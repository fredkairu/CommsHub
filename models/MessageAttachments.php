<?php

class MessageAttachments {
	
    public $idcmn_message_attachments;
    public $msg_id;
    public $file_type;
    public $file_size;
    public $file_name;
     public $content;
	
    public function exchangeArray($data) 
    {
        $this->idcmn_message_attachments = (!empty($data['idcmn_message_attachments'])) ? $data['idcmn_message_attachments'] : null;
        $this->msg_id = (!empty($data['msg_id'])) ? $data['msg_id'] : null;
        $this->file_type = (!empty($data['file_type'])) ? $data['file_type'] : null;
        $this->file_size =(!empty($data['file_size'])) ? $data['file_size'] : null;
        $this->file_name =(!empty($data['file_name'])) ? $data['file_name'] : null;
        $this->content	= (!empty($data['content'])) ? $data['content'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
   
}	
