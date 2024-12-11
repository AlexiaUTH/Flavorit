<?php
    // Variables d'affichage
    $strTitle = 'À propos';

    // Variables de fonctionnement
    $strPage = 'about';

    // Inclusion de l'en-tête
    include('_partials/header-page.php');

    // Inclusion de la section principale
    include('_partials/main-page.php');
?>

    <div class="row">
        <div class="col-lg-6">
            <p><a href="<?= site_url(); ?>">Flavor’it</a> vous permet de découvrir les saveurs des produits d’artisans locaux présents sur notre territoire. En effet, notre plateforme vous met en relation avec nos boulangeries partenaires via une page vitrine vous présentant leurs produits.</p>
            <p>Des boulangeries vous proposant des produits locaux et biologiques prêtant une attention particulière à la sélection des ingrédients.</p>
        </div>
        <div class="col-lg-6">
            <img src="<?= base_url(); ?>assets/img/banner.jpg" class="img-fluid" alt="Illustration">
        </div>
    </div>

    <p>Aussi, <a href="<?= site_url(); ?>">Flavor’it</a> et ses partenaires s’efforcent de minimiser leur empreinte environnementale en adoptant des pratiques de production respectueuses de l’environnement, en favorisant la réutilisation et le recyclage.
    En outre, nous sommes fiers de soutenir les agriculteurs locaux et les petites entreprises, contribuant ainsi à la vitalité économique de notre belle région.</p>

    <p>Notre plateforme vous permet de choisir des produits élaborés avec la plus grande attention et le plus grand soin. Vous y trouverez différentes sortes de pain : le pain et la baguette de tradition, celui aux 5 céréales, le pain au levain, le complet ainsi que celui de campagne&hellip;</p>

    <p>Vous pourrez composer un petit déjeuner rêvé avec toute une sélection de viennoiseries dont pain au chocolat, croissant, pain aux raisins, chausson aux pommes, brioche au sucre et nature.</p>

    <p>Si vous souhaitez céder à la gourmandise, nous et nos boulangeries vous proposons des pâtisseries confectionnées avec talent par nos pâtissiers ; vous y trouverez éclairs, millefeuilles, tartelette au citron, à la fraise, fondant au chocolat, macarons, Paris-Brest, tropézienne, profiterole et plein d’autres délices.</p>

    <p>Une fois vos produits choisis, vous avez la possibilité de les ajouter à vos <strong>&laquo;&nbsp;Flavor’it&nbsp;&raquo;</strong> !</p>

<?php
    // Inclusion du pied de page
    include('_partials/footer-page.php');