    <!-- Icône permettant de remonter en haut de l'écran -->
    <?php include('_partials/arrowup.php'); ?>
    
    <!-- Scripts Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Scripts de l'application -->
    <?php if (isset($arrScripts)): 
        foreach($arrScripts as $arrScript): ?>
        <?= asset_link($arrScript, 'js'); ?>
    <?php endforeach; 
    endif; ?>
    <script src="<?= base_url(); ?>assets/js/script.js"></script>

</body>
</html>