<?php
/**
 * Template part for displaying no content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photo_MuXeD
 */

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$tax = get_taxonomy($term->taxonomy);
?>

<section class="error-404 not-found">

    <h1 class="page-title"><?php printf( esc_html__( 'Empty %2$s %1$s', 'photo-muxed' ), $tax->labels->singular_name, $term->name ) ?></h1>

    <div class="page-content">

        <p><?php printf(esc_html__( 'Please, add items to the %1$s. Then you can see items here.', 'photo-muxed' ), $term->name) ?></p>

    </div>

</section>
