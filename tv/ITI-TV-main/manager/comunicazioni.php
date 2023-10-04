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
    <title>Gestione Comunicazioni</title>
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
        /* Modifica la selezione del testo */
        ::selection {
            background: white; /* background della selezione */
            color: #102C54; /* colore del testo della selezione */
        }

        /* Modifica la selezione del testo */
        ::-moz-selection {
            background: white; /* background della selezione */
            color: #102C54; /* colore del testo della selezione */
        }

        /* Modifica la selezione del testo */
        input::selection {
            background: #102C54; /* background della selezione */
            color: white; /* colore del testo della selezione */
        }

        /* Modifica la selezione del testo */
        input::-moz-selection {
            background: #102C54; /* background della selezione */
            color: white; /* colore del testo della selezione */
        }

        /* Modifica la selezione del testo */
        textarea::selection {
            background: #102C54; /* background della selezione */
            color: white; /* colore del testo della selezione */
        }

        /* Modifica la selezione del testo */
        textarea::-moz-selection {
            background: #102C54; /* background della selezione */
            color: white; /* colore del testo della selezione */
        }

        /* Per modificare la tabella */
        table, td, tr, th
        {
            margin: auto; /* modifica il margine */
            border: 2px solid white; /* spessore, tipo e colore */
            border-collapse: collapse; /* toglie il doppio bordo alla tabella */
            padding: 4px; /* spazio tra l'esterno della tabella e l'interno della pagina */
        }
        
        /* seleziona l'id "centro" */
        #centro{ 
            text-align: center; /* Centra il testo */
        }
        
        /* Modifica le misure dell'area di testo */
        #txtArea{
            width: 20em; /* lunghezza */
            height: 8em; /* altezza */
            min-width: 20em; /* lunghezza minima */
            min-height: 8em; /* altezza minima */
            max-width: 25em; /* lunghezza massima */
            max-height: 15em; /* altezza massima */
        }

        /* Modifica l'allineamento dell'intestazione della tabella */
        #intestazione
        {
            text-align: center; /* Centra il testo */
        }

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
        
        /* Elimina il bordo quando l'elemento viene cliccato */
        input:focus{
            outline: none;
        }

        /* Elimina il bordo quando l'elemento viene cliccato */
        textarea:focus{
            outline: none;
        }


        /* Input dell'area di testo */
        input,textarea
        {
            font-size: 1em; /* dimensione testo */
            text-align: center; /* centra il testo */
            border: 2px solid white; /* modifica il bordo: spessore, tipo e colore */
            border-radius: 8px;  /* arrotonda gli angoli della text area */
        }

        /* seleziona l'id "bottone" */
        #bottone
        {
            text-align: center; /* centra il testo */
        }

        /* Modifica il pulsante "sfoglia" */
        #add{
            background-image: url("./assets/image/add.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            width: 3em; /* lunghezza immagini*/
            height: 3em; /* altezza immagini */
            background-size: 100% 100%; /* dimensione sfondo */
            color: transparent; /* colore sfondo */
            cursor: pointer; /* tipo di cursore */
        }

        /* Modifica il pulsante "modifica" */
        #edit{ 
            margin: auto; /* mette il margine in maniera automatica */
            background-image: url("./assets/image/edit.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            width: 3em; /* lunghezza immagini*/
            height: 3em; /* altezza immagini */
            background-size: 100% 100%; /* dimensione sfondo */
            color: transparent; /* colore sfondo */
            cursor: pointer; /* tipo di cursore */
        }

        /* Modifica il pulsante "rimozione" */
        #delete{ 
            margin: auto; /* mette il margine in maniera automatica */
            background-image: url("./assets/image/delete.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            width: 3em; /* lunghezza immagini*/
            height: 3em; /* altezza immagini */
            background-size: 100% 100%; /* dimensione sfondo */
            color: transparent; /* colore sfondo */
            cursor: pointer; /* tipo di cursore */
        }
        
        /* Modifica id radioC */
        #radioC{
            cursor: pointer; /* tipo di cursore */
        }

    </style>
    <!-- Favicon -->
    <link rel="icon" href="./assets/image/FaviconITITV.png" />
</head>




<?php
    // Aggiunge una comunicazione al DB
    function aggiungere_al_database($conn, $Numero, $Titolo, $Corpo, $Tag){
        global $errori;
        $query = $conn->prepare("INSERT INTO `comunicazioni` (`Numero`, `Titolo`, `Corpo`, `Tag`) VALUES (?,?,?,?) ");
        $query->bind_param("ssss", $Numero, $Titolo, $Corpo, $Tag);
        if($query->execute() === false){
            $errori .= '<script async defer>alertify.errorAlert("Errore esecuzione inserimento");</script>';
        }
        $query->close();
    }

    // Aggiunge una comunicazione al DB
    function aggiungere_al_database_no_ID($conn, $Titolo, $Corpo, $Tag){
        global $errori;
        $query = $conn->prepare("INSERT INTO `comunicazioni` (`Titolo`, `Corpo`, `Tag`) VALUES (?,?,?) ");
        $query->bind_param("sss", $Titolo, $Corpo, $Tag);
        if($query->execute() === false){
            $errori .= '<script async defer>alertify.errorAlert("Errore esecuzione inserimento");</script>';
        }
        $query->close();
    }

    // Rimuovere una comunicazione al DB
    function cancellare_nel_database($conn, $ID){
        global $errori;
        $query = $conn->prepare("DELETE FROM `comunicazioni` WHERE `comunicazioni`.`Numero` = ?");
        $query->bind_param("d", $ID);
        if($query->execute() === false){
            $errori .= '<script defer>alertify.errorAlert("Errore esecuzione cancellazione");</script>';
        } else {
            $errori .= '<script async defer>alertify.infoAlert("Comunicazione rimossa con successo!")</script>';
        }

        $query->close();

    }

    // Modificare una comunicazione al DB
    function modificare_nel_database($conn, $ID, $Tag, $Titolo, $Corpo){
        global $errori;
        $query = $conn->prepare("UPDATE `comunicazioni` SET `Titolo`=?, `Corpo`=?, `Tag`=? WHERE `Numero` LIKE ?");
        $query->bind_param("sssd", $Titolo, $Corpo, $Tag, $ID);
        if($query->execute() === false){
            $errori .= '<script defer>alertify.errorAlert("Errore esecuzione modifica");</script>';
        } else {
            $errori .= '<script async defer>alertify.infoAlert("Comunicazione modificata con successo!")</script>';
        }

        $query->close();
    }


    // Sceglie che operazione eseguire e esegue gli eventuali controlli sulle variabili
    if(isset($_POST['Operazione'])){
        switch($_POST['Operazione']){
            case 'Aggiunta':
                if(isset($_POST['Numero']) && !empty($_POST['Titolo']) && !empty($_POST['Corpo']) && !empty($_POST['Tag'])){
                    if(!empty($_POST['Numero'])){
                        aggiungere_al_database($conn, $_POST['Numero'], $_POST['Titolo'], $_POST['Corpo'], $_POST['Tag']);
                    }else{
                        aggiungere_al_database_no_ID($conn, $_POST['Titolo'], $_POST['Corpo'], $_POST['Tag']);
                    }
                }else{
                    $errori .= '<script defer>alertify.errorAlert("Tutti i campi sono obbligatori");</script>';
                }
                break;
            case 'Modifica':
                if(!empty($_POST['Tag']) && !empty($_POST['Titolo']) && !empty($_POST['Corpo']) && isset($_POST['ID'])){
                    modificare_nel_database($conn, $_POST['ID'], $_POST['Tag'], $_POST['Titolo'], $_POST['Corpo']);
                }else{
                    $errori .= '<script defer>alertify.errorAlert("Errore modifica");</script>';
                }
                break;
            case 'Rimozione':
                if(!empty($_POST['ID'])){
                    cancellare_nel_database($conn, $_POST['ID']);
                }else{
                    $errori .= '<script defer>alertify.errorAlert("Errore cancellazione");</script>';
                }
                break;
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
                <thead>
                    <tr>
                        <!-- <div style="display: block; position: fixed;"> -->   
                        <th>Numero</th>
                        <th>Titolo</th>
                        <th>Corpo</th>
                        <th>Tag</th>
                        <th colspan="2">Azioni</th>
                        <!-- </div> -->
                    </tr>
                </thead> 
            <!-- -->
            <tbody>
                <tr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <td><input type="number" name="Numero" min="0"></td>
                        <td><input type="text" name="Titolo" autocomplete="off" maxlength="45"></td>
                        <td><textarea name="Corpo" cols="30" rows="10" id="txtArea"  autocomplete="off" maxlength="300"></textarea></td>
                        <td>
                                <input type="radio" id="radioC" name="Tag" value="Nessuno" checked>Nessuno <br>
                                <input type="radio" id="radioC" name="Tag" value="News">News<br>
                                <input type="radio" id="radioC" name="Tag" value="Importante">Importante<br>
                                <input type="radio" id="radioC" name="Tag" value="Progetto">Progetto<br>
                                <input type="radio" id="radioC" name="Tag" value="Docenti">Docenti<br>
                                <input type="radio" id="radioC" name="Tag" value="Studenti">Studenti<br>
                                <input type="radio" id="radioC" name="Tag" value="ATA">ATA<br>
                                <input type="radio" id="radioC" name="Tag" value="Variazioni">Variazioni orari<br>
                        </td>
                        <td colspan="2" id="bottone"><input type="submit" name="Operazione" value="Aggiunta" id="add"></td>
                    </form>
                </tr>
                <?php
                    $result = $conn->query("SELECT * FROM `comunicazioni` ORDER BY `Numero` DESC");
                    
                    if ($result->num_rows > 0) {
                    // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                        <td><input type="number" name="Numero" value="' . $row["Numero"]. '" min="0"></td>
                                        <td><input type="text" name="Titolo" value="' . $row["Titolo"]. '" autocomplete="off" maxlength="45"></td>
                                        <td><textarea name="Corpo" cols="30" rows="3" id="txtArea" autocomplete="off" maxlength="300">' . $row["Corpo"]. '</textarea></td>
                                        <td>
                                            <input type="radio" id="radioC" name="Tag" value="Nessuno"'.($row["Tag"]=='Nessuno' ? 'checked' : '').'>Nessuno <br>
                                            <input type="radio" id="radioC" name="Tag" value="News"'.($row["Tag"]=='News' ? 'checked' : '').'>News <br>
                                            <input type="radio" id="radioC" name="Tag" value="Importante"'.($row["Tag"]=='Importante' ? 'checked' : '').'>Importante <br>
                                            <input type="radio" id="radioC" name="Tag" value="Progetto"'.($row["Tag"]=='Progetto' ? 'Progetto' : '').'>Progetto <br>
                                            <input type="radio" id="radioC" name="Tag" value="Docenti"'.($row["Tag"]=='Docenti' ? 'checked' : '').'>Docenti <br>
                                            <input type="radio" id="radioC" name="Tag" value="Studenti"'.($row["Tag"]=='Studenti' ? 'checked' : '').'>Studenti <br>
                                            <input type="radio" id="radioC" name="Tag" value="ATA"'.($row["Tag"]=='ATA' ? 'checked' : '').'>ATA <br>
                                            <input type="radio" id="radioC" name="Tag" value="Variazioni"'.($row["Tag"]=='Variazioni' ? 'checked' : '').'>Variazioni orari <br>
                                        </td>
                                        <td id="bottone">
                                            <input type="submit" id="edit" name="Operazione" value="Modifica">
                                        </td>
                                        <td id="bottone">
                                            <input type="hidden" name="ID" value="'.$row["Numero"].'">
                                            <input type="submit" id="delete" name="Operazione" value="Rimozione">
                                        </td>
                                    </form>
                                </tr>';
                        }
                    }else{
                        echo '<tr><td colspan="6" id="centro">Nessuna comunicazione presente in memoria</td></tr>';
                    }
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
