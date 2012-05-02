$(function() {

    $.ajax({
        type: "GET",
        url: "wp-content/plugins/jquery-accessible-slider/getTooltipTranslationAjax.php",
        dataType: "json",
        success: function(msg){
            //single slider
            $("#slider").slider({
                label : msg["tooltip"],
                unittext: "#",
                min: 0,
                max: 10,
                value: 0,
                slide: function(event, ui) {
                    updateSliderLabels(ui, ["#slider1Val"]);
                },
                change : function(event, ui) {
                    updateSliderLabels(ui, ["#slider1Val"]);
                }

            });

            updateSliderLabels({
                value : $("#slider").slider("value"),
                handle : $("#slider").find(".ui-slider-handle").eq(0)
            }, ["#slider1Val"]);
            updateSliderLabels({
                value : $("#slider").slider("value"),
                handle : $("#slider").find(".ui-slider-handle").eq(0)
            }, ["#slider1Val"]);
        }
    });

    function updateSliderLabels(ui, valueLabels) {
        if (!ui.values)
            ui.values = [ui.value];
        var pos = $('.ui-slider-handle').offset();
        var left = pos.left - 15;
        var top = pos.top - 15
        $('.sliderValue').css({
            "left": left + "px",
            "top": top + "px"
        });
        $('.sliderValue').text("#" + ui.value);
        $.ajax({
            type: "GET",
            url: "wp-content/plugins/jquery-accessible-slider/getRecentPostsAjax.php",
            data: "postsNum=" + ui.value,
            dataType: "json",
            success: function(msg){
                $('.areaBSlider').empty();
                $('.areaBSlider').removeAttr("style");
                $('.areaBSlider').append('<ul>' + msg["list"] + '</ul>');
            }
        });
    }
});
