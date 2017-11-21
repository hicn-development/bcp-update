<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BCP_BLOG
 */
global $index;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group grid-item'); ?>>
	<div class="post-inner post-hover" data-collection-index="<?php echo $index; ?>">
		<div class="post-thumbnail">
			<a href="<?php echo esc_url(get_permalink());?>" title="<?php echo get_the_title(); ?>" rel="bookmark" >
				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('medium');
					} else {
						echo '<img src="'.bcp_get_thumbnail_default().'" class="thumbnail_default img-responsive" />';
					}
				?>
			</a>
			<a href="<?php comments_link(); ?>" class="post-comments">
				<span>
					<i class="fa fa-comments-o"></i>
					<?php comments_number( '0', '1', '%' ); ?>
				</span>
			</a>
		</div>
		<div class="post-content">
			<div class="post-meta group">
				<p class="post-category">
					<?php 
					$categories = get_the_category();
					foreach($categories as $category){
					   $cat_link = get_category_link($category->cat_ID);
					   echo '<a href="'.$cat_link.'">'.$category->name.'</a>'.',&nbsp;';
					}
					?>
				</p>
				<p class="post-date">
					<?php bcp_custom_posted_on(); ?>
				</p>
				<p class="post-byline">
					<?php bcp_posted_on(); ?>
				</p>
			
			</div>
			<?php 
				the_title( '<h2 class="entry-title post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
			<div class="entry-excerpt entry-summary">
			<?php
				the_excerpt(); 
			?>
			</div>
		</div>
	</div><!-- .post-inner.post-hover -->

	<!-- <footer class="entry-footer"> -->
		<?php //bcp_entry_footer(); ?>
	<!--</footer> --><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
