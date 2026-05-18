<?php
if (isset($_SESSION['login_id'])) {
    $login_id = $_SESSION['login_id'];
} else {
    $login_id = -1;
}
if (isset($_SESSION['nom'])) {
    $nom = $_SESSION['nom'];
} else {
    $nom = '';
}
if (isset($_SESSION['prenom'])) {
    $prenom = $_SESSION['prenom'];
} else {
    $prenom = '';
}
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = '';
}
if (isset($_SESSION['solde'])) {
    $solde = $_SESSION['solde'];
} else {
    $solde = 0;
}
?>

<nav class="navbar navbar-expand-lg bg-primary fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="router.php?action=accueil">BlaBlaCar 2026</a>
        <span style="color: white; margin-left: 10px;">
            <?php echo "LOPEZ Antonin & SCHAEFFER Antoine" ?>
        </span>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
            <!-- infos si co -->
            <?php if ($login_id > 0): ?>
                <li class="nav-item">
                    <a class="nav-link">
                        <?php echo $prenom . ' | ' . $nom . ' | ' . $solde . ' €'; ?>
                    </a>
                </li>
            <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="router.php?action=innovations">Innovations</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="router.php?action=examinateur">Examinateur</a>
                </li>
                <!-- situation si pas co -->
                <?php if ($login_id==-1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?action=login">Se connecter</a>
                    </li>
                <?php endif; ?>

                <!-- situation si co -->
                <?php if ($login_id>0): ?>

                    <!-- menu admin -->
                    <?php if ($role=='administrateur'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Utilisateurs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?action=liste_utilisateurs">Liste des utilisateurs</a></li>
                                <li><a class="dropdown-item" href="router.php?action=ajout_conducteur">Ajouter un conducteur</a></li>
                                <li><a class="dropdown-item" href="router.php?action=ajout_passager">Ajouter un passager</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Véhicules
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?action=liste_vehicules">Liste des véhicules</a></li>
                                <li><a class="dropdown-item" href="router.php?action=ajout_vehicule">Ajouter un véhicule</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Villes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?action=liste_villes">Liste des villes</a></li>
                                <li><a class="dropdown-item" href="router.php?action=ajout_ville">Ajouter une ville</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <!-- menu conducteur -->
                    <?php if ($role == 'conducteur'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="router.php?action=vehicules">Mes véhicules</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mes trajets
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="router.php?action=liste_trajets">Liste de mes trajets</a></li>
                                <li><a class="dropdown-item" href="router.php?action=ajout_trajet">Ajouter un trajet</a></li>
                                <li><a class="dropdown-item" href="router.php?action=passagers_trajet">Passagers d'un trajet</a></li>
                                <li><a class="dropdown-item" href="router.php?action=cloturer_trajet">Clôturer un trajet</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- menu passager -->
                    <?php if ($role == 'passager'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="router.php?action=reservations">Mes réservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="router.php?action=reserver_trajet">Réserver un trajet</a>
                        </li>
                    <?php endif; ?>

                    <!-- deconnexion -->
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?action=logout">Déconnexion</a>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>