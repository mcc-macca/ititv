<?php

/**
 * @param mixed $file PARAMETRO FILE
 * @return mixed
 */
function leggiFileJson($file){
    $fileContents = file_get_contents($file);

    $data = json_decode($fileContents, true);

    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Errore nella lettura o nel parsing del file JSON: ' . json_last_error_msg());
    }
    return $data;
}
