<?php

class operacion_saldo_insuficiente extends Exception
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}

;
