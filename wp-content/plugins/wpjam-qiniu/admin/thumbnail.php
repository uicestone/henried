<?php

add_filter('manage_posts_columns', 'wpjam_manage_posts_columns_add_thumbnail');
//add_filter('manage_pages_columns', 'wpjam_manage_posts_columns_add_thumbnail');
function wpjam_manage_posts_columns_add_thumbnail($columns){
    $columns['thumbnail'] = '缩略图';
    return $columns;
}

add_action('manage_posts_custom_column','wpjam_manage_posts_custom_column_show_thumbnail',10,2);
//add_action('manage_pages_custom_column','wpjam_manage_posts_custom_column_show_thumbnail',10,2);
function wpjam_manage_posts_custom_column_show_thumbnail($column_name,$id){
    if ($column_name == 'thumbnail') {
        wpjam_post_thumbnail(array(60,60));
    }
}

if(wpjam_qiniutek_get_setting('advanced')){

	add_action('admin_init', 'wpjam_thumbnail_admin_init',99);
	function wpjam_thumbnail_admin_init(){

	    //自定义分类
	    $custom_taxonomies = get_taxonomies(array( 'public' => true)); 
	    if($custom_taxonomies){
	        foreach ($custom_taxonomies as $taxonomy) {
	            add_action($taxonomy.'_add_form_fields','wpjam_term_add_thumbnail_field');
	            add_action($taxonomy.'_edit_form_fields','wpjam_term_edit_thumbnai_field'); 
	        }
	    }

	    //分类
	    //add_action('category_add_form_fields','wpjam_term_add_thumbnail_field');
	    //add_action('edit_category_form_fields','wpjam_term_edit_thumbnai_field',10,2);

	    //标签
	    //add_action('post_tag_add_form_fields','wpjam_term_add_thumbnail_field');
	    //add_action('post_tag_edit_form_fields','wpjam_term_edit_thumbnai_field',10,2);
	        
	    // 保存
	    add_action('edited_term', 'wpjam_save_term_thumbnail',10, 3);  
	    add_action('created_term', 'wpjam_save_term_thumbnail',10, 3);

	    foreach ( get_taxonomies() as $taxonomy ) {
	        add_action('manage_edit-'.$taxonomy.'_columns', 'wpjam_manage_edit_taxonomy_column_show_thumbnail');            
	        add_filter('manage_'.$taxonomy.'_custom_column', 'wpjam_manage_taxonomy_custom_column_show_thumbnail', 10, 3);
	    }

	    function wpjam_manage_edit_taxonomy_column_show_thumbnail($columns){
	        $columns['term_thumbnail'] = '缩略图';
	        return $columns;
	    }

	    function wpjam_manage_taxonomy_custom_column_show_thumbnail($sss, $column_name,$id){
	        if ($column_name == 'term_thumbnail') {
	            echo wpjam_get_term_thumbnail($id,array(60,60));
	        }
	    }
	    
	}


	function wpjam_term_add_thumbnail_field($taxonomy){
	    ?>
	    <div class="form-field">
	        <label for="thumbnail">缩略图</label>
	        <input name="thumbnail" id="thumbnail" type="url" value="" style="width:80%;"/>
	        <input type="button" class="wpjam_upload button" style="width:80px;" value="选择图片">
	    </div>
	    <?php
	}

	function wpjam_term_edit_thumbnai_field($term, $taxonomy=''){
	    $thumbnail = get_term_meta($term->term_id,'thumbnail', true);
	    ?>
	    <tr class="form-field">
	        <th scope="row" valign="top">
	            <label for="thumbnail">缩略图</label>
	        </th>
	        <td>
	            <input name="thumbnail" id="thumbnail" type="url" value="<?php echo $thumbnail; ?>" />
	            <input type="button" class="wpjam_upload button" style="width:80px;" value="选择图片">
	        </td>
	    </tr>
	    
	    <?php
	}

	function wpjam_save_term_thumbnail($term_id, $tt_id, $taxonomy) {
	    if ( isset( $_POST['thumbnail'] ) ) {
	        update_term_meta($term_id,'thumbnail',$_POST['thumbnail']);
	    }
	}
}