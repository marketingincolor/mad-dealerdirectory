<?php
/*
 Template Name: Sample
 */
                    $the_query = new WP_Query( 'post_type=dealer'); 
                    if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    
                    <h4 style="event-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
                    <p style="event-content"><?php the_content(); ?></p>
                    <a href="<?php the_permalink();?>" style="line-height: 78px;font-size: 14px;color: #D0C;">Read More...</a>
                    
                    <?php
                    endwhile;
                    endif;