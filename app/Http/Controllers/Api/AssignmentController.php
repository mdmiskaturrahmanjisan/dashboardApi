<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    // Haversine Formula
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }

    // Assign customers inside polygon
    public function assign(Request $request)
    {
        $deliveryMan = User::findOrFail($request->delivery_man_id);
        $polygon = $request->polygon; // array of lat/lng
        $customers = User::where('role', 'customer')->get();

        $assigned = [];

        foreach ($customers as $customer) {
            if ($this->pointInPolygon($customer->lat, $customer->lng, $polygon)) {

                // distance from delivery_man to customer
                $distance = $this->calculateDistance(
                    $deliveryMan->lat, $deliveryMan->lng,
                    $customer->lat, $customer->lng
                );

                Assignment::updateOrCreate(
                    ['delivery_man_id' => $deliveryMan->id, 'customer_id' => $customer->id],
                    ['distance' => $distance]
                );

                $assigned[] = [
                    "id" => $customer->id,
                    "name" => $customer->name,
                    "address" => $customer->address,
                    "lat" => $customer->lat,
                    "lng" => $customer->lng,
                    "distance" => $distance
                ];
            }
        }

        // sort by nearest first
        usort($assigned, fn($a, $b) => $a['distance'] <=> $b['distance']);

        return response()->json($assigned);
    }


    // Point in polygon
    private function pointInPolygon($lat, $lng, $polygon)
    {
        $inside = false;
        $j = count($polygon) - 1;

        for ($i = 0; $i < count($polygon); $i++) {
            $xi = $polygon[$i]['lat'];
            $yi = $polygon[$i]['lng'];
            $xj = $polygon[$j]['lat'];
            $yj = $polygon[$j]['lng'];

            $intersect = (($yi > $lng) != ($yj > $lng)) &&
                ($lat < ($xj - $xi) * ($lng - $yi) / ($yj - $yi) + $xi);

            if ($intersect) $inside = !$inside;
            $j = $i;
        }
        return $inside;
    }
}
