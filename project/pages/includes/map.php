<?php if((!empty($p_id) && intval($p_id)>0)||(!empty($id) && intval($id)>0)){
    if(!empty($lat_lon) && is_array($lat_lon)){
        $x=[]; ?>
        <script>
            var newMarkers=[],markers=[];
            geojson.<?= (!empty($position) && $position?'position':(!empty($company) && $company?'company':'product')) ?>[<?= intval($p_id) ?>] = {
                'mark': [
                    <?php for($a=0;$a<=count($lat_lon)-1;$a++){
                        if(!empty($lat_lon[$a])&&!empty($lat_lon[$a]['lat']) && !empty($lat_lon[$a]['lon'])){
                            $z="company-id:".(!empty($lat_lon[$a]['company_id'])?$lat_lon[$a]['company_id']:0).",position-id:".(!empty($lat_lon[$a]['position_id'])?$lat_lon[$a]['position_id']:0).",product-id:".(!empty($lat_lon[$a]['product_id'])?$lat_lon[$a]['product_id']:0).",title:".(!empty($lat_lon[$a]['title'])?$lat_lon[$a]['title']:0).",d:".(!empty($lat_lon[$a]['d'])?$lat_lon[$a]['d'].'km':0);
                            if(!in_array($z,$x)){
                                $x[]=$z;
                                echo "{
                                    'count':++markerNumber,
                                    'icon': {
                                        'url':'".(!empty($icon)?$icon:'')."',
                                        'iconSize': [60, 60]
                                    },
                                    'categoryId':'".(!empty($lat_lon[$a]['category_id'])?$lat_lon[$a]['category_id']:(!empty($category_id) && intval($category_id) > 0?intval($category_id):0))."',
                                    'companyId':'".(!empty($lat_lon[$a]['company_id'])?$lat_lon[$a]['company_id']:0)."',
                                    'positionId':'".(!empty($lat_lon[$a]['position_id'])?$lat_lon[$a]['position_id']:0)."',
                                    'productId':'".(!empty($lat_lon[$a]['product_id'])?$lat_lon[$a]['product_id']:0)."',
                                    'name':'".(!empty($lat_lon[$a]['name'])?$lat_lon[$a]['name']:"")."',
                                    'option':'".(!empty($role) && is_string($role) && $role=='manager'?'<a class="marker-remove-style" onclick="delMarker(this,'.intval($lat_lon[$a]['id']).');"><input class="type" type="hidden" value="'.($lat_lon[$a]['type']?$lat_lon[$a]['type']:'').'"><i class="fa fa-trash tx-20-f text-danger"></i></a>':'')."',
                                    'message': '".(!empty($lat_lon[$a]['d'])?$lat_lon[$a]['d']:(!empty($lat_lon[$a]['title'])?$lat_lon[$a]['title']:''))."',
                                    'coordinates': [".$lat_lon[$a]['lon'].", ".$lat_lon[$a]['lat']."],
                                },";
                            }
                        }
                    }?>
                ]
            };
    </script>
<?php }
} ?>

