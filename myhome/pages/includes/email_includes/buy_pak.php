<html>
<head>
    <style type='text/css'>
        body {background: #2e3035;font-family: Verdana, Geneva, sans-serif}
        a {text-decoration: none;color: #edac7f !important;}
        p,div,h1 {text-align:center;font-weight:bold}
    	h1{color:#23104f;}
        .div{box-shadow: 3px 3px 26px #000000;padding: 10px;border-radius: 10px;background: #252937;}
    	.div p{color:#f5ecec;display:inline-block;width:50%;word-break: break-word;vertical-align: middle;float: left;padding-top: 15px;font-size:25px;}
        .div img{border-radius: 10px;display:inline-block;width:50%;height:auto;min-height:100px;}
        .div p img{height:150px;width:auto;max-width:100%;margin:auto;border-radius: 10px;display:block;}
        article {direction:rtl;margin-top:10px;word-break: break-word;padding: 20px;max-height: 300px;overflow-x: hidden;overflow-y: auto;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;color: #dfe5a5;}
    </style>
</head>
<body>
    <h1>
        <a href="<?= base_url() ?>">
            مدیریت کسب و کار خانه ی من
        </a>
    </h1>
    <div class="div">
    	<img src="<?= base_url('assets/img/brand/logo.jpg') ?>" alt="my-home.ir">
        <p>
            
            <?php if(!empty($company_info)){ ?>
                <p style="margin:auto;">
                    <img src="<?= base_url('assets/'.(!empty($company_info['icon'])?'svg/company/'.$company_info['icon']:(!empty($company_info['qr_code'])?'qrcode/'.$company_info['qr_code']:'svg/company/company.svg'))) ?>">
                    <span>
                        <?= (!empty($company_info['title'])?$company_info['title']:'') ?> 
                        <?= (!empty($company_info['description'])?$company_info['description']:'') ?>
                    </span>
                </p>
            <?php } ?>
            <p>خرید بسته ارتقای کسب و کار شما ثبت شد</p>
            
        </p>
    </div>
    <?php if(!empty($data)){ ?>
        <div>
            <article>
        		<?= (!empty($text)?$text:'') ?>
            </article>
        </div>
    <?php } ?>
</body>
</html>