<?php
/**
 * Template Name: 404 Page
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : The template for show instead of missing files.
 * @Created At  : 03 August 2016
 * @Modified At :
 * @Created By  : Sathiyaraj
 * @Modified By :
 */
/** Header Section********** */
get_header('madico');
?>
<!-- content starts here -->
<div class="oops-page-container">
    <div class="container">
        <section>
            <div class="oops-cont">
                <div class="oops-msg">
                <h3>Oops!</h3>
                <h4><span>Sorry, that page doesn't exist.</span> Let’s try that again.</h4>
                </div>
                 <img src="<?php echo get_template_directory_uri(); ?>/images/404-arrow.png"/>
            </div>
        </section>
            <section>
                <div class="oops-search-blk-container">
                    <div class="search-blk">
                <div class="searchby">
                    <select class="Search_by" id="country">
                        <option value="">Search By</option>
                        <option value="Location">Location</option>
                        <option value="ZipCode">Zip Code Range</option>
                    </select>
                </div>
                <div class="search-type">
                <form role="form" action="<?php echo home_url(); ?>/result-page" id="homeSearch" method="post">
                    <ul>
                        <li>
                            <select class="flim_type" id="filmType" name="flim_type">
                                <option value="0">Choose a Film Type</option>
                                    <option value="automotive">Automotive</option>
                                    <option value="architectural">Architectural</option>
                                    <option value="safety_and_security">Safety and Security</option>
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
            </section>
        </div>
</div>
<!-- content starts here -->
<?php
get_footer('madico');
?>