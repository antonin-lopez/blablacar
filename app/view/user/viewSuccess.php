<?php /** @var string $login */ ?>
<?php /** @var string $roleNewUser */ ?>

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
                    <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($lastName) ?></li>
                    <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($firstName) ?></li>
                    <li class="list-group-item"><strong>Login généré :</strong> <?= htmlspecialchars($login) ?></li>
                    <li class="list-group-item"><strong>Mot de passe :</strong> <?= htmlspecialchars($password) ?></li>
                    <li class="list-group-item"><strong>Rôle :</strong> <?= htmlspecialchars($roleNewUser) ?></li>
                    <li class="list-group-item"><strong>Solde initial :</strong> <?= htmlspecialchars($balance) ?> €</li>
                </ul>
            </div>
        </div>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>