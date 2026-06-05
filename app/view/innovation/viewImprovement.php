<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Amélioration du code MVC</h1>

        <p>
            Le routeur accepte désormais deux paramètres distincts (<code>controller</code> et <code>action</code>) au lieu d'un seul.
            La classe du contrôleur est générée dynamiquement et la méthode correspondante est exécutée après vérification de son existence.
            En conséquence, ces deux variables doivent être passées séparément dans les liens de la barre de navigation.
        </p>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>