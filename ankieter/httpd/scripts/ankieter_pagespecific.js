$(document).ready(
	function () {
		$('ul').Sortable(
			{
				accept : 		'sortableitem',
				activeclass : 	'sortableactive',
				hoverclass : 	'sortablehover',
				helperclass : 	'sorthelper',
				opacity: 		0.8,
				/*fx:				200,*/
				revert:			true,
				tolerance:		'intersect',
				onStop:		serialize	
			}
		);
		
		
		$("input.buttonBslidedown").click(function(){ $("p.fourthparagraph:hidden").slideDown("slow"); });
		$("input.buttonBslideup").click(function(){ $("p.fourthparagraph:visible").slideUp("slow"); });
	}
);


	

