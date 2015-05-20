$(document).ready(function(){

console.log("reached");

$('.navbar-brand img').css({"width":"30px","height":"30px"});
//$('input[type="text"]').addClass('form-control');
$('label').wrap('<div class="form-group"></div>');
$('fieldset legend').remove();
$('.gender').parent().parent().parent().prepend('<span>Gender</span>');
$('.gender').parent().unwrap();
$('.gender').parent().css({"display":"block"});
var activeurl = window.location.pathname;
$('a[href="'+activeurl+'"]').parent('li').addClass('active');
//This is obtained from database table
});