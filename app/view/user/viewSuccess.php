<?php /** @var string $newLastName */ ?>
<?php /** @var string $newFirstName */ ?>
<?php /** @var string $newLogin */ ?>
<?php /** @var string $newPassword */ ?>
<?php /** @var string $roleNewUser */ ?>
<?php /** @var float $newBalance */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <div class="alert alert-success">
            Le nouvel utilisateur a été ajouté avec succès !
        </div>

        <div class="card">
            <div class="card-header">
                Récapitulatif des informations
            </div>
            <div class="card-body p-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($newLastName) ?></li>
                    <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($newFirstName) ?></li>
                    <li class="list-group-item"><strong>Login généré :</strong> <?= htmlspecialchars($newLogin) ?></li>
                    <li class="list-group-item"><strong>Mot de passe :</strong> <?= htmlspecialchars($newPassword) ?></li>
                    <li class="list-group-item"><strong>Rôle :</strong> <?= htmlspecialchars($roleNewUser) ?></li>
                    <li class="list-group-item"><strong>Solde initial :</strong> <?= htmlspecialchars($newBalance) ?> €</li>
                </ul>
            </div>
        </div>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>