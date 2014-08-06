<?php
class Recepients {
	
    public $rcp_id;
    public $id_user;
    public $msg_id;
    public $crt_id;
    public $non_user_names;
    public $non_user_address;

    public function exchangeArray($data) 
    {
        $this->rcp_id     		  = (!empty($data['rcp_id'])) ? $data['rcp_id'] : null;
        $this->id_user 			  = (!empty($data['id_user'])) ? $data['id_user'] : null;
        $this->msg_id			  = (!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->crt_id			  = (!empty($data['crt_id'])) ? $data['crt_id'] : null;
        $this->non_user_names	  = (!empty($data['non_user_names'])) ? $data['non_user_names'] : null;
        $this->non_user_address	  = (!empty($data['non_user_address'])) ? $data['non_user_address'] : null;
        
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
        
   
}	
