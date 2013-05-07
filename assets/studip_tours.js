STUDIP.tours = {
    start: function (id, callback) {
        if (typeof id === "undefined") {
            id = "studip_tour";
        }
        jQuery("#" + id)
            .appendTo("body")
            .joyride({
                'autoStart': true,
                'postRideCallback': function (completed, tip) {
                    console.log(tip);
                    var index = jQuery(tip).attr("data-index");
                    var script = jQuery("#" + id).attr("data-tourname")
                        ? jQuery("#" + id).attr("data-tourname")
                        : location.href;
                    script = script.replace(STUDIP.ABSOLUTE_URI_STUDIP, "");
                    jQuery.ajax({
                        'url': STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/studiptours/skip",
                        'type': "post",
                        'data': {
                            'script': script
                        }
                    });
                    if (typeof callback === "function") {
                        callback(completed, index, script);
                    }
                }
            });
    }
};

jQuery(function() {
    jQuery("#barBottomright a[href='?#']").bind("click", function () {
        STUDIP.tours.start();
        return false;
    });
});