<?php
include 'header.php';
Class Routes {
public $routes;
public $routename;
public $path;

//get requested route from instantiation
public function getPath(){
    return $this->path;
}

public static function getRoute($routename){

  switch ($routename) {
case 'home':$path=WEBROOT."/index.php";
break;
case 'loadmessage':$path=WEBROOT."/loadmessage.php";
break;
default:
die("Error:".$routename." is not a valid route\n");
break;
}  
return $path;
}

}
