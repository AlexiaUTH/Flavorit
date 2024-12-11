    <!-- Messages d'alerte -->
    <div class="alert alert-<?= $strClass ?> alert-dismissible fade show" role="alert">
        <?php foreach($arrMessages as $strMessage): ?>
        <div><?= esc($strMessage); ?></div>
        <?php endforeach ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>