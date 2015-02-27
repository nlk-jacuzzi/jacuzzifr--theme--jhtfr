<?php

?>
            <ul class="primaryMenu" id="tnav">
            	<li class="menu-item first parent<?php if ( in_array( get_post_type(), array('jht_cat', 'jht_tub'))) echo ' current'; ?>">
	                <?php
						global $polylang;
						global $tubcats;
							$o = '<a href="'. jht_hottublandingurl() .'">Spas</a>';
							$o .= '<ul>';
								foreach ( $tubcats as $c ) {
									$catID = preg_replace("/[^A-Za-z0-9]/", '', $c['name']);
									if ( in_array($c['name'], array('Best Selling', 'Collections', 'Spas les plus populaires')) ) { // make Best Selling like COLLECTIONS :)
										$o .= '<li class="collections">';
									} else {
										$o .= '<li>';
									}
									$o .= '<a href="'. $c['url'] .'">'. $c['name'] .'</a>';
									$o .= '<div class="superMenu">';
									
									if ( isset($c['subcats']) == false ) {
										if ( in_array($c['name'], array('Best Selling', 'Spas les plus populaires')) ) { // make Best Selling like COLLECTIONS :)
											$o .= '<ul class="grid4 collections best">';
											for ( $i = 0; $i < 4; $i++ ) {
												$o .= '<li class="cell '. $c['tubs'][$i]['slug'] .($i==0 ? ' first' : ($i==3 ? ' last' : '') ) .'">';
												$o .= '<div class="h">'. $c['tubs'][$i]['name'] .'<sup>MC</sup></div>';
												$o .= '<p class="thumb"><a href="'. $c['tubs'][$i]['url'] .'" class="prel thm" title="'. $c['tubs'][$i]['imgs']['nav34src'] .'"></a></p>';
												$o .= '<p class="tag">'. $c['tubs'][$i]['tag'] .'</p>';
												$o .= '<p class="link"><a href="'. $c['tubs'][$i]['url'] .'">Voir les spas '. $c['tubs'][$i]['name'] .'</a></p>';
											}
											$o .= '</ul>';
										} else {
											$o .= '<ul class="grid8">';
											for ( $i = 0; $i < 8; $i++ ) {
												$o .= '<li class="cell ';
												if ( isset( $c['tubs'][$i] ) ) {
													$t = $c['tubs'][$i];
													$o .= $t['slug'] .'"><a href="'. $t['url'] .'">'. $t['name'] .'<sup>MC</sup><span>'. str_replace(' cm','', strtolower($t['size']) ) .' cm</span>';
													if ( $t['imgs']['rollover'] != '' ) {
														$o .= '<span class="rollover prel" title="'. $t['imgs']['rollover'] .'"><span>'. $t['name'] .'<sup>MC</sup></span></span>';
													}
													$o .= '</a></li>';
												} else {
													$o .= '"></li>';
												}
											}
											$o .= '</ul>';
											$o .= '<div class="image prel" title="'. $c['img'] .'"></div>';
										}
									} else {
										$o .= '<ul class="grid4 collections">';
										$j = 0;
										foreach ( $c['subcats'] as $k => $s ) {
											$o .= '<li class="cell '. $s['slug'] .($j==0 ? ' first' : ($j==3 ? ' last' : '') ) .'">';
											$o .= '<div class="h">'. $s['fullname'] .'</div>';
											$o .= '<p class="thumb"><a href="'. $s['url'] .'" title="'. $s['imgsrc'] .'" class="prel thm"></a></p>';
											$o .= '<p class="tag">'. str_replace('Collection ', 'Collection<br />', $s['tag']) .'</p>';
											$o .= '<p class="link"><a href="'. $s['url'] .'">Voir les spas '. str_replace('Collection ', '', $s['name']) .'</a></p>';
											$j++;
										}
										$o .= '</ul>';
									}
									$o .= '</div>';
									$o .= '</li>';
								}
								/* no acc */
							$o .= '</ul>';
						echo $o;
					?>
                </li>
                <li class="menu-item parent<?php if(is_page(3749)) echo ' current'; ?>"><a href="<?php echo get_permalink(3749) ?>">&Agrave; propos de nous</a>
                	<ul class="drop2">
                		<li>
                        	<div class="search-flop why">
                        		<ul>
                        			<li class="search-flop-col">
                        				<ul class="nav big">
                        					<li><a href="<?php echo get_permalink(3749) ?>">Pourquoi choisir Jacuzzi</a></li>
					                				<?php wp_list_pages('include=3803,3805&title_li=&depth=-1'); ?>
					                    </ul>
					                </li>
			                    </ul>
			                </div>
			            </li>
                	</ul>
                </li>
                <li class="menu-item<?php if(is_page(4282)) echo ' current'; ?>"><a href="<?php echo get_site_url() ?>/accessories/">Accessoires</a></li>
                <li class="menu-item last<?php if(is_page(9674) || is_page_template('page-new-dealer.php') ) echo ' current'; ?>"><a href="<?php echo get_permalink(9674) ?>">Trouver un DÉtaillant</a></li>
                <?php /* no search... */ ?>
            </ul>