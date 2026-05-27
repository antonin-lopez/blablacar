<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajouter un trajet</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="departure_city_id" class="form-label">Ville de départ</label>
                <select class="form-select" id="departure_city_id" name="departure_city_id" required>
                    <option value="" disabled selected>Choisissez une ville de départ</option>
                    <?php foreach ($cities ?? [] as $city): ?>
                        <option value="<?= $city->getId() ?>"><?= htmlspecialchars($city->getName()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="arrival_city_id" class="form-label">Ville d'arrivée</label>
                <select class="form-select" id="arrival_city_id" name="arrival_city_id" required>
                    <option value="" disabled selected>Choisissez une ville d'arrivée</option>
                    <?php foreach ($cities ?? [] as $city): ?>
                        <option value="<?= $city->getId() ?>"><?= htmlspecialchars($city->getName()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-12">
                <label for="vehicle_id" class="form-label">Véhicule</label>
                <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                    <option value="" disabled selected>Choisissez un véhicule</option>
                    <?php foreach ($vehicles ?? [] as $vehicle): ?>
                        <option value="<?= $vehicle->getId() ?>">
                            <?= htmlspecialchars($vehicle->getBrand() . ' ' . $vehicle->getModel() . ' [' . $vehicle->getYear() . '] (' . $vehicle->getLicensePlate() . ')') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="departure_date" class="form-label">Date de départ</label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" required>
            </div>

            <div class="col-md-4">
                <label for="departure_time" class="form-label">Heure de départ</label>
                <input type="time" class="form-control" id="departure_time" name="departure_time" required>
            </div>

            <div class="col-md-4">
                <label for="price" class="form-label">Prix</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" placeholder="0.00" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">Publier le trajet</button>
            </div>
        </form>

    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>