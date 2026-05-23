<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Clôturer un trajet</h1>

        <?php if (empty($trajets)): ?>
            <div class="alert alert-warning">
                Vous n'avez aucun trajet actif à clôturer.
            </div>

        <?php else: ?>
            <div class="alert alert-info">
                La clôture d'un trajet le rendra indisponible pour de nouvelles réservations.
            </div>

            <form method="POST" action="" class="row g-3">
                <div class="col-md-12">
                    <label for="trajet_id" class="form-label">Choisissez le trajet à clôturer</label>
                    <select class="form-select" id="trajet_id" name="trajet_id" required>
                        <option value="" disabled selected>Choisissez un trajet</option>
                        <?php foreach ($trajets ?? [] as $trajet): ?>
                            <option value="<?= $trajet['id'] ?>">
                                <?= htmlspecialchars($trajet['nom_ville_depart']) ?> - <?= htmlspecialchars($trajet['nom_ville_arrivee']) ?> le <?= $trajet['date_depart'] ?> à <?= $trajet['heure_depart'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir clôturer ce trajet ? Cette action est irréversible.');">
                        Clôturer le trajet
                    </button>
                </div>
            </form>
        <?php endif; ?>

    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>