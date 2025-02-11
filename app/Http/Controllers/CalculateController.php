<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    // public function showForm()
    // {
    
    //     return view('kundalis.calculation');
    // }
    public function showbirth()
    {
        return view('kundalis.birth');
    }
    
    // public function convertDegreesToDMS(Request $request)
    // {
    //     $this->validate($request, [
    //         'degrees' => 'required|numeric|min:0|max:360',
    //     ]);
    
    //     $degrees = $request->input('degrees');
    //     $dms = $this->degreesToDMS($degrees); // Use the conversion method
    
    //     $data = DB::table('zodiac')
    //               ->where('s_degree', '<=', $degrees)
    //               ->where('l_degree', '>=', $degrees)
    //               ->first();
    
    //     // Make sure to pass the correct degree value
    //     $netDegree = $this->calculateNetDegree($degrees, $data->sign_number);
    //     $netDms = $this->degreesToDMS($netDegree);
    
    //     $results = $this->calculateAstrologyValues($degrees);
    //     $resultsDms = [];
    //     foreach ($results as $result) {
    
    //         $nethouseDegree = $this->calculateNetDegree($result['value'], $result['data']->sign_number);
    //         $nethouseDms = $this->degreesToDMS($nethouseDegree);
    //         $resultsDms[] = [
    //             'original' => $result,
    //             'dms' => $nethouseDms
    //         ];
    //     }
    //     // var_dump($results);
    //     return view('kundalis.calculation', [
    
    //         'data' => $data,
    //         'result' => $dms,
    //         'netDegree' => $netDegree,
    //         'netDms'=>$netDms,
    //         'inputDegrees' => $degrees,
    //         'results' =>  $results
    
    //     ]);
    // }
    
    // public function convertDMSToDegrees(Request $request)
    // {
    //     $this->validate($request, [
    //         'degree' => 'required|numeric',
    //         'minute' => 'required|numeric',
    //         'second' => 'required|numeric',
    //     ]);
    
    //     $degree = $request->input('degree');
    //     $minute = $request->input('minute');
    //     $second = $request->input('second');
    //     $decimalDegrees = $this->dmsToDegrees($degree, $minute, $second);
    
    //     $data = DB::table('zodiac')
    //               ->where('s_degree', '<=', $decimalDegrees)
    //               ->where('l_degree', '>=', $decimalDegrees)
    //               ->first();
    
    //     $netDegree = $this->calculateNetDegree($decimalDegrees, $data->sign_number);
    
    
    //     // Call the new method to convert the net degree to DMS
    //     $netDms = $this->convertDegreesToDMS($netDegree);
    
    //     return view('kundalis.calculation', [
    //         'data' => $data,
    //         'result' => $decimalDegrees, // Use the correct variable name
    //         'netDegree' => $netDegree,
    //         'netDms'=>$netDms // Pass the DMS result
    //     ]);
    // }
    // private function calculateNetDegree($degrees, $sign_number)
    // {
    
    //     // Cast to float for decimal calculations
    //     $degrees = (float)$degrees;
    //     $sign_number = (float)$sign_number;
    
    //     // Calculate net degree using the provided formula
    //     $netDegree = $degrees - ($sign_number - 1) * 30;
    //     // var_dump($netDegree);
    //     // die;
    
    //     // Normalize the net degree to ensure it's within 0-360 degrees
    //     if ($netDegree < 0) {
    //         $netDegree += 360;
    //     } elseif ($netDegree >= 360) {
    //         $netDegree -= 360;
    //     }
    
    //     return $netDegree;
    // }
    // private function degreesToDMS($degrees)
    // {
    //     $d = floor($degrees);
    //     $m = floor(($degrees - $d) * 60);
    //     $s = round((($degrees - $d) * 60 - $m) * 60);
    
    //     return "{$d}° {$m}' {$s}\"";
    // }
    // private function dmsToDegrees($degree, $minute, $second)
    // {
    //     return $degree + ($minute / 60) + ($second / 3600);
    // }
    public function calculate(Request $request)
        {
            // Get values from the request
            $a = $request->input('a'); // Degree of planet A
            $b = $request->input('b'); // Degree of planet B
            $c = $request->input('c'); // Degree of planet C
    
            // Calculate initial d
            $d = $a - $b + $c;
    
            // Apply conditions
            if ($c > $b && $b < $a) {
                if ($c < $a) {
                    // No change
                } else {
                    $d += 30; // Add 30 degrees to d
                }
            }
    
            if ($c > $b && $a < $b) {
                if ($c < $a + 360) {
                    // No change
                } else {
                    $d += 30; // Add 30 degrees to d
                }
            }
    
            if ($c < $b && $a < $b) {
                if ($c < $a) {
                    // No change
                } else {
                    $d += 30; // Add 30 degrees to d
                }
            }
    
            if ($c < $b && $b < $a) {
                if ($c > $a) {
                    // No change
                } else {
                    $d += 30; // Add 30 degrees to d
                }
            }
    
            // Normalize d to ensure it's within 0 to 360 degrees
            $d = $d < 0 ? $d + 360 : ($d >= 360 ? $d - 360 : $d);
    
            // Determine if it's day or night based on d
            $dayOrNight = ($d >= 0 && $d < 180) ? 'Day' : 'Night';
    
            // Query zodiac data
            $data = DB::table('zodiac')->where('s_degree', '<=', $d)->where('l_degree', '>=', $d)->first();
               
            return response()->json([
                'result' => $d,
                'day_or_night' => $dayOrNight,
                // 'zodiac' => $data,
            ]);
            // Return the view with data
            // return view('kundalis.birth', ['data' => $data, 'result' => $d, 'day_or_night' => $dayOrNight]);
        }
    // public function calculateAstrologyValues($initialValue)
    //     {
    //         $results = [];
    //         $currentValue = $initialValue;
    
    //         // Add the initial value with house number fixed to 1
    //         $results[] = [
    //             'value' => $currentValue,
    
    //             'data' => DB::table('zodiac')
    //                         ->where('s_degree', '<=', $currentValue)
    //                         ->where('l_degree', '>=', $currentValue)
    //                         ->first(),
    //             'house_number' => 1, // Fixed house number for initial value
    //         ];
    
    //         for ($i = 1; $i < 12; $i++) { // Start from 1 since initial value is already added
    //             $currentValue = fmod($currentValue + 30.0, 360.0); // Increment and wrap
    
    //             $data = DB::table('zodiac')
    //                       ->where('s_degree', '<=', $currentValue)
    //                       ->where('l_degree', '>=', $currentValue)
    //                       ->first();
    //             // Calculate house number based on index (1-12)
    //             $houseNumber = ($i % 12) + 1;
    
    //             $results[] = [
    //                 'value' => $currentValue,
    //                 'data' => $data,
    //                 'house_number' => $houseNumber,
    //             ];
    //         }
    //         return $results;
    //     }
    
    // }
    
}
