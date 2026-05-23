<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <?php if (isset($results) && !empty($results)): 
            $nom = htmlspecialchars($_GET['nom']);
            $prenom = htmlspecialchars($_GET['prenom']);
            $login = strtolower($nom . $prenom);
            $password = htmlspecialchars($_GET['password']);
            $role = htmlspecialchars($_GET['userRole']);
            $solde = htmlspecialchars($_GET['solde']);
            
            echo "<h3>Le nouvel utilisateur a été ajouté </h3>";
            echo "<ul>";
            echo "<li>ID = " . htmlspecialchars($results) . "</li>";
            echo "<li>Nom = " . $nom . "</li>";
            echo "<li>Prénom = " . $prenom . "</li>";
            echo "<li>Login = " . $login . "</li>";
            echo "<li>Password = " . $password . "</li>";
            echo "<li>Rôle = " . $role . "</li>";
            echo "<li>Solde = " . $solde . "</li>";
            echo "</ul>";
        else:
            echo "<h3>Problème d'insertion de l'utilisateur</h3>";
        endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>