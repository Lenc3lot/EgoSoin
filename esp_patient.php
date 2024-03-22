<?php include './templates/tmpl_top.php'; ?>
<section>
    <div></div>
    <div>
        <h1> Connexion à l'espace patient</h1>
        <form method="POST" name="monFormulaire" action="./scripts/connexionpatient.php">
            <input type="text" placeholder="Nom d'utilisateur" name="Plogin">
            <input type="password" name="Pmdp" placeholder="Mot de passe">
            <input type="submit" name="BtValider" value="Valider">
        </form>
        <?php
        if (isset($_GET["codeErr"])) {
            $_GET["codeErr"] = "IDENTIFIANT OU MOT DE PASSE INCORRECT !";
            echo $_GET["codeErr"];
        }
        ?>
    </div>
    <div></div>
</section>
<?php include './templates/tmpl_bot.php'; ?>