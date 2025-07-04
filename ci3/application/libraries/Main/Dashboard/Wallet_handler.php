<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wallet_handler
{
  private $CI;
  private $user;
  private $security;
  public function __construct(){
		$this->CI =& get_instance();
    $this->CI->load->model('Users_model');
    $this->CI->load->model('Wallet_model');
    $this->CI->load->model('Media_model');
    $this->CI->load->model('Category_model');
    $this->CI->load->library('Tools/Security_handler');
    $this->CI->load->library('Main/Dashboard/User_handler');
    $this->CI->load->model('News_model');
    $this->CI->load->model('Notification_model');
    $this->user=new User_handler();
    $this->security=new Security_handler();
	}
  private function find_order($ids){
    $result=[];
    if(!empty($ids) && is_string($ids) && ($a=explode(',',$ids))!==false &&
    !empty($a) && ($b=$this->CI->Wallet_model->select_orders_where_in_order_ids($a))!==false && !empty($b)){
      foreach ($b as $c) {
        if(!empty($c) && !empty($c['product_id']) && intval($c['product_id'])>0){
        // report_list_id	product_count	amount	created_at	updated_at
          $this->CI->Wallet_model->select_product_where_id(intval($c['product_id']));

        }
      }
      $result[]=[];
    }  
    return $result;
  }
  public function get_cards() {
    $user_id = $this->user->get_user_id();
    if (!$user_id) return ['status' => 'error', 'message' => 'شناسه کاربر یافت نشد'];
    $cards = $this->CI->Wallet_model->select_carts_where_user_id($user_id);
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
      return $this->CI->Wallet_model->add_cart([
        'shomare_shaba'=>$shaba??null,
        'shomare_hesab'=>$hesab??null,
        'shomare_cart'=>$cart??null,
      ]) ? ['status' => 'success'] : ['status' => 'error', 'message' => 'خطا در افزودن کارت'];
    }
    return ['status'=>'error'];
  }
  public function delete_card($data) {
    if($this->user->get_user_id() && !empty($data) && !empty($data['id']) && intval($data['id'])>0 && 
    $this->CI->Wallet_model->remove_cart_where_id(intval($data['id']))){
      return ['status'=>'success'];
    }
    return ['status'=>'error'];
  }
  public function get_withdrawals(){
    $user_id = $this->user->get_user_account_id();
    if(!empty($user_id) && intval($user_id)>0){
      $withdraws = $this->CI->Wallet_model->select_account_withdraws_where_user_account_ids(intval($user_id));
      $cart_ids = array_column($withdraws, 'user_cart_id');
      $cards = $this->CI->Wallet_model->select_carts_where_in_cart_ids($cart_ids);
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
    $card = $this->CI->Wallet_model->select_carts_where_id($card_id);
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
    $this->CI->Wallet_model->add_withdraw($insert);
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
    $this->CI->Wallet_model->add_payement($paymentData);
    $this->CI->Users_model->edit_account_weher_id(['balance'=>$result_money],$user_id);
    return ['status' => 'success'];
  }
  public function get_transactions() {
    $res=[];
    $user = $this->user->get_user_account_id();
    if (!$user) return ['status' => 'error', 'message' => 'کاربر یافت نشد'];
    $info=$this->CI->Wallet_model->select_payment_info_where_user_account_id(intval($user));
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
            $arr['cart']=$this->CI->Wallet_model->select_carts_where_id(intval($a['give_money_user_cart_id']));
          }
        }elseif(intval($a['pay_money_user_account_id'])===intval($user)){
          $arr['action']='p';
          $arr['user']=$this->user->get_user_info_where_user_account(intval($a['give_money_user_account_id']));
          $arr['order']=$this->find_order($a['order_ids']??'');
        }elseif(intval($a['give_money_user_account_id'])===intval($user)){
          $arr['action']='g';
          $arr['user']=$this->user->get_user_info_where_user_account(intval($a['pay_money_user_account_id']));
          $arr['order']=$this->find_order($a['order_ids']??'');
        }
      }
      $res[]=$arr;
    }
    return ['status' => 'success', 'data' => $res];
  }
  public function get_discount_cards(){

  }
}