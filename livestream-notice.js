if (typeof jQuery === 'undefined') {
    throw new Error('JavaScript requires jQuery')
}


(function (jQuery) {
    jQuery(document).ready(function (jQuery) {
        jQuery.notify = function (message, options) {
            var config = jQuery.extend({
                delay: 3000,
                type: "default",
                align: "center",
                verticalAlign: "top",
                blur: 0.2,
                close: false,
                background: "",
                color: "",
                class: "",
                animation: true,
                animationType: "drop",
                icon: "",
                buttons: [],
                buttonFunc: [],
                buttonAlign: "center",
                width: "600px"
            }, options);

            var animation = "";
            var buttons = "";
            var close = "";
            var closeClass = "";
            var icon = "";

            if (config.animation) { animation = config.animationType; }
            if (config.icon != "") { icon = "<i class='icon fa fa-" + config.icon + "'></i>"; }
            if (config.close || config.delay == 0) { close = "<button type='button' class='close' data-close='notify' data-animation='" + animation + "'; >×</button>"; closeClass = "notify-dismissible"; }
            /*if(config.buttons.length != 0){
                buttons = "<div class='notify-buttons "+config.buttonAlign+"'>";
                if(config.buttonFunc.length != 0){
                    if(typeof config.buttonFunc[0] != "undefined"){
                        buttons += "<button type='button' onclick='"+config.buttonFunc[0]+"()'>"+config.buttons[0]+"</button>";
                    }
                    if(typeof config.buttonFunc[1] != "undefined"){
                        buttons += "<button type='button' onclick='"+config.buttonFunc[1]+"()'>"+config.buttons[1]+"</button>";
                    }else{
                        if(typeof config.buttons[1] != "undefined"){ buttons += "<button type='button'>"+config.buttons[1]+"</button>"; }
                    }
                }else{
                    buttons += "<button type='button'>"+config.buttons[0]+"</button>";
                    if(typeof config.buttons[1] != "undefined"){ buttons += "<button type='button'>"+config.buttons[1]+"</button>"; }
                	
                }
                buttons += "</div>";
            }*/

            var jQueryelem = jQuery("<div data-animation='" + animation + "' class='notify " + config.align + " " + config.verticalAlign + " " + animation + " " + closeClass + "'><div class='message'>" + icon + message + "</div>" + buttons + close + "</div>");
            if (config.background != "") {
                jQueryelem.css("background", config.background);
            } else {
                if (config.class == "") {
                    jQueryelem.addClass("notify-" + config.type);
                } else {
                    jQueryelem.addClass(config.class);
                }
            }
            if (config.color != "") { jQueryelem.css("color", config.color); }
            if (animation == "drop") { jQuery("body").addClass("notify-open-drop"); }
            if (config.verticalAlign == "middle") {
                jQueryelem.css("visibility", "hidden");
                jQuery("body").append(jQueryelem);
                jQueryelem.css({ "margin-top": jQueryelem.innerHeight() / 2 * -1, "visibility": "visible" });
            } else {
                jQuery("body").append(jQueryelem);
            }

            if (config.animation) {
                setTimeout(function () {
                    jQueryelem.removeClass(animation);
                }, 100);
            }

            if (config.delay == 0) {
                var jQuerybackdrop = jQuery("<div class='notify-backdrop'></div>");
                jQuery("body").append(jQuerybackdrop).addClass("notify-open");
                setTimeout(function () {
                    jQuerybackdrop.css("opacity", config.blur);
                }, 100);
            } else {
                setTimeout(function () {
                    if (config.animation) {
                        jQueryelem.addClass(config.animationType);
                        setTimeout(function () {
                            if (config.animation == "drop") { jQuery("body").removeClass("notify-open-drop"); }
                            jQueryelem.remove();
                        }, 400);
                    } else {
                        jQueryelem.remove();
                    }
                }, config.delay);
            }
        }

        jQuery(document).on("click", ".notify-backdrop", function (e) {
            hide(jQuery(".notify"));
        });
        jQuery(document).on("click", ".notify-buttons > button", function (e) {
            hide(jQuery(this).parent().parent());
        });
        jQuery(document).on("click", "[data-close='notify']", function (e) {
            hide(jQuery(this).parent());
        });

        function hide(jQueryel) {
            jQuery("body").removeClass("notify-open");
            jQuery(".notify-backdrop").css("opacity", 0);
            if (jQueryel.data("animation") != "") {
                jQueryel.addClass(jQueryel.data("animation"));
                setTimeout(function () {
                    jQuery("body").removeClass("notify-open-drop");
                    jQuery(".notify-backdrop").remove();
                    jQueryel.remove();
                }, 400);
            } else {
                jQuery(".notify-backdrop").remove();
                jQueryel.remove();
            }
        }
        // Twitch Banner
        jQuery(document).ready(function livestreamNotice() {
            jQuery.getJSON('https://api.twitch.tv/kraken/streams/' + livestreamNoticeSettings.channelname + '?client_id=' + livestreamNoticeSettings.twitchclientid + '&callback=?', function (data) {
                if (data.stream) {
                    jQuery.notify(`<a href="https://www.twitch.tv/${livestreamNoticeSettings.channelname}">${livestreamNoticeSettings.noticemessage}<span></a>`, {
                        delay: 30000, class: 'livestreamNotice', align: "right", verticalAlign: "bottom", close: true
                    });
                }
            })
        });
    });
    console.log(livestreamNoticeSettings.noticemessage)
})(jQuery);
