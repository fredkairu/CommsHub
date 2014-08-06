<?php

class MsgFrequencies {
	
    public $mfr_id;
    public $frq_id;
    public $msg_id;
    public $last_date;
    public $frequency_cal;
	
    public function exchangeArray($data) 
    {
        $this->mfr_id     		 = (!empty($data['mfr_id'])) ? $data['mfr_id'] : null;
        $this->frq_id  			 = (!empty($data['frq_id'])) ? $data['frq_id'] : null;
        $this->msg_id			 = (!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->last_date 	     = (!empty($data['last_date'])) ? $data['last_date'] : null;
        $this->	frequency_cal	 = (!empty($data['frequency_cal'])) ? $data['frequency_cal'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
   
}	
