<?php

require_once("config.php");

class MySqliDatabase {

private $connection;
public $last_query;
public $tablename;
private $magic_quotes_active;
private $real_escape_string_exists;

function __construct() {
$this->open_connection();
$this->magic_quotes_active = get_magic_quotes_gpc();
$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
}

public function open_connection() {
$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
if (!$this->connection) {
die("Database connection failed: " . mysqli_connect_error());
} else {
$db_select = mysqli_select_db($this->connection, DB_NAME);
if (!$db_select) {
die("Database selection failed: " . mysqli_error($this->connection));
}
}
}

public function close_connection() {
if (isset($this->connection)) {
@mysqli_close($this->connection);
unset($this->connection);
}
}

//set table to use 
public function setTable($tablename){
$this->tablename=$tablename;
}

public function getTable(){
return $this->tablename;
}


public function query($sql) {
$this->last_query = $sql;
$result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
$this->confirm_query($result);
return $result;
}

public function escape_value($value) {
if ($this->real_escape_string_exists) { // PHP v4.3.0 or higher
// undo any magic quote effects so mysql_real_escape_string can do the work
if ($this->magic_quotes_active) {
$value = stripslashes($value);
}
$value = mysqli_real_escape_string($value);
} else { // before PHP v4.3.0
// if magic quotes aren't already on then add slashes manually
if (!$this->magic_quotes_active) {
$value = addslashes($value);
}
// if magic quotes are active, then the slashes already exist
}
return $value;
}

// "database-neutral" methods
public function fetch_array($result_set) {
$rows = array();
while ($row = mysqli_fetch_array($result_set)) {
array_push($rows, $row);
}
return $rows;
}

public function num_rows($result_set) {
return mysqli_num_rows($result_set);
}

public function insert_id() {
// get the last id inserted over the current db connection
return mysqli_insert_id($this->connection);
}

public function mysql_prep($value) {
$magic_quotes_active = get_magic_quotes_gpc();
$new_enough_php = function_exists("mysql_real_escape_string"); // i.e. PHP >= v4.3.0
if ($new_enough_php) { // PHP v4.3.0 or higher
// undo any magic quote effects so mysql_real_escape_string can do the work
if ($magic_quotes_active) {
$value = stripslashes($value);
}
$value = mysqli_real_escape_string($value);
} else { // before PHP v4.3.0
// if magic quotes aren't already on then add slashes manually
if (!$magic_quotes_active) {
$value = addslashes($value);
}
// if magic quotes are active, then the slashes already exist
}
return $value;
}

public function affected_rows() {
return mysqli_affected_rows($this->connection);
}

private function confirm_query($result) {
if (!$result) {
$output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";
//$output .= "Last SQL query: " . $this->last_query;
die($output);
}
}
//return all records in a table
public function fetchAll(){
$table=$this->getTable();
return $this->fetch_array($this->query("SELECT * FROM {$table}"));
}

/* @param array of fields to select by*/
public function select($array){
if(sizeof($array)>1){die("Cannot query with more than one field!");}
$table=$this->getTable();
foreach ($array as $key => $value) {
$key=$key;$value=$value;
}
if(is_string($value)){ //if arry value is a string
    return $this->fetch_array($this->query("SELECT * FROM {$table} WHERE $key like '$value' LIMIT 1"));
}else{
return $this->fetch_array($this->query("SELECT * FROM {$table} WHERE $key='$value'"));
}
}
//insert data
public function insert($data){
$table=$this->getTable();$values=null;
$arraykeys=array_keys($data);
$keys = implode(",",$arraykeys);
$arrayvalues=array_values($data);
$comma_separated = implode("','",$arrayvalues);
$values= "'".$comma_separated."'";
//$values=substr($values,3);
return $this->query("INSERT INTO {$table} ($keys) VALUES ($values)");
}
//update data
public function update($dataarray,$array){
$updatestring=null;
if(sizeof($array)>1){die("Only one key required for update");} //ensure only one value is passed for id
$table=$this->getTable();
foreach ($dataarray as $key => $value) {
$updatestring=$updatestring.$key."='".$value."',";
}
$updatestring=rtrim($updatestring,","); //remove trailing comma
$key1=array_keys($array);$value1=  array_values($array);
$this->query("UPDATE {$table} SET $updatestring  WHERE $key1[0]='$value1[0]'"); 

}

}

//call db

