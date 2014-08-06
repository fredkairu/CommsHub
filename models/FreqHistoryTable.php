<?php
/******************Author 
* Fred kairu
* krufed@gmail.com
*/
include_once 'ConnectDb.php'; //
require_once 'FreqHistory.php';

class FreqHistoryTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_msg_freq_history"; //declare table name

//initialise connections and table name
function __construct() {
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
public function getFreqHistory($id)
{
$id  = (int) $id;
$row = $this->db->select(array('mfh_id' => $id));
if (!$row) {
throw new \Exception("Could not find row $id");
}
return $row;
}
//insert/update a row
public function saveFreqHistory(FreqHistory $reqhistory)
{
$data = array('frq_id'  => $reqhistory->frq_id,'msg_id'  => $reqhistory->msg_id,'wef'  => $reqhistory->wef,'wet'  => $reqhistory->wet);
$id = (int) $reqhistory->mfh_id;
if ($id == 0) {
$this->db->insert($data);
} else {
if ($this->getFreqHistory($id)) {
    $this->db->update($data, array('mfh_id' => $id));
} else {
    throw new \Exception('FreqHistory id does not exist');
}
}
}
//delete a row
public function deleteFreqHistory($id)
{
$this->db->delete(array('mfh_id' => (int) $id));
}
}

