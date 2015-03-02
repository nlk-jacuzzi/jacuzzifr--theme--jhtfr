<?php
remove_action('wp', 'jht_404fix2', 98);
function jhtfr_404d() {
	global $wp_query;
	global $post;
	
	$req = substr($_SERVER['REQUEST_URI'], 3); // /fr/whatever
	if ( ( $wp_query->query_vars['post_type'] == 'jht_acc' ) && ( $wp_query->post_count == 0 ) ) {
		/*
		 * make sure it really is...
		 * check for jht_cat & jht_tub
		 */
		if ( strpos($req, 'accessories') > 0 ) {
			$unslashed = substr( $req, strrpos( $req, '/', -2)+1, -1 );
			$old_query = $wp_query;
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'jht_acc_cat',
						'field' => 'slug',
						'terms' => $unslashed,
					)
				)
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->post_count > 0 ) {
				// thats ok, we're already 404
			} else {
				$wp_query = $old_query;
			}
		}
	}
	if ( $wp_query->query_vars['error'] == '404' ) {
		/*
		 * make sure it really is...
		 * check for jht_cat & jht_tub
		 */
		if ( strpos($req, 'accessories') > 0 ) {
			$unslashed = substr( $req, strrpos( $req, '/', -2)+1, -1 );
			$old_query = $wp_query;
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'jht_acc_cat',
						'field' => 'slug',
						'terms' => $unslashed,
					)
				)
			);
			$wp_query = new WP_Query( $args );
			if ( $wp_query->post_count > 0 ) {
				// 404d
			} else {
				$wp_query = $old_query;
			}
		} else {
			$slashcount = substr_count($req, '/');
			
			$catslash = 2;
			$tubslash = 3;
			if ( in_array($slashcount, array( $catslash, $tubslash ) ) ) {
				$old_query = $wp_query;
				$morevars = array( 'page' => 0 );
				if ( $slashcount == $catslash ) {
					$ptype = 'jht_cat';
				} else {
					$ptype = 'jht_tub';
				}
				$slash2 = strrpos($req, '/');
				$slash1 = strrpos(substr($req,0,$slash2-2), '/')+1;
				$unslashed = substr($req,$slash1, $slash2-$slash1);
				$wp_query = new WP_Query(array('post_type'=>$ptype, 'name'=> $unslashed));
				$morevars[$ptype] = $unslashed;
				
				if ( $wp_query->post_count > 0 ) {
					$wp_query->query_vars = array_merge($morevars, $wp_query->query_vars);
					$morevars['page'] = '';
					$wp_query->query = array_merge($morevars, $wp_query->query);
					
					$post = $wp_query->post;
				} else {
					$wp_query = $old_query;
				}
			}
		}
	}
	$GLOBALS['wp_query'] = $wp_query;
	$GLOBALS['wp_the_query'] = $wp_query;
}
add_action( 'wp', 'jhtfr_404d', 98 );

function jhtfr_baseurl($u = null) {
  // outdated : now just define JHTBASE in wp-config.php
	return '/fr/';
}
add_filter('hottubbase', 'jhtfr_baseurl');

function jhtfr_htlurl($u) {
	return jhtfr_baseurl() .'hot-tubs/';
}
add_filter('hottublandingurl', 'jhtfr_htlurl');

add_filter( 'body_class', 'jhtfr_body_class', 99 );
function jhtfr_body_class( $classes ) {
	$classes[] = 'fr';
	return $classes;
}

function jhtfr_htsizekey($k) {
  return "dim_int";
}
add_filter('hottubsize', 'jhtfr_htsizekey');
/* fr-CA header meta tag stuff */
function jhtfr_og_locale($locale) {
  return "fr_CA";
}
add_filter('wpseo_locale', 'jhtfr_og_locale');

function jhtfr_language_meta() {
	echo '<meta http-equiv="content-language" content="fr-ca" />';
}
add_action( 'wp_head', 'jhtfr_language_meta' );

function jhtfr_language_attr( $l ) {
	$l = str_replace('lang="en-US"', 'lang="fr-CA"', $l );
	return $l;
}
add_filter( 'language_attributes', 'jhtfr_language_attr' );


function jhtfr_socialmenu($plusone = false) {
	?><ul class="socialMenu">
        <li class="first"><a href="http://www.facebook.com/jacuzziofficial" target="_blank" class="icon fb" title="Join us on Facebook">Facebook</a></li><?php
		if ( $plusone ) { ?>
        <li><g:plusone size="medium" annotation="none"></g:plusone></li><?php } ?>
        <li><a href="http://twitter.com/jacuzziofficial" target="_blank" class="icon tw" title="Follow us on Twitter">Twitter</a></li>
        <li class="last"><a href="http://www.youtube.com/jacuzziofficial" target="_blank" class="icon yt" title="Watch us on YouTube">YouTube</a></li>
    </ul><?php
}

function jhtfr_avala_args_filter( $field ) {
	if ( isset( $field['id'] ) ) {
		switch ( $field['id'] ) {
			case 'custom_data_CurrentlyOwn':
			case 'custom_data_InterestedInOwning':
			case 'custom_data_HomeOwner':
				$field['options'] = array(
					'Oui' => array( 'value' => 'Yes' ),
					'Non' => array( 'value' => 'No' ),
				);
				break;
			case 'custom_data_BuyTimeFrame':
				$field['options'] = array(
					'Je ne le sais pas encore' => array( 'value' => 'Not sure' ),
					'D\'ici 1 mois' => array( 'value' => 'Within 1 month' ),
					'D\'ici 1 &agrave; 3 mois' => array( 'value' => '1-3 months' ),
					'D\'ici 4 &agrave; 6 mois' => array( 'value' => '4-6 months' ),
					'Dans plus de 6 mois' => array( 'value' => '6+ months' ),
				);
				break;
			case 'custom_data_ProductUse':
				$field['options'] = array(
					'Relaxation' => array( 'value' => 'Relaxation' ),
					'Soulagement des douleurs/Th&eacute;rapie' => array( 'value' => 'Pain Relief/Therapy' ),
					'Liens avec parents et amis' => array( 'value' => 'Bonding/Family' ),
					'Organiser des f&ecirc;tes dans la cour arri&egrave;re' => array( 'value' => 'Backyard Entertaining' ),
				);
				break;
		}
	}
	return $field;
}
add_filter('avala_args', 'jhtfr_avala_args_filter');


// [get_blog_info dir="url"]
function s_code_get_site_dir( $atts ) {
	extract( shortcode_atts( array(
		'dir' => 'url',
	), $atts ) );
	$url = get_bloginfo( $dir );
	return $url;
}
add_shortcode( 'get_blog_info', 's_code_get_site_dir' );