<?php
/**
 * Template Name: Form Page - Buyers Guide (Hero Form)
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero buyersguide2">
    	<div class="wrap">
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/brochure/hot-tub-buyers-guide.png"/>
            <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">
                <span class="formtitle">Téléchargez maintenant une brochure gratuite</span>
                <?php avala_hidden_fields( 36, 9, 20 ); ?>
                <table width="320">
                    <tr>
                        <td>
                            <?php avala_field('first_name', 'text', true, 'field', array('placeholder'=>"Prénom *", 'required'=>"required" ), false, 'Prénom'); ?>
                        </td>
                        <td>
                            <?php avala_field('last_name', 'text', true, 'field', array('placeholder'=>"Nom *", 'required'=>"required" ), false, 'Nom'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php avala_field('postal_code', 'text', true, 'field', array('size'=>"7", 'placeholder'=>"Code postal *",'required'=>"required" ), false, 'Code postal'); ?>
                        </td>
                        <td>
                            <?php avala_field('email', 'text email', true, 'field', array('placeholder'=>"Courriel *", 'required'=>"required" ), false, 'Courriel'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php avala_field('phone', 'text', false, 'field', array('size'=>"11", 'placeholder'=>"Téléphone" ), false, 'Téléphone'); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="dropdowns">
                            <span class="thefield"><?php avala_field('product_use_fr', '', false, 'all', '', 'select', 'Quel avantage vous attire le plus dans un spa?', 'Choisir'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="buttonarea">
                            <input type="submit" value="Téléchargez maintenant" class="sprite" onClick="if(typeof(_vis_opt_top_initialize) == 'function') { _vis_opt_goal_conversion(200); }; _gaq.push(['_trackEvent', 'lead', 'buyers-guide']);" />
                            <p class="requiredtext">* Champ obligatoire</p>
                            <p class="privacytext">La protection de votre vie privée est très importante pour nous. Nous ne louons et ne vendons en aucun cas vos renseignements personnels; <a href="<?php echo get_bloginfo('url'); ?>/about/policies/">voir notre politique de confidentialité.</a></p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <?php 
                the_content(); // hardcoded?
                ?>
            </div>
        </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>

