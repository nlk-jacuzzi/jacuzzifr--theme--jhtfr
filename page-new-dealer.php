<?php
/**
 * Template Name: Dealer Info
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); 

/* The following are all the vars containing dealer data
 *
 *  $dealer_name            :   string
 *  $dealer_address         :   string
 *  $dealer_phone           :   string
 *  $dealer_hours           :   array
 *  $dealer_email           :   string
 *  $dealer_website         :   string
 *  $dealer_images          :   array
 *  $dealer_testimonials    :   array
 *  $dealer_services        :   array
 *  $dealer_wet_test        :   bool
 *  $dealer_promo           :   string
 *
*/

    // Currently get vars from page meta/custom fields
    $dealer_name            = get_post_meta( get_the_ID(), 'dealer-name', true );
    $dealer_address         = get_post_meta( get_the_ID(), 'dealer-address', true );
    $dealer_phone           = get_post_meta( get_the_ID(), 'dealer-phone', true );
    $dealer_hours           = get_post_meta( get_the_ID(), 'dealer-hours', true );
    $dealer_email           = get_post_meta( get_the_ID(), 'dealer-email', true );
    $dealer_website         = get_post_meta( get_the_ID(), 'dealer-website', true );
    $dealer_images          = get_post_meta( get_the_ID(), 'dealer-images', true );
    $dealer_testimonials    = get_post_meta( get_the_ID(), 'dealer-testimonials', true );
    $dealer_services        = get_post_meta( get_the_ID(), 'dealer-services', true );
    $dealer_wet_test        = get_post_meta( get_the_ID(), 'dealer-wet-test', true );
    $dealer_promo           = get_post_meta( get_the_ID(), 'dealer-promo', true );

    /* * * * Format data for output */
    $dealer_name        = preg_replace('/[^A-Za-z0-9]/', ' ', $dealer_name);
    $dealer_name        = preg_replace('/ +/', ' ', $dealer_name);
    $dealer_name        = trim($dealer_name);

    $dealer_address     = str_replace("\n", ", ", $dealer_address);
    $dealer_address     = preg_replace('/[^A-Za-z0-9,-\.]/', ' ', $dealer_address);
    $dealer_address     = preg_replace('/ +/', ' ', $dealer_address);
    $dealer_address     = trim($dealer_address);

    $dealer_phone       = format_phone_us($dealer_phone, 'dash');

    $dealer_hours_array = json_decode($dealer_hours, true);
    foreach ( $dealer_hours_array as $k => $v ) {
        $dealer_hours_str   .= $k . ': ' . $v . '<br />';
    }
    $dealer_hours       = $dealer_hours_str;

    $dealer_testimonials_array  = json_decode($dealer_testimonials, true);
    $dealer_testimonials_ct     = count( $dealer_testimonials_array );
    $i = 1;
    $dealer_testimonials_str    = '';
    foreach ( $dealer_testimonials_array as $k => $v ) {
        $dealer_testimonials_str    .= '<p class="dealertest" style="display: none;">';
        $dealer_testimonials_str    .= $v . '<br /><br />- ' . $k;
        $dealer_testimonials_str    .= '</p>';
        $i++;
    }
    $dealer_testimonials    = $dealer_testimonials_str;

    $services_array = json_decode( $dealer_services, true );
    $services_str = null;
    foreach ( $services_array as $k => $v ) {
        $services_str .= '<li>-&nbsp;&nbsp;'.$v.'</li>';
    }
    $dealer_services = $services_str;

    $dealer_images_array    = json_decode( $dealer_images, true );
    $i = 1;
    foreach ( $dealer_images_array as $value ) {
        $dealer_images_str .= '<img class="dealerimg" src="'.$value.'"/>';
        $i++;
    }
    $dealer_images = $dealer_images_str;

    $dealer_promo = json_decode($dealer_promo, true);
    /* * * * END formatting data */


    $dealer_lat_long = explode(",", str_replace("\n", "", get_post_meta( get_the_ID(), 'dealer-lat-long', true )));


    ?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=fr"></script>
    <script>
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;
        var marker;

        function initialize() {
          directionsDisplay = new google.maps.DirectionsRenderer();
          var dealer = new google.maps.LatLng(<?php echo $dealer_lat_long[0]; ?>,<?php echo $dealer_lat_long[1]; ?>);
          var mapOptions = {
            zoom:13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: dealer,
          }
          map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
          marker = new google.maps.Marker({
              position: dealer,
              map: map,
              title: '<?php echo $dealer_name; ?>'
          });
          directionsDisplay.setMap(map);
          directionsDisplay.setPanel(document.getElementById('directions-panel'));
        }

        function calcRoute() {
          var start = document.getElementById('saddr').value;
          var end = '<?php echo $dealer_address; ?>';
          var request = {
              origin:start,
              destination:end,
              travelMode: google.maps.DirectionsTravelMode.DRIVING
          };
          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
            }
          });
        }

        google.maps.event.addDomListener(window, 'load', initialize);


        function show_sms() {
            jQuery('#sms-form-success').hide();
            jQuery('#sms-carrier').val("");
            jQuery('#sms-phonenumber').val("");
            jQuery('#sms-container').show();
            jQuery('#sms-form').show();
        }
        
        jQuery(document).ready(function($){
            // SMS pop-up control
            $(document).bind('mouseup touchstart', function(e){
                var container = $('#sms-form');
                if (!container.is(e.target) // if the target of the click isn't the container...
                    && container.has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        $('#sms-container').hide();
                    }
            });
            // submit for SMS form
            $('form[name=send-message-form]').submit( function() {
                var canSubmit = true;
                var smsNumber = $('#sms-phonenumber').val();
                smsNumber = smsNumber.replace(/\D/g,'');
                var smsCarrier = $('#sms-carrier').val();

                if ( smsNumber == '' ) { canSubmit = false; }
                if ( smsCarrier == '' ) { canSubmit = false; }

                var emailToVal = smsNumber + '@' + smsCarrier;
                var subjectVal = '<?php echo $dealer_name; ?>';
                var messageVal = "Address: <?php echo $dealer_address ?>" + "\n" + "Phone: <?php echo $dealer_phone ?>" + "\n" + "Website: <?php echo $dealer_website; ?>";
                var data = { action: 'sms_dealer_email', emailTo: emailToVal, subject: subjectVal, message: messageVal };

                if ( canSubmit == true ) {
                    $.post(
                        "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",
                        data,
                        function(response) {
                            $('#sms-form').hide();
                            $("#sms-form-success").show("normal");
                        }
                    );
                    _gaq.push(['_trackEvent', 'DealerLocator', 'Send-to-phone']);
                }
                return false;
            });

            //submit button for directions search
            $('form[name=getDirs]').submit( function() {
                if ( $('#saddr').val() !== "" ) {
                    if ( $("#map-canvas").height() < 200 ) {
                        $("#map-canvas").animate( { height: '+=100px' }, 500, function() {
                                google.maps.event.trigger(map, 'resize');
                                marker.setMap(null);
                                calcRoute();
                        });
                    }
                    else {
                        calcRoute();
                    }
                    if ( $("#directions-panel").height() < 20 ) {
                        $("#directions-panel").animate( { maxHeight: '24px' }, 300 );
                    }
                    _gaq.push(['_trackEvent', 'DealerLocator', 'Directions']);
                }
                return false;
            });
            $("#dirs-showhide").click( function() {
                if ( $(this).hasClass('expanded') ) {
                    $("#directions-panel").animate( { maxHeight: '24px' }, 500 ).css('overflow', 'hidden');
                    $(this).removeClass('expanded').removeClass('icon-arrow-up').addClass('icon-arrow-down').text('  Show Directions');
                }
                else {
                    $("#directions-panel").animate( { maxHeight: '900px' }, 500, function() {
                        $("#directions-panel").css('overflow', 'auto');
                    });
                    $(this).addClass('expanded').removeClass('icon-arrow-down').addClass('icon-arrow-up').text('  Hide Directions');
                }
            });

            // animate images
            var nimg = $('.dealerimg').length;
            var $lastimg = $('.dealer-img-contain>img:last-child');

            if ( nimg > 1 ) {
                $lastimg.css('display', 'block').delay(4500).fadeOut(500);
            }
            else {
                $lastimg.css('display', 'block');
            }
            function startImg() {
                var $firstimg = $('.dealer-img-contain>img:first-child');
                $firstimg.fadeIn(500, function () {
                    $(this).parent().append($(this));
                    $(this).delay(4000).fadeOut(500);
                });
            }
            
            if ( nimg > 1 ) {
                setInterval( function() {
                    startImg();
                }, 5000);
            }

            //animate testimonials
            if ( $('#testimonial-container').children().size() > 1 ) {
                var $last = $('#testimonial-container>p:last-child');
                $last.css('display', 'block').delay(11500).fadeOut(500);
                function startTesti() {
                    var $first = $('#testimonial-container>p:first-child');
                    $first.fadeIn(500, function () {
                        $(this).parent().append($(this));
                        $(this).delay(11000).fadeOut(500);
                    });
                }
                var ntest = $('.dealertest').length;
                if ( ntest > 1 ) {
                    setInterval( function() {
                        startTesti();
                    }, 12000);
                }
            }
            else {
                $('#testimonial-container p').css('display', 'block');
            }

            var hl = $('.dealer-lt-col').height();
            var hr = $('.dealer-rt-col').height();
            if ( hl > hr ) {
                $('.dealer-rt-col').height();
            }

            $('.close-popup').click( function() {
                $('#sms-container').hide('normal');
            });

        });
    </script>

    <script type="text/javascript">

        function PrintElem(elem)
        {
            Popup($(elem).html());
        }

        function Popup(data) 
        {
            var mywindow = window.open('', 'Directions');
            mywindow.document.write('<html><head><title>Directions</title>');
            /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            mywindow.document.write('</head><body >');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');

            mywindow.print();
            mywindow.close();

            return true;
        }

    </script>
    <script async src="https://www.youtube.com/iframe_api"></script>
    <script>
      // This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      //   <iframe id="jhtVideo" width="312" height="176" src="//www.youtube.com/embed/zDtaKQlnoag?enablejsapi=1&playerapiid=jhtVideo" frameborder="0" allowfullscreen></iframe>

      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('jhtVideo', {
          height: '176',
          width: '312',
          videoId: 'zDtaKQlnoag',
          events: {
            'onReady': onPlayerReady
          }
        });
      }

      // The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        //event.target.playVideo();
      }
    </script>
    
    <?php ?>

    <div id="sms-container" >
        <div id="sms-form" >
            <h3>Envoyer au t&eacute;l&eacute;phone</h3>
            <form action="/" method="post" id="sms-fields" name="send-message-form" >
                <label for="sms-carrier">S&eacute;lectionner votre op&eacute;rateur mobile</label>
                <select id="sms-carrier" name="sms-carrier">
                    <option value="">Choisir parmi diff&eacute;rents op&eacute;rateurs</option>
                    <optgroup>
                        <option value="txt.att.net">AT&T</option>
                        <option value="sms.mycricket.com">Cricket</option>
                        <option value="mymetropcs.com">MetroPCS</option>
                        <option value="messaging.sprintpcs.com">Sprint</option>
                        <option value="tmomail.net">T-Mobile</option>
                        <option value="txt.att.net">TracFone</option>
                        <option value="email.uscc.net">U.S. Cellular</option>
                        <option value="vtext.com">Verizon</option>
                        <option value="vmobl.com">Virgin Mobile</option>
                    </optgroup>
                </select>
                <label for="sms-phonenumber">Entrer votre num&eacute;ro de t&eacute;l&eacute;phone cellulaire</label>
                <input type="text" id="sms-phonenumber" class="phonenumber" name="sms-phonenumber" placeholder="Num&eacute;ro de t&eacute;l&eacute;phone"/>
                <input type="hidden" name="action" value="sms_dealer_email" />
                <input type="submit" id="submit-sms" class="black-button" name="submit-sms" value="ENVOYER LES D&Eacute;TAILS &Agrave; MON T&Eacute;L&Eacute;PHONE" onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Send-to-Phone']);"/>
            </form>
            <a class="close-popup">X</a>
        </div>
        <div id="sms-form-success">
            <h3>Thank you!</h3><p>Your Dealer information is on its way.</p>
            <a class="black-button">Close</a>
        </div>
    </div>

    <div class="hero">
    	<div class="wrap">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="bd dealer-page">
    	<div class="wrap">

            <div class="dealer-two-col">
                <div class="dealer-banner">
                    <div class="dealer-banner-lt">
                        <h2><?php echo $dealer_name ?></h2>
                    </div>
                    <div class="dealer-banner-rt">
                        <a href="javascript:window.print()" class="black-button lt" onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Print']);"><span class="print-button"></span><div class="right-carrot"></div></a>
                        <a class="black-button rt" onclick="show_sms()"><span class="send-to-phone-button"></span><div class="right-carrot"></div></a>
                        
                    </div>
                </div>
                <div class="dealer-lt-col">
                    <div class="dealer-images">
                        <div class="dealer-img-contain">
                            <?php echo $dealer_images; ?>
                        </div>
                        <div class="dealer-locator-form">
                            <p>Obtenir l'itin&eacute;raire pour aller chez ce distributeur</p>
                            <form name="getDirs">                              
                            <input id="saddr" type="text" name="starting_address" value="Veuillez inscrire votre adresse" placeholder="Veuillez inscrire votre adresse" onfocus="if(jQuery(this).val() == 'Veuillez inscrire votre adresse') jQuery(this).val('')" onblur="if(jQuery(this).val() == '') jQuery(this).val('Veuillez inscrire votre adresse')"/>
                            <input type="submit" id="get_directions" name="submit-go" value=" " onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Directions']);" /><div class="right-carrot"></div>
                            </form>
                        </div>
                    </div>
                    <div class="dealer-details">
                        <h4>Adresse</h4>
                        <p><?php echo $dealer_address ?></p>
                        <h4><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/callouts/cplogo.png" width="94" height="50" alt="Club Piscine" style="float:right" />T&eacute;l&eacute;phone</h4>
                        <p><?php echo $dealer_phone ?></p>
                        <h4>Heures d'ouverture</h4>
                        <p><?php echo $dealer_hours ?></p>
                        <div>
                            <a href="mailto:<?php echo $dealer_email; ?>" class="lt" onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Email']);"><span class="icons icon-envelope"></span><span class="the-words">Courriel du distributeur</span></a>
                            <a href="<?php echo $dealer_website; ?>" class="rt" target="_blank" onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Website']);"><span class="icons icon-map-pin-stroke"></span><span class="the-words">Site Web du distributeur</span></a>
                        </div>

                    </div>
                    <div id="map-canvas" class="dealer-map"></div>
                    <div id="directions-panel">
                        <div id="dirs-showhide" class="fs1 icon-arrow-down">&nbsp; Show Directions</div>
                        <div id="print-directions"><a onclick="PrintElem('.adp.classic')" >Print Directions</a></div>
                    </div>

                    <div class="dealer-article">
                        <?php if ( isset( $dealer_promo ) && $dealer_promo ) { ?>
                            <div class="dealer-promo">
                                <img src="<?php echo $dealer_promo[0]; ?>" alt="<?php echo $dealer_promo[1]; ?>"/>
                            </div>
                        <?php } ?>

                        <div class="dealer-exp-vid">
                            <h2>D&Eacute;COUVREZ POURQUOI IL<br />VOUS FAUT MAINTENANT<br />RENDRE VISITE &Agrave; UN<br />DISTRIBUTEUR</h2>
                            <p>Regardez cette vid&eacute;o pour savoir ce que vous offre<br />le distributeur Jacuzzi </p>
                            <!--[if lte IE 9]><div style="display:none;"><![endif]-->
                            <a id="playJHTvideo" onclick="player.playVideo()"><span class="play-now">REGARDER MAINTENANT</span></a>
                            <!--[if lte IE 9]></div><![endif]-->
                            <div id="jhtVideo">
                                <!--iframe id="jhtVideo" width="312" height="176" src="//www.youtube.com/embed/zDtaKQlnoag?enablejsapi=1&playerapiid=jhtVideo" frameborder="0" allowfullscreen></iframe-->
                            </div>
                        </div>

                        <?php the_content(); ?>

                    </div>


                </div>
                <div class="dealer-rt-col">
                    <div class="dealer-testimonials">
                        <span class="test-quot lt">“</span>
                        <span id="testimonial-container">
                            <?php echo $dealer_testimonials ?>
                        </span>
                        <span class="test-quot rt">”</span>
                    </div>
                    <div class="dealer-visit-guide widge">
                        <h4>Liste de contr&ocirc;le pour votre visite chez le marchand</h4>
                        <p>T&eacute;l&eacute;chargez votre liste de contr&ocirc;le pour votre visite chez le marchand. Vous pouvez l'imprimer pour profiter au maximum de votre visite, poser les bonnes questions et trouver le spa id&eacute;al</p>
                        <a href="<?php echo get_stylesheet_directory_uri(); ?>/images/brochure/FR_Dealer_visit_Checklist.pdf" class="black-button" onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Download-Guide']);" target="_blank">T&Eacute;L&Eacute;CHARGER<div class="fs1" aria-hidden="true" data-icon="&#xe129;"><div class="arrow-cover-t"></div></div></a>
                    </div>
                    <?php if ( strtolower($dealer_wet_test) == 'true' ) { ?>
                        <div class="dealer-wet-test widge wht">
                            <img src="<?php bloginfo('template_url'); ?>/images/dealer-locator/wet-test.jpg" />
                            <h3>Faites l'essai d'un spa ici!</h3>
                            <p>L'achat d'un spa est trop important pour le faire &agrave; l'aveuglette. Nous vous offrons de faire l'essai - en priv&eacute; - de nos spas et diff&eacute;rents types de jets pour trouver le mod&egrave;le id&eacute;al pour vous. </p>
                            <h4>Apportez votre maillot de bain</h4>
                            <p>Aucune obligation - vous serez &eacute;tonn&eacute; de constater &agrave; quel point nos spas sont relaxants.</p>
                            <h4>VOUS PR&Eacute;F&Eacute;REZ NE PAS VOUS MOUILLER?</h4>
                            <p>Vous pouvez au moins prendre place dans un spa vide pour voir s'il a la bonne profondeur et si les si&egrave;ges sont confortables.</p>
                        </div>
                    <?php } ?>
                    <div class="dealer-brochure widge gld">
                        <h4>Brochure Jacuzzi</h4>
                        <p>40 pages de<br />faits et de photos<br /><span style="text-transform:none">Gratuitement</span></p>
                        <a href="<?php echo get_permalink(3745) ?>" class="black-button" onclick="_gaq.push(['_trackEvent', 'DealerLocator', 'Get-Brochure']);">OBTENIR MA BROCHURE<div class="fs1" aria-hidden="true" data-icon="&#xe127;"><div class="arrow-cover-l"></div></div></a>
                    </div>
                    <div class="dealer-services widge gld">
                        <h4>Entretien des spas</h4>
                        <ul>
                            <?php echo $dealer_services; ?>
                        </ul>
                    </div>
                </div>
                <div class="clr"></div>
            </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
