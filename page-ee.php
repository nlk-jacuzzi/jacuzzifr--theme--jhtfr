<?php
/**
 * Template Name: Energy Efficiency
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
if ( function_exists('jhtpolylangfix_contentcheck') ) {
	jhtpolylangfix_contentcheck();
} else {
	the_content(); // hardcoded?
}
endwhile; // end of the loop.
?><div class="threeColEven"><table>
            	<tr class="blueGrad">
                	<th>NOM DU MOD&Egrave;LE</th>
                    <th>CO&Ucirc;TS MENSUELS ESTIM&Eacute;S* <br />
60&deg;F / 15&deg;C</th>
                    <th>CO&Ucirc;TS MENSUELS<br /> AVEC ISOLATION SMARTSEAL<sup>MC</sup></th>
                </tr>
                <?php
					$alltubs = get_posts(array('numberposts'=>'-1', 'post_type'=>'jht_tub', 'orderby'=>'menu_order', 'order'=>'ASC'));
					foreach ( $alltubs as $t ) {
						$custom = get_post_meta($t->ID,'jht_specs');
						$info = $custom[0];
						if ( $info == '' ) $info = array();
						if ( isset($info['emoc']) == false ) $info['emoc'] = '';
						if ( isset($info['smartseal']) == false ) $info['smartseal'] = '';
						echo '<tr><td>'. esc_attr($t->post_title) .'</td>';
						echo '<td>'. ( in_array( $info['emoc'], array('','NA') ) ? '' : '$' ) . $info['emoc'] .'</td>';
						echo '<td>'. ( in_array( $info['smartseal'], array('','NA') ) ? '' : '$' ) . $info['smartseal'] .'</td>';
						echo '</tr>';
						
					}
				?>
            </table>
            <p style="padding:20px" class="note">*Les co&ucirc;ts mensuels estim&eacute;s sont bas&eacute;s sur le protocole d'essai de la CEC pour la consommation d'&eacute;nergie en mode veille seulement. Les r&eacute;sultats sont mesur&eacute;s dans un environnement contr&ocirc;l&eacute; &agrave; un tarif de 0,10 $ par kilowattheure. Diff&eacute;rents &eacute;l&eacute;ments peuvent influer sur les co&ucirc;ts mensuels estim&eacute;s, comme les variations de tarifs d'une r&eacute;gion &agrave; l'autre, l'&eacute;tablissement de nouveaux tarifs et les conditions d'utilisation du spa. Pour tous les d&eacute;tails concernant le protocole d'essai et les r&eacute;sultats de la CEC, consulter le site suivant: <a href="http://www.energy.ca.gov" target="_blank">http://www.energy.ca.gov</a></p>
</div>
<?php get_footer(); ?>
