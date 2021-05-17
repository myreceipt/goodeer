/**
 * Version: 1.0
 * Author: JuicyCodes
 * Website: https://juicycodes.com
 */
function jc_confirm(a){return swal({title:"Are you sure?",type:"warning",showCancelButton:!0,confirmButtonColor:"#F44336",confirmButtonText:"Yes!",closeOnConfirm:!1,closeOnCancel:!0},function(){window.open(a.href,""==a.target?"_self":a.target)}),!1}$(document).ready(function(){$("[data-toggle=tooltip]").tooltip(),Waves.attach(".btn-circle",["waves-circle","waves-float","waves-light"]),Waves.attach(".btn",["waves-light","waves-float"]),Waves.attach(".menu_link"),Waves.init(),$(".menu_link.active.collapsed").trigger("click")});