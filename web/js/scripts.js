$(document).ready(function () {
    $(".fancybox").fancybox({
        loop: false,
        openEffect	: 'elastic',
        closeEffect	: 'elastic',
        prevEffect		: 'fade',
        nextEffect		: 'fade',
        helpers		: {
            title	: { type : 'inside' }
        },
        afterLoad : function() {
            this.title = 'Afbeelding ' + (this.index + 1) + ' van ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
    });
    if ($('#home-slider').length) {
        var $homeSliderTexts = $('#home-slider-text .item');
        var homeSlider = new Sly($('#home-slider'),
            {
                horizontal: 1,
                itemNav: 'basic',
                smart: 1,
                mouseDragging: 0,
                touchDragging: 0,
                releaseSwing: 1,
                scrollBy: 0,
                speed: 1000,
                clickBar: 1,
                cycleBy: 'items',
                cycleInterval: 5000,
                pauseOnHover: 1,
                pagesBar: '#home-slider-paging',
                activatePageOn: 'click',
                pageBuilder: function (index) {
                    return '<li>' + (index + 1) + '</li>';
                }
            });
        homeSlider.on('active', function (eventName, index) {
                $homeSliderTexts.fadeOut(800);
                $($homeSliderTexts[index]).fadeIn(1000);
            }
        );
        homeSlider.init();
    }

    var $hovers = $('.hover-effect');
    var $hoverBlock = $('<div class="hover-block"><span></span></div>').hide();
    $hovers.each(function (index, $hoverEl) {
        $($hoverEl).on('mouseenter', function (e) {
            $(this).css('position', 'relative');
            var $hoverBlockClone = $hoverBlock.clone();
            $hoverBlockClone.find('span').text($(this).data('hover-text'));
            $(this).append($hoverBlockClone);
            $hoverBlockClone.fadeIn();
        });
        $($hoverEl).on('mouseleave', function (e) {

            var $thisHoverBlock = $(this).find('.hover-block');
            $thisHoverBlock.stop();
            $thisHoverBlock.fadeOut(400, function () {
                $thisHoverBlock.remove();
            });
        });
    });
    var $mediaGallery = $('.media-gallery');
    var $bigImg = $mediaGallery.find('.big-img img');
    if ($mediaGallery.length) {
        $mediaGallery.find('.thumbs img').mouseover(function (e) {
            e.preventDefault();
            $bigImg.attr('src', $(this).data('src'));
        });
    }
});
