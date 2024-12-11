<!-- Menu Popover -->
<div id="menu" class="popover">
    <a href="#" class="close">
        <i class="bi bi-x-lg"></i>
    </a>
    <ul class="navbar-nav me-auto">
        <li class="nav-list-item text-start">
            <a href="<?= site_url(); ?>/index.php" 
                class="nav-link <?php if ($strPage == 'index') echo 'active'; ?>">
                Accueil
            </a>
        </li>
        <li class="nav-list-item">
            <a href="<?= site_url(); ?>/about.php" 
                class="nav-link <?php if ($strPage == 'about') echo 'active'; ?>">
                À propos
            </a>
        </li>
        <li class="nav-list-item">
            <a href="<?= site_url(); ?>/bakery.php" 
                class="nav-link <?php if ($strPage == 'bakery') echo 'active'; ?>">
                Boulangeries
            </a>
        </li>
        <li class="nav-list-item">
            <a href="<?= site_url(); ?>/product.php" 
                class="nav-link <?php if ($strPage == 'product') echo 'active'; ?>">
                Produits
            </a>
        </li>
        <li class="nav-list-item">
            <a href="mailto:<?= app_email(); ?>" class="nav-link">
                Contact
            </a>
        </li>
    </ul>
</div><!-- .popover -->

<nav class="navbar">
    <div class="navbar-brand d-block d-lg-none">
        <a href="#menu">
            <i class="bi bi-list"></i>
        </a>
    </div>
    <div class="navbar-brand mx-auto d-block d-lg-none">
        <a href="<?= base_url(); ?>">
            Flavor’it
        </a>
    </div>
    <div class="navbar-brand me-auto d-none d-lg-block">
        <a href="<?= base_url(); ?>">
            Flavor’it
        </a>
    </div>
    <ul class="navbar-nav ms-lg-auto ms-0">
        <li class="nav-item d-none d-lg-inline-block">
            <a href="<?= site_url(); ?>/index.php" 
                class="nav-link <?php if ($strPage == 'index') echo 'active'; ?>">
                Accueil
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline-block">
            <a href="<?= site_url(); ?>/about.php" 
                class="nav-link <?php if ($strPage == 'about') echo 'active'; ?>">
                À propos
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline-block">
            <a href="<?= site_url(); ?>/bakery.php" 
                class="nav-link <?php if ($strPage == 'bakery') echo 'active'; ?>">
                Boulangeries
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline-block">
            <a href="<?= site_url(); ?>/product.php" 
                class="nav-link <?php if ($strPage == 'product') echo 'active'; ?>">
                Produits
            </a>
        </li>
        <li class="nav-item d-none d-lg-inline-block">
            <a href="mailto:<?= app_email(); ?>" class="nav-link">
                Contact
            </a>
        </li>
        <li class="nav-item mx-0 mx-lg-auto">
            <?php if (logged_in()): ?>
                <span class="ms-3 d-none d-lg-inline-block">
                    <em>Bonjour, <?= $_SESSION['firstname'] ?? ''; ?></em>
                </span>
                <a href="<?= site_url(); ?>/logout.php" class="ms-2 nav-link">
                <i class="bi bi-box-arrow-left" title="Se déconnecter"></i>
            <?php else: ?>
                <a href="<?= site_url(); ?>/login.php" class="nav-link">
                <i class="bi bi-person-circle" title="Se connecter"></i>
            <?php endif; ?>
            </a>
        </li>
    </ul>
</nav><!-- .navbar -->