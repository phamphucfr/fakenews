<?php
//include("Theme.php");

class ManagerTheme{
     
    static function findAll(PDO $cnx){
        // String Requete SQL
        $sql = "SELECT id_theme, libelle 
                FROM themes";
        // ON PREPARE LA REQUETE (plus sécurisé que la requete directe car protège contre des injection SQL et rapidité en cas de requete multiple)
        // La méthode 'prepare()'de l'objet PDO retourne un objet PDOStatement
        $PDOStmt = $cnx->prepare($sql);
                
        // Exécution de la requete
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Theme();
            $obj->setIdTheme($record->id_theme); // id de la colonne
            $obj->setLibelle($record->libelle); // nom de la colonne
            
            array_push($liste, $obj);
        }
        
        return $liste;
    }  
   
        //----------------------Methode findAll() surchargée avec filtre recherche----------------------------------
    static function findAllwithFilter(PDO $cnx, $pattern){
        // String Requete SQL
        $sql = "SELECT id_theme, libelle 
                FROM themes
                WHERE libelle LIKE ?
                ORDER BY libelle";

        $PDOStmt = $cnx->prepare($sql);
        
        $stringPattern = "%".$pattern."%";
        $PDOStmt->bindParam(1, $stringPattern, PDO::PARAM_STR);
        
        $PDOStmt->execute();
        $liste = [];
        while($record = $PDOStmt->fetch(PDO::FETCH_OBJ)){  // retourne chaque élément suivant
            // Un objet pour chaque enregistrement
            $obj = new Theme();
            $obj->setIdTheme($record->id_theme); // id de la colonne
            $obj->setLibelle($record->libelle); // nom de la colonne
            
            array_push($liste, $obj);
        }
        
        return $liste;
    }  
    
    
    //----------------------Methode modify()----------------------------------    
    static function findById(PDO $cnx, $id){
        // requete SQL
        $sql = "SELECT id_theme, libelle
                FROM themes
                WHERE id_theme = ? ";
             
        // Préparation
        $PDOStmt = $cnx->prepare($sql);

        // Binding les params par les "?" dans la requete SQL en haut
        $PDOStmt->bindParam(1,$id,PDO::PARAM_INT);

        // Exécution de la requete
        $PDOStmt->execute();
        
        $retour = $PDOStmt->fetchObject();
        $obj = new Theme();
        $obj->setIdTheme($retour->id_theme);
        $obj->setLibelle($retour->libelle);

        return $obj;
    }
    
  
        
}  

    
?>
