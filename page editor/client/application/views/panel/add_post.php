<?php //$musics and $video checking...?>














<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .picture-div:hover{
	    opacity:0.9;
	}
	.preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 2.5% !important;
    }
    #pic_select{
        box-shadow: 8px 8px 800px #9b9b9b;
        max-height: 100px !important;
        overflow-y: auto !important;
        background-color: #3c2b2b2e;
        
    }
    #content ,#dis{
        height:120px;
    }
</style>     
<div class='my-5 container fluid' style="min-height:480px;">   
    <div class='row row-sm'>
		<div class="col-xl-12 my-5">
        	<div class="card">
        	    <a href="<?= base_url()?>post" style='float:left;padding:7px;color:red;width:20px;' title="انصراف"><i class='fa fa-times' aria-hidden='true'></i></a>
				<input type="hidden" id="videos" value="<?= (!empty($videos)?$vedios:'') ?>">
				<input type="hidden" id="musics" value="<?= (!empty($musics)?$musics:'') ?>">
        		<div class="card-body h-100">
        			<div class="row row-sm ">
        				<div class=" col-xl-5 col-lg-12 col-md-12" id="old">
        				    <div style="margin-bottom:0px;" class="">
        				        <a href="#" id="addP" class="mx-1 text-dark">افرودن عکس به پست</a>
        				        <a href="#" id="addM" class="mx-1 text-primary">افرودن موسیقی به پست</a>  
        				        <a href="#" id="addV" class="mx-1 text-primary">افزودن فیلم به پست</a>
                            </div>
        					<p id="picErr" class="d-none text-center" style="color:red;">حتما عکسی را انتخاب کنید</p>
        								    
        		            <div class="preview-pic tab-content">
                                			<div style="height:353px;background-color:white;margin-top: 1px;overflow-y: auto;overflow-x:hidden;">
                                			    <div class="m-2" style="position: absolute;left: 3px;top: -3px;">
                                			        <a id="rola" title="افزودن عکس" style="color:grey;" class="pull-left" href="#">
                                			        <i class="fa fa-plus"></i></a>
                                			    </div>
                                			    <div class="row mt-3 px-2  pt-2 mx-auto text-center" id="bit-pic" style="padding-right: 10px;padding-left:10px;width:100%;">
                                        		<?php 
                                		            if(!empty($data)){
                                		            foreach($data as $p){ ?>
                                        				<div class='col-md-4 my-1 picture-div'>
                                        				    <input class='post-id' type='hidden' value='<?= $p['id'] ?>' />
                                        			        <div class='card text-center'>
                                        		                <img class='card-img-top w-100' src='<?php echo base_url().'pic'.DS.$p['name'];?>' alt='تصاویر پست ها'>    
                                        		            </div>
                                        		        </div>
                                        		<?php }}else{ ?>
                                    			    <div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
                                    			        <p>هیچ عکسی وجود ندارد لطفا ابتدا عکس ایجاد کنید</p><br>
                                        			    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' id='addPic' href='#'>افزودن عکس</a>
                                        			</div>
                                    		    <?php } ?>
                                		        </div>
                                			</div>
                                		</div>
							<ul class="preview-thumbnail nav nav-tabs" id="pic_select">
							            <?php if(!empty($edit)){$picssss=''; for($as=0;$as<=count($pics)-1;$as++){$sho=$pics[$as]['id'].':'.rand(0,9); $picssss.=$sho.','; ?>
							            <li>
							                <input class='post-id' type='hidden' value='<?= $pics[$as]['id'] ?>' />
                                        	<div class='card text-center'>
                                        	    <img class='card-img-top w-100' src='<?php echo base_url().'pic'.DS.$pics[$as]['name'];?>' alt='تصاویر پست ها'>    
                                        	</div>
							            </li>
							            <?php }}?>
									</ul>
				        </div>
				                
				                
				                
				                
			            <div class=" col-xl-5 col-lg-12 col-md-12 d-none" id="oldest">
				            <?php echo form_open_multipart('pic/music_upload','method="post"')?>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="news_image">Playlist Audio <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="play_list_audio" name="play_list_audio" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                  <button id="send" type="submit" class="btn btn-success">Submit</button>
                                </div>
                              </div>
                             <?php echo form_close(); ?>
				        </div>
			                
			            <div class=" col-xl-5 col-lg-12 col-md-12 d-none" id="older">
			                 <!--<form method="post" action="" id="videoUp">-->
                    <!--            <label for="title">Title</label>-->
                    <!--            <input type="text" name="title" id="title" value="" />-->
                         
                    <!--            <label for="userfile">File</label>-->
                    <!--            <input type="file" name="userfile" id="userfile" size="20" />-->
                         
                    <!--            <input type="submit" name="submit" id="submit" />-->
                    <!--        </form>-->
			            </div>
				                
				                
				                
				                
				                
				                <div class=" col-xl-5 col-lg-12 col-md-12 d-none">
        								    <h6 style="margin-bottom:0px;">افزودن عکس به پست</h6>
        								    <p id="picErr" class="d-none text-center" style="color:red;">حتما عکسی را انتخاب کنید</p>
        		                            <div class="preview-pic tab-content">
                                			<div style="height:353px;background-color:white;margin-top: 1px;overflow-y: auto;overflow-x:hidden;">
                                			    <div class="m-2" style="position: absolute;left: 3px;top: -3px;">
                                			        <a id="rola" title="افزودن عکس" style="color:grey;" class="pull-left" href="#">
                                			        <i class="fa fa-plus"></i></a>
                                			    </div>
                                			    <div class="row mt-3 px-2  pt-2 mx-auto text-center" id="bit-pic" style="padding-right: 10px;padding-left:10px;width:100%;">
                                        		<?php 
                                		            if(!empty($data)){
                                		            foreach($data as $p){ ?>
                                        				<div class='col-md-4 my-1 picture-div'>
                                        				    <input class='post-id' type='hidden' value='<?= $p['id'] ?>' />
                                        			        <div class='card text-center'>
                                        		                <img class='card-img-top w-100' src='<?php echo base_url().'pic'.DS.$p['name'];?>' alt='تصاویر پست ها'>    
                                        		            </div>
                                        		        </div>
                                        		<?php }}else{ ?>
                                    			    <div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'>
                                    			        <p>هیچ عکسی وجود ندارد لطفا ابتدا عکس ایجاد کنید</p><br>
                                        			    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' id='addPic' href='#'>افزودن عکس</a>
                                        			</div>
                                    		    <?php } ?>
                                		        </div>
                                			</div>
                                		</div>
							        <ul class="preview-thumbnail nav nav-tabs" id="pic_select">
							            <?php if(!empty($edit)){$picssss=''; for($as=0;$as<=count($pics)-1;$as++){$sho=$pics[$as]['id'].':'.rand(0,9); $picssss.=$sho.','; ?>
							            <li>
							                <input class='post-id' type='hidden' value='<?= $pics[$as]['id'] ?>' />
                                        	<div class='card text-center'>
                                        	    <img class='card-img-top w-100' src='<?php echo base_url().'pic'.DS.$pics[$as]['name'];?>' alt='تصاویر پست ها'>    
                                        	</div>
							            </li>
							            <?php }}?>
									</ul>
				                </div>
						        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
        							<?= form_open()?>
        							<div class="row row-xs mb-1" style="line-height: 0px;height: 55px;">
        								<div class="col-md-6">
        								    <label>عنوان پست</label>
        									<?= form_input($t); ?>
        									<br>
        									<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        								</div>
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <label>لینک پست</label>
        									<?= form_input($l); ?>
        									<br>
        								</div>
        								</div>
        							    <div class="row row-xs mb-1 mt-3" style="line-height: 0px;height: 55px;">
        								<div class="col-md-3 mg-t-10 mg-md-t-0">
        								    <label>قیمت</label>
        									<?= form_input($pric); ?>
        								</div>
        								<div class="col-md-3 mg-t-10 mg-md-t-0">
        								    <label> قیمت باتخفیف</label>
        									<?= form_input($n); ?>
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
        								<div class="row mt-3 row-xs mb-1" style="line-height: 0px;">
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <label>متن پست</label>
        									<?= form_textarea($c); ?>
        									<br>
        									<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="contentErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        							    </div>
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <label>توضیحات بیشتر</label>
        									<?= form_textarea($d); ?>
        								</div>
        							</div>
        							
        									
        							<div class="row row-xs mb-1" style="line-height: 0px;height: 55px;">
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button"><?= (!empty($edit)?'ویرایش':'افزودن') ?></a>
        								</div>
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        									<a href="<?php echo base_url().'post';?>" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        								</div>
        								</div>
        						    <?= form_close()?>
        						    <input type="hidden" id="pi" value="<?php echo (empty($picssss)?'':$picssss); ?>" />
    					        </div>
						    </div>
					    </div>
					</div>
				</div>
		<div class="modal effect-fall" id="modaldemo8" aria-modal="true" style="padding-right: 4px; display: none;">
                            		<div class="modal-dialog modal-dialog-centered" style="width:800px !important;height:400px!important" role="document">
                            			<div class="modal-content modal-content-demo">
                            				<div class="modal-header">
                            					<h6 class="modal-title">
                            					</h6>
                            				</div>
                            				<div class="modal-body text-center">
                            				    <div class="col-sm-12 col-md-10 mg-t-10 mg-sm-t-0 mx-auto">
                            				        <form method="post" id="upload_form" align="center" enctype="multipart/form-data">
                            				            <input type="file" class="dropify" id="image_file" name="image_file" data-default-file="<?php echo base_url();?>assets/img/ecommerce/01.jpg" data-height="200">
                            				            <input type="submit" name="upload" id="upload" value="افزودن به گالری" class="btn btn-info-gradient btn-block mt-1" />
                            				        </form>
                            				    </div>
                            				</div>
                            			</div>
                            		</div>
                            	</div>
	</div>
</div>	

<script>

// $(function() {
// 	$('#videoUp').submit(function(e) {
// 		e.preventDefault();
// 		$.ajaxFileUpload({
// 			url 			:'<?php echo base_url();?>pic/video_upload/', 
// 			secureuri		:false,
// 			fileElementId	:'userfile',
// 			dataType		: 'json',
// 			data			: {
// 				'title'				: $('#title').val()
// 			},
// 			success	: function (data, status)
// 			{
// 				if(data.status != 'error')
// 				{
// 					$('#files').html('<p>Reloading files...</p>');
// 					refresh_files();
// 					$('#title').val('');
// 				}
// 				alert(data.msg);
// 			}
// 		});
// 		return false;
// 	});
// });


    $(document).ready(function(){
        $("#addM").click(function(){
            if($(this).hasClass('text-dark')){}else{
                $(this).addClass('text-dark')
            }
            if($("#addP").hasClass('text-dark')){
                $("#addP").removeClass('text-dark') 
                $("#addP").addClass('text-primary')
            }
            if($("#addV").hasClass('text-dark')){
                $("#addV").removeClass('text-dark') 
                $("#addV").addClass('text-primary')
            }
        })
        $("#addV").click(function(){
                if($(this).hasClass('text-dark')){}else{
                $(this).addClass('text-dark')
            }
            if($("#addP").hasClass('text-dark')){
                $("#addP").removeClass('text-dark') 
                $("#addP").addClass('text-primary')
            }
            if($("#addM").hasClass('text-dark')){
                $("#addM").removeClass('text-dark') 
                $("#addM").addClass('text-primary')
            }
        })
        $("#addP").click(function(){
                if($(this).hasClass('text-dark')){}else{
                $(this).addClass('text-dark')
            }
            if($("#addM").hasClass('text-dark')){
                $("#addM").removeClass('text-dark') 
                $("#addM").addClass('text-primary')
            }
            if($("#addV").hasClass('text-dark')){
                $("#addV").removeClass('text-dark') 
                $("#addV").addClass('text-primary')
            }
        })
    })
</script>
<script>
    function komeil(a, b) {
        let check_id = $(a).val().split(',');
        let id;
        var rn = 1 + Math.floor(Math.random() * 6);
        if ($.inArray(b, check_id, 2)) {
            id = b + ':' + rn;
        } else {
            id = b;
        }
        return id;
    }
            Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };
        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }
        
    $(document).ready(function (){
         <?php if(!empty($edit)){?>
        let picsid="<?php echo $ids_pic;?>";
        picidss=picsid.split(',');
        
        for(r=0;r<=picidss.length-1;r++){
            liklik=picidss[r].split(':');
            
            
	        if( $('.picture-div').find('input[value="'+liklik[0]+'"]').parent().hasClass('rounded-10 box-shadow-primary pt-2') ){
	            $('.picture-div').find('input[value="'+liklik[0]+'"]').parent().removeClass('rounded-10 box-shadow-primary pt-2');
	            $('.picture-div').find('input[value="'+liklik[0]+'"]').parent().addClass('rounded-10 box-shadow-danger pt-2');
	        }else{
	            $('.picture-div').find('input[value="'+liklik[0]+'"]').parent().addClass('rounded-10 box-shadow-primary pt-2')
	        }
        }
        <?php }?>
        let id,ht,fh,as,asi,rmid,i,ids;
        $('.picture-div').on('click',function(){
            if( $(this).hasClass('rounded-10 box-shadow-primary pt-2') ){
                $(this).removeClass('rounded-10 box-shadow-primary pt-2');
                $(this).addClass('rounded-10 box-shadow-danger pt-2');
            }else{
                $(this).addClass('rounded-10 box-shadow-primary pt-2');
            }
            idsss=$(this).children( '.post-id' ).val();
            id=komeil('#pi',idsss);
            
            ht="<input class='post-id' type='hidden' value='"+id+"' />"+$(this).children('.card').html();
            fh='<li>'+ht+'</li>';
            
            as=$('#pi').val();
            asi=as+','+id;
            $('#pi').val(asi);
            $("#pic_select").html($("#pic_select").html()+fh);
            ul = $('#pic_select'); // your parent ul element
            ul.children().each(function(i,li){ul.prepend(li)})
        });
                                        
        $('#pic_select').on('click','li',function(){
            rmid=$(this).children('.post-id').val();
            ids=$('#pi').val().split(',');
            for(i=1;i<=ids.length;i++){
                if(rmid==ids[i]){
                    
                    ids = jQuery.grep(ids, function(value) {
                        return value != rmid;
                    });
                }
            }
            removeA(ids,rmid);
            ids.remove(rmid);
            $('#pi').val(ids.join(','));
            $(this).remove();
            mhd=rmid.split(':');
            if($('.picture-div').find('input[value="'+mhd[0]+'"]').parent().hasClass('rounded-10 pt-2 box-shadow-primary')){
                $('.picture-div').find('input[value="'+mhd[0]+'"]').parent().removeClass('rounded-10 pt-2 box-shadow-primary');
            }
            if($('.picture-div').find('input[value="'+mhd[0]+'"]').parent().hasClass('rounded-10 box-shadow-primary pt-2')){
                $('.picture-div').find('input[value="'+mhd[0]+'"]').parent().removeClass('rounded-10 box-shadow-primary pt-2');
            }
            if($('.picture-div').find('input[value="'+mhd[0]+'"]').parent().hasClass('rounded-10 box-shadow-danger pt-2')){
                $('.picture-div').find('input[value="'+mhd[0]+'"]').parent().removeClass('box-shadow-danger');
                $('.picture-div').find('input[value="'+mhd[0]+'"]').parent().addClass('box-shadow-primary');
            }
        });


        $('#rola').on('click',function (){
            $('.modal').modal('show');
        });
         $('#addPic').on('click',function (){
            $('.modal').modal('show');
        });
        $("#send").click(function(){
            let pi =$("#pi").val();
            let title = $("#title").val();
            let dis =$("#dis").val();
            let np =$("#np").val();
            let date_out =$("#datepicker1").val();
            let content =$("#content").val();
            let link=$("#link").val();
            let pri=$("#pri").val();
            let send="ok";
            if(pi == '0' || pi ==''){
                $("#picErr").removeClass("d-none");
            }else{
                $("#picErr").addClass("d-none");
            }
            if(title ==''){
                $("#title").css({"border":"1px solid red"});
                $("#titleErr").removeClass("d-none");
            }else{
                $("#title").css({"border":"1px solid green"});
                $("#titleErr").addClass("d-none");
            }
            if(content ==''){
                $("#content").css({"border":"1px solid red"});
                $("#contentErr").removeClass("d-none");
            }else{
                $("#content").css({"border":"1px solid green"});
                $("#contentErr").addClass("d-none");
            }
            if(title == '' || content == '' || pi=='0' || pi==''){
            }else{
                <?php if(!empty($edit)){?>
                let edit = "<?php echo $edit;?>";
                 $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>post/check_edit",
                    data:{title:title, dis:dis, np:np, date_out:date_out, content:content, link:link, pri:pri, send:send,pi:pi,edit:edit},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>post/edit_post/"+id); 
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "پست ویرایش شد",
                                icon: "success",
                                button: "ادامه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>post"); 
                            });
                        }
                        
                    }
                })
                <?php }else{?>
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>post/check_add",
                    data:{title:title, dis:dis, np:np, date_out:date_out, content:content, link:link, pri:pri, send:send,pi:pi},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                     window.location.replace("<?php echo base_url();?>post/add_post"); 
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "پست ایجاد شد",
                                icon: "success",
                                button: "ادامه"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>post"); 
                            });
                        }
                        
                    }
                })
                <?php }?>
            }
        });
    })
</script>
<script>
    $(document).ready(function (){
        $('#upload_form').on('submit',function(e){ 
            e.preventDefault();
            if($('#image_file').val() == ''){  
                if($('#picErr').hasClass('d-none')){
                   $("#picErr").removeClass('d-none'); 
                } 
            }else{  
                $.ajax({  
                    url:"<?php echo base_url(); ?>pic/pic_upload",   
                    method:"POST",  
                    data:new FormData(this),  
                    contentType: false,  
                    cache: false,  
                    processData:false, 
                    async:false,
                    success:function(data){
                        $('.modal').modal('hide');
                        let xa='ok';
                        $('#pictures').html('');
                        $.ajax({
                            url:'<?php echo base_url();?>pic/all_pic',
                            method:'POST',
                            data:{xa:xa},
                            success:function(x){
                                $('#pictures').html(x);
                            }
                        })
                    }  
                });  
            }
        });
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