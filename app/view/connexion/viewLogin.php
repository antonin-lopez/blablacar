<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1 class="mb-4">Connexion</h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="login_utilisateur" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login_utilisateur" name="login_utilisateur" required>
            </div>

            <div class="col-md-6">
                <label for="password_utilisateur" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password_utilisateur" name="password_utilisateur" required>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>

    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>