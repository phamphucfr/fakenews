<?php


class Actualites {
        private $idActu;
	private $titre;
        private $contenu;
        private $theme;
	private $dateCrea;
        private $dateModif;
        private $image;
        private $publish;
        
	
	function __construct(){
            $this->theme = new Theme();
	}
	
	function getIdActu(){
		return $this->idActu;
	}
	
	function setIdActu($idActu){
		$this->idActu = $idActu;	
	}
        
        
	function getTitre() {
		return $this->titre;
	}
	
	function setTitre($titre){
		$this->titre = $titre;	
	}
        
        
	function getContenu(){
		return $this->contenu;
	}
	
	function setContenu($contenu){
		$this->contenu = $contenu;	
	}
        
        
	function getTheme(){
            
		return $this->theme;
	}
	
	function setTheme($theme){
		$this->theme = $theme;	
	}
        
        
	function getDateCrea(){
		return $this->dateCrea;
	}
	
	function setDateCrea($dateCrea){
		$this->dateCrea = $dateCrea;	
	}
        
	function getDateModif(){
		return $this->dateModif;
	}
	
	function setDateModif($dateModif){
		$this->dateModif = $dateModif;	
	}
        
        function getImage(){
        return $this->image;
	}
	
	function setImage($image){
                $this->image = $image;			
	}
        
        function getPublish(){
        return $this->publish;
	}
	
	function setPublish($publish){
                $this->publish = $publish;			
	}
        
}
