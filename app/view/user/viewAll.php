<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1>Affichage de tous les utilisateurs</h1>

        <?php if (empty($users)): ?>
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
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user->getLastName()) ?></td>
                                <td><?= htmlspecialchars($user->getFirstName()) ?></td>
                                <td><?= htmlspecialchars($user->getRole()) ?></td>
                                <td><?= htmlspecialchars($user->getLogin()) ?></td>
                                <td><?= htmlspecialchars($user->getPassword()) ?></td>
                                <td><?= htmlspecialchars($user->getBalance()) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>