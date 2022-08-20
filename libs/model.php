<?php

class model
{
    public $db;

    public function __construct()
    {
        //echo "<p>modelo principal</p>";
        $this->db = new database();
    }
}
