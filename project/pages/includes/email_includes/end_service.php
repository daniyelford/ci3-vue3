<html>
<head>
    <style type='text/css'>
        body {background: #2e3035;font-family: Verdana, Geneva, sans-serif}
        a {text-decoration: none;color: #edac7f !important;}
        p,div,h1,h2,h3,h5 {text-align:center;font-weight:bold}
    	h1,h2,h3,h5,h6,span{color:#b1af97 !important;}
        article {margin-top:10px;direction:rtl;word-break: break-word;padding: 20px;max-height: 300px;overflow-x: hidden;overflow-y: auto;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;color: #dfe5a5;}
    	.div{box-shadow: 3px 3px 26px #000000;padding: 10px;border-radius: 10px;background: #252937;}
    	.div p{color:#f5ecec;display:inline-block;width:50%;word-break: break-word;vertical-align: middle;float: left;padding-top: 15px;font-size:25px;}
        .div img{border-radius: 10px;display:inline-block;width:50%;height:auto;min-height:100px;}
        .div p img{height:150px;width:auto;max-width:100%;margin:auto;border-radius: 10px;display:block;}
        /*.div p span img{height:50px;width:auto;max-width:100%;margin:auto;border-radius: 100px;display:inline-block;}*/
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
            <?php if(!empty($data['moshtary'])){ ?>
                <p style="margin:auto;">
                    <img src="<?= (!empty($data['moshtary']['image'])?$data['moshtary']['image']:base_url('assets/svg/user/user.svg')) ?>">
                    <span>
                        <?= (!empty($data['moshtary']['name'])?$data['moshtary']['name']:'').''.(!empty($data['moshtary']['family'])?$data['moshtary']['family']:'') ?>
                    </span>
                </p>
            <?php } ?>
            <p>اتمام سرویس دهی</p>
    	</p>
    </div>
    <?php if(!empty($data)){ ?>
        <div>
            <article>
    		    <?= (!empty($text)?$text:'') ?>
            </article>
        </div>
        <br>
        <div class="div">
            <?php if(!empty($data['position'])){ ?>
                <p>
                    <img src="<?= base_url('assets/'.(!empty($data['position']['icon'])?'svg/position/'.$data['position']['icon']:(!empty($data['position']['qr_code'])?'qrcode/'.$data['position']['qr_code']:'svg/position/position.svg'))) ?>">
                    <h2>
                        <?= (!empty($data['position']['title'])?$data['position']['title']:'') ?>
                    </h2>
                    <h3>
                        <?= (!empty($data['position']['description'])?$data['position']['description']:'') ?>
                    </h3>
                    <h5><?php $date=new JDF(); echo $date->jdate('Y/m/d H:i',time()); ?></h5>
                </p>
            <?php } ?>
        </div>
    <?php } ?>
</body>
</html>