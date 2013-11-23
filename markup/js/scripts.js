$(document).ready(function()
{
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
            pauseOnHover:  1,
            pagesBar: '#home-slider-paging',
            activatePageOn: 'click',
            pageBuilder:
                function(index)
                {
                    return '<li>' + (index + 1) + '</li>';
                }
        });
    homeSlider.on('active', function(eventName, index)
        {
            $homeSliderTexts.fadeOut(800);
            $($homeSliderTexts[index]).fadeIn(1000);
        }
    );
    homeSlider.init();

    var $hovers = $('.hover-effect');
    var $hoverBlock = $('<div class="hover-block"><span>Meer informatie</span></div>').hide();
    $hovers.each(function(index, $hoverEl)
    {
        $($hoverEl).on('mouseenter', function(e)
        {
           $(this).css('position', 'relative');
           var $hoverBlockClone = $hoverBlock.clone();
           $(this).append($hoverBlockClone);
           $hoverBlockClone.fadeIn();
        });
        $($hoverEl).on('mouseleave', function(e)
        {

            var $thisHoverBlock = $(this).find('.hover-block');
            $thisHoverBlock.stop();
            $thisHoverBlock.fadeOut(400, function()
            {
                $thisHoverBlock.remove();
            });
        });
    });
});
