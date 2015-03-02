<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
 
?>
        <div class="aware-foot">
            <div class="aware-rows">
                <div class="aware-row">
                    <div class="aware-row-left">
                        <img id="aware-foot-pic1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/new-tubs-advice-pic.jpg">
                        <a id="aw-btn-1" class="aware-btn" href="<?php echo get_bloginfo('url'); ?>/dealer-locator/">TROUVER UN DÉTAILLANT</a>
                    </div>
                    <div class="aware-row-right">
                        <img id="aware-foot-pic2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/find-the-tub-for-you-pic.jpg">
                        <a id="aw-btn-2" class="aware-btn" href="<?php echo get_bloginfo('url'); ?>/collections/">VOIR LES COLLECTIONS DE SPAS</a>
                    </div>
                </div>
            </div>
            <div class="aware-side">
                <div class="aware-right-sidebar">
                    <img id="aware-foot-pic3" src="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/most-popular-tubs-pic.jpg">
                    <a id="aw-btn-3" class="aware-btn" href="<?php echo get_bloginfo('url'); ?>/best-selling-hot-tubs/">VOIR LES SPAS LES PLUS POPULAIRES</a>
                </div>
            </div>
        </div>

    </div><!-- wrap -->
</div><!-- bd -->
    <div class="hd">
        <div class="wrap">
            <a href="<?php bloginfo('url'); ?>" class="logo">Jacuzzi</a>
            <div class="aware-logo">There's Only One</div>
        </div>
    </div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
    <?php

    /* Always have wp_footer() just before the closing </body>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to reference JavaScript files.
     */

    wp_footer();
?>

</body>
</html>
