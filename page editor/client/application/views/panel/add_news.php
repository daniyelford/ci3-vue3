
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container-fluid my-5" style="min-height:480px;">
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12 my-5">
			<div class="card">
    			<div class="card-body">
					<div class="main-content-label mg-b-5">
					<a style="float:left;padding: 7px;color:red;" title="انصراف" href="<?php echo base_url()."news";?>"><i class="fa fa-times" aria-hidden="true"></i></a>
						<h3 class="pull-right txt-start">
					    </h3>
					</div><p class="mg-b-20">
					</p>
					<div class="pd-30 pd-sm-40 bg-gray-200">
						<?= form_open()?>
							<div class="row row-xs" style="line-height: 0px;height: 55px;">
								<div class="col-md-12">
								    <label>عنوان اطلاعیه</label>
									<?= form_input($t) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
							</div>
							<div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>سایت مورد نظر</label>
								    <?= $s ?>
								    <br>
									<span class="mt-2 text-danger tx-10 d-none" id="siteErr">نمیتوانید این فیلد را خالی بگذارید!</span>
								</div>
								<div class="col-md-6 mg-t-10 mg-md-t-0">
								    <label>مدت اعتبار</label>
								    <div class="card">
                						<div class="card-body" style="padding: 0;">
                							<div class="main-content-label d-none mg-b-5">
                							</div>
                							<div class="row row-sm">
                								<div class="input-group col-sm-12">
                									<div class="input-group-prepend">
                										<div class="input-group-text">
                											<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                										</div>
                									</div><?= form_input($e) ?>
                								</div>
                							</div>
                						</div>
                					</div>
								</div>
							</div>
							<div class="row row-xs mt-3" style="line-height: 0px;">
								<div class="col-md-12 mg-t-10 mg-md-t-0">
								    <label>متن اطلاعیه</label>
									<?= form_textarea($c) ?>
									<br>
									<span class="mt-2 text-danger tx-10 d-none" id="contentErr">نمیتوانید فیلد class را خالی بگذارید!</span>
								</div>
							</div>
							<div class="row row-xs mt-3" style="line-height: 0px;height: 55px;">
    							<div class="col-md-6 mg-t-10 mg-md-t-0">
            					    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button"><?php echo (!empty($edit)?'ویرایش':'افزودن');?></a>
            					</div>
        	    				<div class="col-md-6 mg-t-10 mg-md-t-0">
        		    				<a href="<?php echo base_url().'news';?>" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
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
    $(document).ready(function (){
        $("#send").click(function(){
            let title = $("#title").val();
            let content =$("#content").val();
            let site=$("#site").val();
            let date=$('#datepicker1').val();
            let send="ok";
            if(title ==''){
                $("#title").css({"border":"1px solid red"});
                if($("#titleErr").hasClass('d-none')){
                    $("#titleErr").removeClass("d-none");
                    $("#titleErr").addClass("d-block");
                }
            }else{
                $("#title").css({"border":"1px solid green"});
                if($("#titleErr").hasClass('d-none')){}else{
                    $("#titleErr").removeClass("d-block");
                    $("#titleErr").addClass("d-none");
                }
            }
            if(content == ''){
                $("#content").css({"border":"1px solid red"});
                if($("#contentErr").hasClass('d-none')){
                    $("#contentErr").removeClass("d-none");
                    $("#contentErr").addClass("d-block");
                }
            }else{
                if($("#contentErr").hasClass('d-none')){}else{
                $("#contentErr").removeClass("d-block");
                $("#contentErr").addClass("d-none");}
                $("#content").css({"border":"1px solid green"});
            }
            if(site == '0'){
                $("#site").css({"border":"1px solid red"});
                if($("#siteErr").hasClass('d-none')){
                    $("#siteErr").removeClass("d-none");
                    $("#siteErr").addClass("d-block");
                }
            }else{
                if($("#siteErr").hasClass('d-none')){}else{
                    $("#siteErr").removeClass("d-block");
                    $("#siteErr").addClass("d-none");
                }
                $("#site").css({"border":"1px solid green"});
            }
            if(title != '' && site != '0' && content != ''){
                <?php if(!empty($edit)){?>
                let id='<?php echo $edit;?>';
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>news/check_edit",
                    data:{date:date,title:title,content:content,site:site,send:send,id:id},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>news/edit/"+id); 
                            });
                        }
                        if(values==1){
                            let xa='asad';
                            let type ='news';
                            let con=12345654321;
                            let news='<?php echo $_SESSION['id'];?>';
                            news = news + con + title + con + content + con;
                            news= news + "<?php echo $_SESSION['role'];?>";
                            news=news+con+date+con+id;
                            $.ajax({
                                method:'post',
                                url:site+'err/n_f',
                                data:{xa:xa,type:type,news:news,send:send},
                                success:function (x){
                                    if(x == 1){
                                        swal({
                                            title: "عملیات موفق",
                                            text: "اطلاعیه ویرایش شد",
                                            icon: "success",
                                            button: "ادامه"
                                        }).then(function(){
                                            window.location.replace("<?php echo base_url();?>news"); 
                                        });
                                    }
                                }
                            })
                        }
                        
                    }
                })
                <?php }else{ ?>
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>news/check_add",
                    data:{
                        date:date,
                        title:title,
                        content:content,
                        site:site,
                        send:send
                    },
                    success:function (newsId){
                        
                        if(newsId == 0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>news/add"); 
                            });
                        }else{
                            let xa='asad';
                            let type ='news';
                            let con=12345654321;
                            let news='<?php echo $_SESSION['id'];?>';
                            news = news + con + title + con + content + con;
                            news= news + "<?php echo $_SESSION['role'];?>";
                            news=news+con+date+con+newsId;
                            $.ajax({
                                method:'post',
                                url:site+'err/n_f',
                                data:{
                                    send:send,
                                    xa:xa, 
                                    type:type,
                                    news:news
                                },
                                success:function (y){
                                    if(y == 1){
                                        $('#title').val('');
                                        $('#content').val('');
                                        $('#datepicker1').val('<?php echo (isset($itemOutData->datepicker1) ? set_value('datepicker1', date('Y-m-d', strtotime($itemOutData->datepicker1))) : set_value('datepicker1'))?>');
                                        $('#site').val('0').change();
                                        $('#title').css('border','1px solid gold');
                                        $('#content').css('border','1px solid gold');
                                        $('#site').css('border','1px solid gold');
                                        swal({
                                            title: "عملیات موفق",
                                            text: "اطلاعیه ی جدید اضافه شد",
                                            icon: "success",
                                            button: "ادامه"
                                        });
                                    }
                                }
                            })
                        }
                        
                    }
                })
                <?php }?>
            }
        })
    })
</script>
<script src="<?php echo base_url();?>assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pickerjs/picker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/file-upload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fancyuploder/fancy-uploader.js"></script>