<?php get_header(); ?>
<div id="content">


    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<?php 
	if(is_home()) echo '<div class="spacer">&nbsp;</div>';
		if (have_posts()) :
		$post = $posts[0]; // Hack. Set $post so that the_date() works.
		if(is_category()){
			echo '<h3 class="archivetitle">Архив категории &raquo;'.single_cat_title('',FALSE).' &laquo;</h3>';
		}elseif(is_day()){
			echo '<h3 class="archivetitle">Архив за &raquo; '.get_the_time('j F Y').'&laquo;</h3>';
		}elseif(is_month()){
			echo '<h3 class="archivetitle">Архив за &raquo; '.get_the_time('F, Y').' &laquo;</h3>';
		}elseif(is_year()){
			echo '<h3 class="archivetitle">Архив за &raquo; '.get_the_time('Y').' &laquo;</h3>';
		} elseif(is_search()){
			echo '<h3 class="archivetitle">Результаты поиска</h3>';
		}elseif(is_author()){
			echo '<h3 class="archivetitle">Архив автора</h3>';
		}elseif(isset($_GET['paged']) && !empty($_GET['paged'])){ // If this is a paged archive
			echo '<h3 class="archivetitle">Архив блога</h3>';
		}elseif(is_tag()){
			echo '<h3 class="archivetitle">Архив меток &raquo; '.single_tag_title('',FALSE).' &laquo; </h3>';
		}

		while (have_posts()) : the_post(); ?>
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
					<?php if (is_search()){
							the_excerpt();
						}else{
							the_content('далее...'); 
						}
					?>
				</div>
				<div class="clear"></div>
				<div class="info">
					<span class="category">Категория: <?php the_category(', ') ?></span>
					<?php the_tags('&nbsp;<span class="tags">Метки: ', ', ', '</span>'); ?>
					&nbsp;<span class="bubble"><?php comments_popup_link('Нет комментариев', 'Комментарии (1)', 'Комментарии (%)'); ?></span>
				</div>
			</div>
<?php 
		endwhile; 
?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Предыдущие записи') ?></div>
			<div class="alignright"><?php previous_posts_link('Следующие записи &raquo;') ?></div>
		</div>
<?php else : ?>
		<h3 class="archivetitle">Не найдено</h3>
		<p class="sorry">"Извините, ничего не нашлось. Воспользуйтесь навигацией или поиском, чтобы найти необходимую вам информацию. Try something else.</p>
<?php
	endif;
?>

</div>


<?php get_sidebar(); ?>
<?php get_footer();?>