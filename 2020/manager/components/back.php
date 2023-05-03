<style>

    /* tasto indietro */
    #back { 
    float: left; /* allocazione */
    margin-left: 8em; /* dimensione margine */
    }

/* modifica pulsante */
#back button {
    mix-blend-mode: lighten;
    padding: 0; /* spazio tra esterno pulsante e interno tabella */
    margin: 0; /* margine */
    background-color: transparent; /* colore sfondo */
    border-color: transparent; /* colore bordo */
    }

/* caratteristiche immagine back */
#back button img {
    height: 5.5em /* altezza immagine */
    }

/* immagine pulsante  */
#back button img:hover {
    cursor: pointer; /* modifica cursore */
    }
</style>

<div id="back">
    <button onclick="window.location.replace('menu.php')"><img src="./assets/image/back.png" alt="Back"></button>
</div>