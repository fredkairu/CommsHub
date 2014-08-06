<?php
class Queues {
	
    public $que_id;
    public $msg_id;
    public $med_id;
    public $rcp_id;
    public $queued_date;
    public $queued_time;
    public $expected_send_date;
    public $expected_send_time;
    public $frequency;
    public $sent_times;
    public $sender_address;
    public $reciever_address;
    public $status;
	
    public function exchangeArray($data) 
    {
        $this->que_id     		     = (!empty($data['que_id'])) ? $data['que_id'] : null;
        $this->msg_id  				 = (!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->med_id				 = (!empty($data['med_id'])) ? $data['med_id'] : null;
        $this->rcp_id 	       		 = (!empty($data['rcp_id'])) ? $data['rcp_id'] : null;
        $this->queued_date			 = (!empty($data['queue_message'])) ? $data['queue_message'] : null;
        $this->expected_send_date	 = (!empty($data['expected_send_date'])) ? $data['expected_send_date'] : null;
        $this->expected_send_time	 = (!empty($data['expected_send_time'])) ? $data['expected_send_time'] : null;
        $this->frequency	         = (!empty($data['frequency'])) ? $data['frequency'] : null;
        $this->sent_times	         = (!empty($data['sent_times'])) ? $data['sent_times'] : null;
        $this->sender_address	     = (!empty($data['sender_address'])) ? $data['sender_address'] : null;
        $this->reciever_address	     = (!empty($data['reciever_address'])) ? $data['reciever_address'] : null;
        $this->status	     		 = (!empty($data['status'])) ? $data['status'] : null;
        
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
   
}	
