<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    .picture-div:hover{
	    opacity:0.9;
	}
	.preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 2.5% !important;
    }
</style>     
<div class='mt-5 container fluid' style="min-height:480px;">   
    <div class='row row-sm'>
        <?php if(!empty($data)){
		    foreach($data as $v){
		 ?>
		  <div class="col-xl-12 my-5">
					<div class="card">
						<div class="card-body h-100">
							<div class="row row-sm ">
								<div class=" col-xl-5 col-lg-12 col-md-12">
									  <?php if(!empty($pic)){$num=$numb=2;?>
									<div class="preview-pic tab-content">
									    
									 
									 
									  
									  <?php 
									  $g='<div class="tab-pane active" id="pic-1"><img src="'. base_url().'pic'.DS.$pic['0'].'" alt="تصویر"></div>';
									  for ($capt=1;$capt<=count($pic)-1;$capt++){
									  
									    $g .= '<div class="tab-pane" id="pic-'. $numb.'"><img src="'. base_url().'pic'.DS.$pic[$capt].'" alt="تصویر"></div>';
									    $numb++;
									  }
									  echo $g;
									  ?>
									 
									
									
								
		      
									</div>
									<ul class="preview-thumbnail nav nav-tabs">
									  <?php 
									  $h='<li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="'. base_url().'pic'.DS.$pic['0'].'" alt="تصویر"></a></li>';
									  for ($captal=1;$captal<=count($pic)-1;$captal++){
									  $h .= '<li><a data-target="#pic-'.$num.'" data-toggle="tab"><img src="'. base_url().'pic'.DS.$pic[$captal].'" alt="تصویر"></a></li>';
									 $num++;
									 }
									 echo $h;
									 ?>
									 
									 </ul>
									 <?php }else{?>
									    <div class='alert alert-danger mt-5 rounded-10 pd-x-25 text-center'>
									        هیچ عکسی برای این پست انتخاب نشده
									    </div>
									 <?php }?>
								</div>
								<div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
									<h4 class="product-title mb-1"><?= $v['title']?></h4>
									<p class="text-muted tx-13 mb-1"><?= $v['des']?></p>
									<div class="rating mb-1">
										<div class="stars">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star text-muted"></span>
										</div>
										<span class="review-no"><?= $v['date']?></span>
									</div>
									<?php if(is_null($v["n_p"])){?>
									<h6 class="price">قیمت فعلی: <span class="h3 ml-2"><?= $v["price"]?></span></h6>
									<?php }else{?>
								    <del>	<h6 class="price">قیمت قبلی: <span class="h3 ml-2"><?= $v["price"]?></span></h6></del>	
								    <br>
								    	<h6 class="price">قیمت فعلی: <span class="h3 ml-2"><?= $v["n_p"]?></span></h6>
									<?php }?>
									<p class="product-description"> 
								        <?= $v["content"]?>
								    </p>
									<div class="sizes d-flex">
									    لینک پست: 
									    <a href="<?= $v["link"]?>">
									    <?= $v["link"]?>
									    </a>
									</div>
									<div class="action">
									    <?php if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){?>
									    <input type='hidden' id='post_id' value='<?php echo $v['id'];?>'/>
										<a href="<?php echo base_url().'post'.DS.'edit_post'.DS.$v['id'];?>" class="add-to-cart btn btn-secondary-gradient rounded-10 pd-x-25 box-shadow-danger" type="button">ویرایش</a>
										<?php if($v['status']==1){?>
										<a href="<?php echo base_url().'post'.DS.'disable'.DS.$v['id'];?>" class="add-to-cart btn btn-dark-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">غیر فعال سازی</a>
										<?php }else{?>
										<a href="<?php echo base_url().'post'.DS.'enable'.DS.$v['id'];?>" class="add-to-cart btn btn-success-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">فعال سازی</a>
										<?php }?>
										<a href="#" id="d" class="add-to-cart btn btn-danger-gradient rounded-10 pd-x-25 box-shadow-danger" type="button">حذف</a>
										<a href="<?php echo base_url().'post';?>" class="add-to-cart btn btn-warning-gradient rounded-10 pd-x-25 box-shadow-pink" type="button">انصراف</a>
										<?php }else{ ?>
										
										<a class="btn mx-1" title="خرید محصول" href="#" id="selectPro"><svg width="48px" height="48px" viewBox="0 -2 48 48" xmlns="http://www.w3.org/2000/svg">
  <g id="Group_17" data-name="Group 17" transform="translate(-626 -216)">
    <g id="Group_15" data-name="Group 15">
      <rect id="Rectangle_7" data-name="Rectangle 7" width="4" height="10" transform="translate(646 230)" fill="#7d50f9"/>
      <rect id="Rectangle_8" data-name="Rectangle 8" width="4" height="10" transform="translate(654 230)" fill="#7d50f9"/>
      <path id="Path_16" data-name="Path 16" d="M666,236l-4,4V230h4Z" fill="#7d50f9"/>
    </g>
    <g id="Group_16" data-name="Group 16">
      <path id="Path_17" data-name="Path 17" d="M671,224H641a1,1,0,0,1-1-1v-4a3,3,0,0,0-3-3H626v2h.1a5.007,5.007,0,0,0,3.991,3.908A5,5,0,0,0,635,226h3v14h2V225.816a2.966,2.966,0,0,0,1,.184h30a1,1,0,0,1,1,1v7a5.136,5.136,0,0,1-1.081,2.818l-6.324,7.027A4.189,4.189,0,0,1,662,245H641a3,3,0,0,0-3,3v2.1a5,5,0,1,0,5.9,5.9h8.2a5,5,0,1,0,0-2h-8.2a5.016,5.016,0,0,0-3.9-3.9V248a1,1,0,0,1,1-1h21a6.076,6.076,0,0,0,4.081-1.818l6.324-7.027A7.071,7.071,0,0,0,674,234v-7A3,3,0,0,0,671,224Zm-42.816-6H637a1,1,0,0,1,1,1v1h-7A3,3,0,0,1,628.184,218ZM635,224a3,3,0,0,1-2.816-2H638v2Zm22,28a3,3,0,1,1-3,3A3,3,0,0,1,657,252Zm-15,3a3,3,0,1,1-3-3A3,3,0,0,1,642,255Z" fill="#303033"/>
      <path id="Path_18" data-name="Path 18" d="M657,256.5a1.5,1.5,0,1,0-1.5-1.5A1.5,1.5,0,0,0,657,256.5Zm0-2a.5.5,0,1,1-.5.5A.5.5,0,0,1,657,254.5Z" fill="#303033"/>
      <path id="Path_19" data-name="Path 19" d="M637.5,255a1.5,1.5,0,1,0,1.5-1.5A1.5,1.5,0,0,0,637.5,255Zm2,0a.5.5,0,1,1-.5-.5A.5.5,0,0,1,639.5,255Z" fill="#303033"/>
    </g>
  </g>
</svg></a>
										<a href="<?php echo base_url();?>" class="add-to-cart btn btn-danger-gradient rounded-10 pd-x-45 box-shadow-pink" type="button">انصراف</a>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
				$(document).ready(function (){
				    $('#selectPro').click(function (){
				        let send='s';
				        let id = "<?= intval($v['id']) ?>";
				        $.ajax({
				            url:"<?php echo base_url();?>post/buy",
				            method:"POST",
				            data:{send:send,id:id},
        				    success:function (h){
                                if(h==0){
                                    swal({
                                        title: "عملیات نا موفق",
                                        text: "دسترسی شما به این بخش مجاز نیست",
                                        icon: "error",
                                        button: "متوجه شدم"
                                    }).then(function(){
                                             window.location.replace("<?php echo base_url()?>err/no_access"); 
                                    });
                                }
                                if(h==1){
                                    swal({
                                        title: "عملیات موفق",
                                        text: "پست مورد نظر اضافه شد",
                                        icon: "success",
                                        button: "ادامه"
                                    }).then(function(){
                                        if($('#selectPro').hasClass('disabled')){
                                            
                                        }else{
                                            $("#selectPro").addClass('disabled');
                                        }
                                    });
                                }
                                if(h==2){
                                    swal({
                                        title: "عملیات ناموفق",
                                        text: "پست مورد نظر به سبد اضافه نشد",
                                        icon: "success",
                                        button: "ادامه"
                                    }).then(function(){
                                        window.location.reload();
                                    });
                                }
        				    }
				        })
                                  
				    })
				})
				$(document).ready(function(){
				    $('#d').click(function(){
				        let id=$('#post_id').val();
				        let send='s';
				        $.ajax({
				            url:"<?php echo base_url();?>post/del",
				            method:"POST",
				            data:{send:send,id:id},
        				    success:function (values){
                                if(values==0){
                                    swal({
                                        title: "عملیات نا موفق",
                                        text: "پست مورد نظر پاک نشد",
                                        icon: "error",
                                        button: "متوجه شدم"
                                    }).then(function(){
                                             window.location.replace("<?php echo base_url()?>post/show_post/"+id); 
                                    });
                                }
                                if(values==1){
                                    swal({
                                        title: "عملیات موفق",
                                        text: "پست مورد نظر پاک شد",
                                        icon: "success",
                                        button: "ادامه"
                                    }).then(function(){
                                        window.location.replace("<?php echo base_url()?>post"); 
                                    });
                                }
                            }
				        })
				    });
				})
				</script>
		<?php }}else{
		    header('location:'.base_url().'err'.DS.'not_found');
		 }?>
	</div>
</div>