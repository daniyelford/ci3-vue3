function searchShow(el){
    $(el).parent().find('.search').removeClass('d-none');
    return true;
}
function backToCategoryNav(el){
    $(el).parent().addClass('d-none');
    searchCategory($(el).parent().children('.search-category'),null);
    return true;
}
function searchCategory(el,e=null){
    $('#nav').children('.li').filter(function () {
        $(this).toggle($(this).find('.category-nav-menu').text().toLowerCase().indexOf($(el).val()) > -1)
    });
    $('#category-show').children('.children-category-nav-menu').removeClass('d-none');
    $('#category-show').children('.children-category-nav-menu').filter(function () {
        $(this).toggle($(this).find('.category-show-menu').text().toLowerCase().indexOf($(el).val()) > -1)
    });
    $('#company').find('.company-show').filter(function () {
        $(this).toggle($(this).find('.company-name').text().toLowerCase().indexOf($(el).val()) > -1)
    });
    $('#product').find('.product').removeClass('d-none');
    $('#product').find('.product').filter(function () {
        $(this).toggle($(this).find('.product-name').text().toLowerCase().indexOf($(el).val()) > -1)
    });
    
}
