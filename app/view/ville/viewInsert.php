<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Ajout d'une ville</h1><br>
        <form role="form" method="get" action="router.php">
            <input type="hidden" name="controller" value="ville">
            <input type="hidden" name="action" value="villeCreated">
            
            <div class="mb-3">
                <label for="nom" class="form-label w-auto">Nom de la ville :</label>
                <input type="text" class="form-control" name="nom" id="nom" style="width: 300px;" placeholder="ici c'est Troyes" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter la ville</button>
        </form>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>