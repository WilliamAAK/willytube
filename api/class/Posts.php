<?php

class Posts
{
    public static function listRecent(): void
    {
        $videos = PostsFactory::getVideosByRecent();

        print(json_encode($videos));
    }
}