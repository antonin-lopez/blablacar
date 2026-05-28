<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Réserver un trajet</h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (empty($rides)): ?>
            <div class="alert alert-info">
                Aucun trajet disponible à la réservation.
            </div>
        <?php else: ?>
            <form method="POST" action="" class="row g-3">
                <div class="col-md-12">
                    <label for="ride_id" class="form-label">Trajets disponibles</label>
                    <select class="form-select" id="ride_id" name="ride_id" required>
                        <option value="" disabled selected>-- Sélectionnez un trajet --</option>

                        <?php foreach ($rides as $ride): ?>
                            <?php
                            $date = (new DateTime($ride->getDepartureDate()))->format('d/m/Y');
                            $time = (new DateTime($ride->getDepartureTime()))->format('H:i');
                            ?>
                            <option value="<?= $ride->getId() ?>">
                                <?= htmlspecialchars($ride->getDepartureCity()) ?> -
                                <?= htmlspecialchars($ride->getArrivalCity()) ?>
                                le <?= $date ?> à <?= $time ?>
                                (<?= htmlspecialchars(number_format($ride->getPrice(), 2)) ?> €)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </div>
            </form>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>