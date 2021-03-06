<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage FSV002WP BASIC
 * @since FSV002WP BASIC 1.0
 */
?>

<?php get_header(); ?>

	<div id="main" class="main-content-area">

		<div class="component-inner">

			<div id="wrapbox" class="main-content-wrap">

				<div id="primary" class="main-content-site" role="main">

					<?php if ( !( is_home() || is_front_page() ) ) { fsv002wpbasic_breadcrumb(); } else { ?><div id="breadcrumb">&nbsp;</div><?php } ?>

					<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="main-content-header">

							<h2 class="main-content-title"><?php the_title(); ?></h2>

							<?php if ( is_user_logged_in() ) : ?>
							<div class="entry-meta">
								<?php edit_post_link( __( 'Edit', 'fsv002wpbasic') , '<p>', '</p>' ); ?>
							</div><!-- .entry-meta -->
							<?php endif; ?>

						</header><!-- .main-content-header -->

						<div class="entry-content">

						<?php if ( has_post_thumbnail() ) : ?>

							<div class="attachment">

								<?php

								$thumbnail_id = get_post_thumbnail_id($post->ID);
								$image_ary = wp_get_attachment_image_src( $thumbnail_id, 'full' );

								$img_src = $image_ary[0]; 
								$img_width = $image_ary[1]; 
								$img_height = $image_ary[2]; 

								if ( ( $img_width < intval( fsv002wpbasic_img_resize('img_post_width') ) ) || ( $img_height < intval( fsv002wpbasic_img_resize('img_post_height') ) ) ) :

									the_post_thumbnail();

								else : ?>

								<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), fsv002wpbasic_img_resize('img_post_width'),  fsv002wpbasic_img_resize('img_post_height'),  fsv002wpbasic_img_resize('img_post_crop') ); ?>" alt="<?php echo the_title(); ?>" />

								<?php endif; ?>

							</div><!-- .attachment -->

							<?php endif; ?>

							<?php the_content(); ?>

							<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

						</div><!-- .entry-content -->

						<div class="clear"></div>

					</article><!-- #post -->

					<?php endwhile; // end of the loop. ?>

					<?php comments_template( '', true ); ?>

				</div><!-- #primary -->

				<?php get_sidebar( 'left' ); ?>

			</div>

			<?php get_sidebar( 'right' ); ?>

		</div>

	</div><!-- #main -->

<?php get_sidebar( 'footer' ); ?>

<?php get_footer(); ?>
