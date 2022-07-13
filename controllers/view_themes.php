<?php
// controller_themes.php - controller spécifique pour la vue listing des articles liés à un thème
ob_start();

?>

<div style="display: flex;">
   
<div id="menu-vertical-gauche">
    
  <a name="view_home" href="index.php" >Home</a>  
    
<?php foreach($listeThemes as $theme) { ?>    
  <a href="index.php?view=1&theme=<?= $theme->getIdTheme(); ?>" 
     class="<?= ($theme->getIdTheme()==$theme_selected->getIdTheme())?'selected':''?>" ><?= $theme->getLibelle(); ?>    
  </a>
<?php } ?> 
 
</div><div id="contenu" >
    
    <!--    CONTENU CENTRAL AU MILIEU -->
    
<?php $listeActus = ManagerActus::findByTheme($cnx, (int)$theme_selected->getIdTheme()); ?>
<table>
 <caption><p style="text-align: center">Nos dernières actualités:<br/><br/></p></caption>

    <?php foreach($listeActus as $actu) { ?>
   <tr>
        <td class="preview_image">
            <a href="index.php?view=1&theme=<?= $actu->getTheme()->getIdTheme(); ?>" ><p style="color: purple;font-size: 1.1em"><?= $actu->getTheme()->getLibelle(); ?></p></a>
            <p style="font-size: 0.6em;"><?= $actu->getDateCrea(); ?></p>
            <p><img src="<?= $actu->getImage(); ?>"  /></p>
        </td>

        <td class="preview_article">
            <p class="titre_article"><?= $actu->getTitre(); ?></p><br/>
            <p style="font-size: 0.9em;color: black;"><?= ManagerActus::preview($cnx,(int)$actu->getIdActu()); ?> </p>
            <a href="index.php?view=3&actu=<?= $actu->getIdActu(); ?>"  ><strong>[Voir l'article...]</strong></a>
        </td>
       
   </tr>
    <tr></tr>
    <?php } ?>

</table>    

    
    <!-- FIN -  CONTENU CENTRAL AU MILIEU -->    
    
</div><div id="menu-vertical-droite">
    
<?php foreach($listeTags as $tag) { ?>    
  <a href="index.php?view=2&tag=<?= $tag->getIdTag(); ?>" class="" >#<?= $tag->getNameTag(); ?></a>
<?php } ?>     
  
</div>	

</div>


<?php
 
$content = ob_get_clean();
include("template.php");

?>