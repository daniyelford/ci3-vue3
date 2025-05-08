<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .picture-div:hover {
        opacity: 0.9;
    }

    .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 2.5% !important;
    }
    .tab-content img {
    width: 60%  !important;
    margin-right: 20% !important;
    height: 100% !important;
}
div.stars span.fa.fa-star{
    display: inline-block !important;
}
div.stars  span.fa.fa-star.checked {
    color: gold !imprtant;
}
</style>

<div class='mt-5 container fluid' style="min-height:480px;">
    <div class='row row-sm'>
        <?php if (!empty($data)){
        foreach ($data as $v){
        echo(!is_null($v['style']) && !empty($v['style']) ? "<style>" . $v['style'] . "</style>" : '');
        ?>
            <div class="col-xl-12 my-5">
                <div>
                    <a class="main-header-arrow" href="#" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
                    <div class="main-content-body main-content-body-contacts card custom-card">
                        <div class="main-contact-info-header pt-3">
                            <div class="media">
                                <div class="main-img-user">
                                    عنوان متن :
                                </div>
                                <div class="media-body">
                                    <h5><?php echo $v['title']; ?></h5>
                                </div>
                            </div>
                            <div class="main-contact-action btn-list pt-3 pr-3">
                                <input type='hidden' id='post_id' value='<?php echo $v['id']; ?>'/>
                                <a href="<?php echo base_url() . 'content' . DS . 'edit_content' . DS . $v['id']; ?>"
                                   class="btn btn-secondary-gradient rounded-10 pd-x-25 box-shadow-danger text-white"
                                   type="button">ویرایش</a>
                                <?php //if ($v['status'] == 1) { ?>
                                    <!--<a href="<?php echo base_url() . 'content' . DS . 'disable' . DS . $v['id']; ?>"-->
                                    <!--   class="btn btn-dark-gradient rounded-10 pd-x-25 box-shadow-pink mr-1 text-white"-->
                                    <!--   type="button">غیر فعال سازی</a>-->
                                <?php //} else { ?>
                                    <!--<a href="<?php echo base_url() . 'content' . DS . 'enable' . DS . $v['id']; ?>"-->
                                    <!--   class="btn btn-success-gradient rounded-10 pd-x-25 box-shadow-pink mr-1 text-white"-->
                                    <!--   type="button">فعال سازی</a>-->
                                <?php //} ?>
                                <a href="#" id="d"
                                   class="btn btn-danger-gradient rounded-10 pd-x-25 box-shadow-danger mr-1 text-white"
                                   type="button">حذف</a>
                                <a href="<?php echo base_url() . 'content'; ?>"
                                   class=" btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-pink mr-1 text-white"
                                   type="button">انصراف</a>
                            </div>
                        </div>
                        <div class="main-contact-info-body p-4 ps">

                            <div class="media-list pb-0">
                                <div class="media">
                                    <div class="media-body">
                                        <div>
                                            <label style="margin-bottom: 2.5%;">تصاویر این متن</label>
                                            <?php if (!empty($pics)) {
                                                $num = $numb = 2;
                                                $g = '<div class="preview-pic tab-content"><div class="tab-pane active" id="pic-1"><img src="' . base_url() . 'pic' . DS . (!empty($pics['0'])?$pics['0']:$pics['1']) . '" alt="تصویر"></div>';
                                                $nn=(!empty($pics['0'])?1:2);
                                                for ($capt = $nn; $capt <= count($pics) - 1; $capt++) {
                                                    if(!empty($pics[$capt])){
                                                    $g .= '<div class="tab-pane" id="pic-' . $numb . '"><img src="' . base_url() . 'pic' . DS . $pics[$capt] . '" alt="تصویر"></div>';
                                                    $numb++;
                                                    }
                                                }
                                                $g .= "</div>";
                                                
                                                echo $g;
                                                ?>
                                                <ul class="preview-thumbnail nav nav-tabs">
                                                    <?php if(!empty($pics)){
                                                    
                                                       $h = '<li class="active mb-1"style="margin-right: 0 !important;width: 20% !important;"><a data-target="#pic-1" data-toggle="tab"><img style="width: 98%;height: 100%;margin-right: 1%;" src="' . base_url() . 'pic' . DS . (!empty($pics['0'])?$pics['0']:$pics['1']) . '" alt="تصویر"></a></li>';
                                                    $xx=(!empty($pics['0'])?1:2);
                                                    for ($captal = $xx; $captal <= count($pics) - 1; $captal++) {
                                                        if(!empty($pics[$captal])){
                                                        $h .= '<li class="mb-1"style="margin-right: 0 !important;width: 20% !important;"><a data-target="#pic-' . $num . '" data-toggle="tab"><img style="width: 98%;height: 100%;margin-right: 1%;" src="' . base_url() . 'pic' . DS . $pics[$captal] . '" alt="تصویر"></a></li>';
                                                        $num++;
                                                        }
                                                    }  
                                                    
                                                    echo $h;
                                                   } ?>
                                                </ul>
                                            <?php } else { ?>
                                                <div class='alert alert-danger mt-5 rounded-10 pd-x-25 text-center'>
                                                    هیچ عکسی برای این متن انتخاب نشده
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($v['des'])){?>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                <label>توضیحات مختصر</label>
                                                <span class="tx-medium"><?php echo $v['des']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="media">
                                    <div class="media-body">
                                        <div>
                                            <label>توضیحات تکمیلی</label>
                                            <span class="tx-medium"><?php echo $v['text']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($writer)){?>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                <label>نویسنده</label>
                                                <span class="tx-medium"><?php echo $writer; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } if (!empty($editors) && !empty($editors['0'])) {?>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                <label>ویرایشگران</label>
                                                <?php for ($love = 0; $love <= count($editors) - 1; $love++) { ?>
                                                    <span class="tx-medium"><?php echo $editors[$love]; ?></span>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if(is_numeric($v['rate']) && !empty($v['rate'] && $v['rate'] !=0)){?>
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="rating mb-1">
                                                                                                <span class="review-no">امتیاز متن</span>
                                                <div class="stars">
                                                    <?php switch($v['rate']){
                                                        case '1':
                                                            echo '<span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span>';
                                                            break;

                                                        case '2':
                                                            echo '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span>';
                                                            break;

                                                        case '3':
                                                            echo '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span>';
                                                            break;

                                                        case '4':
                                                            echo '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span>';
                                                            break;

                                                        default:
                                                            echo '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>';
                                                            break;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if(!empty($v['words'])){?>
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                <label>کلمات</label>
                                                <span class="tx-medium"><?php echo $v['words']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="media mb-0">
                                    <div class="media-body">
                                        <div>
                                            <label>تاریخ</label>
                                            <span class="tx-medium"><?php echo $v['date']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ps__rail-x" style="left: 0px; top: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; right: 663px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $(".checked").css('color','gold');
                    $('#d').click(function () {
                        let id = $('#post_id').val();
                        let send = 's';
                        $.ajax({
                            url: "<?php echo base_url();?>content/del",
                            method: "POST",
                            data: {send: send, id: id},
                            success: function (values) {
                                if (values == 0) {
                                    swal({
                                        title: "عملیات نا موفق",
                                        text: "متن مورد نظر پاک نشد",
                                        icon: "error",
                                        button: "متوجه شدم"
                                    }).then(function () {
                                        window.location.replace("<?php echo base_url()?>content/show_content/" + id);
                                    });
                                }
                                if (values == 1) {
                                    swal({
                                        title: "عملیات موفق",
                                        text: "متن مورد نظر پاک شد",
                                        icon: "success",
                                        button: "ادامه"
                                    }).then(function () {
                                        window.location.replace("<?php echo base_url()?>content");
                                    });
                                }
                            }
                        })
                    });
                })
            </script>
        <?php }
        } else {
            header('location:' . base_url() . 'err' . DS . 'not_found');
        } ?>
    </div>
</div>