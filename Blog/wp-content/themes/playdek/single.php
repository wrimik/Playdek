<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>

<div class="container-fluid primary">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <div class="card sp caption page-title">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <h1 class="caption">
                        DEVELOPER DIARY
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="card">
                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('content', get_post_format()); ?>

                    <nav class="nav-single">
                        <h3 class="assistive-text"><?php _e('Post navigation', 'twentytwelve'); ?></h3>
                        <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'twentytwelve') . '</span> %title'); ?></span>
                        <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'twentytwelve') . '</span>'); ?></span>
                    </nav><!-- .nav-single -->

                    <?php // comments_template('', true); ?>

                <?php endwhile; // end of the loop. ?>

            </div><!-- .card -->
        </div><!-- .col -->

        <div class="col-md-4 col-xs-12">
            <div class="card">
        <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>