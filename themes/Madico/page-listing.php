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
                <h2 class="md-title">A-1 Window Tinters</h2>
                <hr>
            </div>
            <div class="clearfix"></div>
            <div class="dealer-listing">
                <div class="col-md-4 col-sm-5">
                    <div class="dealer-address-blk">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/window_tinters_logo.png" alt="Window Tinters" height="70"/>
                        <div class="dealer-address">
                            <ul>
                                <li class="city_address sprite">1234 Something St<br />City, ST 98765</li>
                                <li class="dealer-phone sprite">987-654-3210</li>
                                <li class="dealer-email sprite">Joe@a1windowtinters.com</li>
                                <li class="dealer-website sprite">A1WindowTinters.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="result-social-media">
                        <a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-7 mobile-padding">
                    <div class="contact-dealer">
                        <h1>Contact Dealer</h1>
                        <ul>
                            <li> <input type="text" class="form-control" placeholder="First Name" ></li>
                            <li><input type="text" class="form-control" placeholder="Last Name"></li>
                            <li><input type="text" class="form-control" placeholder="Email Address"></li>
                            <li><div class="comments-blk">
                                    <textarea class="form-control" rows="6"  placeholder="Type Message Here..."></textarea>
                                </div>
                            </li>
                            <li>
                                <div class="blue-btn">
                                    <a class="button button--fsp">Submit</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="share-page-container">
      
            <div class="row">
                <div class="share-page">
                    <h2 class="md-title">Share This Page</h2>
                    <ul>
                        <li><iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></li>
                        <li><iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></li>
                        <li><iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></li>
                        <li class="last"><iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></li>
                    </ul>
                </div>
            </div>
   
    </div>
</div>
<!-- content ends here -->
<?php
get_footer('madico');
?>