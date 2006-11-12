<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin</title>
<link rel="stylesheet" href="/styles/style.css" type="text/css">
</head>
<body>

<table id="top" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<a href="/"><img src="/images/logo.jpg"  border="0"></a>
		</td>
		<td id="navigation">
<ul>
	<li><a href="/respondenci" id="purplenbar">respondenci</a></li>		
	<li><a href="/admin/" id="bluebar">admin</a></li>
</ul>
		
		</td>
	</tr>
</table>
<table id="body"  cellspacing="0" cellpadding="0">
	<tr>
		<td id="left">
<?php echo $this->body; ?>

		</td>
		<td id="right">
		<?php echo $this->render('/layout/login.php');?>	
		<img src="/images/right.jpg">
		</td>
	</tr>
</table>
</div>
</body>
</html>
