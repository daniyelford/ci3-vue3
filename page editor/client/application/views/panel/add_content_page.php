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
</style>     
<div class='my-5 container-fluid' style="min-height:480px;">   
    <div class='row row-sm'>
			 <div class="col-xl-12 my-5">
        					<div class="card">
        						     <a href="<?= base_url()?>content" style='float:left;padding:7px;color:red;' title="انصراف"><i class='fa fa-times' aria-hidden='true'></i></a>
        						<div class="card-body h-100">
        							<div class="row row-sm ">
        								<div class=" col-xl-5 col-lg-12 col-md-12" id="picChoose">
        								    <h6 style="margin-bottom:0px;">افزودن عکس به جعبه</h6>
        								    <p id="picErr" class="d-none text-center" style="color:red;">حتما عکسی را انتخاب کنید</p>
        		                            <div class="preview-pic tab-content" id='pictures'>
                                			<div style="height:353px;background-color:white;margin-top: 1px;overflow-y: auto;overflow-x:hidden;">
                                			    <div class="m-2" style="position: absolute;left: 3px;top: -3px;">
                                			        <a id="rola" title="افزودن عکس" style="color:grey;" class="pull-left" href="#">
                                			        <i class="fa fa-plus"></i></a>
                                			    </div>
                                			    <div class="row mt-3 px-2  pt-2 mx-auto text-center" id="bit-pic" style="padding-right: 10px;padding-left:10px;width:100%;">
                                        		<?php 
                                		            if(!empty($pic_info)){
                                		            foreach($pic_info as $p){ ?>
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
									</ul>
										<?php if(!empty($rate)){?>
						<div class='mt-2'>
						    <span>امتیاز متن</span>
						    <br>
						    <select id='rate' class="form-control">
 
    <option value="0">انتخاب کنید</option>
    <option value="5">عالی</option>
      <option value="4">خوب</option>
        <option value="3">متوسط</option>
          <option value="2">بد</option>
        <option value="1">ضعیف</option>
  </optgroup>
</select>
						</div>
						<?php }?>
				                </div>
				                <div class="col-xl-5 col-lg-12 col-md-12 mg-t-10 mg-sm-t-0 mx-auto d-none" id="picSelecting">
        				        <form method="post" id="upload_form" align="center" enctype="multipart/form-data">
        				            <input type="file" class="dropify" id="image_file" name="image_file" data-default-file="<?php echo base_url();?>assets/img/ecommerce/01.jpg" data-height="200">
        				            <input type="submit" name="upload" data-dismiss="modal" id="upload" value="افزودن به گالری" class="btn btn-info-gradient btn-block mt-1" />
        				        </form>
        				    </div>
						        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
        						
        						
        							<?php echo form_open();?>
        							<div class="row row-xs mb-1" style="line-height: 0px;height: 55px;">
        								<div class="col-md-12">
        								    <label>عنوان متن</label>
        									<?= form_input($t); ?>
        									<br>
        									<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="titleErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        								</div>
        								</div>
        								<div class="row row-xs my-2" style="line-height: 0px;">
        								<div class="col-md-12 mg-t-10 mg-md-t-0">
        								    <label>توضیحات مختصر</label>
        									<?= form_textarea($d); ?>
        									<br>
        									<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="contentErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        								</div>
        								</div>
        								<div class="row row-xs my-3" style="line-height: 0px;">
        								<div class="col-md-12 mg-t-10 mg-md-t-0">
        								    <label>توضیحات بیشتر</label>
        									<?= form_textarea($c); ?>
        										<br>
        									<span style="display: block;margin-top: 15px;" class="mt-12 text-center text-danger tx-10 d-none" id="desErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        								
        								</div>
        								</div>
        								
        								<div class="row row-xs my-3" style="line-height: 0px;">
        						        	    <span><a id='more' href="#">تنظیمات بیشتر</a></span>
        								<div id='t_more' class="col-md-12 mg-t-10 mg-md-t-0 d-none">
        								    <label>استایل css</label>
        									<?= form_textarea($s); ?>
        								</div>
        								</div>
        											<div class="row row-xs mb-1" style="line-height: 0px;height: 55px;">
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        								    <a href="#" id="send_content" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button">افزودن</a>
        								</div>
        								<div class="col-md-6 mg-t-10 mg-md-t-0">
        									<a href="#" id="back" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        								</div>
        								</div>
        								<input type="hidden" id="pi" />
        								<script>
        								    $(document).ready(function(){
        								        $("#more").click(function(){
        								            $(this).parent().remove();
        								            if($("#t_more").hasClass('d-none')){$("#t_more").removeClass('d-none');}
        								        })
        								    })
        								</script>
        								
        			<?php  echo form_close();?>
        						
        						
        						
        						
        						
        						
        						    <input type="hidden" id="pi" />
    					        </div>
						    </div>
					    </div>
					</div>
				</div>
			</div>
	    </div>
	</div>
</div>	


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
        let id,ht,fh,as,asi,rmid,i,ids,picidss,r,idsss,liklik,mhd;
        $("#set").click(function (){
            $(this).remove();
            if($('#setting').hasClass('d-none')){
                $('#setting').removeClass('d-none');
            }
            if($('#setting1').hasClass('d-none')){
                $('#setting1').removeClass('d-none');
            }
        });
    })
    $(document).ready(function (){
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
    })
    $(document).ready(function (){
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
    })
    $(document).ready(function (){
        $('#rola').on('click',function (){
            // $('.modal').modal('show');
            if($("#picSelecting").hasClass('d-none')){
               $('#picSelecting').removeClass('d-none'); 
            }
            if($("#picChoose").hasClass('d-none')){
            }else{
               $('#picChoose').addClass('d-none'); 
            }
            
        });
    })
    // $(document).ready(function (){    
    //     $('#addPic').on('click',function (){
    //         $('.modal').modal('show');
    //     });
    // })
    $(document).ready(function (){
        $("#back").click(function () {
            if ($("#newhtml").hasClass('d-none')) {
            } else {
                $("#newhtml").addClass('d-none');
            }
            $("#newhtml").html('');
            if ($("#oldhtml").hasClass('d-none')) {
                $("#oldhtml").removeClass('d-none');
            }
            if($("#hideBtn").hasClass('d-none')){}else{$("#hideBtn").addClass('d-none');}
            if($("#showBtn").hasClass('d-none')){$("#showBtn").removeClass('d-none');}
            $('#content').val('none');
        });
    })
    $(document).ready(function (){
        $("#send_content").click(function(){
            let pi =$("#pi").val();
            let title = $("#title").val();
            let content =$("#content").val();
            let style =$("#style").val();
            let des =$("#des").val();
            let send="send";
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
             if(des ==''){
                $("#des").css({"border":"1px solid red"});
                $("#desErr").removeClass("d-none");
            }else{
                $("#des").css({"border":"1px solid green"});
                $("#desErr").addClass("d-none");
            }
            if(title != '' && content != '' && pi!='0' && pi!='' && des !=''){
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>content/check_add",
                    data:{title:title, des:des, content:content, style:style,send:send,pi:pi},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            });
                        }
                        if(values==1){
                            swal({
                                title: "عملیات موفق",
                                text: "متن ایجاد شد",
                                icon: "success",
                                button: "ادامه"
                            });
                            $.ajax({
                                method:'post',
                                url:"<?php echo base_url();?>page/content_new",
                                data:{send:send,values:values},
                                success:function (x){
                                    $('#contentS').html(x);
                                    if ($("#newhtml").hasClass('d-none')) {
                                    } else {
                                        $("#newhtml").addClass('d-none');
                                    }
                                    $("#newhtml").html('');
                                    if ($("#oldhtml").hasClass('d-none')) {
                                        $("#oldhtml").removeClass('d-none');
                                    }
                                    $('#contentS').val('none');
                                }
                            })
                        }
                    }
                })
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
                        
                        let xa='ok';
                        $('#pictures').html('');
                        $.ajax({
                            url:'<?php echo base_url();?>pic/all_pic',
                            method:'POST',
                            data:{xa:xa},
                            success:function(x){
                                $('#pictures').html(x);
                                if($("#picChoose").hasClass('d-none')){
               $('#picChoose').removeClass('d-none'); 
            }
            if($("#picSelecting").hasClass('d-none')){
            }else{
               $('#picSelecting').addClass('d-none'); 
            }
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