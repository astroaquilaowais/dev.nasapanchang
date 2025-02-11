<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kundali extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'country', 'state', 'city', 'locality', 'pin', 'dob', 'ayan_name', 'cst', 'juliyan', 
        'lmt_birthtime', 'gmt_birthtime', 'subtime', 'dst', 'timedifference', 'timezone', 'ayan', 
        'choice', 'sub_choice', 'tob', 'gmt', 'lmt', 'latitude', 'longitude', 
        'saryana_dms_ascendant', 'saryana_dms_sun', 'saryana_dms_moon', 'saryana_dms_mercury', 
        'saryana_dms_venus', 'saryana_dms_mars', 'saryana_dms_juipter', 'saryana_dms_saturn', 
        'saryana_dms_rahu', 'saryana_dms_ketu', 'nirayana_dms_ascendant', 'nirayana_dms_sun', 
        'nirayana_dms_moon', 'nirayana_dms_mercury', 'nirayana_dms_venus', 'nirayana_dms_mars', 
        'nirayana_dms_juipter', 'nirayana_dms_saturn', 'nirayana_dms_rahu', 'nirayana_dms_ketu', 
        'sary_degree_ascendant', 'sary_degree_sun', 'sary_degree_moon', 'sary_degree_mercury', 
        'sary_degree_venus', 'sary_degree_mars', 'sary_degree_juipter', 'sary_degree_saturn', 
        'sary_degree_rahu', 'sary_degree_ketu', 'niray_degree_ascendant', 'niray_degree_sun', 
        'niray_degree_moon', 'niray_degree_mercury', 'niray_degree_venus', 'niray_degree_mars', 
        'niray_degree_juipter', 'niray_degree_saturn', 'niray_degree_rahu', 'niray_degree_ketu',
        'sunRiseYesterday', 'sunSetYesterday', 'sunRiseTomorrow', 'sunSetTomorrow', 'sunRiseToday', 
        'sunSetToday', 'moonRiseYesterday', 'moonSetYesterday', 'moonRiseTomorrow', 'moonSetTomorrow', 
        'moonRiseToday', 'moonSetToday', 'planet_selection', 'degree_input', 'starting_degree1', 
        'ending_degree1', 'range1', 'house1', 'starting'
    ];
}
