<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
if(!empty($_GET['up'])){
    echo "<script>".($_GET['up'] == 'err'?'swal({title: "خطا",text:"انجام نشد",icon: "error" ,button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user'.DS.'add_con'.DS.intval($id).'")});':
        'swal({title: "موفق",text:"انجام شد",icon: "success" ,button: "متوجه شدم"}).then(function(){window.location.replace("'.base_url().'site_user")});').
        "</script>";
}
if(!empty($_GET['ex']) && $_GET['ex'] == 'err'){
    echo '<script>swal({title: "خطا",text:"این صفحه موجود است",icon: "error" ,button: "متوجه شدم"}).then(function(){window.location.reload()});</script>';
}
?>
<div class='my-5 container fluid' style="min-height:480px;">   
    <div class='row row-sm'>
	    <div class="col-xl-12 my-5">
		    <div class="card" id='ryhaneParsa'>
        		<div class="card-body h-100">
        		    <?= form_open()?>
        				<div class="row row-xs mb-1" style="line-height: 0px;height: 55px;">
        				    <div class="col-md-12">
        				        <?= $t ?>
        				    </div>
        				</div>
        				<div class="row row-xs mt-4 d-none" id="n" style="line-height: 0px;height: 55px;">
        					<div class="col-md-12">
        				        <label>عنوان فایل</label>
        						<?= form_input($n); ?>
        						<br>
        						<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="nameErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        					</div>
        				</div>
        				<div class="row row-xs mt-4 d-none" id="c" style="line-height: 0px;">	
        					<div class="col-md-12 mg-t-10 mg-md-t-0">
        						<label>کد فایل</label>
        						<?= form_textarea($c); ?>
        						<br>
        						<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="contentErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        					</div>
        				</div>
        				<div class="row row-xs mt-4" id='d' style="line-height: 0px;">	
        					<div class="col-md-12 mg-t-10 mg-md-t-0">
        						<label>کد دیتابیس</label>
        						<?= form_textarea($d); ?>
        						<br>
        						<span style="display: block;margin-top: 15px;" class="mt-2 text-center text-danger tx-10 d-none" id="databaseErr">نمیتوانید این فیلد را خالی بگذارید!</span>
        					</div>
        				</div>
        				<div class="row row-xs mt-4" style="line-height: 0px;height: 55px;">
        					<div class="col-md-6 mg-t-10 mg-md-t-0">
        					    <a href="#" id="send" class="btn-block add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-danger" type="button">تغییر سایت</a>
        					</div>
        					<div class="col-md-6 mg-t-10 mg-md-t-0">
        						<a href="<?php echo base_url().'site_user';?>" class="add-to-cart btn btn-block btn-danger-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
        					</div>
        				</div>
        			<?= form_close()?>
        		</div>
			</div>     
		</div>	     
	</div>		     
</div>			 
<script>
    $(document).ready(function(){
        $('#type').on('change',function(){
            if($(this).val() == '0'){
                if($("#d").hasClass('d-none')){
                    $("#d").removeClass('d-none')
                }
                if($('#n').hasClass('d-none')){}else{
                    $('#n').addClass('d-none');
    		    } 
    		    if($('#c').hasClass('d-none')){}else{
    		        $('#c').addClass('d-none');
    		    }
		    }else{
		        if($("#d").hasClass('d-none')){
                }else{
                    $("#d").addClass('d-none')
                }
		        if($('#n').hasClass('d-none')){
    		        $('#n').removeClass('d-none');
    		    } 
    		    if($('#c').hasClass('d-none')){
    		        $('#c').removeClass('d-none');
    		    }
		    }
	    })
    })
	$(document).ready(function(){
		$('#send').click(function(){
		    if($("#database").val() == ''){
		        $('#database').css('border','1px solid red');
		        if($('#databaseErr').hasClass('d-none')){
		            $('#databaseErr').removeClass('d-none');
		        }
		    }else{
		        $('#database').css('border','1px solid green');
		        if($('#databaseErr').hasClass('d-none')){}else{
		            $('#databaseErr').addClass('d-none');
		        }
		    }
		    if($("#type").val() == '0'){
		        if($("#database").val() != ''){
		            let database = $("#database").val();
                    let send='send';
                    let id="<?= intval($id) ?>";
		            $.ajax({
                        method:'post',
                        url:"<?php echo base_url();?>site_user/check_add_con",
                        data:{send:send,id:id,database:database},
                        success:function (values){
                            $("#ryhaneParsa").html($("#ryhaneParsa").html()+values);
                        },error:function(){
                            swal({title: "خطا",text:"انجام نشد",icon: "error" ,button: "متوجه شدم"}).then(function(){window.location.reload()});
                        }
                    })
		        }else{
                    swal({title: "خطا",text: "فیلد خالی می باشد",icon: "error" ,button: "متوجه شدم"}).then(function(){window.location.reload()});
                }
            }else{
                if($('#name').val() == ''){
                    $('#name').css('border','1px solid red');
                    if($('#nameErr').hasClass('d-none')){
                        $('#nameErr').removeClass('d-none');
                    }
                }else{
                    $('#name').css('border','1px solid green');
                    if($('#nameErr').hasClass('d-none')){}else{
                        $('#nameErr').addClass('d-none');
                    }
                }
                if($('#content').val() == ''){
                    $('#content').css('border','1px solid red');
                    if($('#contentErr').hasClass('d-none')){
                        $('#contentErr').removeClass('d-none');
                    }
                }else{
                    $('#content').css('border','1px solid green');
                    if($('#contentErr').hasClass('d-none')){}else{
                        $('#contentErr').addClass('d-none');
                    }
                }
                if($('#name').val() != '' && $('#content').val() != ''){
                    let name =$('#name').val();
            		let content=$('#content').val();
            	    let send='send';
                    let type=$("#type").val();
                    let id="<?= intval($id) ?>";
                    $.ajax({
                        method:'post',
                        url:"<?php echo base_url();?>site_user/check_add_con",
                        data:{send:send,id:id,name:name,content:content,type:type},
                        success:function (values){
                            $("#ryhaneParsa").html($("#ryhaneParsa").html()+values);
                        }
                    })
                }
            }
		})    
    })
</script>	     
			     
			     