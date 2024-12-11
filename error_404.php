<?php
    // Variables d'affichage
    $strTitle = 'Page non trouvée';

    // Inclusion de l'en-tête
    include('_partials/header-error.php');
?>

    <main class="container d-flex flex-column align-items-center justify-content-center h-100vh">
        
        <h2 class="display-2 mb-2">404</h2>
        <p class="h3 mb-0">Oups... Vous venez de trouver une page d'erreur</p>
        <p class="text-muted fs-6 mb-5">Nous sommes désolés, mais la page que vous recherchez n’a pas été trouvée</p>
        <a href="<?php echo (isset($_SESSION['role']) && in_array($_SESSION['role'], array('admin', 'superadmin'))) ? 'dashboard.php' : 'index.php'; ?>" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Retour à l’accueil
        </a>

    </main>

</body>
</html>