// function mapMarkersShowerFunction(geojson){
//     var myCom = JSON.stringify(geojson.company),myPro = JSON.stringify(geojson.product),myPos =JSON.stringify(geojson.position),projson=[],posjson=[],comjson=[];
//     projson = JSON.parse(myPro);
//     posjson = JSON.parse(myPos);
//     comjson = JSON.parse(myCom);
//     for (const [key, value] of Object.entries(comjson)) {
//         value.mark.forEach(function (marker) {
//             var el = document.createElement('div'),icon=marker.icon.url,x='';
//             el.className = 'marker company-marker all-markers company-marker-count-'+marker.count;
//             el.style.backgroundImage ='url("'+icon+'")';
//             el.style.width = marker.icon.iconSize[0] + 'px';
//             el.style.height = marker.icon.iconSize[1] + 'px';
//             if(marker.icon!=''){
//                 x+='<img class="rounded-10 my-1 wd-150" src="'+icon+'">';
//             }
//             if(marker.name!=''){
//                 x+='<h6 class="text-center py-1">'+marker.name+'</h6>';
//             }
//             if(marker.message!=''){
//                 x+=marker.message;
//             }
//             if(marker.companyId!==0 && marker.companyId!=='0'){
//                 x+='<a onclick="visitCompanyProfile('+marker.companyId+');" class="btn btn-block btn-info mt-1">مشاهده کسب وکار</a>';
//             }
//             markers[marker.count]=new maptilersdk.Marker(el).setLngLat(marker.coordinates).setPopup(new maptilersdk.Popup().setHTML(x)).addTo(map);
//         });
//     }
//     for (const [key, value] of Object.entries(posjson)) {
//         value.mark.forEach(function (marker) {
//             var el = document.createElement('div'),icon=marker.icon.url,y='';
//             el.className = 'marker position-marker all-markers position-marker-count-'+marker.count;
//             el.style.backgroundImage ='url('+icon+')';
//             el.style.width = marker.icon.iconSize[0] + 'px';
//             el.style.height = marker.icon.iconSize[1] + 'px';
//             if(marker.icon!=''){
//                 y+='<img class="rounded-10 my-1 wd-150" src="'+icon+'">';
//             }
//             if(marker.name!=''){
//                 y+='<h6 class="text-center py-1">'+marker.name+'</h6>';
//             }
//             if(marker.message!=''){
//                 y+=marker.message;
//             }
//             if(marker.companyId!==0 && marker.companyId!=='0'){
//                 y+='<a onclick="visitCompanyProfile('+marker.companyId+');" class="btn btn-block btn-info mt-1">مشاهده کسب وکار</a>';
//             }
//             if(marker.positionId!==0 && marker.positionId!=='0'){
//                 y+='<a href="'+baseUrl("position/"+marker.positionId)+'" class="btn btn-block btn-success mt-2">مشاهده جایگاه</a>';
//             }
//             markers[marker.count]=new maptilersdk.Marker(el).setLngLat(marker.coordinates).setPopup(new maptilersdk.Popup().setHTML(y)).addTo(map);
//         });
//     }
//     for (const [key, value] of Object.entries(projson)) {
//         value.mark.forEach(function (marker) {
//             var el = document.createElement('div'),icon=marker.icon.url,z='';
//             el.className = 'marker product-marker all-markers product-marker-count-'+marker.count;
//             el.style.backgroundImage ='url("'+icon+'")';
//             el.style.width = marker.icon.iconSize[0] + 'px';
//             el.style.height = marker.icon.iconSize[1] + 'px';
//             if(marker.icon!=''){
//                 z+='<img class="rounded-10 my-1 wd-150" src="'+icon+'">';
//             }
//             if(marker.name!=''){
//                 z+='<h6 class="text-center py-1">'+marker.name+'</h6>';
//             }
//             if(marker.message!=''){
//                 z+=marker.message;
//             }
//             if(marker.companyId!==0 && marker.companyId!=='0'){
//                 z+='<a onclick="visitCompanyProfile('+marker.companyId+');" class="btn btn-block btn-info mt-1">مشاهده کسب وکار</a>';
//             }
//             if(marker.positionId!==0 && marker.positionId!=='0'){
//                 z+='<a href="'+baseUrl("position/"+marker.positionId)+'" class="btn btn-block btn-warning mt-2">مشاهده جایگاه</a>';
//             }
//             if(marker.productId!==0 && marker.productId!=='0'){
//                 z+='<a href="'+baseUrl("product/"+marker.productId)+'" class="btn btn-block btn-success mt-2">مشاهده محصول</a>';
//             }
//             markers[marker.count]=new maptilersdk.Marker(el).setLngLat(marker.coordinates).setPopup(new maptilersdk.Popup().setHTML(z)).addTo(map);
//         });
//     }
// }
function mapMarkersShowerFunction(geojson) {
    const types = ['company', 'position', 'product'];
    const typeClasses = {
        company: 'company-marker',
        position: 'position-marker',
        product: 'product-marker'
    };

    types.forEach(type => {
        let items = geojson[type];
        if (!items) return;

        for (const value of Object.values(items)) {
            value.mark.forEach(marker => {
                if (!marker.coordinates || !marker.icon || !marker.count) return;

                let el = document.createElement('div');
                let icon = marker.icon.url;
                el.className = `marker ${typeClasses[type]} all-markers ${typeClasses[type]}-count-${marker.count}`;
                el.style.backgroundImage = `url("${icon}")`;
                el.style.width = marker.icon.iconSize[0] + 'px';
                el.style.height = marker.icon.iconSize[1] + 'px';

                // ساخت محتوا پاپ‌آپ
                let popupContent = '';
                if (icon) {
                    popupContent += `<img class="rounded-10 my-1 wd-150" src="${icon}">`;
                }
                if (marker.name) {
                    popupContent += `<h6 class="text-center py-1">${marker.name}</h6>`;
                }
                if (marker.message) {
                    popupContent += marker.message;
                }
                if (marker.companyId && marker.companyId !== '0') {
                    popupContent += `<a onclick="visitCompanyProfile(${marker.companyId});" class="btn btn-block btn-info mt-1">مشاهده کسب وکار</a>`;
                }
                if (marker.positionId && marker.positionId !== '0') {
                    popupContent += `<a href="${baseUrl('position/' + marker.positionId)}" class="btn btn-block btn-${type === 'product' ? 'warning' : 'success'} mt-2">مشاهده جایگاه</a>`;
                }
                if (marker.productId && marker.productId !== '0') {
                    popupContent += `<a href="${baseUrl('product/' + marker.productId)}" class="btn btn-block btn-success mt-2">مشاهده محصول</a>`;
                }

                // اضافه کردن به نقشه
                markers[marker.count] = new maptilersdk.Marker(el)
                    .setLngLat(marker.coordinates)
                    .setPopup(new maptilersdk.Popup().setHTML(popupContent))
                    .addTo(map);
            });
        }
    });
}
