<?php

class Search
{
    public static function get($title)
    {
        if (empty($title))
        {
            Api::error(400, "Search cannot be empty");
        }

        # Connects to sqlite database
        $db = Database::connect();

        # Query database and fetch results to array
        $results = $db->query("SELECT uid, title, date FROM videos WHERE title LIKE '" . "%" . $db->escapeString($title) . "%" . "'");
        while ($dbs_row = $results->fetchArray(SQLITE3_ASSOC)) {
            $assoc_array[] = $dbs_row;
        }

        if ($assoc_array == null)
        {
            Api::error(404, "No results found");
        }

        for ($i = 0; $i < count($assoc_array); ++$i)
        {
            $assoc_array[$i]["date"] = date('M d Y',$assoc_array[$i]["date"]);;
        }

        return $assoc_array;
    }

    public static function orderByRecent($title): void
    {
        $results = Search::get($title);
        header('Content-Type: application/json');
        print_r(json_encode($results));
    }
}