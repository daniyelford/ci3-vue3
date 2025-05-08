<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    $b=form_dropdown("icons",$n,(!empty($edit)?$n1:'0'),array('class'=>'rounded-5 form-control','id'=>'icons'));
    $d=form_dropdown('parent_id',$p,(!empty($edit)?$p1:'0'),array('class'=>'rounded-5 form-control','id'=>'parent_id'));
    $e=form_dropdown("side_id",$q,(!empty($edit)?$q1:'0'),array('class'=>'rounded-5 form-control','id'=>'side_id'));
    $f=form_dropdown("mega",$r,(!empty($edit)?$r1:'0'),array('class'=>'rounded-5 form-control','id'=>'mega'));
?>

<div class="container-fluid mt-5" style="min-height:480px;">
    <div class="row mt-5">
        <div class="col-lg-11 col-md-11 mx-auto my-5">
			<div class="card">
    			<div class="card-body">
					<div class="main-content-label mg-b-5">
		    			<a style="float:left;padding: 7px;color:red;" title="انصراف" href="<?php echo base_url().'menu';?>"><i class="fa fa-times" aria-hidden="true"></i></a>
			    		<?php if(isset($edit) && !empty($edit)){?>
				    	<h3 class="pull-right txt-start">
					        ویرایش منو
    					</h3>
	    				<?php }else{?>
		    			<h3 class="pull-right txt-start">
			    			ایجاد منو 
				    	</h3>
					    <?php }?>
					</div>
					<br><br>
					<p class="mg-b-20">
					<?php if(isset($edit) && !empty($edit)){?>
				به آسانی می توانید منو های خود را ویرایش کنید
					<?php }else{?>
					در این بخش شما می توانید به آسانی در هر سایدبار منو های مورد نظر خود را ایجاد کنید
					<?php }?>
					</p>
					<div class="pd-30 pd-sm-40 bg-gray-200">
						<?= form_open()?>
							<div class="row row-xs mb-3" style="line-height: 0px;height: 55px;">
								<div class="col-md-6">
								    <label>عنوان منو</label>
									<?= form_input($m); ?>
									<br/>
									<span class="mt-2 text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-3 mg-t-10 mg-md-t-0">
								    <label>سایدبار مورد نظر</label>
									<?= $e ?>
								</div>
								<div class="col-md-3 mg-t-10 mg-md-t-0">
								    <label>منوی مادر</label>
									<?= $d ?>
								</div>
							</div>
							<div class="row row-xs mb-3 mt-4" style="line-height: 0px;height: 55px;">
								
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>لینک منو (آدرس را کامل و در آغاز https را وارد کنید)</label>
									<?= form_input($o); ?>
								</div>
								
								<div class="col-md-3 mg-t-10 mg-md-t-0">
								    <label>آیکون مورد نظر</label>
									<?= $b ?>
								</div>
								<div class="col-md-3 mg-t-10 mg-md-t-0" id="bpr">
								    <label>نوع منو (مخصوص منو های بالای صفحه)</label>
									<?= $f ?>
								</div>
								<div class="col-md-3 mg-t-10 mg-md-t-0 d-none text-center pt-4" id="bpri">
								  
								</div>
							</div>
							<span><a id="showSet" class="<?php if(!empty($edit)){echo 'd-none';} ?>" href="#">تنظیمات پیشرفته</a></span>
							<div class="row row-xs mb-3 sett <?= (empty($edit)?'d-none':'')?>" style="line-height: 0px;height: 55px;">	
							<?php if(!empty($edit)){?>
								<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>لیست</label>
									<?= form_input($s) ?>
								</div>
							<?php }else{?>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>class لیست</label>
									<?= form_input($s) ?>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>attribute لیست</label>
									<?= form_input($t) ?>
								</div>
								<?php }?>
						    </div>
						    <div class="row row-xs mb-3 sett <?= (empty($edit)?'d-none':'')?>" style="line-height: 0px;height: 55px;">
						        <?php if(!empty($edit)){?>
						        	<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>attribute لیست</label>
									<?= form_input($t) ?>
								</div>
						        <?php }else{?>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>class لینک</label>
									<?= form_input($u) ?>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>attribute لینک</label>
									<?= form_input($v) ?>
								</div>
								<?php }?>
							</div>
							<div class="row row-xs mb-3 sett <?= (empty($edit)?'d-none':'')?>" style="line-height: 0px;height: 55px;">
							<?php if(!empty($edit)){?>
								<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>class لینک</label>
									<?= form_input($u) ?>
								</div>
							<?php }else{?>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>class ul منوی فرزند</label>
									<?= form_input($w) ?>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>attribute ul منوی فرزند</label>
									<?= form_input($x) ?>
								</div>
							<?php }?>
							</div>
							<div class="row row-xs mb-3 sett <?= (empty($edit)?'d-none':'')?>" style="line-height: 0px;height: 55px;">
									<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>تگ های html دلخواه</label>
									<?= (!empty($edit)?form_input($v):form_input($y)) ?>
								</div>
									<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>بستن تگ های html دلخواه</label>
									<?= form_input($z) ?>
								</div>
							</div>
							
							<div class="row row-xs mb-2" style="line-height: 0px;height: 55px;">	
							    <div class="col-md-6 mg-t-10 mg-md-t-0">
        						    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button"><?php echo (!empty($edit)?'ویرایش':'افزودن');?></a>
        						</div>
        						<div class="col-md-6 mg-t-10 mg-md-t-0">
        							<a href="<?php echo base_url()?>menu" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        						</div>
							</div>
							
						<?= form_close()?>
					</div>
				</div>
			</div>
		</div>        
    </div>
</div>

<script>
	$(document).ready(function () {
		$("#showSet").click(function () {
			if ($(this).hasClass('d-none')) {
			} else {
				$(this).addClass('d-none')
			}
			
			if ($(".sett").hasClass('d-none')) {
				$(".sett").removeClass('d-none');
				$(".sett").css("display", "flex");
			}
		})
		$("#send").click(function () {
			let title = $("#title").val();
			let link = $("#link").val();
			let parent_id = $("#parent_id").val();
			let side = $("#side_id").val();
			let mega = $("#mega").val();
			let icons = $("#icons").val();
			let custom_html = $("#custom_html").val();
			let end_custom_html = $("#end_custom_html").val();
			let send = "ok";
			if (title == '') {
				$("#title").css({"border": "1px solid red"});
				$("#titleErr").removeClass("d-none");
				$("#titleErr").addClass("d-block");
			} else {
				$("#titleErr").removeClass("d-block");
				$("#titleErr").addClass("d-none");
				$("#title").css({"border": "1px solid green"});
			}
			if(side == 0){
				$("#side_id").css('border','1px solid red');
			}else{
				$("#side_id").css('border','1px solid green');
			}
			if (title != '' && side != 0) {
				<?php if(!empty($edit)){?>
				let id = '<?php echo $edit;?>';
				let list_css = $('#list_css').val();
        		let link_css = $('#link_css').val();
        		let ul_css = $('#ul_css').val();
				$.ajax({
					method: 'POST',
					url: "<?php echo base_url();?>menu/edit_menu_check",
					data: {
						id: id,
						title: title,
						link: link,
						parent_id: parent_id,
						side: side,
						mega: mega,
						icons: icons,
						list_css: list_css,
						link_css: link_css,
						ul_css: ul_css,
						custom_html: custom_html,
						end_custom_html: end_custom_html,
						send: send
					},
					success: function (values) {
						if (values == 0) {
							swal({
								title: "خطا در اطلاعات",
								text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
								icon: "error",
								button: "متوجه شدم"
							}).then(function () {
								window.location.replace("<?php echo base_url();?>menu/edit_menu/" + id);
							});
						}
						if (values == 1) {
							swal({
								title: "عملیات موفق",
								text: "منو ویرایش شد",
								icon: "success",
								button: "ادامه"
							}).then(function () {
								window.location.replace("<?php echo base_url();?>menu");
							});
						}
					},
					error: function () {
						alert('error');
					}
				})
				<?php }else{?>
				let list_class = $("#list_class").val();
    			let list_attr = $("#list_attr").val();
    			let link_class = $("#link_class").val();
    			let link_attr = $("#link_attr").val();
    			let ul_child_class = $("#ul_child_class").val();
    			let ul_child_attr = $("#ul_child_attr").val();
				$.ajax({
					method: 'POST',
					url: "<?php echo base_url();?>menu/check_add_menu",
					data: {
						title: title,
						link: link,
						parent_id: parent_id,
						side: side,
						mega: mega,
						icons: icons,
						list_class: list_class,
						list_attr: list_attr,
						link_class: link_class,
						link_attr: link_attr,
						ul_child_class: ul_child_class,
						ul_child_attr: ul_child_attr,
						custom_html: custom_html,
						end_custom_html: end_custom_html,
						send: send
					},
					success: function (values) {
						if (values == 0) {
							swal({
								title: "خطا در اطلاعات",
								text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
								icon: "error",
								button: "متوجه شدم"
							}).then(function () {
								window.location.replace("<?php echo base_url();?>menu/add_menu");
							});
						}
						if (values == 1) {
							swal({
								title: "عملیات موفق",
								text: "منو ی جدید اضافه شد",
								icon: "success",
								button: "ادامه"
							}).then(function () {
								window.location.replace("<?php echo base_url();?>menu");
							});
						}
					},
					error: function () {
						alert('error');
					}
				})
				<?php }?>
			}
		})
	})
</script>
<script>
    $(document).ready(function (){
        $('#side_id').on('change', function() {
            let selectBox=$(this).val();
            if(selectBox == 0){
                $("#side_id").css('border',"1px solid red");
                $('#parent_id').html('');
            }else{
                $("#side_id").css('border','1px solid green');
              
                 $.ajax({
                    method : "POST" ,
                    url :"<?php echo base_url();?>menu/side_place_id" ,
                    data : { selectBox : selectBox} ,
                    success:function (v){
                        if(v=='left'){
                            $("#bpr").addClass('d-none');
                            $("#bpri").removeClass('d-none');
                            $("#bpri").html('<p class="asdfg">سایدبار سمت چپ صفحه است</p>');
                        }
                        if(v=='right'){
                            $("#bpr").addClass('d-none');
                            $("#bpri").removeClass('d-none');
                            $("#bpri").html('<p class="asdfg">سایدبار سمت راست صفحه است</p>');
                        }
                        if(v=='foot'){
                            $("#bpr").addClass('d-none');
                            $("#bpri").removeClass('d-none');
                            $("#bpri").html('<p class="asdfg">سایدبار پایین صفحه است</p>');
                        }
                        if(v=='top'){
                            $("#bpri").addClass('d-none');
                            $("#bpr").removeClass('d-none');
                        }
                        $.ajax({
                            method : "POST" ,
                            url :"<?php echo base_url();?>menu/menuselectbox" ,
                            data : { selectBox : selectBox} ,
                            success:function (e){
                                $('#parent_id').html(e);
                            },
                            error:function(){
                                alert('error');
                            }
                        });
                    },
                    error:function(){
                        alert('error');
                    }
                });
            }
        });
    })
</script>
