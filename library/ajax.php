<?php
if(!isset($_POST)) {}
else {
	$url = mysql_real_escape_string($_POST['url']);
	$custom = mysql_real_escape_string($_POST['custom']);
	$delete = mysql_real_escape_string(intval($_POST['delete']));
	
	if($delete != 0) {
		$cookie = user_cookie();
		$sql = mysql_query("SELECT id FROM url WHERE id='$delete' AND cookie='$cookie' LIMIT 0,1");
		if(mysql_num_rows($sql) == 0) {
			echo'0|Permission denied!';
		}
		else {
			mysql_query("DELETE FROM url WHERE id='$delete'");
			echo'1';
		}
		mysql_free_result($sql);
	}
	else {
	
		if($custom == "") {
			if(!validURL($url)) {
				echo'0|Definitely this isn\'t a valid URL!';
			}
			else {
				$short = genUrl(rand(3,5));
				$short = add_url($url,$short,'usual');
				
				echo'1|'.ABS.'/'.$short.'';
			}
		}
		else {
			if(!validURL($url)) {
				echo'0|Definitely this isn\'t a valid URL!';
			}
			elseif(!validCustom($custom)) {
				echo'0|Invalid custom path (just numeric & text characters)!';
			}
			else {
				$custom = add_url($url,$custom,'custom');
				if($custom == "0") {
					echo'0|Custom URL already in use!';
				}
				else {
					echo'1|'.ABS.'/'.$custom.'';
				}
			}
		}	
	
	}
}



?>