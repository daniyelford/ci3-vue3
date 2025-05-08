<html>
<head>
    <style type='text/css'>
        body {background: #2e3035;font-family: Verdana, Geneva, sans-serif}
        a {text-decoration: none;color: inherit;}
        p,div,h1 {text-align:center;font-weight:bold}
    	div p{color:#f5ecec;display:inline-block;width:50%;word-break: break-word;vertical-align: middle;float: left;padding-top: 15px;font-size:20px;}
    	h1{color:#23104f;}
        div img{border-radius: 10px;display:inline-block;width:50%;height:auto;min-height:100px;}
        ul {margin: 0;list-style: none;width: 85%;max-height: 340px;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;overflow-x: hidden;overflow-y: auto;float: right;text-align: end;padding: 0;padding-right: 40px;}
        h2{color: #11351c;text-align: center;padding: 7px 10px;}
        li {color: #dfe5a5;width:100%;padding: 20px;border-bottom: 1px solid #86f7f2;box-shadow: 0 0 26px #dfe5a5;align-content: center;justify-content: flex-start;display: flex;flex-direction: row-reverse;flex-wrap: nowrap;gap: 10px;align-items: center;}
        li img {width: 50px;display: inline-block;min-height: auto;}
        li span{padding:12px 10px;}
        article {direction:rtl;word-break: break-word;padding: 20px;max-height: 300px;overflow-x: hidden;overflow-y: auto;border-radius: 10px;box-shadow: 3px 3px 26px #000000;background: #252937;color: #dfe5a5;}
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
            <?php if(!empty($data['meet_users']) && is_array($data['meet_users'])){ ?>
                <div style="width:40%;float: right;">
                    <h2>با حضور</h2>
                    <ul>
                        <?php $tot=[];
                        foreach($data['meet_users'] as $a){ 
                            if(!empty($a) && !empty($a['info']) && !empty($a['info']['id']) && intval($a['info']['id'])>0 && !in_array(intval($a['info']['id']),$tot)){ 
                                $tot[]=intval($a['info']['id']);
                                $a=$a['info']; ?>
                                <li>
                                    <img src="<?= (!empty($a['image'])?$a['image']:base_url('assets/svg/user/user.svg')) ?>">
                                    <span>
                                        <?= (!empty($a['name'])?$a['name']:'').' '.(!empty($a['family'])?$a['family']:'') ?>
                                    </span>
                                </li>
                            <?php } 
                        } ?>
                    </ul>
                </div>
            <?php } ?>
            <div style="width:60%;float: left;">
                <h2>اطلاعات کلی</h2>
                <article>
                    جلسه ای با موضوع
                    <br>
                    <?= (!empty($data['title'])?$data['title']:'تعیین نشده') ?>
                    <br><br>
                    توضیحات
                    <br>
                    <?= (!empty($data['description'])?$data['description']:'ندارد') ?>
                </article>
            </div>
        </div>
    <?php } ?>
</body>
</html>