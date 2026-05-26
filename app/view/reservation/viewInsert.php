<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Réserver un trajet</h1>

        <?php if (empty($trajets)): ?>
            <div class="alert alert-info">
                Aucun trajet disponible à la réservation.
            </div>
        <?php else: ?>


            <form method="POST" action="" class="row g-3">
                <div class="col-md-12">
                    <label for="trajet_id" class="form-label">Trajets disponibles</label>
                    <select class="form-select" id="trajet_id" name="trajet_id" required>
                        <option value="" disabled selected>-- Sélectionnez un trajet --</option>

                        <?php foreach ($trajets as $trajet): ?>
                            <?php
                            $date = (new DateTime($trajet['date_depart']))->format('d/m/Y');
                            $heure = (new DateTime($trajet['heure_depart']))->format('H:i');
                            ?>
                            <option value="<?= $trajet['id'] ?>">
                                <?= htmlspecialchars($trajet['nom_ville_depart']) ?> -
                                <?= htmlspecialchars($trajet['nom_ville_arrivee']) ?>
                                le <?= $date ?> à <?= $heure ?>
                                (<?= htmlspecialchars($trajet['prix']) ?> €)
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

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>