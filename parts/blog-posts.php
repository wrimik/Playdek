<?php
include 'Blog/wp-blog-header.php';

$args = array('numberposts' => 3, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
$postslist = get_posts($args);
$blog = array();
foreach ($postslist as $post){
    setup_postdata($post);
    $blog[] = array(
            'date' => date('m/d/y', strtotime($post->post_date)),
            'link' => $post->guid,
            'title'=> $post->post_title,
            'preview'=> $post->post_excerpt
        );
}