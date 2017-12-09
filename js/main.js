// Design by Arthur Systems 2017
$(function(){
    var wasFeed = false;
    
    $('.carousel').carousel({
        interval: 2000
    });
    
    /* Menu scrolling*/
    $(".top-menu ul li a").on("click", function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr("href")).offset().top - 75
        }, 500);
    });
    
    /* Add rate*/
    $(".add_rate").on("click", function(e) {
       e.preventDefault();
       $(".feedba").load(base_url + "add_rate").fadeOut(0).fadeIn(250);
    });
    
    /* Add rate form ajax*/
    $(document).on("submit", ".addrate-form", function(e) {
       e.preventDefault();
       $.post(base_url + "page/add_rate_ajax", $(this).serialize(), function(data) {
           if(data=="true")
           {
               $(".feedba").load(base_url + "page/get_rates_ajax").fadeOut(0).fadeIn(250);
           }
           else
           {
               $(".errors").html(data);
           }
       });
    });
    
    /* Return to all rates*/
    $(document).on("click", ".return_to_rates", function(e) {
        e.preventDefault();
        $(".feedba").load(base_url + "page/get_rates_ajax", function() {
            $(".feedba").find(".clientfeedback").css("opacity", "0");
        });
    });
    
	/* Window scrolling  background*/
	$(window).scroll(function(){
		var y = $(this).scrollTop();
		if($(window).width() < 414){
			if(y >= 2000){
				$('.centerblock').css({
					'backgroundPosition' : 'center ' + (0 - y) * 0.1 + 'px'
				}, 200);
			}
		} else {
			if(y >= 750){
				$('.centerblock').css({
					'backgroundPosition' : 'center ' + (0 - y) * 0.3 + 'px'
				}, 200);
			}
		}
        if(y >= 600) {
            $(".services-blocks li div img:nth-child(1)").addClass('animated flipInX');
            $(".services-blocks li div img:nth-child(2)").addClass('animated flipInY');
            $(".services-blocks li div img:nth-child(3)").addClass('animated rotateInDownLeft');
            $(".services-blocks li div img:nth-child(4)").addClass('animated rotateInDownRight');
        }
        if(y >= 1350) {
            wasFeed = true;
            $(".feedba .clientfeedback:even").addClass('animated rotateInUpLeft');
            $(".feedba .clientfeedback:odd").addClass('animated rotateInUpRight');
        } else if(!wasFeed) {
            $(".feedba .clientfeedback").css("opacity", "0");
        }
	});
    
    /* Range value update*/
    $(document).on("change", ".addrate-form input[type='range']", function() {
        $(".addrate-form .myscore span").text($(this).val()/2);
    });
});