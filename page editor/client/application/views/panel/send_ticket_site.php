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
    	<div class="col-xl-10 mx-auto my-5 col-lg-10">
        	<div class="card">
    						<a class="main-header-arrow" href="#" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
    						<div class="main-content-body">
    								<a style="position: absolute;left: 13px;top: 10px;" class="text-danger pull-left" href="<?= base_url() ?>ticket"><i class="fa fa-times"></i></a>
    							<div class="main-chat-header">
    								<div class="main-img-user"><img alt="resiver picture" src="<?= base_url()?>assets/img/faces/1.png"></div>
    								<div class="main-chat-msg-name">
    									<h6><?= $name ?></h6>
    								</div>
    								<nav class="nav mx-auto" style="height: 45px;">
    								    <?= form_input($data1)?>
    								</nav>
    							</div><!-- main-chat-header -->
    							<div class="main-chat-body" id="ChatBody" style="max-height:400px!important;min-height:160px!important;overflow: auto;">
    								<div class="content-inner" id="tickets">
    								    <?= $c ?>
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
<?php if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){?>
<script>
    $(document).ready(function (){
        $('#send').click(function(){
            if($('#chatContent').val() == ''){
                $('#chatContent').css('border','1px solid red');
            }
            if($("#title").val() == ''){
                $('#title').css('border','1px solid red');
            }
            if($("#title").val() != '' && $('#chatContent').val() != ''){
                let title=$("#title").val();
                let content=$('#chatContent').val();
                let send='ok';
                let id="<?php echo $id?>";
                $.ajax({
                    method:'post',
                    url:"<?php echo base_url();?>ticket/check_send_server",
                    data:{content:content,send:send,title:title,id:id},
                    success:function (values){
                        if(values==0){
                            swal({
                                title: "خطا در اطلاعات",
                                text: "",
                                icon: "error",
                                button: "متوجه شدم"
                            }).then(function(){
                                window.location.replace("<?php echo base_url();?>ticket"); 
                            });
                        }else{
                	        let xa ='asad';
                	        let type='ticket';
                            let usId= values;
                            $.ajax({
                                method:'post',
                                url:'<?php echo $url; ?>err/n_f',
                                data:{send:send,xa:xa,type:type,usId:usId,title:title,content:content},
                                success:function (x){
                                    if(x == 0){
                                        swal({
                                            title: "خطا در اطلاعات",
                                            text: "",
                                            icon: "error",
                                            button: "متوجه شدم"
                                        }).then(function(){
                                            window.location.replace("<?php echo base_url();?>ticket/send_site/"+id); 
                                        });
                                    }else{
                                        let dom="<?php echo $url; ?>";
                                        let ins = x;
                                        $.ajax({
                                            method:'post',
                                            url:"<?php echo base_url();?>ticket/ins",
                                            data:{send:send,ins:ins,content:content,title:title,values:values,dom:dom},
                                            success:function (y){
                                                if(y == 1){
                                                    window.location.replace("<?php echo base_url();?>ticket/send_site/"+id);
                                                }else{
                                                    swal({
                                                        title: "خطا در اطلاعات",
                                                        text: "",
                                                        icon: "error",
                                                        button: "متوجه شدم"
                                                    }).then(function(){
                                                        window.location.replace("<?php echo base_url();?>ticket/send_site/"+id); 
                                                    });
                                                }
                                            }
                                        })
                                    }
                                },errors:function(){
                                    swal({
                                        title: "خطا در اتصال",
                                        text: "اتصال با سرور برقرار نشد",
                                        icon: "error",
                                        button: "متوجه شدم"
                                    }).then(function(){
                                        window.location.replace("<?php echo base_url();?>ticket/send_site/"+id); 
                                    });
                                }
                            });
                        }
                    }
                });
            }
        });
    })
</script>
<?php }else{
    header('Location :'.base_url().'err'.DS.'no_access');
    exit();
}?>