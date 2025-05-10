<?php

get_header();

// Setup post data in a clean, reusable way
$post = get_post();
$postData = (object) [
    'title' => get_the_title($post),
    'content' => apply_filters('the_content', $post->post_content),
    'date' => get_the_date('', $post),
    'author_name' => get_the_author_meta('display_name', $post->post_author),
    'author_id' => $post->post_author,
    'id' => $post->ID,
    'excerpt' => get_the_excerpt($post),
    'permalink' => get_permalink($post),
];
?>

<div>
    <h1>
        <?= $postData->title ?>
    </h1>
    <div class="post-content">
        <?= $postData->content; ?>
    </div>
    <div class="post-meta">
        Posted by <?= $postData->author_name; ?> on <?= $postData->date; ?>
    </div>
</div>

<?php
get_footer();
