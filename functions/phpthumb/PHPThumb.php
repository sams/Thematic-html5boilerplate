<?php

// SETTINGS
// 
// To squeak a few more KB of memory performance out of this script replace the dynamic settings
// here with static paths.

// 
// The path to PHPThumb

define('DS', DIRECTORY_SEPARATOR);
define('BASEPATH', realpath('.'));
define('BASEURL', str_replace(array(basename($_SERVER['SCRIPT_NAME']), '\\'), array('', '/'), dirname($_SERVER['SCRIPT_NAME'])));
define('ABSBASE', str_replace(BASEURL, '', str_replace('\\', '/', BASEPATH)));
define('ABSURL', str_replace(ABSBASE, '', str_replace('\\', '/', BASEPATH)));

require_once 'ThumbLib.inc.php';

// 
// The path to your web root
$document_path = $_SERVER['DOCUMENT_ROOT'];

// 
// The path to your cache folder
$cache_path = str_replace(array('functions' . DS . 'phpthumb', '/'), array('cache/', '\\'), BASEPATH);

// 
// The URI to your cache folder
$cache_uri = 'http://' . trim($_SERVER['HTTP_HOST']) . str_replace(array('functions/phpthumb'), array('cache/'), BASEURL);

// 
// How long caches should live. Remember, hard refreshes will also clear out your cache so you'll be
// safe setting this pretty high
$cache_life = '-1 month'; 

// End configurable settings


function get_request( $property, $default = 0 ) {

    if( isset($_REQUEST[$property]) ) {

        return $_REQUEST[$property];

    } else {

        return $default;

    }

}

define ('CACHE_SIZE', 250);                    // number of files to store before clearing cache
define ('CACHE_CLEAR', 5);                    // maximum number of files to delete on each cache clear
define ('VERSION', '1.14');                    // version number (to force a cache refresh)
define ('DIRECTORY_CACHE', $cache_path);        // cache directory
define ('DIRECTORY_TEMP', './temp');        // temp directory

    

// sort out image source
$src = get_request("src", "");
if($src == '' || strlen($src) <= 3) {
displayError ('no image specified');
}

// clean params before use
$src = cleanSource($src);
// last modified time (for caching)
$lastModified = filemtime($src); 
// get mime type of src
$mime_type = mime_type($src);

// get properties
$new_width         = preg_replace("/[^0-9]+/", '', get_request('w', 0));
$new_height     = preg_replace("/[^0-9]+/", '', get_request('h', 0));
$zoom_crop         = preg_replace("/[^0-9]+/", '', get_request('zc', 1));
$quality         = preg_replace("/[^0-9]+/", '', get_request('q', 80));
$filters        = get_request('f', '');
$sharpen        = get_request('s', 0);
$logo        = get_request('type', 'logo');

if ($new_width == 0 && $new_height == 0) {
    $new_width = 100;
    $new_height = 100; 
}


/**
 *
 */
function get_cache_file() {

    global $lastModified;
    static $cache_file;

    if (!$cache_file) {
        $cachename = $_SERVER['QUERY_STRING'] . VERSION . $lastModified;
        $cache_file = md5($cachename) . '.png';
    }

    return $cache_file;

}


/**
 *
 */
function checkExternal ($src) {

    $allowedSites = array(
        'flickr.com',
        'picasa.com',
        'blogger.com',
        'wordpress.com',
        'img.youtube.com',
    );

    if (preg_match('/http:\/\//', $src) == true) {

        $url_info = parse_url ($src);

        $isAllowedSite = false;
        foreach ($allowedSites as $site) {
            $site = '/' . addslashes($site) . '/';
            if (preg_match($site, $url_info['host']) == true) {
                $isAllowedSite = true;
            }
        }

        if ($isAllowedSite) {

            $fileDetails = pathinfo($src);
            $ext = strtolower($fileDetails['extension']);

            $filename = md5($src);
            $local_filepath = DIRECTORY_TEMP . '/' . $filename . '.' . $ext;

            if (!file_exists($local_filepath)) {

                if (function_exists('curl_init')) {

                    $fh = fopen($local_filepath, 'w');
                    $ch = curl_init($src);

                    curl_setopt($ch, CURLOPT_URL, $src);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
                    curl_setopt($ch, CURLOPT_FILE, $fh);

                    if (curl_exec($ch) === FALSE) {
                        if (file_exists($local_filepath)) {
                            unlink($local_filepath);
                        }
                        displayError('error reading file ' . $src . ' from remote host: ' . curl_error($ch));
                    }

                    curl_close($ch);
                    fclose($fh);

                } else {

                    if (!$img = file_get_contents($src)) {
                        displayError('remote file for ' . $src . ' can not be accessed. It is likely that the file permissions are restricted');
                    }

                    if (file_put_contents($local_filepath, $img) == FALSE) {
                        displayError('error writing temporary file');
                    }

                }

                if (!file_exists($local_filepath)) {
                    displayError('local file for ' . $src . ' can not be created');
                }

            }

            $src = $local_filepath;

        } else {

            displayError('remote host "' . $url_info['host'] . '" not allowed');

        }

    }

    return $src;

}

/**
 * tidy up the image source url
 */
function cleanSource($src) {

    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $regex = "/^((ht|f)tp(s|):\/\/)(www\.|)" . $host . "/i";

    $src = preg_replace ($regex, '', $src);
    $src = strip_tags ($src);
    $src = checkExternal ($src);

    // remove slash from start of string
    if (strpos($src, '/') === 0) {
        $src = substr ($src, -(strlen($src) - 1));
    }

    // don't allow users the ability to use '../'
    // in order to gain access to files below document root
    $src = preg_replace("/\.\.+\//", "", $src);

    // get path to image on file system
    $src = get_document_root($src) . '/' . $src;

    return $src;

}

 


/**
 *
 */
function get_document_root ($src) {

    // check for unix servers
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $src)) {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    // check from script filename (to get all directories to timthumb location)
    $parts = array_diff(explode('/', $_SERVER['SCRIPT_FILENAME']), explode('/', $_SERVER['DOCUMENT_ROOT']));
    $path = $_SERVER['DOCUMENT_ROOT'];
    foreach ($parts as $part) {
        $path .= '/' . $part;
        if (file_exists($path . '/' . $src)) {
            return $path;
        }
    }

    // the relative paths below are useful if timthumb is moved outside of document root
    // specifically if installed in wordpress themes like mimbo pro:
    // /wp-content/themes/mimbopro/scripts/timthumb.php
    $paths = array(
        ".",
        "..",
        "../..",
        "../../..",
        "../../../..",
        "../../../../.."
    );

    foreach ($paths as $path) {
        if(file_exists($path . '/' . $src)) {
            return $path;
        }
    }

    // special check for microsoft servers
    if (!isset($_SERVER['DOCUMENT_ROOT'])) {
        $path = str_replace("/", "\\", $_SERVER['ORIG_PATH_INFO']);
        $path = str_replace($path, "", $_SERVER['SCRIPT_FILENAME']);

        if (file_exists($path . '/' . $src)) {
            return $path;
        }
    }

    displayError('file not found ' . $src);

}
 


/**
 * determine the file mime type
 */
function mime_type($file) {

    if (stristr(PHP_OS, 'WIN')) {
        $os = 'WIN';
    } else {
        $os = PHP_OS;
    }

    $mime_type = '';

    if (function_exists('mime_content_type') && $os != 'WIN') {
        $mime_type = mime_content_type($file);
    }

    // use PECL fileinfo to determine mime type
    if (!valid_src_mime_type($mime_type)) {
        if (function_exists('finfo_open')) {
            $finfo = @finfo_open(FILEINFO_MIME);
            if ($finfo != '') {
                $mime_type = finfo_file($finfo, $file);
                finfo_close($finfo);
            }
        }
    }

    // try to determine mime type by using unix file command
    // this should not be executed on windows
    if (!valid_src_mime_type($mime_type) && $os != "WIN") {
        if (preg_match("/FreeBSD|FREEBSD|LINUX/", $os)) {
            $mime_type = trim(@shell_exec('file -bi ' . escapeshellarg($file)));
        }
    }

    // use file's extension to determine mime type
    if (!valid_src_mime_type($mime_type)) {

        // set defaults
        $mime_type = 'image/png';
        // file details
        $fileDetails = pathinfo($file);
        $ext = strtolower($fileDetails["extension"]);
        // mime types
        $types = array(
             'jpg'  => 'image/jpeg',
             'jpeg' => 'image/jpeg',
             'png'  => 'image/png',
             'gif'  => 'image/gif'
         );

        if (strlen($ext) && strlen($types[$ext])) {
            $mime_type = $types[$ext];
        }

    }

    return $mime_type;

}


/**
 *
 */
function valid_src_mime_type($mime_type) {

    if (preg_match("/jpg|jpeg|gif|png/i", $mime_type)) {
        return true;
    }

    return false;

}

$params = array('src'=>false, 'w'=>false, 'h'=>false);
$options = array('resizeUp'=>true,'jpegQuality'=>100,'cache_life'=>$cache_life);
extract(array_merge($params, $options, $_GET));

$cache = md5($src.$w.$h).'.png';
$cache_path.= $cache;

if (
    file_exists($cache_path) &&
    ($cache_life == false || filemtime($cache_path) > strtotime($cache_life)) &&
    @$_SERVER['HTTP_CACHE_CONTROL'] != 'no-cache'
)
{
    header('Content-type: '.$mime_type);
    header('Location: '.$cache_uri.$cache);
    exit();
}
else
{
    if (!file_exists($src))
    {
        $src = $document_path.$src;
    }

    $thumb = PhpThumbFactory::create($src);
    $thumb->setOptions($options);
    $thumb->adaptiveResize($w, $h)->createReflection(40, 40, 80, true, '#a4a4a4');;

    $thumb->save($cache_path);
} 
    header('Content-type: '.$mime_type);

$thumb->show();
flush();
