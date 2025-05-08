<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    #chatContent{
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        text-align: start;
        line-height: 50px;
    }
    .main-img-user::after {
        display: none !important;
    }
    input::placeholder{
        padding:5px;
    }
    .main-chat-footer {
        flex-shrink: 0 !important;
        display: flex !important;
        align-items: center !important;
        height: 50px !important;
        padding: 0 20px !important;
        border-top: 1px solid #e3e8f7 !important;
        background-color: #fff !important;
        position: relative !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
    }
</style>
<div class="container-fluid my-5">
<div class="row row-sm main-content-app">	
	<div class="col-xl-10 mx-auto col-lg-10 my-5">
    	<div class="card">
						<a class="main-header-arrow" href="#" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
						<div class="main-content-body">
							<div class="main-chat-header">
								<div class="main-img-user"><img alt="resiver picture" src="<?= base_url()?>assets/img/faces/<?= $pic ?>"></div>
								<div class="main-chat-msg-name">
									<h6><?= $name ?></h6>
								</div>
								<a style="position: absolute;left: 25px;" class="text-danger pull-left" href="<?= base_url()?>ticket"><i class='fa fa-times'></i></a>
							</div><!-- main-chat-header -->
							<div class="main-chat-body" id="ChatBody" style="max-height:400px!important;min-height:160px!important">
								<div class="content-inner" id="tickets">
								    <?php echo $c; ?>
								</div>
							</div>
							<div class="main-chat-footer">
                    			<div id="chatBoxHelp" class="form-text text-center" style="height: 100%;margin: 0;width: 95%;">
                    			<?= form_textarea($data) ?>
                    			</div>
                        		<div style="width: 5%;height: 100%;text-align: center;line-height: 50px;">
                        		<a href="#" id="send"><i style="font-size: 20px;color: darkslategrey;" class="fa fa-paper-plane"></i></a>
                        		</div>
							</div>
				        </div>
				    </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function (){
        let res_id="<?php echo $id;?>";
        $('#send').click(function(){
            let content=$('#chatContent').val();
            let send='send';
            if($('#chatContent').val() == ''){
                $('#chatContent').css('border','1px solid red');
            }else{
                
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>ticket/check_send",
                    data:{content:content, res_id:res_id,send:send},
                    success:function (values){
                        if(values == 0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "اطلاعات وارد شده تکراری و یا اشتباه می باشد",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>ticket/send/<?php echo $id;?>"); 
                            });
                        }else{
                            $('#tickets').html(values);
                            $('#chatContent').val('');
                        }
                    }
                });
            }
        });
        $('.del-t').click(function (){
            let id=$(this).children('input').val();
            let send='send'; 
            $('#tickets').html('');
            $.ajax({
                method:'post',
                url:"<?php echo base_url();?>ticket/del",
                data:{send:send,id:id,res_id:res_id},
                success:function (values){
                    alert(values);
                    if(values==0){
                        swal({
                            title: "خطا در اطلاعات",
                            text: "",
                            icon: "error",
                            button: "متوجه شدم"
                        }).then(function(){
                                 window.location.replace("<?php echo base_url();?>ticket/send/<?php echo $id; ?>"); 
                        });
                    }else{
                        
                        $('#tickets').html(values);
                    }
                }
            });
        })
    })
</script>
