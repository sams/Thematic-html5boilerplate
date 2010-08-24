<?php



/**
 * The Generate the javascript for the ajax remove image feature
 *
 */

function childtheme_javascript() {
global $my_shortname;

$nonce= wp_create_nonce  ('my-nonce');
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {

	// Register the action we are looking for
	$('.remove_img').click(function(){

		var id = $(this).attr('id');

		var container = $(this).parent();

		// Set what we are going to send via ajax
		var data = {
			action: 'remove_header_image',
			_nonce: '<?php echo $nonce; ?>',
			field: id,
		};

		// Disable submitting options
		$('#childoption_submit').attr('disabled', 'disabled');

		jQuery.post(ajaxurl, data, function(response) {
			if (response == 'Nice Try')
			{
				alert(response)
			}
			else if (response == 'Error')
			{
				alert('<?php _e('Unable to remove image') ?>')
			}
			else
			{

				//remove thumbnail, path to image, and remove button
				$(container).children('.img_preview').fadeOut("slow");
				$(container).children('.remove_img').fadeOut("slow");
				$(container).children('.img_location').fadeOut("slow");

				//remove input so it doesn't accidentaly get processed
				$(container).children('.img_location').remove();

				//let user know what happened
				$(container).prepend('<p><span class="updated inline">' + response +'</span><br /></p>');
			}
		});

		// Allow option submition again
		$('#childoption_submit').removeAttr("disabled");

		// Stop the submit button from actually submitting the form
		return false;
	});
});
</script>
<?php
}


add_action('wp_ajax_remove_header_image', 'childtheme_remove_header_image_callback');

/**
 * Process our Ajax request to remove the header image
 *
 */

function childtheme_remove_header_image_callback() {
$nonce=$_REQUEST['_nonce'];
if (! wp_verify_nonce($nonce, 'my-nonce') ) die('Nice Try');
if (! childtheme_can_edit_theme_options() ) die('Nice Try');

	global $wpdb; // this is how you get access to the database

	$delete = delete_option($_REQUEST['field']);


	if ($delete == true)
		_e("Image Removed");
	else
		_e("Error");



	die();
}