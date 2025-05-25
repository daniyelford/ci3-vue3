<div id="edit-company-manager" class="d-none">
    <input type="hidden" class="companyId">
    <?= (!empty($uploader)?$uploader:'') ?>
    <input type="text" id="company-title">
    <input type="text" id="company-description">
    <input type="url" id="company-url">
    <input type="radio" id="team" name="type" value="1">
    <label for="html">تجارت چند نفره</label>
    <br>
    <br>
    <input type="radio" id="one" name="type" value="0" checked>
    <label for="css">تجارت تک نفره</label><br>
    <input type="button" onclick="btnTypeAction('edit','company',this,event,0);" value="ویرایش">
</div>