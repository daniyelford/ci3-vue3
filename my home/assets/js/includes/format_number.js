/**
 * number_format - javascript/jquery equivalent of number_format in php with additional abilities
 *
 * @version 0.0.1
 * @author April Sacil <aprilvsacil@gmail.com>
 * @website https://github.com/aprilsacil/number_format
 * @license MIT
 */
jQuery.fn.extend({number_format:function(t,r,e){return void 0===e&&(e=","),void 0===r&&(r="."),void 0===t&&(t=2),this.each(function(){var n=$(this),o="",i=Math.pow(10,t),a=$.trim(n.html()).split("."),d=a[0];t&&a.length>1&&a[1]&&(a[1]="0."+a[1],o=(o=Math.round(a[1]*i)/i)?o.toString().replace("0.",r):"");for(var h=/(\d+)(\d{3})/;h.test(d);)d=d.replace(h,"$1"+e+"$2");n.html(d+o)})}}),jQuery.extend({number_format:function(t,r,e,n){var o="";void 0===n&&(n=","),void 0===e&&(e="."),void 0===r&&(r=0);var i=Math.pow(10,r),a=(t=t.toString().split("."))[0];r&&t.length>1&&t[1]&&(t[1]="0."+t[1],o=(o=Math.round(t[1]*i)/i)?o.toString().replace("0.",e):"");for(var d=/(\d+)(\d{3})/;d.test(a);)a=a.replace(d,"$1"+n+"$2");return a+o}});