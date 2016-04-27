$(document).ready(function() {
    //globals
    gameLinkOuterWidth = 190;
    
    nav();
    carousel();
    htmlSafe();
    tsToggle();
    gameImgs();
    socialFeeds();
    jumpTo();

    $(window).resize(function() {
        gameImgs();
    });
    dlcToggle();
    setTimeout(function(){gameImgs()}, 1000)
});

function dlcToggle(){
    $(document).on('click', '.dlc-title', function(){
        var i = $(this).index();
        var s = 'selected';
        $('.dlc-title, .dlc-content').removeClass(s);

        $('.dlc-content:eq('+i+')').addClass(s);
        $(this).addClass(s);
    });
    $('.dlc-title:nth-child(1)').click();
    if($('.dlc-title').length == 0){
        $('#dlc').hide();
    }
}

function nav(){
    $(document).on('scroll', function() {
        if ($(document).scrollTop() > 78) {
            $('#jump-to').css({
                'position': 'fixed',
                'top': 0
            });
        } else {
            $('#jump-to').css({
                'position': 'relative'
            })
        }
    })
    $(document).on('click', '#nav-show-games a', function(){
       $('#games-nav').toggleClass('showing');
    });
    
    $('#game-link-icons > div').css({
        'width' :  ($('.game-link').length * gameLinkOuterWidth) + "px",
        'left' : 0
    });
    
    $('.game-scroll').hover(
        function () {
            var dir = '+';
            var amt = '=3px';
            if($(this).hasClass('gs-right')){
                dir = '-';
            }
            //Do whatever you want to any element when the mouse is on the div with id: div-id. If you want to change anything related to the div being hoved, use the $(this) selector.
            gsInterval = setInterval(function(){scrollNav(amt, dir);}, 1);
        },
        function () {
          //Do whatever you want to any element when the mouse was on the div with id: div-id and leaves it. If you want to change anything related to the div being hoved, use the $(this) selector.
            clearInterval(gsInterval);
            $('#game-link-icons > div').stop();
        }
    ); 
}
function scrollNav(amt, dir){
    var d = $('#game-link-icons > div');
    var max= getMaxGamesNavScroll();
    if((!max && dir == '-') || (dir == '+' && parseInt(d.css('left').replace('px', '')) > -2)){
        if(dir == '+'){
            d.css('left', 0);
        }
    }else{
        d.css({
            left:dir+amt
        });
    }
}
function getMaxGamesNavScroll(){
    var staticMenu = 220;//viewall + arrow controls
    var viewport = $(document).width();
    var left     = parseInt($('#game-link-icons > div').css('left').replace('px', ''));
    var menu     = parseInt($('#game-link-icons > div').css('width').replace('px', ''));
    var visibleArea = viewport - staticMenu;
    var remainingMenu = menu + left;
    return remainingMenu > visibleArea;
}
function jumpTo() {
    $(document).on('click', '.jt-container a', function() {
        var target = $(this).attr('href');
        var top = $(target).position().top - 37;
        $("html, body").animate({scrollTop: top + "px"});
    });
}

function socialFeeds() {
    setTimeout(function() {
        $('#twitter-widget-0').height('295');
        $('.fb_iframe_widget').removeAttr('style');
    }, 3000);
}

function htmlSafe() {
    var flag = 'html-parsed';
    $('.htmlsafe').each(function() {
        if (!$(this).hasClass(flag)) {
            $(this).html($(this).text());
            $(this).addClass(flag);
        }
    });
}

function gameImgs() {
    $('.game-thumb').each(function() {
        $(this).css('height', ($(this).width() * .65) + 'px');
    });
}

function tsToggle() {
    $(document).on('click', '.tsToggle', function() {
        if ($(this).hasClass('showing')) {
            $(this).parent('.card').find('.ts-topic').hide();
            var text = $(this).attr('data-text');
            $(this).text('Show ' + text);
            $(this).removeClass('showing');
        } else {
            $(this).parent('.card').find('.ts-topic').show();
            var text = $(this).attr('data-text');
            $(this).text('Hide ' + text);
            $(this).addClass('showing');
        }
        ;
    });
}
function carousel() {
//    $('.carousel-indicators li').each(function(){
//        var parent = $($(this).attr('data-target'));
//        var slide  = $(this).attr('data-slide-to');
//        var src    = parent.find('.item:eq('+slide+') img').attr('src');
//        $(this).css({
//            'background-image': 'url('+src+')',
//            'background-size' : '100%',
//            'background-position':'center center',
//            'background-repeat':'no-repeat'
//        });
//    });
}