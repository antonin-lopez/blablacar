<?php /** @var float $roleNewUser */ ?>

<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container my-5 d-flex flex-column gap-4">
        <h1>Ajouter un <?= htmlspecialchars($roleNewUser === 'conducteur' ? 'conducteur' : 'passager') ?></h1>

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
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="col-md-6">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="col-md-12">
                <label for="balance" class="form-label">Solde initial</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="balance" id="balance" min="0" step="1" placeholder="0" required>
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <div class="col-md-12 mt-4 d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">
                    Créer le <?= htmlspecialchars($roleNewUser === 'conducteur' ? 'conducteur' : 'passager') ?>
                </button>
            </div>
        </form>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>