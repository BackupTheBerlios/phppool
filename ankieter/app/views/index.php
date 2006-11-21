<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ankieter</title>
<link rel="stylesheet" href="/styles/style.css" type="text/css">
<link rel="stylesheet" href="/styles/tabs.css" type="text/css" media="print, projection, screen" />
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="/styles/tabs-ie.css" type="text/css" media="projection, screen" />
<![endif]-->
<script type="text/javascript" src="/scripts/jquery.js"></script>
<script type="text/javascript" src="/scripts/jquery.tabs.js"></script>
<script type='text/javascript' src='/scripts/jquery.editable.js'></script>
<script type="text/javascript" src="/scripts/index_pagespecific.js"></script>
<style type="text/css" media="screen, projection">
            /* just to make this demo look a bit better */
            * {
                margin: 0;
                padding: 0;
            }
            
           
           
            
            h3 {
                 font-size: 12px;
                margin: 0 0 1em;
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
            p, pre {
                margin: 1em 0 0;
            }
            code {
                font-family: "Courier New", Courier, monospace;
            }
            div {
                margin:  0 0;
              
            }
            div div {
                margin: 0;
                width: auto;
            }
            #container-9 div {
                border: 1px solid #eaeaea;
                background: transparent;
            }
            #container-9 div div {
                border: 0;
            }
            #tested {
                height: 300px;
            }
            #container-2{
            	margin-top:10px;
            }
        </style>
</head>
<body>

<table id="top" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<a href="/"><img src="/images/logo.jpg" border="0"></a>
		</td>
		<td id="navigation">
<ul>
	<li><a href="/respondent/dodaj/" id="bluebar">dodaj swój email</a></li>
	<li><a href="/ankieta/wypelnij/" id="greenbar">wypełnij ankiete</a></li>		
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
