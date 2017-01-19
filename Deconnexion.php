<?php
    session_start();
    $url = $_REQUEST["url"];
    session_destroy();
	header("Location: ".$url);
?>
