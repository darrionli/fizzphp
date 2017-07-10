<?php
class Page{
	protected $count;				// 总条数
	protected $countPage;			// 总页数
	protected $currentPage;			// 当前页
	protected $rows;				// 每页显示的条数
	protected $pageUrl;				// 分页URL
	protected $pageShow;			// 总共需要显示的页数
	public function __construct($count=1, $currentPage=1, $rows=1, $pageShow=1, $pageUrl=''){
		$con_count = $this->setNum($count);
		$con_curpage = $this->setNum($currentPage);
		$con_rows = $this->setNum($rows);

		$this->rows = $con_rows<1?1:$con_rows;
		$this->count = $con_count<0?0:$con_count;
		$this->countPage = ceil($this->count/$this->rows);
		if($con_curpage<1){
			$this->currentPage = 1;
		}else{
			if($con_curpage>$this->countPage){
				$this->currentPage = $this->countPage;
			}else{
				$this->currentPage = $con_curpage;
			}
		}
		$this->pageUrl = $pageUrl;
		$this->pageShow = $pageShow;
	}

	// 校验数字
	private function setNum($num){
		if (!preg_match("/^[0-9]+$/", $num)) {
            $num = 1;
        }
        return $num;
	}

	// 填充分页占位符
	private function setPage($page){
		if($page){
			return str_replace('{page}', $page, $this->pageUrl);
		}else{
			return $this->pageUrl;
		}
	}

	// 生成分页
	public function showPage($pageStyle){
		if($pageStyle==1){
			return $this->createPage1();
		}elseif($pageStyle==2){
			return $this->createPage2();
		}
	}

	/**
	 * 共30条记录，当前第1/5页 [首页] [上页] [1] .. [4] [5] [6] [7] [8] .. [15] [下页] [尾页]
	 */
	private function createPage1(){
		$pagestr = '';
		$pagestr .= '共'.$this->count.'条记录，当前是第'.$this->currentPage.'/'.$this->countPage.'页';
		$pagestr .= '<nav aria-label="..."><ul class="pagination">';
		if($this->currentPage>1){
			$pagestr .= '<li><a href="'.$this->setPage(1).'" aria-label="Previous"><span aria-hidden="true">首页</span></a></li>';
			$pagestr .= '<li><a href="'.$this->setPage($this->currentPage-1).'" aria-label="Previous"><span aria-hidden="true">上一页</span></a></li>';
		}else{
			$pagestr .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">首页</span></a></li>';
			$pagestr .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">上一页</span></a></li>';
		}

		if($this->countPage<10){
			for ($i=1; $i <= $this->countPage; $i++) {
				if($i==$this->currentPage){
					$pagestr .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
				}else{
					$pagestr .= '<li><a href="'.$this->setPage($i).'">'.$i.'</a></li>';
				}
			}
		}else{
			$left_step = $right_step = 4; //默认的步长
			$right_need = $this->countPage - ($this->pageShow - 1) + 1;

			if($this->pageShow-1 < $this->currentPage){
				$left_step = $left_step - ($this->currentPage - ($this->currentPage-1));
			}
			if($right_need > $this->currentPage){
				$right_step = $right_step + ($this->currentPage-$right_need);
			}

			$left = 1 + $left_step;
			$right = $this->countPage - $right_step;

			if($this->currentPage<=$left){
				$need = $this->pageShow - 1;
				for ($i=1; $i <= $need; $i++) {
					if($i==$this->currentPage){
						$pagestr .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
					}else{
						$pagestr .= '<li><a href="'.$this->setPage($i).'">'.$i.'</a></li>';
					}
				}
				$pagestr .= '<li class="disabled"><a href="javascript:void(0);">...</a></li>';
				$pagestr .= '<li><a href="'.$this->setPage($this->countPage).'">'.$this->countPage.'</a></li>';
			}

			if($this->currentPage>$left && $this->currentPage<$right){
				$pagestr .= '<li><a href="'.$this->setPage(1).'">1</a></li>';
				$pagestr .= '<li class="disabled"><a href="javascript:void(0);">...</a></li>';
				// 根据需要显示的页数计算中间页
				$submid = ($this->pageShow - 3)/2;
				if(($this->pageShow - 3)%2===0){
					$subleft = $this->currentPage - $submid;
					$subright = $this->currentPage + $submid;
				}else{
					$subleft = $this->currentPage - ceil($submid);
					$subright = $this->currentPage + floor($submid);
				}

				for ($i=$subleft; $i<=$subright; $i++) {
					if($i==$this->currentPage){
						$pagestr .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
					}else{
						$pagestr .= '<li><a href="'.$this->setPage($i).'">'.$i.'</a></li>';
					}
				}
				$pagestr .= '<li class="disabled"><a href="javascript:void(0);">...</a></li>';
				$pagestr .= '<li><a href="'.$this->setPage($this->countPage).'">'.$this->countPage.'</a></li>';
			}

			if($this->currentPage>=$right){
				$pagestr .= '<li><a href="'.$this->setPage(1).'">1</a></li>';
				$pagestr .= '<li class="disabled"><a href="javascript:void(0);">...</a></li>';
				for ($i=$right_need; $i <= $this->countPage; $i++) {
					if($i==$this->currentPage){
						$pagestr .= '<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
					}else{
						$pagestr .= '<li><a href="'.$this->setPage($i).'">'.$i.'</a></li>';
					}
				}
			}
		}

		if($this->currentPage<$this->countPage){
			$pagestr .= '<li><a href="'.$this->setPage($this->currentPage+1).'" aria-label="Next"><span aria-hidden="true">下一页</span></a></li>';
			$pagestr .= '<li><a href="'.$this->setPage($this->countPage).'" aria-label="Next"><span aria-hidden="true">尾页</span></a></li>';
		}else{
			$pagestr .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">下一页</span></a></li>';
			$pagestr .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">尾页</span></a></li>';
		}
		$pagestr .= '</ul></nav>';
		return $pagestr;
	}

	private function createPage2(){

	}
}
