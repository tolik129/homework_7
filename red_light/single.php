<?php get_header(); ?>
<div id="content">
	<div class="spacer"></div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка на <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<div class="post_author"><?php the_author_posts_link('nickname'); ?> <?php edit_post_link(' Редактировать ',' &raquo;','&laquo;'); ?></div>
				</div>
				<div class="post_date">
					<div class="post_date_d"><?php the_time('d');?></div>
					<div class="post_date_m"><?php the_time('M Y');?></div>
				</div>
				<div class="entry clear">
					<?php the_content('далее...'); ?><div class="clear"></div>
					<?php wp_link_pages(array('before' => '<div><strong><center>Страницы: ', 'after' => '</center></strong></div>', 'next_or_number' => 'number')); ?>
				</div>



				<div class="info">
					<span class="category">Категория: <?php the_category(', ') ?></span>
					<?php the_tags('&nbsp;<span class="tags">Метки: ', ', ', '</span>'); ?>
				</div>
			</div>
			
			<div id="postmetadata">
			Вы можете следить за комментариями с помощью <?php comments_rss_link('RSS 2.0-ленты'); ?>. 
			<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) { // Both Comments and Pings are open ?>
						Вы можете <a href="#respond">оставить комментарий</a> или <a href="<?php trackback_url(); ?>" rel="trackback">трекбэк</a> с вашего сайта.
			<?php }elseif(!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {	// Only Pings are Open ?>
						Комментарии закрыты, но вы можете оставить <a href="<?php trackback_url(); ?> " rel="trackback">трекбэк</a> с вашего сайта.
			<?php }elseif(('open' == $post-> comment_status) && !('open' == $post->ping_status)){	// Comments are open, Pings are not ?>
						Вы можете оставить комментарий ниже.
			<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {	// Neither Comments, nor Pings are open ?>
						Комментарии и пинги к записи запрещены.
			<?php } 
					edit_post_link('Редактировать','(',')'); 
			?>
			</div>			
		<?php 
			comments_template();
		?>
<?php 
		endwhile; 
?>
		<div class="navigation">
				<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
<?php 
	else : ?>
		<h3 class="archivetitle">Не найдено</h3>
		<p class="sorry">"Извините, ничего не нашлось. Воспользуйтесь навигацией или поиском, чтобы найти необходимую вам информацию. Try something else.</p>
<?php
	endif;
?>	
	
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>