<html>
<head>
    <style type='text/css'>
        body {background: #2e3035;font-family: Verdana, Geneva, sans-serif}
        a {text-decoration: none;color: #d7e4fb !important;}
        p,div,h1 {text-align:center;font-weight:bold}
    	div p{color:#f5ecec;display:inline-block;width:50%;word-break: break-word;vertical-align: middle;float: left;padding-top: 15px;font-size:365%;}
    	h1{color:#23104f;}
        div img{border-radius: 10px;display:inline-block;width:50%;height:auto;min-height:100px;}
        h2{color: #11351c;text-align: center;padding: 7px 10px;}
        article {direction: rtl;word-break: break-word;padding: 20px;max-height: 300px;overflow-x: hidden;overflow-y: auto;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;color: #dfe5a5;}
    </style>
</head>
<body>
    <h1>
        <a href="<?= base_url() ?>">
            مدیریت کسب و کار خانه ی من
        </a>
    </h1>
    <div style="box-shadow: 3px 3px 26px #000000;padding: 10px;border-radius: 10px;background: #252937;">
    	<img src="<?= base_url('assets/img/brand/logo.jpg') ?>" alt="my-home.ir">
        <p>
            سفارش آنی محصول
    	</p>
    </div>
    <?php if(!empty($data)){ ?>
        <div style="margin:10px;">
            <div style="width:45%;display:inline-block;float:right;">
                <img style="height:60px;border-radius:10px;float:right;display:inline;width:auto;" src="<?= (!empty($data['buyer']['image'])?$data['buyer']['image']:base_url('assets/svg/user/user.svg')) ?>" alt="user image">
                <span style="padding-top:24px;display: inline-block;font-size:30px;">
                    <?= (!empty($data['buyer']['name'])?$data['buyer']['name']:'').' '.(!empty($data['buyer']['family'])?$data['buyer']['family']:'') ?>
                </span>
            </div>
            <div style="width:45%;display:inline-block;float:left;">
                <img style="height:60px;border-radius:10px;float:right;display:inline;width:auto;" src="<?= (!empty($data['product']['icon'])?base_url('assets/svg/product/'.$data['product']['icon']):base_url('assets/qrcode/'.$data['product']['qr_code'])) ?>" alt="product image">
                <span style="padding-top:24px;display: inline-block;font-size:30px;">
                    <?= (!empty($data['product']['title'])?$data['product']['title']:'') ?>
                </span>
            </div>
        </div>
        <div style="clear:both;width:100%;"></div>
        <div>
            <div>
                <h2>خرید موفق محصول</h2>
                <article>
    		        <?= (!empty($text)?$text:'') ?>
                </article>
            </div>
        </div>
    <?php } ?>
</body>
</html>