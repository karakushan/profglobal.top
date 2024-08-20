<?php
if(!class_exists('\FS\FS_Config',false)) return;
/**
 * Title: Latest Products
 * Slug: profglobal/latest-products
 * Categories: profglobal
 */
$products = new WP_Query( array(
    'post_type' => \FS\FS_Config::get_data('post_type'),
    'posts_per_page' => 6,
) );;
?>

<?php if ( $products->have_posts() ) : ?>
    <!-- wp:heading {"level":2,"align":"center"} -->
    <h2 class="has-text-align-center"><?php esc_html_e('Latest Products', 'profglobal'); ?></h2>
    <!-- /wp:heading -->

    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <div class="wp-block-group">
            <figure class="wp-block-image size-full">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" class="wp-image-<?php echo get_post_thumbnail_id(); ?>"/>
            </figure>
            <h3><a href="#"><?php the_title(); ?></a></h3>
            <p><?php the_excerpt(); ?></p>
        </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

<?php endif; ?>
