<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php if ( function_exists('yoast_breadcrumb') ) {
	yoast_breadcrumb('<h1 class="page-title">','</h1>');
} ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php if ( has_post_thumbnail() ) { // the current post has a thumbnail
					the_post_thumbnail();
					} else {
						// the current post lacks a thumbnail
					}
				?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<div class="moreposts">
							<?php $original_post = $post;
							$tags = wp_get_post_tags($post->ID);
							if ($tags) {
								$first_tag = $tags[0]->term_id;
								$args=array(
									'tag__in' => array($first_tag),
									'post__not_in' => array($post->ID),
									'showposts'=>5,
									'caller_get_posts'=>1
								);
								$my_query = new WP_Query($args);
								if( $my_query->have_posts() ) {
									echo '<h4>Some other posts here at <em>'.get_bloginfo('name').'</em> that you may also enjoy:</h4>';
									echo "<ul>";
									while ($my_query->have_posts()) : $my_query->the_post(); ?>
										<li><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID, "post-img", true); ?>&h=40&w=40&zc=1" align="left" alt="" /><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile;
									echo "</ul>";
								}
							}
							$post = $original_post;
							wp_reset_query(); ?>
						</div>
					</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 100 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s &rarr;', 'twentyten' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- .entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-(id) -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
