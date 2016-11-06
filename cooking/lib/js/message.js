(function ($) {
    $.fn.messageBox = function () {
        var $this = $(this);
        var $parent = $this.parent();
        var timeToHide = 2000;
        var hideOnClick = true;

        $this.css({
            "left" : "50%",
            "top" : "50%",
            "width": "350px",
            "padding": "15px",
            "border": "2px solid black",
            "background": "yellow",
            "text-align": "center",
            "font-size": "20px",
            "display": "none",
            "position": "fixed",
            "z-index" : "888",
            "box-shadow" : "10px 10px 5px -7px rgba(0,0,0,0.75)"
        });

        function loadCss() {
            if(event) {
                $this.css({
                    "background" : "yellow",
                    "color" : "black",
                    "left": event.pageX - 270,
                    "top": event.pageY - $(document).scrollTop() - 50
                });
            }

            $this.css({
                "background" : "#DEB887",
                "color" : "black"
            });

            $this.children('button').css({
                "width": "90px",
                "height": "30px",
                "margin": "20px 5px 0 5px",
                "background": "none",
                "border": "2px dashed black",
                "font-size": "18px",
                "border-radius": "10px",
                "text-align": "center",
                "cursor" : "pointer"
            });

            $this.children('button').hover(
                function () {
                    $(this).css('border', "2px solid black");
                }, function () {
                    $(this).css('border', "2px dashed black");
                });

            hideOnClick = false;
        }

        $this.click(function () {
            if(hideOnClick) {
                $this.slideUp();
            }
        });

        function error(message) {
            $this.css({"color": "white", 'background': "red"});
            $this.fadeIn(500);
            $this.text(message);
            hideMessage(timeToHide);
        }

        function success(message) {
            $this.css({"color": "snow", 'background': "#449A44"});
            $this.fadeIn(500);
            $this.text(message);
            hideMessage(timeToHide);
        }

        function warning(message, hide) {
            $this.css({"background" : "yellow", "color" : "black"});
            $this.fadeIn(500);
            $this.text(message);
            if (!hide) {
                hideMessage(timeToHide);
            }
        }

        function prompt(message, fnYes, fnNo, event) {
            $this.show();
            $this.text(message)
                .append($('<br /><button id="yesBut">Да</button>').click(fnYes))
                .append($('<button id="NoBut">Не</button>').click(function(){
                    fnNo();
                }));

            loadCss(event);
        }

        function hideMsg(){
            $this.hide();
        }

        function hideMessage(timeout) {
            setTimeout(function () {
                $this.fadeOut(2000);
            }, timeout);
        }

        return {
            error: error,
            success: success,
            warning: warning,
            prompt: prompt,
            hide : hideMsg
        };
    };
}(jQuery));