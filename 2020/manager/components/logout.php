<style>

    /* modifica logout */
    #logout {
        float: right; /* allocazione pulsante */
        margin-right: 8em; /* dimensione margine destro */
    }
    
    /* pulsante logout */
    #logout button {
        mix-blend-mode: lighten; 
        padding: 0; /* spazio tra l'esterno della tabella e l'interno della pagina */
        margin: 0; /* dimensione margine */
        background-color: transparent; /* colore sfondo */
        border-color: transparent; /* colore bordo */
    }

    /* immagine pulsante logout */
    #logout button img { 
        height: 5.5em /* altezza immagine */
    }
    
    /* evento passaggio cursore */
    #logout button img:hover {
        cursor: pointer; /* modifica cursore */
    }
</style>

<form action="." method="post" id="logout">
    <button type="submit" name="Logout"><img src="./assets/image/logout.png" alt="Logout"></button>
</form>