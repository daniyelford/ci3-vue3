<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(isset($_GET['dis']) && !empty($_GET['dis']) && $_GET['dis']=='error'){?>
    <script>
        swal({
            title: "عملیات نا موفق",
            text: "",
            icon: "error",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>news"); 
        });
    </script>
    <?php }elseif(isset($_GET['dis']) && !empty($_GET['dis']) && $_GET['dis']=='success'){?>
      <script>
        swal({
            title: "عملیات موفق",
            text: "",
            icon: "success",
            button: "متوجه شدم"
        }).then(function(){
            window.location.replace("<?php echo base_url();?>news"); 
        });
    </script>
    <?php }?>
<style>
    .table td ,.table th{
        padding: 5px !important;
        vertical-align: baseline !important;
    }
</style>
    <div class='my-5 container-fluid' style="min-height:480px;">   
        <div class='row row-sm'>
            <div class="col-xl-12 my-5">
				<div class="card">
					<div class="card-header pb-0">
						<div class="d-flex justify-content-between">
							<h1 class="card-title mg-b-0">جدول اخبار</h1>
						    <span class="pull-left text-end"><a class="btn" title="add news" href="<?= base_url() ?>news/add"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
						</div>
						<p class="tx-12 tx-gray-500 mb-2">
						</p>
					</div>
					<div class="card-body">
					    <?php if(!empty($x)){ ?>
					    <div class="table-responsive">
							<table class="table table-hover mb-0 text-md-nowrap text-center">
								<thead>
									<tr>
										<th>شماره</th>
										<th>عنوان اطلاعیه</th>
										<th>متن اطلاعیه</th>
										<th>زمان پایان</th>
                                        <th>سایت مورد نظر</th>
										<th>وضعیت</th>
										<th>عملیات</th>
									</tr>
								</thead>
								<tbody>
					    
					    <?= $x ?>
					    		</tbody>
							</table>
			   			</div>
					    <?php }else{?>
    					<div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
                            <a href="<?= base_url()?>home" style='float:left;padding:7px;color:red;' title="انصراف"><i class='fa fa-times' aria-hidden='true'></i></a>
    					    <p>
    		                اطلاعیه ای تولید نشده است
    					    </p>
    					    
    					    <a href="<?= base_url()?>news/add" class="btn btn-primary rounded-10 box-shadow-pink text-center pd-x-45 mx-auto">افزودن اطلاعیه</a>
    					</div>
					<?php }?>
			    	</div>
				</div>
			</div>
		</div>
	</div>
	