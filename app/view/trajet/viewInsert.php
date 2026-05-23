<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajouter un trajet</h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="ville_depart_nouveau_trajet" class="form-label">Ville de départ</label>
                <select class="form-select" id="ville_depart_nouveau_trajet" name="ville_depart_nouveau_trajet" required>
                    <option value="" disabled selected>Choisissez une ville de départ</option>
                    <?php foreach ($villes ?? [] as $ville): ?>
                        <option value="<?= $ville['id'] ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="ville_arrivee_nouveau_trajet" class="form-label">Ville d'arrivée</label>
                <select class="form-select" id="ville_arrivee_nouveau_trajet" name="ville_arrivee_nouveau_trajet" required>
                    <option value="" disabled selected>Choisissez une ville d'arrivée</option>
                    <?php foreach ($villes ?? [] as $ville): ?>
                        <option value="<?= $ville['id'] ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-12">
                <label for="id_vehicule_nouveau_trajet" class="form-label">Véhicule</label>
                <select class="form-select" id="id_vehicule_nouveau_trajet" name="id_vehicule_nouveau_trajet" required>
                    <option value="" disabled selected>Choisissez un véhicule</option>
                    <?php foreach ($vehicules ?? [] as $vehicule): ?>
                        <option value="<?= $vehicule['id'] ?>">
                            <?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele'] . ' [' . $vehicule['annee'] . '] (' . $vehicule['immatriculation'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="date_depart_nouveau_trajet" class="form-label">Date de départ</label>
                <input type="date" class="form-select" id="date_depart_nouveau_trajet" name="date_depart_nouveau_trajet" required>
            </div>


            <div class="col-md-4">
                <label for="heure_depart_nouveau_trajet" class="form-label">Heure de départ</label>
                <input type="time" class="form-control" id="heure_depart_nouveau_trajet" name="heure_depart_nouveau_trajet" required>
            </div>


            <div class="col-md-4">
                <label for="prix_nouveau_trajet" class="form-label">Prix</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="prix_nouveau_trajet" name="prix_nouveau_trajet" min="0" step="1" placeholder="0.00" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>


            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">Publier le trajet</button>
            </div>
        </form>

    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>