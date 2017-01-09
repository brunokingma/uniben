$(function() {
    var $videos = $("iframe[src*='player.vimeo.com'], iframe[src*='youtube.com'], object, embed"),
        $elemento_fluido = $("figure");

    $videos.each(function() {
        $(this).attr('data-aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');
    });
    $(window).resize(function() {
        var newWidth = $elemento_fluido.width();
        $videos.each(function() {
            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.attr('data-aspectRatio'));
        });
    }).resize();
});