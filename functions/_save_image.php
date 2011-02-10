<?php
/**
 * PhpThumb Library Example File
 * 
 * This file contains example usage for the PHP Thumb Library
 * 
 * PHP Version 5 with GD 2.0+
 * PhpThumb : PHP Thumb Library <http://phpthumb.gxdlabs.com>
 * Copyright (c) 2009, Ian Selby/Gen X Design
 * 
 * Author(s): Ian Selby <ian@gen-x-design.com>
 * 
 * Licensed under the MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @author Ian Selby <ian@gen-x-design.com>
 * @copyright Copyright (c) 2009 Gen X Design
 * @link http://phpthumb.gxdlabs.com
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version 3.0
 * @package PhpThumb
 * @subpackage Examples
 * @filesource
 */ 


function get_request( $property, $default = 0 ) {

    if( isset($_REQUEST[$property]) ) {

        return $_REQUEST[$property];

    } else {

        return $default;

    }

}

define ('CACHE_SIZE', 250);					// number of files to store before clearing cache
define ('CACHE_CLEAR', 5);					// maximum number of files to delete on each cache clear
define ('VERSION', '1.14');					// version number (to force a cache refresh)
define ('DIRECTORY_CACHE', './cache');		// cache directory
define ('DIRECTORY_TEMP', './temp');		// temp directory

if (function_exists('imagefilter') && defined('IMG_FILTER_NEGATE')) {
	$imageFilters = array(
		"1" => array(IMG_FILTER_NEGATE, 0),
		"2" => array(IMG_FILTER_GRAYSCALE, 0),
		"3" => array(IMG_FILTER_BRIGHTNESS, 1),
		"4" => array(IMG_FILTER_CONTRAST, 1),
		"5" => array(IMG_FILTER_COLORIZE, 4),
		"6" => array(IMG_FILTER_EDGEDETECT, 0),
		"7" => array(IMG_FILTER_EMBOSS, 0),
		"8" => array(IMG_FILTER_GAUSSIAN_BLUR, 0),
		"9" => array(IMG_FILTER_SELECTIVE_BLUR, 0),
		"10" => array(IMG_FILTER_MEAN_REMOVAL, 0),
		"11" => array(IMG_FILTER_SMOOTH, 0),
	);
}

/* / sort out image source
$src = get_request("src", "");
if($src == '' || strlen($src) <= 3) {
displayError ('no image specified');
}

// clean params before use
$src = cleanSource($src);
// last modified time (for caching)
$lastModified = filemtime($src); */

require_once 'phpthumb/ThumbLib.inc.php';

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

$type = 'logo';


switch($type)	{
	case 'login_logo':
	break;
	case 'appletouch':
	break;
	case 'whitelabel_logo':
	break;
	case 'whitelabel_ft_logo':
	break;
	case 'whitelabel_dev_logo':
	break;
	case 'logo':
	default:
		$thumb = PhpThumbFactory::create($src);
		$thumb->adaptiveResize($new_width, $new_height)->createReflection(40, 40, 80, true, '#a4a4a4');
		$thumb->save('../images/spme.png', 'png')->show();
	break;
}

?>