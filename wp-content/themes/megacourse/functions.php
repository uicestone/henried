<?php

add_action('init', function(){
	wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/css/library/bootstrap.min.css', array(), '3.2.0');
	wp_register_style('font-awesome', get_stylesheet_directory_uri() . '/css/library/font-awesome.min.css', array(), '4.2.0');
	wp_register_style('owl.carousel', get_stylesheet_directory_uri() . '/css/library/owl.carousel.css', array(), '1.18');
	wp_register_style('md-font', get_stylesheet_directory_uri() . '/css/md-font.css', array());
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array());
	
	wp_register_script('bootstrap', get_stylesheet_directory_uri() . '/js/library/bootstrap.min.js', array('jquery'), '3.2.0', true);
	wp_register_script('jquery.owl.carousel', get_stylesheet_directory_uri() . '/js/library/jquery.owl.carousel.js', array('jquery'), '1.3.2', true);
	wp_register_script('jquery.appear', get_stylesheet_directory_uri() . '/js/library/jquery.appear.min.js', array('jquery'), null, true);
	wp_register_script('perfect-scrollbar', get_stylesheet_directory_uri() . '/js/library/perfect-scrollbar.min.js', array('jquery'), '0.5.6', true);
	wp_register_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
});

add_action('wp_enqueue_scripts', function(){
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('owl.carousel');
	wp_enqueue_style('md-font');
	wp_enqueue_style('style');
	
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('jquery.owl.carousel');
	wp_enqueue_script('jquery.appear');
	wp_enqueue_script('perfect-scrollbar');
	wp_enqueue_script('scripts');
});

