<?php
class Page{
	protected $count;				// 总条数
	protected $countPage;			// 总页数
	protected $currentPage;			// 当前页
	protected $rows;				// 每页显示的条数
	protected $pageUrl;				// 分页URL
	protected $pageStyle;			// 分页的样式
	public function __construct($count=1, $currentPage=1, $rows=1, $pageUrl='', $pageStyle=1){
		$con_count = $this->setNum($count);
		$con_curpage = $this->setNum($currentPage);
		$con_rows = $this->setNum($rows);
		$con_style = $this->setNum($pageStyle);
		$this->count = $con_count<0?0:$con_count;
		$this->currentPage = $con_curpage<1?1:$con_curpage;
		$this->rows = $con_rows<1?1:$con_rows;
		$this->pageStyle = $con_style<1?1:$con_style;
		$this->countPage = ceil($this->count/$this->rows);
		$this->pageUrl = $pageUrl;
	}

	// 校验数字
	private function setNum($num){
		if (!preg_match("/^[0-9]+$/", $num)) {
            $num = 1;
        }
        return $num;
	}

	// 生成分页
	public function showPage(){
		$func = 'createPage' . $this->pageStyle;
		if(function_exists($func)){
			return $this->$func();
		}else{
			return 'The page style not find';
		}
	}

	/**
	 * 共30条记录，当前第1/5页 [首页] [上页] [1] [2] [3] .. [7] [8] [9] [下页] [尾页]
	 */
	private function createPage1(){
		$pagestr = '';
		$pagestr .= '共'.$this->count.'条记录，当前是第'.$this->currentPage.'/'.$this->countPage.'页';
		if($this->currentPage>1){
			$pagestr .= ' [<a href="'.$this->pageUrl.'?page=1'.'">首页</a>] ';
			$pagestr .= ' [<a href="'.$this->pageUrl.'?page='.$this->currentPage-1.'">上页</a>] ';
		}else{
			$pagestr .= ' [<a href="javascript:void(0);">首页</a>] ';
			$pagestr .= ' [<a href="javascript:void(0);">上页</a>] ';
		}

		if($this->countPage>6){

		}else{

		}

		if($this->currentPage<$this->countPage){
			$pagestr .= ' [<a href="'.$this->pageUrl.'?page='.$this->currentPage+1.'">下页</a>] ';
			$pagestr .= ' [<a href="'.$this->pageUrl.'?page='.$this->countPage.'">尾页</a>] ';
		}else{
			$pagestr .= ' [<a href="javascript:void(0);">下页</a>] ';
			$pagestr .= ' [<a href="javascript:void(0);">尾页</a>] ';
		}
	}
}
