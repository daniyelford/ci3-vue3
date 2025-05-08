<script src="<?= base_url() ?>assets/inc/uploader/script.js"></script>
<?php
    $a='';
    $b=implode('',range('A', 'Z'));
    for ($i = 0; $i < 10; $i++) {
        $a .= $b[random_int(0, strlen($b) - 1)];
    }
    $a.rand(1000000,10000000);
?>
<input type="hidden" class="file-name">
<input type="hidden" class="url" value="<?= (!empty($url) && is_string($url)?$url:'0') ?>">
<input type="hidden" class="type" value="<?= (!empty($type) && is_string($type)?$type:'0') ?>">
<input type="hidden" class="mediaType">
<form method="post" enctype="multipart/form-data" id="<?= $a ?>" class="w-100 mx-auto imageuploadform" onsubmit="uploadSubmit(this,'<?= $a ?>',event);">
    <lable for="fileupload">بارگذاری فایل</lable>
    <input hidden="true" class="fileupload" type="file" name="file" multiple onchange="changeFileUplod(this,event);">
    <div>
        <a class="btn btn-dark-gradient mh-2v border-none h-100p w-100 mx-auto shadow-light rounded-10 p-10px text-center" onclick="btnUploadClick(this,event);">افرودن</a>
    </div>
</form>
<div id="progress-<?= $a ?>">
    <div class="mt-2 rounded-10 text-center file-progress-bar pd-5"></div>
</div>
<div class="w-100 d-none rounded-10 bg-opacity box-shadow-pink" id="media-<?= $a ?>"></div>