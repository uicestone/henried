<?php
add_filter('wpjam_pre_post_thumbnail_uri','wpjam_tag_pre_post_thumbnail_uri',10,2);
function wpjam_tag_pre_post_thumbnail_uri($post_thumbnail_uri,$post){
    $post_taxonomies = get_post_taxonomies($post);

    if($post_taxonomies){

        foreach($post_taxonomies as $taxonomy){
            if($taxonomy == 'category'){
                continue;
            }
            $terms = get_the_terms($post,$taxonomy);
            if($terms){
                foreach ($terms as $term) {
                    if($term_thumbnail = get_term_meta($term->term_id,'thumbnail',true)){
                        return $term_thumbnail;
                    }
                }
            }
        }       
        
    }
}

add_filter('wpjam_post_thumbnail_uri','wpjam_category_post_thumbnail_uri',10,2);
function wpjam_category_post_thumbnail_uri($post_thumbnail_uri,$post){
    $post_taxonomies = get_post_taxonomies($post);

    if($post_taxonomies){
        if(in_array('category',$post_taxonomies)){
            $categories = get_the_category($post);
            if($categories){
                foreach ($categories as $category) {
                    if($term_thumbnail = get_term_meta($category->term_id,'thumbnail',true)){
                        return $term_thumbnail;
                    }
                }       
            }
        }
    }
}

function wpjam_get_custom_taxonomies(){
    $args = array(
        'public'   => true,
        '_builtin' => false
    );

    return get_taxonomies($args); 
}

function wpjam_has_term_thumbnail(){
    if(wpjam_get_term_thumbnail_uri()){
        return true;
    }else{
        return false;
    }
}

function wpjam_has_category_thumbnail(){
    return wpjam_has_term_thumbnail();
}

function wpjam_has_tag_thumbnail(){
    return wpjam_has_term_thumbnail();
}

function wpjam_get_term_thumbnail_uri($term=null){
    if(!$term){
        $term = get_queried_object();
    }

    if ( !$term ){
        return false;
    }

    if(is_object($term)){
        $term_id = $term->term_id;
    }else{
        $term_id = $term;
    }
    if($term_thumbnail = get_term_meta($term_id,'thumbnail', true)){
        return $term_thumbnail;
    }

}

function wpjam_get_term_thumbnail_src($term=null, $size='thumbnail', $crop=1){

    $term_thumbnail_uri = wpjam_get_term_thumbnail_uri($term);

    if($term_thumbnail_uri){
        extract(wpjam_get_dimensions($size));

        return apply_filters('wpjam_thumbnail', $term_thumbnail_uri, $width, $height, $crop);
    }else{
        return false;
    }

}

function wpjam_get_term_thumbnail($term=null, $size='thumbnail', $crop=1, $class="wp-term-image"){

    $term_thumbnail_src = wpjam_get_term_thumbnail_src($term, $size, $crop);

    if($term_thumbnail_src){
        extract(wpjam_get_dimensions($size));

        $width_attr = $width?' width="'.$width.'"':'';
        $height_attr = $height?' height="'.$height.'"':'';

        if(!$term){
            $term = get_queried_object();
        }

        return  '<img src="'.$term_thumbnail_src.'" class="'.$class.'"'.$width_attr.$height_attr.' />';
    }else{
        return false;
    }

}

function wpjam_term_thumbnail($size='thumbnail', $crop=1, $class="wp-term-image"){
    if($term_thumbnail =  wpjam_get_term_thumbnail(null, $size, $crop, $class)){
        echo $term_thumbnail;
    }
}

function wpjam_category_thumbnail($size='thumbnail', $crop=1, $class="wp-category-image"){
    wpjam_term_thumbnail($size,$crop,$class);
}

function wpjam_tag_thumbnail($size='thumbnail', $crop=1, $class="wp-tag-image"){
    wpjam_term_thumbnail($size,$crop,$class);
}
