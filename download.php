<?php
require '_config.php';

/**
 * Function to fetch track id from url
 * @param string $url Soundcloud track URL
 * @param string $client_id Your client ID
 */
function find_trackid($url, $client_id)
{
    $data      = file_get_contents("https://api.soundcloud.com/resolve.json?url=$url&client_id=$client_id");
    $data      = json_decode($data, true);
    $trackid   = $data['id'];
    $trackname = trim($data['title']);
    echo $trackname = $trackname . ".mp3";
    return [$trackid, $trackname];
}

/**
 * Function to get download link of specified track
 * @param string $trackid ID of the track to download
 * @param string $client_id Your client ID
 */
function find_dl($trackid, $client_id)
{
    $data = file_get_contents("http://api.soundcloud.com/i1/tracks/$trackid/streams?client_id=$client_id");
    $data = json_decode($data, true);
    $mp3  = $data['http_mp3_128_url'];
    return $mp3;
}
/**
 * Function to download mp3 by appending Songs title as file name.
 * @param string $trackname The name of the track
 * @param string $mp3 The file to download
 */
function get_mp3($trackname, $mp3)
{
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $trackname . "\"");
    readfile($mp3);
    exit;
}

if (!isset($_GET['url']))  
    return;
$url = $_GET['url'];
list($trackid, $trackname) = find_trackid($url, $client_id);
$mp3 = find_dl($trackid, $client_id);
get_mp3($trackname, $mp3);
  
?>