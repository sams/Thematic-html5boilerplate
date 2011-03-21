<?php

    @header("HTTP/1.1 503 Service unavailable", true, 503);

?><!doctype html>
<title><?php bloginfo('name'); ?> Service unavailable</title>

<style>
body { text-align: center;}
h1 { font-size: 50px; }
body { font: 20px Constantia, 'Hoefler Text',  "Adobe Caslon Pro", Baskerville, Georgia, Times, serif; color: #999; text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5); }
::-moz-selection{ background:#FF5E99; color:#fff; }
::selection { background:#FF5E99; color:#fff; } 
details { display:block; }
a { color: rgb(36, 109, 56); text-decoration:none; }
a:hover { color: rgb(96, 73, 141) ; text-shadow: 2px 2px 2px rgba(36, 109, 56, 0.5); }
nav    { float: right; width: 3em; clear: both; }
nav ul    { width: 100%; margin: 0; padding: 0; }
nav li    { display: inline; float: left; }
nav a    { display: block;}
</style>



<?php echo $this->mamo_template_tag_message(); ?>

<nav id="menu">
    <ul>
        <li id="admin"><?php    echo $this->mamo_template_tag_login_logout(); ?></li>
    </ul>
</nav>
