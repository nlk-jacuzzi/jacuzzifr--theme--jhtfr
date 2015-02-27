<?php
/*
 * Template Name: Warranty Registration
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];

?>
    <div class="hero">
        <div class="wrap">
            <div class="inner">
                <h1><span class="gold">Enregistrement de la garantie</span></h1>
                <p>Registering your hot tub will expedite communications with Jacuzzi Hot Tubs and will enable us to send you important updates and special offers.</p>
            </div>
            <!--div class="sign-up ">
                <p><span>sign Up</span> to receive water maintenance tips and special savings coupons!<a class="goldButton-240" id="ReceiveSavings">Receive Savings</a><a class="closethis" id="CLOSEX">CLOSE X</a></p>
                <?php gravity_form('Receive Savings', false, false, false, '', false); ?>
            </div-->
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap warranty">
            <div class="twoCol">
                <div class="side">
                	<?php
					if ( isset($pageopts['menu']) ) {
						$mid = absint($pageopts['menu']);
						if ( $mid > 0 ) {
							wp_nav_menu(array('menu'=>$mid));
						}
					}
                    //wp_nav_menu(array('theme_location'=>'trademark'));
					if ( isset($pageopts['b']) ) if ( $pageopts['b'] == 'Yes' ) get_sidebar('freeBrochure');
                    if ( isset($pageopts['q']) ) if ( $pageopts['q'] == 'Yes' ) get_sidebar('requestQuote');
                    if ( isset($pageopts['t']) ) if ( $pageopts['t'] == 'Yes' ) get_sidebar('tradeIn');
                    if ( isset($pageopts['n']) ) if ( $pageopts['n'] == 'Yes' ) get_sidebar('contactNumber');
					?>
                </div>
                <div class="main">
					<?php
if ( function_exists('jhtpolylangfix_contentcheck') ) {
	jhtpolylangfix_contentcheck();
} else {
	the_content(); // hardcoded?
} ?>
                </div>
            </div>
            <div class="splitrow4">
                <div href="<?php echo get_site_url(); ?>/warranty-registration/" class="manuals active"><h3>Enregistrement de la garantie</h3><p><a href="<?php echo get_site_url(); ?>/warranty-registration/"><img src="/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" width="20" height="20" title="Warranty Registration"/></a>Essential information for owners</p></div>
                <div href="<?php echo get_site_url(); ?>/owners-corner/water-maintenance/" class="watermaint"><h3>Entretien de l'eau</h3><p><a href="<?php echo get_site_url(); ?>/owners-corner/water-maintenance/"><img src="/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" width="20" height="20" title="Water Maintenance"/></a>Keep your water sparkeling with genuine Jacuzzi parts!</p></div>
                <div href="<?php echo get_site_url(); ?>/owners-corner/accessories/" class="htaccessories"><h3>Accessoires de spas</h3><p><a href="<?php echo get_site_url(); ?>/owners-corner/accessories/"><img src="/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" width="20" height="20" title="Accessories"/></a>Enrich your enjoyment with accessories from Jacuzzi</p></div>
                <div href="<?php echo get_site_url(); ?>/owners-corner/hot-tub-maintenance/" class="htmaint"><h3>Entretien du spa</h3><p><a href="<?php echo get_site_url(); ?>/owners-corner/hot-tub-maintenance/"><img src="/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" width="20" height="20" title="Hot Tub Maintenance"/></a>Maintain your hot tub with genuine Jacuzzi parts</p></div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
