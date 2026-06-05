<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1>Mes réservations</h1>

        <?php if (empty($reservations)): ?>
            <div class="alert alert-info">
                Vous n'avez pas de réservation enregistrée.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Ville de départ</th>
                            <th>Ville d'arrivée</th>
                            <th>Date de départ</th>
                            <th>Heure de départ</th>
                            <th>Conducteur</th>
                            <th>Véhicule</th>
                            <th>Immatriculation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation->getDepartureCity()) ?></td>
                                <td><?= htmlspecialchars($reservation->getArrivalCity()) ?></td>
                                <td>
                                    <?php
                                    $date = new DateTime($reservation->getDepartureDate());
                                    echo htmlspecialchars($date->format('d/m/Y'));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $time = new DateTime($reservation->getDepartureTime());
                                    echo htmlspecialchars($time->format('H:i'));
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($reservation->getDriverFullName()) ?></td>
                                <td><?= htmlspecialchars($reservation->getVehicleFullName()) ?></td>
                                <td><?= htmlspecialchars($reservation->getLicensePlate()) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>