<div class="search d-none">
    <a class="back-to-category" onclick="backToCategoryNav(this)"><img src="<?= base_url() ?>assets/svg/back.svg"></a>
    <input class="search-category inputs" type="search" onkeypress="searchCategory(this,event);" placeholder="جستجو کلی">
</div>
<?php if(!empty($menu)){ ?>
    <link href="<?= base_url()?>assets/css/category/nav.css" rel="stylesheet">
    <h1 class="text-center" style="
    margin: 6px 0;
    width: 90%;
    display: inline-block;
    font-size: 13px;
    ">دسته بندی ها
    </h1>
    <a class="search-icon" onclick="searchShow(this);"><img src="<?= base_url() ?>assets/svg/search.svg"></a>
    <nav class=" rounded-50px h-50px" id="nav">
        <ul class="p-0 my-5px f-right w-100d h-40px l-h-37px text-center">
            <?php foreach($menu as $a){?>
                <li class="d-inline-block"><a class="category-nav-menu px-25px rounded-10" id="category-nav-menu-option-<?= $a['id'] ?>" onclick="changeCategory(<?= $a['id'] ?>)"><?= (!empty($a['icon'])?'<img src="'. base_url() .'assets/svg/category/'. $a['icon'].'" class="w-30px h-30px ml-10px v-align">':'') . $a['title'] ?></a></li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>