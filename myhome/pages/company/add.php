<div id="add-company-manager" class="text-center">
    <?= (!empty($uploader)?$uploader:'') ?>
    <hr>
    <br>
    <lable>
        عنوان کسب و کار
    </lable>
    <br>
    <br>
    <input class="inputs" type="text" id="company-title">
    <br>
    <hr>
    <br>
    <lable>
        توضیحات کسب و کار
    </lable>
    <br>
    <br>
    <input  class="inputs h-120px" type="text" id="company-description">
    <br>
    <hr>
    <br>
    <lable>
        آدرس سایت(اختیاری)
    </lable>
    <br>
    <br>
    <input class="inputs" type="url" id="company-url">
    <br>
    <hr>
    <br>
    <lable>
        نوع تجارت مورد نظر
    </lable>
    <br>
    <br>
    <input type="radio" id="team" name="type" value="1">
    <label for="html">تجارت چند نفره</label>
    <br>
    <br>
    <input type="radio" id="one" name="type" value="0" checked>
    <label for="css">تجارت تک نفره</label><br>
    <br>
    <hr>
    <br>
    <input type="button" onclick="btnTypeAction('add','company',this,event,0);" value="ایجاد">
</div>