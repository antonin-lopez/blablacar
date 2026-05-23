<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Affichage de tous les véhicules</h1><br>
        <?php if (isset($results) && !empty($results)): ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Marque</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Année</th>
                        <th scope="col">Immatriculation</th>
                        <th scope="col">Propriétaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $elements): ?>
                        <?php printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s %s</td></tr>", $elements->getMarque(), $elements->getModele(), $elements->getAnnee(), $elements->getImmatriculation(), $elements->getPrenom(), $elements->getNom()); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert">Aucun véhicule trouvé dans la base de données.</div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>