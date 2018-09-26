<?php
namespace framework;
	class Page
	{
		public $Total;
		public $Page;
		public $PageSize;
		public $TotalPage;
		public $Limit;
		public $PageList;
		function __construct($total,$pagesize)
		{
			$this->Total = $total;
			$this->PageSize = $pagesize;
			$this->TotalPage = $this->getTotalPage();
			$this->Page  = $this->getPage();
			$this->Limit = $this->getLimit();
			$this->PageList = $this->getPageList();
			$this->AdPageList = $this->AdmingetPageList();
		}

		private function getPage(){
			if (empty($_GET['page'])) {
				return 1;
			}
			if ($_GET['page']<=0) {
				return 1;
			}
			if ($_GET['page']>$this->TotalPage) {
				return $this->TotalPage;
			}
			return $_GET['page'];
		}

		private function getTotalPage(){
			return ceil($this->Total/$this->PageSize);
		}

		private function getLimit(){
			$startList = ($this->Page-1)*$this->PageSize;
			return "$startList,$this->PageSize";
		}

		private function getUrl(){
			$url = $_GET;
			unset($url['page']);
			$OrdQuary=http_build_query($url);
			return $OrdQuary ? "?$OrdQuary&":"?";
		}
		private function getPageList(){
			$pagelist = "";
			$totalPage=$this->TotalPage;
			if (empty($orders)) {
				$orders="id desc";
			}else{
				$orders=$_GET['order'];
			}
			if ($this->TotalPage<=1) {
				return '';
			}
			if ($this->Page>4) {
				$pagelist="<a onclick='getDataAll(1,\"$orders\")' style='cursor:pointer;'>1</a>...";
			}
			$i=$this->Page-3;
			if ($this->Page==5) {
				$i=3;
			}
			$len=$this->Page+3;
			if ($this->Page==4) {
				$len-=1;
			}
			for ($i,$len; $i<=$len&&$i<=$this->TotalPage; $i++) {
				if ($i>0) {
					if ($i==$this->Page) {
						$pagelist.="<a onclick='getDataAll($i,\"$orders\")' style='cursor:pointer;' class=\"curr\">$i</a>";
					}else{
						$pagelist.="<a onclick='getDataAll($i,\"$orders\")' style='cursor:pointer;'>$i</a>";
					}
				}
			}
			if ($this->Page+3<$this->TotalPage) {
					$pagelist.="...<a onclick='getDataAll($totalPage,\"$orders\")' style='cursor:pointer;'>$totalPage</a>";
			}
			return $pagelist;
		}
		private function AdmingetPageList(){
			$pagelist = "";
			$totalPage=$this->TotalPage;
			if (empty($orders)) {
				$orders="id desc";
			}else{
				$orders=$_GET['order'];
			}
			if ($this->TotalPage<=1) {
				return '';
			}
			if ($this->Page>4) {
				$pagelist="<a onclick='admingetDataAll(1,\"$orders\")' style='cursor:pointer;'>1</a>...";
			}
			$i=$this->Page-3;
			if ($this->Page==5) {
				$i=3;
			}
			$len=$this->Page+3;
			if ($this->Page==4) {
				$len-=1;
			}
			for ($i,$len; $i<=$len&&$i<=$this->TotalPage; $i++) {
				if ($i>0) {
					if ($i==$this->Page) {
						$pagelist.="<a onclick='admingetDataAll($i,\"$orders\")' style='cursor:pointer;' class=\"curr\">$i</a>";
					}else{
						$pagelist.="<a onclick='admingetDataAll($i,\"$orders\")' style='cursor:pointer;'>$i</a>";
					}
				}
			}
			if ($this->Page+3<$this->TotalPage) {
					$pagelist.="...<a onclick='admingetDataAll($totalPage,\"$orders\")' style='cursor:pointer;'>$totalPage</a>";
			}
			return $pagelist;
		}
	}
 ?>