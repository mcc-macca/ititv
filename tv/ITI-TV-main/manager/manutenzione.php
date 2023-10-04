<?php
    require('./backend/init_page.php');      // Codice di inizializzazione e controllo per le paggine che richiedono gli utenti già autenticati
    require('./backend/db_connection.php');     // Imposta la connessione col database esponendo $conn per interagire col DB (Ricordarsi di chiudere la connessione quando finito le query)
    $errori = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Manutezione</title>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script defer>
        if(!alertify.errorAlert){
            // Definisco un nuovo popup di avvertimento
            alertify.dialog('errorAlert',function factory(){
                return{
                    build:function(){
                        this.set('movable', false);
                        var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                        +    'style="vertical-align:middle;color:#e10000;">'
                        + '</span><span style="color: red;">Errore Applicazione</span>';
                        this.setHeader(errorHeader);
                    }
                };
            },true,'alert');

            alertify.dialog('infoAlert',function factory(){
                return{
                    build:function(){
                        this.set('movable', false);
                        var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                        +    'style="vertical-align:middle;color:#e10000;">'
                        + '</span><span style="color: blue;">Informazione Applicazione</span>';
                        this.setHeader(errorHeader);
                    }
                };
            },true,'alert');
        }


    </script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="./assets/stylesheets/body.css">
    <style>
        /* Seleziona tutto ciò che è in "h2", per ora solo il titolo */
        h2
        {
            text-align: center; /* centra il testo */
            width: 12.5em; /* lunghezza */
            height: 1.5em; /* altezza */
            border: 2px solid white; /* modifica il bordo: spessore, tipo e colore */
            box-sizing: border-box; /* include "padding" e "border" in un solo elemento */
            margin: auto; /* ridimensionamento margine */   
            padding: 2px; /* spazio tra l'esterno della tabella e l'interno della pagina */        
        }

        /* Per modificare la tabella */
        table, td, tr, th
        {
            margin: auto; /* modifica il margine */
            width: 80%;
            border: 2px solid white; /* spessore, tipo e colore */
            border-collapse: collapse; /* toglie il doppio bordo alla tabella */
            padding: 4px; /* spazio tra l'esterno della tabella e l'interno della pagina */
            font-size:1.2em;
        }

        #salva{
            width:8em;
            font-size:1em;
            border-radius:20px;
            backgroud-color:white;
        }
    </style>
    <!-- Favicon -->
    <link rel="icon" href="./assets/image/FaviconITITV.png" />
</head>




<?php
$servername = "localhost";
$username = "ititv";
$password = "ititv";
$dbname = "ititv";
$ris='';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

mysqli_query($conn, "UPDATE manutenzione SET Manutenzione=.$ris");


if(isset($_POST['modifica'])){
    switch($_POST['modifica']){
        case 'Modifica':
            $ris=$_POST['Tag'];
    }
}

?>



<body>
    
<?php require('./components/header.php'); // Importa il titolo?>
   
   <br> <h2>Gestione Comunicazioni</h2> <br>
   <!--<div style="height: 22.5em; overflow-y: auto;">-->
   <div style="height: 22.5em; overflow-y: auto;">
       <div>
           <table>
           <!-- -->
           <tbody>
               <?php
                           echo '<tr>
                                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                       <td>Impostare Stato Manutenzione</td>
                                       <td>
                                           <input type="radio" id="radioC" name="Tag" value="Si"'.(["Manutenzione"]=='Si' ? 'checked' : '').'>Si <br>
                                           <input type="radio" id="radioC" name="Tag" value="No"'.(["Manutenzione"]=='No' ? 'checked' : '').'>No <br>
                                       </td>
                                       <td id="bottone">
                                            <input type="submit" id="edit" name="modifica" value="Modifica">
                                        </td>
                                   </form>
                               </tr>';
               ?>
           </tbody>
           </table>
       </div>
   </div>

   <?php require('./components/footer.php'); // Importa il fondo pagina?>
   <?php require('./components/back.php'); // Importa il tasto indietro?>
   <?php require('./components/logout.php'); // Importa il tasto logout?>

   <?php $conn->close(); // Chiusura commessione col database generale?>
</body>
</html>
<?php

    echo $errori;

?>
