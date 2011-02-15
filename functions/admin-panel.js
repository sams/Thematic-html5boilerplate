// Title : Set Thematic Image Logo
// Author : S Sherlock
// URL : http://samsherlock.com/
//
// Description : Sets the value of the logo the static cached image and changes the srce of image preview and auto saves the update (auto save needs doing)
//
// Created : 
// Modified : 
	
function setRedirect (url) {
	hiddenframe.location = url;
}
function readyLoad() {
	jQuery('#header_img_location').attr('readonly', false).val( hiddenframe.location.href ).attr('readonly', true);
	if(jQuery('#header_img_location').val() == hiddenframe.location.href ) {
		jQuery('.img_preview img').attr('src', hiddenframe.location.href);
	}
}

jQuery(document).ready(function () {
	var $imgPreviews = jQuery('.img_preview img');
	jQuery('body').append('<iframe src="blank.html" name="hiddenframe" id="hiddenframe" onload="readyLoad()">');
	
	if($imgPreviews.length > 0)	{
		$imgPreviews.each(function () {
			setRedirect (jQuery(this).attr('src'), this);
		});
	}
});
















