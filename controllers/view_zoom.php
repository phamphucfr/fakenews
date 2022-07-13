<?php
// controller_home.php - view liste de 10 actualités récentes sans tenant compte de thème ou tag

ob_start();

?>

<div style="display: flex;">
   
<div id="menu-vertical-gauche">
    
  <a name="view_home" href="index.php" >Home</a>  
    
<?php foreach($listeThemes as $theme) { ?>    
  <a href="index.php?view=1&theme=<?= $theme->getIdTheme(); ?>" 
     class="<?= ($theme->getIdTheme()==$actu_selected->getTheme()->getIdTheme())?'selected':''?>" ><?= $theme->getLibelle(); ?>    
  </a>
<?php } ?> 
 
</div><div id="contenu">
    <table>  
    <!--    CONTENU CENTRAL AU MILIEU -->
    <tr>
        <td style="width: 100%">
            <div>
                <a href="index.php?view=1&theme=<?= $actu_selected->getTheme()->getIdTheme(); ?>" ><p style="color: purple;font-size: 1.1em"><?= $actu_selected->getTheme()->getLibelle(); ?></p></a>
                <p class="titre_article"><?= $actu_selected->getTitre(); ?></p>
                <p style="font-size: 0.7em;">Article publié le <?= $actu_selected->getDateCrea(); ?></p>
            </div>
            <br/>
            <p style="text-align:center;">
                <img src="<?= $actu_selected->getImage(); ?>" class="image" alt="<?= $actu_selected->getTitre(); ?>" />
            </p>
        </td> 
    </tr>    
    <tr>
        <td>
            <div>
            <p>
             <?= $actu_selected->getContenu(); ?>   
            </p>
            </div>
        </td>
    </tr>

    <tr>
        <td>
            <p style="font-size: 0.8em;color: purple;">Les mots-clés concernés par cet article: </p>
            <p><?php foreach($listeTagsActu as $tagActu) { ?>  
                
              <a href="index.php?view=2&tag=<?= $tagActu->getIdTag(); ?>" class="tagsActu" >
                <?php if(count($listeTagsActu)>1) echo " &nbsp; "; 
                      echo " #".$tagActu->getNameTag().",";  ?>   
              </a>
            <?php } ?>  
            </p>
        </td>
    </tr>

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

