<?php
$month = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
if (!function_exists('convert2english')){
    function convert2english($string){
        $newNumbers = range(0, 9);
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
}
if (!empty($time)) {
    $jalal = new Jdf();
    $now_hour = convert2english($jalal->jdate('H:i', $time));
    $now_day = convert2english($jalal->jdate('d', $time));
    $now_month = $jalal->jdate('F', $time);
    $now_year = convert2english($jalal->jdate('Y', $time));
    ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/inc/timer/style.css">
    <script src="<?= base_url() ?>assets/inc/timer/script.js"></script>
    <div class="my-5px">
        <?php if (!empty($now_hour) && !empty($want_hour) && $want_hour) { ?>
            <input type="time" name="hour" <?= (!empty($dont_use_id)?'':'id="hour"') ?> class="hour rounded-10 bg-info form-control w-50 mx-auto my-3" value="<?= $now_hour ?>">
        <?php }
        if (!empty($now_day)) { ?>
            <select name="day" <?= (!empty($dont_use_id)?'':'id="day"') ?> class="day text-center bg-dark shadow-light rounded-10px color-light w-30d h-40px border-none">
                <?php for ($i = 1; $i < 32; $i++) {
                    if (intval($i) === intval($now_day)) { ?>
                        <option selected class="everyDay" value="<?= $i ?>"><?= $i ?></option>
                    <?php } else { ?>
                        <option class="everyDay" value="<?= $i ?>"><?= $i ?></option>
                    <?php }
                } ?>
            </select>
        <?php }
        if (!empty($now_month)) { ?>
            <select name="month" <?= (!empty($dont_use_id)?'':'id="month"') ?> onchange="changeMonth(this);"; class="month text-center bg-dark shadow-light rounded-10px color-light w-30d h-40px border-none">
                <?php if (!empty($month) && in_array(trim($now_month), $month)) {
                    for ($a = 0; $a <= count($month) - 1; $a++) {
                        if (!empty($month[$a])) {
                            if ($month[$a] == $now_month){ ?>
                                <option selected class="everyMonth" value="<?= $a + 1 ?>"><?= $month[$a] ?></option>
                            <?php } else { ?>
                                <option class="everyMonth" value="<?= $a + 1 ?>"><?= $month[$a] ?></option>
                            <?php }
                        }
                    }
                } else {
                    echo $now_month;
                } ?>
            </select>
        <?php }
        if (!empty($now_year)) { ?>
            <select name="year" <?= (!empty($dont_use_id)?'':'id="year"') ?> class="year text-center bg-dark shadow-light rounded-10px color-light w-30d h-40px border-none">
                <?php $num=(!empty($next_years) && $next_years?intval($now_year)+11:intval($now_year)-101);
                $boolean=$selected=true;
                while($boolean){
                    if(intval($now_year)==intval($num)){
                        $boolean=false;
                    }else{ ?>
                        <option <?= ($selected?'selected':'') ?> value="<?= $now_year ?>" class="everyYear"><?= $now_year ?></option>
                    <?php $selected=false;
                        $now_year=(!empty($next_years) && $next_years?$now_year+1:$now_year-1);
                    } 
                } ?>
            </select>
        <?php } ?>
    </div>
<?php } ?>