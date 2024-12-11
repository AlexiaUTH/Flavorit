<nav class="navbar">
    <div class="navbar-brand me-auto">
        <a href="<?= base_url(); ?>">
            Flavor’it
        </a>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="text-white text-decoration-none" href="tel:<?= $objBakery->getPhone(); ?>"><?= $objBakery->getPhone(); ?></a>
            <i class="ms-1 bi-telephone-fill"></i>
        </li>
    </ul>
</nav><!-- .navbar -->