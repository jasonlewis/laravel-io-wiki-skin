$.fn.sticky = function()
{
    return this.each(function()
    {
        var element = $(this),
            stickyTop = $(this).offset().top - parseInt($(this).css('margin-top'));

        var checkStickyness = function()
        {
            var windowTop = $(window).scrollTop();

            if (stickyTop < windowTop)
            {
                element.css({ position: 'fixed', top: 0 });
            }
            else
            {
                element.css('position','static');
            }
        }

        $(window).scroll(checkStickyness);
        $(document).ready(checkStickyness);
    });
};