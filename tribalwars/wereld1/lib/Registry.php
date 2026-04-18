<?php

class Registry {

    static protected $datas = array();

    static public function set($key, &$value) {
	self::$datas[$key] = $value;
    }

    static public function &get($key) {
	return self::$datas[$key];
    }

}

?>
