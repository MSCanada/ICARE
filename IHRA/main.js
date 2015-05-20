$(document).ready(function(){

	var link=location.pathname;
console.log(link);
	$('.nav.navbar-nav.navbar-right li a[href="' + link + '"]').parent().siblings().removeClass('active');
	$('.nav.navbar-nav.navbar-right li a[href="' + link + '"]').parent().addClass('active');

// for select profile
$.get("/IHRA/en/SelectUserProfile.php", function(data, status){
var   json_data=JSON.parse(data);
$(json_data).each(function(index,element){
var radio= $('<input>').attr({type:"radio",name:"radio",value:element.UserID});
$('#pos-right').append(radio);
var label=$('<label>').text(element.FirstName);
$('#pos-right').append(label);
$('#pos-right').append('<br>');
     })        	
  }
       );
$('button').click(function(){
	var rate_value=($(':checked').val());
		$.post("/IHRA/en/SelectUserProfile.php",{
                basicuserid: rate_value
                
            }, function(data, status){
            	
        		if(data==true)
        		{
        		window.location.href = "/IHRA/en/MemberProfile.php";
        		
        		}
        	})
})


})