<?php
require_once("D:\\XAMPP\\htdocs\\LYB\\framework\\DBtools.php");
use framework\DBtools;
class ClassName
{
	protected $mod;
	function __construct()
	{
		$this->mod = DBtools::getInstance(['dbname'=>'db_tt']);
	}
	function getUserData(){
			$sql="SELECT * FROM admin";
			return $this->mod->getAll($sql);
	}
	function checkUserAdd(){
		$dataU=$this->getUserData();
		foreach ($dataU as $key) {
			if ($_POST['username']==$key['username']) {
					echo "true";
				}else{
					echo "false";
				}
			}
		}
}
$p=new ClassName();
$p->checkUserAdd();
?>