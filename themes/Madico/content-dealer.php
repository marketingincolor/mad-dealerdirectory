<?php
/**
 * Template Name: Listing page
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : The template for displaying the home page details
 * @Created At  : 20 June 2016
 * @Modified At :
 * @Created By  : Sathiyaraj
 * @Modified By :
 */
/** Header Section********** */
get_header('madico');
?>
<!-- content starts here -->
<div class="dealer-listing-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="md-title"><?php the_field('company_name'); ?></h2>
                <hr>
            </div>
            <div class="clearfix"></div>
            <div class="dealer-listing">
                <form method="post" id="contactDealerPage">
                    <div class="col-md-4 col-sm-5">
                        <div class="dealer-address-blk">
                            <?php
                            $image = get_field('logo');
                            if (!empty($image)) {
                                ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php the_field('company_name') ?>" />
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/icon.png" alt="Window Tinters">
                            <?php }
                            ?>
                            <div class="dealer-address">
                                <ul>
                                    <li class="city_address sprite">
                                        <span class="street_field">
                                            <?php echo (get_field('street') ? strip_tags(get_field('street')) : ''); ?>
                                        </span>
                                        <?php echo (get_field('city') ? get_field('city') . ',' : ''); ?><?php echo (get_field('state') ? get_field('state') : ''); ?> <?php echo (get_field('zip') ? get_field('zip') : ''); ?></li>
                                    <li class="dealer-phone sprite"><?php echo (get_field('phone_number') ? get_field('phone_number') : ''); ?></li>
                                    <li class="dealer-email sprite"><a href="mailto:<?php echo (get_field('email') ? get_field('email') : ''); ?>"><?php echo (get_field('email') ? get_field('email') : ''); ?></a></li>
                                    <input type="hidden" id="dealerEmail" name="dealerEmail" value="<?php echo (get_field('email') ? get_field('email') : ''); ?>"/>
                                    <li class="dealer-website sprite"><a target="_blank" href="http://<?php echo (get_field('website') ? get_field('website') : 'javascript:void(0)'); ?>"><?php echo (get_field('website') ? get_field('website') : ''); ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="result-mediacontainer">
                            <div class="result-social-media">
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
                        <div class="clear"></div>
                    </div>
                    <div class="col-md-8 col-sm-7 mobile-padding">
                        <div class="contact-dealer">
                            <h1>Contact Dealer</h1>
                            <ul>
                                <li><input type="text" class="form-control" name="firstName" placeholder="First Name *" id="firstName"></li>
                                <li><input type="text" class="form-control" name="lastName" placeholder="Last Name *" id="lastName"></li>
                                <li><input type="email" class="form-control" name="email"placeholder="Email Address *" id="email"></li>
                                <li><div class="comments-blk">
                                        <textarea class="form-control" rows="6" id="message" name="message" placeholder="Type Message Here... *"></textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="blue-btn">
                                        <input type="submit" name="contact-dealer" value="Send" class="button button--fsp" id="contactDealer"/>
                                        <span id="spinLoader"></span>
                                        <span id="statusMessage"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <section id="showdealears_btn">
                <div class="show-all-blk">
                    <div class="lightblue-btn">
                        <a href="#" alt="hi" class="button button--fsp" id="redirectBack">Back to Search Results</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="share-page-container">
        <div class="col-xs-12">
            <div class="share-page">
                <h2 class="md-title">Share This Page</h2>
                <ul>
                    <?php
                    if (function_exists('ADDTOANY_SHARE_SAVE_KIT')) {
                        ADDTOANY_SHARE_SAVE_KIT();
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- content ends here -->
<?php
get_footer('madico');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#redirectBack').click(function(){
            history.go(-1);
            return false;
        });
    });
</script>
