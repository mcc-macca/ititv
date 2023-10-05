<!DOCTYPE html>
<html>
    <head>
        <title>Comunicazioni</title>
        <link rel="stylesheet" href="./assets/css/news.css">
        <!-- Favicon -->
        <link rel="shortcut icon" href="./assets/image/FaviconITITV.ico" />
        <style>
            @font-face {
                font-family: 'Inter';
                src: url('assets/font/Inter/Inter-VariableFont_slnt,wght.ttf') format('truetype');
            }

            body{
                margin-top: 0;
                margin-left: 0;
                width: 1920px;
                height: 1080px;
                overflow: hidden;
                cursor: no-drop;
                background: #2c74b3;
            }
            /*HEADER*/
            #titolo{
                display: flex;
                width: 804px;
                height: 117px;
                flex-direction: column;
                justify-content: center;
                color: #FFF;
                text-align: center;
                text-shadow: -20px 0px 60px #7AB7FF;
                font-family: Inter;
                font-size: 90px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 32px;
                left: 573px;
            }
            /*MAIN*/
            .titolo{
                display: flex;
                width: 440.817px;
                height: 34.375px;
                flex-direction: column;
                justify-content: center;
                flex-shrink: 0;
                color: #FF1B1B;
                text-align: center;
                font-family: Inter;
                font-size: 70px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top:32.6px;
                left: 202px;
            }
            .ora1{
                display: flex;
                width: 665.186px;
                height: 34.375px;
                flex-direction: column;
                justify-content: center;
                flex-shrink: 0;
                color: #FFF;
                text-align: center;
                font-family: Inter;
                font-size: 53px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 104.32px;
                left: 89.84px;
            }
            .ora2{
                display: flex;
                width: 696.861px;
                height: 34.375px;
                flex-direction: column;
                justify-content: center;
                flex-shrink: 0;
                display: flex;
                width: 696.861px;
                height: 34.375px;
                flex-direction: column;
                justify-content: center;
                flex-shrink: 0;
                color: #FFF;
                text-align: center;
                font-family: Inter;
                font-size: 53px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 161.37px;
                left: 74px;
            }
            .chiuso{
                color: #F00;
                text-align: center;
                font-family: Inter;
                font-size: 53px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 220.05px;
                left: 262px;
            }
            .aperto{
                color: #00FF1A;
                text-align: center;
                font-family: Inter;
                font-size: 53px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 220.05px;
                left: 253px;
            }
            #ora{
                color: #FFF;
                text-align: center;
                font-family: Inter;
                font-size: 95px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 44px;
                left: 281px;
            }
            #data{
                color: #FFF;
                text-align: center;
                font-family: Inter;
                font-size: 95px;
                font-style: normal;
                font-weight: 735;
                line-height: normal;
                position: absolute;
                top: 159px;
                left: 143px;
            }
            #orario{
                width: 846px;
                height: 311px;
                background: #205295;
                filter:drop-shadow(20px 20px 60px #479CFF);
                position: absolute;
                border-radius: 3.125rem;
                top: 203px;
                left: 50px;
                z-index: 2;
            }
            #or1{
                width: 846px;
                height: 311px;
                background: #205295;
                filter: drop-shadow(20px 20px 60px #479CFF);
                position: absolute;
                border-radius: 3.125rem;
                top: 566px;
                left: 46px;
                z-index: 2;
            }
            #or2{
                width: 846px;
                height: 311px;
                background: #205295;
                filter: drop-shadow(20px 20px 60px #479CFF);
                position: absolute;
                border-radius: 3.125rem;
                top: 210px;
                left: 1034px;
                z-index: 2;
            }
            #or3{
                width: 846px;
                height: 311px;
                background: #205295;
                filter: drop-shadow(20px 20px 60px #479CFF);
                position: absolute;
                border-radius: 3.125rem;
                top: 566px;
                left: 1035px;
                z-index: 2;
            }
            /*FOOTER*/
            #test-rosso{
                display: flex;
                width: 242px;
                height: 132px;
                flex-direction: column;
                justify-content: center;
                flex-shrink: 0;
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
        </style>
    </head>
    <body>
        <!--HEADER-->
        <header>
            <img src="assets/image/logoiti.png" id="logoiti">
            <div id="titolo">ORARI</div>
        </header>
        <!--MAIN-->
        <main>
            <div id="orario">
                <div id="ora">23:59</div>
                <div id="data">39/10/2929</div>
            </div>
            <div id="or1">
                <div class="titolo">SEGRETERIA</div>
                <div class="ora1">Dalle 8:00 alle 9:00</div>
                <div class="ora2">Dalle 11:45 alle 13:45</div>
                <div class="aperto">-- APERTO --</div>
                <div class="chiuso">-- CHIUSO --</div>
            </div>
            <div id="or2">
                <div class="titolo">BIBLIOTECA</div>
                <div class="ora1">Dalle 8:00 alle 9:00</div>
                <div class="ora2">Dalle 11:45 alle 13:45</div>
                <div class="aperto">-- APERTO --</div>
                <div class="chiuso">-- CHIUSO --</div>
            </div>
            <div id="or3">
                <div class="titolo">PANINARO</div>
                <div class="ora1">Dalle 8:00 alle 9:00</div>
                <div class="ora2">Dalle 11:45 alle 13:45</div>
                <div class="aperto">-- APERTO --</div>
                <div class="chiuso">-- CHIUSO --</div>
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