<?php
// controller_home.php - view liste de 10 actualités récentes sans tenant compte de thème ou tag

ob_start();

?>

<div style="display: flex;">
   
  <div id="menu-vertical-gauche">
    
  <a name="view_home" href="index.php" class="selected" >Home</a>  
    
<?php foreach($listeThemes as $theme) { ?>    
  <a href="index.php?view=1&theme=<?= $theme->getIdTheme(); ?>" class="" ><?= $theme->getLibelle(); ?></a>
<?php } ?> 
 
</div><div id="contenu">
    
    <!--    CONTENU CENTRAL AU MILIEU -->
    
<table>
    <caption><p style="text-align: center">Nos dernières actualités:<br/><br/></p></caption>
    
    <?php for($i=0; $i<count($listeActus); $i++) { ?>
   <tr>
        <td class="preview_image">
            <a href="index.php?view=1&theme=<?= $listeActus[$i]->getTheme()->getIdTheme(); ?>" ><p style="color: purple;font-size: 1.1em"><?= $listeActus[$i]->getTheme()->getLibelle(); ?></p></a>
            <p style="font-size: 0.6em;"><?= $listeActus[$i]->getDateCrea(); ?></p>
            <p><img src="<?= $listeActus[$i]->getImage(); ?>"  /></p>
        </td>

        <td class="preview_article">
            <p class="titre_article"><?= $listeActus[$i]->getTitre(); ?></p><br/>
            <p style="font-size: 0.9em;color: black;"><?= ManagerActus::preview($cnx,(int)$listeActus[$i]->getIdActu()); ?> </p>
            <a href="index.php?view=3&actu=<?= $listeActus[$i]->getIdActu(); ?>"  ><strong>[Voir l'article...]</strong></a>
        </td>
              
   </tr>
    <tr></tr>
    <?php  }  ?>

</table> 
    
    <!-- Pagination -->
<div style="text-align: right;">
    <form method="POST" action="index.php">
        Nombre d'articles par page :
        <select name="limite" onchange="this.form.submit()">
            <option value="<?= count($listeActusAll); ?>" <?php $paging=null; ?> >Tous</option>
            <option value="5" <?php if($limite==5){ 
                                echo 'selected';
                                $paging = $limite; }            
                                ?> >5</option>
            <option value="10" <?php if($limite==10){ 
                                echo 'selected';
                                $paging = $limite; }            
                                ?> >10</option>
        </select>
       </form>
    
        <?php  $nbPage = ceil(count($listeActusAll)/$limite); ?>
    
    <p> <?php if($nbPage>1){ for($itr=1; $itr<=$nbPage; $itr++) {?>
        <a href="index.php?view=0&page=<?= $itr; ?>&limite=<?= $paging; ?>" style="text-decoration: none;">page <?= $itr; ?>  &nbsp;</a>
    <?php } } ?>
    </p>
</div>

    <!-- FIN -  CONTENU CENTRAL AU MILIEU -->    
    
</div><div id="menu-vertical-droite" >
    
<?php foreach($listeTags as $tag) { ?>    
  <a href="index.php?view=2&tag=<?= $tag->getIdTag(); ?>" class="" >#<?= $tag->getNameTag(); ?></a>
<?php } ?>     
  
</div>	

</div>


<?php
 
$content = ob_get_clean();
include("template.php");

?>

