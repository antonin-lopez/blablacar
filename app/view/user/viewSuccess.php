<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <?php if (isset($nouvelUtilisateur) && $nouvelUtilisateur): ?>

            <div class="alert alert-success">
                Le nouvel utilisateur a été ajouté avec succès !
            </div>

            <div class="card">
                <div class="card-header">
                    Récapitulatif des informations
                </div>
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($nomNouvelUtilisateur) ?></li>
                        <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($prenomNouvelUtilisateur) ?></li>
                        <li class="list-group-item"><strong>Login généré :</strong> <?= htmlspecialchars($loginNouvelUtilisateur) ?></li>
                        <li class="list-group-item"><strong>Mot de passe :</strong> <?= htmlspecialchars($mdpNouvelUtilisateur) ?></li>
                        <li class="list-group-item"><strong>Rôle :</strong> <?= htmlspecialchars($roleNouvelUtilisateur) ?></li>
                        <li class="list-group-item"><strong>Solde initial :</strong> <?= htmlspecialchars($soldeNouvelUtilisateur) ?> €</li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>