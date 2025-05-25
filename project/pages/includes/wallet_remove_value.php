<?php if(!empty($wallet) && !empty($wallet['id']) && intval($wallet['id'])>0 && !empty($id) && intval($id)>0){ ?>
    <div class="row mt-3">
        <div class="col-12 text-center">
        <h4>
            برداشت مبلغ از 
            <a class="text-success" href="<?= base_url('wallet') ?>">
                کیف پول
            </a>
        </h4>
        <p>
            شما از این صفحه می توانید از کیف پول خود برداشت وجه کنید به خاطر داشته باشد 
            <strong>
                قیمت ها به تومان است
            </strong>
            <br>
            <strong>
                حسابی را برای تسویه وجه انتخاب کنید
            </strong>
        </p>
        </div>
        <br>
        <?php if(!empty($carts) && is_array($carts)){ ?>
            <div class="col-10 mx-auto overflow-y-auto" style="max-height:300px">
                <div class="row mt-3">
                    <?php foreach($carts as $a){ 
                        if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
                            <div class="col-sm-6 mx-auto mb-1">
                                <a
                                <?= (!empty($a['status']) && intval($a['status'])>0?'onclick="selectCart('.$a['id'].');"':'onclick="not20();"') ?>
                                class="cart-number w-100 h-100 d-inline-block btn rounded-10 text-center p-5
                                cart-<?= $a['id'] .' '. (!empty($a['status']) && intval($a['status'])>0?'btn-dark-gradient':'btn-danger-gradient') ?>">
                                    <?php if(!empty($a['cart_number'])){ ?>
                                        <span><?= $a['cart_number'] ?></span>
                                    <?php }if(!empty($a['cart_info'])){ ?>
                                        <br>
                                        <span><?= $a['cart_info'] ?></span>
                                    <?php } ?>
                                </a>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3 mx-auto mb-1">
                <a href="<?= base_url('add_cart') ?>" class="bg-danger-gradient w-100 h-100 d-inline-block btn btn-dark-gradient rounded-10 text-center p-5">
                    <p>
                        شما حسابی را برای خود مشخص نکردید
                        <br>
                        برای ایجاد حساب برای خود کلیک کنید
                    </p>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="row my-3">
        <div class="col-10 mx-auto">
            <?php if(!empty($wallet)){ ?>
                <h6 class="text-center">
        		    موجودی فعلی :
                    تومان 
                    <?= (!empty($wallet['value']) && intval($wallet['value'])>0?number_format($wallet['value']):0) ?>
                </h6>
    		<?php } ?>
            <p class="text-center p-1">
                مبلغ قابل پرداخت را تایید و یا به صورت دستی مبلغ دلخواه خود را وارد کنید به خاطر داشته باشد مبلغ باید بیشتر از ده هزار تومان و تا سقف ده میلیون تومان باشد
            </p>
            <input step="1000" type="number" class="w-100 ht-40 rounded-10 border-none text-center" id="money-value" placeholder="جمع کل به تومان">
            <br>
            <input type="hidden" id="cart-id">
            <br>
            <button class="btn btn-success btn-block rounded-10" onclick="removeMoney(this);">برداشت</button>
        </div>
    </div>
    <script>
        function selectCart(id){
            $('.cart-number').removeClass('border-success');
            $('.cart-'+id).addClass('border-success');
            $('#cart-id').val(id);
            return true;
        }
        function removeMoney(el){
            let v=$('#money-value').val(),c=$('#cart-id').val(),wp=<?= (!empty($wallet['value']) && intval($wallet['value'])>0?intval($wallet['value']):0) ?>;
            if(parseInt(c)>0){
                if(parseInt(v)<10000000 && parseInt(v)>10000){
                    if(parseInt(v)<=wp){                
                        return sendAjax({w:<?= intval($wallet['id']) ?>,u:<?= intval($id) ?>,v:v,t:'',c:c} ,baseUrl('includes/wallet/harvest'),'');
                    }else{
                        return not19();
                    }
                }else{
                    return not15();
                }
            }else{
                return not18();
            }
        }
    </script>
 <?php } else{ ?>
    <div class="row row-sm my-2">
        <div class="col-12 bd-b bd-primary mb-3 pb-1">
            <div class="alert alert-danger p-4 rounded-10 text-center">
                <a class="text-success" 
                href="<?= base_url('add_cart') ?>">
                    اطلاعات حساب ناقص است لطفاً آن را کامل کنید
                </a>
            </div>
        </div>
    </div>
<?php 
} ?>
