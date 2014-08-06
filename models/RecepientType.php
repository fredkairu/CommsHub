<?php
class RecepientType {
	
    public $crt_id;
    public $type;
      public function exchangeArray($data) 
    {
        $this->crt_id    		  = (!empty($data['crt_id'])) ? $data['crt_id'] : null;
        $this->type 			  = (!empty($data['type'])) ? $data['type'] : null;
                
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
        
   
}	
