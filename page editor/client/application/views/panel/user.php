<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(isset($_GET['err']) && !empty($_GET['err']) && $_GET['err']=='del'){?>
    <script>
        swal({
            title: "عملیات نا موفق",
            text: "کاربر ادمین اصلی است نمی توانید آن را حذف کنید",
            icon: "error",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>user"); 
        });
    </script>
    <?php }elseif(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success']=='del'){?>
      <script>
        swal({
            title: "عملیات موفق",
            text: "کاربر مورد نظر پاک شد",
            icon: "success",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>user"); 
        });
    </script>
    <?php }?>
    <style>
        .table td ,.table th{
            padding: 5px !important;
            vertical-align: baseline !important;
        }
    </style>
    <div class='my-5 container fluid' style="min-height:480px;">   
        <div class='row row-sm'>
            <div class="col-xl-12 my-5">
				<div class="card">
					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h1 class="card-title mg-b-0">جدول کاربرها</h1>
							<span class="pull-left text-end"><a class="btn text-danger" title="add member" href="<?= base_url().'home'?>"><i class="fa fa-times" aria-hidden="true"></i></a></span>
						</div>
						<p class="tx-12 tx-gray-500 mb-2">
						</p>
					</div>
					<div class="card-body">
					    <?php if(!empty($x)){?>
	    				<div class="table-responsive">
							<table class="table table-hover mb-0 text-md-nowrap text-center">
								<thead>
									<tr>
										<th>شماره</th>
										<th>نام</th>
										<th>نام خانوادگی</th>
										<th>کد ملی</th>
										<th>عکس</th>
										<th>نام پدر</th>
										<th>شماره تماس</th>
										<th>محل تولد</th>
										<th>سن</th>
										<th>نقش کاربری</th>
										<th>عملیات</th>
									</tr>
								</thead>
								<tbody>
								    <?php echo $x;?>
								</tbody>
							</table>
			   			</div>
					<?php }else{?>
    					<div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
    					    <p>
    		شما هنوز ثبت نام نکردید
    					    </p>
    					</div>
					<?php }?>
			    	</div>
				</div>
			</div>
		</div>
	</div>
	