<?php if(!empty($id) && intval($id)>0){ 
    if(!empty($has_info) && $has_info){ ?>
        <div class="row mt-3">
            <div class="col-10 mx-auto">
                <h4>
                    شماره حساب های مرتبط به
                    <a class="text-success" href="<?= base_url('wallet') ?>">
                        کیف پول
                    </a>
                </h4>
                <p>
                    برای افزودن حساب کافیست شماره شبا حساب بانکی خود را وارد کرده تا پس از بررسی حویت از سمت بانک صادر کننده حساب شما برای انجام عملیات تسویه ثبت شود
                    <br>
                    به خاطر داشته باشید حساب باید به نام خودتان باشد و در صورت مغایر بودن اطلاعات پروفایل شما و اطلاعات بانکی شما کارت مورد تایید نخواهد بود و درحین ثبت مشخصات توجه کافی را داشته باشید
                </p>
            </div>
            <?php if(!empty($carts) && is_array($carts)){ ?>
                <div class="col-10 mx-auto overflow-y-auto" style="max-height:300px">
                    <div class="row mt-3">
                        <?php foreach(array_reverse($carts) as $a){ 
                            if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){ ?>
                                <div class="col-sm-6 my-1 h-100 <?= (!empty($a['status']) && intval($a['status'])>0?'bg-success-gradient':'bg-danger-gradient') ?> rounded-10 text-center p-5">
                                    <span class="">
                                        <?= (!empty($a['cart_number'])?$a['cart_number']:'') ?>
                                    </span>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="col-10 mx-auto alert alert-danger p-5 text-center text-dark rounded-10">
                    شما حساب فعالی ندارید از همین صفحه یکی برای خود فعال کنید
                </div>
            <?php } ?>
        </div>
        <div class="row my-3">
            <div class="col-10 mx-auto">
                <h4 class="w-100">
                    ثبت حساب با شماره شبا
                </h4>
                <p>
                    شماره شبا باید بدون فاصله و IR باشد
                </p>
            </div>
            <div class="col-10 mx-auto">
                <input type="text" class="w-100 ht-40 rounded-10 border-none text-center" id="cart-number" placeholder="شماره شبا بدون IR">
                <br>
                <br>
                <button class="btn btn-success btn-block rounded-10" onclick="addCart(this);">ثبت</button>
            </div>
        </div>
        <script>
            function addCart(el){
                let c = $('#cart-number').val();
                if(c!==''){
                    if(c.length==22||c.length==24){
                        return sendAjax({u:<?= intval($id) ?>,c:c} ,baseUrl('includes/wallet/add_cart_action'),'');
                    }else{
                        return not2();
                    }
                }else{
                    return not1();
                }
            }
        </script>
    <?php } else{ ?>
        <div class="row row-sm my-2">
            <div class="col-12 bd-b bd-primary mb-3 pb-1">
                <div class="alert alert-danger p-4 rounded-10 text-center">
                    <a class="text-success" href="<?= base_url('user_setting') ?>">
                        اطلاعات شخصی خود را کامل وارد کنید.
                    </a>
                </div>
            </div>
        </div>
    <?php }
} ?>