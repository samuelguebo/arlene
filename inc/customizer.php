<?php
/**
 * Arlene Theme Customizer
 *
 * @package Arlene
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function arlene_customize_register( $wp_customize ) {
	
    // Create sections for socials links
    $wp_customize->add_section('arlene_social_links', array(
		'title' => __('Social links', 'arlene'),
		'priority' => 30,
	));
    
    // Facebook link
    $wp_customize->add_setting('facebook_url', array(
		'default' => '#',
		'transport' => 'refresh',            
        'sanitize_callback'	=> 'arlene_sanitize_text'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'facebook_url',
		array(
			'label' => __('Enter Facebook url', 'arlene'),
			'section' => 'arlene_social_links',
			'settings' => 'facebook_url',
			'type' => 'text',
		)
	));
    
    // Twitter link
    $wp_customize->add_setting('twitter_url', array(
		'default' => '#',
		'transport' => 'refresh',
        'sanitize_callback'	=> 'arlene_sanitize_text'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'twitter_url',
		array(
			'label' => __('Enter Twitter url', 'arlene'),
			'section' => 'arlene_social_links',
			'settings' => 'twitter_url',
			'type' => 'text',
		)
	));
    
    // Youtube link
    $wp_customize->add_setting('youtube_url', array(
		'default' => '#',
		'transport' => 'refresh',
		'sanitize_callback'	=> 'arlene_sanitize_text'
	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'youtube_url',
		array(
			'label' => __('Enter Youtube url', 'arlene'),
			'section' => 'arlene_social_links',
			'settings' => 'youtube_url',
			'type' => 'text',
		)
	));
    
    // Github link
    $wp_customize->add_setting('github_url', array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback'	=> 'arlene_sanitize_text'
	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'github_url',
		array(
			'label' => __('Enter Github url', 'arlene'),
			'section' => 'arlene_social_links',
			'settings' => 'github_url',
			'type' => 'text',
		)
	));
    
    
    /*
     * Theme colors using Customizer Custom Controls, 
     * @link https://github.com/bueltge/Wordpress-Theme-Customizer-Custom-Controls
     *
     */
    require_once dirname(__FILE__) . '/class-palette_custom_control.php';
    
    $wp_customize->remove_control('header_textcolor'); // remove existing Headline color setting
    $wp_customize->add_setting(
		'arlene_theme_color', array(
			'default' => '',
            'sanitize_callback'	=> 'arlene_sanitize_colors'

		)
	);
    
    $wp_customize->add_control(
            new Palette_Custom_Control(
                $wp_customize, 'arlene_theme_color', array(
                    'label' => __( 'Theme color', 'arlene' ),
                    'section' => 'colors',
                    'settings' => 'arlene_theme_color',
                )
            )
        );
    
    
    
     /*
     * From the blog text
     * 
     *
     */
    // Create sections for socials links
    $wp_customize->add_section('arlene_from_section', array(
		'title' => __('From the blog', 'arlene'),
		'priority' => 30,
	));
    
    // Typing lines
    $wp_customize->add_setting('from_text', array(
		'default' => 'From the blog',
		'transport' => 'refresh',
        'sanitize_callback'	=> 'arlene_sanitize_text'

	));
    $wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'from_text',
		array(
			'label' => __('Replace the defaut &laquo; From the blog &raquo; text', 'arlene'),
			'section' => 'arlene_from_section',
			'settings' => 'from_text',
			'type' => 'textarea',
		)
	));
}
add_action( 'customize_register', 'arlene_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function arlene_customize_preview_js() {
	wp_enqueue_script( 'arlene_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

/* Validate user input */
get_template_part('inc/customizer-sanitize'); 
