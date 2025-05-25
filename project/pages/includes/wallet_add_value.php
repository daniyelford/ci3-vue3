<?php if(!empty($wallet) && !empty($wallet['id']) && intval($wallet['id'])>0 && !empty($id) && intval($id)>0){ ?>
    <div class="row mt-3">
        <div class="col-12">
            <h4>
                افزایش مبلغ
                <a class="text-success" href="<?= base_url('wallet') ?>">
                    کیف پول
                </a>
            </h4>
            <p>
                شما از این صفحه می توانید موجودی کیف پول خود را افزایش دهید به خاطر داشته باشد 
            <strong>
                قیمت ها به تومان است
            </strong>
            </p>
            
        </div>
        <br>
        <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3 mb-1">
            <a onclick="addmoneyvalue(50000);" class="w-100 h-100 d-inline-block btn btn-dark-gradient rounded-10 text-center p-5">50,000</a>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3 mb-1">
        	<a onclick="addmoneyvalue(100000);" class="w-100 h-100 d-inline-block btn btn-dark-gradient rounded-10 text-center p-5">100,000</a>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3 mb-1">
            <a onclick="addmoneyvalue(150000);" class="w-100 h-100 d-inline-block btn btn-dark-gradient rounded-10 text-center p-5">150,000</a>
        </div>
        <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3 mb-1">
        	<a onclick="addmoneyvalue(200000);" class="w-100 h-100 d-inline-block btn btn-dark-gradient rounded-10 text-center p-5">200,000</a>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-10 mx-auto">
            <?php if(!empty($wallet)){ ?>
                <h6 class="text-center">
        		    موجودی فعلی :
                    تومان <?= (!empty($wallet['value'])?number_format($wallet['value']):0) ?>
                </h6>
    		<?php } ?>
            <p class="text-center p-1">
                مبلغ قابل پرداخت را تایید و یا به صورت دستی مبلغ دلخواه خود را وارد کنید به خاطر داشته باشد مبلغ باید بیشتر از ده هزار تومان و تا سقف ده میلیون تومان باشد
            </p>
            <input step="1000" type="number" class="w-100 ht-40 rounded-10 border-none text-center" id="money-value" placeholder="جمع کل به تومان">
            <br>
            <br>
            <button class="btn btn-success btn-block rounded-10" onclick="addMoney();">افزایش</button>
        </div>
    </div>
    <script>
        function addmoneyvalue(x){
            let z=0,y=$('#money-value').val();
            if(y!=='' && y!==0 && y!=='0'){
                z=parseInt(y);
            }
            z+=x;
            $('#money-value').val(z);
            return true;
        }
        function addMoney(){
            let v=$('#money-value').val();
            if(parseInt(v)<10000000 && parseInt(v)>10000){
                let siteKey=$('#site-key').val(),data={w:<?= intval($wallet['id']) ?>,u:<?= intval($id) ?>,v:v,t:'افزایش موجودی کیف پول به مبلغ '+v+' تومان'} ,url=baseUrl('includes/wallet/pay');
                grecaptcha.ready(function() {
                    grecaptcha.execute(siteKey, {action: 'send'}).then(function(token) {
                		$('#send').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                		$.post(url,{data:data, token: token}, function(result) {
                		    if(result==0){
                		        return not1();
                		    }else{
                		        window.location.replace(result);
                		    }
                        });
                	});
                });     
            }else{
                return not15();
            }
        }
    </script>
<?php } else{ ?>
    <div class="row row-sm my-2">
        <div class="col-12 bd-b bd-primary mb-3 pb-1">
            <div class="alert alert-danger p-4 rounded-10 text-center">
                <a class="text-success" 
                href="<?= base_url('user_setting') ?>">
                    اطلاعات حساب ناقص است لطفاً آن را کامل کنید
                </a>
            </div>
        </div>
    </div>
<?php } ?>