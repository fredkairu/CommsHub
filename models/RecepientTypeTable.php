<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'RecepientType.php';

class RecepientTypeTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename=" cmn_recepient_types"; //declare table name

//initialise connections and table name
function __construct(){
   $this->db=new ConnectDb();
   $this->connection=$this->db->open_connection();
   $this->db->setTable($this->tablename);
}
   

//return all rows
	public function fetchAll()
	{
            
            return $this->db->fetchAll();
			}
//get by id
	public function getRecepientType($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('crt_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
        //get  id from name
	public function getRecepientIdFromType($type)
	{
          		$row = $this->db->select(array('type' =>$type));
			if (!$row) {
			throw new \Exception("Could not find row $type");
		}
		return $row;
	}
//insert/update a row
	public function saveRecepientType(RecepientType $recepients)
	{
		$data = array('type'  => $recepients->type);
		$id = (int) $recepients->crt_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getRecepients($id)) {
				$this->db->update($data, array('crt_id' =>$id));
			} else {
				throw new \Exception('Recepients id does not exist');
			}
		}
	}
//delete a row
	public function deleteRecepients($id)
	{
		$this->db->delete(array('crt_id' => (int) $id));
	}
}

