<?php

$array = ["mp4","asdf"];
$file_extension = "mp4";

for($i = 0; $i < count($array); ++$i)
{
  if($array[$i] == $file_extension)
    {
        $offset = $i;
    }
}