jQuery.noConflict();
	jQuery(function () {
/*
Function Created by : Mahendra Prasath.
Usage : To enable the dealeron front end.
*/
	jQuery(".enable_dealer").each(function(){
		jQuery(this).on('click', function() {
			var post_id = jQuery(this).prev('.postid').val();
			var homeurl = jQuery('#wp-admin-bar-site-name a').attr('href');
			var ajaxurl = homeurl+"/wp-admin/admin-ajax.php";
			if(this.checked){
				var cval='1';
				var data ={
					action :'enable_button',
					postID : post_id,
					cVal   : cval
				}
			    jQuery.post(ajaxurl, data, function(response) {
					if(response == 'Success'){
                	alert(response);
                	return false;
            		}
				});
			}else{
				var cval='0';
				var data ={
					action :'enable_button',
					postID : post_id,
					cVal   : cval
				}
			    jQuery.post(ajaxurl, data, function(response) {
					if(response == 'Success'){
                	alert(response);
                	return false;
            	}
				});
			}
		});
	});

	/* Setting the limit and validating the numeric fields options Page: Dealer Page */
	jQuery("#acf-field-dealer_id").inputmask({
  	mask: '99-9999'
	});
        
        /* Setting the limit and validating the phone number  Page: Dealer Page */
	jQuery("#acf-field-phone_number").inputmask({
  	mask: '999-999-9999'
	});
        

	/* Checking the unique validation for dealers id in Add Dealers page */
 	jQuery("#acf-field-dealer_id").blur(function(){
       var dealerID= jQuery('#acf-field-dealer_id').val();
//     var dealerID= $('#acf-field-dealer_id').val().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, ' ');
        var homeurl = jQuery('#wp-admin-bar-site-name a').attr('href');
	 var ajaxurl = homeurl+"/wp-admin/admin-ajax.php";
        jQuery.ajax({
                type: "POST",
                url :  ajaxurl,
                data : {  action: "check_DealerID",  username: dealerID},
                success : function(result) {
                   if(result === '1') {
                       jQuery('#errorResult').html('');
                       jQuery('#acf-dealer_id').after('<div id="errorResult" style="color:red;">Dealer ID already exists</div>');
                       jQuery('#publish').hide();
                   } else {
                       jQuery('#errorResult').html('');
                       jQuery('#publish').show();
                   }
                }
        });
        });
        
        /* copy the in Add Dealers page */
        jQuery("#acf-field-company_name").blur(function(event){
            var dealerName= jQuery(this).val();
            jQuery('#title').val(dealerName);
        });
        
        /* to hide the page title in edit dealer page*/
        var post_type = jQuery("#post_type").val();
        console.log(post_type);
        if(post_type == 'dealer'){
        	jQuery("#titlediv").hide();
        }
/*Main jQuery End*/
});