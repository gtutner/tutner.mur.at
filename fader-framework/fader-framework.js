var FaderFramework = {

    oldWinOnLoad: false,
    inits: new Array(),
    faders: new Object(),

    init: function (einstellungen) {
        var fader;

        if (this.inits) {
            this.inits[this.inits.length] = einstellungen;

        } else {
            fader = new this.Fader(einstellungen);

            if (fader != false && !this.faders[fader.id]) {
                this.faders[fader.id] = fader;
                window.setTimeout(function () {    fader.next(); }, fader.viewTime);
            }
        }
    },

    start: function () {
        this.oldWinOnLoad = window.onload;

        window.onload = function () {
            if (typeof(FaderFramework.oldWinOnLoad) == "function") {
                FaderFramework.oldWinOnLoad();
            }
            FaderFramework.onload();
        };
    },

    onload: function () {
        var i, fader, e = document.createElement("link");
        e.type = "text/css";
        e.rel = "stylesheet";
        e.href = "fader-framework/fader-framework.css";
        document.getElementsByTagName("head")[0].appendChild(e);

        fader = this.inits;
        delete this.inits;

        for (i = 0; i < fader.length; i++) {
            this.init(fader[i]);
        }
    },

    Fader: function (einstellungen) {
        if (!einstellungen.id || !document.getElementById(einstellungen.id)
            || FaderFramework.faders[einstellungen.id]
            || einstellungen.images.length < 2) {

            return new Boolean(false);
        }

        var i, original = document.getElementById(einstellungen.id);

        this.id = einstellungen.id;
        this.images = new Array();
        this.counter = false;

        this.element = document.createElement("span");
        this.element.className = "fader";
        original.parentNode.replaceChild(this.element, original);

        for (i = 0; i < einstellungen.images.length; i++) {
            this.images[i] = document.createElement("img");
            this.images[i].src = einstellungen.images[i];
            this.images[i].alt = "Bild";

            if (i == 0) {
                this.element.appendChild(this.images[i]);
            }
        }

        this.fade = function (step) {
            var fader = this, imgs = this.element.getElementsByTagName("img");

            step = (!step) ? 0 : step;

            imgs[1].style.opacity = step/100;
            imgs[1].style.filter = "alpha(opacity=" + step + ")"; // IE?

            step = step + 2;

            if (step <= 100) {
                window.setTimeout(function () { fader.fade(step); }, 1);
            } else {
                imgs[1].className = "";
                this.element.removeChild(imgs[0]);
                window.setTimeout(function () { fader.next(); }, 7500);
            }
        };

        this.next = function () {
            this.counter = (this.counter < this.images.length -1) ? this.counter +1 : 0;

            this.element.appendChild(this.images[this.counter]);
            this.images[this.counter].className = "next";
            this.fade();
        };
    }
};

FaderFramework.start();