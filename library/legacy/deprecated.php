<?php

/**
 * Function for handling the bloginfo / get_bloginfo data using our own 'cache'.
 * move the content div inside of template files By taking the content div out of 
 *
 * We removed the functionality because it will not run on all systems. The system used
 * a fallback, but we could not guarantee that the fallback would meet every possible
 * error condition.
 *
 * @since 0.9.6
 * @deprecated 0.6.1
 */

function thm_bloginfo($command = '', $echo = FALSE) {

    if ($echo) {
	   bloginfo($command);
    } else {
        return get_bloginfo($command);
    }
} 

?>