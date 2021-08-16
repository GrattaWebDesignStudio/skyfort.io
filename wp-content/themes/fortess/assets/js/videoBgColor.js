window.onload = function() {
    var vid = document.getElementById('video');

    if ( vid ) {

        vid.play();

        var wrapper = document.querySelector('body');
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        //var ratio = window.devicePixelRatio || 1;
        var vidWidth;
        var vidHeight;

        vid.addEventListener('loadeddata', changeBgColor); 

        if (vid.readyState >= 0) {
          changeBgColor();
        }

        function changeBgColor() {
            vidWidth = vid.videoWidth;
            vidHeight = vid.videoHeight;

            canvas.width = vid.offsetWidth;
            canvas.height = vid.offsetHeight;

            drawingLoop();

            setTimeout( function() {
                setVideoBgColor(vid, wrapper);
            }, 300);
        };

        function drawingLoop(){
          requestId = window.requestAnimationFrame(drawingLoop)

          ctx.drawImage(vid, 0, 0, vidWidth, vidHeight, // source rectangle
                           0, 0, canvas.width, canvas.height); // destination rectangle);
        }

        function setVideoBgColor(vid, backgroundElement) {
            // draw first four pixel of video to a canvas
            // then get pixel color from that canvas
            var canvas = document.createElement("canvas");
            canvas.width = 8;
            canvas.height = 8;

           
                var ctx = canvas.getContext("2d");
                ctx.drawImage(vid, 0, 0, 8, 8);

                var p = ctx.getImageData(0, 0, 8, 8).data;
                backgroundElement.style.backgroundColor = "rgb(" + p[60] + "," + p[61] + "," + p[62] + ")";
                document.querySelector('.section-intro__animate').classList.add('is-show');
            //alert(backgroundElement.style.backgroundColor);
        }


        // window.onresize = function(event) {
        //     vidWidth = vid.videoWidth;
        //     vidHeight = vid.videoHeight;

        //     canvas.width = vid.offsetWidth;
        //     canvas.height = vid.offsetHeight;

        //     //redraw canvas after resize
        //     ctx.drawImage(vid, 0, 0, vidWidth, vidHeight, // source rectangle
        //                    0, 0, canvas.width, canvas.height); // destination rectangle);
        // };
    }

}