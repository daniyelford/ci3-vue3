<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
if(!empty($_GET['dis'])){
    echo ($_GET['dis'] == "err"?'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "خطا",text: "انجام نشد",icon: "error",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>':'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "موفقیت",text: "انجام شد",icon: "success",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>');
}
if(!empty($_GET['bomb'])){
    echo ($_GET['bomb'] == "err"?'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "خطا",text: "انجام نشد",icon: "error",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>':'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "موفقیت",text: "انجام شد",icon: "success" ,button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>');
}
if(!empty($_GET['en'])){
    echo ($_GET['en'] == "err"?'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "خطا",text: "انجام نشد",icon: "error",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>':'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "موفقیت",text: "انجام شد",icon: "success",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>');
}
if(!empty($_GET['up'])){
    echo ($_GET['up'] == "err"?'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "خطا",text: "انجام نشد",icon: "error",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>':'<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script><script>swal({title: "موفقیت",text: "انجام شد",icon: "success",button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});</script>');
}
?>
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
							<h1 class="card-title mg-b-0">جدول سایت ها</h1>
							<span class="pull-left text-end"><a class="btn" title="add site" href="<?= base_url()."site_user".DS."add"?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
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
										<th>اسم شرکت</th>
										<th>نام خریدار</th>
										<th>شماره تماس</th>
										<th>توضیحات</th>
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
    		                    سایتی موجود نیست ابتدا یکی اضافه کنید
    					    </p>
    					    <br>
    					    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='<?= base_url()."site_user".DS."add"?>'>افزودن سایت</a>
    					</div>
					<?php }?>
			    	</div>
				</div>
			</div>
		</div>
	</div>