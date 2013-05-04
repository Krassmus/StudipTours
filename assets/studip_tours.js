STUDIP.tours = {
    start: function () {
        jQuery("#joyridetour")
            .appendTo("body")
            .joyride({
                'autoStart': true,
                'postRideCallback': function (completed) {
                    var script = location.href;
                    script = script.replace(STUDIP.ABSOLUTE_URI_STUDIP, "");
                    jQuery.ajax({
                        'url': STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/studiptours/skip",
                        'type': "post",
                        'data': {
                            'script': script
                        }
                    });
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