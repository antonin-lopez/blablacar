<?php
$login_id = $_SESSION['login_id'] ?? -1;
$nom      = $_SESSION['nom'] ?? '';
$prenom   = $_SESSION['prenom'] ?? '';
$role     = $_SESSION['role'] ?? '';
$solde    = $_SESSION['solde'] ?? 0;
?>

<nav class="navbar navbar-expand-lg bg-primary sticky-top py-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="router.php?controller=accueil&action=home">Antoine Schaeffer et Antonin Lopez</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">

                <?php if ($login_id > 0): ?>
                    <li class="nav-item">
                        <span class="nav-link text-light bg-primary rounded px-3 mx-2">
                            | <?php echo htmlspecialchars($prenom) . ' ' . htmlspecialchars($nom) . ' | ' . number_format($solde, 2, ',', ' ') . ' € |'; ?>
                        </span>
                    </li>

                    <?php if ($role === 'administrateur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrateur
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?controller=utilisateur&action=readAll">Liste des utilisateurs</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=utilisateur&action=createConducteur">Ajout d'un conducteur</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=utilisateur&action=createPassager">Ajout d'un passager</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="router.php?controller=vehicule&action=readAll">Liste des véhicules</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=vehicule&action=create">Ajout d'un véhicule</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="router.php?controller=ville&action=readAll">Liste des villes</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=ville&action=create">Ajout d'une ville</a></li>
                            </ul>
                        </li>
                    <?php elseif ($role === 'conducteur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Conducteur
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?controller=vehicule&action=readMyVehicles">Liste de mes véhicules</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="router.php?controller=trajet&action=readMyTrajets">Liste de tous mes trajets (actifs et passifs)</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=trajet&action=create">Ajout d'un trajet</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="router.php?controller=trajet&action=selectActiveTrajetForPassengers">Liste des passagers de l'un de mes trajets actifs</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=trajet&action=selectActiveTrajetToClose">Cloturer un de mes trajets actifs</a></li>
                            </ul>
                        </li>
                    <?php elseif ($role === 'passager'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Passager
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?controller=reservation&action=readMyReservations">Liste de mes réservations</a></li>
                                <li><a class="dropdown-item" href="router.php?controller=reservation&action=create">Réservation d'un trajet actif</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Innovations
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?controller=innovation&action=ideeData">Idée originale</a></li>
                        <li><a class="dropdown-item" href="router.php?controller=innovation&action=ameliorationMVC">Amélioration du code MVC</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Examinateur
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?controller=examinateur&action=showSuperglobales">Superglobales</a></li>
                        <li><a class="dropdown-item" href="router.php?controller=examinateur&action=addRandomReservations">Ajout de 10 réservations au hasard</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="navbar-nav">
                <?php if ($login_id === -1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?controller=connexion&action=login">Se connecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?controller=connexion&action=logout">Se déconnecter</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>
