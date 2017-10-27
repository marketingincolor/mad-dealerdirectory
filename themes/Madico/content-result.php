    <div class="container">
    <div class="row">
        <div class="row-height-20"></div>
        <div class="dealer-result">
            <?php 
              /* TO list dealer list page based on the search query */
            $flim_type= $_REQUEST['flim_type'];
            $removeSpecial_filmType=str_replace("_"," ",$flim_type); /* to remove the special characters in a string */
            $convertedString  = ucwords($removeSpecial_filmType);
            $finalConSt = str_replace(' A', ' a', $convertedString); /* to remove the special characters in a string */
            
            $zip_startvalue = $_REQUEST['zip_startvalue'];
            $zip_endvalue = $_REQUEST['zip_endvalue'];
            if(!empty($flim_type) && !empty($_REQUEST['StateFilm'])){ /* breadcrumb to display for state and city values*/
            ?>
            <p class="breadcrumb-custom">You searched for 
                <?php echo $finalConSt ?> in
                <?php if(!empty($_REQUEST['CityFilm'])) { echo $_REQUEST['CityFilm'].','; } ?>
                <?php echo (($_REQUEST['StateFilm']=='0') ? $state='': $state = $_REQUEST['StateFilm']); ?>
            </p>
            <?php 
            } else if(!empty($flim_type) && !empty($zip_startvalue)) { /* breadcrumb to display for zipcode values */
            ?>
            <p class="breadcrumb-custom">You searched for
                <?php echo $finalConSt ?> in zip code range
                <?php echo (($zip_startvalue) ? $zip_startvalue : $zip_startvalue); ?>
                <?php echo (($zip_endvalue) ? ' - '.$zip_endvalue : $zip_endvalue); ?>
            </p>
            <?php
            }
            ?>

            <div class="dealer-result-row clearfix">
                <hr class="hidden-sm hidden-xs">
                <ul>
                    <?php
                    
                    (($_REQUEST['CityFilm'] == '0') ? $city = '' : $city = $_REQUEST['CityFilm']);
                    (($_REQUEST['StateFilm'] == '0') ? $state = '' : $state = $_REQUEST['StateFilm']);
                    (($_REQUEST['showAll']) ? $show_all = $_REQUEST['showAll'] : $show_all = '6' );

                    $ordermethod = 'ASC';
                    //$show_all='6';
                    if (!empty($state) && (!empty($city)) && (!empty($flim_type))) {

                        $dealer_list = array(
                            'posts_per_page' => $show_all,
                            'offset' => 0,
                            'category' => '',
                            //'category_name' => 'blog',
                            'orderby' => 'title',
                            'meta_query' => array(
                                'relation' => 'and',
                                array(
                                    'key' => $flim_type,
                                    'value' => sprintf(':"%d";', 1),
                                    'compare' => 'LIKE'
                                ),
                                array(
                                    'key' => 'state',
                                    'value' => $state,
                                ),
                                array(
                                    'key' => 'city',
                                    'value' => $city,
                                ),
                                array(
                                'key' => '_enable_dealer',
                                'value'   => '1',
                                )
                            ),
                            'order' => $ordermethod,
                            'post_type' => 'dealer',
                            'post_mime_type' => '',
                            'compare' => 'LIKE',
                            'post_parent' => '',
                            'author' => '',
                            'post_status' => 'publish',
                            'suppress_filters' => true
                        );
                    } else if (!empty($state) && (empty($city)) && (!empty($flim_type))) {

                        $dealer_list = array(
                            'posts_per_page' => $show_all,
                            'offset' => 0,
                            'category' => '',
                            //'category_name' => 'blog',
                            'orderby' => 'title',
                            'meta_query' => array(
                                'relation' => 'and',
                                array(
                                    'key' => $flim_type,
                                    'value' => sprintf(':"%d";', 1),
                                    'compare' => 'LIKE'
                                ),
                                array(
                                    'key' => 'state',
                                    'value' => $state,
                                ),
                                array(
                                'key' => '_enable_dealer',
                                'value'   => '1',
                                )
                            ),
                            'order' => $ordermethod,
                            'post_type' => 'dealer',
                            'post_mime_type' => '',
                            'compare' => 'LIKE',
                            'post_parent' => '',
                            'author' => '',
                            'post_status' => 'publish',
                            'suppress_filters' => true
                        );
                    } else if (!empty($zip_startvalue) && (!empty($zip_endvalue)) && (!empty($flim_type))) {
                        $dealer_list = array(
                            'posts_per_page' => $show_all,
                            'offset' => 0,
                            'category' => '',
                            'orderby' => 'title',
                            'meta_query' => array(
                                'relation' => 'and',
                                array(
                                    'key' => $flim_type,
                                    'value' => sprintf(':"%d";', 1),
                                    'compare' => 'LIKE'
                                ),
                                array(
                                    'key' => 'zip',
                                    'value' => array($zip_startvalue, $zip_endvalue),
                                    'type' => 'UNSIGNED',
                                    'compare' => 'BETWEEN',
                                ),
                                array(
                                'key' => '_enable_dealer',
                                'value'   => '1',
                                )
                            ),
                            'order' => 'ASC',
                            'post_type' => 'dealer',
                            'post_mime_type' => '',
                            'post_parent' => '',
                            'author' => '',
                            'post_status' => 'publish',
                            'suppress_filters' => true
                        );
                    } else {

                        $dealer_list = array(
                            'posts_per_page' => $show_all,
                            'offset' => 0,
                            'category' => '',
                            'orderby' => 'title',
                            'meta_query' => array(
                                'relation' => 'and',
                                array(
                                'key' => '_enable_dealer',
                                'value'   => '1',
                                )
                            ),
                            'order' => 'ASC',
                            'compare' => 'LIKE',
                            'post_type' => 'dealer',
                            'post_mime_type' => '',
                            'post_parent' => '',
                            'author' => '',
                            'post_status' => 'publish',
                            'suppress_filters' => true
                        );
                    }
                    $dealers = get_posts($dealer_list);
                    /* Post Count to use to hide and Show the load more and count button to user */
                    $post_count = count($dealers);
                    if ($dealers):
                        foreach ($dealers as $post) : setup_postdata($post);
                            ?>
                            <!-- First Row -->
                            <li class="col-md-4 col-sm-6 col-xs-12 count" >
                                <div class="address-title">
                                    <h2><a href="<?php the_permalink(); ?>">
                                            <?php
                                            $text = get_field('company_name');
                                            echo $text;
//                                            $content = strip_tags($text);
//                                            $excerpt = substr($content, 0, 20);
//                                            $excerpt_length = strlen($content);
//                                            echo ($excerpt_length > 23 ? (strip_tags($excerpt) . '...') : $excerpt);
                                            ?></a>
                                    </h2>
                                    <div class="brand_imgs">
                                        <?php
                                        $brand_1 = get_post_meta($post->ID, 'madico', true);
                                        $brand_2 = get_post_meta($post->ID, 'sunscape', true);
                                        $brand_3 = get_post_meta($post->ID, 'safetyshield', true);
                                        $brand_4 = get_post_meta($post->ID, 'sungard', true);
                                        $brand_5 = get_post_meta($post->ID, 'clearplex', true);
                                        echo ($brand_1[0] == 1 ? '<img src=' . get_template_directory_uri() . '/images/madico-icon.png  width="22" height="21"/> ' : "");
                                        echo ($brand_3[0] == 1 ? '<img src=' . get_template_directory_uri() . '/images/safety-shield-icon.png  width="22" height="21"/> ' : "");
                                        echo ($brand_2[0] == 1 ? '<img src=' . get_template_directory_uri() . '/images/sunscape-icon.png  width="22" height="21"/> ' : "");
                                        echo ($brand_4[0] == 1 ? '<img src=' . get_template_directory_uri() . '/images/sungard-icon.png  width="22" height="21"/> ' : "");
                                        echo ($brand_5[0] == 1 ? '<img src=' . get_template_directory_uri() . '/images/clearplex-icon.png  width="22" height="21"/> ' : "");
                                        ?>
                                    </div>
                                </div>
                                <div class="address">
                                    <p class="address_content">
                                        <span class="street_field">
                                            <?php echo (get_field('street') ? strip_tags(get_field('street')) : ''); ?>
                                        </span>
                                        <?php echo (get_field('city') ? get_field('city') . ',' : ''); ?>
                                        <?php echo (get_field('state') ? get_field('state') : ''); ?> <?php echo (get_field('zip') ? get_field('zip') : ''); ?></p>
                                    <p><?php echo (get_field('phone_number') ? get_field('phone_number') : ''); ?></p>
                                    <p><a target="_blank" href="http://<?php echo (get_field('website') ? get_field('website') : 'javascript:void(0)'); ?>"><?php echo (get_field('website') ? get_field('website') : ''); ?></a></p>
                                </div>
                                <div class="result-social-media">
                                    <div class="social_links">
                                        <?php
                                        $fb_act = get_post_meta($post->ID, 'facebook_status', true);
                                        $tw_act = get_post_meta($post->ID, 'twitter_status', true);
                                        $ln_act = get_post_meta($post->ID, 'linkedin_status', true);

                                        echo ($fb_act[0] == 1 && (get_field('facebook')) ? '<a target="_blank" href="' . get_field('facebook') . '"><i class="fa fa-facebook-official" aria-hidden="true"></i></a> ' : '' );
                                        echo ($tw_act[0] == 1 && (get_field('twitter')) ? '<a target="_blank" href="' . get_field('twitter') . '"><i class="fa fa-twitter" aria-hidden="true"></i></a> ' : '' );
                                        echo ($ln_act[0] == 1 && (get_field('linkedin')) ? '<a target="_blank" href="' . get_field('linkedin') . '"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> ' : '' );
                                        ?>
                                    </div>
                                </div>
                                <div class="blue-btn">
                                    <a href="<?php the_permalink(); ?>" class="button button--fsp">Read More</a>
                                </div>
                            </li>
                            <?php
                        endforeach;
                    else:
                        echo 'No Result Found';
                    endif;
                    wp_reset_postdata();
                    ?>
                </ul>
                <hr>
            </div>
            <!-- hide fields to get the value for show all and loadmore button processs -->
            <div class="row-height-20"></div>
            <input type="hidden" id="flim_val" value="<?php echo $flim_type; ?>">
            <input type="hidden" id="state_val" value="<?php echo $state; ?>">
            <input type="hidden" id="city_val" value="<?php echo $city; ?>">
            <input type="hidden" id="zipstart_val" value="<?php echo $zip_startvalue; ?>">
            <input type="hidden" id="zipend_val" value="<?php echo $zip_endvalue; ?>">

            <!-- show all block -->

            <?php if (($show_all !== '-1') && $post_count > '5'): ?>
                <section id="showdealears_btn">
                    <div class="show-all-blk">
                        <div class="three-dot">
                            <div class="lightblue-btn">
                                <a href="javascript:void(0)" id="loadmore" alt="" class="button button--fsp">
                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                    <i class="fa fa-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="lightblue-btn">
                            <a href="javascript:void(0);" id="show_all" alt="hi" class="button button--fsp">Show all</a>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <p id="no_result"></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var len = jQuery('li.count').length;
        
        jQuery("#loadmore").attr('alt', len);
        jQuery('#loadmore').on('click', function () {
            loadmoredealers();

        });

        function loadmoredealers() {
            var add_more = parseInt("3");
            var length = jQuery('#loadmore').attr('alt');
            var loadmore_dealers = parseInt(length) + add_more;
            console.log(length + loadmore_dealers);
            var state_value = jQuery('#state_val').val();
            var flim_value = jQuery('#flim_val').val();
            var city_value = jQuery('#city_val').val();
            var zipstart_val = jQuery('#zipstart_val').val();
            var zipend_val = jQuery('#zipend_val').val();
            var homeURL = jQuery("#siteurl").attr('href');
            var ajaxurl = homeURL + "/wp-admin/admin-ajax.php";
            var data = {
                action: 'loadmore_dealers',
                showAll: loadmore_dealers,
                StateFilm: state_value,
                CityFilm: city_value,
                flim_type: flim_value,
                zip_startvalue: zipstart_val,
                zip_endvalue: zipend_val
            }

            jQuery(document).ajaxStop(jQuery.unblockUI);
            //jQuery(document).ajaxStop(jQuery('#show_all').hide('1000'));
            jQuery.blockUI({
                message: '<i class="fa fa-spinner fa-spin" style="color:#fff;font-size: 50px;"></i>',
                css: {
                    border: 'none',
                    padding: '10px',
                    backgroundColor: 'none',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    'left': '35%',
                    // 'width':'10%',
                    'margin': '0px 0px 0px 0px',
                    color: '#fff'
                }});
            //setTimeout(jQuery.unblockUI, 2000);
            jQuery.post(ajaxurl, data, function (response) {
                jQuery('#dealer_res').html(response);
                var len = jQuery('li.count').length;
                if (len < loadmore_dealers) {
                    jQuery('#showdealears_btn').css({"display": "none"});
                    jQuery('#no_result').html('All dealers has displayed')
                }
            });
            return false;
        }

        jQuery('#show_all').on('click', function () {
            showalldealers();
        });
        /* show all process on result page*/
        function showalldealers() {
            var show_dealers = '-1';
            console.log(show_dealers);
            var state_value = jQuery('#state_val').val();
            var flim_value = jQuery('#flim_val').val();
            var city_value = jQuery('#city_val').val();
            var zipstart_val = jQuery('#zipstart_val').val();
            var zipend_val = jQuery('#zipend_val').val();
            console.log(state_value + flim_value + city_value);
            var homeURL = jQuery("#siteurl").attr('href');
            var ajaxurl = homeURL + "/wp-admin/admin-ajax.php";
            var data = {
                action: 'showall_dealers',
                showAll: show_dealers,
                StateFilm: state_value,
                CityFilm: city_value,
                flim_type: flim_value,
                zip_startvalue: zipstart_val,
                zip_endvalue: zipend_val
            }
            console.log(data);
            jQuery(document).ajaxStop(jQuery.unblockUI);
            //jQuery(document).ajaxStop(jQuery('#show_all').hide('1000'));
            jQuery.blockUI({
                message: '<i class="fa fa-spinner fa-spin" style="color:#fff;font-size: 50px;"></i>',
                css: {
                    border: 'none',
                    padding: '10px',
                    backgroundColor: 'none',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    'left': '35%',
                    // 'width':'10%',
                    'margin': '0px 0px 0px 0px',
                    color: '#fff'
                }});
            //setTimeout(jQuery.unblockUI, 2000);
            jQuery.post(ajaxurl, data, function (response) {
                jQuery('#dealer_res').html(response);
            });
            return false;
        }

    });
</script>