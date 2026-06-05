<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1>Affichage des superglobales</h1>

        <div>
            <h2>Session</h2>
            <?php if (empty($_SESSION)): ?>
                <div class="alert alert-info">
                    Aucune donnée en session.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Clé</th>
                                <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION as $key => $value): ?>
                                <tr>
                                    <td><?= htmlspecialchars($key) ?></td>
                                    <td><?= htmlspecialchars(print_r($value, true)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <h2>Cookies</h2>
            <?php if (empty($_COOKIE)): ?>
                <div class="alert alert-info">
                    Aucun cookie trouvé.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_COOKIE as $key => $value): ?>
                                <tr>
                                    <td><?= htmlspecialchars($key) ?></td>
                                    <td><?= htmlspecialchars($value) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>