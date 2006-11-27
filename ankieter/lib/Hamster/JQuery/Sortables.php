<?php
class Hamster_JQuery_Sortables{
	private $hash;
	private $arrayName;
	public function setHash($temp) 
	{
		$pos = stripos($temp, '=');
		$pos2 = stripos($temp, '[');
		$this->hash = substr($temp,++$pos);
		$this->arrayName = substr($temp,0,$pos2);
	}
	public function getArrayName()
	{
		return $this->arrayName;
	}
	public function getSortArray()
	{
		return explode("&".$this->arrayName."[]=", $this->hash);
	}
}