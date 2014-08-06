<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'MsgFrequencies.php';

class MsgFrequenciesTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_msg_frequencies"; //declare table name

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
	public function getMsgFrequencies($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('mfr_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveMsgFrequencies(MsgFrequencies $msfFrequencies)
	{
		$data = array('frq_id'=>$msfFrequencies->frq_id,'msg_id'  => $msfFrequencies->msg_id,'last_date'  => $msfFrequencies->last_date,'frequency_cal'  => $msfFrequencies->frequency_cal);
		$id = (int) $$msfFrequencies->mfr_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getMsgFrequencies($id)) {
				$this->db->update($data, array('mfr_id' => $id));
			} else {
				throw new \Exception('MsgFrequenciesTable id does not exist');
			}
		}
	}
//delete a row
	public function deleteMsgFrequencies($id)
	{
		$this->db->delete(array('mfr_id' => (int) $id));
	}
}

