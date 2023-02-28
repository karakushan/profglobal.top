<?php
/* Template Name: Marketplace */

get_header(); ?>

<div class="page-header-wrapper page-header-wrapper-archive">
    <div class="container">
        <div class="row">
            <div class="col">
                <header class="page-header">
                    <?php the_title('<h1 class="page-title">', '</h1>') ?>
                </header>
            </div>
        </div>
    </div>
</div>

<div class="site-content-inside">
    <div class="container">
        <div class="row">

            <?php
            $products = new WP_Query([
                'post_type' => 'product',
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            ]);

            while ($products->have_posts()): $products->the_post();  ?>
                <div class="col-xl-4 col-md-6">
                    <div class="card-product">
                        <div class="card-product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php fs_product_thumbnail() ?>
                            </a>
                        </div>
                        <div class="card-product-body">
                            <a href="<?php the_permalink(); ?>" class="card-product-title"><?php the_title() ?></a>
                            <div class="card-product-description">
                               <?php the_excerpt(); ?>
                            </div>
                            <div class="card-product-price">
                                <span class="price"><?php do_action('fs_the_price'); ?></span>
                            </div>
                            <div class="card-product-button">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                    </svg>
                                    <span>Купити</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_query(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>


