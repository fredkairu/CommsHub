<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'Recepients.php';

class RecepientsTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_recepients"; //declare table name

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
	public function getRecepients($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('rcp_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveRecepients(Recepients $recepients)
	{
		$data = array('id_user'  => $recepients->id_user,'msg_id'  => $recepients->msg_id,'crt_id'=>$recepients->crt_id,'non_user_names'  => $recepients->non_user_names,'non_user_address'  => $recepients->non_user_address);
		$id = (int) $recepients->rcp_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getRecepients($id)) {
				$this->db->update($data, array('rcp_id' => $id));
			} else {
				throw new \Exception('Recepients id does not exist');
			}
		}
	}
//delete a row
	public function deleteRecepients($id)
	{
		$this->db->delete(array('rcp_id' => (int) $id));
	}
}

