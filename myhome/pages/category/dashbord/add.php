<div id="add-category-manager" class="d-none text-center overflow-y">
    <?= (!empty($upload)?$upload:'') ?>
    <hr>
    <input type="hidden" id="parent-category-id">
    <lable>
        عنوان سردسته
    </lable><br>
    <input type="text" id="category-title" class="inputs">
    <br><hr>
    <lable>
        توضیحات سردسته
    </lable><br>
    <input type="text" id="category-description" class="inputs h-100px">
    <br><hr>
    <input type="button" onclick="btnTypeAction('add','category',this,event,0);" value="ایجاد">
</div>