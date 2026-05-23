<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajout d'un véhicule</h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <?= htmlspecialchars($errors) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="marque_nouveau_vehicule" class="form-label">Marque</label>
                <input type="text" class="form-control" name="marque_nouveau_vehicule" id="marque_nouveau_vehicule" required>
            </div>

            <div class="col-md-6">
                <label for="modele_nouveau_vehicule" class="form-label">Modèle</label>
                <input type="text" class="form-control" name="modele_nouveau_vehicule" id="modele_nouveau_vehicule" required>
            </div>

            <div class="col-md-6">
                <label for="annee_nouveau_vehicule" class="form-label">Année</label>
                <input type="number" class="form-control" name="annee_nouveau_vehicule" id="annee_nouveau_vehicule" required>
            </div>

            <div class="col-md-6">
                <label for="immatriculation_nouveau_vehicule" class="form-label">Immatriculation</label>
                <input type="text" class="form-control" name="immatriculation_nouveau_vehicule" id="immatriculation_nouveau_vehicule" required>
            </div>

            <div class="col-md-12">
                <label for="id_proprietaire_nouveau_vehicule" class="form-label">Propriétaire</label>
                <select class="form-select" name="id_proprietaire_nouveau_vehicule" id="id_proprietaire_nouveau_vehicule" required>
                    <option value="" disabled selected>Sélectionnez un conducteur</option>
                    <?php foreach ($conducteurs ?? [] as $conducteur): ?>
                        <option value="<?= htmlspecialchars($conducteur['id']) ?>">
                            <?= htmlspecialchars($conducteur['prenom'] . ' ' . $conducteur['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">Ajouter le véhicule</button>
            </div>
        </form>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>