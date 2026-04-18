<?php
class aLang {
	var $section = "";
	var $lang = "";
	var $path = "";
	var $parsed = array();

	function __construct($section, $language, $path = "") {
            $this->path = PATH . "/lang/";
            $this->section = $section;
            $this->lang = $language;
		
            if($path) {
				$this->path = $path;
            }
            return $this->parse();
	}
	
	function parse() {
		$path = $this->path . $this->lang;
		$filename = $path.'.ini';
		$cachedata = $path.'.cachedata';
		$cachearray = $path.'.cachearray';
                
		if (!file_exists($filename)) {
			printf('[Language] Error: Language file %s does not exist! (%s does not exist)', htmlentities($this->lang), htmlentities($filename));
			exit;
		}
                
		$current_size = filesize($filename);
		if (file_exists($cachedata) && file_exists($cachearray)) {
			$cachesize = file_get_contents($cachedata);
			if ($current_size == $cachesize) {
				$decoded = base64_decode(file_get_contents($cachearray));
				$this->parsed = unserialize($decoded);
			}
			else {
				$this->reparse($filename);
			}
		}
		else {
			$this->reparse($filename);
		}
		return true;
	}
	
	function reparse($fname) {
		$path = $this->path . $this->lang;
		$this->parsed = parse_ini_file($fname, true);
		$ini_size = filesize($fname);
                
		if ($fp = @fopen($path.'.cachedata', 'w+')) {
			fwrite($fp, $ini_size);
			fclose($fp);
		}
		if ($fp = @fopen($path.'.cachearray', 'w+')) {
			fwrite($fp, base64_encode(serialize($this->parsed)));
			fclose($fp);
		}
	}
	
	function get($varname) {
	if (!$this->exists($this->section, $varname)) {
		return sprintf('Translation for %s(%s) is not available!', htmlentities($this->section), htmlentities($varname));
		}
		return $this->parsed[$this->section][$varname];
	}
	
	function grab($section, $varname) {
		if (!$this->exists($section, $varname)) {
			return sprintf('Translation for %s[%s] is not available!', htmlentities($section), htmlentities($varname));
		}
		return $this->parsed[$section][$varname];
	}
	
	function exists($section, $varname) {
		return isset($this->parsed[$section][$varname]);
	}
}

?>