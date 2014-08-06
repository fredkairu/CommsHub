<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'SysModules.php';

class SysModulesTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="sys_modules"; //declare table name

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
	public function getSysModules($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('mdl_id' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveSysModules(SysModules $sysModules)
	{
		$data = array('description'  => $sysModules->description,'alias'  => $sysModules->alias,'show'  => $sysModules->show);
		$id = (int) $sysModules->mdl_id;
		if ($id == 0) {
			$this->db->insert($data);
		} else {
			if ($this->getSysModules($id)) {
				$this->db->update($data, array('mdl_id' => $id));
			} else {
				throw new \Exception('SysModules id does not exist');
			}
		}
	}
//delete a row
	public function deleteSysModules($id)
	{
		$this->db->delete(array('mdl_id' => (int) $id));
	}
}

