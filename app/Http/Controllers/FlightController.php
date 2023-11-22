<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function show(Request $request)
    {
        if ($request->input('origin') == $request->input('destination')) {
            return response(['massage' => 'The city of origin and destination should not be the same'], 404);
        }

        $result = Flight::query()
            ->where('origin_id', $request->input('origin'))
            ->where('destination_id', $request->input('destination'))
            ->whereDate('departure', $request->input('departure'))
            ->where('capacity', '>=', $request->input('number_of_passengers'))
            ->when($request->input('start_price'), function ($query) use ($request) {
                return $query->where('price', '>=', $request->input('start_price'));
            })
            ->when($request->input('end_price'), function ($query) use ($request) {
                return $query->where('price', '<=', $request->input('end_price'));
            })
            ->when($request->input('start_time'), function ($query) use ($request) {
                return $query->whereTime('departure', '>=', $request->input('start_time'));
            })
            ->when($request->input('end_time'), function ($query) use ($request) {
                return $query->whereTime('departure', '<=', $request->input('end_time'));
            })
            ->when($request->input('airline_id'), function ($query) use ($request) {
                return $query->where('airline_id', $request->input('airline_id'));
            })
            ->when($request->input('sort'), function ($query) use ($request) {
                match ($request->input('sort')) {
                    'cheapest' => $query->orderBy('price', 'asc'),
                    'earliest' => $query->orderBy('departure', 'asc'),
                    'expensive' => $query->orderBy('price', 'desc'),
                };
            })
            ->get();


        if ($result->isEmpty()) {
            return response(['message' => 'No flights found'], 404);
        }

        return FlightResource::collection($result);
    }

    public function weekly(Request $request)
    {
        if ($request->input('origin') == $request->input('destination')) {
            return response(['massage' => 'The city of origin and destination should not be the same'], 404);
        }

        $weekStart = Carbon::parse($request->input('departure'))->startOfWeek(Carbon::SATURDAY);
        $weekDays = collect(CarbonPeriod::create($weekStart, 7)->toArray())->map(fn ($date) => $date->format('Y-m-d'));

        $results = DB::table('flights')->select([
            DB::raw("DATE_FORMAT(departure, '%Y-%m-%d') as date"),
            DB::raw("MIN(price) as lowest_price")
        ])
            ->where('origin_id', $request->input('origin'))
            ->where('destination_id', $request->input('destination'))
            ->where('capacity', '>=', $request->input('number_of_passengers'))
            ->havingBetween('date', [
                $weekDays->first(),
                $weekDays->last(),
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $weekDays->map(fn ($date) => [
            "date" => $date,
            "lowest_price" => $results->where('date', $date)->first()->lowest_price ?? '-',
        ]);
    }
}
