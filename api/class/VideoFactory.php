<?php

class VideoFactory
{
    public static function getVideoByUid($uid)
    {
        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT id, uid, videotype FROM videos WHERE uid = '" . $db->escapeString($uid) . "'");
        $results = $results->fetchArray(SQLITE3_ASSOC);

        if(empty($results))
        {
            return null;
        }

        $video_item = new VideoItem;
        $video_item->id=$results["id"];
        $video_item->uid=$results["uid"];
        $video_item->name=$results["name"];
        $video_item->size=$results["size"];
        $video_item->type=$results["type"];
        return $video_item;


    }

    public static function getVideosByRecent()
    {
        
    }
}

class VideoItem
{
    public $id;
    public $uid;
    public $name;
    public $size;
    public $type;
}