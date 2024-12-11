<main class="bg-white">

    <section>

        <div class="container">

            <div class="row">

            <?php if (!in_array($strPage, array('bakery', 'product'))): ?>

                <div class="col-lg-8 offset-lg-2">
                    
            <?php endif; ?>
        
            <!-- Breadcrumb -->
            <?php include('_partials/breadcrumb.php'); ?>
            
            <?php 
                // S'il s'agit de la page `produits`
                if ($strPage == 'product'): 
            ?>
                
                <?php if (isset($_GET['bakid']) && $_GET['bakid'] > 0): ?>
                
                    <h2 class="mb-4">Produits de <?= esc($arrBakery['bak_name']); ?></h2>
                
                <?php elseif (is_user() && isset($_SESSION['bakid']) && $_SESSION['bakid'] > 0): ?>
                    
                    <h2>Produits de votre boulangerie préférée</h2>
                    <h3><?= esc($arrBakery['bak_name']); ?></h3>

                <?php else: ?>
                
                    <h2 class="mb-4">Produits des boulangeries partenaires</h2>
                
                <?php endif; ?>
        
            <?php else: ?>

                <h2 class="mb-4"><?= $strTitle; ?></h2>

            <?php endif; ?>