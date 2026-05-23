<?php 
/** @var int|false|null $results */ //Pour eviter l'erreur de $results car le code fonctionne mais il subsiste une erreur
require ROOT . '/app/view/fragment/fragmentHeader.html'; 
?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>
    <main class="container my-5">
        <?php 
        // verif que la ville existe ou pas
        if ($results === false): 
            $nom = htmlspecialchars($_GET['nom']);
        ?>
            <h3>La ville "<?php echo $nom; ?>" existe déjà !</h3>
            <p>Aucune insertion n'a été effectuée.</p>
        <?php elseif (isset($results) && !empty($results)): 
            $nom = htmlspecialchars($_GET['nom']);
        ?>
            <h3>La ville a été ajoutée</h3>
            <ul>
                <li>ID = <?php echo htmlspecialchars($results); ?></li>
                <li>Nom de la ville = <?php echo $nom; ?></li>
            </ul>
        <?php else: ?>
            <h3>Problème d'insertion de la ville</h3>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>