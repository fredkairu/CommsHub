<?php 
require_once 'pathconfig.php';
include ABSOLUTEURL.'/controller/BaseFunctions.php';
$messages=new BaseFunctions();
$allmessages=$messages->retreiveAllMessages($_REQUEST['msgtype']);
//?>

<br><br><div id="demo" class="smallerfont"> <table id="treport1" width="100%" class="display dataTable" >
    <thead id="treport1"><tr><th style="padding:10px"><b>S/no</b></th><th style="padding:10px"><b>Message</b></th><th style="padding:10px"><b>Media Type</b></th><th style="padding:10px"><b>Module</b></th><th style="padding:10px"><b>Queued</b></th><th style="padding:10px"><b>Select</b></th></tr>

                                </thead>
                                <tbody>
                            <?php     $count=1;       
                            foreach ($allmessages as $value) {
                                if(strlen($value['message'])>50){
                                    $message=substr($value['message'],0,50).'...';
                                }  else {
                                    $message=$value['message'];
                                }
echo '<tr class="greyrow"><td>'.$count.'</td><td>'.$message.'</td><td>'.$value['media'].'</td><td>'.$value['description'].'</td><td>'.$value['queue_message'].'</td><td><input class="checkmsg" type="checkbox" id="'.$value['msg_id'].'"/></td></tr>';

                  $count++;}?>
                             
                                                   
                                </tbody>
                             
                            </table >
</div>
