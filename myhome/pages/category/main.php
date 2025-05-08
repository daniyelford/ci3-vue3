<link href="<?= base_url()?>assets/css/category/category.css" rel="stylesheet">
<script src="<?= base_url()?>assets/js/category/script.js"></script>
<div id="category-show">
<h2 class="text-center" style="
    margin: 6px 0;
    font-size: 13px;
">زیر دسته های موجود
</h2>
    <?= (!empty($menu) && is_string($menu)?$menu:'') ?>
</div>