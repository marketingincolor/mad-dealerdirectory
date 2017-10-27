<?php
/**
 * Template Name: Contact Us
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

if(isset($_POST['save'])){
    $userType = $_POST['UserType'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $organization = $_POST['Organization'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $country = $_POST['Country'];
    $state = $_POST['State'];
    $city = $_POST['city'];
    $automotive = $_POST['Automotive'];
    $architectural = $_POST['Architectural'];
    $safetySecurity = $_POST['Safety_&_Security'];
    $other = $_POST['Other'];
    $products = array($automotive,$architectural,$safetySecurity,$other);
    $productsFilter = array_filter($products);
    $productResult = implode(', ', $productsFilter);
    $comments = $_POST['Comments'];
    
    $subject = 'Consumer Window Film Inquiry from Madico, Inc.';

    $message = "<html><head></head>"
            . "<body style='background:#5D5D5D; font-size:10px; margin:0; color:#000000; padding:0; font-family: 'Helvetica', arial, sans-serif;'>"
            . "<div style='background:#ffffff; width:600px; margin:0 auto;'>"
            . "<div><img src='".get_template_directory_uri()."/images/email-header.jpg' alt='Madico Logo' style='border: 0;vertical-align: middle;'></div>"
            . "<div style='padding-top:25px; padding-bottom:25px; padding-left:25px; padding-right:25px;background:#f4f4f4;'>"
            . "<h2 style='text-align:center; font-size:22px; color:#010204; font-weight:normal;'><b>Consumer Information</b></h2>"
            . "<table style='width: 100%;margin: 20px auto;border: 0;border-spacing: 3px;border-collapse: separate;'>"
            . "<tbody>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Consumer Type</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$userType."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>First Name</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$firstName."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Last Name</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$lastName."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Organization</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$organization."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Email</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$email."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Phone</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$phone."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Country</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$country."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>State</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$state."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>City</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$city."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Products Interested</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$productResult."</td>"
            . "</tr>"
            . "<tr>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: center;font-size: 13px;'><b>Comments</b></td>"
            . "<td style='border: 1px solid #e3e3e3;padding: 7px 9px;background: #fff;text-align: left;font-size: 13px;'>".$comments."</td>"
            . "</tr>"
            . "</tbody>"
            . "</table>"
            . "<div>"
            . "<table style='width: 100%;margin: 20px auto;border: 0;border-spacing: 3px;border-collapse: separate;'>"
            . "<tbody>"
            . "<tr>"
            . "<td style='text-align:center; background:#5f5f5f;'><p style='color:#ffffff; font-size:13px;'>&copy; Madico Inc. All rights reserved</p></td>"
            . "</tr>"
            . "</tbody>"
            . "</table>"
            . "</div>"
            . "</div>"
            . "</div>"
            . "</body>"
            . "</html>";
    
    $to = 'windowfilm@madico.com'; //toAddress
    $headers = array('Content-Type: text/html; charset=UTF-8\r\n'); //headers
    $mailSend = wp_mail($to, $subject, $message,$headers);
    if($mailSend == 1) {   
    do_shortcode('[cfdb-save-form-post]'); // storing into the database
    wp_redirect(home_url('/thankyou')); //redirect to thankyou page
    
    } else {
        $failureMessage = 1; // for failure message
    }
}

?>
<!-- content starts here -->
<div class="contact-us-container">
    <div class="container">
        <div class="contact-us-blk-container">
            <h2 class="md-title">Contact Madico</h2>
            <hr>
            <p>
                Whether A commercial architect, a homeowner, or an automobile enthusiast. Madico has a product that will greatly improve the glass that surrounds you. To learn more about Madico Window Films, submit the form below and we'll respond to you at our earliest opportunity.
            </p>
        </div>
        <?php //Displaying the Failure Message
        if(!empty($failureMessage)) { ?>
        <div style="border: 1px solid #FF0000;text-align: center;border-radius: 18px;">
        <span style="color:#FF0000;font-size: 19px;padding: 2px 3px 4px 15px;display: inline-block;"><i class="fa fa-times" aria-hidden="true"></i></span>
        <span style="color:#FF0000;font-size: 16px;">Failed to submit your request</span>
        </div>
        <?php 
        }
        ?>
        <div class="contact-us-form">
            <form role="form" method="post" id="contactusPage">
                <input type="hidden" name="form_title" value="ContactUsMadico"/>
                <div class="col-md-12 col-xs-10">
                    <div class="row">
                        <h4>Please choose one of the following: *</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="validation-box">
                    <label id="UserType-error" class="error" for="UserType" ></label>
                </div>
                <div class="contact-field-top clearfix">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="contact-form-blk col-sm-pull-left">
                                <ul>
                                    <li>
                                        <div class="consumer">
                                            <div class="checkbox">
                                                <input type="radio" name="UserType" id="consumer" value="Consumer"><label for="consumer"><span></span>I am a consumer</label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="contact-form-blk pull-right col-sm-pull-right">
                                <ul>
                                    <li>
                                        <div class="professional">
                                            <div class="checkbox">
                                                <input type="radio" name="UserType" id="professional" value="Professional"><label for="professional"><span></span>I am a window film professional</label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-field">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="contact-form-blk col-sm-pull-left">
                                <ul>
                                    <li> <input type="text" class="form-control" placeholder="First Name *"  name="FirstName"></li>
                                    <li><input type="text" class="form-control" placeholder="Last Name *" name="LastName"></li>
                                    <li><input type="text" class="form-control" placeholder="Organization" name="Organization"></li>
                                    <li><input type="text" class="form-control" placeholder="Email Address *" name="Email"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="contact-form-blk pull-right col-sm-pull-right">
                                <ul>
                                    <li> <input type="text" class="form-control" placeholder="Phone *" name="Phone" id="phoneNumber"></li>
                                    <li>
                                        <select name="Country" id="countryId" class="country">
                                            <option value="0">Country *</option>
                                            <option value='USA'>United States</option>
                                            <option value='Canada'>Canada</option>
                                        </select>
                                    </li>
                                    <li>
                                        <input type="text" class="form-control" placeholder="State/Province *" name="state" id="state">
                                        <!--<select name="State" class="state" id="stateId">
                                             <option value="0">State/Province *</option>
                                        </select>-->
                                    </li>
                                    <li>
                                    <input type="text" class="form-control" placeholder="City *" name="city" id="city">
                                        <!--<select name ="city" id ="city" class="city">
                                            <option value="0">City *</option>
                                        </select>-->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-check-blk" id="productsList">
                    <div class="row">
                        <h4>What products are you interested in? Check all that apply. *</h4>
                        <div class="checkbox" >
                            <input type="hidden" name="products" id="products"/>
                            <input type="checkbox" class="checkbox" id="automotive" name="Automotive" value="Automotive"><label for="automotive"><span></span> Automotive</label>
                            <input type="checkbox" class="checkbox" id="architectural" name="Architectural" value="Architectural"><label for="architectural"><span></span> Architectural</label>
                            <input type="checkbox" class="checkbox" id="safety-security" name="Safety & Security" value="Safety & Security"><label for="safety-security"><span></span> Safety & Security</label>
                            <input type="checkbox" class="checkbox" id="other" name="Other" value="Other"><label for="other"><span></span> Other</label>
                        </div>
                       <div class="validation-text">
                             <label id="products-error" class="error" for="products"></label>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 comments-blk">
                    <div class="row">
                        <h4>Questions and comments *</h4>
                        <textarea class="form-control" rows="6"  placeholder="Type Message Here..." name="Comments"></textarea>
                    </div>
                </div>
                <div class="blue-btn">
                <input type="submit" class="button button_fsp" value="Submit" name="save" id="save"/>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- content starts here -->
<?php
get_footer('madico');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery('#save').click(function(){
          jQuery('#UserType-error').css({ display: "block" });
       });
       
       jQuery('input:radio').click(function() {
            jQuery('input:radio[name='+jQuery(this).attr('name')+']').parent().removeClass('contact-active');
            jQuery(this).parent().addClass('contact-active');
       });
       
    });
</script>