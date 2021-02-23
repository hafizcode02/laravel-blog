<?php

use App\Models\Post;

function getPages()
{
    // to get navbar of pages in home of website
    $pages = Post::where('post_type', 'page')->where('is_published', '1')->get();
    return $pages;
}
