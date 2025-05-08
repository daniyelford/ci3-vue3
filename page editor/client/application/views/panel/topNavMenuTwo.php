<style>
    .sub-menu li a:before {
        display:none !important;
    }
    .horizontalMenu > .horizontalMenu-list > li > ul.sub-menu > li > a {
        padding: 8px 20px;
        color:black !important;
    }
</style>
<?php foreach($data as $val){
    echo $val;
}?>