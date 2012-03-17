<?php
class Calendar{
	var $w,$y,$m,$d;
	public function Calendar($year=0,$month=0){
		$t=time();
		if($year==0)
			$year=date('Y',$t);
		if($month==0)
			$month=date('m',$t);
		$t=mktime(0,0,0,$month,1,$year);
		$this->w=date('w',$t);
		$p=$t-$this->w*24*3600;
		$this->d=date('d',$p);
		$this->m=$month;
		$this->y=$year;
	}
	public function draw(){
		$ret=array();
		$tmp=array();
		for($i=0;$i<$this->w;$i++)
		{
			$tmp[]=array(($this->d+$i),0);
		}
		$d=1;
		$m=$this->m+1;
		$y=$this->y;
		if($m>12)
		{
			$m=1;
			$y++;
		}
		$t=mktime(0,0,0,$m,1,$y)-24*3600;
		$d=date('d',$t);
		$w=$this->w;
		for($i=1;$i<=$d;$i++)
		{
			if($w==7)
			{
				$w=0;
				$ret[]=$tmp;
				$tmp=array();
			}
			$w++;
			$tmp[]=array($i,1);
		}
		$d=1;
		for(;$w<7;$w++)
		{
			$tmp[]=array($d,0);
			$d++;
		}
		$ret[]=$tmp;
		return $ret;
	}
}
?>