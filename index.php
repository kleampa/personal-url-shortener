<?php
include("library/init.php"); 
$my = init();
$my_url = my_url($my);

if(isset($_GET['u'])) { $url = $_GET['u']; } else { $url='http://'; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Personal URL shortener</title>
<meta name="description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="assets/css/style_ie8.css" media="screen" />
<![endif]-->
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/library.js"></script>
<?php if($url == "http://") {} else { 
echo'<script type="text/javascript">
$(document).ready(function() {
short_ussualy();
});

</script>'; } ?>
<link rel="shortcut icon" href="assets/images/favicon.ico"/>
</head>
<body>
	<div id="all">
		<h1>Personal URL shortener</h1>
		
		<div id="error" style="display:none;"></div>
		<div id="done" style="display:none;"></div>
		
		<table id="url_area">
			<tr>
				<td>
					<form method="post" action="" onsubmit="return false;">
						<input type="text" name="url" class="inputus" value="<?=$url?>" size="40"/>
						<input type="submit" class="doit_smaller" value="make it smaller"/>
						<input type="submit" class="doit_custom" value="&raquo;"/> 
						<span id="custom_hide" style="display:none;">&nbsp;&nbsp;&nbsp;
							<span class="custom_url"><?=ABS?>/</span> <input type="text" class="inputus" value="custom path" size="10" name="custom"/>
							<img src="assets/images/check.jpg" class="img_check"/>
						</span>
					</form>
				</td>
			</tr>
		</table>
		
		<div id="history" style="display:none;">
			<span class="text_shadow">Short links created from this computer.</span>
			<table width="100%">
			
			<?php if(count($my_url) == 0) { ?>
				<tr>
					<td valign="top">
						No short links created ever from this computer.
					</td>
				<tr>
			<?php } else { foreach($my_url AS $url) { ?>
				<tr id="l<?=$url['id']?>">
					<td valign="top">
						<a href="<?=$url['original_link']?>" title="Visit"><img src="assets/images/go.png" alt="Visit" class="go"></a> <?=$url['original_link']?><br/>
						<span class="info"><?=$url['short_link']?></span>
					</td>
					<td valign="top" width="70">
						<?=$url['hits']?> hits<br/>
						<span class="info">in <?=$url['days_ago']?> days</span>
					</td>
					<td width="40" valign="middle" align="center">
						<img src="assets/images/delete.png" alt="Delete link" class="delete_icon" rel="<?=$url['id']?>"/>
					</td>
				<tr>
			<?php } } ?>
			</table>
		</div>
		
		<div id="footer">
			<a href="javascript:;" onclick="$('#history').show();">Hit count history</a> <a href="<?=ABS?>" title="Refresh"><img src="assets/images/refresh.png" alt="Refresh"/></a> &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="javascript:void(location.href='<?=ABS?>/?u='+encodeURIComponent(location.href))">Drag this to bookmark bar and create shorten links easier more anything</a><br/>
			<span class="text_shadow">If you use the same computer everytime, you can track hit count without any password or account.</span>
		</div>
	
		
		
	</div>
</body>
</html>