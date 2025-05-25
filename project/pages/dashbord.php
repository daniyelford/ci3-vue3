<script src="<?= base_url() ?>assets/js/dashbord/function.js"></script>
<style>
    #content section , #add-company{
        position: absolute;
        top:15px;
        left:0;
        right:0;
        bottom:0;
        width: auto;
        height: auto;
        overflow-y: auto;
    }
</style>
<a class="z-index-9 w-50px h-50px b-165px l-0 p-fixed" id="add-company-btn-show" onclick="changePageClick('add-company');"><img width="100%" height="100%" src="<?= base_url() ?>assets/svg/company/add.svg"></a>
<a class="z-index-9 w-50px h-50px b-210px l-0 p-fixed d-none" id="company-manager-btn-show" onclick="changePageClick('company-info');"><img width="100%" height="100%" src="<?= base_url() ?>assets/svg/company/company.svg"></a>
<a class="z-index-9 w-50px h-50px l-0 b-120px p-fixed" href="/logout"><img width="100%" height="100%" src="<?= base_url() ?>assets/svg/user/logout.svg"></a>
<?php if(!empty($content)){ ?>
    <?= $content ?>
<?php } ?>
<div id="add-company" class="d-none">
    <a class="z-index-9 w-50px h-50px b-165px l-0 p-fixed" id="dashbord-manager-btn-show" onclick="changePageClick('dashbord');"><img width="100%" height="100%" src="<?= base_url() ?>assets/svg/user/dashbord.svg"></a>
    <?= (!empty($add)?$add:'') ?>
</div>
<script>
    $(function(){
        if($('#content').children('section').length>1){
            $('#company-manager-btn-show').removeClass('d-none');
            $('#content').children('section').addClass('d-none');
            $('#content').children('section').first().removeClass('d-none');
        }
        return true;
    })
</script>