<script src="<?= base_url('assets/js/dashbord/function.js') ?>"></script>
<input type="hidden" value="<?= intval($id) ?>" id="user-id">
<div class="modal" id="modaldemo3" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
        	    <h6 class="modal-title">افزودن کسب و کار </h6>
        		<button aria-label="بستن" class="close" data-dismiss="modal" type="button">
        		    <span aria-hidden="true">×</span>
        		</button>
    		</div>
        	<div class="modal-body">
                <div id="add-company-manager" style="overflow-y: auto;overflow-x: hidden;max-height: 410px;">
            	    <label class="mb-0">
            		    عکس کسب و کار خود را اضافه کنید
            		</label>
            	    <div class="w-50 mx-auto">
            	        <?= $this->view('includes/uploader',['url'=>'assets---svg---company','type'=>'image'],true) ?>
        			</div>
        			<form>
            		    <div class="mt-1 mb-2">
            			    <div class="row">
            				    <div class="parsley-input col-md-6" id="fnWrapper">
            					    <label>
            						    عنوان کسب و کار
            							<span class="tx-danger">*</span>
            						</label>
            						<input class="form-control shadow-light rounded-10" id="company-title" placeholder='نام کسب و کار' type="text">
            					</div>
            					<div class="parsley-input col-md-6" id="lnWrapper">
            					    <label>
            						    آدرس سایت(اختیاری)
        							</label>
        							<input dir="ltr" class="form-control shadow-light rounded-10" id="company-url" placeholder='example.com' type="text">
        						</div>
            				</div>
            			</div>
            			<label>
        				    توضیح فعالیت
            				<span class="tx-danger">*</span>
            			</label>
            			<textarea class="form-control shadow-light rounded-10" id="company-description" placeholder="توضیحات کسب و کار" rows="3"></textarea>
            			<p class="mg-b-10 mg-t-10 d-none">
            			    نوع تجارت مورد نظر شما چیست؟
        					<span class="tx-danger">*</span>
        				</p>
            			<div class="row d-none">
            			    <div class="col-4">
            				    <label class="rdiobox">
            					    <input name="type" type="radio" id="one" value="0" checked="">
        							<span>تجارت تک نفره</span>
        						</label>
            				</div>
            				<div class="col-8">
            				    <label class="rdiobox">
            					    <input name="type" id="team" disabled type="radio" value="1">
            						<span>تجارت چند نفره(با خرید پکیج ها می توانید این بخش را باز کنید)
        							</span>
        						</label>
            				</div>
            			</div>
            			<div class="mg-t-20">
            			    <button class="btn btn-success-gradient btn-block pd-x-20" onclick="addCompany(this);" type="button">
            				    ثبت
        					</button>
        				</div>
            		</form>
            	</div>
            </div>
        </div>
    </div>
</div>
