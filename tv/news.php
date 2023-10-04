<!DOCTYPE html>
<html>

<head>
    <title>Comunicazioni</title>
    <link rel="stylesheet" href="./assets/css/news.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
    <style>
        /*pre-HEADER*/
        @font-face {
            font-family: 'Inter';
            src: url('./assets/font/Inter/Inter-VariableFont_slnt,wght.ttf') format('truetype');
        }

        body {
            margin-top: 0;
            margin-left: 0;
            width: 1920px;
            height: 1080px;
            overflow: hidden;
            cursor: no-drop;
            background: #2c74b3;
        }

        /*HEADER*/
        #titolo {
            color: #FFF;
            text-align: center;
            text-shadow: -20px 0px 60px #7AB7FF;
            font-family: Inter;
            font-size: 53px;
            font-style: normal;
            font-weight: 735;
            line-height: normal;
            display: flex;
            width: 804px;
            height: 117px;
            flex-direction: column;
            justify-content: center;
            flex-shrink: 0;
            position: absolute;
            top: 32px;
            left: 573px;
        }

        /*MAIN*/
        #com1 {
            width: 600px;
            height: 675px;
            flex-shrink: 0;
            border-radius: 50px;
            background: #205295;
            box-shadow: 20px 20px 60px 0px #479CFF;
            position: absolute;
            top: 196px;
            left: 24px;
        }

        #com2 {
            width: 600px;
            height: 675px;
            flex-shrink: 0;
            border-radius: 50px;
            background: #205295;
            box-shadow: 20px 20px 60px 0px #479CFF;
            position: absolute;
            top: 196px;
            left: 660px;
        }

        #com3 {
            width: 600px;
            height: 675px;
            flex-shrink: 0;
            border-radius: 50px;
            background: #205295;
            box-shadow: 20px 20px 60px 0px #479CFF;
            position: absolute;
            top: 196px;
            left: 1295px;
        }

        .head {
            width: 600px;
            height: 132px;
            flex-shrink: 0;
            border-radius: 50px 50px 0px 0px;
            background: #004996;
            box-shadow: 0px 20px 60px 0px #2C74B3;
        }

        .lin {
            width: 4px;
            height: 132px;
            flex-shrink: 0;
            background: #FFF;
            position: absolute;
            left: 154px;
        }

        .num {
            display: flex;
            width: 156px;
            height: 132px;
            flex-direction: column;
            flex-shrink: 0;
            justify-content: center;
            color: #FFF;
            text-align: center;
            font-family: Inter;
            font-size: 60px;
            font-style: normal;
            font-weight: 735;
            line-height: normal;
            position: absolute;
            left: 2px;
        }

        .title {
            display: flex;
            width: 440px;
            height: 123px;
            flex-direction: column;
            flex-shrink: 0;
            justify-content: center;
            color: #FFF;
            text-align: center;
            font-family: Inter;
            font-size: 35px;
            font-style: normal;
            font-weight: 735;
            line-height: normal;
            position: absolute;
            left: 158px;
        }

        .cont {
            display: flex;
            width: 552px;
            height: 440px;
            flex-direction: column;
            flex-shrink: 0;
            justify-content: center;
            color: #FFF;
            text-align: justify;
            font-family: Inter;
            font-size: 36px;
            font-style: normal;
            font-weight: 735;
            line-height: normal;
            max-width: 552px;
            position: absolute;
            top: 168px;
            left: 24px;
            z-index: 3;
        }

        /*FOOTER*/
        #test-rosso {
            display: flex;
            width: 242px;
            height: 132px;
            flex-direction: column;
            flex-shrink: 0;
            justify-content: center;
            color: #FFF;
            text-align: center;
            font-family: Inter;
            font-size: 53px;
            font-style: normal;
            font-weight: 735;
            line-height: normal;
            position: absolute;
            top: 16px;
            left: 46px;
        }

        #news {
            position: relative;
            float: left;
            width: 87.7%;
            color: white;
            display: inline;
            font-weight: bold;
        }
    </style>
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/news.js"></script>
</head>

<body>
    <!--HEADER-->
    <header>
        <img src="assets/image/logoiti.png" id="logoiti">
        <div id="titolo">COMUNICAZIONI</div>
    </header>
    <!--MAIN-->
    <main>
        <div id="com1">
            <div class="head">
                <div class="num" id="id1">999</div>
                <div class="lin"></div>
                <div class="title" id="titolo1">Distribuzione carta dello studente</div>
            </div>
            <div class="cont" id="cont1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque venenatis ipsum nec pulvinar venenatis. Morbi facilisis interdum mi ac imperdiet. Pellentesque eget rhoncus sapien. Nunc vitae diam eu nisl consequat iacu lis. Sed commodo gravida nunc quis dictum. Vivamus non iaculis velit. ciaoc siaoc soi. dic</div>
        </div>
        <div id="com2">
            <div class="head">
                <div class="num" id="id2">998</div>
                <div class="lin"></div>
                <div class="title" id="titolo2">COMUNICAZIONE 2</div>
            </div>
            <div class="cont" id="cont2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque venenatis ipsum nec pulvinar venenatis. Morbi facilisis interdum mi ac imperdiet. Pellentesque eget rhoncus sapien. Nunc vitae diam eu nisl consequat iacu lis. Sed commodo gravida nunc quis dictum. Vivamus non iaculis velit. ciaoc siaoc soi. dic</div>
        </div>
        <div id="com3">
            <div class="head">
                <div class="num" id="id3">997</div>
                <div class="lin" id=></div>
                <div class="title" id="titolo3">COMUNICAZIONE 3</div>
            </div>
            <div class="cont" id="cont3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque venenatis ipsum nec pulvinar venenatis. Morbi facilisis interdum mi ac imperdiet. Pellentesque eget rhoncus sapien. Nunc vitae diam eu nisl consequat iacu lis. Sed commodo gravida nunc quis dictum. Vivamus non iaculis velit. ciaoc siaoc soi. dic</div>
        </div>
    </main>
    <!--FOOTER-->
    <footer>
        <div id="quad-rosso"></div>
        <div id="test-rosso">LIVE NEWS</div>
        <div id="news">----- LIVE NEWS -- LIVE NEWS -- LIVE NEWS-----</div>
    </footer>
</body>

</html>