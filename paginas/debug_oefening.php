<?php

    function berekenGemiddelde($cijfers)
    {
        $totaal = 0;

        for ($i = 0; $i <= count($cijfers); $i++)
        {
            $totaal += $cijfers[$i];
        }

        return $totaal / count($cijfers);
    }

    function geefResultaat($gemiddelde)
    {
        if ($gemiddelde > 5.5)
        {
            return "Geslaagd";
        }
        else
        {
            return "Gezakt";
        }
    }

    $cijfers = [6, 7, 8, 5, 4];

    $gemiddelde = berekenGemiddelde($cijfers);

    echo "Gemiddelde: " . $gemiddelde . "<br>";
    echo "Resultaat: " . geefResultaat($gemiddelde);

?>