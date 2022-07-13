<?php


class ManagerTags {
     //----------------------Methode findAll()----------------------------------
    static function findAll(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT id_keyword, libelle  
                FROM keywords
                ";
        $PDOStmt = $cnx->prepare($sql);

        $PDOStmt->execute();
        $listeTags = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Tags();
            $obj->setIdTag($record->id_keyword); // id de la colonne
            $obj->setNameTag($record->libelle); // nom de la colonne
            
            array_push($listeTags, $obj);
        }
        
        return $listeTags;
    }  
   
    //----------------------Methode findAll() surchargée avec filtre recherche----------------------------------
    static function findAllwithFilter(PDO $cnx, $pattern){
        // String Requete SQL
        $sql = "SELECT id_keyword, libelle 
                FROM keywords
                WHERE libelle LIKE ?
                ORDER BY libelle";

        $PDOStmt = $cnx->prepare($sql);
        
        $stringPattern = "%".$pattern."%";
        $PDOStmt->bindParam(1, $stringPattern, PDO::PARAM_STR);
        
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Tags();
            $obj->setIdTag($record->id_keyword); // id de la colonne
            $obj->setNameTag($record->libelle); // nom de la colonne
            
            array_push($liste, $obj);
        }
        
        return $liste;
    } 
   
  
    //----------------------Methode modify()----------------------------------    
    static function findById(PDO $cnx, $id){
        // requete SQL
        $sql = "SELECT id_keyword, libelle
                FROM keywords
                WHERE id_keyword = ? ";
             
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1,$id,PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
        
        $retour = $PDOStmt->fetchObject();
        $obj = new Tags();
        $obj->setIdTag($retour->id_keyword);
        $obj->setNameTag($retour->libelle);

        return $obj;
    }
    
            
        
        static function getTagsActu(PDO $cnx, $id_actu){
            $liste = [];
      
            $sql="SELECT keyword
                  FROM actualites_keywords 
                  WHERE actualite = ?
                 ";
            // Préparation
            $PDOStmt = $cnx->prepare($sql);

            // Binding les params par les "?" dans la requete SQL en haut
            $PDOStmt->bindParam(1,$id_actu,PDO::PARAM_INT);

            // Exécution de la requete
            $PDOStmt->execute();
            
            while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = ManagerTags::findById($cnx, $record->keyword);
            array_push($liste, $obj);
            }
            
            return $liste;
        
        }
  
           
    
  
       
}
