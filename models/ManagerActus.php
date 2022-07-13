<?php


class ManagerActus {
        //----------------------Methode findAll()----------------------------------
    static function findAll(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
                actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
                themes.id_theme, themes.libelle 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE actu.publish = 1
                ORDER BY actu.date_creation DESC";

        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->execute();
        
        $liste = [];
        
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);

            array_push($liste, $obj);
        }
        
        return $liste;
    } 
    
    //----------------------Methode findAll() surchargée avec filtre recherche----------------------------------
       static function findAllwithFilter(PDO $cnx, $pattern){
        // String Requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
            actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
            themes.id_theme, themes.libelle  
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE actu.titre LIKE ?
                ORDER BY libelle, actu.titre";

        $PDOStmt = $cnx->prepare($sql);
        
        $stringPattern = "%".$pattern."%";
        $PDOStmt->bindParam(1, $stringPattern, PDO::PARAM_STR);
        
        $PDOStmt->execute();
        $liste = [];
        
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);
           
            array_push($liste, $obj);
        }
        
        return $liste;
    }  
    
   
      
    //----------------------Methode findByID()----------------------------------    
    static function findById(PDO $cnx, $idActu){

        // requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
            actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
            themes.id_theme, themes.libelle 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE actu.id_actualite = ?";

        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->bindParam(1,$idActu,PDO::PARAM_INT);
        
        $PDOStmt->execute();
              
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);

        }

        return $obj;
    }
   
    //----------------------Methode findByTheme()----------------------------------    
    static function findByTheme(PDO $cnx, $idTheme){

        $theme_selected = ManagerTheme::findById($cnx, $idTheme);
        // requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.theme, actu.date_creation,
                actu.date_modif, actu.url_image, actu.contenu, actu.publish,
                themes.id_theme, themes.libelle
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE themes.id_theme = ? AND actu.publish = 1 
                ORDER BY actu.date_creation DESC";

        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->bindParam(1,$idTheme,PDO::PARAM_INT);
        
        $PDOStmt->execute();
        
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setTheme($theme_selected); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif); 
            $obj->setContenu($record->contenu);
            $obj->setImage($record->url_image);
            array_push($liste, $obj);
        }

        return $liste;
    }
    
    //----------------------Methode findByTags()----------------------------------    
    static function findByTag(PDO $cnx, $idTag){

        // requete SQL
        $sql = "SELECT actu.id_actualite, actu.titre, actu.theme, actu.date_creation,
                actu.date_modif, actu.url_image, actu.contenu, actu.publish,
                themes.id_theme, themes.libelle, actualite, keyword 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                INNER JOIN actualites_keywords
                ON actu.id_actualite = actualite
                WHERE keyword = ? AND actu.publish = 1 
                ORDER BY actu.date_creation DESC";
        

        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->bindParam(1,$idTag,PDO::PARAM_INT);
        
        $PDOStmt->execute();
        
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);

            array_push($liste, $obj);
        }

        return $liste;
    }
    
        //----------------------Methode preview()----------------------------------
    static function preview(PDO $cnx, $idActu){
        // String Requete SQL
        $sql = "SELECT id_actualite, SUBSTRING(contenu, 1, 250) AS preview
                FROM actualites
                WHERE id_actualite = ?
                ";

        $PDOStmt = $cnx->prepare($sql);
        
        $PDOStmt->bindParam(1,$idActu,PDO::PARAM_INT);

        $PDOStmt->execute();
               
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $preview = $record->preview;      
        }
        
        return $preview;
    } 
        
    
    static function findPagination(PDO $cnx, $limite, $idPage) {
        $offset = ($limite*$idPage) - $limite;
        
        $sql="SELECT actu.id_actualite, actu.titre, actu.contenu, actu.theme, 
                actu.date_creation, actu.date_modif, actu.publish, actu.url_image, 
                themes.id_theme, themes.libelle 
                FROM actualites AS actu
                INNER JOIN themes
                ON actu.theme = themes.id_theme
                WHERE actu.publish = 1
                ORDER BY actu.date_creation DESC
                LIMIT ? OFFSET ?
             ";
        
        $PDOStmt = $cnx->prepare($sql);
        
        $PDOStmt->bindParam(1, $limite, PDO::PARAM_INT);
        $PDOStmt->bindParam(2, $offset, PDO::PARAM_INT);

        $PDOStmt->execute();
        
        $liste = [];
        
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $theme = new Theme();
            $theme->setIdTheme($record->id_theme);
            $theme->setLibelle($record->libelle);
            
            $obj = new Actualites();
            $obj->setIdActu($record->id_actualite); 
            $obj->setTitre($record->titre); 
            $obj->setContenu($record->contenu); 
            $obj->setTheme($theme); 
            $obj->setDateCrea($record->date_creation); 
            $obj->setDateModif($record->date_modif);  
            $obj->setImage($record->url_image);

            array_push($liste, $obj);
        }
        
        return $liste;
        
    }
  
     
}
