<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ClientsReportController extends BaseController
{


    /**
     * Report Clients With Average age by gender 
     */
    public function averageAgeByGender(Request $request)
    {
        return response()->json(
            DB::table('clients')
                ->select(DB::raw('round(avg(age), 0) as ageAverage'), 'clients.gender')
                ->groupBy('clients.gender')
                ->get()
        );
    }
}
