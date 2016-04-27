<?php
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
               
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="card">
                <?php get_sidebar(); ?>
            </div>
            <div class="card">
                <?php include '../parts/mailing-list-form.php'; ?>
            </div>            
        </div>            
    </div>

    <div class="row">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="col-xs-12">
                    <div class="card">
                        <?php
                        get_template_part('content', get_post_format());
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            twentytwelve_content_nav('nav-below');
        else :
            ?>

            <div class="col-md-6 col-xs-12">
                <div class="card">
                    <article id="post-0" class="post no-results not-found">
                        <?php
                        if (current_user_can('edit_posts')) :
                            // Show a different message to a logged-in user who can add posts.
                            ?>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php _e('No posts to display', 'twentytwelve'); ?></h1>
                            </header>

                            <div class="entry-content">
                                <p><?php printf(__('Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve'), admin_url('post-new.php')); ?></p>
                            </div><!-- .entry-content -->

                            <?php
                        else :
                            // Show the default message to everyone else.
                            ?>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php _e('Nothing Found', 'twentytwelve'); ?></h1>
                            </header>
                            <div class="entry-content">
                                <p><?php _e('Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve'); ?></p>
                                <?php get_search_form(); ?>
                            </div><!-- .entry-content -->
                        <?php endif; // end current_user_can() check   ?>
                    </article><!-- #post-0 -->
                </div>
            </div>
        <?php endif; // end have_posts() check    ?>
    </div>
</div>

<?php get_footer(); ?>