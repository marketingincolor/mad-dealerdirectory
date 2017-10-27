jQuery.noConflict();
    jQuery(function () {
/*To avoid the admin bar error while user sign in */
if (jQuery('#wpadminbar').length) {
       jQuery("html").css("cssText", "margin-top: 0px !important;");
}

/* Setting the phone number validation in contact us page */
jQuery("#phoneNumber").inputmask({
  mask: '999-999-9999'
});

/*Script for Home Page Brands Slider */
/*-----------------------------------*/
jQuery('.multiple-items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false
    });
    jQuery('.responsive').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

/* To show the pop-up on Home Page Brand Sliders */

   jQuery('.madico-slider-btn').click(function(){
        var sliderID = jQuery(this).attr('href');
            var sliderId = sliderID;
            var homeURL = jQuery("#siteurl").attr('href');
            var ajaxurl = homeURL+"/wp-admin/admin-ajax.php";
            var data ={
                action :'sliderPopup',
                sliderID : sliderId
            }
            jQuery.post(ajaxurl, data, function(response) {
            jQuery('.modal').html(response);
            if (!jQuery('.rep_modal').hasClass('modalActive')) {
                jQuery('.rep_modal').addClass('modalActive');
                jQuery('a.rep_modal').trigger('click');
            }
        });
        jQuery.ajaxSetup({
        async: true
        });
        return false;
   });

   /*Show the pop-up on homepage based on the image hover*/
   jQuery(".rep_modal").click(function () {
                jQuery('.modal').modal({
                    show: true
                });
                return false;
            });


/*Home page Search Process*/
    jQuery(".Search_by").on('change',function(){
        var search_val = jQuery(this).val();
        // console.log(search_val);
        jQuery('.location').show();
        if(search_val=='Location'){
            jQuery('.location').show();
            jQuery('.zipcode').hide();
            jQuery('.zip_clear').val('');
        }
        else if(search_val=='ZipCode'){
            jQuery('.location').hide();
            jQuery('.zipcode').show();
            jQuery('#stateIdFilm').prop('selectedIndex',0);
            jQuery('#cityIdFilm').prop('selectedIndex',0);
        }
        else{
            jQuery('.location').show();
            jQuery('.zipcode').hide();
            jQuery('.zip_clear').val('');
        }
    });

    /*Home Search Page zip code start value*/
    jQuery("#zip_startvalue").inputmask({
        mask: '9999?9'
    });
    /*Home Search Page zip code End value*/
    jQuery("#zip_endvalue").inputmask({
        mask: '9999?9'
    });

    jQuery('.carousel').carousel();
    /* appending the class to the first class in home page*/
    jQuery('.item:first-child').addClass('active');

     /* Checking the the cities with respect to the states and dealers */
        jQuery('select.flim_type').on('change', function() {
                var filmType = jQuery('#filmType').val();
                var homeURL = jQuery("#siteurl").attr('href');
                var ajaxurl = homeURL+"/wp-admin/admin-ajax.php";
                jQuery.ajax({
                    type: "POST",
                    url :  ajaxurl,
                    data : {  action: "filmtype_checkStates",  filmType: filmType},
                    success : function(resultJSON) {
                        jQuery('#stateIdFilm').html('');
                        jQuery('#stateIdFilm').html('<option value="0">Choose a State or Province...</option>');
                        var result = resultJSON;
                        jQuery.each(jQuery.parseJSON(result), function(k, v) {
                            jQuery('#stateIdFilm').append(jQuery("<option></option>").attr("value",k).text(v));
                        });
                    }
                });
            });

        /* Checking the the cities with respect to the states and dealers */
            jQuery('select.stateFilm').on('change', function() {
               var filmCitie = jQuery('#stateIdFilm').val();
               var filmType = jQuery('#filmType').val();
               var homeURL = jQuery("#siteurl").attr('href');
               var ajaxurl = homeURL+"/wp-admin/admin-ajax.php";
               jQuery.ajax({
                    type: "POST",
                    url :  ajaxurl,
                    data : {  action: "filmtype_checkCities",  filmCitie: filmCitie,filmType:filmType},
                    dataType: 'json',
                    success : function(json) {
                        jQuery('#cityIdFilm').html('');
                        jQuery('#cityIdFilm').html('<option value="0">Choose a City...</option>');
                        jQuery.each(json, function(i, value) {
                        jQuery('#cityIdFilm').append(jQuery('<option>').text(value).attr('value', value));
                        });
                   }
                });

           });


           /* To validate the select box for country,state and city in home page*/
            jQuery.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg != value;
            }, "Value must not equal arg.");

            /* To validate the zip code starting and ending value in home page*/
            jQuery.validator.addMethod("zip_code_checking", function(value, element) {
            return jQuery('#zip_endvalue').val() > jQuery('#zip_startvalue').val()
            }, "* Zip code end value should be greater than Zip code start value");


           jQuery("#homeSearch").validate({
            rules: {
                flim_type : {
                    valueNotEquals: "0"
                },
                StateFilm : {
                    valueNotEquals: "0"
                },
                zip_startvalue : {
                   required: true
                },
                zip_endvalue : {
                   required: true,
                   zip_code_checking: true
                }
            },
            messages: {
            },
            errorPlacement: function(){
            return false;
            }
        });

         /*Usage: Template:page-contactus */
jQuery.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg != value;
 }, "Value must not equal arg.");

jQuery.validator.addMethod("checkbox", function(value, element) {
    return jQuery('input[type=checkbox]:checked').length > 0;
},'Atleast');


jQuery("#contactusPage").validate({
    ignore:[],
//    errorClass: "validation-border",
    rules: {
        UserType: {
            required: true
        },
        FirstName : {
            required: true
        },
        LastName : {
            required: true
        },
        Email : {
            required: true,
            email: true
        },
        Phone : {
            required: true
        },
        Country : {
            valueNotEquals: "0"
        },
        State : {
            valueNotEquals: "0"
        },
        city : {
            valueNotEquals: "0"
        },
        Comments : {
            required: true
        },
        products: {
            required: function (element) {
                var boxes = jQuery('.checkbox');
                if (boxes.filter(':checked').length === 0) {
                    return true;
                }
                return false;
            },
            minlength: 1
        }

    },
    messages: {
        UserType: {
            required: "Please choose any option"
        },
//        email : {
//            required: "Please enter your Email address",
//            email: "Please enter valid Email address"
//        },
            products: "Please select at least one product"
    },
    errorPlacement: function(){
            return false;
    }
  });
      /*Usage: Template:page-contactus */
    jQuery("#contactDealerPage").validate({
    ignore:[],
    rules: {
        firstName: {
            required: true
        },
        lastName : {
            required: true
        },
        email : {
            required: true,
            email: true
        },
        message : {
            required: true
        }
    },
    messages: {
    },
    errorPlacement: function(){
            return false;
    },
        submitHandler: function (form) {
            jQuery('#contactDealer').prop('disabled', true);
            jQuery('#statusMessage').html(''); //to clear the status message
            jQuery('#spinLoader').append('<i class="fa fa-refresh fa-spin" style="color:#ffffff;font-size: 20px;"></i>');
            var dealerEmail = jQuery("#dealerEmail").val(), firstName = jQuery("#firstName").val(),lastName = jQuery("#lastName").val(),email = jQuery("#email").val(), message = jQuery("#message").val();
            var homeURL = jQuery("#siteurl").attr('href');
            var ajaxurl = homeURL+"/wp-admin/admin-ajax.php";
            jQuery.ajax({
                type: "POST",
                url :  ajaxurl,
                data : {  action: "contactDealer",  dealerEmail:dealerEmail,firstName:firstName,lastName:lastName,email:email,message:message },
                success : function(response) {
                    jQuery('#contactDealer').prop('disabled', false);
                    jQuery("#contactDealerPage")[0].reset(); // to clear the all the form values
                    jQuery('#spinLoader').html(''); //to hide the spin loader
                    jQuery('#statusMessage').html('');
                   if(response === '1') {
                        jQuery('#statusMessage').append('<div class="successEmail"><i class="fa fa-check" aria-hidden="true"></i>Success</div>'); // to append the status messages for email
                    } else {
                        jQuery('#statusMessage').append('<div class="failEmail"><i class="fa fa-times" aria-hidden="true"></i>Failure</div>'); // to append the status messages for email
                    }
                }
            });
        }
        });

        /* Checking the the states with respect to the countries and dealers | Page:Contact Us */
    jQuery('select.countryOMIT').on('change', function() {
    var country = jQuery('#countryId').val();
    var homeURL = jQuery("#siteurl").attr('href');
    var ajaxurl = homeURL+"/wp-admin/admin-ajax.php";
    jQuery.ajax({
        type: "POST",
        url :  ajaxurl,
        data : {  action: "check_States",  country: country},
        success : function(resultJSON) {
           jQuery('#stateId').html('');
           jQuery('#stateId').html('<option value="0">State/Province</option>');
           var result = resultJSON;
           jQuery.each(jQuery.parseJSON(result), function(k, v) {
               jQuery('#stateId').append(jQuery("<option></option>").attr("value",k).text(v));
            });
        }
    });
    });


/* Checking the the cities with respect to the states and dealers | Page:Contact Us*/
 jQuery('select.stateOMIT').on('change', function() {
    var cities = jQuery('#stateId').val();

    var homeURL = jQuery("#siteurl").attr('href');
    var ajaxurl = homeURL+"/wp-admin/admin-ajax.php";
    jQuery.ajax({
        type: "POST",
        url :  ajaxurl,
        data : {  action: "check_Cities",  city: cities},
        dataType: 'json',
        success : function(json) {
                jQuery('#city').html('');
                jQuery('#city').html('<option value="0">City</option>');
                jQuery.each(json, function(i, value) {
                jQuery('#city').append(jQuery('<option>').text(value).attr('value', value));
                });
        }
    });
});


        jQuery("#back-top").hide();
        // fade in #back-top
        jQuery(function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 600) {
                jQuery('#back-top').fadeIn();
            } else {
                jQuery('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        jQuery('#back-top a').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        });
        jQuery('.checkbox').on('click',function(){
            jQuery('#products-error').hide();
        });
});
