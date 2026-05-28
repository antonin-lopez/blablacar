<?php /** @var string $cityName */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <div class="alert alert-success">
            La nouvelle ville a été ajoutée avec succès !
        </div>

        <div class="card">
            <div class="card-header">
                Récapitulatif des informations
            </div>
            <div class="card-body p-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nom de la ville :</strong> <?= htmlspecialchars($cityName) ?></li>
                </ul>
            </div>
        </div>

        <div>
            <a href="index.php?controller=city&action=index" class="btn btn-primary">Retour à la liste</a>
        </div>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>