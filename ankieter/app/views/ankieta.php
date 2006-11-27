<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xml:lang="en" lang="en">
    <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />

        <title>Wypełniamy ankietę</title>

        <link rel="stylesheet" href="/styles/tabs.css" type="text/css" media="print, projection, screen" />
        <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
        <!--[if lte IE 7]>
        <link rel="stylesheet" href="/styles/tabs-ie.css" type="text/css" media="projection, screen" />
        <![endif]-->
        <style type="text/css" media="screen, projection">
            /* just to make this demo look a bit better */
            * {
                margin: 0;
                padding: 0;
            }
            body {
                padding: 10px;
                line-height: 1.4;
                font-size: 16px; /* @ EOMB */
            }
            body * {
                font-size: 87.5%;
                font-family: "Trebuchet MS", Trebuchet, Verdana, Helvetica, Arial, sans-serif;
            }
            body * * {
                font-size: 100%;
            }
            h1 {
                margin: 0 0 1em;
                font-size: 143%;
            }
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
            p, pre {
                margin: 1em 0 0;
            }
            code {
                font-family: "Courier New", Courier, monospace;
            }
            
            #container-1, #container-2{
            	
            	margin-top:10px;
            
            }
            
            
            #main_box{
            	margin:80px auto;
            	width:500px;
            }
            .answerBox{
            	margin-left:20px;
            }
            #send{
            	margin-left:50px;
            	margin-top:10px;
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
    <div id="main_box">    

        <h2><?php echo $this->pool->nazwa; ?></h2>
        <p><?php echo $this->pool->opis; ?></p>
<form action="/ankieta/pokaz/ankieta/1" method="post">        
<div id="container-1">	
<ul class="anchors">
	<li><a href="#section-0">Start</a></li>
	<?php
	
	$max = $this->questions->count();
	for($i=1;$i<=$max;$i++){
		echo '<li><a href=#section-'.$i.'>'.$i.'</a></li>';	
	}
	?>
	
</ul>	
<div id="section-0" class="fragment">
	<h3>Start</h3>
	<p>
		Numery wszystkich pytań umieszczone są na dole ekranu. Można się poruszać między nimi klikając na numer pytania bądź strzałki w przód oraz w tył. 
		Po odpowiedzi na ostanie pytanie prosimy nacisnąć przycisk Wyślij.
	</p>
	<p>
	</p>
</div>
		<?php
		$counter=1;
		
		foreach($this->questions as $row){
		?>
		<div id="section-<?php echo $counter;?>" class="fragment">
		<?php	
			echo '<h3>'.$row->pytanie.'</h3>'."\n\r";
			if($row->idTypOdpowiedzi==2){
					echo '<div class="answerBox">';
					echo '<input type=text name="'.$row->idPytanie.'">';
					echo '</div>'."\n\r";
			} else {
				foreach($this->variants[$row->idPytanie] as $nextRow){
					if ($row->idTypOdpowiedzi==0){
						echo '<div class="answerBox">'.$this->formRadio($row->idPytanie, null, null, array($nextRow->idWariantOdpowiedzi=>$nextRow->opis)).'</div>'."\n\r";
					} else if($row->idTypOdpowiedzi==1) {
						echo '<div class="answerBox">';
								echo '<input type=checkbox name="'.$row->idPytanie.'['.$nextRow->idWariantOdpowiedzi.']"  />'.$nextRow->opis;
						echo '</div>'."\n\r";
					
					} 
				}	
			}
			
			if($counter == $this->questions->count()) {
					 echo '<div id="send">'.$this->formSubmit('send','Wyślij').'</div>'."\n\r";   
				}
			$counter++;
		?>
		</div>
		<?php	
		}
	
		?>
</div>	

     
</form>
 
       
	</div>
    </body>
</html>