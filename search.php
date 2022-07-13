     <form action="index.php" id="search-form" method="POST">
        <input type="hidden" name="section" value="<?= $section; ?>"/>
        <input type="hidden" name="action" value="4"/>
        <input type="text" id="pattern" name="pattern" placeholder="your pattern ..." class="champText"/>
        <input type="button" onclick="check_search()" value="Rechercher" class="bouton" />
        <p id="err-libelle"></p>
     </form>