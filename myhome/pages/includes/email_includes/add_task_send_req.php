<html>
<head>
    <style type='text/css'>
    /*no*/
        body {background: #2e3035;font-family: Verdana, Geneva, sans-serif}
        a {text-decoration: none;color: inherit;}
        p,div,h1 {text-align:center;font-weight:bold}
    	div p{color:#f5ecec;display:inline-block;width:50%;word-break: break-word;vertical-align: middle;float: left;padding-top: 15px;font-size:365%;}
    	h1{color:#23104f;}
        div img{border-radius: 10px;display:inline-block;width:50%;height:auto;min-height:100px;}
        ul {margin: 0;list-style: none;width: 85%;max-height: 340px;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;overflow-x: hidden;overflow-y: auto;float: right;text-align: end;padding: 0;padding-right: 40px;}
        h2{color: #11351c;text-align: center;padding: 7px 10px;}
        li {color: #dfe5a5;width:100%;padding: 20px;border-bottom: 1px solid #86f7f2;box-shadow: 0 0 26px #dfe5a5;align-content: center;justify-content: flex-start;display: flex;flex-direction: row-reverse;flex-wrap: nowrap;gap: 10px;align-items: center;}
        li img {width: 50px;display: inline-block;min-height: auto;}
        li span{padding:12px 10px;}
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
            <div>
                <h2></h2>
                <article>
                    درخواست شما برای انجام کار توسط اعضا ارسال شده است
                    <!--
                    <br>
                    <?= (!empty($data['info']['title'])?$data['info']['title']:'تعیین نشده') ?>
                    <br><br>
                    توضیحات
                    <br>
                    <?= (!empty($data['info']['description'])?$data['info']['description']:'ندارد') ?>
                    -->
                </article>
            </div>
        </div>
    <?php } ?>
</body>
</html>