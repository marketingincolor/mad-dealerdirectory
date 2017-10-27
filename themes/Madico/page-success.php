<?php
/**
 * Template Name: Success Page 
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : The template for displaying the home page details
 * @Created At  : 03 August 2016
 * @Modified At :
 * @Created By  : Sathiyaraj
 * @Modified By :
 */
/** Header Section********** */
get_header('madico');
?>
<!-- content starts here -->
<div class="success-container">
    <div class="container">
        <h2 class="md-title">Success!</h2>
        <div class="success-msg">
            <hr>
            <p> We've received your information and will be touch soon. <br class="hidden-xs"/>
                We look forward to talking with you!</p>
        </div>
        <div class="contact-madico-container">
            <div class="container">
                <div class="row">
                    <div class="contact-madico">
                        <h2 class="md-title">Connect with Madico</h2>
                        <ul>
                            <li><div class="fb-like" data-href="https://www.facebook.com/MadicoWindowFilms" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div></li>
                            <li><a href="https://twitter.com/MadicoInc" class="twitter-follow-button" data-show-count="default">Follow @MadicoInc</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script></li>
                            <li><script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                                <script type="IN/FollowCompany" data-id="119045" data-counter="right"></script></li>
                            <li><div class="g-follow" data-annotation="bubble" data-height="24" data-href="https://plus.google.com/109912744876993567602" data-rel="publisher"></div></li>
                        </ul>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

</div>
<!-- content starts here -->
<?php
get_footer('madico');
?>
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
