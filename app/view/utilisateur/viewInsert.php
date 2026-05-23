<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajouter un <?= htmlspecialchars($roleNouvelUtilisateur ?? 'passager') ?></h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <?= htmlspecialchars($errors) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">

            <div class="col-md-6">
                <label for="nom_nouvel_utilisateur" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom_nouvel_utilisateur" name="nom_nouvel_utilisateur" required>
            </div>

            <div class="col-md-6">
                <label for="prenom_nouvel_utilisateur" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom_nouvel_utilisateur" name="prenom_nouvel_utilisateur" required>
            </div>

            <input type="hidden" name="mdp_nouvel_utilisateur" value="secret">
            <input type="hidden" name="role_nouvel_utilisateur" value="<?= htmlspecialchars($roleNouvelUtilisateur ?? 'passager') ?>">

            <div class="col-md-12">
                <label for="solde_nouvel_utilisateur" class="form-label">Solde initial</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="solde_nouvel_utilisateur" id="solde_nouvel_utilisateur" min="0" step="1" placeholder="0.00" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">
                    Créer le <?= htmlspecialchars($roleNouvelUtilisateur ?? 'passager') ?>
                </button>
            </div>
        </form>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>