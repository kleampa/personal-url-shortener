<?php
$short = mysql_real_escape_string(strip_tags($_GET['short']));
$sql = mysql_query("SELECT url,id FROM url WHERE short='$short' LIMIT 0,1") or die(mysql_error());
if(mysql_num_rows($sql) == 0) {
	header("HTTP/1.0 404 Not Found");
	echo'Page not found! <a href="/">Click here</a>';
}
else {
	$row = mysql_fetch_object($sql);
	$go = stripslashes($row->url);
	mysql_query("UPDATE url SET hits=hits+1 WHERE id='$row->id'") or die(mysql_error());
	header('HTTP/1.1 301 Moved Permanently');
	header("location:$go");
}
mysql_free_result($sql);
exit();
?>