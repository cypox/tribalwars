<?php

class knight_items {

	var $name = array();
	var $unit = array();
	var $att = array();
	var $deff = array();
	var $special = array();
	var $poly = array();
	
	function addItem($dbname, $name, $unit, $att, $deff, $special) {
		$this->name[$dbname] = $name;
		$this->unit[$dbname] = $unit;
		$this->att[$dbname] = $att;
		$this->deff[$dbname] = $deff;
		$this->special[$dbname] = $special;
	}

	function setPoly($dbname, $poly) {
		$this->poly[$dbname] = $poly;
	}

	function getItem($dbname) {
		$item = array();
		$item['name'] = $this->name[$dbname];
		$item['unit'] = $this->unit[$dbname];
		$item['att'] = $this->att[$dbname];
		$item['deff'] = $this->deff[$dbname];
		$item['special'] = $this->special[$dbname];
		$item['poly'] = $this->poly[$dbname];
		return $item;
	}
	
	function getByUnit($unit) {
		$dbnames = array_flip($this->unit);
		if(isset($dbnames[$unit]))
		{
			$return = $dbnames[$unit];
		}
		else
		{
			$return = null;
		}
		return $return;
	}

	function getAll() {
		$all = array();
		foreach($this->name as $key=>$value)
		{
			$all[$key] = $this->getItem($key);
		}
		return $all;
	}

	function getPoly($dbname) {
		return $this->poly[$dbname];
	}
}
?>