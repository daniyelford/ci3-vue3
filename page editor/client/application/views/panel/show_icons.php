<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(isset($_GET['err']) && !empty($_GET['err']) && $_GET['err']=='del'){?>
    <script>
        swal({
            title: "عملیات نا موفق",
            text: "آیکون مورد نظر پاک نشد",
            icon: "error",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>icon"); 
        });
    </script>
    <?php }elseif(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success']=='del'){?>
      <script>
        swal({
            title: "عملیات موفق",
            text: "آیکون مورد نظر پاک شد",
            icon: "success",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>icon"); 
        });
    </script>
    <?php }?>

        <div class='mt-5 container fluid' style="min-height:480px;">   
            <div class='row row-sm'>
                <div class="col-xl-12 mt-3">
					<div class="card">
						<div class="card-header pb-0">
							<div class="d-flex justify-content-between">
								<h1 class="card-title mg-b-0">جدول آیکون ها</h1>
								<span class="pull-left text-end"><a class="btn" title="add menu" href="<?= base_url()."icon".DS."add_icon"?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
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
											<th>عنوان آیکون</th>
											<th>class مربوط</th>
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
											<td><span style="color:grey;"><?php if(!empty($val['class'])){?><i class="<?= $val['class']?>" aria-hidden="true"></i><?php }elseif(!empty($val['shrtcd'])){ echo $val['shrtcd']; }else{echo "-";}?></span></td>
											<td>
											    <?php if($val['status'] == 1){?>
											        <a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='<?= base_url()."icon".DS."disable_icon".DS.$val['id']?>'>غیر فعال</a>
											    <?php }else{?>
											        <a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='<?= base_url()."icon".DS."enable_icon".DS.$val['id']?>'>فعال</a>
											    <?php }?>
											</td>
											<td>
											    <a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink' href='<?= base_url()."icon".DS."delete_icon".DS.$val['id']?>'>حذف</a>
											    <a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='<?= base_url()."icon".DS."edit_icon".DS.$val['id']?>'>ویرایش</a>
											</td>
											
										</tr>
										<?php $num++; }?>
									</tbody>
								</table>
							</div>
							<?php }else{?>
    							<div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
    							    <p>
    						آیکونی وجود ندارد لطفا ابتدا آیکون ایجاد کنید
    							    </p>
    							    <br>
    							    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='<?= base_url()."icon".DS."add_icon"?>'>افزودن آیکون</a>
    							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>