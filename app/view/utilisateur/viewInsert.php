<?php 
if (!isset($userRole)) {
    $userRole = '';
}
?>

<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Ajout d'un utilisateur</h1><br>
        <form role="form" method="get" action="router.php">
            <input type="hidden" name="controller" value="utilisateur">
            <input type="hidden" name="action" value="utilisateurCreated">
            <div class="mb-3">
                <label for="nom" class="form-label w-auto">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" style="width: 300px;" value="SCHAEFFER" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label w-auto">Prénom :</label>
                <input type="text" class="form-control" name="prenom" id="prenom" style="width: 300px;" value="Antoine" required>
            </div>
            <input type="hidden" name="password" value="secret">
            <input type="hidden" name="userRole" value="<?php echo htmlspecialchars($userRole); ?>">
            <div class="mb-3">
                <label for="solde" class="form-label w-auto">Solde :</label>
                <input type="number" class="form-control" name="solde" id="solde" style="width: 300px;" value="100" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer <?php echo htmlspecialchars($userRole); ?></button>
        </form>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>