<?php
/**
 * Template Name: Alternate Default
 *
 * @package     : WordPress
 * @subpackage  : Twenty_Fifteen
 * @Description : The alternate default page template for displaying content
 * @Created At  : 6 October 2016
 * @Modified At :
 * @Created By  : eddt
 * @Modified By :
 */

get_header('madico');
?>
<!-- content starts here -->
<div class="default-container">
    <div class="container">
        <?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>
    </div>
</div>
<!-- content starts here -->
<?php
get_footer('madico');
?>
<script>
	if (location.href != "http://dealerdirectory.madico.com/contact-us/#wpcf7-f720-p8-o1") {
		jQuery('#country-select').prepend('<option value="" disabled selected>Select Country</option>');
		jQuery('#state-select').prepend('<option value="" disabled selected>Select State</option>');
		jQuery('#province-select').prepend('<option value="" disabled selected>Select Province</option>');
		jQuery('input:not(#organization-input),textarea,#country-select').prop('required',true);
	}

	jQuery('#country-select').on('change',function(){
		if(this.value == 'United States'){
			jQuery('#state-select').prop('required',true);
			jQuery('#province-select').prop('required',true);
		}else if(this.value == 'Canada'){
			jQuery('#province-select').prop('required',true);
			jQuery('#state-select').prop('required',false);
		}else{
			jQuery('#province-select').prop('required',false);
			jQuery('#state-select').prop('required',false);
		}
	});

	jQuery('.wpcf7-submit').on('click',function(){
		console.log('hello')
		var inputs = jQuery('input:not(#organization-input),textarea,#country-select')
		for(i = 0;i < inputs.length;i++){
			if(inputs[i].hasAttribute("required")){
	      if(inputs[i].value == ""){
	          // found an empty field that is required
	          alert("Please fill all required fields");
	          return false;
	      }
	    }
		}
		return true;
	});
</script>
