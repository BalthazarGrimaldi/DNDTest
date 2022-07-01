<?php

namespace App\Services;

class formatCsvClass
{
    /**
     * Undocumented function
     *
     * @param [type] $csv
     * @return array
     */
    public function formatCsv(array $csv): array // formats the array according to the instructions
    {
        for ($i = 0; $i < count($csv[0]); $i++) {
            if ($csv[0][$i] ===  "title") {
                $csv[0][$i] = "slug"; // change "title" to "slug" in the first line
                for ($j = 1; $j < count($csv); $j++) {
                    $csv[$j][$i] = preg_replace(["/[$&+,:;=?@#|'<>.^*()%!-]/", '/[ ]/'], ['-', '_'], $csv[$j][$i]); // change 
                }
            }
            if ($csv[0][$i] ===  "is_enabled") {
                $csv[0][$i] = "status"; // change "is_enabled" to "status" in the first line
                for ($j = 1; $j < count($csv); $j++) {
                    if ($csv[$j][$i] == 0) {
                        $csv[$j][$i] = "Disable"; // change "0" to "Disable" in other lines
                    } else {
                        $csv[$j][$i] = "Enable"; // change "1" to "Enable" in other lines
                    }
                }
            }
            if ($csv[0][$i] ===  "currency") {
                for ($j = 0; $j < count($csv); $j++) {
                    array_splice($csv[$j], $i, 1); // delete this column
                }
            }
            if ($csv[0][$i] ===  "price") {
                for ($j = 1; $j < count($csv); $j++) {
                    $csv[$j][$i] = str_replace(".", ",", $csv[$j][$i]) . "€"; //change "." to "," and add "€" in all lines on the column of "price"
                }
            }
            if ($csv[0][$i] ===  "description") {
                for ($j = 1; $j < count($csv); $j++) {
                    $csv[$j][$i] = str_replace(['\r', '<br/>'], ['', ''], $csv[$j][$i]); // Supress "\r" and "<br/>" in the column "description"
                    $csv[$j][$i] = preg_replace('/<[^<>]+>/', '', $csv[$j][$i]); // Supress all HTML tags and their content in the column "description"
                }
            }
            if ($csv[0][$i] ===  "created_at") {
                for ($j = 1; $j < count($csv); $j++) {
                    $csv[$j][$i] = date_create($csv[$j][$i]);
                    $csv[$j][$i] = date_format($csv[$j][$i], 'l, d-M-Y H:i:s e'); //formats all the date (in column : "created_at")
                }
            }
        }
        return $csv;
    }
}
