<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PopularController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'limit' => 'numeric|max:10',
            'date_filter' => 'in:day,month',
        ]);

        $query = DB::table('searches')
            ->selectRaw('count (*) as searches, city')
            ->groupBy('city')
            ->limit(10)
            ->orderBy(DB::raw('count(*)'), 'desc');

        if ($request->filled('limit')) {
            $value = $request->input('limit');
            $query->limit($value);

        }

        if ($request->filled('date_filter')) {
            $value = $request->input('date_filter');
            switch ($value) {
                case 'day':
                    $query->whereDay('created_at', Carbon::now()->day);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month);
                    break;
                default:
                    return response()->json(['message' => '400 - Only DAY and MONTH values available for this parameter'], 400);
            }
        }

        return response()->json(
            $query->get()
        );
    }
}
