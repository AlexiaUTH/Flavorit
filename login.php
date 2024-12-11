<?php
    // Variables d'affichage
    $strTitle = 'Se connecter';

    // Variables de fonctionnement
    $strPage = 'login';

    // Inclusion de l'en-tête
    include('_partials/header-auth.php');

    // Instanciation d'un nouveau modèle d'utilisateurs
    $objUserModel = model('user');

    // Instanciation d'une nouvelle entité de l'objet utilisateur
    $objUser = entity('user');

    // Chargement des helpers
    helper('picsum');
    
    // Récupération des messages d'information
    $strMessage  = $_SESSION['message'] ?? '';

    // Récupération des valeurs des champs du formulaire
    $strEmail    = $_POST['email']     ?? '';
    $strPassword = $_POST['password']  ?? '';

    // Remplissage de l'entité de l'objet utilisateur
    $objUser->setEmail($strEmail);
    $objUser->setPassword($strPassword);

    // Initialisation du tableau des erreurs
    $arrErrors = array();

    // Si le formulaire est envoyé
    if (count($_POST) > 0)
    {
        // Gestion des messages d'erreur du formulaire
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
            // Récupération des informations de l'utilisateur
            $arrUser = $objUserModel->findByMail($objUser, true);

            // S'il y a un utilisateur correspondant dans la BDD
            if ($arrUser)
            {
                // Remplissage de l'entité de l'objet utilisateur
                $objUser->setId($arrUser['user_id']);
                $objUser->setRole($arrUser['user_role']);
                
                // Si le mot du passe renseigné et celui de la BDD correspondent
                if (password_verify($objUser->getPassword(), $arrUser['user_pwd']))
                {
                    // // On crée de nouvelles variables de session
                    $_SESSION['userid'] = $objUser->getId();
                    $_SESSION['email']  = $objUser->getEmail();
                    $_SESSION['role']   = $objUser->getRole();

                    // Instanciation d'un nouveau modèle de clients
                    $objCustomerModel = model('customer');

                    // On récupère les informations du client
                    $arrCustomer = $objCustomerModel->find($objUser);

                    // S'il existe un client dans la BDD
                    if ($arrCustomer) {
                        // On crée de nouvelles variables de session
                        $_SESSION['lastname']  = $arrCustomer['user_lastname'];
                        $_SESSION['firstname'] = $arrCustomer['user_firstname'];
                    }

                    // Instanciation d'un nouveau modèle d'administrateurs
                    $objAdminModel = model('admin');

                    // On récupère les informations de l'administrateur
                    $arrAdmin = $objAdminModel->find($objUser);

                    // On enregistre le statut de l'administrateur dans une variable
                    $boolActive = $arrAdmin['user_active'] ?? 0;

                    // Si l'utilisateur est un administrateur et que son compte est inactif
                    if (is_admin() && $boolActive == 0)
                    {
                        // On affiche un message d'avertissement
                        $_SESSION['message'] = lang('admin_inactive');

                        // Et on le déconnecte
                        redirect('logout');
                    }
                    // Sinon
                    else 
                    {
                        // On enregistre le statut de l'administrateur dans la session
                        $_SESSION['active'] = $boolActive;
                    }

                    // Message informant l'utilisateur de la réussite de sa connexion
                    $_SESSION['message'] = lang('login');

                    // Si l'utilisateur est un administrateur ou un superadministrateur
                    if (is_admin() || is_superadmin())
                    {
                        // On créé une nouvelle variable de session pour l'Id de la boulangerie
                        $_SESSION['bakid'] = $arrAdmin['user_bak_id'];

                        // Redirection vers le tableau de bord
                        redirect('dashboard');
                    }
                    // Sinon
                    else
                    {
                        // Instanciation d'un nouvel objet
                        $objCustomerbakeryModel = model('customerbakery');

                        // Récupération des favoris de la base de données
                        $arrCustomerbakery = $objCustomerbakeryModel->find();

                        // Si le tableau des favoris n'est pas vide 
                        if ($arrCustomerbakery)
                        {
                            // On créé une nouvelle variable de session pour l'Id de la boulangerie favorite
                            $_SESSION['bakid'] = $arrCustomerbakery['cb_bak_id'];
                        }

                        // Redirection vers la page d'accueil
                        redirect('index');
                    }   
                }
                // Sinon
                else
                {
                    // On affiche un message d'erreur
                    $arrErrors['error'] = lang('credentials_invalid');
                }
            }
            // Sinon
            else
            {
                // On affiche un message d'erreur
                $arrErrors['error'] = lang('credentials_invalid');
            }
        }
    }
?>

    <main class="row g-0">
        
        <div class="col-12 col-lg-6 col-xl-4 border-3 border-top border-primary d-flex d-flex-column justify-content-center align-items-center">

            <div class="container my-5 px-lg-5">

                <div class="text-center mb-2">
                    <a href="<?= site_url(); ?>" class="navbar-brand navbar-brand-autodark">
                        <img src="<?= base_url(); ?>assets/img/logo.png" alt="Logo" width="100">
                    </a>
                </div>
                
                <h2 class="h4 text-center mb-3"><?= $strTitle; ?></h2>

                <?php if (count($arrErrors) > 0): ?>
                    <?php alert('error', $arrErrors); ?>
                <?php elseif ($strMessage != ''): ?>
                    <?php alert('warning', array($strMessage)); ?>
                <?php endif; ?>
                
                <form action="<?= site_url(); ?>/login.php" method="POST">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" name="email" placeholder="votre@email.com" class="form-control <?php if (isset($arrErrors['email'])) echo 'is-invalid'; ?>" value="<?= $objUser->getEmail(); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <!--<span class="float-end">
                            <a href="<?= site_url(); ?>/forgot.php" class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover">Mot de passe oublié</a>
                        </span>-->
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control <?php if (isset($arrErrors['password'])) echo 'is-invalid'; ?>" >
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
                
                </form>

                <div class="text-center small text-secondary mt-3">
                    Pas encore de compte ? <a href="<?= site_url(); ?>/register.php" class="link-primary link-underline-opacity-0 link-underline-opacity-100-hover">S’enregistrer</a>
                </div>

            </div>

        </div><!-- .col-lg-6 -->

        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block" 
             style="background-image: url('https://picsum.photos/id/<?= random_picsum_id(); ?>/1200/800'); background-size: cover; height: 100vh;">
        </div><!-- .col-lg-6 -->

    </main><!-- .row -->

<?php
    // Inclusion du pied de page
    include('_partials/footer.php');