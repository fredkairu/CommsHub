<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'Queues.php';

class QueuesTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_queues"; //declare table name

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
	public function getQueues($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('que_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveQueues(Queues $queues)
	{
		$data = array('msg_id'  => $queues->msg_id,'med_id'  => $queues->med_id,'rcp_id'  => $queues->rcp_id,'queued_date'  => $queues->queued_date,'queued_time'  => $queues->queued_time,'expected_send_date'  => $$queues->expected_send_date,'expected_send_time'  => $queues->expected_send_time,'frequency'  => $queues->frequency,'sent_times'  => $queues->sent_times,'sender_address'  => $queues->sender_address,'reciever_address'  => $queues->reciever_address,'status'  => $queues->status);
		$id = (int) $queues->que_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getQueues($id)) {
				$this->db->update($data, array('que_id' => $id));
			} else {
				throw new \Exception('Queues id does not exist');
			}
		}
	}
//delete a row
	public function deleteQueues($id)
	{
		$this->db->delete(array('que_id' => (int) $id));
	}
}

