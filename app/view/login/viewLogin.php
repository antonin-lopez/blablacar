<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1 class="mb-4">Connexion</h1>

        <?php if (!empty($errors)): ?>
            <div class='alert alert-danger'>
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
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

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>