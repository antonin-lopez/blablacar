<?php require 'app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require 'app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1 class="mb-4">Connexion</h1>

        <?php if (!empty($erreur)): ?>
            <div class='alert alert-danger'>
                <?php echo $erreur; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="login" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>

    </main>

    <?php require 'app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>