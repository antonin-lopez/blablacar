<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1>
            <?= $_SESSION['user_role'] === 'admin' ? "Liste de tous les véhicules" : "Mes véhicules" ?>
        </h1>

        <?php if (empty($vehicles)): ?>
            <div class="alert alert-info">
                Aucun véhicule enregistré.
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
                            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                <th>Propriétaire</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <tr>
                                <td><?= htmlspecialchars($vehicle->getBrand()) ?></td>
                                <td><?= htmlspecialchars($vehicle->getModel()) ?></td>
                                <td><?= htmlspecialchars($vehicle->getYear()) ?></td>
                                <td><?= htmlspecialchars($vehicle->getLicensePlate()) ?></td>
                                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <td><?= htmlspecialchars($vehicle->getOwnerFullName()) ?></td>
                                <?php endif; ?>
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