<?php
/**
 * @package WordPress
 * @subpackage Thematic post.php
 */
?>
<?php get_header(); ?>

        <!-- once upon a time this was  id="primary" -->
        <section class="main image-attachment">

            <?php the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><?php the_title(); ?></h2>

                        <div class="entry-meta">
                            <?php
                                $metadata = wp_get_attachment_metadata();
                                printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>  at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'themename' ),
                                    esc_attr( get_the_time() ),
                                    get_the_date(),
                                    wp_get_attachment_url(),
                                    $metadata['width'],
                                    $metadata['height'],
                                    get_permalink( $post->post_parent ),
                                    get_the_title( $post->post_parent )
                                );
                            ?>
                            <?php edit_post_link( __( 'Edit', 'themename' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-meta -->

                        <nav id="image-navigation">
                            <span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous' , 'themename' ) ); ?></span>
                            <span class="next-image"><?php next_image_link( false, __( 'Next &rarr;' , 'themename' ) ); ?></span>
                        </nav><!-- #image-navigation -->
                    </header><!-- .entry-header -->

                    <div class="entry-content">

                        <div class="entry-attachment">
                            <div class="attachment">
<?php
    /**
     * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
     * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
     */
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
    foreach ( $attachments as $k => $attachment ) {
        if ( $attachment->ID == $post->ID )
            break;
    }
    $k++;
    // If there is more than 1 attachment in a gallery
    if ( count( $attachments ) > 1 ) {
        if ( isset( $attachments[ $k ] ) )
            // get the URL of the next image attachment
            $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
        else
            // or get the URL of the first image attachment
            $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
    } else {
        // or, if there's only 1 image, get the URL of the image
        $next_attachment_url = wp_get_attachment_url();
    }
?>
                                <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                                $attachment_size = apply_filters( 'theme_attachment_size',  800 );
                                echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
                                ?></a>
                            </div><!-- .attachment -->

                            <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                            <div class="entry-caption">
                                <?php the_excerpt(); ?>
                            </div>
                            <?php endif; ?>
                        </div><!-- .entry-attachment -->

                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>

                    </div><!-- .entry-content -->

                    <div class="entry-utility">
                        <?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
                            <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'themename' ), get_trackback_url() ); ?>
                        <?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
                            <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'themename' ), get_trackback_url() ); ?>
                        <?php elseif ( comments_open() && ! pings_open() ) : // Only comments open ?>
                            <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'themename' ); ?>
                        <?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed ?>
                            <?php _e( 'Both comments and trackbacks are currently closed.', 'themename' ); ?>
                        <?php endif; ?>
                        <?php edit_post_link( __( 'Edit', 'themename' ), ' <span class="edit-link">', '</span>' ); ?>
                    </div><!-- .entry-utility -->
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php comments_template(); ?>

        </section><!-- #primary -->

<?php get_footer(); ?>
