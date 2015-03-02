<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
get_header();
while ( have_posts() ) : the_post();

global $post;
/*
$custom = get_post_meta($post->ID,'jht_quickinfo');
$jht_tub_quickinfo = $custom[0];
echo '<pre style="display:none" title="quickinfo">'. print_r($jht_tub_quickinfo,true) .'</pre>';
*/
$custom = get_post_meta($post->ID,'jht_info');
$jht_info = $custom[0];
$custom = get_post_meta($post->ID,'jht_colors');
$jht_colors = $custom[0];
// array(66,68,70...) -> so process it
$o = array();

$args = array( 'numberposts' => -1, 'post_type'=>'jht_color', 'include' => $jht_colors, 'orderby' => 'menu_order', 'order' => 'ASC' );
$thesecolors = get_posts($args);

foreach ( $thesecolors as $c ) {
	$o[$c->ID] = $c->post_title;
}

$jht_colors = $o;

$custom = get_post_meta($post->ID,'jht_cabs');
$jht_cabs = $custom[0];
// array(66,68,70...) -> so process it
$o = array();

$args = array( 'numberposts' => -1, 'post_type'=>'jht_cabinetry', 'include' => $jht_cabs, 'orderby' => 'menu_order', 'order' => 'ASC' );
$thesecolors = get_posts($args);

foreach ( $thesecolors as $c ) {
	$o[$c->ID] = $c->post_title;
}
$jht_cabs = $o;

$custom = get_post_meta($post->ID,'jht_specs');
$jht_specs = $custom[0];
$custom = get_post_meta($post->ID,'jht_feats');
$jht_feats = $custom[0];
$custom = get_post_meta($post->ID,'jht_wars');
$jht_wars = $custom[0];
if ( $jht_wars == '' ) $jht_wars = array();
if ( count($jht_wars) > 0 ) {
	$args = array( 'numberposts' => -1, 'post_type'=>'jht_warranty', 'include' => $jht_wars, 'orderby' => 'menu_order', 'order' => 'ASC' );
	$jht_wars = get_posts($args);
}
$custom = get_post_meta($post->ID,'jht_jets');
$jht_jets = $custom[0];
$jetcount = 0;
foreach ( $jht_jets as $v ) $jetcount += $v;

// transient for jht_alljets
if ( false === ( $special_query_results = get_transient( 'jht_alljets' ) ) ) {
	// It wasn't there, so regenerate the data and save the transient
	$special_query_results = get_posts(array('numberposts'=>-1,'post_type'=>'jht_jet','orderby'=>'menu_order','order'=>'ASC'));
	set_transient( 'jht_alljets', $special_query_results, 60*60*12 );
}
// Use the data like you would have normally...
$alljets = get_transient( 'jht_alljets' );
?>
<div class="hero"<?php
if (class_exists('MultiPostThumbnails')) {
	$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_tub', 'background-image', $post->ID);
	if ( $img_id ) {
		$img = get_post($img_id);
		echo ' style="background: #000 url('. $img->guid .') 50% 0 no-repeat"';
	}
}
?>>
    	<div class="wrap">
            <div class="inner"<?php
			if (class_exists('MultiPostThumbnails')) {
				$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_tub', 'overhead-large', $post->ID);
				if ( $img_id ) {
					$imgsrc = wp_get_attachment_image_src($img_id, 'overhead');
					echo ' style="background: url('. $imgsrc[0] .') 0 65% no-repeat"';
				}
			}
?>>
                <h1><?php the_title(); ?></h1>
                <h2><?php esc_attr_e($jht_info['topheadline']); ?></h2>
            </div>
        </div>
    </div>
    <div class="goldBar8">
        <div class="the-tab-buttons">
            <a id="brochure-tab-link" href="<?php bloginfo('url'); ?>/request-brochure/"><b>Brochure</b> gratuite</a>
        </div>
    </div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="side">
                	<div class="specifications">
                    	<h4>Sp&eacute;cifications</h4>
                        <p><strong>Nombre de places:</strong> <?php esc_attr_e(strtolower($jht_specs['seats'])); ?></p>
                        <p><strong>Nombre de jets PowerPro:</strong> <?php echo absint($jetcount); ?></p>
                        <p><strong>Dimensions:</strong> <?php esc_attr_e($jht_specs['dim_int']); ?></p>
                        <p><strong>Volume moyen du spa:</strong> <?php esc_attr_e($jht_specs['vol_int']); ?></p>
                    </div>
                    <div class="energy">
                    	<h2 class="green"><strong>&Eacute;CONERG&Eacute;TIQUE</strong><span class="icon e"></span></h2>
                        <table cellpadding="0">
                        	<tr>
                            	<td><p><strong>Co&ucirc;ts d'op&eacute;ration mensuels<br /> 60&deg;F / 15&deg;C:</strong></p></td>
                                <td><p class="green">$<?php esc_attr_e($jht_specs['emoc']); ?></p></td>
                            </tr>
                        </table>
                    </div>
                	<br />
                    <?php
					get_sidebar('freeBrochure');
					//get_sidebar('requestQuote');
                    //get_sidebar('tradeIn');
					?>
                    <div class="share">
                        <div class="share-bar">
                            <?php if(function_exists('sharethis_button')) sharethis_button(); ?>
                        </div>
                    </div>
                </div>
                <div class="main">
					<?php the_content();
					if (class_exists('MultiPostThumbnails')) {
						MultiPostThumbnails::the_post_thumbnail('jht_tub', 'three-quarter', $post->ID, 'three-quarter', array('class'=>'threequarters'));
					}
					?>
                    <div class="options">
                        <h3>Couleurs de coquilles en acrylique</h3>
                        <ul><?php foreach ( $jht_colors as $i => $t ) echo '<li>'. get_the_post_thumbnail( $i, 'options-small-thumbs')  .'</li>'; ?></ul>
                        <h3>Caisson ProEndure</h3>
                        <ul><?php foreach ( $jht_cabs as $i => $t ) echo '<li>'. get_the_post_thumbnail( $i, 'options-small-thumbs')  .'</li>'; ?></ul>
                    </div>
                    <?php /*
					// not right now
                    <div class="buy-now">
                    	<h3>Call to Order: 844.411.5228 <!--span class="icon close"></span--></h3>
                        <p class="inner">
                        	<a href="#" class="btn gold">Request a Quote</a><a class="btn black" href="#">Buy</a>
                        </p>
                    </div>
					*/ ?>
                </div>
            </div>
            
            <div class="container">
                <ul class="tabs" id="tubtabs"><li class="current"><a href="#features-options">CARACT&Eacute;RISTIQUES ET OPTIONS</a></li><li><a href="#jets">Jets</a></li><li><a href="#specs">SP&Eacute;CIFICATIONS</a></li><li><a href="#warranty">GARANTIE</a></li></ul>
                	<div class="twoCol">
                    	<div class="main">
                    	
                        <div id="features-options">
                        	<h2 class="tabtitle">CARACT&Eacute;RISTIQUES ET OPTIONS</h2>
                            <p><?php echo $jht_info['featureblurb']; //esc_attr_e ?></p>
                            <div class="features">
                            	<?php
								foreach ( $jht_feats as $fid ) {
									$feat = get_post($fid);
									?>
                                <div class="feature withimage">
                                	<?php echo get_the_post_thumbnail($fid, 'feature-option'); ?>
                                    <h2><?php echo str_replace( 'MC', '<sup>MC</sup>', str_replace( 'MD', '<sup>MD</sup>', esc_attr($feat->post_title) ) ); ?></h2>
                                    <?php echo apply_filters('the_content', $feat->post_content); ?>
                                </div>
								<?php } ?>
                            </div>
                        </div>
                            
                        <div id="jets" style="display:none">
                            <div class="half">
                                <div class="description">
                                	<div class="inner">
                                        <h2>DES JETS ENCORE PLUS EFFICACES</h2>
                                        <p>Le syst&egrave;me exclusif de jets PowerPro est actionn&eacute; par des pompes &agrave; grand d&eacute;bit et basse pression qui assurent un hydromassage vigoureux. Gr&acirc;ce &agrave; un proc&eacute;d&eacute; brevet&eacute;, il est possible d'introduire de l'air dans les jets, cr&eacute;ant par le fait m&ecirc;me un m&eacute;lange moiti&eacute; air et moiti&eacute; eau capable de produire des massages de qualit&eacute; professionnelle, qui sont &agrave; la fois relaxants et efficaces. Pour faire l'essai des jets d'un spa, veuillez communiquer avec le distributeur de votre r&eacute;gion.</p>
                                    </div>
                                </div>
                                <div class="rollover">
                                <?php /*
                                    <div class="arrow arrow1"></div>
                                    <div class="arrow arrow1"></div>
                                    <div class="arrow arrow1"></div>
                                    <div class="arrow arrow1"></div>
                                    <div class="arrow arrow1"></div>
                                    <?php
									*/
                                    if (class_exists('MultiPostThumbnails')) {
                                    	MultiPostThumbnails::the_post_thumbnail('jht_tub', 'overhead-large', $post->ID, 'overhead');
                                    }
								?>
                                </div>
                            </div>
                            <div class="jet-details">
                            <?php
							$i = 0;
							foreach( $jht_jets as $j => $c ) {
								if ( absint($c) > 0 ) { ?>
                                <div class="jet-detail">
                                    <?php echo get_the_post_thumbnail( $j, 'jet', array('class'=>'alignleft')); ?>
                                    <h2><?php esc_attr_e($alljets[$i]->post_title); ?> Jets <span class="count">(<?php echo absint($c); ?>)</span></h2>
                                    <?php echo apply_filters('the_content', $alljets[$i]->post_content); ?>
                                    <br class="clear" />
                                </div>
                                <?php
								}
								$i++;
							}?>
                            </div>
                        </div>
                            
                        <div id="specs" class="specifications" style="display:none">
                        	<h3>VUE D'ENSEMBLE</h3>
                            <table cellspacing="0">
                            	<tr class="line1">
                                	<td>Nombre de places</td>
                                    <td><?php esc_attr_e($jht_specs['seats']); ?></td>
                                </tr>
                                <tr>
                                	<td>Dimensions</td>
                                    <td><?php echo esc_attr($jht_specs['dim_int']); ?></td>
                                </tr>
                                <tr>
                                	<td>Volume moyen du spa</td>
                                    <td><?php echo esc_attr($jht_specs['vol_int']); ?></td>
                                </tr>
                                <tr>
                                	<td>Poids &agrave; sec</td>
                                    <td><?php esc_attr_e($jht_specs['dry_weight']); ?></td>
                                </tr>
                                <tr>
                                	<td>Poids total rempli</td>
                                    <td><?php esc_attr_e($jht_specs['filled']); ?></td>
                                </tr>
                                <?php
								for ( $i = 1; $i < 4; $i++ ) {
								if ( isset($jht_specs['pump'.$i]) ) if ( $jht_specs['pump'. $i] != '' ) { ?>
                                <tr>
                                	<td>Pompe <?php echo $i . ($i<3 ? ', Am&eacute;rique du Nord' : '') ?></td>
                                    <td><?php echo nl2br(esc_attr($jht_specs['pump'. $i])); ?></td>
                                </tr>
                                <?php
								}
								}
								?>
                                <tr>
                                	<td>Pompe de circulation</td>
                                    <td><?php esc_attr_e($jht_specs['circulation']); ?></td>
                                </tr>
                                <tr>
                                	<td>Vanne de d&eacute;rivation</td>
                                    <td><?php echo absint($jht_specs['diverter']); ?></td>
                                </tr>
                                <?php
								if ( !isset($jht_specs['wps']) ) $jht_specs['wps'] = 'CLEAR<strong>RAY</strong><sup>MC</sup>'; // hax
								if ( isset($jht_specs['wps']) ) if ( $jht_specs['wps'] != '' ) { ?>
                                <tr>
                                	<td>Water Purification System</td>
                                    <td><?php echo $jht_specs['wps']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if ( isset($jht_specs['filtration']) ) if ( $jht_specs['filtration'] != '' ) { ?>
                                <tr>
                                	<td>Filtration</td>
                                    <td><?php echo $jht_specs['filtration']; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                	<td>Filtres</td>
                                    <td><?php echo nl2br($jht_specs['filters']); ?></td>
                                </tr>
                                <tr>
                                	<td>Alimentation &eacute;lectrique Am&eacute;rique du Nord</td>
                                    <td><?php esc_attr_e($jht_specs['elec_na']); ?></td>
                                </tr>
                                <tr>
                                	<td>Alimentation &eacute;lectrique International</td>
                                    <td><?php esc_attr_e($jht_specs['elec_int']); ?></td>
                                </tr>
                            </table>
                        	<h3>COULEURS ET CAISSONS</h3>
                            <table cellspacing="0">
                                <tr class="line1">
                                	<td>Caisson</td>
                                    <td><?php echo implode(', ', $jht_cabs); ?></td>
                                </tr>
                                <tr>
                                	<td>Couleurs de la coquille**</td>
                                    <td><?php echo implode(', ', $jht_colors); ?></td>
                                </tr>
                            </table>
                            <h3>Jets</h3>
                            <table cellspacing="0">
                            	<tr class="line1">
                                	<td>Total Jets</td>
                                    <td><?php echo absint($jetcount); ?></td>
                                </tr>
                                <?php
								$i = 0;
								foreach ( $jht_jets as $j => $c ) {
									$c = absint($c);
									if ( $c > 0 ) {
									?>
                            	<tr>
                                	<td><?php esc_attr_e($alljets[$i]->post_title); ?></td>
                                    <td><?php echo $c; ?></td>
                                </tr><?php
									}
									$i++;
								}
								?>
                            </table>
                            <p class="note"><small><strong>NOTE:</strong> Le volume du spa est bas&eacute; sur un remplissage moyen.<br /><br />
                                Jacuzzi Hot Tubs peut apporter des modifications et des am&eacute;liorations &agrave; ses produits sans pr&eacute;avis. Les produits destin&eacute;s au march&eacute; international peuvent &ecirc;tre configur&eacute;s diff&eacute;remment pour respecter les codes &eacute;lectriques locaux. Les dimensions sont approximatives. Le volume du spa est bas&eacute; sur un remplissage moyen. Les produits sont prot&eacute;g&eacute;s par un ou plusieurs num&eacute;ros de brevets des &Eacute;tats-Unis. D'autres brevets peuvent s'appliquer.<br /><br />
                                Les co&ucirc;ts mensuels estim&eacute;s sont bas&eacute;s sur le protocole d'essai de la CEC pour la consommation d'&eacute;nergie en mode veille seulement. Les r&eacute;sultats sont mesur&eacute;s dans un environnement contrôl&eacute; &agrave; un tarif de 0,10 $ par kilowattheure. Diff&eacute;rents &eacute;l&eacute;ments peuvent influer sur les co&ucirc;ts mensuels estim&eacute;s, comme les variations de tarifs d'une r&eacute;gion &agrave; l'autre, l'&eacute;tablissement de nouveaux tarifs et les conditions d'utilisation du spa. Pour tous les d&eacute;tails concernant le protocole d'essai et les r&eacute;sultats de la CEC, consulter le site suivant: http://www.energy.ca.gov <br /><br />
                                * La puissance &agrave; la pompe ou la puissance au frein (BHP) est la puissance disponible &agrave; l'arbre d'entraînement de la pompe. Source: ITT Goulds Pumps, Centrifugal Pump Fundamentals.<br />
                                ** Le choix peut varier d'un distributeur &agrave; l'autre.</small></p>
                        </div>
                		<div id="warranty" style="display:none">
                        	<h2 class="tabtitle">Garanties Disponibles</h2>
                            <h2>Informations sur la garantie de: <?php the_title(); ?></h2>
                            <div class="warranties">
                            	<?php foreach ( $jht_wars as $p ) { ?>
                            	<div class="warranty">
                                	<p><?php echo get_the_post_thumbnail($p->ID, 'warranty', array('class'=>'alignleft')); ?><?php echo esc_attr($p->post_title) .' - '. $p->post_content; ?></p>
                                </div>
                                <?php } ?>
                            </div>
                            <p class="note">For complete warranty information, please visit our <a href="<?php echo get_permalink(4169) ?>">warranty page</a></p>
                        </div>
                                                
                    </div>
                    <div class="side">
                        <h2>Couleurs de coquilles en acrylique</h2>
                        <p>Le syst&egrave;me TriFusion<sup>MC</sup> produit une coquille en acrylique durable; elle est huit fois plus robuste que les coquilles ordinaires en fibre de verre; ses couleurs et sa texture sont riches.</p>
                            <div class="options">
                                <ul class="colors">
                                	<?php
									foreach ( $jht_colors as $i => $t ) {
										echo '<li><span>'. get_the_post_thumbnail( $i, 'right-thumbs') .'</span>';
										echo $t;
										echo '</li>';
									}
									?>
                                </ul>
                                <h2>Caisson ProEndure</h2>
                                <p>Notre caisson est durable et il r&eacute;siste aux rayons UV.</p>
                                <ul class="cabinetry">
                                	<?php
									foreach ( $jht_cabs as $i => $t ) {
										echo '<li><span>'. get_the_post_thumbnail( $i, 'right-thumbs') .'</span>';
										echo $t;
										echo '</li>';
									}
									?>
                                </ul>
                        </div>
                        <div class="scall bro"><a href="<?php echo get_permalink(3745); ?>"><strong>Brochure </strong> gratuite</a></div>
                    </div>
                </div>
                <h3 class="to-top"><a href="#top"><span class="icon upArrow"></span>RETOUR AU HAUT DE LA PAGE</a></h3>
            </div><br /><br />
<?php
endwhile;
get_footer(); ?>
