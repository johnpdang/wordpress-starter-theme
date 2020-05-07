import "babel-polyfill";
import locomotiveScroll from 'locomotive-scroll';

import slider from './components/slider';
import modal from './components/modal';

function id(v){ return document.getElementById(v); }

// used for window resize/scroll functions to reduce function calls
function debouncer(func, timeout) {
    var timeoutID, timeout = timeout || 20;
    return function () {
        var scope = this, args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function () {
            func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
    };
}

/*
 YOUTUBE VIDEO
 */
function onYouTubeIframeAPIReady() {
    // 1. This function creates an <iframe> (and YouTube player) //    after the API code downloads.
    var videoID = $('#player').attr('data-rel');
    if(videoID) {
        player = new YT.Player('player', {
            width: '1140',
          height: '641',
          videoId: videoID,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
            },
            playerVars: {
                'rel' : 0,
                'fs' : 0,
                'controls' : 1
            }
        });
    }
}
function onPlayerReady(event) {
    // 2. The API will call this function when the video player is ready.
    var playButton = document.getElementById("video__playbutton_1");
    var vid = document.getElementById('video__elem');
    vid.playbackRate = 0.625;
    playButton.addEventListener("click", function() {
        player.playVideo();
        $('.video__wrapper').addClass('video-active hide--loop');
    });
}
function onPlayerStateChange(event) {
    // 3. The API calls this function when the player's state changes.
    setTimeout(function(){
        if(event.data == 1 || event.data == 3) {
            $('.video__wrapper').addClass('video-active');
        } else {
            $('.video__wrapper').removeClass('video-active hide--loop');
        }
    }, 350);
}
function stopVideo() {
    // 4. This API will stop the video
    player.stopVideo();
}

// Object fit polyfill
objectFitImages();


// Use this file for all your js need
$(document).ready(() => {
    // bootstrap accordion
    $('.collapse').collapse({
        toggle: false
    });

    // Remove empty p tags automatically placed by wordpress editor
    $('.entry-content p').each(function(){
        var content = $(this).html();
        var content = content.replace(/\s+/g, '');
        if(!content){
            $(this).remove();
        }
    });

    // Set Divs to Equal Heights
    function equalHeights() {
        $('.equalHeightContainer').each(function(index, element) {
            var parent = element;
            var maxHeight = 0;
            $(parent).find('.equalHeightsMeasure').each(function(){
                var height = $(this).outerHeight();
                if(height > maxHeight){
                    maxHeight = height;
                }
            });

            // Set each height to the max height
            $(parent).find('.equalHeightsSet').height(maxHeight);
        });
    };
    equalHeights();

    // Smooth Scrolling links
    $('body').on('click', '.scroll-link', function(e){
      e.preventDefault();
      const target = $(this).attr('href');
      if($('body').find(target).length){
        const targetPos = $(target).offset().top - 30;
        $('html,body').animate({scrollTop: targetPos}, 800);
      }
    });

    // Resize iFrames
    //$('iframe').iFrameResize( { log:false, resizeFrom:'parent', bodyMargin:'20px 0', heightCalculationMethod: 'lowestElement' });

   	$( window ).resize( debouncer( function ( e ) {
   		equalHeights();
   	} ) );

    // Adjust screen position when accordions open
    $('.accordion__trigger').click(function(e){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            return;
        }
        const container = $(this).closest('.block__accordion__items');
        const currentParent = $(this).closest('.accordion__item');
        const scrollPaddingTop = 150;
        let active = container.find('.accordion__trigger.active');
        let currentIndex = currentParent.index();

        let scrollPosition;
        let activeParent
        let activeHeight;
        let activePadding;
        let activeIndex;

        // Check if there is an active element, and if so, get it's index
        if(active.length){
            activeParent = active.closest('.accordion__item');
            activeIndex = activeParent.index();
        }

        // Check if active element is above the current element
        if(activeIndex < currentIndex){
            activeHeight = activeParent.outerHeight();
            activePadding = activeHeight - activeParent.innerHeight();
            activeHeight = activeHeight - activePadding - activeParent.find('.accordion__header').outerHeight();
            scrollPosition = currentParent.offset().top - activeHeight - scrollPaddingTop;
        } else {
            scrollPosition = currentParent.offset().top - scrollPaddingTop;
        }

        $('html,body').animate({scrollTop: scrollPosition}, 800);

        active.removeClass('active');
        $(this).addClass('active');
    });
});


$(window).on('load', function() {

    const mainScroll = new locomotiveScroll({
        el: document.getElementById('page'),
    });
    mainScroll.on('call', (func) => {});

    // Update locomotiveScroll when UI elements change scroll positions
    const ui_elements = document.querySelectorAll('.accordion__trigger, .tab-links a, .nav-tabs a');
    for(var i = 0; i < ui_elements.length; i++) {
        let el = ui_elements[i];
        el.addEventListener('click', function(e){
            // Set timeout to ensure elements position has updated
            setTimeout(function(){
                mainScroll.update();
            },500);
        });
    };

});
