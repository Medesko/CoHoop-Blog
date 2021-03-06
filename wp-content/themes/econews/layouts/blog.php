<?php if (have_posts()) { ?>

	<?php while (have_posts()) : the_post();
	
		// post image
		$imgurl = get_post_custom_values('ide_post_image', $post->ID);
	?>

		<div class="post">
			<?php if(ide_option('post_strip')) ide_post_strip(); ?>
			
			<?php if($imgurl = @array_pop($imgurl)): ?>
				<div class="post_image"><a href="<?php the_permalink(); ?>"><img src="<?php echo $imgurl; ?>" alt="<?php the_title(); ?>" /></a></div>
			<?php else: ?>
				<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php endif; ?>

            <div class="post-author">
                <?php echo get_avatar( get_the_author_meta('ID'), '48' ); ?>
                <div class="post-meta">Written by <span><?php the_author(); ?></span></div>
                <div class="post-meta">On <?php the_time(get_option('date_format')); ?> 
                    <?php $cat = get_the_category();
                    
                    if ($cat[0]->term_id != '1'): ?> 
                        in <?php the_category(', '); ?>
                    <?php endif; ?>
                </div>
                <?php if ( comments_open() ) { ?>
                <div class="comments-bubble"><?php comments_popup_link('0', '1', '%', '', ''); ?></div>
                <?php } ?>
                <div class="clear"> </div>
            </div>

			<!--<div class="meta">
				<p class="author"><?php //ide_option('post_author') ? _e('by ').the_author_posts_link() : null; ?></p>
				<?php //if(has_tag()) { ?><p class="tags"><?php //the_tags(); ?></p><?php //}; ?>
				<div class="clear"> </div>
			</div>--><!-- .meta //-->

			<?php if(!empty($imgurl)): ?>
				<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<?php endif; ?>
			
			<div class="text">
				<?php
					if(!ide_option('post_content'))
						the_content(_('continue reading..'));	// show full post
					else
						the_excerpt(_('continue reading..'));	// excerpt
				?>
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="btn btn-cohoop read-more pull-right">Continue reading&#133;</a>
				<div class="clear"> </div>
			</div><!-- .text //-->
			
			<div class="clear"> </div>
		</div><!-- .post //-->

	<?php endwhile; ?>
	
	<div class="pagination">
		<div class="alignleft"><?php next_posts_link('&laquo; '._('Older Entries')); ?></div>
		<div class="alignright"><?php previous_posts_link(_('Newer Entries').' &raquo;'); ?></div>
		<div class="clear"> </div>
	</div>

<?php } else {
		_e( !empty($empty_message) ? $empty_message : '<h1>Sorry!</h1>Sorry, the requested content was not found.');
	}
?>