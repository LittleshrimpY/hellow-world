<?php
namespace framework;
	class DBtools
	{
		private $conf =array('db'=>'mysql','host'=>'localhost','port'=>3306,'dbname'=>'','passwd'=>'','user'=>'root','charset'=>'utf8');
		private $pdo;
		private static $instance;
		function __construct($params=array())
		{
			$this->conf = array_merge($this->conf,$params);
			$this->pdo = new \PDO("{$this->conf['db']}:host={$this->conf['host']};dbname={$this->conf['dbname']};port={$this->conf['port']};charset={$this->conf['charset']}","{$this->conf['user']}","{$this->conf['passwd']}");
		}

		public static function getInstance($params=array()){
			if (!self::$instance instanceof sefl) {
				self::$instance = new self($params);
			}
			return self::$instance;
		}
		private function __clone(){
			echo 'Clone can not Called!';
		}

		private function execute($sql,$data,&$flag=true)
		{
			$stmt = $this->pdo->prepare($sql);
			$flag = $stmt->execute($data);
			return $stmt;
		}

		function getAll($sql,$data=array()){
			return $this->execute($sql,$data)->fetchAll(\PDO::FETCH_ASSOC);
		}

		function getByID($sql,$data=array()){
			return $this->execute($sql,$data)->fetchAll(\PDO::FETCH_ASSOC);
		}

		function add($sql,$data=array(),&$flag){
			return $this->execute($sql,$data);
		}

		function reSet($sql,$data=array(),&$flag){
			return $this->execute($sql,$data);
		}

		function delete($sql,$data=array(),&$flag){
			return $this->execute($sql,$data);
		}
		function getFileName($sql){
			$sql = $this->pdo->query($sql);
			$array = array();
			for ($i=0; $i <$sql->columnCount(); $i++) {
				array_push($array,$sql->getColumnMeta($i)['name']);
			}
			return $array;
		}
	}
 ?>