<?php
/**
 * Template Name: Home page
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : The template for displaying the home page details
 * @Created At  : 19 June 2016
 * @Modified At :
 * @Created By  : Sathiyaraj
 * @Modified By :
 */
/** Header Section********** */
get_header('madico');
?>
<!-- content starts here -->
<div class="homepage-container">
    <div class="carousel slide carousel-fade" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php
                /* To display the slider from the home&result slider section */
                $home_sliderList = array(
                    'posts_per_page' => -1,
                    'offset' => 0,
                    'category' => '',
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_type' => 'home_slider',
                    'post_mime_type' => '',
                    'post_parent' => '',
                    'author' => '',
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $homeSlider = get_posts($home_sliderList);
                if ($homeSlider):
                    foreach ($homeSlider as $post) : setup_postdata($post);
                        $slider_img = get_post_meta($post->ID, 'wpcf-home-slider-image', false);
                        ?>
                        <div class="item"
                       style='background: url("<?php echo $slider_img[0]; ?>") no-repeat center center ;
                        -webkit-background-size: cover;
                        -moz-background-size: cover;
                        -o-background-size: cover;
                        background-size: cover;'>
                        </div>
                        <?php
                    endforeach;
                else:
                    ?>
                    <div class="item"
                         style='background: url("<?php echo get_template_directory_uri().'/images/homepage-banner.png' ?>") no-repeat center center ;
                        -webkit-background-size: cover;
                        -moz-background-size: cover;
                        -o-background-size: cover;
                        background-size: cover;'>
                        </div>
                    <?php
                endif;
                wp_reset_postdata();
                ?>
        </div>
        <div class="txt-blk-container">
            <div class="txt-blk">
                <h2 class="hidden-xs hidden-sm">Welcome to the Madico Dealer Directory</h2>
                <h3>Locate a Madico window film dealer near you to discuss film options and schedule a professional installation.</h3>
            </div>
        </div>
        <div class="search-blk-container">
            <div class="search-blk">
                <div class="searchby">
                    <select class="Search_by" id="country">
                        <option value="">Search by...</option>
                        <option value="Location">Location</option>
                        <option value="ZipCode">Zip Code Range</option>
                    </select>
                </div>
                <div class="search-type">
                <form role="form" action="<?php echo home_url(); ?>/result-page" id="homeSearch" method="post">
                    <ul>
                        <li>
                            <select class="flim_type" id="filmType" name="flim_type">
                                <option value="0">Choose a Film Type...</option>
                                    <option value="automotive">Automotive</option>
                                    <option value="architectural">Architectural</option>
                                    <option value="safety_and_security">Safety and Security</option>
                                    <option value="windshield_protection">Windshield Protection</option>
                            </select>
                        </li>
                        <li class="location">
                            <select name="StateFilm" class="stateFilm" id="stateIdFilm">
                                <option value="0">Choose a State or Province...</option>
                            </select>
                        </li>
                        <li class="location">
                            <select name="CityFilm" class="cityFilm" id="cityIdFilm">
                                <option value="0">Choose a City...</option>
                            </select>
                        </li>
                        <li class="zipcode">
                            <input type="text" class="zip_clear" id="zip_startvalue" name="zip_startvalue" placeholder="Zip Code Range Starting Value 33700">
                        </li>
                        <li class="zipcode">
                            <input type="text" class="zip_clear" name="zip_endvalue" id="zip_endvalue" placeholder="Zip Code Range Ending Value 33800 ">
                        </li>
                        <li class="last-blk">
                                    <div class="blue-btn">
                                        <button type="submit" class="button button_fsp"><span>Go</span></button>
                                    </div>
                        </li>
                    </ul>
                </form>

                </div>

            </div>
        </div>
    </div>

    <div class="bottom-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 pad-zero vcenter"><img class="img-full" src="<?php echo get_template_directory_uri(); ?>/images/home-mfilm-img.jpg" /></div>
                <div class="col-sm-12 col-md-6 content-parent vcenter">
                    <div class="content">
                        <p><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/home-mfilm-logo.png" /></p>
                        <p>Whether a commercial architect, a homeowner, or an automobile enthusiast, Madico<sup>&reg;</sup> has a product that will greatly improve the glass that surrounds you. Trusted by the Smithsonian, the Louvre, and many other architectural landmarks, Madico has been improving windows with films for more than 40 years.</p>
                        <p><a href="http://madico.com" target="_blank" class="more-btn">Learn More</a><br class="hidden-md"><br class="hidden-md"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="hidden-md hidden-lg col-sm-12 pad-zero vcenter"><img class="img-full" src="<?php echo get_template_directory_uri(); ?>/images/home-sshield-img.jpg" /></div>
                <div class="col-sm-12 col-md-6 content-parent vcenter">
                    <div class="content">
                        <p><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/home-sshield-logo.png" /></p>
                        <p>We live in a far from perfect world. Whether it is man or nature, destructive forces are all around us. Madico is and always has been the pioneer and world leader in the development of window protection systems, like SafetyShield<sup>&reg;</sup>, that guard against everything from criminal acts to catastrophic events.</p>
                        <p><a href="http://safetyshield.com" target="_blank" class="more-btn">Learn More</a><br class="hidden-md"><br class="hidden-md"></p>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-6 pad-zero vcenter"><img class="img-full" src="<?php echo get_template_directory_uri(); ?>/images/home-sshield-img.jpg" /></div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 pad-zero vcenter"><img class="img-full" src="<?php echo get_template_directory_uri(); ?>/images/home-sscape-img.jpg" /></div>
                <div class="col-sm-12 col-md-6 content-parent vcenter">
                    <div class="content">
                        <p><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/home-sscape-logo.png" /></p>
                        <p>Sunscape<sup>&reg;</sup> window films celebrate everything we love about the sun, while creating a safe, energy-efficient environment that captivates as well as it protects. Your family will enjoy cooler summers and warmer winters, along with the benefits of reduced glare and UV exposure, in a superior window film product that lasts for a lifetime.</p>
                        <p><a href="http://sunscapefilms.com" target="_blank" class="more-btn">Learn More</a><br class="hidden-md"><br class="hidden-md"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="hidden-md hidden-lg col-sm-12 pad-zero vcenter"><img class="img-full" src="<?php echo get_template_directory_uri(); ?>/images/home-clearplex-img.jpg" /></div>
                <div class="col-sm-12 col-md-6 content-parent vcenter">
                    <div class="content">
                        <p><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/home-clearplex-logo.png" /></p>
                        <p>Driving on today's highways can be hazardous, especially to your windshield. ClearPlex<sup>&reg;</sup> Windshield Protection Film by Madico is a premium optically-clear protection film for vehicle windshields. It absorbs the impact of standard road hazards, significantly reducing the occurance of rock chips, stars, pitting, and bull's eyes&mdash;leaving the glass in pristine condition.</p>
                        <p><a href="http://clearplex.com" target="_blank" class="more-btn">Learn More</a><br class="hidden-md"><br class="hidden-md"></p>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-6 pad-zero vcenter"><img class="img-full" src="<?php echo get_template_directory_uri(); ?>/images/home-clearplex-img.jpg" /></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <a href="javascript:void(0)" data-toggle="modal" class="rep_modal displayhidden">Click Me For A Modal</a>

    <div class="modal fade" id="myModal" tabindex="-1" tabindex="-1" data-replace="true">
    </div>
    <?php
    get_footer('madico');
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery(window).bind("pageshow", function() {
                jQuery('form').get(0).reset();
                jQuery('#country').val('');
                
            });
        });
    </script>