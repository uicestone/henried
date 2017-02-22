<?php

add_action("wp_head","wpjam_seo_head");
function wpjam_seo_head(){
	global $paged;

	if(is_search()){
		//do nothing
	}elseif(is_singular()){
		global $post;
		$meta_description = addslashes_gpc(get_the_excerpt());

		if(wpjam_basic_get_setting('seo_use_keywords') && $tags = get_the_tags($post->ID)){
			$meta_keywords = array();
			foreach ($tags as $tag ) {
	        	$meta_keywords[] = $tag->name;
	    	}
	    	if($meta_keywords){
	    		$meta_keywords = implode(',', $meta_keywords);
	    	}
		}
		//$meta_author = get_the_author_meta( 'display_name', $post->post_author );
		//$meta_revised = get_the_modified_time('l, F jS, Y, g:i a');
	}elseif($paged<2){
		if((is_home())) {
			$meta_description = wpjam_basic_get_setting('seo_home_description');
			$meta_keywords = wpjam_basic_get_setting('seo_home_keywords');
			
			$canonical_link = home_url();
		}elseif(is_tag()){
			$meta_description = get_plain_text(tag_description());
		}elseif(is_category()){
			$meta_description = get_plain_text(category_description());
		}elseif(is_post_type_archive()){
			$post_type = get_queried_object();
			//var_dump($post_type);
			//$post_type = get_post_type_object( get_query_var( 'post_type' ) );
			if($post_type){
				$meta_description = $post_type->description;
			}
	    }
	}

	if(is_singular() || is_home() || is_tag() || is_category() || is_post_type_archive()){
		$meta_robots = "index,follow";
	}elseif(is_404() || is_search()){
		$meta_robots = "noindex,noarchive";
	}elseif(is_archive()){
		$meta_robots = "noarchive";
	}

	if ( !empty( $meta_description )){
		echo "<meta name='description' content='{$meta_description }' />\n";
	}
	if ( !empty( $meta_keywords )){
		echo "<meta name='keywords' content='{$meta_keywords }' />\n";
	}
	if ( !empty( $meta_robots ) ){
		echo "<meta name='robots' content='{$meta_robots}' />\n";
	}
	if ( !empty( $canonical_link ) ){
		echo "<link rel='canonical' href='{$canonical_link}' />\n";
	}
	//if ( !empty( $meta_author ) ){
	//	echo "<meta name='author' content='" . esc_attr( $meta_author ) . "' />\n";	
	//}
	//if ( !empty( $meta_revised ) ){
	//	echo "<meta name='revised' content='{$meta_revised}' />\n";
	//}
}

add_filter('robots_txt', 'wpjam_robots_txt',10,2);
function wpjam_robots_txt($output, $public){
	if ( '0' == $public ) {
		return "Disallow: /\n";
	} else {
		return wpjam_basic_get_setting('seo_robots');
	}
}

register_activation_hook( WPJAM_BASIC_PLUGIN_FILE, 'flush_rewrite_rules' );
register_deactivation_hook( WPJAM_BASIC_PLUGIN_FILE, 'flush_rewrite_rules' );

add_action('generate_rewrite_rules', 'wpjam_seo_generate_rewrite_rules');
function wpjam_seo_generate_rewrite_rules($wp_rewrite){

    $new_rules = array();

    $new_rules['sitemap\.xml$'] = 'index.php?sitemap=1'; 

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

add_filter('query_vars', 'wpjam_seo_sitemap_query_vars');
function wpjam_seo_sitemap_query_vars($public_query_vars) {
    $public_query_vars[] = "sitemap";
    return $public_query_vars;
}

add_filter('pre_get_posts','wpjam_seo_sitemap_pre_get_posts');
function wpjam_seo_sitemap_pre_get_posts(&$query){
	if(get_query_var('sitemap')){
		wpjam_xml_sitemap();
		exit;
	}
}

function wpjam_xml_sitemap(){
	global $wpdb;

	$wpjam_sitemap = get_transient('wpjam_sitemap');

	if($wpjam_sitemap === false){
		
		$post_types = array();

		foreach (get_post_types( array('public' => true)) as $post_type => $value) {
			if($post_type != 'page' && $post_type != 'attachment'){
				$post_types[] = $post_type;
			}
		}

		$post_types = '"'.implode('","', $post_types).'"';

		$post_ids = $wpdb->get_col('SELECT ID FROM '.$wpdb->posts.' WHERE post_password="" AND post_status="publish" AND post_type in('.$post_types.') ORDER BY post_modified_gmt DESC');
		if ($post_ids) {
			/* homepage in google sitemap */
			$home_last_mod = str_replace(' ', 'T', get_lastpostmodified('GMT')).'+00:00';
			$wpjam_sitemap .= "\t<url>\n";
			$wpjam_sitemap .= "\t\t<loc>".home_url()."</loc>\n";
			$wpjam_sitemap .= "\t\t<lastmod>".$home_last_mod."</lastmod>\n";
			$wpjam_sitemap .= "\t\t<changefreq>daily</changefreq>\n";
			$wpjam_sitemap .= "\t\t<priority>1.0</priority>\n";
			$wpjam_sitemap .= "\t</url>\n";
			/*end of homepage in google sitemap*/
			
			// fetch 100 posts at a time rather than loading the entire table into memory
			while ( $next_posts = array_splice($post_ids, 0, 100) ) {
				$where = "WHERE ID IN (".join(',', $next_posts).")";
				$sitemap_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts $where ORDER BY post_modified_gmt DESC");
				update_post_cache($sitemap_posts,'', false, false);
				foreach ($sitemap_posts as $sitemap_post) {
					$permalink = get_permalink($sitemap_post->ID); //$siteurl.$sitemap_post->post_name.'/';
					$last_mod = str_replace(' ', 'T', $sitemap_post->post_modified_gmt).'+00:00';
					/*google sitemap*/
					$wpjam_sitemap .= "\t<url>\n";
					$wpjam_sitemap .= "\t\t<loc>".$permalink."</loc>\n";
					$wpjam_sitemap .= "\t\t<lastmod>".$last_mod."</lastmod>\n";
					$wpjam_sitemap .= "\t\t<changefreq>weekly</changefreq>\n";
					$wpjam_sitemap .= "\t\t<priority>0.8</priority>\n";
					$wpjam_sitemap .= "\t</url>\n";
					/*end of google sitemap*/				
				}
			}
		}

		$wpjam_sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="'.WPJAM_BASIC_PLUGIN_URL.'/include/sitemap.xsl'.'"?>
<!-- generated-on="'.date('d. F Y').'" -->
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n".$wpjam_sitemap."\n".'</urlset>'."\n";
		set_transient('wpjam_sitemap',$wpjam_sitemap,60*60*3);
	}
	
	
	if(!isset($_GET['debug'])){
		header ("Content-Type:text/xml"); 
		echo $wpjam_sitemap;
	}else{

		$wpjam_sitemap_url = home_url('/sitemap.xml');
		
		$pingurls = array();
		$pingurls[] = array(
			'service' => 'GOOGLE',
			'url' => 'http://www.google.com/webmasters/sitemaps/ping?sitemap='.$wpjam_sitemap_url,
			'snippet' => 'Your Sitemap has been successfully added to our list of Sitemaps to crawl.'
		);
		$pingurls[] = array(
			'service' => 'ASK.COM',
			'url' => 'http://submissions.ask.com/ping?sitemap='.$wpjam_sitemap_url,
			'snippet' => 'Your Sitemap has been successfully received and added to our Sitemap queue.'
		);
		$pingurls[] = array(
			'service' => 'Bing',
			'url' => 'http://www.bing.com/webmaster/ping.aspx?siteMap='.$wpjam_sitemap_url,
			'snippet' => 'Thanks for submitting your sitemap.'
		);
		$pingurls[] = array(
			'service' => 'YAHOO',
			'url' => 'http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap='.$wpjam_sitemap_url,
			'snippet' => 'Update notification has successfully submitted.'
		);
	
		echo '<ul>';
		foreach($pingurls as $engine){
			$httpresult = (array)wp_remote_get($engine['url']);
			if(strpos($httpresult['body'], $engine['snippet']) !== false){
				echo '<li>'.sprintf(__('%s was pinged at: ', 'simplesitemap'), $engine['service']).'<a href="'.$engine['url'].'">'.$engine['url'].'</a></li>';
			}else{
				echo  '<li>'.'<span style="color:#cc0000">'.sprintf(__('Oops .. %s ping failed at: ', 'simplesitemap').'</span>', $engine['service']).'<a href="'.$engine['url'].'">'.$engine['url'].'</a></li>';			
			}
		}
		echo '</ul>';

	    global $wpdb;
	    
	    echo get_num_queries();echo ' queries in ';timer_stop(1);echo ' seconds.<br>';
	    
	    echo '按执行顺序：<br>';
	    echo '<pre>';
	    var_dump($wpdb->queries);
	    echo '</pre>';
	    
	    echo '按耗时：<br>';
	    echo '<pre>';
	    $qs = array();
	    foreach($wpdb->queries as $q){
	    $qs[''.$q[1].''] = $q;
	    }
	    krsort($qs);
	    print_r($qs);
	    echo '</pre>';
	}
		
}