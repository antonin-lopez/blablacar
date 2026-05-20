<?php require 'app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require 'app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Connexion</h1>

        <?php if (!empty($erreur)): ?>
            <div class='alert alert-danger'><?php echo $erreur; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="login" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>


    </main>


    <?php require 'app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>