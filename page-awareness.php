<?php
/**
 * Template Name: Awareness FR
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header('awareness');
?>

<script type="text/javascript">
    //$('<div />', {id:'TB_window'}).appendTo('body').css({backgroundColor:'red'});
    jQuery('.aware-img').on("click", function(){
        jQuery('#TB_window').ready(function() {
            jQuery('#TB_window').scrollTop(700);
        });
    });
</script>
    <div class="hero">
    	<div class="wrap">
            <!--<h1 class="title"></h1>-->
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
                <div><h1 class="awareness-title">3 raisons pour lesquelles vous adorerez votre spa Jacuzzi<sup>MD</sup></h1></div>
                <div class="aware-rows">
                    <div class="aware-row aware-row1">
                        <div class="aware-row-left">
                            <h2 class="awareness-h2">1. Se rapprocher de sa famille et de ses amis</h2>
                            <h3 class="awareness-h3">Améliorer ses relations avec son conjoint, ses enfants et ses amis</h3>
                            <p>"Le téléphone cellulaire et les autres distractions n’ont pas leur place dans un spa. Nous nous retrouvons l’un avec l’autre et pouvons ainsi avoir de vraies conversations."<br />
                            <b>- Nicole MacKenzie</b></p>
                        </div>

                        <div class="aware-row-right aware-img1">
                            <a class="aware-img thickbox" href="http://www.youtube.com/embed/G8zHFlpW_1o?rel=0&amp;KeepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=600" >
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/pic-top.jpg" />
                            </a>
                        </div>
                    </div>
                    <div class="aware-row aware-row2">
                        <div class="aware-row-left">
                            <h2 class="awareness-h2">2. Mieux se sentir physiquement</h2>
                            <h3 class="awareness-h3">Réduire les douleurs</h3>
                            <p>"La chaleur favorise la circulation et l’influx nerveux; elle vous aide à vous sentir mieux."<br /><b>- Dr. James Andrews, chirurgien orthopédique renommé et ancien président de la American Orthopedic Society for Sports Medicine</b></p>
                        </div>

                        <div class="aware-row-right aware-img2">
                            <a class="aware-img thickbox" href="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/Hydro_Infographic_FR.jpg" >
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/pic-middle.jpg" />
                            </a>
                        </div>
                    </div>
                    <div class="aware-row aware-row3">
                        <div class="aware-row-left">
                            <h2 class="awareness-h2">3. Se relaxer</h2>
                            <h3 class="awareness-h3">Éliminer le stress et les tensions</h3>
                            <p><b>Bruce Becker, MD et professeur à la Washington State University, a récemment étudié les effets de l’eau chaude sur les adultes en santé :</b></p>
                            <p>&bull; Après environ 24 minutes, on constate dans le système nerveux central du sujet des modifications lui permettant d’être plus détendu et concentré.</p>
                            <p>&bull; D’autres études indiquent qu’il y a diminution de la dépression et de l’anxiété et une amélioration du sommeil. En 1999, une étude a démontré que les femmes qui avaient pris un bain de 20 à 30 minutes s’endormaient plus facilement et avaient un sommeil de meilleure qualité.</p>
                        </div>

                        <div class="aware-row-right aware-img3">
                            <a class="aware-img thickbox" href="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/Jacuzzi-Hot-Tub-InfographicFR.jpg" >
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/awareness/pic-bottom.jpg" />
                            </a>
                        </div>
                    </div>                    
                </div>
                <div class="aware-side">
                    <?php get_sidebar('awareness'); ?>
                </div>
        
<?php get_footer('awareness'); ?>
