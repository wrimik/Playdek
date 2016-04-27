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
                    <h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'twentytwelve' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>

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
</div>

<?php get_footer(); ?>