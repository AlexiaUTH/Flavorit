<?php
    // Variables d'affichage
    $strTitle    = 'Administrateurs';
    $strSubtitle = 'Liste des administrateurs';

    // Variables de fonctionnement
    $strPage = 'list_user';

    // Inclusion de l'en-tête
    include('_partials/header-dashboard.php');

    // Si l'utilisateur n'est pas un super administrateur
    if (!is_superadmin())
    {
        // Message d'erreur
        $_SESSION['message'] = lang('error_403');

        // On le redirige vers la page de connexion
        redirect('logout');
    }

    // Récupération des messages d'information
    $strMessage = $_SESSION['message'] ?? '';

    // Instanciation d'un nouveau modèle d'utilisateurs
    $objAdminModel = model('admin');

    // Récupération de tous les utilisateurs dans un tableau
    $arrUsers = $objAdminModel->findAll();

    // Tableau des utilisateurs à afficher
    $arrUserToDisplay = array();

    // Remplissage de l'objet utilisateur
    foreach($arrUsers as $arrUser)
    {
        // Instanciation d'une nouvelle entité d'utilisateur
        $objUser = entity('user');
        $objUser->setId($arrUser['user_id']);
        $objUser->setEmail($arrUser['user_mail']);
        $objUser->setActive($arrUser['user_active']);
        $objUser->setCreatedAt($arrUser['user_created_at']);
        $arrUserToDisplay[] = $objUser;
    }
?>

    <main class="container">

        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h2 class="mb-0"><?= $strTitle; ?></h2>
                <h5 class="text-uppercase text-muted mb-4"><?= $strSubtitle; ?></h5>

                <?php if ($strMessage != ''): ?>
                    <?= alert('warning', array($strMessage)); ?>
                <?php endif; ?>

                <a href="<?= site_url(); ?>/add_user.php" class="btn btn-primary mb-4">
                    <i class="bi bi-plus-square me-1"></i>
                    Ajouter un administrateur
                </a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Adresse e-mail</th>
                            <th>Actif</th>
                            <th>Date de création</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($arrUserToDisplay): ?>
                        <?php foreach($arrUserToDisplay as $intKey => $objUser): ?>
                        <tr>
                            <td><?= ++$intKey; ?></td>
                            <td><?= $objUser->getEmail(); ?></td>
                            <td><?= $objUser->getActive() ? '<span class="badge text-bg-dark">Oui</span>' : '<span class="badge text-bg-warning">Non</span>'; ?></td>
                            <td><?= $objUser->getFormattedCreatedAt(); ?></td>
                            <td class="text-end">
                                <?php if ($objUser->getActive()): ?> 
                                <a href="<?= site_url(); ?>/toggle_user.php?userid=<?= $objUser->getId(); ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-person-slash me-1"></i>
                                    Désactiver
                                <?php else: ?>
                                <a href="<?= site_url(); ?>/toggle_user.php?userid=<?= $objUser->getId(); ?>" class="btn btn-dark btn-sm">
                                    <i class="bi bi-person me-1"></i>
                                    Activer
                                <?php endif; ?>
                                </a>
                                <a href="<?= site_url(); ?>/edit_user.php?userid=<?= $objUser->getId(); ?>" class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Modifier
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                <?= lang('user_none'); ?>
                            </td>
                        <tr>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div><!-- .col-lg-8 -->

        </div><!-- .row -->

    </main><!-- .container -->

<?php
    // Inclusion du pied de page
    include('_partials/footer.php');