<?php
/*
Template name: Front Page
*/
global $wp_query;

$query_options = array(
	'post_type'      => 'work',
	'posts_per_page' => 12,
	'orderby'        => 'post_date',
	'order'          => 'DESC'
);
$wp_query = new WP_Query($query_options);
?>

<?php get_header() ?>
<!-- Feeds all the posts for the blog page -->
<div id="main">
		<div class="wrapper cf">
			<!-- posts list -->
			<div id="posts-list" class="cf">

<?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				<!-- Standard -->
				<article class="post-24 post type-post status-publish format-standard hentry category-uncategorized">
					<div class="feature-image">
						<?php echo get_template_part('includes/post-thumbnail')?>
					</div>
					<div class="box cf">
						<?php echo get_template_part('includes/post-date')?>
						<div class="excerpt">
									<a href="<?php the_permalink(); ?>" class="post-heading" ><?php the_title() ?></a>
									<?php the_excerpt() ?>

									<p><a href="<?php the_permalink(); ?>" class="learnmore"><?php _e('Learn More','ansimuz'); ?></a></p>
								</div>
						<?php echo get_template_part('includes/post-meta')?>
					</div>
				</article>
				<!-- ENDS  Standard -->
<?php endwhile;
else: ?>
	<?php get_template_part('includes/woops') ?>
<?php endif; ?>
			</div>
			<!-- ENDS posts list -->
			<aside id="sidebar">
				<h5>РУБРИКИ</h5>
				<ul>
			<?php
			    $cat_args = array (
			      'taxonomy' => 'work_category',
			    );
			    $categories = get_categories ( $cat_args );
			    foreach ( $categories as $category ) {
			      $cat_query = null;
			      $args = array (
			        'post_type' => 'work',
			        'taxonomy-name' => $category->slug
			      );
			      $cat_query = new WP_Query( $args );

			      if ( $cat_query->have_posts() ) {
			      echo "<li><a href='".site_url().'/work_category/'.$category->slug."'>". $category->name ."</a></li>";
			      }
			      wp_reset_postdata();
			    }
			?>
					</ul>
			</aside>

		</div>
		<!-- ENDS WRAPPER -->
	</div>


<?php get_footer() ?>
