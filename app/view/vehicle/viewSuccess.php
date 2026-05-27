<?php /** @var string $brand */ ?>
<?php /** @var string $model */ ?>
<?php /** @var string $year */ ?>
<?php /** @var string $licensePlate */ ?>
<?php /** @var string $ownerFullName */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <div class="alert alert-success">
            Le nouveau véhicule a été ajouté avec succès !
        </div>

        <div class="card">
            <div class="card-header">
                Récapitulatif des informations du véhicule
            </div>
            <div class="card-body p-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Marque :</strong> <?= htmlspecialchars($brand) ?></li>
                    <li class="list-group-item"><strong>Modèle :</strong> <?= htmlspecialchars($model) ?></li>
                    <li class="list-group-item"><strong>Année :</strong> <?= htmlspecialchars($year) ?></li>
                    <li class="list-group-item"><strong>Immatriculation :</strong> <?= htmlspecialchars($licensePlate) ?></li>
                    <li class="list-group-item"><strong>Propriétaire :</strong> <?= htmlspecialchars($ownerFullName) ?></li>
                </ul>
            </div>
        </div>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>