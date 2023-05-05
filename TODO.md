# ToDo itiTV

### Aprile 2023:

- [x] Cambiare stile
- [x] Sistemare aggiunta sub-admin
- [x] Sistemare portale accesso (SQL)
- [ ] Sistemare codice cambio password
- [x] Mettere il "Postato da: ?" con utenza multipla.
- [ ] nel file add-post.php, l'inserimento di immagini nel campo di testo funziona solo tramite URL.
- [ ] Aggiungere installer grafico per un php.ini (?) (versione definitiva in MCNS)
- [x] Inviare una mail durante l'aggiunta di un commento (usare phpmailer)
- [ ] Usare il sistema di password dimenticata con verifica email
- [x] Aggiungiere credenziali mail nel database
- [ ] Aggiungiere pagina gestione messaggi mail con la funzione.

### Maggio 2023:

###### Visualizzazione TV

- [x] Orari segreteria APERTO CHIUSO Js
- [x] Sistemare div in news.php
- [x] Auto aggiornamento news.php quando si pubblica una nuova notizia. [AJAX]
- [ ] Mettere a posto questo codice:

```js
$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: 'php/recupera_ultima_comunicazione.php',
            dataType: 'json',
            success: function(data) {
                if (data) {
                    var id = data.id;
                    var title = data.PostTitle;
                    var content = data.PostDetails;
                    var lastCommunication = $('#last-communication');
                    lastCommunication.find('table thead #id').text(id);
                    lastCommunication.find('table thead #title').text(title);
                    lastCommunication.find('table tbody #lastbody').html(content);
                }
            }
        });
    }, 10000); // esegue la chiamata ogni 10 secondi
});
```
