<?php

require_once ABSOLUTEURL . '/models/ConnectDb.php';
include_once(ABSOLUTEURL . '/core/DI.php' );

Class BaseFunctions {

    private $db, $connection; //connection fields
    public $tablename = "cmn_msg_freq_history"; //declare table name
    public $sendfrequency = 5; //every 5 minutes

//initialise connections and table name

    function __construct() {
        $this->db = new ConnectDb();
        $this->connection = $this->db->open_connection();
    }

    public function setTable($tablename) {
        $this->tablename = $tablename;
    }

    public function getTable() {
        return $this->tablename;
    }

    function retreiveAllMessages($type) {
        $mesagetable = $this->getMessageTable();
        $mediatable = $this->getMediaTable();
        $modulestable = $this->getModulesTable();
        $resultset = $this->db->query("SELECT msg_id,description,message,queue_message,$mesagetable.med_id,media from {$mesagetable} JOIN {$mediatable} ON $mesagetable.med_id=$mediatable.med_id JOIN {$modulestable} ON $mesagetable.mdl_id=$modulestable.mdl_id WHERE $mediatable.med_id=$type ");
        $rows = $this->db->fetch_array($resultset);
        return $rows;
    }
    
    private  function getRecepientType(){
        
    }

//retreive messages from modules
//frequency &queued have default values
//recepients in a csv format
    public function acceptMessage($to, $cc, $bcc, $msg, $filesarray, $moduleid, $queued, $med_id = 1, $frequency = 1) {
        $di = DI::getClassInstance("MessageTable"); //return an instance of messages table 
        $message = DI::getClassInstance("Message");
        $message->exchangeArray(array('msg_id' => null, 'mdl_id' => $moduleid, 'med_id' => $med_id, 'message' => $msg, 'queue_message' => $queued));
        $msgid = $di->saveMessage($message); //save message
        if ($to) { $this->saveTo($to,$msgid);} //save To recepients
        if ($cc) { $this->saveCc($cc, $msgid);} //save Cc recepients
        if ($bcc) {$this->saveBCc($bcc, $msgid); } //save Bcc recepients
       if ($filesarray) {$this->saveFiles($filesarray);} //save To files array
    }

    //save files
    public function saveFiles($filesarray) {
        foreach ($filesarray as $file) {
            $this->saveAttachment($file); //save each file
        }
    }

    //save the To recepients of the message
    public function saveTo($to,$msgid) {
           $di = DI::getClassInstance("RecepientTypeTable"); 
        $row=$di->getRecepientIdFromType("to");
        $recepientsarray = explode(",", $to);
        foreach ($recepientsarray as $recepientid) {
            $this->save_recepients($recepientid, $msgid,$row['crt_id']);
        }
    }

    //
    public function saveCc($cc, $msgid) {
       $di = DI::getClassInstance("RecepientTypeTable"); 
        $row=$di->getRecepientIdFromType("cc");
        $recepientsarray = explode(",", $cc);
        foreach ($recepientsarray as $recepientid) {
            $this->save_recepients($recepientid, $msgid,$row['crt_id']);
        }
    }
/*@param:csv separated bcc */
    public function saveBCc($bcc,$msgid) {
      $di = DI::getClassInstance("RecepientTypeTable"); 
        $row=$di->getRecepientIdFromType("Bcc");
        $recepientsarray = explode(",", $bcc);
        foreach ($recepientsarray as $recepientid) {
            $this->save_recepients($recepientid, $msgid,$row['crt_id']);
        }  
    }

//save a message file with its msg id stamp
    public function saveAttachment($file, $msg_id) {
        $di = DI::getClassInstance("MessageAttachmentsTable");
        $msgfreq = DI::getClassInstance("MessageAttachments");
        $msgfreq->exchangeArray(array('msg_id' => $msg_id, 'file_type' => $_FILES["file"]["type"], 'file_size' => $_FILES["file"]["size"], 'file_name' => $_FILES["file"]["name"], 'content' => file_get_contents($_FILES["file"]["tmp_name"])));
        $di->saveMessageAttachment($msgfreq); //save message   
    }

//invoke the sending of mail--might be replaced with the a custom mailer function
    public function send_mail($from, $recepientsarray, $cc, $attachments) {
        
    }

//add message to queue
    public function queueMessage($msg_id, $med_id, $rcp_id, $sender_address) {
        $date = $this->getDateAndTime();
        $queueddate = $date['dateandtime'];
        $queuedtime = $date['time'];
        $expected_send_date = addTime($queueddate, $this->sendfrequency);
        $expected_send_time = date("H:i:s", strtotime($expected_send_date));
        //frequency
        //sent_times
        //status
    }

//save recepients
    public function save_recepients($recepientid,$msgid,$typeid) {
        $di = DI::getClassInstance("RecepientsTable"); //return an instance of messages table 
        $recepients = DI::getClassInstance("Recepients");
        $recepients->exchangeArray(array('rcp_id' => null, 'id_user'=>$recepientid, 'msg_id' => $msgid,'crt_id'=>$typeid,'non_user_names' => null, 'non_user_address' => null));
        $di->saveRecepients($recepients); //save message
    }

//eg send 5 times a day until 30th July
    public function setFrequency($frequency, $msgid, $lastdate, $freqcal) {
        $di = DI::getClassInstance("MsgFrequenciesTable");
        $msgfreq = DI::getClassInstance("MsgFrequencies");
        $msgfreq->exchangeArray(array('frq_id' => $frequency, 'msg_id' => $msgid, 'last_date' => $lastdate, 'frequency_cal' => $freqcal));
        $di->saveFrequencies($msgfreq); //save message   
    }

//insert message details into tables


    /*     * *******date and time********** */
    private function getDateAndTime() {
        $datetime = array();
        //set Default TimeZone 
        date_default_timezone_set('Africa/Nairobi');
        $date = date("Y-m-d");
        $time = date('h:i A');
        $dateandtime = date("Y-m-d H:i:s");
        $datetime['date'] = $date;
        $datetime['time'] = $time;
        $dateandtime['dateandtime'] = $dateandtime;
        return $datetime;
    }

    //add minutes to current time
    private function addTime($date, $minutes) {
        $currentDate = strtotime($date);
        $futureDate = $currentDate + (60 * $minutes);
        $formatDate = date("Y-m-d H:i:s", $futureDate);
        return $formatDate;
    }

    /*******tables***************** */

    private function getMessageTable() {
        return "cmn_message";
    }

    private function getMediaTable() {
        return "cmn_media";
    }


    private function getModulesTable() {
        return "sys_modules";
    }
 /******************************************** */

// used to insert frequence in the freq table
//@param fromdate:datetime ,todate:datetime,interval:day,week,month etc
    function getInterval($fromdate, $todate, $interval) {
        if ($fromdate && $todate) {
            $minuteinterval = ($todate - $fromdate) / $interval;
            return $minuteinterval;
        } else {
            return 0;
        }
    }

//used to calculate the in mins given the duration
    function calcTime() {
        
    }

//used to insert queue
    function insertMsg() {
        
    }

}
