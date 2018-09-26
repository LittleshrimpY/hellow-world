<?php
namespace application\lyb\model;
use framework\MOD;
use framework\Page;
	class lybModel extends MOD
	{
		private $data_assign;
		protected function assign($key,$data){
			$this->data_assign["$key"]=$data;
		}
		function getAll($limit='',$order=''){
			$order=empty($_GET['order'])?'id':$_GET['order'];
			$sql="SELECT * FROM comment ORDER BY $order LIMIT $limit";
			return $this->mod->getAll($sql);
		}
		function getByID(){
			$data['id'] = $_GET['id'];
			$sql = "SELECT * FROM comment WHERE id=:id";
			return $this->mod->getByID($sql,$data);
		}
		function getFileName(){
			return $this->mod->getFileName("SELECT * FROM comment");
		}
		function add(){
			$this->filter(array('poster','email','ly'),'htmlspecialchars');
			$this->filter(array('ly'),'nl2br');
			$data['poster']= $_POST['poster'];
			$data['mail']= $_POST['email'];
			$data['comment'] = $_POST['ly'];
			$data['ip'] = $_SERVER["REMOTE_ADDR"];
			date_default_timezone_set('Asia/Shanghai');
			$data['date'] =date("Y-m-d H:i:s");
			$sql="INSERT INTO `comment` SET ";
			foreach ($data as $key => $value) {
				$sql .= "`$key`=:$key,";
			}
			$sql=rtrim($sql,',');
			$flag=true;
			$this->mod->add($sql,$data,$flag);
			return $flag;
		}
		function getTotalData(){
			$sql="SELECT count(*) AS total FROM comment";
			$data=$this->mod->getAll($sql);
			return $data[0]['total'];
		}
		function getDATA(){
			$color=isset($_GET['order'])?$_GET['order']:"id desc";
			$totalData=$this->getTotalData();
			$climit = new Page($totalData,2);
			$pagelist = $climit->PageList;
			$data=$this->getAll($climit->Limit);
			$this->assign("totalData",$totalData);
			$this->assign("pagelist",$pagelist);
			$this->assign("data",$data);
			$this->assign("color",$color);
			echo json_encode($this->data_assign);
		}
	}
 ?>