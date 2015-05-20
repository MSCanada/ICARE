<?php
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/OptionsServices.php";
include_once  $_SERVER['DOCUMENT_ROOT']."/IHRA/HRAservices/questionsservices.php";
include "../template.php";
$qid=$_GET["qid"];;


$cid= $_GET["cid"];
$rate_value=$_GET["rate_value"];
$sid=$_GET["sid"];;
$a=array();

$options=OptionsServices::GetOptionsByQuestion($qid);
$server = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$questions=questionsservices::GetQuestionByQuestionNumber($qid);
$options_string=json_encode($options);


if($rate_value!=0)
header( 'Location:http://'.$server.'/IHRA/en/processquestion.php?cid='.$cid.'&oid='.$rate_value .'&sid='.$sid);
?>
<head>
<script type="text/javascript"
 src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 
<script type="text/javascript">   
var options=<?php echo $options_string ?>;
  $(document).ready(function() {
  var question_text=$('<label>').text("<?php echo $questions->QuestionTextEN ?>");
$('#form1').append(question_text);
$('#form1').append('<br>');
if ((options[0].OptionType)=="Radio Button")
{
	$(options).each(function(index,element){
	var radio_input=$('<input>').attr({type:"radio",name:"radio",value:element.OptionID});
	$('#form1').append(radio_input);
	var label=$('<label>').text(element.OptionTextEN);
	$('#form1').append(label);
	$('#form1').append('<br>');
	})
$('button').click(function(){
	var rate_value=$(':checked').val();
	window.location.href = "/IHRA/en/questions.php?rate_value="+rate_value+"&cid="+<?php echo $cid?>+"&sid="+<?php echo $sid?>;
})

}	 
	    	
else if(options[0].OptionType=="Check Box"){
console.log("checkbox");
$(options).each(function(index,element){
noneoftheabove=index;
var input=$('<input>').attr({type:"checkbox",name:"checkbox",value:element.OptionID,id:index});
$('#form1').append(input);
var label=$('<label>').text(element.OptionTextEN);
$('#form1').append(label);
$('#form1').append('<br>');


})

$(':checkbox').click(function(){
	
	if($('input[type=checkbox]:last-of-type').attr('checked')){
	$('input[type=checkbox]').attr('checked',false);
	$('input[type=checkbox]:last-of-type').attr('checked',true);
}

})

$("button").click(function(){
rate_value1="";
	$(':checked').each(function(){
		if(rate_value1==""){
			rate_value1=$(this).val();
		}
		else
rate_value1=rate_value1+"||"+ $(this).val();
	})
	console.log(rate_value1);
window.location.href = "/IHRA/en/questions.php?rate_value="+rate_value1+"&cid="+<?php echo $cid?>+"&sid="+<?php echo $sid?>;
	
})
	}
    
  });
  
</script>
</head>
<body>
	<div class="container-fluid">

    <div class="row">
<div class="col-sm-6 col-sm-push-3">
	<div class="questions-create">
<form id="form1"></form>
<button class="questions-submit">Click</button>
</div>
</div>
</div>
</div>
</body>

