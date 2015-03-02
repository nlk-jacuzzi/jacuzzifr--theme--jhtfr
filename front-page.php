<?php
/**
 * Front / Homepage template file
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
define('DONOTCACHEPAGE', true);

get_header(); ?>
    <div class="hero">

        <div class="slide9 slide" style="position: absolute; top: 0; left: 0; background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/heros/French-j-500-french.jpg);">
            <a class="slidebg" target="_blank" href="<?php echo get_stylesheet_directory_uri(); ?>/images/heros/French-j-500-french.jpg"></a>
            <div class="wrap">
                <a href="<?php echo get_bloginfo('url') ?>/j-500/" target="_blank" class="" style="display: block; position: relative; width: 200px; height: 40px; left: 116px; margin-left: -100px; top: 307px;">&nbsp;</a>
            </div>
        </div>

        <div class="slide8 slide" style="display: none;">
            <a class="slidebg" href="<?php echo get_stylesheet_directory_uri(); ?>/images/heros/j-300-fr-hero.jpg"></a>
            <div class="wrap">
                <a href="<?php echo get_bloginfo('url') ?>/the-j-300-collection/" class="" style="display: block; position: relative; width: 200px; height: 40px; left: 50%; margin-left: -100px; top: 430px;">&nbsp;</a>
            </div>
        </div>


	    <div class="slide1 slide" style="display: none;">
            <a class="slidebg" href="<?php bloginfo('template_url'); ?>/images/heros/couple-in-jacuzzi-bg.jpg"></a>
        	<div class="wrap">
            	<div class="inner">
                    <h3>D&eacute;couvrez le spa Jacuzzi<sup>MD</sup> id&eacute;al pour vous</h3>
                    <ul class="collections">
                        <li class="jlx first"><a href="<?php echo get_permalink(48) ?>">collection j-lx</a></li>
                        <li class="j400"><a href="<?php echo get_permalink(52) ?>">collection j-400</a></li>
                        <li class="j300"><a href="<?php echo get_permalink(58) ?>">collection j-300</a></li>
                        <li class="j200"><a href="<?php echo get_permalink(62) ?>">collection j-200</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="slide2 slide" style="display:none">
        	<a class="slidebg" href="<?php bloginfo('template_url'); ?>/images/heros/woman-under-water.jpg"></a>
        	<div class="wrap">
            	<div class="inner">
                	<h3>La diff&eacute;rence Jacuzzi</h3>
                    <h2><strong>100 ans</strong>  d'innovations</h2>
                    <div class="video">
                    	<p><a href="<?php echo get_permalink(3749) ?>"><img src="<?php bloginfo('template_url'); ?>/images/video-thumbs/jacuzzi-story.jpg" align="left" /> <span>L'histoire de Jacuzzi</span></a></p>
                    </div>
                    <div class="horz-white-gradient"></div>
                    <div class="video">
                    	<p><a href="<?php echo get_permalink(3805) ?>"><img src="<?php bloginfo('template_url'); ?>/images/video-thumbs/hydrotherapy.jpg" align="left" /> <span>Les raisons de l'efficacit&eacute; de l'hydroth&eacute;rapie</span></a></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="slide4 slide" style="display:none">
        	<a class="slidebg" href="<?php echo get_stylesheet_directory_uri(); ?>/images/heros/couple-in-jacuzzi-full.jpg"></a>
        	<div class="wrap">
           		<div class="inner">
                </div>
            </div>
        </div>


        <div class="slide5 slide" style="display:none">
        	<a class="slidebg" href="<?php echo get_stylesheet_directory_uri(); ?>/images/heros/family-in-jacuzzi.jpg"></a>
        	<div class="wrap">
            	<a href="<?php echo get_permalink(20) ?>" class="btn yellow-bright">Voir les spas de dimensions moyennes</a>
            </div>
        </div>
        <div class="slide6 slide" style="display:none">
        	<a class="slidebg" href="<?php echo get_stylesheet_directory_uri(); ?>/images/heros/woman-under-water-full.jpg"></a>
        	<div class="wrap">
            	<a href="<?php echo get_permalink(3805) ?>" class="btn yellow-bright">En savoir plus</a>
            </div>
        </div>
        <div class="slide7 slide" style="display:none">
            <a class="slidebg" href="<?php echo get_stylesheet_directory_uri(); ?>/images/heros/exclusiveCPa.jpg"></a>
        	<div class="wrap">
            	<a href="<?php echo get_permalink(9674) ?>" class="btn yellow-bright">Trouver un dÉtaillant</a>
            </div>
        </div>

        


    </div>
    <div class="goldBar5"></div>
    <?php get_sidebar('callouts'); ?>
    <div class="bd wrap">
    	<?php //get_sidebar('silverMenu'); ?>
        <div class="threeCol">
            <div>
                <div class="col main">
                    <?php while ( have_posts() ) : the_post();
						global $post;
						$ct = $post->post_content;
						
						$ct2 = $ct;
						
						if ( function_exists('jhtpolylangfix_contentcheck') ) {
							$ct = jhtpolylangfix_contentcheck(false);
						}
						$ct = apply_filters('the_content', $post->post_content);
						/*
						echo '<pre style="display:none">'. print_r($ct2,true) .'</pre>';
						echo '<pre style="display:none">'. print_r($ct,true) .'</pre>';
						*/
                        if( strpos($ct,'<!--more-->') ) {
                        $ct = str_replace('<!--more--></p>', '<a href="#" onclick="jQuery(this).hide().parent().next().show(); return false;"><br />Read More</a></p><div style="display:none">', $ct) .'</div>';
                        }
                        echo $ct;
                    endwhile; ?>
                </div>
            </div>
<?php get_footer(); ?>
