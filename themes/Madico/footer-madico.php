
        <footer>
            <div class="footer">
                <div class="container">
                    <div class="footer-top-links clearfix">
                        <?php  /**Menu-bar for footer section **/
                        if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu(array('menu' => 'primary',
                                'theme_location' => 'footer',
                                'container' => false ));
                         } ?>
                    </div>
                    <div class="footer-bottom-img">
                        <ul>
                    <?php
                    /*To display the Footer Images from the Footer Image section*/
                        $footer_img = array(
                                'posts_per_page' => 5,
                                'offset' => 0,
                                'category' => '',
                                //'category_name' => 'blog',
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'post_type' => 'footerimage',
                                'post_mime_type' => '',
                                'post_parent' => '',
                                'author' => '',
                                'post_status' => 'publish',
                                'suppress_filters' => true
                            );
                        $fimg = get_posts($footer_img);
                        if ($fimg):
                        foreach ($fimg as $post) : setup_postdata($post);
                        $foot_img = get_post_meta($post->ID,'wpcf-footer-logo',false);
                        $web_link = get_post_meta($post->ID,'wpcf-web-link',false);
                    ?>
                        <li><a target="_blank" href="<?php echo(!empty($web_link[0])?$web_link[0]:'javascript:void(0)'); ?>"><img src="<?php echo $foot_img[0]; ?>" alt=""/></a></li>
                    <?php
                        endforeach;
                        else:
                        echo '';
                        endif;
                        wp_reset_postdata();
                    ?>
                        </ul>
                    </div>
                    <div class="footer-bottom">
                         <p>Copyright © <?php echo date("Y"); ?> Madico, Inc.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer ends here -->
        <?php wp_footer(); ?>
    </body>
</html>