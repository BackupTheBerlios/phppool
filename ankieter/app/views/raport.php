<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Raporty</title>
	<link rel="stylesheet" href="/styles/style.css" type="text/css">
	<meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
  	<link rel="stylesheet" href="/styles/tabs.css" type="text/css" media="print, projection, screen" />
        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <link rel="stylesheet" href="/styles/tabs-ie.css" type="text/css" media="projection, screen" />
        <![endif]-->
        <style type="text/css" media="screen, projection">
            /* just to make this demo look a bit better */

            h2 {
                margin: 2em 0 1em;
                
            }
            h3 {
                margin: 0 0 1em;
                 font-size: 14px;
            }
            ul {
                list-style: none;
            }
            body>ul>li {
                display: inline;
            }
            body>ul>li:before {
                content: ", ";
            }
            body>ul>li:first-child:before {
                content: "";
            }
            
            .fragment {
            	  background: #FFFFFF;
            	  border: 1px solid #AAAAAA;
            }
            .anchors {
            	background:#aaaaaa;
            }
            code {
                font-family: "Courier New", Courier, monospace;
            }
            
            #container-1, #container-2{
            	
            	margin-top:10px;
            
            }
            
            
            #main_box{
            	margin:20px auto;
            	width:1070px;
            }

        </style>
        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <style type="text/css" media="screen, projection">
            body {
                font-size: 100%; /* resizable fonts */
            }
        </style>
        <![endif]-->

        <script src="/scripts/jquery.js" type="text/javascript"></script>
        <script src="/scripts/jquery.tabs.js" type="text/javascript"></script>
        <script type="text/javascript" src="/scripts/index_pagespecific.js"></script>
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
</body>
</html>