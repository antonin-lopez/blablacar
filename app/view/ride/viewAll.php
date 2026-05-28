<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Mes trajets</h1>

        <?php if (empty($rides)): ?>
            <div class="alert alert-info">
                Vous n'avez pas de trajet enregistré.
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
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rides as $ride): ?>
                            <?php
                            $date = new DateTime($ride->getDepartureDate());
                            $time = new DateTime($ride->getDepartureTime());
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($ride->getDepartureCity()) ?></td>
                                <td><?= htmlspecialchars($ride->getArrivalCity()) ?></td>
                                <td><?= htmlspecialchars($date->format('d/m/Y')) ?></td>
                                <td><?= htmlspecialchars($time->format('H:i')) ?></td>
                                <td><?= htmlspecialchars($ride->getStatus()) ?></td>
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