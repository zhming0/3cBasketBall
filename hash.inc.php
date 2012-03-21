<?php
class Hash{
	//This function is damn good!
	private function hs($ar,$n,$m)
	{
		$c=count($ar);
		$p=1;
		$ret=array();
		while($p)
		{
			$p=0;
			for($i=0;$i<$c;$i++)
			{
				$t=$ar[$i];
				if($t==0)
					continue;
				$p=1;
				$ar[$i]=floor($t/$m);
				$ar[$i+1]+=($t%$m)*$n;
			}
			if($p)
			{
				$ret[]=$ar[$c]/$n;
				$ar[$c]=0;
			}
		}
		return array_reverse($ret);
	}
	public function encode($str)
	{
		$c=strlen($str);
		$v='';
		$m=0;
		$A=ord('a')-10;	// That's weird... 10?
		$ar=array();
		for($i=0;$i<$c;$i++)
		{
			$ar[]=ord($str{$i});
		}
		$ar=$this->hs($ar,256,36);
		$str='';
		$c=count($ar);
		for($i=0;$i<$c;$i++)
		{
			$t=$ar[$i];
			$t=($t>10)?chr($A+$t):$t;
			$str.=$t;
		}
		return $str;
	}
	public function decode($str)
	{
		$c=strlen($str);
		$v='';
		$m=0;
		$A=ord('a');
		$ar=array();
		for($i=0;$i<$c;$i++)
		{
			$t=ord($str{$i});
			$t=($t>=$A)?$t-$A+10:$str{$i};
			$ar[]=$t;
		}
		$ar=$this->hs($ar,36,256);
		$str='';
		$c=count($ar);
		for($i=0;$i<$c;$i++)
		{
			$str.=chr($ar[$i]);
		}
		return $str;
	}
}
?>