<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'SentHistory.php';

class SentHistoryTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_msg_sent_history"; //declare table name

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
	public function getSentHistory($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('msh_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveSentHistory(SentHistory $sentHistory)
	{
		$data = array('que_id'  => $sentHistory->que_id,'msg_id'  => $sentHistory->msg_id,'address'  => $sentHistory->address,'date_sent'  => $sentHistory->date_sent);
		$id = (int) $sentHistory->msh_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getSentHistory($id)) {
				$this->db->update($data, array('msh_id' => $id));
			} else {
				throw new \Exception('SentHistory id does not exist');
			}
		}
	}
//delete a row
	public function deleteSentHistory($id)
	{
		$this->db->delete(array('msh_id' => (int) $id));
	}
}

