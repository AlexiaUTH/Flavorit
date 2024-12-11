<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= site_url(); ?>">Accueil</a>
        </li>
        <?php if (isset($_GET['bakid']) && $_GET['bakid'] > 0): ?>
        <li class="breadcrumb-item">
            <a href="<?= site_url(); ?>/showcase.php?bakid=<?= intval($_GET['bakid']); ?>"><?= esc($arrBakery['bak_name']); ?></a>
        </li>
        <?php endif; ?>
        <li class="breadcrumb-item active" aria-current="page">
            <?= $strTitle; ?>
        </li>
    </ol><!-- .breadcrumb -->
</nav>