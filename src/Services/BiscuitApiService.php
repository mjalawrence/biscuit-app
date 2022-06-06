<?php

namespace App\Services;

class BiscuitApiService
{
    public function fetchBiscuitData(): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_URL, "https://dev.io-academy.uk/resources/biscuits.json");
        $output = curl_exec($ch);
        $biscuits_returned = json_decode($output, true);

        curl_close($ch);

        return $biscuits_returned;
    }
}