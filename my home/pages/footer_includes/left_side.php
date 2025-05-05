<?php if(!empty($id) && intval($id)>0){ ?>
    <div class="sidebar sidebar-left sidebar-animate">
        <div class="panel panel-primary card mb-0 box-shadow">
            <div class="tab-menu-heading border-0 p-3">
        	    <div class="card-options ml-auto">
        		    <a href="#" class="sidebar-remove">
        			    <img class="wd-25 hd-25" src="<?= base_url('assets/svg/back.svg') ?>" alt="back icon">
        			</a>
        		</div>
        		<div class="card-title mb-0 pt-1 text-center mx-auto">تنظیمات کسب و کار</div>
        		<a class="ripple mx-1 my-0 px-3 py-1 btn-success-gradient rounded-10" data-target="#modaldemo3" data-toggle="modal">
        		    <span style="position: relative;top: -8px;right: -18px;" class="pulse d-none workCreateLogError"></span>
        			ایجاد شغل
        		</a>
        	</div>
        	<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                <div class="tabs-menu">
        		    <ul class="nav panel-tabs">
        				<li>
        				    <a href="<?= base_url('resume') ?>">
        					    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/nav/documents.svg') ?>">
            				    رزومه های من
            				</a>
        				</li>
        				<li>
        				    <a href="<?= base_url('company_manager') ?>">
        					    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/info.svg') ?>">
				                مدیریت کسب و کارها
        					</a>
        				</li>
        			    <li>
        				    <a href="#side1" data-toggle="tab" class="active">
        					    <img class="wd-30 hd-30 pd-1 rounded-10" src="<?= base_url('assets/svg/company/selector.svg') ?>">
        						کسب و کار های من
        					</a>
        				</li>
        			</ul>
        		</div>
        	    <div class="tab-content">
        		    <div class="tab-pane active work-setting-tab" id="side1" style="overflow: auto;max-height: 360px;">
        			    <?php $this->view('footer_includes/left_side_includes/side1'); ?>
        			</div>
        	   </div>
            </div>
        </div>
    </div>
<?php } ?>