<head>
    <x-resources/>
</head>
<body>
    <div>
    <div id="demo"></div>
    <h1>HTML Geolocation</h1>
    <p>Click the button to get your coordinates.</p>

    <button onclick="getLocation()">Try It</button>
    <script>
        const x = document.getElementById("demo");

        function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        }

        function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
        }
    </script>
</div>
</body>
