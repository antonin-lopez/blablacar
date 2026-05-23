<?php require 'app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require 'app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Liste des passagers</h1>
            <a href="index.php?controller=trajet&action=selectActiveTrajetForPassengers" class="btn btn-outline-secondary">
                Choisir un autre trajet
            </a>
        </div>

        <?php if (!empty($trajet)): ?>
            <div class="card">
                <div class="card-header">
                    Détails du trajet sélectionné
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-muted mb-1">Itinéraire</label>
                        <div class="fw-semibold"><?= htmlspecialchars($trajet['nom_ville_depart']) ?> - <?= htmlspecialchars($trajet['nom_ville_arrivee']) ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted mb-1">Départ</label>
                        <div class="fw-semibold">
                            <?php
                            $date = new DateTime($trajet['date_depart'] . ' ' . $trajet['heure_depart']);
                            echo htmlspecialchars($date->format('d/m/Y à H:i'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted mb-1">Prix par place</label>
                        <div class="fw-semibold"><?= htmlspecialchars($trajet['prix']) ?> €</div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($passagers)): ?>
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
                        <?php foreach ($passagers ?? [] as $passager): ?>
                            <tr>
                                <td><?= htmlspecialchars($passager['nom']) ?></td>
                                <td><?= htmlspecialchars($passager['prenom']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </main>

    <?php require 'app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>