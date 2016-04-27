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
                <h2>Welcome to the Developer Diary</h2>
                <p>
                    Here is the description! This content will be editable and 
                    will not be treated as a regular blog post.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit. Donec vel egestas velit. 
                    Cras dignissim elementum luctus. Curabitur ut suscipit 
                    enim. Aliquam massa elit, hendrerit vitae ornare in, 
                    congue vitae tortor. Aliquam accumsan enim sed nulla
                    eleifend faucibus. Nunc in neque nec orci elementum 
                    sagittis tempor et orci. Integer pulvinar ornare aliquam.
                </p>
                <p>
                    Ut at feugiat metus, sed porta nunc. Cras vehicula vel 
                    dolor et hendrerit. Praesent commodo, justo sit amet 
                    pharetra varius, dolor nunc porta urna, quis pretium augue
                    nibh non nulla. Nulla vitae felis et metus lacinia viverra
                    sit amet et lorem. Proin sodales vulputate libero vitae 
                    sodales. Mauris dictum est mattis mattis egestas. Proin
                    ipsum nisi, commodo et nisl at, euismod tempus enim.
                </p>
                <p>
                    Nunc quam mi, placerat at condimentum vel, interdum et odio. 
                    Pellentesque tincidunt imperdiet ultricies. Donec commodo
                    ipsum ultricies blandit sodales. 
                </p>
                <p>
                    Nunc quam mi, placerat at condimentum vel, interdum et odio. 
                    Pellentesque tincidunt imperdiet ultricies. Donec commodo
                </p>
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