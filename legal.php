<?php
    // Variables d'affichage
    $strTitle = 'Mentions légales';

    // Variables de fonctionnement
    $strPage = 'legal';

    // Inclusion de l'en-tête
    include('_partials/header-page.php');

    // Inclusion de la section principale
    include('_partials/main-page.php');
?>

    <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site internet <a href="https://flavorit.fr">Flavor'it</a> l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi&nbsp;:</p>

    <ul>
        <li><strong>Propriétaire</strong>&nbsp;: SARL Boulangerie Flavor’it – 3 avenue Carnot – 70200 Lure.<br>Capital social de 40000&nbsp;€</li>
        <li><strong>Responsable publication</strong>&nbsp;: Philippe ENDERLIN – <a href="mailto:<?= app_email(); ?>"><?= app_email(); ?></a><br>Le responsable publication est une personne physique ou une personne morale.</li>
        <li><strong>Webmaster</strong>&nbsp;: Jérôme BLONDEAU – <a href="mailto:webmaster@flavorit.fr">webmaster@flavorit.fr</a></li>
        <li><strong>Hébergeur</strong>&nbsp;: IONOS SARL – 7 place de la Gare BP 70109 – 57200 Sarreguemines Cedex.<br>Tél. 0970 808 911</li>
        <li><strong>Délégué à la protection des données</strong>&nbsp;: Mohamed AZOUGAGH – <a href="mailto:<?= app_email(); ?>"><?= app_email(); ?></a></li>
    </ul>

    <h3 class="mb-0">Définitions</h3>

    <ul>
        <li><strong>Client&nbsp;:</strong> tout professionnel ou personne physique capable au sens des articles 1123 et suivants du Code civil, ou personne morale, qui visite le site objet des présentes conditions générales.</li>
        <li><strong>Prestations et Services&nbsp;:</strong> <a href="https://flavorit.fr">Flavor'it</a> met à disposition des Clients&nbsp;:</li>
        <ul>
            <li><strong>Contenu&nbsp;:</strong> ensemble des éléments constituants l’information présente sur le Site, notamment textes – images – vidéos.</li>
            <li><strong>Informations clients&nbsp;:</strong> ci-après dénommé « Information(s) » qui correspondent à l’ensemble des données personnelles susceptibles d’être détenues par <a href="https://flavorit.fr">Flavor'it</a> pour la gestion de votre compte, de la gestion de la relation client et à des fins d’analyses et de statistiques.</li>
        </ul>
        <li><strong>Utilisateur&nbsp;:</strong> internaute se connectant, utilisant le site susnommé.</li>
        <li><strong>Informations personnelles&nbsp;:</strong> « Les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).</li>
        <li>Les termes « données à caractère personnel », « personne concernée », « sous traitant » et « données sensibles » ont le sens défini par le Règlement Général sur la Protection des Données (RGPD&nbsp;: n°&nbsp;2016-679).</li>
    </ul>

    <p class="text-muted">
        <small><em>Ce modèle de mentions légales est proposé par le <a href="https://fr.orson.io/1371/generateur-mentions-legales" title="générateur gratuit offert par Orson.io">générateur gratuit offert par Orson.io</a>.</em></small>
    </p>

<?php
    // Inclusion du pied de page
    include('_partials/footer-page.php');