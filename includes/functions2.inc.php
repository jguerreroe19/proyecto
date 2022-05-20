<?php
    //Función para convertir los valores de los campos en urlencode
    function getURLData($name, $sname, $email){
        $valor = 'name='.urlencode($name).'&sname='.urlencode($sname).'&email='.urlencode($email);
        return $valor;
    }


