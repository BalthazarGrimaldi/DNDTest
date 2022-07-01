<?php

namespace App\Services;

class csvToJsonClass
{
    /**
     * Undocumented function
     *
     * @param [type] $line
     * @return string
     */
    public function csvToJson(array $arrayCsv): string // Retrieves the array obtained from the CSV file and creates a Json file at "public/JSON/" named "product" from this array and returns the content of the Json file
    {
        $fJson = json_encode($arrayCsv);
        $fp = fopen('public/JSON/products.json', 'w');
        fwrite($fp, $fJson);
        fclose($fp);

        return $fJson;
    }
}
