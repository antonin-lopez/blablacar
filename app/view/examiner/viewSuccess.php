<?php /** @var array $results */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajout des réservations aléatoires</h1>

        <?php if (isset($results['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($results['error']) ?>
            </div>
        <?php else: ?>

            <strong>Succès !</strong> <?= count(array_filter($results['reservations'], function ($r) {
                                            return $r['success'];
                                        })) ?> réservation(s) ajoutée(s) avec succès.
            <div class="card">
                <div class="card-header">
                    Détail des 10 réservations
                </div>
                <div class="card-body p-0">
                    <ul class="list-group">
                        <?php foreach ($results['reservations'] as $reservation): ?>
                            <?php if ($reservation['success']): ?>
                                <li class="list-group-item">
                                    <strong>Réservation n°<?= $reservation['numero'] ?></strong><br>
                                    <strong>Passager :</strong> <?= htmlspecialchars($reservation['passenger_prenom']) ?> <?= htmlspecialchars($reservation['passenger_nom']) ?> (ID: <?= $reservation['passenger_id'] ?>)<br>
                                    <strong>Trajet :</strong> <?= htmlspecialchars($reservation['ride_depart']) ?> → <?= htmlspecialchars($reservation['ride_arrivee']) ?> (ID: <?= $reservation['ride_id'] ?>)<br>
                                    <strong>Conducteur :</strong> <?= htmlspecialchars($reservation['driver_nom']) ?><br>
                                    <strong>Départ :</strong> <?= htmlspecialchars($reservation['date_depart']) ?> à <?= htmlspecialchars($reservation['heure_depart']) ?>
                                </li>
                            <?php else: ?>
                                <li class="list-group-item">
                                    <strong>Réservation n°<?= $reservation['numero'] ?></strong><br>
                                    <?= htmlspecialchars($reservation['message']) ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>