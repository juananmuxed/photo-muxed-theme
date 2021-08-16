<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photo_MuXeD
 */

 
$options = get_option('photo_muxed_theme_options');
$show_title = (isset($options['photo_muxed_show_title_grid'])) ? true : false;
$show_desc = (isset($options['photo_muxed_show_desc_grid'])) ? true : false;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
    <div class="container">
        <?php the_post_thumbnail('large') ?>
        
        <div class="entry-content">
            <?php if( $show_title ) the_title( '<h3 class="entry-title">', '</h3>' ) ?>
        
            <?php if( $show_desc ) the_content('<div class="entry-content">', '</div>') ?>
        </div>
    </div>

</div>
