<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ankieter</title>
<link rel="stylesheet" href="/styles/style.css" type="text/css">
<script type="text/javascript" src="/scripts/jquery.js"></script>
<script type='text/javascript' src='/scripts/jquery.editable.js'></script>
</head>
<body>

<table id="top" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<a href="/" id="bluebar"><img src="/images/logo.jpg"  border="0"></a>
		</td>
		<td id="navigation">
<ul>
	<li><a href="/ankieter/" id="bluebar">ankiety</a></li>
	<li><a href="/raport/" id="greenbar">raporty</a></li>		
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