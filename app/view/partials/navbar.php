<?php
$userId    = $_SESSION['user_id'] ?? -1;
$lastName  = $_SESSION['last_name'] ?? '';
$firstName = $_SESSION['first_name'] ?? '';
$userRole  = $_SESSION['user_role'] ?? '';
$balance   = $_SESSION['balance'] ?? 0;
?>

<nav class="navbar navbar-expand-lg py-3 bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?controller=home&action=home">Antoine Schaeffer et Antonin Lopez</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto">

                <?php if ($userId >= 0): ?>
                    <?php if ($userRole === 'administrateur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Administrateur</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?controller=user&action=index">Liste des utilisateurs</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=user&action=create&role=conducteur">Ajout d'un conducteur</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=user&action=create&role=passager">Ajout d'un passager</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=vehicle&action=index">Liste des véhicules</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=vehicle&action=create">Ajout d'un véhicule</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=city&action=index">Liste des villes</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=city&action=create">Ajout d'une ville</a></li>
                            </ul>
                        </li>

                    <?php elseif ($userRole === 'conducteur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Conducteur</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?controller=vehicle&action=index">Mes véhicules</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=ride&action=index">Mes trajets</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=ride&action=create">Ajouter un trajet</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=ride&action=activeRides&view=passengers">Passagers de mes trajets</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=ride&action=activeRides&view=close">Clôturer un trajet</a></li>
                            </ul>
                        </li>

                    <?php elseif ($userRole === 'passager'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Passager</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?controller=reservation&action=index">Mes réservations</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=reservation&action=create">Réserver un trajet</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controller=innovation&action=originalIdea">Idée originale</a></li>
                        <li><a class="dropdown-item" href="index.php?controller=innovation&action=mvcImprovement">Amélioration du code MVC</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Examinateur</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controller=examiner&action=showSuperglobals">Superglobales</a></li>
                        <li><a class="dropdown-item" href="index.php?controller=examiner&action=seedReservations">Ajout de 10 réservations</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php if ($userId === -1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=login&action=login">Se connecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-3 d-flex align-items-center">
                        <span class="navbar-text fw-medium">
                            <?= htmlspecialchars("$firstName $lastName") ?>
                            <span class="badge bg-body text-body ms-1 py-2">
                                <?= number_format($balance, 2) ?> €
                            </span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=login&action=logout">Se déconnecter</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>