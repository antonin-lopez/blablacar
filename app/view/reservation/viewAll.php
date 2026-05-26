<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
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
                                <td><?= htmlspecialchars($reservation['ville_depart']) ?></td>

                                <td><?= htmlspecialchars($reservation['ville_arrivee']) ?></td>

                                <td>
                                    <?php
                                    $date = new DateTime($reservation['date_depart']);
                                    echo htmlspecialchars($date->format('d/m/Y'));
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $heure = new DateTime($reservation['heure_depart']);
                                    echo htmlspecialchars($heure->format('H:i'));
                                    ?>
                                </td>

                                <td><?= htmlspecialchars($reservation['prenom_conducteur']) . ' ' .
                                        htmlspecialchars($reservation['nom_conducteur']) ?></td>

                                <td><?= htmlspecialchars($reservation['marque_vehicule']) . ' ' .
                                        htmlspecialchars($reservation['modele_vehicule']) ?></td>

                                <td><?= htmlspecialchars($reservation['immatriculation']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>