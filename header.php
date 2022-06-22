<!-- ========== header.php ========== -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">        <?php wp_head(); ?>
    </head>
    <header>
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php get_header_logo(); ?></a>
        <!--
        <i class="fas fa-bars fa-2x" id="barIcon"></i>
        -->
    </header>
    <div id="wrapper">
    <div class="container">