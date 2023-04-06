<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Http\Request;

class UserExport implements FromCollection, WithHeadings
{
    //method returns a collection of users that we want to export
    public function collection()
    {
        return User::select('id', 'name', 'email')->get();
    }


    //method returns an array of column headings that will be included in the exported file
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
        ];
    }

//method generates an Excel file and downloads it to the user's browser
public function exportExcel()
{
    return Excel::download(new UserExport(), 'users_data.xlsx');
}

//method generates a CSV file and downloads it to the user's browser. It uses the
public function exportCsv()
{
    $fileName = 'users_data.csv';

    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    //closure that will be executed when the user requests the CSV file
    $callback = function () {
        $FH = fopen('php://output', 'w');
        fputcsv($FH, ['ID', 'Name', 'Email']);

        $users = User::select('id', 'name', 'email')->get();

        foreach ($users as $user) {
            fputcsv($FH, [$user->id, $user->name, $user->email]);
        }

        fclose($FH);
    };

    //returns a response object that streams the CSV data to the browser with the appropriate headers.
    return response()->stream($callback, 200, $headers);
}


}