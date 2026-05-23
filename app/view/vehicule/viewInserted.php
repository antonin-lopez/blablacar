<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <?php if (isset($results) && !empty($results)): 
            require_once ROOT . '/app/model/ModelUtilisateur.php';
            $conducteurs = ModelUtilisateur::getConducteurs();
            $nomProprietaire = '';
            foreach ($conducteurs as $conducteur) {
                if ($conducteur['id'] == $_GET['proprietaire_id']) {
                    $nomProprietaire = $conducteur['prenom'] . ' ' . $conducteur['nom'];
                    break;
                }
            }
            
            echo "<h3>Le nouveau véhicule a été ajouté</h3>";
            echo "<ul>";
            echo "<li>ID du véhicule = " . htmlspecialchars($results) . "</li>";
            echo "<li>Marque = " . htmlspecialchars($_GET['marque']) . "</li>";
            echo "<li>Modèle = " . htmlspecialchars($_GET['modele']) . "</li>";
            echo "<li>Année = " . htmlspecialchars($_GET['annee']) . "</li>";
            echo "<li>Immatriculation = " . htmlspecialchars($_GET['immatriculation']) . "</li>";
            echo "<li>Propriétaire = " . htmlspecialchars($nomProprietaire) . "</li>";
            echo "</ul>";
        else:
            echo "<h3>Problème d'insertion du véhicule</h3>";
        endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>