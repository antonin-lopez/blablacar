<?php /** @var string $viewMode */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($viewMode === 'close'): ?>
            <h1>Clôturer un trajet</h1>
        <?php else: ?>
            <h1>Passagers de mes trajets</h1>
        <?php endif; ?>

        <?php if (empty($rides)): ?>
            <div class="alert alert-warning">
                <?php if ($viewMode === 'close'): ?>
                    Vous n'avez aucun trajet actif à clôturer.
                <?php else: ?>
                    Vous n'avez aucun trajet actif pour le moment.
                <?php endif; ?>
            </div>

        <?php else: ?>
            <?php if ($viewMode === 'close'): ?>
                <div class="alert alert-info">
                    La clôture d'un trajet le rendra indisponible pour de nouvelles réservations.
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="row g-3">
                <div class="col-md-12">
                    <label for="ride_id" class="form-label">
                        <?php if ($viewMode === 'close'): ?>
                            Choisissez le trajet à clôturer
                        <?php else: ?>
                            Vos trajets actifs
                        <?php endif; ?>
                    </label>

                    <select class="form-select" id="ride_id" name="ride_id" required>
                        <option value="" disabled selected>-- Sélectionnez un trajet --</option>

                        <?php foreach ($rides ?? [] as $ride): ?>
                            <?php
                            $date = (new DateTime($ride->getDepartureDate()))->format('d/m/Y');
                            $time = (new DateTime($ride->getDepartureTime()))->format('H:i');
                            ?>
                            <option value="<?= $ride->getId() ?>">
                                <?= htmlspecialchars($ride->getDepartureCity()) ?> -
                                <?= htmlspecialchars($ride->getArrivalCity()) ?>
                                le <?= $date ?> à <?= $time ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12 mt-4 d-flex justify-content-end">
                    <?php if ($viewMode === 'close'): ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir clôturer ce trajet ? Cette action est irréversible.');">
                            Clôturer le trajet
                        </button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary">
                            Voir les passagers
                        </button>
                    <?php endif; ?>
                </div>
            </form>

        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>