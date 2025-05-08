<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .picture-div:hover{
	    opacity:0.9;
	}
	.preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 2.5% !important;
    }
    .table td ,.table th{
        padding: 5px !important;
        vertical-align: baseline !important;
    }
</style>     
<div class='mt-5 container-fluid' style="min-height:480px;">   
    <div class='row row-sm'>
            <div class="col-xl-12 my-5">
				<div class="card">
					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h1 class="card-title mg-b-0">جدول پست ها</h1>
							<span class="pull-left text-end"><a class="btn" title="add post" href="<?= base_url()."post".DS."add_post"?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
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
										<th>عنوان پست</th>
										<th>متن پست</th>
										<th>لینک پست</th>
										<th>عکس پس زمینه</th>
										<th>توضیحات</th>
										<th>قیمت</th>
										<th>قیمت با تخفیف</th>
										<th>اعتبار</th>
										<th>مشاهده</th>
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
    					    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='<?= base_url()."post".DS."add_post"?>'>افزودن پست</a>
    					</div>
					<?php }?>
			    	</div>
				</div>
			</div>
	</div>
</div>