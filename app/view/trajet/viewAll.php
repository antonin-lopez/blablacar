<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Mes trajets</h1>

        <?php if (empty($trajets)): ?>
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
                        <?php foreach ($trajets as $trajet): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($trajet['nom_ville_depart']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($trajet['nom_ville_arrivee']) ?>
                                </td>
                                <td>
                                    <?php
                                    $date = new DateTime($trajet['date_depart']);
                                    echo htmlspecialchars($date->format('d/m/Y'));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $heure = new DateTime($trajet['heure_depart']);
                                    echo htmlspecialchars($heure->format('H:i'));
                                    ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($trajet['statut']) ?>
                                </td>
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