<?php

namespace App\Http\Controllers;

use App\Models\kundali;
use League\Csv\Writer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use App\Http\Requests\UploadCsvRequest;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvExportController extends Controller
{
    // Download slide 1
    public function downloadSlide1($kundali)
    {
        if (!$kundali) {
            return abort(404); // Handle case when kundali is not found
        }

        $data = [
            ['Label', 'Value'],
            ['Name', $kundali->name],
            ['Date of Birth', $kundali->dob],
            ['Time of Birth', $kundali->tob],
            ['Birth Place (Country)', $kundali->country],
            ['Birth Place (State)', $kundali->state],
            ['Birth Place (City)', $kundali->city],
            ['Birth Place (Locality)', $kundali->locality],
            ['Pin', $kundali->pin],
            ['Latitude', $kundali->latitude],
            ['Longitude', $kundali->longitude],
            ['GMT Birth Time', $kundali->gmt],
            ['LMT Birth Time', $kundali->lmt],
            ['Sun Rise Yesterday Time', $kundali->sunRiseYesterday],
            ['Sun Set Yesterday Time', $kundali->sunSetYesterday],
            ['Moon Rise Yesterday Time', $kundali->moonRiseYesterday],
            ['Moon Set Yesterday Time', $kundali->moonSetYesterday],
            ['Sun Rise Today Time', $kundali->sunRiseToday],
            ['Sun Set Today Time', $kundali->sunSetToday],
            ['Moon Rise Today Time', $kundali->moonRiseToday],
            ['Moon Set Today Time', $kundali->moonSetToday],
            ['Sun Rise Tomorrow Time', $kundali->sunRiseTomorrow],
            ['Sun Set Tomorrow Time', $kundali->sunSetTomorrow],
            ['Moon Rise Tomorrow Time', $kundali->moonRiseTomorrow],
            ['Moon Set Tomorrow Time', $kundali->moonSetTomorrow],
        ];

        return $this->generateCsv($data, 'slide1.csv');
    }

    // Download slide 2 (empty for now)
    public function downloadSlide2($kundali)
    {
        if (!$kundali) {
            return abort(404); // Handle case when kundali is not found
        }

        $data = [['Label', 'Value']];
        return $this->generateCsv($data, 'slide2.csv');
    }

    // Download slide 3
    public function downloadSlide3($kundali)
    {
        if (!$kundali) {
            return abort(404); // Handle case when kundali is not found
        }

        $data = [['Planet', 'Nirayana Degree', 'Saryana Degree']];
        foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'jupiter', 'saturn', 'rahu', 'ketu'] as $planet) {
            $data[] = [
                $planet,
                $kundali->{'niray_degree_' . $planet},
                $kundali->{'sary_degree_' . $planet},
            ];
        }
        return $this->generateCsv($data, 'slide3.csv');
    }

    // Download slide 4
    public function downloadSlide4($kundali)
    {
        if (!$kundali) {
            return abort(404); // Handle case when kundali is not found
        }

        $data = [['Planet', 'Saryana DMS', 'Nirayana DMS']];
        foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'jupiter', 'saturn', 'rahu', 'ketu'] as $planet) {
            $data[] = [
                $planet,
                $kundali->{'saryana_dms_' . $planet},
                $kundali->{'nirayana_dms_' . $planet},
            ];
        }
        return $this->generateCsv($data, 'slide4.csv');
    }

    // Function to generate and return the CSV response
    private function generateCsv($data, $filename)
    {
        // Creating an in-memory writer instance
        $csv = Writer::createFromString('');

        // Insert headers (if any)
        $csv->insertOne(['Label', 'Value']);  // Adjust as per your needs

        // Add data to CSV
        foreach ($data as $row) {
            $csv->insertOne($row);
        }

        // Return the CSV as a response
        return response((string) $csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-store');
    }
    // Upload CSV function to import kundali data
   
    
    public function uploadCsv( $request)  // Use the custom form request here
    {
        // If validation passes, this code will run
        $file = $request->file('csv_file');
    
        // Read the CSV file
        $csvData = array_map('str_getcsv', file($file->getRealPath()));
        array_shift($csvData); // Remove the header row
    
        // Loop through each row of the CSV file
        foreach ($csvData as $row) {
            $kundali = new Kundali();
    
            // Assuming each index corresponds to a field
            $kundali->name = $row[0];
            $kundali->country = $row[1];
            $kundali->state = $row[2];
            $kundali->city = $row[3];
            $kundali->locality = $row[4];
            $kundali->pin = $row[5];
            $kundali->dob = $row[6];
            $kundali->tob = $row[7];
            $kundali->gmt = $row[8];
            $kundali->lmt = $row[9];
    
            $kundali->sunRiseYesterday = $row[10];
            $kundali->sunSetYesterday = $row[11];
            $kundali->sunRiseToday = $row[12];
            $kundali->sunSetToday = $row[13];
            $kundali->sunRiseTomorrow = $row[14];
            $kundali->sunSetTomorrow = $row[15];
    
            $kundali->moonRiseYesterday = $row[16];
            $kundali->moonSetYesterday = $row[17];
            $kundali->moonRiseToday = $row[18];
            $kundali->moonSetToday = $row[19];
            $kundali->moonRiseTomorrow = $row[20];
            $kundali->moonSetTomorrow = $row[21];
    
            $kundali->nirayana_dms_ascendant = $row[22];
            $kundali->nirayana_dms_sun = $row[23];
            $kundali->nirayana_dms_moon = $row[24];
            $kundali->nirayana_dms_mercury = $row[25];
            $kundali->nirayana_dms_venus = $row[26];
            $kundali->nirayana_dms_mars = $row[27];
            $kundali->nirayana_dms_juipter = $row[28];
            $kundali->nirayana_dms_saturn = $row[29];
            $kundali->nirayana_dms_rahu = $row[30];
            $kundali->nirayana_dms_ketu = $row[31];
    
            // Save the data to the database
            $kundali->save();
        }
    
        return redirect()->route('kundalis.index')->with('success', 'Kundalis imported successfully.');
    }
    


    // Download all Kundalis as CSV
    public function downloadCsv($kundali)
    {
        $kundalis = Kundali::all();

        // Create a CSV Writer instance
        $csv = Writer::createFromString('');

        // Insert header
        $csv->insertOne([
            'name',
            'country',
            'state',
            'city',
            'locality',
            'pin',
            'dob',
            'tob',
            'gmt',
            'lmt',
            'latitude',
            'longitude',
            'sun_rise_yesterday',
            'sun_set_yesterday',
            'sun_rise_today',
            'sun_set_today',
            'sun_rise_tomorrow',
            'sun_set_tomorrow',
            'moon_rise_yesterday',
            'moon_set_yesterday',
            'moon_rise_today',
            'moon_set_today',
            'moon_rise_tomorrow',
            'moon_set_tomorrow',
            'nirayana_dms_ascendant',
            'nirayana_dms_sun',
            'nirayana_dms_moon',
            'nirayana_dms_mercury',
            'nirayana_dms_venus',
            'nirayana_dms_mars',
            'nirayana_dms_jupiter',
            'nirayana_dms_saturn',
            'nirayana_dms_rahu',
            'nirayana_dms_ketu',
            'sayana_dms_ascendant',
            'sayana_dms_sun',
            'sayana_dms_moon',
            'sayana_dms_mercury',
            'sayana_dms_venus',
            'sayana_dms_mars',
            'sayana_dms_jupiter',
            'sayana_dms_saturn',
            'sayana_dms_rahu',
            'sayana_dms_ketu',
            'sary_degree_ascendant',
            'sary_degree_sun',
            'sary_degree_moon',
            'sary_degree_mercury',
            'sary_degree_venus',
            'sary_degree_mars',
            'sary_degree_juipter',
            'sary_degree_saturn',
            'sary_degree_rahu',
            'sary_degree_ketu',
            'niray_degree_ascendant',
            'niray_degree_sun',
            'niray_degree_moon',
            'niray_degree_mercury',
            'niray_degree_venus',
            'niray_degree_mars',
            'niray_degree_juipter',
            'niray_degree_saturn',
            'niray_degree_rahu',
            'niray_degree_ketu',
            'ayan_degree_ascendant',
            'ayan_degree_sun',
            'ayan_degree_moon',
            'ayan_degree_mercury',
            'ayan_degree_venus',
            'ayan_degree_mars',
            'ayan_degree_juipter',
            'ayan_degree_saturn',
            'ayan_degree_rahu',
            'ayan_degree_ketu'
        ]);

        // Insert data
        foreach ($kundalis as $kundali) {
            $csv->insertOne([
                $kundali->name,
                $kundali->country,
                $kundali->state,
                $kundali->city,
                $kundali->locality,
                $kundali->pin,
                $kundali->dob,
                $kundali->tob,
                $kundali->gmt,
                $kundali->lmt,
                $kundali->latitude,
                $kundali->longitude,
                $kundali->sunRiseYesterday,
                $kundali->sunSetYesterday,
                $kundali->sunRiseToday,
                $kundali->sunSetToday,
                $kundali->sunRiseTomorrow,
                $kundali->sunSetTomorrow,
                $kundali->moonRiseYesterday,
                $kundali->moonSetYesterday,
                $kundali->moonRiseToday,
                $kundali->moonSetToday,
                $kundali->moonRiseTomorrow,
                $kundali->moonSetTomorrow,
                $kundali->nirayana_dms_ascendant,
                $kundali->nirayana_dms_sun,
                $kundali->nirayana_dms_moon,
                $kundali->nirayana_dms_mercury,
                $kundali->nirayana_dms_venus,
                $kundali->nirayana_dms_mars,
                $kundali->nirayana_dms_juipter,
                $kundali->nirayana_dms_saturn,
                $kundali->nirayana_dms_rahu,
                $kundali->nirayana_dms_ketu,
                $kundali->sayana_dms_ascendant,
                $kundali->sayana_dms_sun,
                $kundali->sayana_dms_moon,
                $kundali->sayana_dms_mercury,
                $kundali->sayana_dms_venus,
                $kundali->sayana_dms_mars,
                $kundali->sayana_dms_juipter,
                $kundali->sayana_dms_saturn,
                $kundali->sayana_dms_rahu,
                $kundali->sayana_dms_ketu,
                $kundali->sary_degree_ascendant,
                $kundali->sary_degree_sun,
                $kundali->sary_degree_moon,
                $kundali->sary_degree_mercury,
                $kundali->sary_degree_venus,
                $kundali->sary_degree_mars,
                $kundali->sary_degree_juipter,
                $kundali->sary_degree_saturn,
                $kundali->sary_degree_rahu,
                $kundali->sary_degree_ketu,
                $kundali->niray_degree_ascendant,
                $kundali->niray_degree_sun,
                $kundali->niray_degree_moon,
                $kundali->niray_degree_mercury,
                $kundali->niray_degree_venus,
                $kundali->niray_degree_mars,
                $kundali->niray_degree_juipter,
                $kundali->niray_degree_saturn,
                $kundali->niray_degree_rahu,
                $kundali->niray_degree_ketu,
                $kundali->ayan_degree_ascendant,
                $kundali->ayan_degree_sun,
                $kundali->ayan_degree_moon,
                $kundali->ayan_degree_mercury,
                $kundali->ayan_degree_venus,
                $kundali->ayan_degree_mars,
                $kundali->ayan_degree_juipter,
                $kundali->ayan_degree_saturn,
                $kundali->ayan_degree_rahu,
                $kundali->ayan_degree_ketu
            ]);
        }

        // Return the response for download
        return response((string) $csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="kundalis.csv"');
    }
}
