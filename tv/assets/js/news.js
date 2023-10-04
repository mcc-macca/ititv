console.log(
  "ITITV:: Frontend -> Bovina:-:Marinelli ++ Backend -> Macca Computer;"
);

$(document).ready(function () {
  // data ora nel titolo
  function aggiornaDataOra() {
    var dataOraElement = document.getElementById("titolo");
    if (dataOraElement) {
      var dataOra = new Date();
      var dd = String(dataOra.getDate()).padStart(2, "0");
      var mm = String(dataOra.getMonth() + 1).padStart(2, "0");
      var yyyy = dataOra.getFullYear();
      var hh = String(dataOra.getHours()).padStart(2, "0");
      var min = String(dataOra.getMinutes()).padStart(2, "0");
      var ss = String(dataOra.getSeconds()).padStart(2, "0");

      var dataOraString =
        "COMUNICAZIONI<br>" +
        dd +
        "/" +
        mm +
        "/" +
        yyyy +
        " - " +
        hh +
        ":" +
        min +
        ":" +
        ss;

      dataOraElement.innerHTML = dataOraString;
    }
  }
  aggiornaDataOra();
  setInterval(aggiornaDataOra, 1000);

  // notizie
  var idfirst = document.getElementById("id1");
  var titolofirst = document.getElementById("titolo1");
  var contenutofirst = document.getElementById("cont1");

  var idsecond = document.getElementById("id2");
  var titolosecond = document.getElementById("titolo2");
  var contenutosecond = document.getElementById("cont2");

  var idthird = document.getElementById("id3");
  var titolothird = document.getElementById("titolo3");
  var contenutothird = document.getElementById("cont3");

  var defaultDetails = "Nessun Contenuto da mostrare";

  $.ajax({
    type: "GET",
    url: "xnews.php",
    dataType: "json",
    success: function (data) {
      if (data[0]) {
        idfirst.textContent = data[0].id || "001";
        titolofirst.textContent = data[0].PostTitle || "Ultima notizia";
        contenutofirst.innerHTML = data[0].PostDetails || defaultDetails;
      } else {
        idfirst.textContent = "001";
        titolofirst.textContent = "Ultima notizia";
        contenutofirst.textContent = defaultDetails;
      }

      if (data[1]) {
        idsecond.textContent = data[1].id || "002";
        titolosecond.textContent = data[1].PostTitle || "Penultima notizia";
        contenutosecond.innerHTML = data[1].PostDetails || defaultDetails;
      } else {
        idsecond.textContent = "002";
        titolosecond.textContent = "Penultima notizia";
        contenutosecond.textContent = defaultDetails;
      }

      if (data[2]) {
        idthird.textContent = data[2].id || "003";
        titolothird.textContent = data[2].PostTitle || "Terzultima notizia";
        contenutothird.innerHTML = data[2].PostDetails || defaultDetails;
      } else {
        idthird.textContent = "003";
        titolothird.textContent = "Terzultima notizia";
        contenutothird.textContent = defaultDetails;
      }
    },
    error: function (error, xhr) {
      console.log("%cErrore: %c " + error, "color: red", "color: white");
    },
  });

  var livenews = document.getElementById("news");

  var ultimoTesto = "";

                function aggiornaLiveNews() {
                    $.ajax({
                        type: "GET",
                        url: "xlive.php",
                        dataType: "json",
                        success: function(data) {
                            if (data[0]) {
                                var nuovoTesto = data[0].newsDetails || "Nessuna livenews da mostrare";

                                if (nuovoTesto !== ultimoTesto) {
                                    livenews.textContent = nuovoTesto;
                                    $("#news").marquee({
                                        delayBeforeStart: 10,
                                        allowCss3Support: true,
                                        duplicated: true,
                                        pauseOnCycle: false,
                                        pauseOnHover: false,
                                        startVisible: true,
                                        gap: 1500
                                    });

                                    ultimoTesto = nuovoTesto;
                                }
                            } else {
                                livenews.textContent = "Nessuna live news da mostrare";
                                $("#news").marquee({
                                    delayBeforeStart: 10,
                                    allowCss3Support: true,
                                    duplicated: true,
                                    pauseOnCycle: false,
                                    pauseOnHover: false,
                                    startVisible: true,
                                    gap: 1500
                                });
                            }
                        }
                    });
                }

                // Esegui l'aggiornamento subito all'apertura della pagina
                aggiornaLiveNews();

                // Esegui l'aggiornamento ogni secondo (1000 millisecondi)
                setInterval(aggiornaLiveNews, 1000);
});
