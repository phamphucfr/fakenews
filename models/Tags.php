<?php

class Tags {
        private $idTag;
	private $nameTag;
	
	function __construct(){

	}
	
	function getIdTag(){
		return $this->idTag;
	}
	
	function setIdTag($idTag){
		$this->idTag = $idTag;	
	}
	function getNameTag(){
		return $this->nameTag;
	}
	
	function setNameTag($nameTag){
		$this->nameTag = $nameTag;	
	}
        
}
