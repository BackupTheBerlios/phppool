<?php
 /*
 	* Created on 2006-11-01
 	* Name:	PlotQuestion.php
 	* Author:	Rafal Libik
 	* ����
 	* Projekt  wykres
 	* 
 	*/
	
	define("BASE", "../lib/jpgraph/src/");
	define("MAXCHARSPERLINE", 20);
		
	class PlotQuestion {
		private $question;
		private $amountOfAnswers;
		private $amountOfVariants=0;
		private $datax;
		private $datay;
		private $plotType;
		private $width;
		private $height;
		private $id_pytanie;
		
		
		
		
		public function PlotQuestion($question, $answers, $id_pytanie, $width=300,$height=200, $plotType='barVPlot',$amountOfAnswers=0) {
			$this->question=$question;
			$this->plotType=$plotType;
			$this->width=$width;
			$this->height=$height;
			$this->id_pytanie=$id_pytanie;
			foreach ($answers as $klucz=>$wartosc) {
				$this->datax[$this->amountOfVariants]=$klucz;
				$this->datay[$this->amountOfVariants++]=$wartosc;
			}
		}
		public function generatePlot() {
			if ($this->plotType=='barHPlot') 
				return $this->barHPlot($this->question,$this->datax,$this->datay,$this->width,$this->height);
			elseif ($this->plotType=='piePlot')
				return $this->piePlot($this->question,$this->datax,$this->datay,$this->width,$this->height);
			elseif ($this->plotType=='barVPlot') {
				$this->barVPlot($this->question,$this->datax,$this->datay,$this->width,$this->height);
				//header("Content-type: image/png");
				//ImagePng($im);
			}
		}
		private function barHPlot($question,$datax,$datay,$width,$height) {
			
			include_once (BASE . "jpgraph.php");
			include_once (BASE . "jpgraph_bar.php");
			
			
			$tFontSize=11;
			$xFontSize=6+($height/$this->amountOfVariants/30);
			
			
			$maxX=0;
			foreach ($datax as $x) 
				if (($t=strlen($x))>$maxX) $maxX=$t;
			
			for ($i=0;$i<$this->amountOfVariants;$i++) {
				$x=&$datax[$i];
				if (($t=strlen($x))>=MAXCHARSPERLINE) {
					$index=strrpos(substr($x,0,MAXCHARSPERLINE-1),' ');
					if ($index===false) $index=MAXCHARSPERLINE-3;
					$x[$index]="\n";
					if ($t>$index+MAXCHARSPERLINE) $x=substr($x,0,$index+MAXCHARSPERLINE-3)."...";
				}
			}
			unset($x);
					
			
			// Set the basic parame graph
			$graph = new Graph($width, $height, 'auto');
			$graph->SetScale("textlin",0,100);

			//if (amountOfVariants>5) $xFontSize--;
			$lm=0;
			foreach ($datax as $x) {
				$linia=strtok($x,"\n");
				while ($linia!='') {
					$t=new Text($linia);
					$t->SetFont(FF_COMIC, FS_NORMAL, $xFontSize);$lineWidth=$t->GetWidth($graph->img);
					if ($lineWidth>$lm) $lm=$lineWidth;
					//echo $linia.$lineWidth."<BR>";
					$linia=strtok("\n");
				}
			}
				
			
			// Rotate graph 90 degrees and set margin
			$graph->Set90AndMargin($lm+10, 20, 40, 30);
			
			// Set white margin color
			$graph->SetMarginColor('gray@0.95');
			
			// Setup title
			$graph->title->Set($question);
			$graph->title->SetMargin(10);
			$graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize);
			
			$tWidth=$graph->title->GetWidth($graph->img);
			//if ($graph->title->GetWidth($graph->img)>$width) $graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize-2); 
			if ($tWidth>$width) {
					$index=strrpos(substr($question,0,($len=strlen($question))/2+5),' ');
					//echo $index;
					if ($index===false) $index=$len/2-3;
					$question[$index]="\n";
					$graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize-=2);
					$graph->title->Set($question);
				}
			//$graph->subtitle->Set("(Non optimized)");
			
			// Setup X-axis
			$graph->xaxis->SetFont(FF_COMIC, FS_NORMAL, $xFontSize);
			$graph->xaxis->SetTickLabels($datax);
			$graph->xaxis->SetColor('black');
			
			// Some extra margin looks nicer
			$graph->xaxis->SetLabelMargin(10);
			
			// Label align for X-axis
			$graph->xaxis->SetLabelAlign('right', 'center');
			
			// Add some grace to y-axis so the bars doesn't go
			// all the way to the end of the plot area
			//$graph->yaxis->scale->SetGrace(5);
			$graph->yaxis->SetPos('max');
			$graph->yaxis->SetLabelAlign('center', 'top');
			$graph->yaxis->SetLabelSide('SIDE_RIGHT');
			$graph->yaxis->SetLabelFormat('%2d%%');
			
			// Now create a bar pot
			$bplot = new BarPlot($datay);
			
			$bplot->SetWidth(0.4);
			
			// We want to display the value of each bar at the top
			$bplot->value->Show();
			$bplot->value->SetFont(FF_VERDANA, FS_BOLD, $xFontSize-1);
			
			//$bplot->SetShadow("black@0.1",2,2);
			$bplot->value->SetAlign('right','center');
			$bplot->value->SetColor("yellow");
			$bplot->value->SetFormat('%d%%');
			$bplot->value->HideZero();
			$bplot->SetValuePos('max');
			
			//$graph->SetMarginColor('green');
			
			
			// Box around plotarea
			$graph->SetBox();
			$graph->SetFrame();
			$graph->SetShadow();
			
			// Setup the X and Y grid
			$graph->ygrid->SetFill(true, '#DDDDDD@0.5', '#BBBBBB@0.5');
			$graph->ygrid->SetLineStyle('dashed');
			$graph->ygrid->SetColor('gray');
			$graph->xgrid->Show();
			$graph->xgrid->SetLineStyle('dashed');
			$graph->xgrid->SetColor('gray');
			
			
			$fcol = '#440000';
			$tcol = '#FF9090';
			
			$bplot->SetFillGradient($fcol, $tcol, GRAD_LEFT_REFLECTION);
			
			// Set line weigth to 0 so that there are no border
			// around each bar
			$bplot->SetWeight(0);
			$graph->Add($bplot);
			
			// .. and stroke the graph
			return $graph->Stroke("images/raporty/{$this->id_pytanie}H.png");		
		}
		
		private function piePlot($question,$datax,$datay,$width,$height) {
			
			include_once (BASE."jpgraph.php");
			include_once (BASE."jpgraph_pie.php");
			include_once (BASE."jpgraph_pie3d.php");
			
			
			// Create the Pie Graph.
			$graph = new PieGraph($width,$height,"auto");
			$graph->SetShadow();
			
			// Set A title for the plot
			$tFontSize=14;
			$graph->title->Set($question);
			$graph->title->SetFont(FF_VERDANA,FS_BOLD,$tFontSize); 
			$graph->title->SetColor("darkblue");
			$graph->SetAntiAliasing(true);
			$graph->legend->SetPos(0.02,0.95,'right','bottom');
			$graph->legend->SetMarkAbsSize(5);
			$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
			
			$tWidth=$graph->title->GetWidth($graph->img);
			//if ($graph->title->GetWidth($graph->img)>$width) $graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize-2); 
			if ($tWidth>$width) {
					$index=strrpos(substr($question,0,($len=strlen($question))/2+5),' ');
					//echo $index;
					if ($index===false) $index=$len/2-3;
					$question[$index]="\n";
					$graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize-=2);
					$graph->title->Set($question);
				}
			
			// Create pie plot
			$pie = new PiePlot3d($datay);
			$pie->SetTheme("sand");
			$pie->SetCenter(0.5,0.4);
			$pie->SetSize(($t=($height*0.005/$this->amountOfVariants))>0.5?0.5:$t);
			$pie->SetAngle(30);
			$pie->ExplodeAll(5);
			$pie->value->SetFont(FF_ARIAL,FS_NORMAL,10);
			$pie->SetLegends($datax);
			
			$graph->Add($pie);
			return $graph->Stroke("images/raporty/{$this->id_pytanie}P.png");		

		}
		
		private function barVPlot($question,$datax,$datay,$width,$height) {
			include_once (BASE . "jpgraph.php");
			include_once (BASE . "jpgraph_bar.php");
			
			
			$tFontSize=11;
			$xFontSize=6+($height/$this->amountOfVariants/30);
			
			
			$maxX=0;
			foreach ($datax as $x) 
				if (($t=strlen($x))>$maxX) $maxX=$t;
			
			for ($i=0;$i<$this->amountOfVariants;$i++) {
				$x=&$datax[$i];
				if (($t=strlen($x))>=MAXCHARSPERLINE) {
					$index=strrpos(substr($x,0,MAXCHARSPERLINE-1),' ');
					if ($index===false) $index=MAXCHARSPERLINE-3;
					$x[$index]="\n";
					if ($t>$index+MAXCHARSPERLINE) $x=substr($x,0,$index+MAXCHARSPERLINE-3)."...";
				}
			}
			unset($x);
					
			
			// Set the basic parame graph
			$graph = new Graph($width, $height, 'auto');
			$graph->SetScale("textlin",0,100);

			//if (amountOfVariants>5) $xFontSize--;
			$lm=0;
			foreach ($datax as $x) {
				$linia=strtok($x,"\n");
				while ($linia!='') {
					$t=new Text($linia);
					$t->SetFont(FF_COMIC, FS_NORMAL, $xFontSize);$lineWidth=$t->GetWidth($graph->img);
					if ($lineWidth>$lm) $lm=$lineWidth;
					//echo $linia.$lineWidth."<BR>";
					$linia=strtok("\n");
				}
			}
				
			
			// Rotate graph 90 degrees and set margin
			$graph->SetMargin(35, 20, 40, $lm+15);
			
			// Set white margin color
			$graph->SetMarginColor('gray@0.95');
			
			// Setup title
			//$graph->title->Set($question);
			//$graph->title->SetMargin(10);
			//$graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize);
			
			$graph->tabtitle->Set($question);
			$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,$tFontSize);
			
			$tWidth=$graph->tabtitle->GetWidth($graph->img);
			//if ($graph->title->GetWidth($graph->img)>$width) $graph->title->SetFont(FF_VERDANA, FS_BOLD, $tFontSize-2); 
			if ($tWidth>$width) {
					$index=strrpos(substr($question,0,($len=strlen($question))/2+5),' ');
					//echo $index;
					if ($index===false) $index=$len/2-3;
					$question[$index]="\n";
					$graph->tabtitle->Set($question);
					$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,$tFontSize-=2);
				}
			
			// Setup X-axis
			$graph->xaxis->SetFont(FF_COMIC, FS_NORMAL, $xFontSize);
			$graph->xaxis->SetTickLabels($datax);
			$graph->xaxis->SetColor('black');
			$graph->xaxis->SetLabelAngle(80);
			
			// Some extra margin looks nicer
			$graph->xaxis->SetLabelMargin(10);
			
			// Label align for X-axis
			$graph->xaxis->SetLabelAlign('center', 'top');
			
			// Add some grace to y-axis so the bars doesn't go
			// all the way to the end of the plot area
			$graph->yaxis->scale->SetGrace(10);
			//$graph->yaxis->SetPos('max');
			//$graph->yaxis->SetLabelAlign('center', 'top');
			//$graph->yaxis->SetLabelSide('SIDE_RIGHT');
			$graph->yaxis->SetLabelFormat('%2d%%');
			
			// Now create a bar pot
			$bplot = new BarPlot($datay);
			
			$bplot->SetWidth(0.4);
			
			// We want to display the value of each bar at the top
			$bplot->value->Show();
			$bplot->value->SetFont(FF_VERDANA, FS_NORMAL, $xFontSize);
			
			//$bplot->SetShadow("black@0.1",2,2);
			//$bplot->value->SetAlign('left','center');
			$bplot->value->SetColor("black");
			$bplot->value->SetFormat('%d%%');
			//$bplot->SetValuePos('max');
			
			//$graph->SetMarginColor('green');
			
			
			// Box around plotarea
			$graph->SetBox();
			$graph->SetFrame(false);
		//	$graph->SetShadow();
			
			// Setup the X and Y grid
			$graph->ygrid->SetFill(true, '#DDDDDD@0.5', '#BBBBBB@0.5');
			$graph->ygrid->SetLineStyle('dashed');
			$graph->ygrid->SetColor('gray');
			$graph->xgrid->Show();
			$graph->xgrid->SetLineStyle('dashed');
			$graph->xgrid->SetColor('gray');
			
			
			$fcol = '#440000';
			$tcol = '#FF9090';
			
			$bplot->SetFillGradient($fcol, $tcol, GRAD_LEFT_REFLECTION);
			
			// Set line weigth to 0 so that there are no border
			// around each bar
			$bplot->SetWeight(0);
			$graph->Add($bplot);
			
			// .. and stroke the graph
			return $graph->Stroke("images/raporty/{$this->id_pytanie}V.png");			
			//header("Content-type: image/png");
			//ImagePng($im);
		}
	}
/*	
	
	$p=new PlotQuestion('Co tam Panie w polityce?',array('A no nic'=>13,'A dupa tam'=>27,'A bo ja wiem'=>56,
																											 'Leper pobil Giertycha'=>34));
																											 
	$p=new PlotQuestion('Co tam Panie w polityce?',array('A no nic'=>13,'A dupa tam'=>27,'A bo ja wiem'=>56,
																											 'Leper pobil Giertycha'=>34,
																						'A no panocku nic wam ino nie powiem no bo co tu mowic'=>23));

//	$p=new PlotQuestion('Co u was?',array('A nic'=>13,'Nie powiem'=>67),300,200);
	
	//$p=new PlotQuestion("Jakie s� wed�ug Ciebie stawki za dolara i jak one sie?",array('A nic'=>13,'Ne powiem'=>67,'Aaaaaa das sadsa dsa'=>23,'BBBB bbdas hjlkhkj'=>78,'Ffdsfass sd a sf as fsdf sd f'=>99,'Hhj j jsadasdf ks kas fklj'=>54),300,400);


	
	$p->generatePlot();
*/	
?>
