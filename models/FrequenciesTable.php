<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'FreqHistory.php';

class FrequenciesTable extends ConnectDb{
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
	public function getFrequencies($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('frq_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveFrequencies(Frequencies $frequencies)
	{
		$data = array('description'  => $frequencies->description,'freq_unit'  => $frequencies->freq_unit,'frequency'  => $frequencies->frequency);
		$id = (int) $frequencies->frq_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getFrequencies($id)) {
				$this->db->update($data, array('frq_id' => $id));
			} else {
				throw new \Exception('Frequencies id does not exist');
			}
		}
	}
//delete a row
	public function deleteFrequencies($id)
	{
		$this->db->delete(array('frq_id' => (int) $id));
	}
}

