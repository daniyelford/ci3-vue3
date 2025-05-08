<style>
    .swal-text{
        color: grey;
        direction:rtl;
        text-align:center;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    <?php if(isset($_GET['hasChild']) && !empty($_GET['hasChild']) && $_GET['hasChild'] == 'err'){ ?>
        swal({
            title: "عملیات نا موفق",
            text: "درون این ساید بار منو وجود دارد ابتدا غیر فعال یا خذفشان کنید",
            icon: "error",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>sidebars"); 
        });
    <?php }elseif(isset($_GET['del']) && !empty($_GET['del']) && $_GET['del'] == 'err'){ ?>
        swal({
            title: "عملیات نا موفق",
            text: "ساید بار حذف نشد",
            icon: "error",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>sidebars"); 
        });
    <?php }elseif(isset($_GET['del']) && !empty($_GET['del']) && $_GET['del'] == 'success'){?>
        swal({
            title: "عملیات موفق",
            text: "ساید بار با موفقیت حذف شد",
            icon: "success",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>sidebars"); 
        });
    <?php } ?>
</script>
        <div class='mt-5 container fluid'style='min-height:480px;'>   
            <div class='row row-sm'>
                <div class="col-xl-12 my-5">
					<div class="card">
						<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
								<h3 class="card-title mg-b-0">
								    جدول ساید بار ها
								</h3>
								<span class="pull-left text-end"><a class="btn" title="add sidebar" href="<?= base_url()."sidebars".DS."add_side"?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
							</div>
							<p class="tx-12 tx-gray-500 mb-2">
							    در این جدول می توانید محل ساید بار منو ها را کنترل کنید.
							</p>
						</div>    
						<div class="card-body">
						    <?php if(!empty($data)){?>
							<div class="table-responsive">
								<table class="table table-hover mb-0 text-md-nowrap text-center">
									<thead>
										<tr>
											<th>شماره</th>
											<th>عنوان سایدبار</th>
											<th>موقعیت</th>
											<th>وضعیت</th>
											<th>عملیات</th>
										</tr>
									</thead>
									<tbody>
									    <?php 
									    $num=1;
									    foreach($data as $val){?>
										<tr>
											<th scope="row"><?= $num?></th>
											<td><?= $val['title']?></td>
											<td><?php switch($val['place']){
											    case "top":
											        echo "بالا";
											        break;
											    case "left":
											        echo "چپ";
											        break;
											    case "right":
											        echo "راست";
                                                    break;
                                                default:
                                                    echo "پایین ";
                                                    break;
											}?></td>
										
											<td>
											    <?php if($val['status'] == 1){?>
											        <a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='<?= base_url()."sidebars".DS."disable_side".DS.$val['id']?>'>غیر فعال</a>
											    <?php }else{?>
											        <a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='<?= base_url()."sidebars".DS."enable_side".DS.$val['id']?>'>فعال</a>
											    <?php }?>
											</td>
											<td>
											    <a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink' href='<?= base_url()."sidebars".DS."delete_side".DS.$val['id']?>'>حذف</a>
											    <a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='<?= base_url()."sidebars".DS."edit_side".DS.$val['id']?>'>ویرایش</a>
											</td>
											
										</tr>
										<?php $num++; }?>
									</tbody>
								</table>
							</div>
							<?php }else{?>
    							<div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
    							    <p>
    							 ساید باری وجود ندارد لطفا ابتدا ساید باری ایجاد کنید
    							    </p>
    							    <br>
    							    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='<?= base_url()."sidebars".DS."add_side"?>'>افزودن سایدبار</a>
    							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>	