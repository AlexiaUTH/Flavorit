    <!-- Pied de page -->
    <footer>

        <div class="container">

            <div class="row bg-white" id="footer-top">

                <div class="col-lg-2 text-center p-5">
                    <a href="<?= site_url(); ?>" class="text-decoration-none">
                        <img src="<?= base_url(); ?>assets/img/logo.png" class="img-fluid" alt="Logo" width="90">
                        <div class="navbar-brand navbar-brand-dark">Flavor'it</div>
                    </a>
                </div><!-- .col-lg-2 -->

                <div class="col-lg-8">

                    <div class="row">

                        <div class="col-6 col-lg-4">
                            <ul class="navbar-nav my-5 mx-3">
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>" 
                                       class="nav-link <?php if ($strPage === 'index') echo 'active'; ?>">Accueil</a>
                                </li>
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>/about.php" 
                                       class="nav-link <?php if ($strPage === 'about') echo 'active'; ?>">À propos</a>
                                </li>
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>/bakery.php" 
                                       class="nav-link <?php if ($strPage === 'bakery') echo 'active'; ?>">Boulangeries</a>
                                </li>
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>/product.php" 
                                       class="nav-link <?php if ($strPage === 'product') echo 'active'; ?>">Produits</a>
                                </li>
                            </ul>
                        </div><!-- .col-lg-4 -->

                        <div class="col-6 col-lg-4">
                            <ul class="navbar-nav my-5 mx-3">
                                <li class="nav-list-item">
                                <?php if (logged_in()): ?>
                                    <a href="<?= site_url(); ?>/logout.php" 
                                       class="nav-link">Se déconnecter</a>
                                <?php else: ?>
                                    <a href="<?= site_url(); ?>/login.php" 
                                       class="nav-link <?php if ($strPage === 'login') echo 'active'; ?>">Se connecter</a>
                                <?php endif; ?>
                                </li>
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>/register.php" 
                                       class="nav-link <?php if ($strPage === 'register') echo 'active'; ?>">Créer un compte</a>
                                </li>
                            </ul>
                        </div><!-- .col-4 -->

                        <div class="col-6 col-lg-4">
                            <ul class="navbar-nav my-5 mx-3">
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>/legal.php" 
                                       class="nav-link <?php if ($strPage === 'legal') echo 'active'; ?>">Mentions légales</a>
                                </li>
                                <li class="nav-list-item">
                                    <a href="<?= site_url(); ?>/privacy.php" 
                                       class="nav-link <?php if ($strPage === 'privacy') echo 'active'; ?>">Politique de confidentialité</a>
                                </li>
                            </ul>
                        </div><!-- .col-lg-4 -->

                    </div><!-- .row -->

                </div><!-- .col-lg-8 -->

                <div class="col-lg-2 text-center text-lg-end">
                    <ul class="navbar-nav my-5">
                        <li class="nav-item pe-2">
                            <a href="#" class="nav-link"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="nav-item px-2">
                            <a href="#" class="nav-link"><i class="bi bi-linkedin"></i></a>
                        </li>
                        <li class="nav-item px-2">
                            <a href="#" class="nav-link"><i class="bi bi-youtube"></i></a>
                        </li>
                        <li class="nav-item ps-2">
                            <a href="#" class="nav-link"><i class="bi bi-instagram"></i></a>
                        </li>
                    </ul>
                </div><!-- .col-lg-2 -->

            </div><!-- .row footer-top -->
            
            <div class="row text-center" id="footer-bottom">

                <div class="col-lg-6">

                    <p class="text-lg-start mb-0 my-lg-4">
                        &copy; <?= date('Y'); ?> 
                        <a class="nav-link" href="<?= base_url(); ?>"><?= app_name(); ?></a> 
                        - Tous droits réservés.
                    </p>

                </div><!-- .col-lg-6 -->

                <div class="col-lg-6">
                    
                    <ul class="navbar-nav text-lg-end mt-0 my-lg-4">
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>/legal.php">Mentions légales</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url(); ?>/privacy.php">Politique de confidentialité</a>
                        </li>
                    </ul>

                </div><!-- .col-lg-6 -->

            </div><!-- .row .footer-bottom -->

        </div><!-- .container -->

    </footer>

    <?php 
    if ($strPage == 'showcase') {
        // Inclusion des barres verticales haut et bas
        include('_partials/verticalbars.php');
    } else {
        // Inclusion des barres verticales bas uniquement
        include('_partials/verticalbars-bottom.php');
    } ?>

    <!-- Inclusion du pied de page générique -->
    <?php include('_partials/footer.php'); ?>