<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Mes véhicules</h1>

        <?php if (empty($vehicules)): ?>
            <div class="alert alert-info">
                Vous n'avez pas de véhicule enregistré.
            </div>

        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Année</th>
                            <th>Immatriculation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicules as $vehicule): ?>
                            <tr>
                                <td><?= htmlspecialchars($vehicule['marque']) ?></td>
                                <td><?= htmlspecialchars($vehicule['modele']) ?></td>
                                <td><?= htmlspecialchars($vehicule['annee']) ?></td>
                                <td><?= htmlspecialchars($vehicule['immatriculation']) ?></td>
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