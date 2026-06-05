<?php require ROOT . '/app/view/partials/header.html'; ?>

<body class="d-flex flex-column min-vh-100">
    <?php require ROOT . '/app/view/partials/navbar.php'; ?>

    <main class="container mt-5 d-flex flex-column gap-4">
        <h1>Idée originale</h1>

        <div>
            <h2>La gamification du covoiturage</h2>
            <p>
                Notre innovation repose sur la ludification du covoiturage.
                Le concept est simple : chaque trajet effectué, que ce soit en tant que passager ou comme conducteur,
                rapporte des points d'expérience (XP). Cette XP permet de franchir des niveaux. Un autre moyen de gagner des
                niveau serait de débloquer des badges en accomplissant des défis spécifiques (ex: avoir effectué 100 trajets,
                avoir covoituré 10 semaines consécutives, ou encore avoir parcouru 10 000 km en covoiturage).
            </p>

            <p>
                D'un point de vue psychologique, ce système stimule directement le circuit de la récompense.
                L'anticipation et l'obtention d'un nouveau badge ou d'un passage de niveau déclenchent une libération de
                dopamine, l'hormone de la satisfaction. En transformant une routine de transport en un défi personnel et
                ludique, on crée un réflexe d'utilisation et on augmente considérablement l'engagement sur l'application.
            </p>
        </div>

        <div>
            <h2>Des exemples de réussite</h2>
            <p>
                Ce mécanisme a déjà fait ses preuves et a grandement contribué à la popularité de géants du numérique :
            </p>
            <ul>
                <li><strong>Waze :</strong> Qui a bâti sa communauté en transformant la conduite en jeu, poussant les utilisateurs à "manger" des bonbons virtuels pour faire évoluer leur avatar.</li>
                <li><strong>Duolingo :</strong> Devenue l'application linguistique numéro un mondial grâce à son système addictif de "streaks" (séries de jours consécutifs).</li>
                <li><strong>Strava :</strong> Le réseau social des sportifs qui repose entièrement sur la gamification, l'obtention de badges et les défis de performance.</li>
            </ul>
        </div>
    </main>

    <?php require ROOT . '/app/view/partials/footer.html'; ?>
</body>

</html>