<?php
/**
 * Template Name: Jacuzzi Brochure (one page)
 *
 * @package JHT
 * @subpackage JHTFR
 * @since JHT 1.0
 */

avala_form_submit();

wp_enqueue_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:400,900');

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post();

?>
<div id="main-wrapper">
	<div class="page-header" id="page-header">
    	<div class="content center ab-b">
        	<div class="block span1of1">
            	<h1><strong class="small">BROCHURE DE JACUZZI HOT TUBS </strong>25 pages de faits et de photos - <strong>BROCHURE GRATUITE</strong></h1>
                <h2>Ayez instantan&eacute;ment acc&egrave;s &agrave; des tableaux de comparaison, &agrave; de superbes photos, &agrave; toutes les sp&eacute;cifications et descriptions des produits.</h2>
            </div>
            <form action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" method="post" id="leadForm" class="pform bro"><?php avala_hidden_fields( 35, 9, 12 ); ?>

                <span class="errors"><?php
                global $wp_query;
                $errors = false;
                if(isset($wp_query->query_vars['jht_formerrors']) && ( count($wp_query->query_vars['jht_formerrors']) > 0) ) {
                	foreach( $wp_query->query_vars['jht_formerrors'] as $err ) {
                		echo "$err<br />";
                	}
                }
                ?></span>

                <table width="870">
                    <tr>
                        <td width="490" style="vertical-align: top">
                            <table width="580">
                                <tr>
                                    <td width="270">
                                        <?php avala_field('first_name', 'text full', true, 'field', array('size'=>"14", 'placeholder'=>"Pr&eacute;nom *", 'required'=>"required" )); ?>
                                    </td>
                                    <td width="270">
                                        <?php avala_field('last_name', 'text full', true, 'field', array('size'=>"15", 'placeholder'=>"Nom *", 'required'=>"required" )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            $geo = geo_data();
                                            $geoa = $geo['country'];
                                            $geob = ( strpos($_SERVER['HTTP_HOST'], '.ca') ) ? true : false ;
                                            avala_field('postal_code', 'text full', true, 'field', array('size'=>"7", 'placeholder'=>'Code postal *', 'required'=>"required" )); ?>
                                    </td>
                                    <td>
                                        <?php avala_field('email', 'text full email', true, 'field', array('size'=>"20", 'placeholder'=>"Courriel *", 'required'=>"required" )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table rel="threeRow">
                                            <tr>
                                                <td width="200">
                                                    <span class="thefield"><?php avala_field('currently_own', '', false, 'all', '', 'select', 'Avez-vous d&eacute;j&agrave; poss&eacute;d&eacute; un spa?', 'Choisir :'); ?></span>
                                                </td>
                                                <td width="200">
                                                    <span class="thefield"><?php avala_field('buy_time_frame', '', false, 'all', '', 'select', 'Quand pensez-vous faire l\'achat d\'un spa?', 'Choisir :'); ?></span>
                                                </td>
                                                <td width="200">
                                                    <span class="thefield"><?php avala_field('product_use', '', false, 'all', '', 'select', 'Quel avantage vous attire le plus dans un spa?', 'Choisir :'); ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                            </table>
                        </td>
                        <td width="271" style="padding: 30px 0 0 10px;">
                            <input type="submit" value="T&eacute;l&eacute;charger" class="bigGoldBtn taller" onClick="_gaq.push(['_trackEvent', 'lead', 'brochure-full']);" style="max-width: 184px;" />
                            <p><small><i>* Champ obligatoire</i></small></p>
                            <a id="click-me-spot" name="more-info"></a>
                        </td>
                    </tr>
                </table>
            </form>
            <a id="click-me-anchor" href="#more-info"></a>

                <script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("analytics", {dedup:"1",domainId:"1183768",type:"1",revenue:"250",actionid:"28343"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/analytics.html?dedup=1&domainId=1183768&type=1&revenue=250&actionid=28343" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe></noscript>

        </div>
    </div>
    <section class="section">
    	<div class="content" role="main">
            <article class="row swap">
                <div class="col span1of2 normalize middle">
                    <h2>Comparez facilement les mod&egrave;les de spas entre eux</h2>
                    <ul>
                    	<li>Trouvez le spa qui vous convient le mieux</li>
                        <li>Choisissez les dimensions, caract&eacute;ristiques et options</li>
                        <li>Servez-vous-en comme guide – vous pourrez tout y trouver</li>
                    </ul>
                </div>
                <div class="block span1of2 middle">
                    <div class="overflow-left-2of3">
                        <figure class="align-right">
                            <div class="img span1of1">
                           	 <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/easily_compare_models.jpg" alt="" />
                            </div>
                        </figure>
                    </div>
                </div>
            </article>
        	<article class="row">
            	<div class="col span1of2 normalize middle">
                    <h2>D&eacute;couvrez les bienfaits de l'hydroth&eacute;rapie</h2>
                    <ul>
                    	<li>R&eacute;duit le stress et am&eacute;liore le sommeil</li>
                        <li>Soulage la douleur gr&acirc;ce &agrave; l'action cibl&eacute;e des jets</li>
                        <li>Procure une exp&eacute;rience d'hydromassage sur mesure</li>
                    </ul>
				</div>
                <div class="block span1of2 middle">
                	<div class="overflow-right-1of2">
                        <figure class="span1of1">
                            <div class="img">
                            	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/learn_about_the_power.jpg" alt="" />
                            </div>
                        </figure>
                	</div>
                </div>
			</article>
            <article class="row swap">
                <div class="col span1of2 normalize middle">
                    <h2>Voyez comme il est facile de poss&eacute;der un spa Jacuzzi et d'en profiter</h2>
                    <ul>
                    	<li>Une eau plus propre avec moins de produits chimiques</li>
                        <li>Un entretien sans soucis</li>
                        <li>Des composants &eacute;conerg&eacute;tiques int&eacute;gr&eacute;s</li>
                    </ul>
                </div>
                <div class="block span1of2 middle">
                    <div class="overflow-left-2of3">
                        <figure class="align-right">
                            <div class="img span1of1">
                           	 <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/see_how_easy.jpg" alt="" />
                            </div>
                        </figure>
                    </div>
                </div>
            </article>
            <article class="row awards">
                <div class="col span1of1">
                	<h3>Prix et r&eacute;putation<img src="<?php bloginfo('template_url'); ?>/images/landing/brochure-awards.jpg" alt="Awards" class="alignright" /></h3>
                </div>
            </article>
            <article class="row grad">
                <div class="col span1of2 normalize middle">
                    <img src="<?php bloginfo('template_url'); ?>/images/landing/edward.jpg" alt="Edward Aleman, Jacuzzi Hot Tub Owner" class="alignleft" width="45" height="45" /><blockquote>&laquo;&Agrave; mesure que nous faisions nos recherches... Jacuzzi &eacute;tait le nom qui revenait sans cesse. La qualit&eacute; du produit surpassait celle de toutes les autres marques, et c'est ce qui comptait pour moi.&raquo; <strong class="by">Edward Aleman, propri&eacute;taire d'un spa Jacuzzi</strong></blockquote>
                </div>
                <div class="col span1of2 normalize middle">
                    <img src="<?php bloginfo('template_url'); ?>/images/landing/10yearwarranty.jpg" alt="10 Year Warranty" class="alignleft" /><h3>Fiez-vous &agrave; la protection que vous offre notre garantie compl&egrave;te</h3>
                    <p>Jacuzzi r&eacute;pond de ses produits en offrant des garanties compl&egrave;tes et un r&eacute;seau international de distributeurs agr&eacute;&eacute;s.</p>
                </div>
            </article>
            <article class="row grad lastbro">
                <div class="col span1of1">
                	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/bottom_brochure_fr.png" alt="Brochure" class="alignleft brochure" />
                    <h3>25 pages de faits et de photos</h3>
                    <span>D&eacute;couvrez pourquoi Jacuzzi<sup>MD</sup> est le nom qui d&eacute;finit ce que vous attendez d'un spa : des produits performants qui mettent &agrave; profit la capacit&eacute; de l'eau &agrave; vous d&eacute;tendre et &agrave; vous &eacute;nergiser. </span>
                    <a href="#download" class="btn alignright">T&eacute;l&eacute;charger maintenant</a>
                </div>
            </article>
		</div>
    </section>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>