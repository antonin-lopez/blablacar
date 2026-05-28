<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Ajout d'une ville</h1>

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
            <div class="col-md-12">
                <label for="name" class="form-label">Nom de la ville</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">Créer la ville</button>
            </div>
        </form>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>