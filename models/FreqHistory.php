<?php

class FreqHistory {
	
    public $mfh_id;
    public $frq_id;
    public $msg_id;
    public $wef;
    public $wet;
	//@param array of data fields
    public function exchangeArray($data) 
    {
        $this->mfh_id=(!empty($data['mfh_id'])) ? $data['mfh_id'] : null;
        $this->frq_id=(!empty($data['frq_id'])) ? $data['frq_id'] : null;
        $this->msg_id=(!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->wef=(!empty($data['wef'])) ? $data['wef'] : null;
        $this->wet=(!empty($data['wet'])) ? $data['wet'] : null;
    }
    
    public function getArrayCopy()
    {
    	return  get_object_vars($this);
    }
    

    

}	
