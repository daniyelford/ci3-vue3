</div>
            <?php $date=new JDF();
        	$this->view('footer_includes/left_side.php'); ?>
        </div>
        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
        <div id="result"></div>
        <form id="send"></form>
        <input type="hidden" value="<?= SITE_KEY ?>" id="site-key">
        <?php $this->view('footer_includes/chart');
        $this->view('footer_includes/map');
        if(!empty($id)&&intval($id)>0){
            $this->view('footer_includes/add_company');
        }else{ 
            $this->view('footer_includes/add_user');
            $this->view('footer_includes/login');
        } ?>
        <div class="main-footer ht-70">
			<div class="container-fluid pd-t-0-f ht-50p">
                <span>
        	        <a style="position: absolute;bottom: 11px;left: 76px;" referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=369751&Code=SfGPiPIfCnG5I8TuhfG4UbpKTYngTWXy'><img style="width:50px;height:50px;" referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=369751&Code=SfGPiPIfCnG5I8TuhfG4UbpKTYngTWXy' alt='' style='cursor:pointer' Code='SfGPiPIfCnG5I8TuhfG4UbpKTYngTWXy'></a>
                </span>
                <!--
			    <p class="text-center">
			        قیمت دلار:
    			    <span id="dollar-price">
    			        <i class="spinner-border tx-20-f text-secondary ht-20 wd-20"></i>
    			    </span>
			    </p>
                -->
			</div>
		</div>
    </body>
</html>
<!--live page and dolar price-->
<script type="text/javascript">
    // sendGetMethod(baseUrl('includes/includes/price'),'#dollar-price');
</script>
<!--live page and dolar price-->
<!--map and lang-->
<?php if(!empty($map)){ ?>
    <script src="<?= base_url('assets/js/includes/map.js') ?>"></script>
    <script>
        maptilersdk.config.apiKey = 'kvXmcJTTN5s5LnvpEyP5';
        let map = new maptilersdk.Map({
            container: 'map',
            style: maptilersdk.MapStyle.STREETS,
            center: [<?= (!empty($lon) && $lon !== 'none'?$lon:'0') ?>,<?= (!empty($lat) && $lat !== 'none'?$lat:'0') ?>],
            zoom: 14,
        });
        map.on('load', function () {
            map.addSource('contours', {
                type: 'vector',
                url:`https://api.maptiler.com/tiles/contours/tiles.json`
            });
            map.addLayer({
                'id': 'terrain-data',
                'type': 'line',
                'source': 'contours',
                'source-layer': 'contour',
                'layout': {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                'paint': {
                    'line-color': '#ff69b4',
                    'line-width': 1
                }
            });
        });
        mapMarkersShowerFunction(geojson);
    </script>
<?php }if(!empty($add_map)){ ?>
    <script>
        let nLt='',nLn='';
        map.on('click', function (e) {
            let f=0;
            nLn=e.lngLat.lng,
            nLt=e.lngLat.lat;
            if(typeof(geojson.<?= $add_map ?>[<?= (!empty($add_map_id)?intval($add_map_id):0) ?>])!=='undefined'){
                if(typeof(geojson.<?= $add_map ?>[<?= (!empty($add_map_id)?intval($add_map_id):0) ?>].mark)!=='undefined'){
                    Object.values(geojson.<?= $add_map ?>[<?= (!empty($add_map_id)?intval($add_map_id):0) ?>].mark).forEach(function (marker) {
                        var ln2=marker.coordinates[0],
                        lt2=marker.coordinates[1],lt,ln;
                        lt=nLt-lt2;
                        ln=nLn-ln2;
                        if(Math.abs(ln)<0.00002 || Math.abs(lt)<0.00002) f=1;
                    })
                }
            }
            if(f==1){
                return false;
            }else{
                $('#add-marker-access').removeClass('d-none');
                $('#all-marker-list').addClass('d-none');
                return true;
            }
        });
        function addNewLocation(){
            if($('#add-map-title').val()!==''){
                $('#add-map-title').removeClass('border-danger');
                sendAjax({lat:nLt,lon:nLn,title:$('#add-map-title').val(),id:<?= (!empty($add_map_id)?intval($add_map_id):0) ?>},baseUrl('<?= ($add_map=="company"?'company/company/add_map':($add_map=='position'?'company/position/position/add_map':'company/product/product/add_map')) ?>'),'')
                return true;
            }else{
                $('#add-map-title').addClass('border-danger');
                return not1();
            }
        }
    </script>
    <script src="<?= base_url('assets/js/includes/add_map.js') ?>"></script>
<?php }if(!empty($change_lang)){ ?>
    <!--
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="<?= base_url('assets/js/includes/change_lang.js') ?>"></script>
    <script>
        $(function(){
            googleTranslateElementInit('<?= (!empty($lang)?$lang:"fa") ?>');
        })
    </script>
    -->
<?php } 
if(!empty($js) && is_array($js)){ ?>
<script>
    <?php foreach($js as $a){
        echo $a;
    }?>
</script>
<?php }elseif(!empty($js) && is_string($js)){ ?> 
<script>
    <?= $js ?>
</script>
<?php }
if(!empty($click_action)){ ?>
<script>
    $(function(){<?= $click_action ?>})
</script>
<?php } ?>
<!-- JQuery min js -->
<!--<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>-->
<!-- Bootstrap Bundle js -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Moment js -->
<script src="<?= base_url('assets/plugins/moment/moment.js') ?>"></script>
<!-- index js -->
<script src="<?= base_url('assets/js/index.js') ?>"></script>
<!-- Rating js -->
<script src="<?= base_url('assets/plugins/rating/jquery.rating-stars.js') ?>"></script>
<script src="<?= base_url('assets/plugins/rating/jquery.barrating.js') ?>"></script>
<!--Internal Sparkline js -->
<script src="<?= base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') ?>"></script>
<!-- Custom Scroll bar Js-->
<script src="<?= base_url('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<!-- right-sidebar js -->
<script src="<?= base_url('assets/plugins/sidebar/sidebar-rtl.js') ?>"></script>
<script src="<?= base_url('assets/plugins/sidebar/sidebar-custom.js') ?>"></script>
<!-- Eva-icons js -->
<script src="<?= base_url('assets/js/eva-icons.min.js') ?>"></script>
<!-- Moment js -->
<script src="<?= base_url('assets/plugins/raphael/raphael.min.js')?>"></script> 
<!--Internal  Flot js-->
<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.pie.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.resize.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.flot/jquery.flot.categories.js') ?>"></script>
<script src="<?= base_url('assets/js/dashboard.sampledata.js') ?>"></script>
<script src="<?= base_url('assets/js/chart.flot.sampledata.js') ?>"></script>
<!--Internal Apexchart js-->
<script src="<?= base_url('assets/js/apexcharts.js') ?>"></script> 
<!-- Sticky js -->
<script src="<?= base_url('assets/js/sticky.js') ?>"></script>
<!-- custom js -->
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<!-- Left-menu js-->
<script src="<?= base_url('assets/plugins/side-menu/sidemenu.js') ?>"></script>
<!-- Switcher js -->
<script src="<?= base_url('assets/switcher/js/switcher-rtl.js') ?>"></script>
<!-- notify -->
<script src="<?= base_url('assets/plugins/notify/js/notifIt.js') ?>"></script>
<script src="<?= base_url('assets/plugins/notify/js/notifit-custom.js') ?>"></script>
<!--treeview-->
<script src="<?= base_url('assets/plugins/treeview/treeview.js') ?>"></script>
