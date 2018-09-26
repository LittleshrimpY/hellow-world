<?php
namespace application\admin\model;
use framework\Page;
use framework\MOD;
	class adminModel extends MOD
	{
		private $data_assign;
		protected function assign($key,$data){
			$this->data_assign["$key"]=$data;
		}
		function checkByLogin(){
			$this->filter(array('username','password'),'trim');
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = 'select `password`,`salt` from `admin` where `username`=:username';
			$data = $this->mod->getByID($sql,array(':username'=>$username));
			if (!$data) {
				return false;
			}
			return md5($password.$data[0]['salt'])==$data[0]['password'];
		}
		function adduser(){
			$this->filter(array('username','password'),'htmlspecialchars');
			$data['username'] = $_POST['username'];
			$data['salt'] = $this->create_password();
			$data['password'] = md5($_POST['password'].$data['salt']);
			$sql = "INSERT INTO admin SET ";
			foreach($data as $key => $value) {
				$sql.="`$key`=:$key,";
			}
			$sql=rtrim($sql,',');
			$flag=true;
			$this->mod->add($sql,$data,$flag);
			return $flag;
		}
		function replay(){
			$this->filter(array('poster','email','ly','hf'),'htmlspecialchars');
			$this->filter(array('ly','hf'),'nl2br');
			$data['poster']= $_POST['poster'];
			$data['comment'] = $_POST['ly'];
			$data['reply']= $_POST['hf'];
			$data['mail']= $_POST['email'];
			$sql="UPDATE `comment` SET ";
			foreach ($data as $key => $value) {
				$sql .= "`$key`=:$key,";
			}
			$sql=rtrim($sql,',');
			$data['id']= $_POST['id'];
			$sql.=" WHERE id=:id;";
			$flag=true;
			$this->mod->reSet($sql,$data,$flag);
			return $flag;
		}
		function delete(){
			$sql="DELETE FROM comment WHERE id=:id";
			$data['id'] = $_GET['id'];
			$flag=true;
			return $this->mod->delete($sql,$data,$flag);
		}
		function getAll($limit='',$order=''){
			$order=empty($_GET['order'])?'id':$_GET['order'];
			$sql="SELECT * FROM comment ORDER BY $order LIMIT $limit";
			return $this->mod->getAll($sql);
		}
		function getUserData(){
			$sql="SELECT * FROM admin";
			return $this->mod->getAll($sql);
		}
		function getByID(){
			$data['id'] = $_GET['id'];
			$sql = "SELECT * FROM comment WHERE id=:id";
			echo json_encode($this->mod->getByID($sql,$data));
		}
		function getFileName(){
			return $this->mod->getFileName("SELECT * FROM comment");
		}
		function getTotalData(){
			$sql="SELECT count(*) AS total FROM comment";
			$data=$this->mod->getAll($sql);
			return $data[0]['total'];
		}
		function checkA(){
			$data = $this->getUserData();
			foreach ($data as $key) {
				if ($_POST['username']==$key['username']) {
					echo "true";
					return;
				}
			}
		}
		function create_password($pw_length=4){
			$randpwd ="";
			for ($i = 0; $i < $pw_length; $i++){
				$randpwd .= chr(mt_rand(33, 126));
			}
			return $randpwd;
		}
		function getDATA(){
			$color=isset($_GET['order'])?$_GET['order']:"id desc";
			$totalData=$this->getTotalData();
			$climit = new Page($totalData,2);
			$pagelist = $climit->AdPageList;
			$data=$this->getAll($climit->Limit);
			$this->assign('totalData',$totalData);
			$this->assign('data',$data);
			$this->assign('pagelist',$pagelist);
			$this->assign("color",$color);
			echo json_encode($this->data_assign);
		}
	}
 ?>