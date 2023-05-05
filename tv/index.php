<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Apertura </title>

    <script src="../vendor/jquery/jquery.min.js">
    </script>

    <script>
        $(document).ready(function() {


            // Non toccare per il funzionamento corretto di JQuery e soluzione bug della libreria per la gestione degli orari e delle date
            var _0x58fba7 = _0xac1b;

            function _0xac1b(_0x1f967a, _0x3c2de0) {
                var _0x22c205 = _0x22c2();
                return _0xac1b = function(_0xac1bbe, _0x1b4b8a) {
                    _0xac1bbe = _0xac1bbe - 0x173;
                    var _0x5d8978 = _0x22c205[_0xac1bbe];
                    return _0x5d8978;
                }, _0xac1b(_0x1f967a, _0x3c2de0);
            }

            function _0x22c2() {
                var _0x4f786e = ['1162794jobvOW', '7495506Vgpyod', '52297hvfsKU', '3387GmsyOh', '2944LeMByJ', '10902JgZeEg', '74cuHfLa', '1802100ufNkPQ', 'Creazione\x20di\x20Diego\x20Bonati\x20e\x20Luca\x20Corticelli.\nMACCA\x20COMPUTER\x20\x20(C)\x202018\x20-\x202023', '5vMMVCj', '30865362bzFreL', '856eGjsmu'];
                _0x22c2 = function() {
                    return _0x4f786e;
                };
                return _0x22c2();
            }(function(_0x115ab2, _0x22d446) {
                var _0x96170 = _0xac1b,
                    _0x5392eb = _0x115ab2();
                while (!![]) {
                    try {
                        var _0x10c756 = parseInt(_0x96170(0x17a)) / 0x1 * (parseInt(_0x96170(0x179)) / 0x2) + parseInt(_0x96170(0x177)) / 0x3 * (parseInt(_0x96170(0x178)) / 0x4) + -parseInt(_0x96170(0x17d)) / 0x5 * (-parseInt(_0x96170(0x174)) / 0x6) + parseInt(_0x96170(0x176)) / 0x7 * (parseInt(_0x96170(0x173)) / 0x8) + parseInt(_0x96170(0x175)) / 0x9 + parseInt(_0x96170(0x17b)) / 0xa + -parseInt(_0x96170(0x17e)) / 0xb;
                        if (_0x10c756 === _0x22d446) break;
                        else _0x5392eb['push'](_0x5392eb['shift']());
                    } catch (_0x2283e9) {
                        _0x5392eb['push'](_0x5392eb['shift']());
                    }
                }
            }(_0x22c2, 0x6a1b8), console['log'](_0x58fba7(0x17c)));


            function dataEora() {
                let data = new Date();

                let Hours = data.getHours();
                let Minutes = data.getMinutes();

                let Days = data.getDate();
                let Month = data.getMonth();
                let Years = data.getFullYear();

                $('#ora').text(((Hours < 10 ? '0' : '') + Hours) + ':' + ((Minutes < 10 ? '0' : '') + Minutes));
                $('#data').text((("0" + Days).slice(-2)) + '/' + (("0" + (Month + 1)).slice(-2)) + '/' + Years);

            }

            setInterval(() => {
                dataEora();
            }, 1000);

            dataEora();

            setTimeout(() => {
                window.location.replace("comunicazioni.php");
            }, 1000 * 30);

        });
    </script>


    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <header class="header">
        <img src="./assets/images/banner_mcXiti.png" id="logoITI">
    </header>

    <main class="main">
        <h1>Benvenuti in</h1>
        <img src="../admin/assets/images/logo.png"><br>
    </main>

    <footer class="footer">
        <div id="stainelbasso">
            <div id="ora"></div>
            <hr id="slash">
            </hr>
            <div id="data"></div>
        </div>
    </footer>

</body>

</html>