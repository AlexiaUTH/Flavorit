<?php
    // Variables d'affichage
    $strTitle    = 'Administrateurs';
    $strSubtitle = 'Ajouter un administrateur';

    // Variables de fonctionnement
    $strPage = 'add_user';

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

    // Récupération des variables du formulaire
    $strEmail    = $_POST['email']        ?? '';
    $strPassword = $_POST['password']     ?? '';
    $strName     = $_POST['name']         ?? '';
    $strAddress  = $_POST['address']      ?? '';
    $intCity     = $_POST['city']         ?? 0;
    $strPhone    = $_POST['phone']        ?? '';
    $strOpening  = $_POST['openinghours'] ?? '';
    $strBakEmail = $_POST['bakemail']     ?? '';
    $strAbout    = $_POST['about']        ?? '';
    $strMaps     = $_POST['maps']         ?? '';

    // Initialisation du tableau des erreurs
    $arrErrors = array();

    // Instanciation d'une nouvelle entité de l'objet utilisateur
    $objBakery = entity('bakery');

    // Remplissage de l'objet boulangerie
    $objBakery->setName($strName);
    $objBakery->setAddress($strAddress);
    $objBakery->setPhone($strPhone);
    $objBakery->setOpeningHours($strOpening);
    $objBakery->setEmail($strBakEmail);
    $objBakery->setAbout($strAbout);
    $objBakery->setMaps($strMaps);

    // Instanciation d'une nouvelle entité de l'objet ville
    $objCity = entity('city');

    // Remplissage de l'objet ville
    $objCity->setId($intCity);

    // Instanciation d'une nouvelle entité de l'objet utilisateur
    $objUser = entity('user');

    // Remplissage de l'objet utilisateur
    $objUser->setEmail($strEmail);
    $objUser->setPassword($strPassword);

    // Instanciation d'un nouveau modèle de villes
    $objCityModel = model('city');

    // On récupère tous les enregistrements de la table `city`
    $arrCities = $objCityModel->findAll();

    // Si le formulaire a été envoyé
    if (count($_POST) > 0)
    {
        if ($objUser->getEmail() == '') 
        {
            $arrErrors['email'] = lang('email_required');
        }
        elseif (filter_var($objUser->getEmail(), FILTER_VALIDATE_EMAIL) === false) 
        {
            $arrErrors['email'] = lang('email_invalid');
        }
        if ($objUser->getPassword()  == '') $arrErrors['password'] = lang('password_required');
        if ($objBakery->getName()    == '') $arrErrors['name']     = lang('bakery_name_required');
        if ($objBakery->getAddress() == '') $arrErrors['address']  = lang('bakery_address_required');
        if ($objBakery->getPhone()   == '') $arrErrors['phone']    = lang('bakery_phone_required');
        if ($objBakery->getAbout()   == '') $arrErrors['about']    = lang('bakery_about_required');
        if ($objBakery->getMaps()    == '') $arrErrors['maps']     = lang('bakery_maps_required');
        if ($objCity->getId()        == 0)  $arrErrors['city']     = lang('city_name_required');

        // S'il n'y a aucune erreur
        if (count($arrErrors) == 0)
        {
            // Instanciation d'un nouveau modèle d'utilisateurs
            $objUserModel = model('user');

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

                // Redirection vers la page de création d'un nouvel administrateur
                redirect('add_user');
            }

            // Insertion de la boulangerie dans la BDD

            // TODO

            // Insertion de l'administrateur dans la BDD

            // TODO
        }
    }
?>

    <main class="container">

        <div class="row">

            <div class="col-lg-8 offset-lg-2">

                <h2 class="mb-0"><?= $strTitle; ?></h2>
                <h5 class="text-uppercase text-muted mb-4"><?= $strSubtitle; ?></h5>

                <?php if (count($arrErrors) > 0): ?>
                    <?= alert('error', $arrErrors); ?>
                <?php elseif ($strMessage != ''): ?>
                    <?= alert('warning', array($strMessage)); ?>
                <?php endif; ?>

                <form action="<?= site_url(); ?>/add_user.php" method="POST">
                    
                    <fieldset>

                        <legend>Idenfiants du compte</legend>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                            <input type="email" name="email" placeholder="Entrer votre adresse email" class="form-control <?php if (isset($arrErrors['email'])) echo 'is-invalid'; ?>"  value="<?= $objUser->getEmail(); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control <?php if (isset($arrErrors['password'])) echo 'is-invalid'; ?>">
                        </div>
                        
                    </fieldset>

                    <fieldset>

                        <legend>Boulangerie</legend>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="name" name="name" id="name" placeholder="Entrer le nom de la boulangerie" class="form-control <?php if (isset($arrErrors['name'])) echo 'is-invalid'; ?>" value="<?= $objBakery->getName(); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse postale <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" placeholder="Entrer l'adresse postale de la boulangerie" class="form-control <?php if (isset($arrErrors['address'])) echo 'is-invalid'; ?>"><?= $objBakery->getAddress(); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">Ville <span class="text-danger">*</span></label>
                            <select name="city" id="city" class="form-control <?php if (isset($arrErrors['city'])) echo 'is-invalid'; ?>">
                                <option value="0">-- Sélectionner une ville</option>
                                <?php foreach($arrCities as $arrCity): ?>
                                <option value="<?= (int)$arrCity['city_id']; ?>" <?php if ($arrCity['city_id'] == $objCity->getId()) echo 'selected'; ?>><?= esc($arrCity['city_zip_code'] . ' - ' . $arrCity['city_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="phone" name="phone" id="phone" placeholder="Entrer le numéro de téléphone" class="form-control <?php if (isset($arrErrors['phone'])) echo 'is-invalid'; ?>" value="<?= $objBakery->getPhone(); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="openinghours" class="form-label">Horaires d'ouverture <span class="text-danger">*</span></label>
                            <textarea name="openinghours" id="openinghours" placeholder="Entrer les horaires d'ouverture" class="form-control"><?= $objBakery->getOpeningHours(); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="bakemail" class="form-label">Adresse email</label>
                            <input type="bakemail" name="bakemail" id="bakemail" placeholder="Entrer l'adresse email de la boulangerie" class="form-control" value="<?= $objBakery->getEmail(); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="about" class="form-label">A propos <span class="text-danger">*</span></label>
                            <textarea name="about" id="about" placeholder="Entrer l'à propos" class="form-control <?php if (isset($arrErrors['about'])) echo 'is-invalid'; ?>"><?= $objBakery->getAbout(); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="maps" class="form-label">Google Maps <span class="text-danger">*</span></label>
                            <textarea name="maps" id="maps" placeholder="Entrer le code d'intégration Google Maps" class="form-control <?php if (isset($arrErrors['maps'])) echo 'is-invalid'; ?>"><?= $objBakery->getMaps(); ?></textarea>
                        </div>

                    </fieldset>

                    <footer class="py-4">
                        <button type="submit" class="btn btn-primary">Créer le compte</button>
                        <a href="<?= site_url(); ?>/list_user.php" class="btn btn-outline-dark">Annuler</a>
                    </footer>

                </form>

            </div>

        </div><!-- .row -->

    </main><!-- .container -->