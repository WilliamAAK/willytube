<?php
class Posts
{
    public static function listRecent(): void
    {
        $videos = PostsFactory::getVideosByRecent();

        if ($videos == null)
        {
            Api::error(404, "No videos found in database");
        }

        print(json_encode($videos));
    }
}