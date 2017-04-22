<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Arlene
 */

?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" type="image/png" href="<?php echo arlene_get_custom_logo(); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if ( is_front_page() && is_home() ) : ?>
    <section <?php echo 'class= "fixed-header"'; ?>>
        <header class="background-white">
            <div class="row clearfix">
                <div class="small-3 large-2 medium-2 columns logo">
                    <a href="<?php echo home_url(); ?>"> <img src="<?php echo arlene_get_custom_logo(); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>"> </a>
                </div><!--logo/-->
                <div class="nav-wrapper large-8 medium-8 columns">
                    <?php get_template_part('menu'); ?>
                </div><!--/nav-wrapper-->   
                <div class="small-4 large-2 medium-2 columns socials medium-uncentered small-centered large-uncentered">
                    <ul>
                        <?php arlene_social_links();?>
                    </ul>
                </div><!--socials/-->
            </div>
        </header>
    </section>
    <?php else:?>
    <section>
        <header class="background-white">
            <div class="row clearfix">
                <div class="small-3 large-2 medium-2 columns logo">
                    <a href="<?php echo home_url(); ?>"> <img src="<?php echo arlene_get_custom_logo(); ?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>"> </a>
                </div><!--logo/-->
                <div class="nav-wrapper large-8 medium-8 columns">
                    <?php get_template_part('menu'); ?>
                </div><!--/nav-wrapper-->   
                <div class="small-4 large-2 medium-2 columns socials medium-uncentered small-centered large-uncentered">
                    <ul>
                        <?php arlene_social_links();?>
                    </ul>
                </div><!--socials/-->
            </div>
        </header>
        <section class="clearfix height-150 single-cover" 
         style="background:url(<?php echo esc_url(get_header_image());?>); background-position:center center;">
        <h1 class="center title">
            <?php arlene_custom_title();?>
        </h1>
        </section>
    </section>
    <?php endif;?>