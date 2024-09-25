<?php

namespace App\Http\Controllers;

use App\Models\ForexPair;
use Illuminate\Http\Request;

class ForexController extends Controller
{
    //

    public function forexPair()
    {

        $allPairs = ForexPair::where('status', 'active')->get();

        return view('Exchange/Exchange', [
            'allPairs' => $allPairs
        ]);
    }
}
