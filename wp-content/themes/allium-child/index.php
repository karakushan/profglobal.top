<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Allium
 */

get_header(); ?>

<?php if (!have_posts()) : ?>
    <div class="page-header-wrapper page-header-wrapper-home">
        <div class="container">

            <div class="row">
                <div class="col">

                    <header class="page-header">
                        <?php printf('<h1 class="page-title"><span class="page-title-label">%1$s</span></h1>', esc_html__('Nothing Found', 'allium')); ?>
                    </header><!-- .page-header -->

                </div><!-- .col -->
            </div><!-- .row -->

        </div><!-- .container -->
    </div><!-- .page-header-wrapper -->
<?php endif; ?>

<div class="site-content-inside">
    <div class="container">
        <div class="row">

            <div id="primary" class="content-area <?php allium_layout_class('content'); ?>">
                <main id="main" class="site-main" role="main">

                    <?php
                    $count = 1;
                    if (have_posts()) : ?>

                        <div id="post-wrapper" class="post-wrapper post-wrapper-archive">
                            <?php /* Start the Loop */ ?>
                            <?php while (have_posts()) : the_post(); ?>

                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part('template-parts/content/content', get_post_format());
                                ?>

                                <?php if ($count % 2 == 0 && $count > 1): ?>
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-format="fluid"
                                         data-ad-layout-key="-di-8e+ed+it-12t"
                                         data-ad-client="ca-pub-2704679583568814"
                                         data-ad-slot="6212621992"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>

                                <?php endif ?>
                                <?php $count++; ?>

                            <?php endwhile; ?>
                        </div><!-- .post-wrapper -->

                        <?php allium_the_posts_pagination(); ?>

                    <?php else : ?>

                        <div class="post-wrapper post-wrapper-single post-wrapper-single-notfound">
                            <?php get_template_part('template-parts/content/content', 'none'); ?>
                        </div><!-- .post-wrapper -->

                    <?php endif; ?>

                </main><!-- #main -->
            </div><!-- #primary -->

            <?php get_sidebar(); ?>

        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .site-content-inside -->

<?php get_footer(); ?>
