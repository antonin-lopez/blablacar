<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajout d'un véhicule</h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="brand" class="form-label">Marque</label>
                <input type="text" class="form-control" name="brand" id="brand" required>
            </div>

            <div class="col-md-6">
                <label for="model" class="form-label">Modèle</label>
                <input type="text" class="form-control" name="model" id="model" required>
            </div>

            <div class="col-md-6">
                <label for="year" class="form-label">Année</label>
                <input type="number" class="form-control" name="year" id="year" required>
            </div>

            <div class="col-md-6">
                <label for="license_plate" class="form-label">Immatriculation</label>
                <input type="text" class="form-control" name="license_plate" id="license_plate" required>
            </div>

            <div class="col-md-12">
                <label for="owner_id" class="form-label">Propriétaire</label>
                <select class="form-select" name="owner_id" id="owner_id" required>
                    <option value="" disabled selected>Sélectionnez un conducteur</option>
                    <?php foreach ($drivers ?? [] as $driver): ?>
                        <option value="<?= htmlspecialchars($driver->getId()) ?>">
                            <?= htmlspecialchars($driver->getFullName()) ?>
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

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>