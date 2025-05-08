<style>
    .swal-text{
        color: grey;
        direction:rtl;
        text-align:center;
    }
</style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(isset($_GET['hasChild']) && !empty($_GET['hasChild'])){?>
    <script>
        swal({
            title: "خطا!",
            text:"درون این منو منو های دیگری نیز وجود دارد لطفا ابتدا این منو ها را غیرفعال یا حذف و یا به منوی دیگری انتقال دهید",
            icon: "error",
            className: "swtalert",
            button: "متوجه شدم!",
        });
    </script>
<?php } ?>

        <div class='mt-5 container fluid' style="min-height:480px;">   
            <div class='row row-sm'>
                <div class="col-xl-12 my-5">
					<div class="card">
						<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
								<h1 class="card-title mg-b-0">جدول منو ها</h1>
								<span class="pull-left text-end"><a class="btn" title="add menu" href="<?= base_url()."menu".DS."add_menu"?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
							</div>
							<p class="tx-12 tx-gray-500 mb-2">
							</p>
						</div>
						<div class="card-body">
						    <?php if(!empty($data)){?>
							<div class="table-responsive">
								<table class="table table-hover mb-0 text-md-nowrap text-center">
									<thead>
										<tr>
											<th>شماره</th>
											<th>عنوان منو</th>
											<th>آدرس ارسال</th>
											<th>موقعیت</th>
											<th>منوی والد</th>
											<th>سایدبار اصلی</th>
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
											<td><?= $val['link']?></td>
											<td><?php echo ($val['place']=='top'?'بالا':($val['place']=='left'?'چپ':($val['place'] == 'right'?'راست':'پایین'))); ?></td>
											<td>
											    <?php
											        $child = array_filter($data, function($item) use ($val) {
											            return $item['id'] == $val['parent_id'];
											        });
											        if(!empty($child)){
											            foreach ($child as $ch) {
											                echo $ch['title'];
											            }
											        }else{
											            echo "خودش منوی والد است";
											        }
											    ?>
											</td>
											<td><?= $val['stitle']?></td>
											
											<td>
											    <?php if($val['status'] == 1){?>
											        <a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='<?= base_url()."menu".DS."disable_menu".DS.$val['id']?>'>غیر فعال</a>
											    <?php }else{?>
											        <a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='<?= base_url()."menu".DS."enable_menu".DS.$val['id']?>'>فعال</a>
											    <?php }?>
											</td>
											<td>
											    <a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink' href='<?= base_url()."menu".DS."delete_menu".DS.$val['id']?>'>حذف</a>
											    <a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='<?= base_url()."menu".DS."edit_menu".DS.$val['id']?>'>ویرایش</a>
											</td>
											
										</tr>
										<?php $num++; }?>
									</tbody>
								</table>
							</div>
							<?php }else{?>
    							<div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
    							    <p>
    							        منویی وجود ندارد لطفا ابتدا منویی ایجاد کنید
    							    </p>
    							    <br>
    							    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='<?= base_url()."menu".DS."add_menu"?>'>افزودن منو</a>
    							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>	