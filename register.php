<?php
    // Variables d'affichage
    $strTitle = 'Créer un compte';

    // Variables de fonctionnement
    $strPage = 'register';

    // Inclusion de l'en-tête
    include('_partials/header-auth.php');

    // Instanciation d'un nouveau modèle d'utilisateur
    $objUserModel = model('user');

    // Instanciation d'un nouveau modèle de clients
    $objCustomerModel = model('customer');

    // Instanciation d'une nouvelle entité de l'objet utilisateur
    $objUser = entity('user');

    // Instanciation d'une nouvelle entité de l'objet client
    $objCustomer = entity('customer');

    // Chargement des helpers
    helper('alert');

    // Récupération des messages d'information
    $strMessage  = $_SESSION['message'] ?? '';

    // Récupération des valeurs des champs du formulaire
    $strLastname  = $_POST['lastname']  ?? '';
    $strFirstname = $_POST['firstname'] ?? '';
    $strEmail     = $_POST['email']     ?? '';
    $strPassword  = $_POST['password']  ?? '';

    // Remplissage de l'entité de l'objet utilisateur
    $objUser->setEmail($strEmail);
    $objUser->setPassword($strPassword);

    // Remplissage de l'entité de l'objet client
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
        if ($objUser->getPassword() == '') $arrErrors['password'] = lang('password_required');

        // S'il n'y a aucune erreur
        if (count($arrErrors) == 0)
        {
            // On tente d'insérer un nouvel utilisateur dans la BDD
            try {
                // Récupération de la valeur du dernier Id inséré
                $intInsertId = $objUserModel->insert($objUser, true);
            }
            catch (PDOException $e)
            {
                // Si l'adresse email existe déjà dans la BDD
                if ($e->getCode() == 23000)
                {
                    // Affichage d'un message d'avertissement
                    $_SESSION['message'] = lang('user_mail_duplicate');
                }
                // Sinon
                else
                {
                    // Affichage d'un message d'avertissement
                    $_SESSION['message'] = lang('retry_later');
                }

                // Redirection vers la page d'enregistrement
                redirect('register');
            }
            
            // Remplissage de l'entité de l'objet client
            $objCustomer->setId($intInsertId);

            // Si un nouveau client est inséré dans la BDD
            if ($objCustomerModel->insert($objCustomer))
            {
                // Message de réussite
                $_SESSION['message'] = lang('customer_created');

                // Redirection vers la page de connexion
                redirect('login');
            }
            else
            {
                // Message d'échec
                $_SESSION['message'] = lang('retry_later');
            }
        }
    }
?>

    <main class="border-top border-primary border-3 d-flex flex-column justify-content-center align-items-center">
        
        <div class="col-12 col-lg-6 col-xl-4">

            <div class="container my-5 px-lg-5">

                <form action="<?= site_url(); ?>/register.php" method="POST" class="card card-md">
                    <div class="card-body">
                        <div class="text-center mb-2">
                            <a href="<?= site_url(); ?>" class="navbar-brand navbar-brand-autodark">
                                <img src="<?= base_url(); ?>assets/img/logo.png" alt="Logo" width="100">
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
                            <input type="text" name="lastname" placeholder="Entrer votre nom" class="form-control <?php if (isset($arrErrors['lastname'])) echo 'is-invalid'; ?>" value="<?= $objCustomer->getLastname() ?>">
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" name="firstname" placeholder="Entrer votre prénom" class="form-control <?php if (isset($arrErrors['firstname'])) echo 'is-invalid'; ?>"  value="<?= $objCustomer->getFirstname() ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" name="email" placeholder="Entrer votre adresse email" class="form-control <?php if (isset($arrErrors['email'])) echo 'is-invalid'; ?>"  value="<?= $objUser->getEmail() ?>">
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
                            <button type="submit" class="btn btn-primary w-100"><?= $strTitle; ?></button>
                        </footer>
                    </div>
                </form>

                <div class="text-center small text-secondary mt-3">
                    A déjà un compte ? <a href="<?= site_url(); ?>/login.php" class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover">Se connecter</a>
                </div>

            </div>
 
        </div>

    </main><!-- .d-flex -->

<?php
    // Inclusion du pied de page
    include('_partials/footer.php');