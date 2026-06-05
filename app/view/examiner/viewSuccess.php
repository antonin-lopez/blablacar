<?php /** @var array $reservations */ ?>
<?php /** @var int $successCount */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1>Ajout des réservations aléatoires</h1>

        <div class="alert alert-info">
            <?= $successCount ?> réservation(s) ajoutée(s) avec succès.
        </div>

        <div class="d-flex flex-column gap-3">
            <?php foreach ($reservations as $reservation): ?>

                <div class="card">
                    <div class="card-header <?= $reservation['success'] ? 'text-success' : 'text-danger' ?>">
                        Réservation <?= $reservation['numero'] ?> : <?= $reservation['success'] ? 'Réussie' : 'Ignorée' ?>
                    </div>

                    <?php if ($reservation['success']): ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Passager :</strong>
                                <?= htmlspecialchars($reservation['passenger']->getFullName()) ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Itinéraire :</strong>
                                <?= htmlspecialchars($reservation['ride']->getDepartureCity()) ?> - <?= htmlspecialchars($reservation['ride']->getArrivalCity()) ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Conducteur :</strong>
                                <?= htmlspecialchars($reservation['ride']->getDriverFullName()) ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Départ :</strong>
                                <?php
                                $date = new DateTime($reservation['ride']->getDepartureDate() . ' ' . $reservation['ride']->getDepartureTime());
                                echo htmlspecialchars($date->format('d/m/Y à H:i'));
                                ?>
                            </li>
                        </ul>
                    <?php else: ?>
                        <div class="card-body">
                            <?= htmlspecialchars($reservation['message']) ?>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        </div>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>