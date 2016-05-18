<?php 
	session_start();
	session_unset();
	session_destroy();
	echo "<script>top.location.href='/';</script>"; 
?>