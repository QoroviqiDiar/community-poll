<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function response;
use function storage_path;

class FilesController extends Controller
{
    public function show()
    {

        $pathFile = storage_path('app/GraceHopper.pdf');
        $name = 'Amazing Grace';

        return response()->download($pathFile, $name);
    }
}
