<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Awesome\Traits\PreventHackingTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{

    use PreventHackingTrait;

    /**
     * Handle file downloads.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFiles($file_type, $file_name)
    {
        $file_type = $this->preventDTA($file_type);
        $file_name = $this->preventDTA($file_name);

        $file = public_path() . "/uploads/" . $file_type . "/" . $file_name;

        return response()->download($file);
    }

}
