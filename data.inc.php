<?php
class Data
{
	private $pref;
	public function Data($pref)
	{
		$this->pref='data/'.$pref.'/';
	}
	public function get($key)
	{
		$f=$this->pref.$key.'.db.php';
		if(!file_exists($f))
			return false;
		$c=file($f);
		unset($c[0]);
		$c=implode('',$c);
		return json_decode($c,true);
	}
	public function set($key,$value)
	{
		if(!file_exists($this->pref))
		{
			mkdir($this->pref);
		}
		$fp=fopen($this->pref.$key.'.db.php','w');
		fwrite($fp,'<?php die();?>'.chr(10).json_encode($value));
		fclose($fp);
	}
	public function exist($key)
	{
		$f=$this->pref.$key.'.db.php';
		return file_exists($f);
	}
	public function find($key)
	{
		if(!file_exists($this->pref))
			return array();
		$dir=scandir($this->pref);
		$l=strlen($key);
		foreach($dir as $k=>$f)
		{
			if($f=='.'||$f=='..')
				unset($dir[$k]);
			else if(substr($f,0,$l)!=$key)
				unset($dir[$k]);
			else{
				$p=strpos($f,'.',$l);
				$dir[$k]=substr($f,$l,$p-$l);
			}
		}
		return $dir;
	}
}
?>