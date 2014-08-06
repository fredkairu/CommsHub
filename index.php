<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include_once 'Routes.php';
require_once 'header.php';
include(ABSOLUTEURL.'/controller/BaseFunctions.php' );
//$bf=new BaseFunctions();
//$bf->acceptMessage("Sample email message..",1,"1,2,4,5",3, "Y",3);

$home=Routes::getRoute("home");
$loadmessage=Routes::getRoute("loadmessage");
  
         ?>
</head>
<div id="container" style="border: -moz-use-text-color #E9E8E8; margin-right:auto;margin-left:auto;width:60%">
<div id="commsheader" class="contactheading quicksand largerfont"><a class="notextdecoration blue" href="<?php echo $home;?>"><img src="./img/commshub.png"> Communications Hub</a>

</div>
<!--this  is the portion to be loaded dynamically -->
<table style="width:100%"><tr><td class="greyborderwhiteback" style="width:50%;"><a class="msgtype notextdecoration" id="loademails" href="<?php  ?>"><img id="smsemail" src="./img/folder.png">Emails</a></td><td class="greyborderwhiteback" style="width:50%;"><a class="msgtype notextdecoration" id="loadsms" href="#"><img id="smsimage" src="./img/folder.png">Sms</a></td></tr></table>
<section id="messagecategory">
    
</section>
<select class="blueborderwhiteback">
    <option value="0" selected="true">With Selected:</option>
    <option class="greenfont" value="1">Resend</option>
    <option class="red" value="2">Delete</option>
</select> 
</div>

<script>
    $(document).ready(function () {
        $("#loademails").on("click",function(e){
    e.preventDefault();
$('#messagecategory').load("<?php echo $loadmessage."?msgtype=1" ?>",function(){ //delay loading of data table  //email=1
$('#treport1').dataTable({
      
"iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]

});
}); 
});

$("#loadsms").click(function(e){
    e.preventDefault();
    $("#smsimage").attr("src","./img/openfolder.png");//load open folder icon
     $("#smsemail").attr("src","./img/folder.png");
$('#messagecategory').load("<?php echo $loadmessage."?msgtype=2" ?>",function(){ //delay loading of data table //sms=2
$('#treport1').dataTable({
       
"iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]

});
}); 
});
   $("#loademails").click(function(){
        $("#smsemail").attr("src","./img/openfolder.png"); 
        $("#smsimage").attr("src","./img/folder.png");
                           $(this).css("color","red");
                          
                                   $("#loadsms").css("color","#428BCA");
                       });
   $("#loadsms").click(function(){
                           $(this).css("color","red");
                                             $("#loademails").css("color","#428BCA");
                       });      
  });
  </script>
</body>
</html>

