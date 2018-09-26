<?php
namespace application\admin\controller;
use framework\Countroller;
use application\admin\model\adminModel;
use framework\Page;
header("content-type:text/html;charset=utf-8;");
class adminController extends Countroller{
	private $adminModel;
	function __construct(){
		$this->checkLogin();
	}
	private function checkLogin(){
		if (USER=="admin"&&ACTION=="loginAction") {
			return;
		}
		if (USER=="admin"&&ACTION=="add") {
			return;
		}
		if (USER=="admin"&&ACTION=="checkUser") {
			return;
		}
		session_start();
		if (!isset($_SESSION['admin'])) {
			// $this->loginAction();
			$this->jump('index.php?s=admin/loginAction');
		}
	}
	private function jump($url){
		header("location:$url");
		die;
	}
	function loginAction(){
		if (empty($_POST)) {
			echo "<script>window.location.href='?s=lyb/listAll'</script>";
		}else{
			$this->adminModel = new adminModel();
			$result=$this->adminModel->checkByLogin();
			if ($result) {
				session_start();
				$_SESSION['admin']=$_POST['username'];
			}else{
				echo "false";
			}
		}
	}

	function logoutAction(){
		session_start();
		$_SESSION=null;
		session_destroy();
		$this->jump('index.php?');
	}
	function getDataAll()
	{
		$adminModel=new adminModel();
		$adminModel->getDATA();
	}
	function getByID(){
		$adminModel=new adminModel();
		$adminModel->getByID();
	}
	function listAll(){
		$this->display();
	}
	function add(){
		if (empty($_POST)) {
			$this->display();
		}else{
			$this->adminModel = new adminModel();
			$result=$this->adminModel->adduser();
			if ($result) {
				$this->succeed("index.php?s=admin/loginAction");
			}else{
				$this->failled();
			}
		}
	}
	function reply(){
			$this->adminModel = new adminModel();
			$result = $this->adminModel->replay();
			if ($result) {
				echo "true";
			}
	}
	function delete(){
		$this->adminModel = new adminModel();
		$result=$this->adminModel->delete();
		if ($result) {
			echo "true";
		}
	}
	function checkUser(){
		$this->adminModel=new adminModel();
		return $this->adminModel->checkA();
	}
}