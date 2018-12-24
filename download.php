<?php
require('_config.php');
function find_trackid($url, $client_id)   //function to fetch track id from url
{
    $data      = file_get_contents("https://api.soundcloud.com/resolve.json?url=$url&client_id=$client_id");
    $data      = json_decode($data, true);
    $trackid   = $data['id'];
    $trackname = $data['title'];
    $trackname = trim($trackname);
    echo $trackname = $trackname . ".mp3";
    return array(
        $trackid,
        $trackname
    );
}
function find_dl($trackid, $client_id)   //function to get download link of specified track
{
    $data = file_get_contents("http://api.soundcloud.com/i1/tracks/$trackid/streams?client_id=$client_id");
    $data = json_decode($data, true);
    $mp3  = $data['http_mp3_128_url'];
    return $mp3;
}
function get_mp3($trackname, $mp3)      //function to download mp3 by appending Songs title as file name.
{
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $trackname . "\"");
    readfile($mp3);
    exit;
}
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    list($trackid, $trackname) = find_trackid($url, $client_id);
    $mp3 = find_dl($trackid, $client_id);
    get_mp3($trackname, $mp3);
  
}
?>