<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wallet_handler
{
  private Security_handler $security;
  private Functions_handler $function;
  private User_handler $user;
  private Users_model $users_model;
  private Wallet_model $wallet_model;
  private Notification_model $notification_model;
  public function __construct(
    Security_handler $security_handler,
    Functions_handler $functions_handler,
    User_handler $user_handler,
    Users_model $users_model,
    Wallet_model $wallet_model,
    Notification_model $notification_model
  ){
    $this->security = $security_handler;
    $this->function = $functions_handler;
    $this->user = $user_handler;
    $this->users_model = $users_model;
    $this->wallet_model = $wallet_model;
    $this->notification_model = $notification_model;
	}
  public function get_cards() {
    $user_id = $this->user->get_user_id();
    if (!$user_id) return ['status' => 'error', 'message' => 'شناسه کاربر یافت نشد'];
    $cards = $this->wallet_model->select_carts_where_user_id($user_id);
    return ['status' => 'success', 'data' => $cards];
  }
  public function add_card($data) {
    $user_id = $this->user->get_user_id();
    if (!$user_id) return ['status' => 'error', 'message' => 'شناسه کاربر یافت نشد'];
    if(!empty($data) && (!empty($data['shomare_cart']) || !empty($data['shomare_hesab']) || !empty($data['shomare_shaba']))){
      $shaba=$this->security->string_security_check($data['shomare_shaba']);
      $cart=$this->security->string_security_check($data['shomare_cart']);
      $hesab=$this->security->string_security_check($data['shomare_hesab']);
      if (!($cart || $shaba || $hesab)) {
        return ['status' => 'error', 'message' => 'شماره کارت یا شبا نامعتبر است'];
      }
      return $this->wallet_model->add_cart([
        'shomare_shaba'=>$shaba??null,
        'shomare_hesab'=>$hesab??null,
        'shomare_cart'=>$cart??null,
      ]) ? ['status' => 'success'] : ['status' => 'error', 'message' => 'خطا در افزودن کارت'];
    }
    return ['status'=>'error'];
  }
  public function delete_card($data) {
    if($this->user->get_user_id() && !empty($data) && !empty($data['id']) && intval($data['id'])>0 && 
    $this->wallet_model->remove_cart_where_id(intval($data['id']))){
      return ['status'=>'success'];
    }
    return ['status'=>'error'];
  }
  public function get_withdrawals(){
    $user_id = $this->user->get_user_account_id();
    if(!empty($user_id) && intval($user_id)>0){
      $withdraws = $this->wallet_model->select_account_withdraws_where_user_account_ids(intval($user_id));
      $cart_ids = array_column($withdraws, 'user_cart_id');
      $cards = $this->wallet_model->select_carts_where_in_cart_ids($cart_ids);
      foreach ($withdraws as &$w) {
        if(!empty($w) && !empty($w['user_cart_id']) && intval($w['user_cart_id'])>0)
        $w['card_info'] = $cards[array_search(intval($w['user_cart_id']), array_column($cards, 'id'))];
      }
      return ['status' => 'success', 'data' => $withdraws];
    }
    return ['status'=>'error'];
  }
  public function request_withdrawal($input){
    $user_id = $this->user->get_user_account_id();
    $user_info=$this->user->get_user_info();
    $user_wallet=(!empty($user_info) && !empty($user_info['wallet'])?floatval($user_info['wallet']):0);
    $amount = floatval($input['amount'] ?? 0);
    $card_id = intval($input['card_id'] ?? 0);
    $result_money=$user_wallet-$amount;
    if ($user_wallet <= 0 || $result_money <= 0 || $amount > $user_wallet || intval($user_id) <= 0 || $amount <= 0 || $card_id <= 0) {
      return ['status' => 'error', 'message' => 'مبلغ یا کارت نامعتبر است'];
    }
    $user_id=intval($user_id);
    $card = $this->wallet_model->select_carts_where_id($card_id);
    if (empty($card) || $card[0]['user_id'] != $this->user->get_user_id()) {
        return ['status' => 'error', 'message' => 'کارت متعلق به شما نیست'];
    }
    $insert = [
        'user_account_id' => $user_id,
        'user_cart_id' => $card_id,
        'value' => $amount,
        'time' => date('Y-m-d H:i:s'),
        'vaziate_entghal' => 'pending'
    ];
    $this->wallet_model->add_withdraw($insert);
     $paymentData = [
        'report_list_id' => 0,
        'pay_money_user_account_id' => $user_id,
        'give_money_user_account_id' => $user_id,
        'give_money_user_cart_id' => $card_id,
        'product_id' => null,
        'product_count' => 1,
        'amount' => $amount,
        'factor' => 'برداشت توسط کاربر',
        'status' => 'dont',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
    $this->wallet_model->add_payement($paymentData);
    $this->users_model->edit_account_weher_id(['balance'=>$result_money],$user_id);
    $this->notification_model->insert([
      'user_account_id'=>intval($this->user->get_user_account_id()),
      'title'=>'درخواست برداشت',
      'body'=>'درخواست شما برای برداشت وجه از کیف پولتان به مقدار'.number_format($amount).'تومان ثبت شد',
      'url'=>base_url('wallet'),
    ]);
    return ['status' => 'success'];
  }
  public function get_transactions() {
    $res=[];
    $user = $this->user->get_user_account_id();
    if (!$user) return ['status' => 'error', 'message' => 'کاربر یافت نشد'];
    $info=$this->wallet_model->select_payment_info_where_user_account_id(intval($user));
    $this->function->get_cartables_data();
    $this->function->set_cartables_data();
    foreach($info as $a){
      $arr=[];
      if(!empty($a) && !empty($a['pay_money_user_account_id']) && intval($a['pay_money_user_account_id'])>0 && !empty($a['give_money_user_account_id']) && intval($a['give_money_user_account_id'])>0){
        $arr['amount']=$a['amount']??0;
        $arr['factor']=$a['factor']??'';
        $arr['status']=$a['status']??'';
        $arr['created_at']=$a['created_at']??'';
        $arr['updated_at']=$a['updated_at']??'';
        if(intval($a['pay_money_user_account_id'])===intval($a['give_money_user_account_id'])){
          $arr['action']='w';
          if(!empty($a['give_money_user_cart_id']) && intval($a['give_money_user_cart_id'])>0){
            $arr['cart']=$this->wallet_model->select_carts_where_id(intval($a['give_money_user_cart_id']));
          }
        }elseif(intval($a['pay_money_user_account_id'])===intval($user)){
          $arr['action']='p';
          $arr['user']=$this->user->get_user_info_where_user_account(intval($a['give_money_user_account_id']));
          $arr['order']=$this->function->find_order($a['order_ids']??'');
        }elseif(intval($a['give_money_user_account_id'])===intval($user)){
          $arr['action']='g';
          $arr['user']=$this->user->get_user_info_where_user_account(intval($a['pay_money_user_account_id']));
          $arr['order']=$this->function->find_order($a['order_ids']??'');
        }
      }
      $res[]=$arr;
    }
    return ['status' => 'success', 'data' => $res];
  }
  public function get_discount_cards(){

  }
}