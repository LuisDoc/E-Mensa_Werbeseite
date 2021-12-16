<!--
- Praktikum DBWT. Autoren:
- Luis, Diniz Do Carmo, 3275829
- Nilusche, Liyanaarachchi, 3272466
-->
<!--Einbinden der Navigationsleiste -->
<section>
    <!-- Basic Grid -->
    <div class= "header">
        <div class="header_left_picture">
            <img class ="fh_logo" src="sources/Logo_FH-Aachen.jpg" alt="logo">
        </div>
        <!--Inneres Grid -->
        <div class="header_menu_reiter">
            <a href="index.php#Ankündigungen" class = "header_links">Ankündigung</a>
            <a href="index.php#Speisekarte" class = "header_links">Speisen</a>
            <a href="index.php#Zahlen" class = "header_links">Zahlen</a>
            <a href="index.php#Newsletter" class = "header_links">Kontakt</a>
            <a href="index.php#Wichtig" class = "header_links">Wichtig für Uns</a>
            <?php
                if(isset($_SESSION['userid'])){
                    echo '<a href="includes/logout.inc.php" class = "header_links">Ausloggen</a>';
                }else{
                    echo '<a href="authentication.php" class = "header_links">Einloggen oder Registrieren</a>';
                }
            ?>
        </div>
    </div>
</section>