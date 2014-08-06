<?php
/******************Author 
 * Fred kairu
 * krufed@gmail.com
 */
include_once 'ConnectDb.php'; //
require_once 'MessageAttachments.php';

class MessageAttachmentsTable extends ConnectDb{
private $db,$connection; //connection fields
public $tablename="cmn_message_attachments"; //declare table name

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
	public function getMessageAttachment($id)
	{
		$id  = (int) $id;
		$row = $this->db->select(array('idcmn_message_attachments' => $id));
			if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
//insert/update a row
	public function saveMessageAttachment(MessageAttachments $message)
	{
		$data = array('msg_id'  => $message->msg_id,'file_type'=> $message->file_type,'file_size'=> $message->file_size,'file_name'=> $message->file_name,'content'=>$message->content);
		$id = (int) $message->idcmn_message_attachments;
		if ($id == 0) {
			$this->db->insert($data);
                        return $this->db->insert_id();
		} else {
			if ($this->getMessageAttachment($id)) {
				$this->db->update($data, array('idcmn_message_attachments' =>$id));
			} else {
				throw new \Exception('Message id does not exist');
			}
		}
	}
//delete a row
	public function deleteAttachment($id)
	{
		$this->db->delete(array('idcmn_message_attachments' => (int) $id));
	}
}

