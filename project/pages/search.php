<?php 
if (!function_exists("change_to_url")){
    function change_to_url($str){
        
    }
}else{}
?>
<style>
    .all-search-result .card-body{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        gap: 30px;
        align-items: center;
    }
    .all-search-result img{
        border-radius:15px;
        width:100px;
        max-height:150px;
    }
    .all-search-result-des {
        max-width: 300px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>
<div class="row my-3">
    <div class="col-sm-12 col-md-12">
	    <div class="card custom-card">
		    <div class="card-body pb-0">
			    <div class="input-group mb-2">
				    <input type="text" class="form-control searchTitle mx-1" placeholder="جستجو کردن نام.....">
					<input type="text" class="form-control searchDes mx-1" placeholder="جستجو کردن توضیحات.....">
				</div>
				<div class="input-group mb-2">
				    <input type="number" class="form-control searchMinPrice mx-1" placeholder="از قیمت.....">
					<input type="number" class="form-control searchMaxPrice mx-1" placeholder="تا قیمت.....">
				</div>
				<div class="input-group mb-2">
				    <a class="btn btn-block btn-success" onclick="totalSearching();">جستجو</a>
				</div>
			</div>
			<div class="card-body pl-0 pr-0 bd-t-0 pt-0">
			    <div class="main-content-body-profile mb-3">
				    <nav class="nav main-nav-line">
					    <a class="nav-link active" onclick="searchTabs(this,'.all-search-result');">همه </a>
						<a class="nav-link" onclick="searchTabs(this,'.all-category-search-result');">دسته بندی ها</a>
						<a class="nav-link" onclick="searchTabs(this,'.all-company-search-result');">کسب و کار ها</a>
						<a class="nav-link" onclick="searchTabs(this,'.all-position-search-result');">خدمات</a>
						<a class="nav-link" onclick="searchTabs(this,'.all-product-search-result');">محصولات</a>
					</nav>
				</div>
				<p class="text-muted mb-0 pr-3">
				    تعداد نتیجه:
					<span id="search-count">
    				    <?= intval(count($category)+count($company)+count($position)+count($product)) ?>
					</span>
				</p>
			</div>
		</div>
		<?php $pro_ids=[];
		foreach($product as $pr){ 
		    $pr=(!empty($pr) && !empty($pr['info'])?$pr['info']:[]);
		    if(!empty($pr) && !empty($pr['id']) && intval($pr['id'])>0 && !in_array(intval($pr['id']),$pro_ids)){
		        $pro_ids[]=intval($pr['id']); ?>
        	    <a href="<?= base_url('product/'.$pr['id']) ?>" class="mb-1 mt-0 card all-search-result custom-card all-product-search-result">
        		    <div class="card-body">
        			    <div class="mb-2" style="min-width: 100px;">
        				    <img src="<?= base_url('assets/svg/product/'.(!empty($pr['icon'])?$pr['icon']:'product.svg')) ?>">
        				</div>
        				<h6 class="tx-13 all-search-result-title">
        				    <?= (!empty($pr['title'])?$pr['title']:(!empty($pr['key'])?$pr['key']:'')) ?>
        				</h6>
        				<p class="mb-0 text-muted all-search-result-des">
        				    <?= (!empty($pr['description'])?$pr['description']:'') ?>
        				</p>
        				<p class="mb-0 text-info all-search-result-price mr-auto ml-3">
        				    <?= (!empty($pr['status']) && intval($pr['status'])>0?(!empty($pr['price'])?number_format($pr['price']).' تومان':'رایگان'):'نا موجود') ?>
        				</p>
        			</div>
        		</a>
		<?php }
		} 
		$pos_ids=[];
		foreach($position as $po){ 
		    $po=(!empty($po) && !empty($po['info'])?$po['info']:[]);
    		if(!empty($po) && !empty($po['id']) && intval($po['id'])>0 && !in_array(intval($po['id']),$pos_ids)){
    		    $pos_ids[]=intval($po['id']); ?>
        	    <a href="<?= base_url('position/'.$po['id']) ?>" class="mb-1 mt-0 card all-search-result custom-card all-position-search-result">
        		    <div class="card-body">
        			    <div class="mb-2" style="min-width: 100px;">
        				    <img src="<?= base_url('assets/svg/position/'.(!empty($po['icon'])?$po['icon']:'position.svg')) ?>">
        				</div>
        				<h6 class="tx-13 all-search-result-title">
        			        <?= (!empty($po['title'])?$po['title']:'') ?>
        				</h6>
        				<p class="mb-0 text-muted all-search-result-des">
        				    <?= (!empty($po['description'])?$po['description']:'') ?>
        				</p>
        				<p class="mb-0 text-info all-search-result-price mr-auto ml-3">
        				    <?= (!empty($po['price'])?number_format($po['price']):'') ?>
        				</p>
        			</div>
        		</a>
    	<?php } 
		}
    	foreach($company as $co){ 
    	    if(!empty($co) && !empty($co['id']) && intval($co['id'])>0 && !empty($co['title'])){ ?>
        	    <a href="<?= base_url('show_company/'.str_replace(' ','--',$co['title'])) ?>" class="mb-1 mt-0 card all-search-result custom-card all-company-search-result">
        		    <div class="card-body">
        			    <div class="mb-2" style="min-width: 100px;">
        				    <img src="<?= base_url('assets/svg/company/'.(!empty($co['icon'])?$co['icon']:'company.svg')) ?>">
        				</div>
        				<h6 class="tx-13 all-search-result-title">
        				    <?= (!empty($co['title'])?$co['title']:'') ?>
        				</h6>
        				<p class="mb-0 text-muted all-search-result-des">
        				    <?= (!empty($co['description'])?$co['description']:'') ?>
        				</p>
        			</div>
        		</a>
		<?php }
		} 
		foreach($category as $ca){ 
		    if(!empty($ca) && !empty($ca['id']) && intval($ca['id'])>0){ ?>
        	    <div class="mb-1 mt-0 card all-search-result custom-card all-category-search-result" onclick="changeCategory(<?= intval($ca['id']) ?>);">
        		    <div class="card-body">
        			    <div class="mb-2" style="min-width: 100px;">
        				    <img src="<?= base_url('assets/svg/category/'.(!empty($ca['icon'])?$ca['icon']:'category.svg')) ?>">
        				</div>
        				<h6 class="tx-13 all-search-result-title">
        				    <?= (!empty($ca['title'])?$ca['title']:'') ?>
        				</h6>
        				<p class="mb-0 text-muted all-search-result-des">
        				    <?= (!empty($ca['description'])?$ca['description']:'') ?>
        				</p>
        			</div>
        		</div>
		<?php } 
		} ?>
	</div>
</div>
<script>
    function totalSearchingHandler($this,t,d,pMin,pMax){
	    if(t==''&&d==''&&pMin==''&&pMax==''){
    	    return true;
    	}else{
            if(t!=='' && !($this.find('.all-search-result-title').text().toLowerCase().indexOf(t) > -1)){
    		    return false;
        	}
            if(d!=='' && !($this.find('.all-search-result-des').text().toLowerCase().indexOf(d) > -1)){
                return false;
            }
            var price=$.trim($this.find('.all-search-result-price').text().replaceAll(',',''));
            if(price!==''){
                price=parseInt(price, 10);
                pMin=parseInt(pMin, 10);
                pMax=parseInt(pMax, 10);
                if(pMin!==''){
                    if(price >= pMin){
                        if(pMax!==''){
                            if(price <= pMax){
                                return true;
                            }else{
                                return false;
                            }
                        }else{
                            return true;
                        }
                    }else{
                        return false;
                    }
                }else{
                    if(pMax!==''){
                        if(price <= pMax){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
            }else{
                if((pMin!=='' || pMax!=='')){
                    return false;
                }
            }
            return true;
        }
	}
	function totalSearching(){
	    let t=$('.searchTitle').val(),d=$('.searchDes').val(),pMin=$('.searchMinPrice').val(),pMax=$('.searchMaxPrice').val(),number=0;
		$('.all-search-result').filter(function () {
		    if(totalSearchingHandler($(this),t,d,pMin,pMax)){
			    $(this).removeClass('d-none');
			    number++;
		    }else{
			    $(this).addClass('d-none');
		    }
		});
		$('#search-count').text(number);
		return true;
	}
	function searchTabs(el,x){
	    $(el).parent().children().removeClass('active');
		$(el).addClass('active');
		$('.all-search-result').addClass('d-none');
		$('#search-count').text($(x).length);
		$(x).removeClass('d-none');
		return true;
	}
</script>



					<!--
                        tblpagination 
                    -->
					<!--<div class="text-center search float-left">-->
					<!--	<ul class="pagination">-->
					<!--		<li class="page-item"><a class="page-link" href="#"><i class="icon ion-ios-arrow-forward"></i></a></li>-->
					<!--		<li class="page-item active"><a class="page-link" href="#">1</a></li>-->
					<!--		<li class="page-item"><a class="page-link" href="#">2</a></li>-->
					<!--		<li class="page-item"><a class="page-link" href="#">3</a></li>-->
					<!--		<li class="page-item"><a class="page-link" href="#"><i class="icon ion-ios-arrow-back"></i></a></li>-->
					<!--	</ul>-->
					<!--</div>-->