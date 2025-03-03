<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FeedBack URL</title>
    <link rel="shortcut icon" href="./favicon.ico">
    <meta content="width=device-width" name="viewport">
    <meta name="theme-color" content="#00e5d2">
    <style>
        * {
            padding: 0;
            margin: 0
        }

        a {
            color: #009387;
            text-decoration: none
        }

        a:visited {
            color: #930087
        }

        body {
            margin: 1rem;
            font-family: sans-serif
        }

        main {
            max-width: 28rem;
            margin: 0 auto;
            position: relative
        }

        #controls {
            display: flex;
            margin-top: 2rem
        }

        button {
            flex-grow: 1;
            height: 2.5rem;
            min-width: 2rem;
            border: none;
            border-radius: .15rem;
            background: blue;
            margin-left: 2px;
            box-shadow: inset 0 -.15rem 0 rgba(0, 0, 0, .2);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center
        }

        button:focus,
        button:hover {
            outline: none;
            background: blue;
        }

        button::-moz-focus-inner {
            border: 0
        }

        button:active {
            box-shadow: inset 0 1px 0 rgba(0, 0, 0, .2);
            line-height: 3rem
        }

        button:disabled {
            pointer-events: none;
            background: #d3d3d3
        }

        button:first-child {
            margin-left: 0
        }

        button svg {
            transform: translateY(-.05rem);
            fill: #000;
            width: 1.4rem
        }

        button:active svg {
            transform: translateY(0)
        }

        button:disabled svg {
            fill: #9a9a9a
        }

        button text {
            fill: #00e5d2
        }

        button:focus text,
        button:hover text {
            fill: #00ffe9
        }

        button:disabled text {
            fill: #d3d3d3
        }

        #formats,
        #mode {
            margin-top: .5rem;
            font-size: 80%
        }

        #mode {
            float: right
        }

        #support {
            display: none;
            margin-top: 2rem;
            color: red;
            font-weight: 700
        }

        #list {
            margin-top: 1.6rem
        }

        audio {
            display: block;
            width: 100%;
            margin-top: .2rem
        }

        li {
            list-style: none;
            margin-bottom: 1rem
        }

        .popup-position {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            height: 100%;

            /* // The Modal Wrapper */
        }

        #popup-wrapper {
            text-align: left;
        }

        /* //The Modal Container */
        #popup-container {

            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 70px auto;
        }

        #closePopup {
            margin-left: 281px;
            margin-top: -18px;
        }
    </style>
</head>

<body>
    <a href="javascript:void(0)" onclick="toggle_visibility('contact-popup');">Open Popup</a>
    <div class="popup-position" id="contact-popup">
        <div class="popup-wrapper">
            <div id="popup-container">
                <h5>Feedback</h5>
                <p id="closePopup"><a href="javascript:void(0)" style="color: red;" title="Close" onclick="toggle_visibility('contact-popup');">X</a></p>
                <main>
                    <div id="controls">
                        <button id="record" disabled="" autocomplete="off" title="Record">
                            <svg viewBox="0 0 100 100" id="recordButton">
                                <circle cx="50" cy="50" r="46"></circle>
                            </svg>
                        </button>
                        <button id="pause" disabled="" autocomplete="off" title="Pause">
                            <svg viewBox="0 0 100 100">
                                <rect x="14" y="10" width="25" height="80"></rect>
                                <rect x="62" y="10" width="25" height="80"></rect>
                            </svg>
                        </button><button id="resume" disabled="" autocomplete="off" title="Resume">
                            <svg viewBox="0 0 100 100">
                                <polygon points="10,10 90,50 10,90"></polygon>
                            </svg>
                        </button><button id="stop" autocomplete="off" disabled="" title="Stop">
                            <svg viewBox="0 0 100 100">
                                <rect x="12" y="12" width="76" height="76"></rect>
                            </svg>
                        </button>
                    </div>
                    <div id="mode">
                        Native support,<a href="?polyfill">force polyfill</a>
                    </div>
                    <div id="formats"></div>
                    <div id="support">
                        Your browser doesn’t support MediaRecorder
                        So please use chrome or edge or mozilla
                    </div>
                    <ul id="list"></ul>
                    <form enctype="multipart/form-data"></form>
                    <input id="image-file" type="file" hidden />
                    <button type="button" id="formSubmit" onclick="sendto();">Submit</button>
                    </form>
                </main>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        (function() {
            var a, i, b, d, f, g, l = ["start", "stop", "pause", "resume"],
                m = ["audio/webm", "audio/ogg", "audio/wav"],
                j = 1024,
                k = 1 << 20;

            function n(e) {
                var r, $ = Math.abs(e);
                return $ >= k ? (r = "MB", e /= k) : $ >= j ? (r = "KB", e /= j) : r = "B", e.toFixed(0).replace(
                    /(?:\.0*|(\.[^0]+)0+)$/, "$1") + " " + r;
            }

            function e(e) {
                i.innerHTML = "", navigator.mediaDevices.getUserMedia({
                    audio: !0
                }).then(function(r) {
                    a = new MediaRecorder(r), l.forEach(function(e) {
                        a.addEventListener(e, t.bind(null, e));
                    }), a.addEventListener("dataavailable", s), "full" === e ? a.start() : a.start(1e3);
                }), b.blur(), setTimeout(myFunction, 16000);
            }

            function o() {
                a.stop(), a.stream.getTracks()[0].stop(), g.blur();
            }

            function p() {
                a.pause(), d.blur();
            }

            function q() {
                a.resume(), f.blur();
            }

            function s(e) {
                var r = document.createElement("li"),
                    $ = document.createElement("strong");
                $.innerText = "dataavailable: ", r.appendChild($);
                var a = document.createElement("span");
                a.innerText = e.data.type + ", " + n(e.data.size), r.appendChild(a), a.setAttribute("id", "span");
                var o = document.createElement("audio");
                o.controls = !0, o.src = URL.createObjectURL(e.data), o.setAttribute("id", "Audio"), r.appendChild(o), i
                    .appendChild(r);
            }

            function t(e) {

                var r = document.createElement("li");
                r.innerHTML = "<strong>" + e + ": </strong>" + a.state, "start" === e && (r.innerHTML += ", " + a
                        .mimeType), i.appendChild(r), "recording" === a.state ? (b.disabled = !0,
                        f.disabled = !0, d.disabled = !1, g.disabled = !1) : "paused" === a.state ? (b
                        .disabled = !0, f.disabled = !1, d.disabled = !0, g.disabled = !1) : "inactive" === a
                    .state && (b.disabled = !1, f.disabled = !0, d.disabled = !0, g
                        .disabled = !0);
            }
            i = document.getElementById("list"),
                b = document.getElementById("record"),
                f = document.getElementById("resume"),
                d = document.getElementById("pause"),
                g = document.getElementById("stop"),
                MediaRecorder.notSupported ? (i.style.display = "none",
                    document.getElementById("controls").style.display = "none",
                    document.getElementById("formats").style.display = "none",
                    document.getElementById("mode").style.display = "none",
                    document.getElementById("support").style.display = "block") : (document.getElementById("formats")
                    .innerText = "Format: " + m
                    .filter(function(e) {
                        return MediaRecorder.isTypeSupported(e);
                    }).join(", "), b.addEventListener("click", e.bind(null,
                        "full")), f.addEventListener("click", q), d.addEventListener("click", p),
                    g.addEventListener("click", o), b.disabled = !1);
        })();

        function myFunction() {
            document.getElementById("stop").click();
        }

        function toggle_visibility(id) {
            var element = document.getElementById(id);

            if (element.style.display == 'block')
                element.style.display = 'none';
            else
                element.style.display = 'block';
        }

        async function sendto() {
            var source = document.getElementById("Audio").src;

            $.ajax({
                type: 'POST',
                url: "audioUpload.php",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {}
            })


        }
    </script>

</body>

</html>
<script>
    const sendAudioFile = file => {
        const formData = new FormData();
        formData.append('audio-file', file);
        return fetch('https://perfumeara.com/webapp/audioUpload.php', {
            method: 'POST',
            body: formData
        });
    };

    navigator.mediaDevices.getUserMedia({
        audio: true
    }).then(stream => {
        // Collection for recorded data.
        let data = [];

        // Recorder instance using the stream.
        // Also set the stream as the src for the audio element.
        const recorder = new MediaRecorder(stream);
        audio.srcObject = stream;

        recorder.addEventListener('start', e => {
            // Empty the collection when starting recording.
            data.length = 0;
        });

        recorder.addEventListener('dataavailable', event => {
            // Push recorded data to collection.
            data.push(event.data);
        });

        // Create a Blob when recording has stopped.
        recorder.addEventListener('stop', () => {
            const blob = new Blob(data, {
                'type': 'audio/mp3'
            });
            sendAudioFile(blob);
        });

        // Start the recording.
        recorder.start();
    });
</script>