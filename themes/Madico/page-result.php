<?php
/**
 * Template Name: Result page
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : The template for displaying the home page details
 * @Created At  : 15 June 2016
 * @Modified At :
 * @Created By  : Sathiyaraj
 * @Modified By :
 */
/** Header Section********** */
get_header('madico');
?>
<!-- content starts here -->
<section>
    <div class="legend">
        <div class="container">
            <h4>Legend</h4>
            <ul>
                <?php
                /* To display the slider from the result slider section */
                $legend_slider_list = array(
                    'posts_per_page' => -1,
                    'offset' => 0,
                    //'category' => 'result-brandslider',
                    'category_name' => 'result-brandslider',
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_type' => 'footerslider',
                    'post_mime_type' => '',
                    'post_parent' => '',
                    'author' => '',
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $legend_slider = get_posts($legend_slider_list);
                if ($legend_slider):
                    foreach ($legend_slider as $post) : setup_postdata($post);
                        $slider_img = get_post_meta($post->ID, 'wpcf-slider-image', false);
                        ?>
                        <li>
                            <a href="<?php echo $post->ID; ?>" class="madico-slider-btn" data-toggle="modal" >
                                <img src="<?php echo $slider_img[0]; ?>"/><span><?php the_title(); ?></span>
                            </a>
                            
                        </li>
                        <?php
                    endforeach;
                else:
                    echo '';
                endif;
                wp_reset_postdata();
                ?>
            </ul>
        </div>
    </div>
</section>
<section>
   <!-- Display the  -->
   <div id="dealer_res">
   <?php
        echo get_template_part('content','result');
   ?>
    </div>
</section>
<p id="back-top" style="display: block;">
        <a href="#top">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </a>
</p>
<!-- content ends here -->
<div class="bottom-slider"><h3 style="text-align:center; font-weight:bold; margin:0; color:#5F5F5F;">Our Brands</h3>
        <div class="container">
            <div class="slider responsive">
                <?php
                /* To display the slider from the home&result slider section */
                $slider_list = array(
                    'posts_per_page' => -1,
                    'offset' => 0,
                    //'category' => 'home-brandslider',
                    'category_name' => 'home-brandslider',
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_type' => 'footerslider',
                    'post_mime_type' => '',
                    'post_parent' => '',
                    'author' => '',
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $slider = get_posts($slider_list);
                if ($slider):
                    foreach ($slider as $post) : setup_postdata($post);
                        $slider_img = get_post_meta($post->ID, 'wpcf-slider-image', false);
                        $slider_link = get_post_meta($post->ID, 'wpcf-slider-website', true);
                        ?>
                        <div>
                            <a href="<?php echo $slider_link;//$post->ID; ?>" class="" data-toggle="NOTmodal" target="_blank">
                                <img src="<?php echo $slider_img[0]; ?>"/>
                            </a>
                        </div>
                        <?php
                    endforeach;
                else:
                    echo '';
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

<!-- Modal -->
<a href="javascript:void(0)" data-toggle="modal" class="rep_modal displayhidden">Click Me For A Modal</a>
<div class="modal fade" id="myModal" tabindex="-1" tabindex="-1" data-replace="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content-outer">
            <div class="modal-content">
            </div>
        </div>
    </div>
</div>

<?php
get_footer('madico');
?>