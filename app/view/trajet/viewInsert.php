<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajouter un trajet</h1>

        <?php if (!empty($erreur)): ?>
            <div class='alert alert-danger'>
                <?php echo $erreur; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="ville_depart" class="form-label">Ville de départ</label>
                <select class="form-select" id="ville_depart" name="ville_depart" required>
                    <option value="" disabled selected>Choisissez une ville de départ</option>
                    <?php foreach ($villes ?? [] as $ville): ?>
                        <option value="<?= $ville['id'] ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="ville_arrivee" class="form-label">Ville d'arrivée</label>
                <select class="form-select" id="ville_arrivee" name="ville_arrivee" required>
                    <option value="" disabled selected>Choisissez une ville d'arrivée</option>
                    <?php foreach ($villes ?? [] as $ville): ?>
                        <option value="<?= $ville['id'] ?>"><?= htmlspecialchars($ville['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-12">
                <label for="vehicule_id" class="form-label">Véhicule</label>
                <select class="form-select" id="vehicule_id" name="vehicule_id" required>
                    <option value="" disabled selected>Choisissez un véhicule</option>
                    <?php foreach ($vehicules ?? [] as $vehicule): ?>
                        <option value="<?= $vehicule['id'] ?>">
                            <?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele'] . ' [' . $vehicule['annee'] . '] (' . $vehicule['immatriculation'] . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="date_depart" class="form-label">Date de départ</label>
                <input type="date" class="form-select" id="date_depart" name="date_depart" required>
            </div>


            <div class="col-md-4">
                <label for="heure_depart" class="form-label">Heure de départ</label>
                <input type="time" class="form-control" id="heure_depart" name="heure_depart" required>
            </div>


            <div class="col-md-4">
                <label for="prix" class="form-label">Prix</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="prix" name="prix" min="0" step="1" placeholder="0.00" required>
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