<?php

class media {
	
    public $med_id;
    public $media;
  
    public function exchangeArray($data) 
    {
        $this->med_id=(!empty($data['med_id'])) ? $data['med_id'] : null;
        $this->media=(!empty($data['media'])) ? $data['description'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
   
}	
