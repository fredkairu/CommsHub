<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'FreqHistory.php';

class MediaTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_media"; //declare table name

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
	public function getMedia($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('med_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveMedia(Media $media)
	{
		$data = array('media'  => $media->media);
		$id = (int) $media->med_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getMedia($id)) {
				$this->db->update($data, array('med_id' => $id));
			} else {
				throw new \Exception('Media id does not exist');
			}
		}
	}
//delete a row
	public function deleteMedia($id)
	{
		$this->db->delete(array('med_id' => (int) $id));
	}
}

