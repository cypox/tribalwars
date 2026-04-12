<?php
ignore_user_abort();
class DB_MySQL{
    var $connection;
    var $queries;
    var $ms_querys;

	function connect($host="",$user="",$pass="",$db=""){
		$this->connection = @mysqli_connect($host, $user, $pass, $db);
		if(!$this->connection){
			printf("Não foi possível estabelecer uma conexão com o servidor MySQL.<br />Erro: %s", htmlentities(mysqli_connect_error()));
			exit;
		}
		return true;
	}
	function disconnect(){
		if($this->connection){
			$close = @mysqli_close($this->connection);
		} else {
			$close = false;
		}
		$this->connection = NULL;
		$this->queries = 0;
		return $close;
	}
	function query($query,$show_error=true){
		if(!defined('FILTER_LOCKTABLES') || FILTER_LOCKTABLES){
			$pos = strpos(strtoupper($query), 'LOCK TABLES');
			if($pos !== FALSE && $pos < 3){
				return NULL;
			}
		}
		if($show_error){
			$result = @mysqli_query($this->connection, $query);
			if(!$result){
				printf('Consulta SQL: %s<br />Erro: %s', htmlentities($query), htmlentities(mysqli_error($this->connection)));
				exit;
			}
		}
		return $result;
	}
	function unb_query($query,$show_error=true){
		if($show_error){
			$result = @mysqli_query($this->connection, $query, MYSQLI_USE_RESULT);
			if(!$result){
				printf('Consulta SQL: %s<br />Erro: %s', htmlentities($query), htmlentities(mysqli_error($this->connection)));
				exit;
			}
		}
		return $result;
	}
	function numqueries(){
		return $this->queries;
	}
	function write_ms(){
		foreach($this->ms_querys as $query){
			@mysqli_query($this->connection, $this->ms_querys);
		}
	}
	function lasterror(){
		return mysqli_error($this->connection);
	}
	function affectedrows(){
		return @mysqli_affected_rows($this->connection);
	}
	function __destruct(){
        self::disconnect();
	}
	function fetch($result,$fetchmode=""){
		if($result instanceof mysqli_result){
			if(isset($fetchmode)){
				return mysqli_fetch_assoc($result);
			}else{
				return mysqli_fetch_array($result);
            }
        }
    }
	function freeresult($result){
		return @mysqli_free_result($result);
	}
	function numrows($result){
		if(!($result instanceof mysqli_result)) return 0;
		$rows = @mysqli_num_rows($result);
		return $rows ? $rows : 0;
	}
	function getlastid(){
		return @mysqli_insert_id($this->connection);
	}
	function get_connection(){
		return $this->connection;
	}
}
?>