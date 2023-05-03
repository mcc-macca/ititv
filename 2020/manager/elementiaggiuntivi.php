<?php

    $errore = "";

    require('./backend/init_page.php');     // Codice di inizializzazione e controllo per le paggine che richiedono gli utenti già autenticati
    require('./backend/db_connection.php');     // Imposta la connessione col database esponendo $conn per interagire col DB (Ricordarsi di chiudere la connessione quando finito le query)

    // Aggiunge un elemento aggiuntivo al DB
    function aggiungere_al_database($conn, $url, $tipo, $inizio, $fine){
        global $errore;
        $query = $conn->prepare("INSERT INTO `informazioni_temporizzate` (`URL_File`, `Tipo`, `Data_inizio`, `Data_fine`) VALUES (?,?,?,?) ");
        $query->bind_param("ssss", $url, $tipo, $inizio, $fine);
        if($query->execute() === false){
            $errore .= '<script async defer>alertify.errorAlert("Errore aggiunta informazione!");</script>';
        }
    }

    // Rimuovere una elemento aggiuntivo al DB
    function cancellare_nel_database($conn, $ID){
        global $errore;
        $q = $conn->prepare("SELECT `URL_File` FROM `informazioni_temporizzate` WHERE `informazioni_temporizzate`.`ID_Informazione` = ?");
        $q->bind_param("d", $ID);
        $q->execute();
        $result = $q->get_result();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                @unlink($row["URL_File"]);
            }
        }
        $query = $conn->prepare("DELETE FROM `informazioni_temporizzate` WHERE `informazioni_temporizzate`.`ID_Informazione` = ?");
        $query->bind_param("d", $ID);
        if($query->execute() === false){
            $errore .= '<script async defer>alertify.errorAlert("Errore rimozione informazione!");</script>';
        }else{
            $errore .= '<script async defer>alertify.infoAlert("Rimozione avvenuta con successo!");</script>';
        }
        $query->close();
    }

    // Modificare una elemento aggiuntivo al DB
    function modificare_nel_database($conn, $ID, $tipo, $inizio, $fine){
        global $errore;
        $query = $conn->prepare("UPDATE `informazioni_temporizzate` SET `Tipo` = ?, `Data_inizio` = ?, `Data_fine` = ? WHERE `ID_Informazione` LIKE ?");
        $query->bind_param("sssd", $tipo, $inizio, $fine, $ID);
        if($query->execute() === false){
            $errore .= '<script async defer>alertify.errorAlert("Errore modifica informazione!");</script>';
        }else{
            $errore.= '<script async defer>alertify.infoAlert("Modifica avvenuta con successo!");</script>';
        }  
    } 

    // Aggiunge un orario a un determinato elemento aggiuntivo
    function aggiungi_orario($conn, $ID_Informazione, $Orario){
        global $errore;
        $query = $conn->prepare("INSERT INTO `eventi` (`ID_Evento`, `ID_Informazione`, `Orario`) VALUES (NULL, ?, ?) ");
        $query->bind_param("ss", $ID_Informazione, $Orario);
        if($query->execute() === false) {
            $errore .= '<script async defer>alertify.errorAlert("Errore aggiunta orario!");</script>';
        }
    }

    // Rimuove un orario a un determinato elemento aggiuntivo
    function elimina_orario($conn, $ID_Evento){
        global $errore;
        $query = $conn->prepare("DELETE FROM `eventi` WHERE `eventi`.`ID_Evento` = ?");
        $query->bind_param("d", $ID_Evento);
        if($query->execute() === false){
            $errore .= '<script async defer>alertify.errorAlert("Errore elimina orario!");</script>';
        }else{
            $errore .= '<script async defer>alertify.infoAlert("Orario rimosso con successo!);</script>';
        }
    }

    // Sceglie che operazione eseguire
    if(isset($_POST['Operazione'])){
        switch($_POST['Operazione']){
            case 'Aggiunta':
                if(isset($_FILES['fileToUpload']) && !empty($_POST['Tipo']) && !empty($_POST['Inizio']) && isset($_POST['Fine'])){
                    $target_dir = "./assets/upload/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Controlla se il file esiste
                    if (file_exists($target_file)) {
                        $errore.= '<script async defer>alertify.errorAlert("Spiacenti, il file esiste già!");</script>';
                        $uploadOk = 0;
                    }

                    // Controlla la dimensione del file 
                    if ($_FILES["fileToUpload"]["size"] > 100000000000 && $uploadOk == 1) {
                        $errore.= '<script async defer>alertify.errorAlert("Spiacenti, il file caricato è troppo grande!");</script>';
                        $uploadOk = 0;
                    }

                    // Consenti determinati formati di file
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != "mov" && $imageFileType != "mp4" && $uploadOk == 1) {
                        $errore.= '<script async defer>alertify.errorAlert("Spiacenti, sono consentiti unicamente file di tipo JPG, JPEG, PNG, GIF, MOV & MP4!");</script>';
                        $uploadOk = 0;
                    }

                    // Controlla se la variabile $uploadOk è impostata a 0(errore)
                    if ($uploadOk == 0) {
                        $errore.= '<script async defer>alertify.errorAlert("Spiacenti, il file non è stato caricato!");</script>';
                    } else {
                        // Prova a caricare il file sul server
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                            aggiungere_al_database($conn, $target_file, $_POST['Tipo'], $_POST['Inizio'], $_POST['Fine']);
                        } else {
                            $errore.= '<script async defer>alertify.errorAlert("Spiacenti, è stato rilevato un errore nel caricamento del file, riprovare più tardi!");</script>';
                        }
                    }
                }else{
                    $errore .= '<script async defer>alertify.errorAlert("Inserire tutti i campi per aggiungere un elemento!");</script>';
                }

                break;
            case 'Modifica':
                if (!empty($_POST['Tipo']) && !empty($_POST['Inizio']) && isset($_POST['Fine']) && isset($_POST['IDEvento'])) {
                    modificare_nel_database($conn, $_POST['IDEvento'], $_POST['Tipo'], $_POST['Inizio'], $_POST['Fine']);
                }else{
                    $errore .= '<script async defer>alertify.errorAlert("Inserire tutti i campi per la modifica!");</script>';
                }
                break;
            case 'Rimozione':
                if(!empty($_POST['IDEvento'])){
                    cancellare_nel_database($conn, $_POST['IDEvento']);
                }
                break;
            case 'Aggiungi Ora':
                if(!empty($_POST['Orario']) && !empty($_POST['ID_Informazione'])){
                    aggiungi_orario($conn, $_POST['ID_Informazione'], $_POST['Orario']);
                }else{
                    $errore .= '<script async defer>alertify.errorAlert("Completa il campo ora per inserire un orario!");</script>';
                }
                break;
            case 'Rimuovi Ora':
                if(!empty($_POST['IDEvento'])){
                    elimina_orario($conn, $_POST['IDEvento']);
                }
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Componenti Aggiuntivi</title>
    <!-- Favicon -->
    <link rel="icon" href="./assets/image/FaviconITITV.png" />
    <link rel="stylesheet" href="./assets/stylesheets/body.css">

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

    <style type="text/css">
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

        /* Elimina il bordo quando l'elemento viene cliccato */
        input:focus{
            outline: none;
        }

        /* Elimina il bordo quando l'elemento viene cliccato */
        textarea:focus{
            outline: none;
        }

        /* modifiche tabella e linee interne */
        table,td,tr
        {
            border: 2px solid white; /* spessore, tipo e colore linee */
            text-align: center; 
            margin: auto; /* tipo di margine */
            border-collapse: collapse; /* rimozione doppie-linee */
            padding: 4px; /* spazio tra l'esterno della tabella e l'interno della pagina */
        }

        /* modifiche testi in "h2" */
        h2
        {
            text-align: center; 
            width: 16em; /* lunghezza testo */
            height: 1.5em; /* altezza testo */
            border: 2px solid white; /* spessore, tipo e colore bordo */
            box-sizing: border-box; /* "inscatolamento" testo */
            margin: auto; /* tipo di margine */
            padding: 2px; /* spazio tra l'esterno della tabella e l'interno della pagina */
        }

        /* input testo */
        input
        {
            border: 2px solid white; /* spessore, tipo e colore tabella testo */
            border-radius: 8px; /* curvatura angoli tabella testo */
            font-size: 1em; /* dimensione font */
            text-align: center; 
        }

        /* modifiche tabella orario */
        #tabella
        {
        border-style: hidden; /* tipo di bordo */
        }

        /* Modifica il pulsante "aggiunta" */
        #add{ 
            margin: auto; /* mette il margine in maniera automatica */
            background-image: url("./assets/image/add.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            width: 2.5em; /* lunghezza immagini*/
            height: 2.5em; /* altezza immagini */
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

        /* Modifica il pulsante "aggiunta" dell'orario */
        #add2{ 
            margin: auto; /* mette il margine in maniera automatica */
            background-image: url("./assets/image/add.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            width: 1.5em; /* lunghezza immagini*/
            height: 1.5em; /* altezza immagini */
            background-size: 100% 100%; /* dimensione sfondo */
            color: transparent; /* colore sfondo */
            cursor: pointer; /* tipo di cursore */
        }

        /* Modifica il pulsante "rimozione" dell'orario */
        #delete2{ 
            margin: auto; /* mette il margine in maniera automatica */
            background-image: url("./assets/image/delete2.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            width: 1.5em; /* lunghezza immagini*/
            height: 1.5em; /* altezza immagini */
            background-size: 100% 100%; /* dimensione sfondo */
            color: transparent; /* colore sfondo */
            cursor: pointer; /* tipo di cursore */
        }

        /* Modifica il pulsante "sfoglia" */
        #upload{ 
            margin: auto; /* mette il margine in maniera automatica */
            background-image: url("./assets/image/upload.png"); /* immagine di sfondo */
            border: none; /* tipo di bordo */
            background-color: transparent; /* colore sfondo */
            background-repeat: no-repeat; /* caratteristiche sfondo */
            display: inline-block;
            width: 3.5em; /* lunghezza immagini*/
            height: 3em; /* altezza immagini */
            background-size: 100% 100%; /* dimensione sfondo */
            color: transparent; /* colore sfondo */
            cursor: pointer; /* tipo di cursore */
        }

        /* Modifica id "data" */
        #data{
            cursor: pointer; /* tipo di cursore */
        }
    </style>
<body>
    
    <?php require('./components/header.php') // Importa il titolo?>
    <br/>
    <h2>Gestione Componenti Aggiuntivi</h2>
    <br/>
    <div style="height: 22.5em; overflow-y: auto;">
        <table>
            <tr>
                <td>ID</td>
                <td>UPLOAD FILE</td>
                <td>Titolo</td>
                <td>Data Inizio</td>
                <td>Data Fine</td>
                <td colspan="2">Azioni</td>
                <td>Tabella orari</td>
            </tr>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <td></td>
                    <td><label id="upload"><input type="file" name="fileToUpload" hidden></label></td>
                    <td><input type="text" name="Tipo" autocomplete="off"></td>
                    <td><input type="date" name="Inizio" id="data"></td>
                    <td><input type="date" name="Fine" id="data"></td>
                    <td colspan="2"><input type="submit" name="Operazione" value="Aggiunta" id="add"></td>
                    <td></td>
                </form>
            </tr>
            <?php

                function getTimeTable($conn, $IDInformazione){
                    echo '<table id="tabella">
                                <tr>
                                    <td>ID</td>
                                    <td>Orario</td>
                                    <td>Azione</td>
                                </tr>
                                <tr>
                                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                        <td></td>
                                        <td><input type="time" name="Orario"></td>
                                        <td>
                                            <input type="hidden" name="ID_Informazione" value="'.$IDInformazione.'">
                                            <input type="submit" name="Operazione" value="Aggiungi Ora" id="add2">
                                        </td>
                                    </form>
                                </tr>';
                                    $query2 = $conn->prepare("SELECT * FROM `eventi` WHERE `ID_Informazione` LIKE ?");
                                    $query2->bind_param("d", $IDInformazione);
                                    $query2->execute();
                                    $result2 = $query2->get_result();
                                    
                        
                                    if ($result2->num_rows > 0) {
                                    // output data of each row
                                        while($row2 = $result2->fetch_assoc()) {
                                            echo '<tr>
                                                    <td>' . $row2["ID_Evento"]. '</td>
                                                    <td>' . $row2["Orario"]. '</td>
                                                    <td>
                                                        <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                                            <input type="hidden" name="IDEvento" value="'.$row2["ID_Evento"].'">
                                                            <input type="submit" name="Operazione" value="Rimuovi Ora" id="delete2">
                                                        </form>
                                                    </td>
                                                </tr>';
                                        }
                                    }else{
                                        echo '<tr><td colspan="3">Nessun orario salvato</td><tr>';
                                    }
                                    $query2->close();
                            echo "</table>";
                }

                // creazione della tabella con SELECT da un database
                $result = $conn->query("SELECT * FROM `informazioni_temporizzate` ");
                
                if ($result->num_rows > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                    <td>'. $row["ID_Informazione"]. '</td>
                                    <td>';
                                    $ext = strtolower(pathinfo($row["URL_File"],PATHINFO_EXTENSION));
                                    if($ext == "mov" || $ext == "mp4"){
                                        echo '<video src="' .$row["URL_File"]. '" style="width:4em;" autoplay muted/>';
                                    }else{
                                        echo '<img src="' .$row["URL_File"]. '" style="width:4em;"/>';
                                    }
                                    echo '</td>
                                    <td><input type="text" name="Tipo" value="'.$row["Tipo"]. ' " autocomplete="off"></td>
                                    <td><input type="date" id="data" name="Inizio" value="'.$row["Data_inizio"].'"></td>
                                    <td><input type="date" id="data" name="Fine" value="'.$row["Data_fine"].'"></td>';
                            

                            echo '  <td>
                                        <input type="hidden" name="IDEvento" value="'.$row["ID_Informazione"].'">
                                        <input type="submit" name="Operazione" value="Modifica" id="edit">
                                    </td>
                                    <td>
                                        <input type="submit" name="Operazione" value="Rimozione" id="delete">
                                    </td>
                                </form>
                            ';

                            echo '<td>';
                            getTimeTable($conn, $row["ID_Informazione"]);
                            echo '</td>';
                            echo '</tr>';
                    }
                }

            ?>
        </table>
    </div>

    <?php echo $errore;?>

    <?php $conn->close();?>
    
    <?php require('./components/footer.php'); // Importa il fondo pagina?>
    <?php require('./components/back.php'); // Importa il tasto indietro?>
    <?php require('./components/logout.php'); // Importa il tasto logout?>


</body>
</html>