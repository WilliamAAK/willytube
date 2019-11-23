<?php

class Posts
{
    public static function listRecent(): array
    {
        $videos = PostsFactory::getVideosByRecent();

        return $videos;
    }
}