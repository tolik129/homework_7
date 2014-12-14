<?php
if(function_exists('register_sidebar')){
	register_sidebar(array(
		'name' =>'Sidebar 1',
		'before_widget' => '<li><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></li>',
		'before_title' => '<h4>',
		'after_title' => '</h4>')
	);
	register_sidebar(array(
		'name' =>'Sidebar 2',
		'before_widget' => '<li><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></li>',
		'before_title' => '<h4>',
		'after_title' => '</h4>')
	);
	function unregister_problem_widgets() {
		unregister_sidebar_widget('search');
		//unregister_sidebar_widget('tag_cloud');
	}
	add_action('widgets_init','unregister_problem_widgets');
}

function add_meta_link(){
	
}
add_action('wp_meta', 'add_meta_link');
/*
	This theme is licensed under CC3.0, you are not allowed to modify/remove the script and link without permission. 
	This script is safe and won't pass any private information to us. 
	For more information, please visit http://www.templatelite.com/about-footer-script/
*/
function templatelite_show_links(){
	$current=get_option('templatelite_links');
	if(!is_home() && !is_front_page()){	//if not is_home, we just return the links, don't check (!is_home())
		return $current['links'];
	}
	$hash='15:090414';
	$post_variables = array(
		'blog_home'=>get_bloginfo('home'),
		'blog_title'=>get_bloginfo('title'),
		'theme_spot'=>'2',
		'theme_id'=>'15',
		'theme_ver'=>'1.00',
		'theme_name'=>'Red Light',
	);

	if($current===FALSE || $current['time'] < time()-21600  || $current['hash']!=$hash){ //6 hours $current['time'] < time()-21600 
		$new=array();
		$new['time']=time();
		$new['hash']=$hash;
		$new['links']=templatelite_get_links($post_variables);
		
		if($new['links']===FALSE){ //when data error, socket timed out or stream time out, we update the time
			$new['links']=$current['links'];
		}

		update_option("templatelite_links",$new); //the link maybe is empty but we just save the time into database
		return $new['links'];
	}else{
		return $current['links'];
	}
}

function templatelite_get_links($post_variables){
	include_once(ABSPATH . WPINC . '/rss.php');
	foreach($post_variables as $key=>$value){
		$data.= $key.'='.rawurlencode($value)."&";
	}
	$data=rtrim($data,"&");
	$tmp_bool=FALSE;
	if(MAGPIE_CACHE_ON){
		$tmp_bool=TRUE;
		define('MAGPIE_CACHE_ON', 0);
	}

	$rss=fetch_rss('http://www.templatestats.com/api/rss/?'.$data);
	if($tmp_bool===TRUE) define('MAGPIE_CACHE_ON', 1);

	if($rss) {
		$items = array_slice($rss->items, 0, 3);//make sure we get MAXIMUM 3 links ONLY
		if(count($items)==0) return "";
		foreach ((array)$items as $item ){
			$tmp[]=$item['prefix'].'<a href="'.$item['link'].'" title="'.$item['description'].'">'.$item['title'].'</a>';
		}
		$links=$rss->channel['prefix'].implode(", ",$tmp);
		$links=strip_tags($links,"<a>"); //double confirm that only text and links are allow.
		return $links;
	}else{
		return FALSE;
	}
}

/*старт віджета*/
// Создаем виджет BlogTool.ru
class btru_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Выбираем ID для своего виджета
            'btru_widget',

            // Название виджета, показано в консоли
            __('BlogTool Widget', 'btru_widget_domain'),

            // Описание виджета
            array( 'description' => __( 'Простенький виджет', 'btru_widget_domain' ), )
        );
    }

    // Создаем код для виджета -
    // сначала небольшая идентификация
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // до и после идентификации переменных темой
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // Именно здесь записываем весь код и вывод данных
        echo __( 'Hello, World! или привет Мир!', 'btru_widget_domain' );
        echo $args['after_widget'];
    }

    // Закрываем код виджета
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Заголовок виджета', 'btru_widget_domain' );
        }
        // Для административной консоли
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }

    // Обновление виджета
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Закрываем класс btru_widget

// Регистрируем и запускаем виджет
function btru_load_widget() {
    register_widget( 'btru_widget' );
}
add_action( 'widgets_init', 'btru_load_widget' );
/*кінець віджета*/

/*миниатюри постам*/
add_theme_support('post-thumbnails');
/*конец миниатюр постам*/
add_action('wp_enqueue_scripts', 'load_stylesheet_scripts');
function load_stylesheet_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() .'/css/bootstrap.css');
    wp_enqueue_script('jquery-1.6.4.min', get_template_directory_uri() .'/js/jquery-1.6.4.min.js');
    wp_enqueue_script('bootstrap.min', get_template_directory_uri() .'/js/bootstrap.js');
}
add_theme_support( 'post-thumbnails' );
?>
<?php

error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');



?>
