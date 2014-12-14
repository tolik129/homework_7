<?php get_header(); ?>
<?php $tmp_PagesComment=0; //set to 1 to show comment on pages ?>
<div id="content">
	<div class="spacer"></div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка на <?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
				<div class="entry clear">
					<?php the_content('далее...'); ?><div class="clear"></div>
					<?php wp_link_pages(array('before' => '<div><strong><center>Страницы: ', 'after' => '</center></strong></div>', 'next_or_number' => 'number')); ?>
					<?php edit_post_link('Редактировать.', '<p>', '</p>'); ?>
				</div>

			</div>



<?php	if($tmp_PagesComment==1):?>
			<div id="postmetadata">
			Вы можете следить за комментариями с помощью <?php comments_rss_link('RSS 2.0-ленты'); ?>. 
			<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) { // Both Comments and Pings are open ?>
						Вы можете <a href="#respond">оставить комментарий</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">трекбэк</a> с вашего сайта.
			<?php }elseif(!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {	// Only Pings are Open ?>
						Комментарии закрыты, но вы можете оставить <a href="<?php trackback_url(); ?> " rel="trackback">трекбэк</a> с вашего сайта.
			<?php }elseif(('open' == $post-> comment_status) && !('open' == $post->ping_status)){	// Comments are open, Pings are not ?>
						Вы можете оставить комментарий ниже.
			<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {	// Neither Comments, nor Pings are open ?>
						Комментарии и пинги к записи запрещены.
			<?php } 
					edit_post_link('Edit this entry.','',''); 
			?>
			</div>			
		<?php comments_template();?>
<?php endif;?>






<?php 
		endwhile; 
	endif;
?>	
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>