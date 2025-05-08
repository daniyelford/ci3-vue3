<div id="edit-category-manager" class="d-none text-center">
    <?= (!empty($upload)?$upload:'') ?>
    <hr><br>
    <input type="hidden" class="id">
    <lable>
        عنوان دسته
    </lable><br><br>
    <input type="text" id="category-title-edit" class="inputs">
    <hr><br>
    <lable>
        توضیحات دسته
    </lable><br><br>
    <input type="text" id="category-description-edit" class="inputs">
    <input type="hidden" class="parentId">
    <hr><br>
    <lable>
        انتخاب سردسته ی دسته
    </lable><br><br>
    <span class="parentsInner">
        <a class="active p-id-0" onclick="changeParentIdVal(this,0);">اصلی</a>
        <?= (!empty($parent)?$parent:'-') ?>
    </span>
    <input type="button" onclick="btnTypeAction('edit','category',this,event,0)" value="ویرایش">
</div>