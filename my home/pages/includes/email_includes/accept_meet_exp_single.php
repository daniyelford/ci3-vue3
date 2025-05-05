<html>
<head>
    <style type='text/css'>
        body {background: #2e3035;font-family: Verdana, Geneva, sans-serif}
        a {text-decoration: none;color: inherit;}
        p,div,h1 {text-align:center;font-weight:bold}
    	div p{color:#f5ecec;display:inline-block;width:50%;word-break: break-word;vertical-align: middle;float: left;padding-top: 15px;font-size:25px;}
    	h1{color:#23104f;}
        div img{border-radius: 10px;display:inline-block;width:50%;height:auto;min-height:100px;}
        h2{color: #11351c;text-align: center;padding: 7px 10px;}
        article {word-break: break-word;padding: 20px;max-height: 300px;overflow-x: hidden;overflow-y: auto;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;color: #dfe5a5;}
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
    		<?= (!empty($text)?$text:'') ?>
    	</p>
    </div>
    <?php if(!empty($data)){ ?>
            <div>
                <h2>اطلاعات</h2>
                <article>
                    جلسه ای با موضوع
                    <br>
                    <?= (!empty($data['info']['title'])?$data['info']['title']:'تعیین نشده') ?>
                    <br><br>
                    توضیحات
                    <br>
                    <?= (!empty($data['info']['description'])?$data['info']['description']:'ندارد') ?>
                </article>
            </div>
    <?php } ?>
</body>
</html>