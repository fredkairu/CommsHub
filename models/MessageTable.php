<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'Message.php';

class MessageTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_message"; //declare table name

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
	public function getMessage($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('msg_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveMessage(Message $message)
	{
		$data = array('mdl_id'  => $message->mdl_id,'med_id'  => $message->med_id,'message'  => $message->message,'queue_message'  => $message->queue_message);
		$id = (int) $message->msg_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getMessage($id)) {
				$this->db->update($data, array('msg_id' => $id));
			} else {
				throw new \Exception('Message id does not exist');
			}
		}
	}
//delete a row
	public function deleteMessage($id)
	{
		$this->db->delete(array('msg_id' => (int) $id));
	}
}

