<?php
$idUtilisateur     = $_SESSION['id_utilisateur'] ?? -1;
$nomUtilisateur    = $_SESSION['nom_utilisateur'] ?? '';
$prenomUtilisateur = $_SESSION['prenom_utilisateur'] ?? '';
$roleUtilisateur   = $_SESSION['role_utilisateur'] ?? '';
$soldeUtilisateur  = $_SESSION['solde_utilisateur'] ?? 0;
?>

<nav class="navbar navbar-expand-lg py-3 bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?controller=accueil&action=home">Antoine Schaeffer et Antonin Lopez</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto">
                <?php if ($idUtilisateur >= 0): ?>
                    <?php if ($roleUtilisateur === 'administrateur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Administrateur</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?controller=utilisateur&action=readAll">Liste des utilisateurs</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=utilisateur&action=create&role_nouvel_utilisateur=conducteur">Ajout d'un conducteur</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=utilisateur&action=create&role_nouvel_utilisateur=passager">Ajout d'un passager</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=vehicule&action=readAll">Liste des véhicules</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=vehicule&action=createVehicule">Ajout d'un véhicule</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=ville&action=readAll">Liste des villes</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=ville&action=create">Ajout d'une ville</a></li>
                            </ul>
                        </li>
                    <?php elseif ($roleUtilisateur === 'conducteur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Conducteur</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?controller=vehicule&action=readMyVehicles">Mes véhicules</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=trajet&action=readMyTrajets">Mes trajets</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=trajet&action=create">Ajouter un trajet</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?controller=trajet&action=selectActiveTrajetForPassengers">Passagers de mes trajets</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=trajet&action=selectActiveTrajetToClose">Clôturer un trajet</a></li>
                            </ul>
                        </li>
                    <?php elseif ($roleUtilisateur === 'passager'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Passager</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?controller=reservation&action=readMyReservations">Mes réservations</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=reservation&action=create">Réserver un trajet</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controller=innovation&action=ideeData">Idée originale</a></li>
                        <li><a class="dropdown-item" href="index.php?controller=innovation&action=ameliorationMVC">Amélioration du code MVC</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Examinateur</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controller=examinateur&action=showSuperglobales">Superglobales</a></li>
                        <li><a class="dropdown-item" href="index.php?controller=examinateur&action=addRandomReservations">Ajout de 10 réservations</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php if ($idUtilisateur === -1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=connexion&action=login">Se connecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-3 d-flex align-items-center">
                        <span class="navbar-text fw-medium">
                            <?= "$prenomUtilisateur $nomUtilisateur" ?>
                            <span class="badge bg-body text-body ms-1 py-2">
                                <?= $soldeUtilisateur ?> €
                            </span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=connexion&action=logout">Se déconnecter</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>