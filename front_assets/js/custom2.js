  jQuery(document).ready(function( $ ) {
		"use strict";
	
	

	
	$(".accordion_example").smk_Accordion({
            showIcon: true, //boolean
            animation: true, //boolean
            closeAble: false, //boolean
            slideSpeed: 200 //integer, miliseconds
        });
	
	$(".accordion_example1").smk_Accordion();

			$(".accordion_example2").smk_Accordion({
				closeAble: true, //boolean
			});

			$(".accordion_example3").smk_Accordion({
				showIcon: false, //boolean
			});

			$(".accordion_example4").smk_Accordion({
				closeAble: true, //boolean
				closeOther: false, //boolean
			});

			$(".accordion_example5").smk_Accordion({closeAble: true});

			$(".accordion_example6").smk_Accordion();
			
			$(".accordion_example7").smk_Accordion({
				activeIndex: 2 //second section open
			});
			$(".accordion_example8, .accordion_example9").smk_Accordion();
	
    
    
 
            //toggle the component with class accordion_body
            $(".accordion_head").click(function () {
                if ($('.accordion_body').is(':visible')) {
                    $(".accordion_body").slideUp(300);
                    $(".plusminus").text('+');
                }
                if ($(this).next(".accordion_body").is(':visible')) {
                    $(this).next(".accordion_body").slideUp(300);
                    $(this).children(".plusminus").text('+');
                } else {
                    $(this).next(".accordion_body").slideDown(300);
                    $(this).children(".plusminus").text('-');
                }
            });

	
});