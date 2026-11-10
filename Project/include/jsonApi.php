<?php

    $adatok = [];

    $mappa = 'json/';

    $jsonok = scandir($mappa);

    $mappa = 'logok/';

    $logok = scandir($mappa);


    //var_dump($jsonok);

    $divId = "";

    class Vasuttarsasag
    {
        public $eleresiUt;
        public $divId;
        public $mappaNev;
        public $logo;

        function __construct($eleresiUt,$divId,$mappaNev,$logo)
        {
            $this->eleresiUt = $eleresiUt;
            $this->divId = $divId;
            $this->mappaNev = $mappaNev;
            $this->logo = $logo;
        }
    }

    

    for($i = 2;$i < sizeof($jsonok);$i++)
    {
            $adatok[] = 
            new Vasuttarsasag("include/json/".$jsonok[$i],
            "kivalasztoLista".str_replace("forras.json","",$jsonok[$i]),
            str_replace("forras.json","",$jsonok[$i]),
            "include/logok/".$logok[$i]);
    }

    $json = json_encode($adatok);

    echo $json;

?>