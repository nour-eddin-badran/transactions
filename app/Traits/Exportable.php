<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait Exportable
{
    public function export(string $fileName, array $data): Response
    {
        $csvFileName = "{$fileName}.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $handle = fopen('php://temp', 'w');

        // Add CSV headers
        fputcsv($handle, array_keys($data[0]));

        // Add data to CSV
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return response($csvContent, 200, $headers);
    }
}
