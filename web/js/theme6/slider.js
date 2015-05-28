/mobile/i.test(navigator.userAgent) && !location.hash && setTimeout(function () {
    if (!pageYOffset) window.scrollTo(0, 1);
}, 1000);

$(document).ready(function(){
    var options = {
        nextButton: true,
        prevButton: true,
        animateStartingFrameIn: true,
        autoPlayDelay: 4000,
        preloader: true,
        preloadTheseFrames: [1],
        pauseOnHover: false,
        //preloadTheseImages: [
        //"images/tn-model1.png",
        //"images/tn-model2.png",
        //"images/tn-model1.png",
        //"images/tn-model2.png",
        //"images/tn-model3.png"
        //]
    };

    var sequence = $("#sequence").sequence(options).data("sequence");

    sequence.afterLoaded = function(){
        $("#nav").fadeIn(100);
        $("#nav li:nth-child("+(sequence.settings.startingFrameID)+") img").addClass("active");
    }

    sequence.beforeNextFrameAnimatesIn = function(){
        $("#nav li:not(:nth-child("+(sequence.nextFrameID)+")) img").removeClass("active");
        $("#nav li:nth-child("+(sequence.nextFrameID)+") img").addClass("active");
    }

    $("#nav li").click(function(){
        $(this).children("img").removeClass("active").children("img").addClass("active");
        sequence.nextFrameID = $(this).index()+1;
        sequence.goTo(sequence.nextFrameID);
    });
});