<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ankieter</title>
<link rel="stylesheet" href="/styles/style.css" type="text/css">
<script type="text/javascript" src="/scripts/jquery.js"></script>
<script type='text/javascript' src='/scripts/jquery.editable.js'></script>
<script type="text/javascript" src="/scripts/ankieter_pagespecific.js"></script>
<script type="text/javascript" src="/scripts/iutil.js"></script>
<script type="text/javascript" src="/scripts/idrag.js"></script>
<script type="text/javascript" src="/scripts/idrop.js"></script>
<script type="text/javascript" src="/scripts/isortables.js"></script>

<style type="text/css" media="all">
body
{
	background: #fff;
	height: 100%;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.edit_inline{
	display:inline;
}
.dupa{
	text-align:right;
	color:red;
	
	float:right;
	
	text-align:right;
	display:block;
}

ul.sortable
{
	width: 740px;
	background-color: #444;
	border: 1px solid #555;
	list-style: none;
	
	padding: 6px;
	float: left;
}
li
{
	margin: 2px;
	padding: 4px;
	background: #666;
	border: 1px solid #666;
	color: #ccc;
}
ul.sortableactive
{
	border: 1px dashed #006600;
	background-color: #003300;
}
ul.sortablehover
{
	border: 1px solid #550000;
	background-color: #330000;
}
.sorthelper
{
	list-style: none;
	border: 1px dotted #ccc;
}
.serializer
{
	clear: both;
	margin: 20px 0;
}
.serializer a
{
	color: #33f;
}
.serializer a:hover
{
	color: #FF6600;
}

</style>

</head>
<body>

<table id="top" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<a href="/" id="bluebar"><img src="/images/logo.jpg"  border="0"></a>
		</td>
		<td id="navigation">
<ul>
	<li class="limenu"><a href="/ankieter/" id="bluebar">ankiety</a></li>
	<li class="limenu"><a href="/raport/" id="greenbar">raporty</a></li>		
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
