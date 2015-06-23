<?php
/**
 * Template Name: Request Pricing A
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */


//avala_form_submit();

$new_post = false;

if( isset($_GET['tid']) ) {
    $new_post = get_post( $_GET['tid'] );
    $custom = get_post_meta($new_post->ID,'jht_info');
    $jht_info = $custom[0];
}

//$avala_tub_default = false;
$avala_tubs_array = avala_args('product_id_list');

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero request-pricing">
        <div class="wrap">
            <?php // empty hero area ?>
        </div>
    </div>
    
    <div class="bd request-pricing">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main request-pricing">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <p>Veuillez simplement remplir ce formulaire pour obtenir le prix du spa idéal pour vous. Le distributeur Jacuzzi accrédité de votre région communiquera avec vous afin de vous renseigner sur les modèles offerts, leur prix et les soldes actuellement en vigueur dans votre secteur.<br><br>*Champ obligatoire.</p>
					<?php echo do_shortcode('[gravityform id="11" name="Sans obligation de prix" title="false" description="false"]'); ?>
					<p class="note"><a href="<?php echo get_permalink(3987) ?>">Politique de confidentialité</a></p>
                </div>
                <script type="text/javascript">
                (function($){
                    var str = "<?php echo get_the_title($new_post->ID); ?>";
                    var sel = str.replace(/[^a-z0-9\-]/gi, '');
                    var opt = $('.avalaFieldProductId option').filter(function () { return $(this).html() == sel; }).val();
                    $('.avalaFieldProductId option[value="'+opt+'"]').attr('selected', 'selected');
                })(jQuery);
                </script>
                <div class="side">
                    <?php // Dynamic images would go here based on product coming in from 
                    if (class_exists('MultiPostThumbnails') && $new_post) {
                        echo '<p style="font-size: 24px;margin-bottom: .5em;margin-top: -68px;font-family: \'GSBQ\';">' . get_the_title($new_post->ID) . '</p>';
                        $the_img = MultiPostThumbnails::the_post_thumbnail('jht_tub', 'three-quarter', $new_post->ID, 'large');
                        echo '<p class="request-pricing_tub-seo" style="font-size: 24px;margin-top: 10px;font-family: \'GSBQ\';">' . esc_attr($jht_info['topheadline']) . '</p>';
                    }
                    else { ?>
                        <p style="font-size: 24px;margin-bottom: .5em;margin-top: -68px;font-family: 'GSBQ';"></p>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote/RequestQuoteDefaultTubs.png" />
                    <?php } ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
