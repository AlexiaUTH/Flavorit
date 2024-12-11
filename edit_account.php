<?php
    // Variables d'affichage
    $strTitle = 'Modifier son compte';

    // Variables de fonctionnement
    $strPage = 'edit_account';

    // Inclusion de l'en-tête
    include('_partials/header.php');

    // Instanciation d'un nouveau modèle d'utilisateurs
    $objUserModel = model('user');

    // Instanciation d'un nouveau modèle de clients
    $objCustomerModel = model('customer');

    // Instanciation d'une nouvelle entité de l'objet utilisateur
    $objUser = entity('user');

    // Instanciation d'une nouvelle entité de l'objet client
    $objCustomer = entity('customer');

    // Récupération des messages d'information
    $strMessage   = $_SESSION['message'] ?? '';

    // Récupération de l'Id de l'utilisateur
    $intUserId    = $_SESSION['userid'] ?? 0;

    // Récupération des valeurs des champs du formulaire
    $strLastname  = $_POST['lastname']  ?? $_SESSION['lastname']  ?? '';
    $strFirstname = $_POST['firstname'] ?? $_SESSION['firstname'] ?? '';
    $strEmail     = $_POST['email']     ?? $_SESSION['email']     ??  '';
    $strPassword  = $_POST['password']  ?? '';

    // Remplissage de l'entité de l'objet utilisateur
    $objUser->setId($intUserId);
    $objUser->setEmail($strEmail);
    $objUser->setPassword($strPassword);

    // Remplissage de l'entité de l'objet client
    $objCustomer->setId($intUserId);
    $objCustomer->setLastname($strLastname);
    $objCustomer->setFirstname($strFirstname);

    // Initialisation du tableau des erreurs
    $arrErrors = array();

    // Si le formulaire a été envoyé
    if (count($_POST) > 0)
    {
        // Gestion des messages d'erreur du formulaire
        if ($objCustomer->getLastname() == '')  $arrErrors['lastname']  = lang('lastname_required');
        if ($objCustomer->getFirstname() == '') $arrErrors['firstname'] = lang('firstname_required');
        if ($objUser->getEmail() == '') 
        {
            $arrErrors['email'] = lang('email_required');
        } 
        elseif (filter_var($objUser->getEmail(), FILTER_VALIDATE_EMAIL) === false) 
        {
            $arrErrors['email'] = lang('email_invalid');
        }
        
        // S'il n'y a aucune erreur
        if (count($arrErrors) == 0)
        {
            // On met à jour l'utilisateur
            $objUserModel->update($objUser);
            
            // On enregistre l'email dans une variable de session
            $_SESSION['email'] = $objUser->getEmail();

            // Si le client est mis à jour
            if ($objCustomerModel->update($objCustomer))
            {
                // On enregistre le nom et le prénom dans une variable de session
                $_SESSION['lastname']  = $objCustomer->getLastname();
                $_SESSION['firstname'] = $objCustomer->getFirstname();

                // Message de réussite
                $_SESSION['message'] = lang('customer_updated');

                // Redirection vers la page de modification du compte
                redirect('edit_account');
            }
            else
            {
                // Message d'échec
                $_SESSION['message'] = lang('retry_later');
            }
        }
    }
?>

    <main class="d-flex flex-column justify-content-center align-items-center bg-body h-100vh">
        
        <div class="col-12 col-lg-6 col-xl-4">

            <div class="container py-4">

                <form action="<?= site_url(); ?>/edit_account.php" method="POST" class="card card-md">
                    <div class="card-body">
                        <div class="text-center mb-2">
                            <a href="<?= site_url(); ?>" class="navbar-brand navbar-brand-autodark">
                                <img src="<?= base_url(); ?>assets/img/logo.bak.png" alt="Logo" width="100">
                            </a>
                        </div>

                        <h2 class="h4 card-title text-center mb-4"><?= $strTitle; ?></h2>
                        
                        <?php if (count($arrErrors) > 0): ?>
                            <?php alert('error', $arrErrors); ?>
                        <?php elseif ($strMessage != ''): ?>
                            <?php alert('warning', array($strMessage)); ?>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text" name="lastname" placeholder="Entrer votre nom" class="form-control <?php if (isset($arrErrors['lastname'])) echo 'is-invalid'; ?>" value="<?= $objCustomer->getLastname(); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" name="firstname" placeholder="Entrer votre prénom" class="form-control <?php if (isset($arrErrors['firstname'])) echo 'is-invalid'; ?>"  value="<?= $objCustomer->getFirstname(); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" name="email" placeholder="Entrer votre adresse email" class="form-control <?php if (isset($arrErrors['email'])) echo 'is-invalid'; ?>"  value="<?= $objUser->getEmail(); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control <?php if (isset($arrErrors['password'])) echo 'is-invalid'; ?>">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" id="btn_toggle_input">
                                        <i class="bi-eye"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        
                        <footer class="pt-4">
                            <button type="submit" class="btn btn-secondary w-100"><?= $strTitle; ?></button>
                        </footer>
                    </div>
                </form>

            </div>
 
        </div>

    </main><!-- .d-flex -->

<?php
    // Inclusion du pied de page
    include('_partials/footer.php');