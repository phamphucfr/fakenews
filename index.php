
<?php

// utilisation du chargement auto des classes
// plus besoin d'inclure les fichier lors d'instanciations
spl_autoload_register('my_autoloader');
// fonction custom lié à l'autoload
function my_autoloader($class) {
    include 'models/' . $class . '.php';
}

//CONTROLEUR PRINCIPAL-INDEX.PHP
include("tools/MaConnexion.php");

// Connexion - Une instance de PDO -
$cnx = MaConnexion::connect();

$view = "0";  // par défaut => listing des entités
if( isset($_GET["view"]) ){
	$view = $_GET["view"];
}

$listeActusAll = ManagerActus::findAll($cnx);
$listeThemes = ManagerTheme::findAll($cnx);
$listeTags = ManagerTags::findAll($cnx);

// On dirige vers un controleur spécifique:
switch($view){
	case "1":

               if(isset($_GET['theme'])){
                    $theme_selected = ManagerTheme::findById($cnx,(int)$_GET['theme']) ;
                    include_once("controllers/view_themes.php");
               }               

		break;
                
	case "2":
                if(isset($_GET['tag'])){
                    $tag_selected = ManagerTags::findById($cnx, (int)$_GET['tag']);
                    include_once("controllers/view_tags.php");
                }

		break;	
                
	case "3":
                if(isset($_GET['actu'])){
                    $actu_selected = ManagerActus::findById($cnx, (int)$_GET['actu']);
                    $listeTagsActu = ManagerTags::getTagsActu($cnx, (int)$_GET['actu']);
                    include_once("controllers/view_zoom.php");
                }
                
		break;	
                
	case "0": default:
            // Pagination 
                if(empty($_POST['limite'])) {
                    if(isset($_GET['limite'])){
                        $limite = $_GET['limite'];
                    }
                    else $limite = 5;
//                    else $limite = count($listeActusAll) ;                    
                }
                else{
                    if(isset($_GET['limite'])){
                        $limite = $_GET['limite'];
                    }
                    else $limite = $_POST['limite'];
                }
                
                if(isset($_GET['page'])){
                    $idPage = $_GET['page'];
                } 
                else $idPage = 1;
                
                $listeActus = ManagerActus::findPagination($cnx, (int)$limite, (int)$idPage);
             // End pagination   
                             
		include_once("controllers/view_home.php");
                
		break;
}

// les sections:
// 0 ==> catégorie Home
// 1 ==> catégorie Theme
// 2 ==> catégorie Tag

// les actions:
// 0 ==> Vue Listing
// 1 ==> Vue Détail
// 2 ==> Vue selon id_theme / id_tag

?>

