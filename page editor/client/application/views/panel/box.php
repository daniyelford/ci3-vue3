<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(isset($_GET['err']) && !empty($_GET['err']) && $_GET['err']=='del'){?>
    <script>
        swal({
            title: "عملیات نا موفق",
            text: "جعبه ی مورد نظر پاک نشد",
            icon: "error",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>box"); 
        });
    </script>
    <?php }elseif(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success']=='del'){?>
      <script>
        swal({
            title: "عملیات موفق",
            text: "جعبه ی مورد نظر پاک شد",
            icon: "success",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>box"); 
        });
    </script>
    <?php }?>
    <style>
        .table td ,.table th{
            padding: 5px !important;
            vertical-align: baseline !important;
        }
    </style>
    <div class='mt-5 container fluid' style="min-height:480px;">   
        <div class='row row-sm'>
            <div class="col-xl-12 my-5">
				<div class="card">
					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h1 class="card-title mg-b-0">جدول جعبه ها</h1>
							<span class="pull-left text-end"><a class="btn" title="add box" href="<?= base_url()."box".DS."add"?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
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
										<th>عنوان جعبه</th>
										<th>متن جعبه</th>
										<th>لینک جعبه</th>
										<th>عکس پس زمینه</th>
										<th>اندازه ی جعبه</th>
										<th>وضعیت</th>
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
    		جعبه ای وجود ندارد لطفا ابتدا جعبه ایجاد کنید
    					    </p>
    					    <br>
    					    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='<?= base_url()."box".DS."add"?>'>افزودن جعبه</a>
    					</div>
					<?php }?>
			    	</div>
				</div>
			</div>
		</div>
	</div>
	
	