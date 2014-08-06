<?php

class Message {
	
    public $msg_id;
    public $mdl_id;
    public $med_id;
    public $message;
    public $queue_message;
	
    public function exchangeArray($data) 
    {
        $this->msg_id     		= (!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->mdl_id  			= (!empty($data['mdl_id'])) ? $data['mdl_id'] : null;
        $this->med_id		    = (!empty($data['med_id'])) ? $data['med_id'] : null;
        $this->message 	       	= (!empty($data['message'])) ? $data['message'] : null;
        $this->queue_message	= (!empty($data['queue_message'])) ? $data['queue_message'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
   
}	
