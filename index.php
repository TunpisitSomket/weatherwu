<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>

    <div class="container mt-5 ">

        <div class="content">

            <div class="col-sm-10">
                <input class="form-control" id="lat" value="10.328147" style="width: 400px; ">
            </div>

            <div class="col-sm-10">
                <input class="form-control" id="lon" value="99.112491" style="width: 400px; ">
            </div>

            <div class="d-grid gap-2 ">
                <button class="btn btn-success" style="width: 400px" id="loadbutt" type="button"> Load </button>
            </div>

            <div class="card mt-3" id="cardset" style="width: 25rem; height: 40rem ">
                <div class="card-body">
                    <img id="home" style="width: 22.7rem; height: 14.5rem"
                        src="https://lh3.googleusercontent.com/proxy/VAc7qI4fw_FyWfNWT5VCUN7Lj79GuMOQR2qcqRQRxRCEGGE2kMm-LQggiyevfHIMC84VQ4BplRzESWA-waV4eWOKXCgC8eI77DMQzJCS41Yqslxor6T4dJ6mESs82nGoP8hpea_8"
                        alt="">
                </div>
            </div>

        </div>
    </div>
    </div>

</body>

<script>
    var lat = 10.328147
    var lon = 99.112491
    pulljson(lat, lon);
    function pulljson(lat, lon) {
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + lon + "&appid=44f67de03e8cffe8f31fcd91dd5a54d3"
        $.getJSON(url)
            .done((data) => {
                console.log(data);
                let temkel_data = data.main.temp;
                var temcel = temkel_data - 273;
                let presenttime = new Date();
                var atthemoment = presenttime.toLocaleString();
                let whensunshines = data.sys.sunrise;
                var sunshines = new Date(whensunshines * 1000);
                var sunshines_h = sunshines.getHours();
                var sunshines_m = "0" + sunshines.getMinutes();
                var sunshines_s = "0" + sunshines.getSeconds();
                var showsunshines = sunshines_h + ':' + sunshines_m.substr(-2) + ':' + sunshines_s.substr(-2);
                let whensundown = data.sys.sunset;
                var sundown = new Date(whensundown * 1000);
                var sundown_h = sundown.getHours();
                var sundown_m = "0" + sundown.getMinutes();
                var sundown_s = "0" + sundown.getSeconds();
                var showsundown = sundown_h + ':' + sundown_m.substr(-2) + ':' + sundown_s.substr(-2);
                var line = "<div class='card-body' id='showinfo'>"
                line += "<h4 >" + data.name + "<h4>"
                line += "<p> อุณหภูมิ" + temcel.toFixed(2) + " เซนเซียส </p>"
                line += "<p>ความชื้นสัมพัทธ์ " + data.main.humidity + " % </p>"
                line += "<p>ดวงอาทิตย์ขึ้นเวลา" + showsunshines + " </p>"
                line += "<p>ดวงอาทิตย์ตกเวลา" + showsundown + " </p>"
                line += "<p>ณ วันที่" + atthemoment + "เวลา" + presenttime + "</p>"
                line += "</div>"
                $("#cardset").append(line);

            })

            .fail((xhr, err, statu) => {
            })
    }

    $("#loadbutt").click(() => {
        $("#showinfo").remove();
        var lat = parseFloat($("#lat").val());
        var lon = parseFloat($("#lon").val());
        pulljson(lat, lon);
    });

</script>

</html>
