<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Ajout d'un véhicule</h1><br>
        <form role="form" method="get" action="router.php">
            <input type="hidden" name="controller" value="vehicule">
            <input type="hidden" name="action" value="vehiculeCreated">
            
            <div class="mb-3">
                <label for="marque" class="form-label w-auto">Marque :</label>
                <input type="text" class="form-control" name="marque" id="marque" style="width: 300px;" value="Renault" required>
            </div>
            
            <div class="mb-3">
                <label for="modele" class="form-label w-auto">Modèle :</label>
                <input type="text" class="form-control" name="modele" id="modele" style="width: 300px;" value="Clio" required>
            </div>
            
            <div class="mb-3">
                <label for="annee" class="form-label w-auto">Année :</label>
                <input type="number" class="form-control" name="annee" id="annee" style="width: 300px;" value="2020" required>
            </div>
            
            <div class="mb-3">
                <label for="immatriculation" class="form-label w-auto">Immatriculation :</label>
                <input type="text" class="form-control" name="immatriculation" id="immatriculation" style="width: 300px;" value="AB-123-CD" required>
            </div>
            
            <div class="mb-3">
                <label for="proprietaire_id" class="form-label w-auto">Propriétaire :</label>
                <select class="form-select" name="proprietaire_id" id="proprietaire_id" style="width: 300px;" required>
                    <option value="">Sélectionnez un conducteur</option>
                    <?php if (isset($conducteurs) && !empty($conducteurs)): ?>
                        <?php foreach ($conducteurs as $conducteur): ?>
                            <option value="<?php echo htmlspecialchars($conducteur['id']); ?>">
                                <?php echo htmlspecialchars($conducteur['prenom'] . ' ' . $conducteur['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Aucun conducteur disponible</option>
                    <?php endif; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter le véhicule</button>
        </form>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>