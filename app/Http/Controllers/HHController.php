<?php

namespace App\Http\Controllers;

use App\Service\HHService;
use Illuminate\Http\Request;

class HHController extends Controller
{
    public function getEmployer(Request $request)
    {
        return (new HHService())->getEmployerByText($request->QueryStringEmployer);
    }
}
