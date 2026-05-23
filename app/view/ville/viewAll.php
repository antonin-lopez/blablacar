<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Affichage de toutes les villes</h1>

        <?php if (empty($villes)): ?>
            <div class="alert alert-info">
                Aucune ville trouvée dans la base de données.
            </div>

        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Villes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($villes as $ville): ?>
                            <tr>
                                <td><?= htmlspecialchars($ville['nom']) ?></td>
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