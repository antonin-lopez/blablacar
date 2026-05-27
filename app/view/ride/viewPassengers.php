<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Liste des passagers</h1>
            <a href="index.php?controller=ride&action=activeRides&view=passengers" class="btn btn-outline-secondary">
                Choisir un autre trajet
            </a>
        </div>

        <?php if (!empty($ride)): ?>
            <div class="card">
                <div class="card-header">
                    Détails du trajet sélectionné
                </div>
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Itinéraire :</strong>
                            <?= htmlspecialchars($ride->getDepartureCity()) ?> - <?= htmlspecialchars($ride->getArrivalCity()) ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Départ :</strong>
                            <?php
                            $date = new DateTime($ride->getDepartureDate() . ' ' . $ride->getDepartureTime());
                            echo htmlspecialchars($date->format('d/m/Y à H:i'));
                            ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Prix par place :</strong>
                            <?= htmlspecialchars(number_format($ride->getPrice(), 2)) ?> €
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($passengers)): ?>
            <div class="alert alert-info">
                Aucun passager n'a encore réservé de place pour ce trajet.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($passengers ?? [] as $passenger): ?>
                            <tr>
                                <td><?= htmlspecialchars($passenger['nom']) ?></td>
                                <td><?= htmlspecialchars($passenger['prenom']) ?></td>
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