<?php
namespace application\lyb\controller;
use application\lyb\model\lybModel;
use framework\Countroller;
class lybController extends Countroller{
	private $cshow;
	private $climit;
	function __construct(){
		$this->cshow = new lybModel();
	}
	function getDataAll()
	{
		$this->cshow->getDATA();
	}
	function listAll(){
		$this->display();
	}
	function getFileName(){
		return $this->cshow->getFileName();
	}
	function add(){
		if ($_POST['poster']==null||$_POST['email']==null||$_POST['ly']==null) {
			echo "shibai";
		}else if($_POST['poster']!=null&&$_POST['email']!=null&&$_POST['ly']!=null){
			$result=$this->cshow->add();
			if ($result) {
				echo "true";
			}
		}
	}
}