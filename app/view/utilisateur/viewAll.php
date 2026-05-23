<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Affichage de tous les utilisateurs</h1><br>
        <?php if (isset($results) && !empty($results)): ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Login</th>
                        <th scope="col">Password</th>
                        <th scope="col">Solde</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $elements): ?>
                        <?php printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>", $elements->getNom(), $elements->getPrenom(), $elements->getRole(), $elements->getLogin(), $elements->getPassword(), $elements->getSolde()); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert">Aucun utilisateur trouvé dans la base de données.</div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>