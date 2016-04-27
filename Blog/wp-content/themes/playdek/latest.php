<div class="container-fluid primary">
    <div class="row">
        <?php
        if (have_posts()){
            $n = 0;
            while (have_posts() && $n++ < 4) : the_post();
                ?>
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <?php
                        get_template_part('content', get_post_format());
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
            twentytwelve_content_nav('nav-below');
        }
            ?>
    </div>
</div>
