$(document).ready(function() {

	$.supersized({ slides  : [ {image : '../img/background.jpg', title : 'sky'} ] });

	var screenHeight = jQuery(window).height();
	var screenWidth = jQuery(window).width();
    var randomX = Math.floor((Math.random() * screenWidth) + 1);
    var randomX2 = Math.floor((Math.random() * screenWidth) + 1);

	$('.moving').css('top',(screenHeight/2)+"px")
	//$('#art').css('left',(screenWidth/2)+"px")

    $('.moving').animate({ width: +screenWidth+'px' }, 0);
    $('.moving').animate({ left: +randomX2/2+'px' }, 0);

    //$('.moving').rotate3Di(180, { duration: 2000, queue: false })

    $('.moving').rotate3Di('1080', 10000, {queue: false});

    //$('.moving').animate({transform: 'rotate(135deg)'}, { duration: 5000, queue: false });

    $('.moving').animate({ width: '1px'}, { duration: 5000, queue: false });
    $('.moving').animate({ top: '-10px'}, { duration: 10000, queue: false });
    $('.moving').animate({ left: +randomX2+"px"}, { duration: 10000, queue: false });
});