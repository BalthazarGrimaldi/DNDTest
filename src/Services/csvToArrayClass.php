<?php

namespace App\Services;

class csvToArrayClass
{
    /**
     * Undocumented function
     *
     * @param [type] $line
     * @return array
     */
    private function strGetcsvSemicolon($line): array // Allows changing the default "," as the second argument of the str_getcsv() function to a ";"
    {
        return str_getcsv($line, ";");
    }
    /**
     * Undocumented function
     *
     * @param [type] $csvFile
     * @return array
     */
    public function arrayCsv($csvFile): array // Convert CSV file to array
    {
        return array_map(array($this, 'strGetcsvSemicolon'), file($csvFile));
    }
}
