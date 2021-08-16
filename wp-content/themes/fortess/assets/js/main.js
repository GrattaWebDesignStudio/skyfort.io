$(function() {
	$('.js-hamburger').on('click', function() {
		$(this).toggleClass('is-active');
		$('.mobile-menu').toggleClass('is-show');
		$('body').toggleClass('menu-show');
	});


	$('.js-go-sign').click(function(){
        var target = $(this).attr('href');
        $('html, body').animate({scrollTop:$(target).offset().top}, 800);
        return false;
    });


    //COLLAPSE
    $('.collapse__header').on('click', function() {
    	$(this).toggleClass('is-active').next().slideToggle(100);
    });



    var $notifications = $('.notification-elem');

    $('.notification-elem__btn').on('click', function() {
        var parentElem = $(this).parent();
        $notifications.not(parentElem).removeClass('is-active');
        $(this).parent().toggleClass('is-active');
    });


    // ************************************************************
    $('.js-add-field').on('click', function() {
        var newField = '<div class="form-group">' +
                            '<div class="form-group__item">' +
                                '<div class="form__label">Email address</div>' +
                                '<input type="email" placeholder="Enter a colleague\'s e-mail">' +
                            '</div>' +  
                        '</div>';
        $(newField).appendTo('.js-append');
    });


    //TABS
    //tabBodyHeight();

    //$(window).on('resize', tabBodyHeight);

    $('.tabs__list-item').on('click', function() {
        var dataName = '.' + $(this).attr('data-name');

        $('.tabs__list-item').removeClass('is-active');
        $('.media-box__item').removeClass('is-active');
        $(this).addClass('is-active');

        $('.tabs__content').removeClass('is-active');
        $(dataName).addClass('is-active');
    });

    // function tabBodyHeight() {
    //     var height = 0;
    //     $('.tabs__content').each(function() {
    //         var elemHeight = $(this).height();
    //         if ( elemHeight > height ) {
    //             height = elemHeight
    //         }
    //     });

    //     return $('.tabs__body').height(height);
    // }


    //MODAL
    $('.js-modal').on('click', function(e) {
        e.preventDefault();
        var hrefName = $(this).attr('href');
        $(hrefName).fadeIn(200);
        $('body').addClass('enabled');
    });
    $('.js-modal-close').on('click', modalHide);
    $('.modal-overlay').on('click', modalHide);

    function modalHide() {
        $('.modal').fadeOut(100);
        setTimeout( returnScrollBody, 100);  
    }
    function returnScrollBody() {
        $('body').removeClass('enabled');
    }

});