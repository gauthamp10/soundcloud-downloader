# Soundcloud-downloader
 A simple soundcloud downloader based on PHP.The script fetches mp3 links for any soundcloud track url.

## Prerequisites
* Webserver
* PHP

### Usage
📝 *Initialize the _config.php file with your 32 character soundcloud client-id!* 
```
download.php?url='url_of_soundcloud_track'
```
### Example
```
download.php?url=https://soundcloud.com/uppermost/independent
```
### Deployment
Upload the download.php script to your server and then pass soundcloud url via GET['url'] to download files directly.
