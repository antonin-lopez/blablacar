<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Amélioration du code MVC</h1>
        <div class="alert alert-info">
            Le routeur a été modifié pour accepter deux paramètres d'entrée distincts (contrôleur et action), au lieu d'un seul auparavant. </p>
            Le nom du contrôleur est désormais construit à partir du paramètre contrôleur, puis on vérifie l'existence de la méthode correspondant au paramètre action. </p>
            Ainsi, les deux paramètres sont cités séparément dans le lien hypertexte de la navbar.
        </div>
        
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>