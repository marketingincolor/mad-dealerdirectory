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
