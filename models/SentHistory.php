<?php

class SentHistory {
	
    public $msh_id;
    public $que_id;
    public $msg_id;
    public $address;
    public $date_sent;
    public $sent;
	
    public function exchangeArray($data) 
    {
        $this->msh_id     	= (!empty($data['msh_id'])) ? $data['msh_id'] : null;
        $this->que_id  		= (!empty($data['que_id'])) ? $data['que_id'] : null;
        $this->msg_id		= (!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->address 	    = (!empty($data['address'])) ? $data['address'] : null;
        $this->date_sent	= (!empty($data['date_sent'])) ? $data['date_sent'] : null;
        $this->	sent		= (!empty($data['sent'])) ? $data['sent'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
}	
