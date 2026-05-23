<?php require ROOT . '/app/view/fragment/fragmentHeader.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/fragment/fragmentMenu.php'; ?>

    <main class="container my-5">
        <h1>Affichage de toutes les villes</h1><br>
        <?php if (isset($results) && !empty($results)): ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Villes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $elements): ?>
                        <?php printf("<tr><td>%s</td></tr>", $elements->getNom()); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert">Aucune ville trouvée dans la base de données.</div>
        <?php endif; ?>
    </main>

    <?php require ROOT . '/app/view/fragment/fragmentFooter.html'; ?>
</body>

</html>