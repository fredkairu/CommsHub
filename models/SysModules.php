<?php

class SysModules {
	
    public $mdl_id;
    public $description;
    public $alias;
    public $show;

    public function exchangeArray($data) 
    {
        $this->mdl_id=(!empty($data['mdl_id'])) ? $data['mdl_id'] : null;
        $this->description =(!empty($data['description'])) ? $data['description'] : null;
        $this->alias=(!empty($data['alias'])) ? $data['alias'] : null;
        $this->show=(!empty($data['show'])) ? $data['show'] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
    
}
        
