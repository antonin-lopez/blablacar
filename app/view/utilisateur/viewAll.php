<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Affichage de tous les utilisateurs</h1>

        <?php if (empty($utilisateurs)): ?>
            <div class="alert alert-info">
                Aucun utilisateur trouvé dans la base de données.
            </div>

        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Rôle</th>
                            <th>Login</th>
                            <th>Password</th>
                            <th>Solde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($utilisateurs as $utilisateur): ?>
                            <tr>
                                <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['role']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['login']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['password']) ?></td>
                                <td><?= htmlspecialchars($utilisateur['solde']) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>