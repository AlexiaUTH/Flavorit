<?php
    // Variables d'affichage
    $strTitle = 'Erreur';

    if (is_production())
    {
        $strSubtitle = 500;
        $strMessage  = lang('error_500');
    }

    // Inclusion de l'en-tête
    include('_partials/header-error.php');
?>

    <main class="container d-flex flex-column align-items-center justify-content-center h-100vh">
        
        <h2 class="display-2 mb-2"><?= esc($strSubtitle); ?></h2>
        <p class="h3 mb-0">Oups... Vous venez de trouver une page d'erreur</p>
        <p class="text-muted mb-5"><?= esc($strMessage); ?></p>
        <a href="index.php" class="btn btn-secondary text-ucfirst">
            <i class="bi bi-arrow-left me-2"></i>
            Retour à l’accueil
        </a>

    </main>

</body>
</html>