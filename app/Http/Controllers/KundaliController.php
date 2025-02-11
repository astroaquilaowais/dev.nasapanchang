<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\PositionHelper;
use Illuminate\Http\Request;
use App\Models\Kundali;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class KundaliController extends Controller
{
    public function index()
    {
        $kundalis = Kundali::orderBy('id')->cursorpaginate(10);
        // $house = $this->get_data();

        return view('kundalis.list', ['kundalis' => $kundalis]);
    }

    public function create()
    {
        return view('kundalis.create');
    }
    public function upload()
    {
        return view('kundalis.upload');
    }

    public function store(Request $request)
    {


        //    if(!empty($request->image)){
        //         $rules['image']='image';
        //    }
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'locality' => 'required|string|max:100',
            'pin' => 'nullable|string|max:10',
            'dob' => 'required|date',
            'hour' => 'required|integer|min:0|max:12',
            'minute' => 'required|integer|min:0|max:59',
            'second' => 'required|integer|min:0|max:59',
            'tob_ampm' => 'required|string|in:AM,PM',
            'hour_gmt' => 'required|integer|min:0|max:12',
            'minute_gmt' => 'required|integer|min:0|max:59',
            'second_gmt' => 'required|integer|min:0|max:59',
            'gmt_ampm' => 'required|string|in:AM,PM',
            'hour_lmt' => 'required|integer|min:0|max:12',
            'minute_lmt' => 'required|integer|min:0|max:59',
            'second_lmt' => 'required|integer|min:0|max:59',
            'lmt_ampm' => 'required|string|in:AM,PM',
            'latitude_plusminus' => 'required|string|in:+,-',
            'latitude' => 'required|string|min:0|max:360',
            'latitude_direction' => 'required|string|in:North,South',
            'longitude_plusminus' => 'required|string|in:+,-',
            'longitude' => 'required|string|min:0|max:360',
            'longitude_direction' => 'required|string|in:East,West',

            'lmt_birth_hour' => 'required|integer|min:0|max:12',
            'lmt_birth_minute' => 'required|integer|min:0|max:59',
            'lmt_birth_second' => 'required|integer|min:0|max:59',
            'lmt_birth_ampm' => 'required|in:AM,PM', // Validate AM/PM
            'lmt_birth_date' => 'required|date', // Assuming you need a date format
            'lmt_birth_direction' => 'required|string', // Add appropriate validation

            'gmt_birth_hour' => 'required|integer|min:0|max:12',
            'gmt_birth_minute' => 'required|integer|min:0|max:59',
            'gmt_birth_second' => 'required|integer|min:0|max:59',
            'gmt_birth_ampm' => 'required|string|in:AM,PM',
            'gmt_birth_date' => 'required|date',
            'gmt_birth_direction' => 'required|string',

            'subtime_plusminus' => 'required|string|in:+,-',
            'hour_subtime' => 'required|integer|min:0|max:12',
            'minute_subtime' => 'required|integer|min:0|max:59',
            'second_subtime' => 'required|integer|min:0|max:59',

            'timedifference_plusminus' => 'required|string|in:+,-',
            'hour_timedifference' => 'required|integer|min:0|max:12',
            'minute_timedifference' => 'required|integer|min:0|max:59',
            'second_timedifference' => 'required|integer|min:0|max:59',


            'dst_plusminus' => 'required|string|in:+,-',
            'hour_dst' => 'required|integer|min:0|max:12',
            'minute_dst' => 'required|integer|min:0|max:59',
            'second_dst' => 'required|integer|min:0|max:59',

            'timezone_time' => 'required|date_format:H:i',
            'timezone_plusminus' => 'required|string|in:+,-',

            'cst' => 'required|string|min:0|max:360',
            'juliyan' => 'required|string',

            'ayan_degree' => 'required|numeric|between:0,360',
            'ayan_minute' => 'required|numeric|min:0|max:59',
            'ayan_second' => 'required|numeric|min:0|max:59',

            'ayan_name' => 'required|string|max:100',

            // Sun Rise/Set Yesterday
            'sun_rise_yesterday_hour' => 'required|integer|between:0,12',
            'sun_rise_yesterday_minute' => 'required|integer|between:0,59',
            'sun_rise_yesterday_second' => 'required|integer|between:0,59',
            'sun_rise_yesterday_ampm' => 'required|string|in:AM,PM',
            'sun_set_yesterday_hour' => 'required|integer|between:0,12',
            'sun_set_yesterday_minute' => 'required|integer|between:0,59',
            'sun_set_yesterday_second' => 'required|integer|between:0,59',
            'sun_set_yesterday_ampm' => 'required|string|in:AM,PM',

            // Sun Rise/Set Today
            'sun_rise_today_hour' => 'required|integer|between:0,12',
            'sun_rise_today_minute' => 'required|integer|between:0,59',
            'sun_rise_today_second' => 'required|integer|between:0,59',
            'sun_rise_today_ampm' => 'required|string|in:AM,PM',
            'sun_set_today_hour' => 'required|integer|between:0,12',
            'sun_set_today_minute' => 'required|integer|between:0,59',
            'sun_set_today_second' => 'required|integer|between:0,59',
            'sun_set_today_ampm' => 'required|string|in:AM,PM',

            // Sun Rise/Set Tomorrow
            'sun_rise_tomorrow_hour' => 'required|integer|between:0,12',
            'sun_rise_tomorrow_minute' => 'required|integer|between:0,59',
            'sun_rise_tomorrow_second' => 'required|integer|between:0,59',
            'sun_rise_tomorrow_ampm' => 'required|string|in:AM,PM',
            'sun_set_tomorrow_hour' => 'required|integer|between:0,12',
            'sun_set_tomorrow_minute' => 'required|integer|between:0,59',
            'sun_set_tomorrow_second' => 'required|integer|between:0,59',
            'sun_set_tomorrow_ampm' => 'required|string|in:AM,PM',

            // Moon Rise/Set Yesterday
            'moon_rise_yesterday_hour' => 'required|integer|between:0,12',
            'moon_rise_yesterday_minute' => 'required|integer|between:0,59',
            'moon_rise_yesterday_second' => 'required|integer|between:0,59',
            'moon_rise_yesterday_ampm' => 'required|string|in:AM,PM',
            'moon_set_yesterday_hour' => 'required|integer|between:0,12',
            'moon_set_yesterday_minute' => 'required|integer|between:0,59',
            'moon_set_yesterday_second' => 'required|integer|between:0,59',
            'moon_set_yesterday_ampm' => 'required|string|in:AM,PM',

            // Moon Rise/Set Today
            'moon_rise_today_hour' => 'required|integer|between:0,12',
            'moon_rise_today_minute' => 'required|integer|between:0,59',
            'moon_rise_today_second' => 'required|integer|between:0,59',
            'moon_rise_today_ampm' => 'required|string|in:AM,PM',
            'moon_set_today_hour' => 'required|integer|between:0,12',
            'moon_set_today_minute' => 'required|integer|between:0,59',
            'moon_set_today_second' => 'required|integer|between:0,59',
            'moon_set_today_ampm' => 'required|string|in:AM,PM',

            // Moon Rise/Set Tomorrow
            'moon_rise_tomorrow_hour' => 'required|integer|between:0,12',
            'moon_rise_tomorrow_minute' => 'required|integer|between:0,59',
            'moon_rise_tomorrow_second' => 'required|integer|between:0,59',
            'moon_rise_tomorrow_ampm' => 'required|string|in:AM,PM',
            'moon_set_tomorrow_hour' => 'required|integer|between:0,12',
            'moon_set_tomorrow_minute' => 'required|integer|between:0,59',
            'moon_set_tomorrow_second' => 'required|integer|between:0,59',
            'moon_set_tomorrow_ampm' => 'required|string|in:AM,PM',




            'choice' => 'required|string|in:degree,dms',
            'sub_choice' => 'required|string|in:niray_degree,sary_degree,saryana_dms,nirayana_dms',

            // Saryana Degree Fields
            'saryana_degree_ascendant' => 'nullable|numeric|between:0,360',
            'saryana_degree_sun' => 'nullable|numeric|between:0,360',
            'saryana_degree_moon' => 'nullable|numeric|between:0,360',
            'saryana_degree_mercury' => 'nullable|numeric|between:0,360',
            'saryana_degree_venus' => 'nullable|numeric|between:0,360',
            'saryana_degree_mars' => 'nullable|numeric|between:0,360',
            'saryana_degree_juipter' => 'nullable|numeric|between:0,360',
            'saryana_degree_saturn' => 'nullable|numeric|between:0,360',
            'saryana_degree_rahu' => 'nullable|numeric|between:0,360',
            'saryana_degree_ketu' => 'nullable|numeric|between:0,360',

            // Saryana Minute Fields
            'saryana_minute_ascendant' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_sun' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_moon' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_mercury' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_venus' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_mars' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_juipter' => 'nullable|numeric|between:0,59',
            'saryana_minute_saturn' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_rahu' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_ketu' => 'nullable|numeric|min:0|max:59',

            // Saryana Second Fields
            'saryana_second_ascendant' => 'nullable|numeric|min:0|max:59',
            'saryana_second_sun' => 'nullable|numeric|min:0|max:59',
            'saryana_second_moon' => 'nullable|numeric|min:0|max:59',
            'saryana_second_mercury' => 'nullable|numeric|min:0|max:59',
            'saryana_second_venus' => 'nullable|numeric|min:0|max:59',
            'saryana_second_mars' => 'nullable|numeric|min:0|max:59',
            'saryana_second_juipter' => 'nullable|numeric|between:0,59',
            'saryana_second_saturn' => 'nullable|numeric|min:0|max:59',
            'saryana_second_rahu' => 'nullable|numeric|min:0|max:59',
            'saryana_second_ketu' => 'nullable|numeric|min:0|max:59',




            // nirayana Degree Fields
            'nirayana_degree_ascendant' => 'nullable|numeric|between:0,360',
            'nirayana_degree_sun' => 'nullable|numeric|between:0,360',
            'nirayana_degree_moon' => 'nullable|numeric|between:0,360',
            'nirayana_degree_mercury' => 'nullable|numeric|between:0,360',
            'nirayana_degree_venus' => 'nullable|numeric|between:0,360',
            'nirayana_degree_mars' => 'nullable|numeric|between:0,360',
            'nirayana_degree_juipter' => 'nullable|numeric|between:0,360',
            'nirayana_degree_saturn' => 'nullable|numeric|between:0,360',
            'nirayana_degree_rahu' => 'nullable|numeric|between:0,360',
            'nirayana_degree_ketu' => 'nullable|numeric|between:0,360',

            // nirayana Minute Fields
            'nirayana_minute_ascendant' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_sun' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_moon' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_mercury' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_venus' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_mars' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_juipter' => 'nullable|numeric|between:0,59',
            'nirayana_minute_saturn' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_rahu' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_ketu' => 'nullable|numeric|min:0|max:59',

            // nirayana Second Fields
            'nirayana_second_ascendant' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_sun' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_moon' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_mercury' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_venus' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_mars' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_juipter' => 'nullable|numeric|between:0,59',
            'nirayana_second_saturn' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_rahu' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_ketu' => 'nullable|numeric|min:0|max:59',


            // Saryana Degree Fields
            'sary_degree_ascendant' => 'nullable|numeric|min:0|max:360',
            'sary_degree_sun' => 'nullable|numeric|min:0|max:360',
            'sary_degree_moon' => 'nullable|numeric|min:0|max:360',
            'sary_degree_mercury' => 'nullable|numeric|min:0|max:360',
            'sary_degree_venus' => 'nullable|numeric|min:0|max:360',
            'sary_degree_mars' => 'nullable|numeric|min:0|max:360',
            'sary_degree_juipter' => 'nullable|numeric|min:0|max:360',
            'sary_degree_saturn' => 'nullable|numeric|min:0|max:360',
            'sary_degree_rahu' => 'nullable|numeric|min:0|max:360',
            'sary_degree_ketu' => 'nullable|numeric|min:0|max:360',

            // nirayana Degree Fields
            'niray_degree_ascendant' => 'nullable|numeric|min:0|max:360',
            'niray_degree_sun' => 'nullable|numeric|min:0|max:360',
            'niray_degree_moon' => 'nullable|numeric|min:0|max:360',
            'niray_degree_mercury' => 'nullable|numeric|min:0|max:360',
            'niray_degree_venus' => 'nullable|numeric|min:0|max:360',
            'niray_degree_mars' => 'nullable|numeric|min:0|max:360',
            'niray_degree_juipter' => 'nullable|numeric|min:0|max:360',
            'niray_degree_saturn' => 'nullable|numeric|min:0|max:360',
            'niray_degree_rahu' => 'nullable|numeric|min:0|max:360',
            'niray_degree_ketu' => 'nullable|numeric|min:0|max:360',

            // Validation for Planet Degree Range
            'planet_selection' => 'required|string',
            'degree_input' => 'required|numeric|min:0|max:360',

            'starting_degree1' => 'nullable|numeric|min:0|max:360',
            'ending_degree1' => 'nullable|numeric|min:0|max:360',
            'range1' => 'nullable|numeric|min:0|max:360',
            'house1' => 'nullable|numeric|min:0|max:12',
            'starting_degree2' => 'nullable|numeric|min:0|max:360',
            'ending_degree2' => 'nullable|numeric|min:0|max:360',
            'range2' => 'nullable|numeric|min:0|max:360',
            'house2' => 'nullable|numeric|min:0|max:12',
            'starting_degree3' => 'nullable|numeric|min:0|max:360',
            'ending_degree3' => 'nullable|numeric|min:0|max:360',
            'range3' => 'nullable|numeric|min:0|max:360',
            'house3' => 'nullable|numeric|min:0|max:12',
            'starting_degree4' => 'nullable|numeric|min:0|max:360',
            'ending_degree4' => 'nullable|numeric|min:0|max:360',
            'range4' => 'nullable|numeric|min:0|max:360',
            'house4' => 'nullable|numeric|min:0|max:12',
            'starting_degree5' => 'nullable|numeric|min:0|max:360',
            'ending_degree5' => 'nullable|numeric|min:0|max:360',
            'range5' => 'nullable|numeric|min:0|max:360',
            'house5' => 'nullable|numeric|min:0|max:12',
            'starting_degree6' => 'nullable|numeric|min:0|max:360',
            'ending_degree6' => 'nullable|numeric|min:0|max:360',
            'range6' => 'nullable|numeric|min:0|max:360',
            'house6' => 'nullable|numeric|min:0|max:12',
            'starting_degree7' => 'nullable|numeric|min:0|max:360',
            'ending_degree7' => 'nullable|numeric|min:0|max:360',
            'range7' => 'nullable|numeric|min:0|max:360',
            'house7' => 'nullable|numeric|min:0|max:12',
            'starting_degree8' => 'nullable|numeric|min:0|max:360',
            'ending_degree8' => 'nullable|numeric|min:0|max:360',
            'range8' => 'nullable|numeric|min:0|max:360',
            'house8' => 'nullable|numeric|min:0|max:12',
            'starting_degree9' => 'nullable|numeric|min:0|max:360',
            'ending_degree9' => 'nullable|numeric|min:0|max:360',
            'range9 ' => 'nullable|numeric|min:0|max:360',
            'house9' => 'nullable|numeric|min:0|max:12',
            'starting_degree10' => 'nullable|numeric|min:0|max:360',
            'ending_degree10' => 'nullable|numeric|min:0|max:360',
            'range10' => 'nullable|numeric|min:0|max:360',
            'house10' => 'nullable|numeric|min:0|max:12',
            'starting_degree11' => 'nullable|numeric|min:0|max:360',
            'ending_degree11' => 'nullable|numeric|min:0|max:360',
            'range11' => 'nullable|numeric|min:0|max:360',
            'house11' => 'nullable|numeric|min:0|max:12',
            'starting_degree12' => 'nullable|numeric|min:0|max:360',
            'ending_degree12' => 'nullable|numeric|min:0|max:360',
            'range12' => 'nullable|numeric|min:0|max:360',
            'house12' => 'nullable|numeric|min:0|max:12',

        ]);


        if ($validator->fails()) {
            return redirect()->route('kundalis.create')->withInput()->withErrors($validator);
        }


        $kundali = new Kundali();
        $kundali->name = $request->name;
        $kundali->country = $request->country;
        $kundali->state = $request->state;
        $kundali->city = $request->city;
        $kundali->locality = $request->locality;
        $kundali->pin = $request->pin;
        $kundali->dob = $request->dob;
        $kundali->ayan_name = $request->ayan_name;
        $kundali->cst = $request->cst;
        $kundali->juliyan = $request->juliyan;
        // $kundali->housechoice = $request->housechoice;

        $kundali->lmt_birthtime = sprintf('%02d:%02d:%02d %s %s %s', $request->lmt_birth_hour, $request->lmt_birth_minute, $request->lmt_birth_second, $request->lmt_birth_ampm, $request->lmt_birth_date, $request->lmt_birth_direction);

        $kundali->gmt_birthtime = sprintf('%02d:%02d:%02d %s %s %s', $request->gmt_birth_hour, $request->gmt_birth_minute, $request->gmt_birth_second, $request->gmt_birth_ampm, $request->gmt_birth_date, $request->gmt_birth_direction);


        $kundali->subtime = sprintf('%s %d:%d:%d', $request->hour_subtime, $request->minute_subtime, $request->second_subtime, $request->subtime_plusminus);

        $kundali->dst = sprintf('%s %d:%d:%d', $request->dst_plusminus, $request->hour_dst, $request->minute_dst, $request->second_dst);

        $kundali->timedifference = sprintf('%2d:%2d:%2d %s', $request->timedifference_plusminus, $request->hour_timedifference, $request->minute_timedifference, $request->second_timedifference);
        $kundali->timezone = sprintf('%s %s', $request->timezone_plusminus, $request->timezone_time);


        $kundali->ayan = sprintf('%d° %d\' %02d"', $request->ayan_degree, $request->ayan_minute, $request->ayan_second);
        $kundali->choice = $request['choice'];
        $kundali->sub_choice = $request['sub_choice'];

        $kundali->tob = sprintf('%d:%d:%d %s', $request->hour, $request->minute, $request->second, $request->tob_ampm);
        $kundali->gmt = sprintf('%d:%d:%d %s', $request->hour_gmt, $request->minute_gmt, $request->second_gmt, $request->gmt_ampm);
        $kundali->lmt = sprintf('%d:%d:%d %s', $request->hour_lmt, $request->minute_lmt, $request->second_lmt, $request->lmt_ampm);
        $kundali->latitude = sprintf('%s %d %s', $request->latitude_plusminus, $request->latitude, $request->latitude_direction);
        $kundali->longitude = sprintf('%s %d %s', $request->longitude_plusminus, $request->longitude, $request->longitude_direction);
        $kundali->nirayana_dms_ascendant = sprintf('%d° %d\' %02d"', $request->nirayana_degree_ascendant, $request->nirayana_minute_ascendant, $request->nirayana_second_ascendant);
        $kundali->nirayana_dms_sun = sprintf('%d° %d\' %02d"', $request->nirayana_degree_sun, $request->nirayana_minute_sun, $request->nirayana_second_sun);
        $kundali->nirayana_dms_moon = sprintf('%d° %d\' %02d"', $request->nirayana_degree_moon, $request->nirayana_minute_moon, $request->nirayana_second_moon);
        $kundali->nirayana_dms_mercury = sprintf('%d° %d\' %02d"', $request->nirayana_degree_mercury, $request->nirayana_minute_mercury, $request->nirayana_second_mercury);
        $kundali->nirayana_dms_venus = sprintf('%d° %d\' %02d"', $request->nirayana_degree_venus, $request->nirayana_minute_venus, $request->nirayana_second_venus);
        $kundali->nirayana_dms_mars = sprintf('%d° %d\' %02d"', $request->nirayana_degree_mars, $request->nirayana_minute_mars, $request->nirayana_second_mars);
        $kundali->nirayana_dms_juipter = sprintf('%d° %d\' %02d"', $request->nirayana_degree_juipter, $request->nirayana_minute_juipter, $request->nirayana_second_juipter);
        $kundali->nirayana_dms_saturn = sprintf('%d° %d\' %02d"', $request->nirayana_degree_saturn, $request->nirayana_minute_saturn, $request->nirayana_second_saturn);
        $kundali->nirayana_dms_rahu = sprintf('%d° %d\' %02d"', $request->nirayana_degree_rahu, $request->nirayana_minute_rahu, $request->nirayana_second_rahu);
        $kundali->nirayana_dms_ketu = sprintf('%d° %d\' %02d"', $request->nirayana_degree_ketu, $request->nirayana_minute_ketu, $request->nirayana_second_ketu);

        $kundali->saryana_dms_ascendant = sprintf('%d° %d\' %02d"', $request->saryana_degree_ascendant, $request->saryana_minute_ascendant, $request->saryana_second_ascendant);
        $kundali->saryana_dms_sun = sprintf('%d° %d\' %02d"', $request->saryana_degree_sun, $request->saryana_minute_sun, $request->saryana_second_sun);
        $kundali->saryana_dms_moon = sprintf('%d° %d\' %02d"', $request->saryana_degree_moon, $request->saryana_minute_moon, $request->saryana_second_moon);
        $kundali->saryana_dms_mercury = sprintf('%d° %d\' %02d"', $request->saryana_degree_mercury, $request->saryana_minute_mercury, $request->saryana_second_mercury);
        $kundali->saryana_dms_venus = sprintf('%d° %d\' %02d"', $request->saryana_degree_venus, $request->saryana_minute_venus, $request->saryana_second_venus);
        $kundali->saryana_dms_mars = sprintf('%d° %d\' %02d"', $request->saryana_degree_mars, $request->saryana_minute_mars, $request->saryana_second_mars);
        $kundali->saryana_dms_juipter = sprintf('%d° %d\' %02d"', $request->saryana_degree_juipter, $request->saryana_minute_juipter, $request->saryana_second_juipter);
        $kundali->saryana_dms_saturn = sprintf('%d° %d\' %02d"', $request->saryana_degree_saturn, $request->saryana_minute_saturn, $request->saryana_second_saturn);
        $kundali->saryana_dms_rahu = sprintf('%d° %d\' %02d"', $request->saryana_degree_rahu, $request->saryana_minute_rahu, $request->saryana_second_rahu);
        $kundali->saryana_dms_ketu = sprintf('%d° %d\' %02d"', $request->saryana_degree_ketu, $request->saryana_minute_ketu, $request->saryana_second_ketu);



        $kundali->sary_degree_ascendant = $request->sary_degree_ascendant;
        $kundali->sary_degree_sun = $request->sary_degree_sun;
        $kundali->sary_degree_moon = $request->sary_degree_moon;
        $kundali->sary_degree_mercury = $request->sary_degree_mercury;
        $kundali->sary_degree_venus = $request->sary_degree_venus;
        $kundali->sary_degree_mars = $request->sary_degree_mars;
        $kundali->sary_degree_juipter = $request->sary_degree_juipter;
        $kundali->sary_degree_saturn = $request->sary_degree_saturn;
        $kundali->sary_degree_rahu = $request->sary_degree_rahu;
        $kundali->sary_degree_ketu = $request->sary_degree_ketu;

        $kundali->niray_degree_ascendant = $request->niray_degree_ascendant;
        $kundali->niray_degree_sun = $request->niray_degree_sun;
        $kundali->niray_degree_moon = $request->niray_degree_moon;
        $kundali->niray_degree_mercury = $request->niray_degree_mercury;
        $kundali->niray_degree_venus = $request->niray_degree_venus;
        $kundali->niray_degree_mars = $request->niray_degree_mars;
        $kundali->niray_degree_juipter = $request->niray_degree_juipter;
        $kundali->niray_degree_saturn = $request->niray_degree_saturn;
        $kundali->niray_degree_rahu = $request->niray_degree_rahu;
        $kundali->niray_degree_ketu = $request->niray_degree_ketu;


        $kundali->sunRiseYesterday = sprintf('%d:%d:%d %s', $request->sun_rise_yesterday_hour, $request->sun_rise_yesterday_minute, $request->sun_rise_yesterday_second, $request->sun_rise_yesterday_ampm);
        $kundali->sunSetYesterday = sprintf('%d:%d:%d %s', $request->sun_set_yesterday_hour, $request->sun_set_yesterday_minute, $request->sun_set_yesterday_second, $request->sun_set_yesterday_ampm);
        $kundali->sunRiseTomorrow = sprintf('%d:%d:%d %s', $request->sun_rise_tomorrow_hour, $request->sun_rise_tomorrow_minute, $request->sun_rise_tomorrow_second, $request->sun_rise_tomorrow_ampm);
        $kundali->sunSetTomorrow =  sprintf('%d:%d:%d %s', $request->sun_set_tomorrow_hour, $request->sun_set_tomorrow_minute, $request->sun_set_tomorrow_second, $request->sun_set_tomorrow_ampm);
        $kundali->sunRiseToday =  sprintf('%d:%d:%d %s', $request->sun_rise_today_hour, $request->sun_rise_today_minute, $request->sun_rise_today_second, $request->sun_rise_today_ampm);
        $kundali->sunSetToday = sprintf('%d:%d:%d %s', $request->sun_set_today_hour, $request->sun_set_today_minute, $request->sun_set_today_second, $request->sun_set_today_ampm);

        $kundali->moonRiseYesterday = sprintf('%d:%d:%d %s', $request->moon_rise_yesterday_hour, $request->moon_rise_yesterday_minute, $request->moon_rise_yesterday_second, $request->moon_rise_yesterday_ampm);
        $kundali->moonSetYesterday = sprintf('%d:%d:%d %s', $request->moon_set_yesterday_hour, $request->moon_set_yesterday_minute, $request->moon_set_yesterday_second, $request->moon_set_yesterday_ampm);
        $kundali->moonRiseTomorrow = sprintf('%d:%d:%d %s', $request->moon_rise_tomorrow_hour, $request->moon_rise_tomorrow_minute, $request->moon_rise_tomorrow_second, $request->moon_rise_tomorrow_ampm);
        $kundali->moonSetTomorrow =  sprintf('%d:%d:%d %s', $request->moon_set_tomorrow_hour, $request->moon_set_tomorrow_minute, $request->moon_set_tomorrow_second, $request->moon_set_tomorrow_ampm);
        $kundali->moonRiseToday =  sprintf('%d:%d:%d %s', $request->moon_rise_today_hour, $request->moon_rise_today_minute, $request->moon_rise_today_second, $request->moon_rise_today_ampm);
        $kundali->moonSetToday = sprintf('%d:%d:%d %s', $request->moon_set_today_hour, $request->moon_set_today_minute, $request->moon_set_today_second, $request->moon_set_today_ampm);

        $kundali->planet_selection = $request->planet_selection;
        $kundali->degree_input = $request->degree_input;
        $kundali->starting_degree1 = $request->starting_degree1;
        $kundali->ending_degree1 = $request->ending_degree1;
        $kundali->range1 = $request->range1;
        $kundali->house1 = $request->house1;
        $kundali->starting_degree2 = $request->starting_degree2;
        $kundali->ending_degree2 = $request->ending_degree2;
        $kundali->range2 = $request->range2;
        $kundali->house2 = $request->house2;
        $kundali->starting_degree3 = $request->starting_degree3;
        $kundali->ending_degree3 = $request->ending_degree3;
        $kundali->range3 = $request->range3;
        $kundali->house3 = $request->house3;
        $kundali->starting_degree4 = $request->starting_degree4;
        $kundali->ending_degree4 = $request->ending_degree4;
        $kundali->range4 = $request->range4;
        $kundali->house4 = $request->house4;
        $kundali->starting_degree5 = $request->starting_degree5;
        $kundali->ending_degree5 = $request->ending_degree5;
        $kundali->range5 = $request->range5;
        $kundali->house5 = $request->house5;
        $kundali->starting_degree6 = $request->starting_degree6;
        $kundali->ending_degree6 = $request->ending_degree6;
        $kundali->range6 = $request->range6;
        $kundali->house6 = $request->house6;
        $kundali->starting_degree7 = $request->starting_degree7;
        $kundali->ending_degree7 = $request->ending_degree7;
        $kundali->range7 = $request->range7;
        $kundali->house7 = $request->house7;
        $kundali->starting_degree8 = $request->starting_degree8;
        $kundali->ending_degree8 = $request->ending_degree8;
        $kundali->range8 = $request->range8;
        $kundali->house8 = $request->house8;
        $kundali->starting_degree9 = $request->starting_degree9;
        $kundali->ending_degree9 = $request->ending_degree9;
        $kundali->range9 = $request->range9;
        $kundali->house9 = $request->house9;
        $kundali->starting_degree10 = $request->starting_degree10;
        $kundali->ending_degree10 = $request->ending_degree10;
        $kundali->range10 = $request->range10;
        $kundali->house10 = $request->house10;
        $kundali->starting_degree11 = $request->starting_degree11;
        $kundali->ending_degree11 = $request->ending_degree11;
        $kundali->range11 = $request->range11;
        $kundali->house11 = $request->house11;
        $kundali->starting_degree12 = $request->starting_degree12;
        $kundali->ending_degree12 = $request->ending_degree12;
        $kundali->range12 = $request->range12;
        $kundali->house12 = $request->house12;

        // Save the main kundali object
        $kundali->save();

        // var_dump($kundali);
        // die;
        return redirect()->route('kundalis.index')->with('success', 'kundali Added Successfully.');
    }
    public function edit($id)
    {
        // Find the Kundali record by ID
        $kundali = Kundali::findOrFail($id);

        // Return the edit view with the Kundali data
        return view('kundalis.edit')->with('kundali', $kundali);
    }
    public function update(Request $request, $id)
    {
        // Find the Kundali record by ID
        $kundali = Kundali::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'locality' => 'required|string|max:100',
            'pin' => 'nullable|string|max:10',
            'dob' => 'required|date',
            'hour' => 'required|integer|min:0|max:12',
            'minute' => 'required|integer|min:0|max:59',
            'second' => 'required|integer|min:0|max:59',
            'tob_ampm' => 'required|string|in:AM,PM',
            'hour_gmt' => 'required|integer|min:0|max:12',
            'minute_gmt' => 'required|integer|min:0|max:59',
            'second_gmt' => 'required|integer|min:0|max:59',
            'gmt_ampm' => 'required|string|in:AM,PM',
            'hour_lmt' => 'required|integer|min:0|max:12',
            'minute_lmt' => 'required|integer|min:0|max:59',
            'second_lmt' => 'required|integer|min:0|max:59',
            'lmt_ampm' => 'required|string|in:AM,PM',
            'latitude_plusminus' => 'required|string|in:+,-',
            'latitude' => 'required|string|min:0|max:360',
            'latitude_direction' => 'required|string|in:North,South',
            'longitude_plusminus' => 'required|string|in:+,-',
            'longitude' => 'required|string|min:0|max:360',
            'longitude_direction' => 'required|string|in:East,West',

            'lmt_birth_hour' => 'required|integer|min:0|max:12',
            'lmt_birth_minute' => 'required|integer|min:0|max:59',
            'lmt_birth_second' => 'required|integer|min:0|max:59',
            'lmt_birth_ampm' => 'required|in:AM,PM', // Validate AM/PM
            'lmt_birth_date' => 'required|date', // Assuming you need a date format
            'lmt_birth_direction' => 'required|string', // Add appropriate validation

            'gmt_birth_hour' => 'required|integer|min:0|max:12',
            'gmt_birth_minute' => 'required|integer|min:0|max:59',
            'gmt_birth_second' => 'required|integer|min:0|max:59',
            'gmt_birth_ampm' => 'required|string|in:AM,PM',
            'gmt_birth_date' => 'required|date',
            'gmt_birth_direction' => 'required|string',

            'subtime_plusminus' => 'required|string|in:+,-',
            'hour_subtime' => 'required|integer|min:0|max:12',
            'minute_subtime' => 'required|integer|min:0|max:59',
            'second_subtime' => 'required|integer|min:0|max:59',

            'timedifference_plusminus' => 'required|string|in:+,-',
            'hour_timedifference' => 'required|integer|min:0|max:12',
            'minute_timedifference' => 'required|integer|min:0|max:59',
            'second_timedifference' => 'required|integer|min:0|max:59',


            'dst_plusminus' => 'required|string|in:+,-',
            'hour_dst' => 'required|integer|min:0|max:12',
            'minute_dst' => 'required|integer|min:0|max:59',
            'second_dst' => 'required|integer|min:0|max:59',

            'timezone_time' => 'required|date_format:H:i',
            'timezone_plusminus' => 'required|string|in:+,-',

            'cst' => 'required|string|min:0|max:360',
            'juliyan' => 'required|string',

            'ayan_degree' => 'required|numeric|between:0,360',
            'ayan_minute' => 'required|numeric|min:0|max:59',
            'ayan_second' => 'required|numeric|min:0|max:59',

            'ayan_name' => 'required|string|max:100',

            // Sun Rise/Set Yesterday
            'sun_rise_yesterday_hour' => 'required|integer|between:0,12',
            'sun_rise_yesterday_minute' => 'required|integer|between:0,59',
            'sun_rise_yesterday_second' => 'required|integer|between:0,59',
            'sun_rise_yesterday_ampm' => 'required|string|in:AM,PM',
            'sun_set_yesterday_hour' => 'required|integer|between:0,12',
            'sun_set_yesterday_minute' => 'required|integer|between:0,59',
            'sun_set_yesterday_second' => 'required|integer|between:0,59',
            'sun_set_yesterday_ampm' => 'required|string|in:AM,PM',

            // Sun Rise/Set Today
            'sun_rise_today_hour' => 'required|integer|between:0,12',
            'sun_rise_today_minute' => 'required|integer|between:0,59',
            'sun_rise_today_second' => 'required|integer|between:0,59',
            'sun_rise_today_ampm' => 'required|string|in:AM,PM',
            'sun_set_today_hour' => 'required|integer|between:0,12',
            'sun_set_today_minute' => 'required|integer|between:0,59',
            'sun_set_today_second' => 'required|integer|between:0,59',
            'sun_set_today_ampm' => 'required|string|in:AM,PM',

            // Sun Rise/Set Tomorrow
            'sun_rise_tomorrow_hour' => 'required|integer|between:0,12',
            'sun_rise_tomorrow_minute' => 'required|integer|between:0,59',
            'sun_rise_tomorrow_second' => 'required|integer|between:0,59',
            'sun_rise_tomorrow_ampm' => 'required|string|in:AM,PM',
            'sun_set_tomorrow_hour' => 'required|integer|between:0,12',
            'sun_set_tomorrow_minute' => 'required|integer|between:0,59',
            'sun_set_tomorrow_second' => 'required|integer|between:0,59',
            'sun_set_tomorrow_ampm' => 'required|string|in:AM,PM',

            // Moon Rise/Set Yesterday
            'moon_rise_yesterday_hour' => 'required|integer|between:0,12',
            'moon_rise_yesterday_minute' => 'required|integer|between:0,59',
            'moon_rise_yesterday_second' => 'required|integer|between:0,59',
            'moon_rise_yesterday_ampm' => 'required|string|in:AM,PM',
            'moon_set_yesterday_hour' => 'required|integer|between:0,12',
            'moon_set_yesterday_minute' => 'required|integer|between:0,59',
            'moon_set_yesterday_second' => 'required|integer|between:0,59',
            'moon_set_yesterday_ampm' => 'required|string|in:AM,PM',

            // Moon Rise/Set Today
            'moon_rise_today_hour' => 'required|integer|between:0,12',
            'moon_rise_today_minute' => 'required|integer|between:0,59',
            'moon_rise_today_second' => 'required|integer|between:0,59',
            'moon_rise_today_ampm' => 'required|string|in:AM,PM',
            'moon_set_today_hour' => 'required|integer|between:0,12',
            'moon_set_today_minute' => 'required|integer|between:0,59',
            'moon_set_today_second' => 'required|integer|between:0,59',
            'moon_set_today_ampm' => 'required|string|in:AM,PM',

            // Moon Rise/Set Tomorrow
            'moon_rise_tomorrow_hour' => 'required|integer|between:0,12',
            'moon_rise_tomorrow_minute' => 'required|integer|between:0,59',
            'moon_rise_tomorrow_second' => 'required|integer|between:0,59',
            'moon_rise_tomorrow_ampm' => 'required|string|in:AM,PM',
            'moon_set_tomorrow_hour' => 'required|integer|between:0,12',
            'moon_set_tomorrow_minute' => 'required|integer|between:0,59',
            'moon_set_tomorrow_second' => 'required|integer|between:0,59',
            'moon_set_tomorrow_ampm' => 'required|string|in:AM,PM',




            'choice' => 'required|string|in:degree,dms',
            'sub_choice' => 'required|string|in:niray_degree,sary_degree,saryana_dms,nirayana_dms',

            // Saryana Degree Fields
            'saryana_degree_ascendant' => 'nullable|numeric|between:0,360',
            'saryana_degree_sun' => 'nullable|numeric|between:0,360',
            'saryana_degree_moon' => 'nullable|numeric|between:0,360',
            'saryana_degree_mercury' => 'nullable|numeric|between:0,360',
            'saryana_degree_venus' => 'nullable|numeric|between:0,360',
            'saryana_degree_mars' => 'nullable|numeric|between:0,360',
            'saryana_degree_juipter' => 'nullable|numeric|between:0,360',
            'saryana_degree_saturn' => 'nullable|numeric|between:0,360',
            'saryana_degree_rahu' => 'nullable|numeric|between:0,360',
            'saryana_degree_ketu' => 'nullable|numeric|between:0,360',

            // Saryana Minute Fields
            'saryana_minute_ascendant' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_sun' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_moon' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_mercury' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_venus' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_mars' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_juipter' => 'nullable|numeric|between:0,59',
            'saryana_minute_saturn' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_rahu' => 'nullable|numeric|min:0|max:59',
            'saryana_minute_ketu' => 'nullable|numeric|min:0|max:59',

            // Saryana Second Fields
            'saryana_second_ascendant' => 'nullable|numeric|min:0|max:59',
            'saryana_second_sun' => 'nullable|numeric|min:0|max:59',
            'saryana_second_moon' => 'nullable|numeric|min:0|max:59',
            'saryana_second_mercury' => 'nullable|numeric|min:0|max:59',
            'saryana_second_venus' => 'nullable|numeric|min:0|max:59',
            'saryana_second_mars' => 'nullable|numeric|min:0|max:59',
            'saryana_second_juipter' => 'nullable|numeric|between:0,59',
            'saryana_second_saturn' => 'nullable|numeric|min:0|max:59',
            'saryana_second_rahu' => 'nullable|numeric|min:0|max:59',
            'saryana_second_ketu' => 'nullable|numeric|min:0|max:59',




            // nirayana Degree Fields
            'nirayana_degree_ascendant' => 'nullable|numeric|between:0,360',
            'nirayana_degree_sun' => 'nullable|numeric|between:0,360',
            'nirayana_degree_moon' => 'nullable|numeric|between:0,360',
            'nirayana_degree_mercury' => 'nullable|numeric|between:0,360',
            'nirayana_degree_venus' => 'nullable|numeric|between:0,360',
            'nirayana_degree_mars' => 'nullable|numeric|between:0,360',
            'nirayana_degree_juipter' => 'nullable|numeric|between:0,360',
            'nirayana_degree_saturn' => 'nullable|numeric|between:0,360',
            'nirayana_degree_rahu' => 'nullable|numeric|between:0,360',
            'nirayana_degree_ketu' => 'nullable|numeric|between:0,360',

            // nirayana Minute Fields
            'nirayana_minute_ascendant' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_sun' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_moon' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_mercury' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_venus' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_mars' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_juipter' => 'nullable|numeric|between:0,59',
            'nirayana_minute_saturn' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_rahu' => 'nullable|numeric|min:0|max:59',
            'nirayana_minute_ketu' => 'nullable|numeric|min:0|max:59',

            // nirayana Second Fields
            'nirayana_second_ascendant' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_sun' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_moon' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_mercury' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_venus' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_mars' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_juipter' => 'nullable|numeric|between:0,59',
            'nirayana_second_saturn' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_rahu' => 'nullable|numeric|min:0|max:59',
            'nirayana_second_ketu' => 'nullable|numeric|min:0|max:59',


            // Saryana Degree Fields
            'sary_degree_ascendant' => 'nullable|numeric|min:0|max:360',
            'sary_degree_sun' => 'nullable|numeric|min:0|max:360',
            'sary_degree_moon' => 'nullable|numeric|min:0|max:360',
            'sary_degree_mercury' => 'nullable|numeric|min:0|max:360',
            'sary_degree_venus' => 'nullable|numeric|min:0|max:360',
            'sary_degree_mars' => 'nullable|numeric|min:0|max:360',
            'sary_degree_juipter' => 'nullable|numeric|min:0|max:360',
            'sary_degree_saturn' => 'nullable|numeric|min:0|max:360',
            'sary_degree_rahu' => 'nullable|numeric|min:0|max:360',
            'sary_degree_ketu' => 'nullable|numeric|min:0|max:360',

            // nirayana Degree Fields
            'niray_degree_ascendant' => 'nullable|numeric|min:0|max:360',
            'niray_degree_sun' => 'nullable|numeric|min:0|max:360',
            'niray_degree_moon' => 'nullable|numeric|min:0|max:360',
            'niray_degree_mercury' => 'nullable|numeric|min:0|max:360',
            'niray_degree_venus' => 'nullable|numeric|min:0|max:360',
            'niray_degree_mars' => 'nullable|numeric|min:0|max:360',
            'niray_degree_juipter' => 'nullable|numeric|min:0|max:360',
            'niray_degree_saturn' => 'nullable|numeric|min:0|max:360',
            'niray_degree_rahu' => 'nullable|numeric|min:0|max:360',
            'niray_degree_ketu' => 'nullable|numeric|min:0|max:360',

            // Validation for Planet Degree Range
            'planet_selection' => 'required|string',
            'degree_input' => 'required|numeric|min:0|max:360',

            'starting_degree1' => 'nullable|numeric|min:0|max:360',
            'ending_degree1' => 'nullable|numeric|min:0|max:360',
            'range1' => 'nullable|numeric|min:0|max:360',
            'house1' => 'nullable|numeric|min:0|max:12',
            'starting_degree2' => 'nullable|numeric|min:0|max:360',
            'ending_degree2' => 'nullable|numeric|min:0|max:360',
            'range2' => 'nullable|numeric|min:0|max:360',
            'house2' => 'nullable|numeric|min:0|max:12',
            'starting_degree3' => 'nullable|numeric|min:0|max:360',
            'ending_degree3' => 'nullable|numeric|min:0|max:360',
            'range3' => 'nullable|numeric|min:0|max:360',
            'house3' => 'nullable|numeric|min:0|max:12',
            'starting_degree4' => 'nullable|numeric|min:0|max:360',
            'ending_degree4' => 'nullable|numeric|min:0|max:360',
            'range4' => 'nullable|numeric|min:0|max:360',
            'house4' => 'nullable|numeric|min:0|max:12',
            'starting_degree5' => 'nullable|numeric|min:0|max:360',
            'ending_degree5' => 'nullable|numeric|min:0|max:360',
            'range5' => 'nullable|numeric|min:0|max:360',
            'house5' => 'nullable|numeric|min:0|max:12',
            'starting_degree6' => 'nullable|numeric|min:0|max:360',
            'ending_degree6' => 'nullable|numeric|min:0|max:360',
            'range6' => 'nullable|numeric|min:0|max:360',
            'house6' => 'nullable|numeric|min:0|max:12',
            'starting_degree7' => 'nullable|numeric|min:0|max:360',
            'ending_degree7' => 'nullable|numeric|min:0|max:360',
            'range7' => 'nullable|numeric|min:0|max:360',
            'house7' => 'nullable|numeric|min:0|max:12',
            'starting_degree8' => 'nullable|numeric|min:0|max:360',
            'ending_degree8' => 'nullable|numeric|min:0|max:360',
            'range8' => 'nullable|numeric|min:0|max:360',
            'house8' => 'nullable|numeric|min:0|max:12',
            'starting_degree9' => 'nullable|numeric|min:0|max:360',
            'ending_degree9' => 'nullable|numeric|min:0|max:360',
            'range9 ' => 'nullable|numeric|min:0|max:360',
            'house9' => 'nullable|numeric|min:0|max:12',
            'starting_degree10' => 'nullable|numeric|min:0|max:360',
            'ending_degree10' => 'nullable|numeric|min:0|max:360',
            'range10' => 'nullable|numeric|min:0|max:360',
            'house10' => 'nullable|numeric|min:0|max:12',
            'starting_degree11' => 'nullable|numeric|min:0|max:360',
            'ending_degree11' => 'nullable|numeric|min:0|max:360',
            'range11' => 'nullable|numeric|min:0|max:360',
            'house11' => 'nullable|numeric|min:0|max:12',
            'starting_degree12' => 'nullable|numeric|min:0|max:360',
            'ending_degree12' => 'nullable|numeric|min:0|max:360',
            'range12' => 'nullable|numeric|min:0|max:360',
            'house12' => 'nullable|numeric|min:0|max:12',
        ]);

        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $kundali->name = $request->name;
        $kundali->country = $request->country;
        $kundali->state = $request->state;
        $kundali->city = $request->city;
        $kundali->locality = $request->locality;
        $kundali->pin = $request->pin;
        $kundali->dob = $request->dob;
        $kundali->ayan_name = $request->ayan_name;
        $kundali->cst = $request->cst;
        $kundali->juliyan = $request->juliyan;

        $kundali->lmt_birthtime = sprintf('%02d:%02d:%02d %s %s %s', $request->lmt_birth_hour, $request->lmt_birth_minute, $request->lmt_birth_second, $request->lmt_birth_ampm, $request->lmt_birth_date, $request->lmt_birth_direction);

        $kundali->gmt_birthtime = sprintf('%02d:%02d:%02d %s %s %s', $request->gmt_birth_hour, $request->gmt_birth_minute, $request->gmt_birth_second, $request->gmt_birth_ampm, $request->gmt_birth_date, $request->gmt_birth_direction);


        $kundali->subtime = sprintf('%s %d:%d:%d', $request->hour_subtime, $request->minute_subtime, $request->second_subtime, $request->subtime_plusminus);

        $kundali->dst = sprintf('%s %d:%d:%d', $request->dst_plusminus, $request->hour_dst, $request->minute_dst, $request->second_dst);

        $kundali->timedifference = sprintf('%2d:%2d:%2d %s', $request->timedifference_plusminus, $request->hour_timedifference, $request->minute_timedifference, $request->second_timedifference);
        $kundali->timezone = sprintf('%s %s', $request->timezone_plusminus, $request->timezone_time);


        $kundali->ayan = sprintf('%d° %d\' %02d"', $request->ayan_degree, $request->ayan_minute, $request->ayan_second);

        $kundali->choice = $request['choice'];
        $kundali->sub_choice = $request['sub_choice'];

        $kundali->tob = sprintf('%d:%d:%d %s', $request->hour, $request->minute, $request->second, $request->tob_ampm);
        $kundali->gmt = sprintf('%d:%d:%d %s', $request->hour_gmt, $request->minute_gmt, $request->second_gmt, $request->gmt_ampm);
        $kundali->lmt = sprintf('%d:%d:%d %s', $request->hour_lmt, $request->minute_lmt, $request->second_lmt, $request->lmt_ampm);
        $kundali->latitude = sprintf('%s %d %s', $request->latitude_plusminus, $request->latitude, $request->latitude_direction);
        $kundali->longitude = sprintf('%s %d %s', $request->longitude_plusminus, $request->longitude, $request->longitude_direction);
        // for niray and sary value to store data
        $kundali->saryana_dms_ascendant = sprintf('%d° %d\' %02d"', $request->saryana_degree_ascendant, $request->saryana_minute_ascendant, $request->saryana_second_ascendant);
        $kundali->saryana_dms_sun = sprintf('%d° %d\' %02d"', $request->saryana_degree_sun, $request->saryana_minute_sun, $request->saryana_second_sun);
        $kundali->saryana_dms_moon = sprintf('%d° %d\' %02d"', $request->saryana_degree_moon, $request->saryana_minute_moon, $request->saryana_second_moon);
        $kundali->saryana_dms_mercury = sprintf('%d° %d\' %02d"', $request->saryana_degree_mercury, $request->saryana_minute_mercury, $request->saryana_second_mercury);
        $kundali->saryana_dms_venus = sprintf('%d° %d\' %02d"', $request->saryana_degree_venus, $request->saryana_minute_venus, $request->saryana_second_venus);
        $kundali->saryana_dms_mars = sprintf('%d° %d\' %02d"', $request->saryana_degree_mars, $request->saryana_minute_mars, $request->saryana_second_mars);
        $kundali->saryana_dms_juipter = sprintf('%d° %d\' %02d"', $request->saryana_degree_juipter, $request->saryana_minute_juipter, $request->saryana_second_juipter);
        $kundali->saryana_dms_saturn = sprintf('%d° %d\' %02d"', $request->saryana_degree_saturn, $request->saryana_minute_saturn, $request->saryana_second_saturn);
        $kundali->saryana_dms_rahu = sprintf('%d° %d\' %02d"', $request->saryana_degree_rahu, $request->saryana_minute_rahu, $request->saryana_second_rahu);
        $kundali->saryana_dms_ketu = sprintf('%d° %d\' %02d"', $request->saryana_degree_ketu, $request->saryana_minute_ketu, $request->saryana_second_ketu);

        $kundali->nirayana_dms_ascendant = sprintf('%d° %d\' %02d"', $request->nirayana_degree_ascendant, $request->nirayana_minute_ascendant, $request->nirayana_second_ascendant);
        $kundali->nirayana_dms_sun = sprintf('%d° %d\' %02d"', $request->nirayana_degree_sun, $request->nirayana_minute_sun, $request->nirayana_second_sun);
        $kundali->nirayana_dms_moon = sprintf('%d° %d\' %02d"', $request->nirayana_degree_moon, $request->nirayana_minute_moon, $request->nirayana_second_moon);
        $kundali->nirayana_dms_mercury = sprintf('%d° %d\' %02d"', $request->nirayana_degree_mercury, $request->nirayana_minute_mercury, $request->nirayana_second_mercury);
        $kundali->nirayana_dms_venus = sprintf('%d° %d\' %02d"', $request->nirayana_degree_venus, $request->nirayana_minute_venus, $request->nirayana_second_venus);
        $kundali->nirayana_dms_mars = sprintf('%d° %d\' %02d"', $request->nirayana_degree_mars, $request->nirayana_minute_mars, $request->nirayana_second_mars);
        $kundali->nirayana_dms_juipter = sprintf('%d° %d\' %02d"', $request->nirayana_degree_juipter, $request->nirayana_minute_juipter, $request->nirayana_second_juipter);
        $kundali->nirayana_dms_saturn = sprintf('%d° %d\' %02d"', $request->nirayana_degree_saturn, $request->nirayana_minute_saturn, $request->nirayana_second_saturn);
        $kundali->nirayana_dms_rahu = sprintf('%d° %d\' %02d"', $request->nirayana_degree_rahu, $request->nirayana_minute_rahu, $request->nirayana_second_rahu);
        $kundali->nirayana_dms_ketu = sprintf('%d° %d\' %02d"', $request->nirayana_degree_ketu, $request->nirayana_minute_ketu, $request->nirayana_second_ketu);

        $kundali->sary_degree_ascendant = $request->sary_degree_ascendant;
        $kundali->sary_degree_sun = $request->sary_degree_sun;
        $kundali->sary_degree_moon = $request->sary_degree_moon;
        $kundali->sary_degree_mercury = $request->sary_degree_mercury;
        $kundali->sary_degree_venus = $request->sary_degree_venus;
        $kundali->sary_degree_mars = $request->sary_degree_mars;
        $kundali->sary_degree_juipter = $request->sary_degree_juipter;
        $kundali->sary_degree_saturn = $request->sary_degree_saturn;
        $kundali->sary_degree_rahu = $request->sary_degree_rahu;
        $kundali->sary_degree_ketu = $request->sary_degree_ketu;

        $kundali->niray_degree_ascendant = $request->niray_degree_ascendant;
        $kundali->niray_degree_sun = $request->niray_degree_sun;
        $kundali->niray_degree_moon = $request->niray_degree_moon;
        $kundali->niray_degree_mercury = $request->niray_degree_mercury;
        $kundali->niray_degree_venus = $request->niray_degree_venus;
        $kundali->niray_degree_mars = $request->niray_degree_mars;
        $kundali->niray_degree_juipter = $request->niray_degree_juipter;
        $kundali->niray_degree_saturn = $request->niray_degree_saturn;
        $kundali->niray_degree_rahu = $request->niray_degree_rahu;
        $kundali->niray_degree_ketu = $request->niray_degree_ketu;


        // For sun rise to store data
        $kundali->sunRiseYesterday = sprintf('%d:%d:%d %s', $request->sun_rise_yesterday_hour, $request->sun_rise_yesterday_minute, $request->sun_rise_yesterday_second, $request->sun_rise_yesterday_ampm);
        $kundali->sunSetYesterday = sprintf('%d:%d:%d %s', $request->sun_set_yesterday_hour, $request->sun_set_yesterday_minute, $request->sun_set_yesterday_second, $request->sun_set_yesterday_ampm);
        $kundali->sunRiseTomorrow = sprintf('%d:%d:%d %s', $request->sun_rise_tomorrow_hour, $request->sun_rise_tomorrow_minute, $request->sun_rise_tomorrow_second, $request->sun_rise_tomorrow_ampm);
        $kundali->sunSetTomorrow =  sprintf('%d:%d:%d %s', $request->sun_set_tomorrow_hour, $request->sun_set_tomorrow_minute, $request->sun_set_tomorrow_second, $request->sun_set_tomorrow_ampm);
        $kundali->sunRiseToday =  sprintf('%d:%d:%d %s', $request->sun_rise_today_hour, $request->sun_rise_today_minute, $request->sun_rise_today_second, $request->sun_rise_today_ampm);
        $kundali->sunSetToday = sprintf('%d:%d:%d %s', $request->sun_set_today_hour, $request->sun_set_today_minute, $request->sun_set_today_second, $request->sun_set_today_ampm);

        $kundali->moonRiseYesterday = sprintf('%d:%d:%d %s', $request->moon_rise_yesterday_hour, $request->moon_rise_yesterday_minute, $request->moon_rise_yesterday_second, $request->moon_rise_yesterday_ampm);
        $kundali->moonSetYesterday = sprintf('%d:%d:%d %s', $request->moon_set_yesterday_hour, $request->moon_set_yesterday_minute, $request->moon_set_yesterday_second, $request->moon_set_yesterday_ampm);
        $kundali->moonRiseTomorrow = sprintf('%d:%d:%d %s', $request->moon_rise_tomorrow_hour, $request->moon_rise_tomorrow_minute, $request->moon_rise_tomorrow_second, $request->moon_rise_tomorrow_ampm);
        $kundali->moonSetTomorrow =  sprintf('%d:%d:%d %s', $request->moon_set_tomorrow_hour, $request->moon_set_tomorrow_minute, $request->moon_set_tomorrow_second, $request->moon_set_tomorrow_ampm);
        $kundali->moonRiseToday =  sprintf('%d:%d:%d %s', $request->moon_rise_today_hour, $request->moon_rise_today_minute, $request->moon_rise_today_second, $request->moon_rise_today_ampm);
        $kundali->moonSetToday = sprintf('%d:%d:%d %s', $request->moon_set_today_hour, $request->moon_set_today_minute, $request->moon_set_today_second, $request->moon_set_today_ampm);
        // for planet selection
        $kundali->planet_selection = $request->planet_selection;
        $kundali->degree_input = $request->degree_input;
        $kundali->starting_degree1 = $request->starting_degree1;
        $kundali->ending_degree1 = $request->ending_degree1;
        $kundali->range1 = $request->range1;
        $kundali->house1 = $request->house1;
        $kundali->starting_degree2 = $request->starting_degree2;
        $kundali->ending_degree2 = $request->ending_degree2;
        $kundali->range2 = $request->range2;
        $kundali->house2 = $request->house2;
        $kundali->starting_degree3 = $request->starting_degree3;
        $kundali->ending_degree3 = $request->ending_degree3;
        $kundali->range3 = $request->range3;
        $kundali->house3 = $request->house3;
        $kundali->starting_degree4 = $request->starting_degree4;
        $kundali->ending_degree4 = $request->ending_degree4;
        $kundali->range4 = $request->range4;
        $kundali->house4 = $request->house4;
        $kundali->starting_degree5 = $request->starting_degree5;
        $kundali->ending_degree5 = $request->ending_degree5;
        $kundali->range5 = $request->range5;
        $kundali->house5 = $request->house5;
        $kundali->starting_degree6 = $request->starting_degree6;
        $kundali->ending_degree6 = $request->ending_degree6;
        $kundali->range6 = $request->range6;
        $kundali->house6 = $request->house6;
        $kundali->starting_degree7 = $request->starting_degree7;
        $kundali->ending_degree7 = $request->ending_degree7;
        $kundali->range7 = $request->range7;
        $kundali->house7 = $request->house7;
        $kundali->starting_degree8 = $request->starting_degree8;
        $kundali->ending_degree8 = $request->ending_degree8;
        $kundali->range8 = $request->range8;
        $kundali->house8 = $request->house8;
        $kundali->starting_degree9 = $request->starting_degree9;
        $kundali->ending_degree9 = $request->ending_degree9;
        $kundali->range9 = $request->range9;
        $kundali->house9 = $request->house9;
        $kundali->starting_degree10 = $request->starting_degree10;
        $kundali->ending_degree10 = $request->ending_degree10;
        $kundali->range10 = $request->range10;
        $kundali->house10 = $request->house10;
        $kundali->starting_degree11 = $request->starting_degree11;
        $kundali->ending_degree11 = $request->ending_degree11;
        $kundali->range11 = $request->range11;
        $kundali->house11 = $request->house11;
        $kundali->starting_degree12 = $request->starting_degree12;
        $kundali->ending_degree12 = $request->ending_degree12;
        $kundali->range12 = $request->range12;
        $kundali->house12 = $request->house12;

        $kundali->save();


        // Update the Kundali record
        $kundali->update($request->all());

        // Redirect to a specific route with a success message
        return redirect()->route('kundalis.index')->with('success', 'Kundali updated successfully!');
    }
    public function destroy(Request $request)
    {
        $kundali = Kundali::find($request->id);
        if ($kundali == null) {
            return response()->json([
                'status' => false,
                'message' => 'Kundali not Found',
            ]);
        } else {
            // File::delete(public_path('uploads/'.$book->image));
            $kundali->delete();
            return response()->json([
                'status' => true,
                'message' => 'kundali deleted Successfully',
            ]);
        }
    }
    public function view_details($id, Request $request)
    {
        $kundali = kundali::find($id);
       

        $ayan = $this->convertDmsToDecimal($kundali->ayan); // Assuming 'ayan_dms' is the column name
        // Get the planets data
        $planetsData = $this->getPlanetsData($kundali, $ayan);

        $niray = [];  // niray array data()
        $sary = [];
        $netDegrees = [];
        // sary array data
        $planet = $this->calculatelagna($kundali, $ayan);

        // $plan = $this->get_data($kundali->starting_degree1, $kundali->ending_degree1);

        $resultsDmsNiray = [];
        $resultsDmsSary = [];
        $houseNumber = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']; // House numbers

        $width = [];
        $starting_degree = [];
        $ending_degree = [];
        $signdata = [];
        foreach ($houseNumber as $number) {
            // Get the range, starting degree, and ending degree for each house
            $width[] = $kundali->{'range' . $number} ?? null;
            $starting_degree[] = $kundali->{'starting_degree' . $number} ?? null;
            $ending_degree[] = $kundali->{'ending_degree' . $number} ?? null;
        }

        foreach ($planet as $house) {

            $nirayResults = $this->calculateAstrologyValues($house['niray'] ?? [], $width);
            $saryResults = $this->calculateAstrologyValues($house['sary'] ?? [], $width);

            //  var_dump($nirayResults);

            // Process niray results
            foreach ($nirayResults as $result) {
                // var_dump( $result['value']);
                $value = $this->get_data($result['value']);
                // var_dump( $value);
                $nethouseDegree = $this->calculateNetDegree($result['value'], $result['data']->sign_number);
                $nethouseDms = $this->convertDegreesToDMS($nethouseDegree);
                $resultsDmsNiray[] = [
                    'original' => $result,
                    'dms' => $nethouseDms,
                    'nethousedegree' => $nethouseDegree,
                    'value' => $value
                ];
            }

            // Process sary results
            foreach ($saryResults as $result) {
                $value = $this->get_data($result['value']);
                // var_dump($result);
                $nethouseDegree = $this->calculateNetDegree($result['value'], $result['data']->sign_number);
                $nethouseDms = $this->convertDegreesToDMS($nethouseDegree);
                $resultsDmsSary[] = [
                    'original' => $result,
                    'dms' => $nethouseDms,
                    'nethousedegree' => $nethouseDegree,
                    'value' => $value
                ];
            }
        }

        foreach ($planetsData as $planet) {
            // Retrieve niray zodiac information
            $nirayResult = DB::table('zodiac')
                ->where('s_degree', '<=', $planet['niray'])
                ->where('l_degree', '>=', $planet['niray'])
                ->first();

            if ($nirayResult) {
                $niray[] = $nirayResult; // Store the result
                $netDegreeNiray = $this->calculateNetDegree($planet['niray'], $nirayResult->sign_number);
                $netDegrees['niray'][] = $netDegreeNiray; // Store net degree
                // Convert to DMS
                $netDmsNiray = $this->convertDegreesToDMS($netDegreeNiray);
                $finalData['netDms']['niray'][] = $netDmsNiray; // Store DMS format for niray
            }

            // Retrieve sary zodiac information
            $saryResult = DB::table('zodiac')
                ->where('s_degree', '<=', $planet['sary'])
                ->where('l_degree', '>=', $planet['sary'])
                ->first();

            if ($saryResult) {
                $sary[] = $saryResult; // Store the result
                $netDegreeSary = $this->calculateNetDegree($planet['sary'], $saryResult->sign_number);
                $netDegrees['sary'][] = $netDegreeSary; // Store net degree
                // Convert to DMS
                $netDmsSary = $this->convertDegreesToDMS($netDegreeSary);
                $finalData['netDms']['sary'][] = $netDmsSary; // Store DMS format for sary
            }
        }

        $finalData['niray'] = $niray;
        $finalData['sary'] = $sary;
        $finalData['netDegrees'] = $netDegrees;

        $agniplanetdata = $this->planetsinput($kundali);
        $agni = $this->agnitatav($kundali, $agniplanetdata , $width);
        //   var_dump($agni);

        // var_dump($resultsDmsNiray[8]);

        // return response()->json([
        //     'kundali' => $kundali,
        //     'planetsData' => $planetsData,
        //     'finalData' => $finalData,
        //     'resultsDmsNiray' => $resultsDmsNiray,
        //     'resultsDmsSary' => $resultsDmsSary,
        //     'houseNumber' => $houseNumber
        // ]);

        return view('kundalis.view', compact('kundali', 'planetsData', 'finalData', 'resultsDmsNiray', 'resultsDmsSary', 'houseNumber', 'agni'));
    }
    private function getPlanetsData(Kundali $kundali)
    {

        $planets = [];
        $ayan = $this->convertDmsToDecimal($kundali->ayan);
        // var_dump($ayan);
        // die;
        foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet) {
            // Fetch degrees and DMS values
            $niray_degree = (float) $kundali->{'niray_degree_' . $planet};
            $sary_degree = (float) $kundali->{'sary_degree_' . $planet};
            $saryana_dms = $kundali->{'saryana_dms_' . $planet};
            $nirayana_dms =  $kundali->{'nirayana_dms_' . $planet};
            // var_dump($sary_degree);
            // Initialize variables
            $degree = 0;

            // Determine degree from available DMS values
            if ($saryana_dms != '0° 0\' 00"') {

                $degree = (float)$this->convertDmsToDecimal($saryana_dms);
            } elseif ($nirayana_dms != '0° 0\' 00"') {

                $degree = (float) $this->convertDmsToDecimal($nirayana_dms);
            } elseif ($niray_degree != 0) {
                $degree = (float)$niray_degree;
            } elseif ($sary_degree != 0) {
                $degree = (float)$sary_degree;
            }

            // $degree = $this->convertDmsToDecimal($nirayana_dms);

            // Calculate Niray and Sary based on available degree
            if ($degree !== null) {
                if ($saryana_dms != '0° 0\' 00"') {
                    $niray = abs($degree - $ayan);
                    $sary = abs($niray + $ayan);
                } elseif ($nirayana_dms != '0° 0\' 00"') {
                    $sary = abs($degree + $ayan);
                    $niray = abs($sary - $ayan);
                } elseif (!empty($niray_degree)) {
                    $sary = abs($degree + $ayan);
                    $niray = abs($sary - $ayan);
                } elseif (!empty($sary_degree)) {
                    $niray = abs($degree - $ayan);
                    $sary = abs($niray + $ayan);
                }


                // Debugging output

                if ($niray === 0) {
                    $niray = 360;
                }
                if ($sary === 0) {
                    $sary = 360;
                }

                // Store results
                $planets[$planet] = [
                    'niray' => $niray,
                    'sary' => $sary,
                ];
            } else {
                // Handle case where degree could not be determined
                $planets[$planet] = [
                    'niray' => null,
                    'sary' => null,
                ];
            }
        }

        return $planets;
    }

    private function convertDmsToDecimal($dms)
    {
        if (empty($dms)) {
            return null; // Return null or a default value if DMS is empty
        }
        // Split the DMS string
        $parts = explode(' ', $dms);

        // Ensure we have exactly 3 parts
        if (count($parts) != 3) {
            // Handle the error as needed, e.g., log it or throw an exception
            return null;
        }

        list($degrees, $minutes, $seconds) = $parts;
        $degree = $this->subdegree($degrees);
        $minutes = $this->subdegree($minutes);
        $seconds = $this->subdegree($seconds);
        // Convert to decimal
        return $degree + ($minutes / 60) + ($seconds / 3600);
    }

    private function subdegree($val)
    {
        $degree = str_split($val);
        $data = null;
        foreach ($degree as $deg) {

            if (is_numeric($deg)) {
                $data .= $deg;
            }
        }
        return $data;
    }
    private function calculateNetDegree($degrees, $sign_number)
    {

        // Cast to float for decimal calculations
        $degrees = (float)$degrees;
        $sign_number = (float)$sign_number;

        // Calculate net degree using the provided formula
        $netDegree = $degrees - ($sign_number - 1) * 30;
        // var_dump($netDegree);
        // die;

        // Normalize the net degree to ensure it's within 0-360 degrees
        if ($netDegree < 0) {
            $netDegree += 360;
        } elseif ($netDegree >= 360) {
            $netDegree -= 360;
        }

        return $netDegree;
    }
    private function convertDegreesToDMS($degrees)
    {
        $d = floor($degrees);
        $m = floor(($degrees - $d) * 60);
        $s = (($degrees - $d) * 60 - $m) * 60;

        return sprintf('%d° %d\' %d"', $d, abs($m), abs($s));
    }
    private function calculateAstrologyValues($initialValue, $count)
    {
        $results = [];
        $currentValue = $initialValue;

        // Get initial data from zodiac and nakshatra tables
        $data = DB::table('zodiac')
            ->where('s_degree', '<=', $currentValue)
            ->where('l_degree', '>=', $currentValue)
            ->first();
        $nakshatraData = DB::table('nakshatra')
            ->where('starting_degree_decimal', '<=', $currentValue)
            ->where('last_degree_decimal', '>=', $currentValue)
            ->first();

        // Add initial data to results
        $results[] = [
            'value' => $currentValue,
            'data' => $data,
            'nakshatra_data' => $nakshatraData,
        ];

        // Loop to calculate next values and get corresponding data
        for ($i = 1; $i < 12; $i++) {
            // Get degree increment based on kundali data for each house (i.e., step)
            $kundaliData = DB::table('kundalis')  // Assuming 'kundalis' holds degree information
                ->where('starting_degree' . $i, '<=', $currentValue)
                ->where('ending_degree' . $i, '>=', $currentValue)
                ->first();

            // Calculate the degree increment based on kundali data or count array
            if ($kundaliData) {
                // Get dynamic starting and ending degrees for the current house
                $startingDegreeColumn = 'starting_degree' . $i;
                $endingDegreeColumn = 'ending_degree' . $i;

                $startingDegree = isset($kundaliData->$startingDegreeColumn) ? $kundaliData->$startingDegreeColumn : 0;
                $endingDegree = isset($kundaliData->$endingDegreeColumn) ? $kundaliData->$endingDegreeColumn : 0;

                // Calculate the increment based on the difference between the starting and ending degrees
                $countIncrement = ($endingDegree - $startingDegree);
            } else {
                // If no kundali data, use the count array value as increment
                $countIncrement = isset($count[$i]) ? $count[$i] : 0; // Default to 0 if count[$i] doesn't exist
            }

            // Ensure the new degree is within the 360-degree range
            $currentValue = fmod($currentValue + $countIncrement, 360.0);
            if ($currentValue < 0) {
                $currentValue += 360.0; // Adjust to always be positive if the modulo results in a negative value
            }

            // Fetch new zodiac and nakshatra data based on the updated degree value
            $data = DB::table('zodiac')
                ->where('s_degree', '<=', $currentValue)
                ->where('l_degree', '>=', $currentValue)
                ->first();

            $nakshatraData = DB::table('nakshatra')
                ->where('starting_degree_decimal', '<=', $currentValue)
                ->where('last_degree_decimal', '>=', $currentValue)
                ->first();

            // Add results for the current step
            $results[] = [
                'value' => $currentValue,
                'data' => $data,
                'nakshatra_data' => $nakshatraData,
            ];
        }

        return $results;
    }
    private function get_data($value)
    {
        $results = [];

        for ($i = 1; $i <= 12; $i++) {

            // Query the database for the given range
            $kund = DB::table('kundalis')
                ->select('id', 'starting_degree' . $i . ' as starting_degree', 'ending_degree' . $i . ' as ending_degree', 'house' . $i . ' as house', 'range' . $i . ' as range')
                ->where('starting_degree' . $i, '<=', $value)
                ->where('ending_degree' . $i, '>=', $value)
                ->first();

            if ($kund) {

                // Query for zodiac sign data
                $sign_data = DB::table('zodiac')
                    ->where('s_degree', '<', $kund->ending_degree)
                    ->where('l_degree', '>', $kund->starting_degree)
                    ->get()
                    ->all();


                // Calculate the range for kundali
                $results[] = [
                    'starting_degree' => $kund->starting_degree,
                    'ending_degree' => $kund->ending_degree,
                    'range' => $kund->range,
                    'sign_data' => $sign_data,
                    'house' => $kund->house,
                ];
            } else {
            }
        }

        return $results;
    }
    private function calculatelagna(Kundali $kundali)
    {
        $planets = [];
        $ayan = $this->convertDmsToDecimal($kundali->ayan);

        // Fetch the dynamic planet selection from the kundali object
        $planetSelection = $kundali->planet_selection;

        // Check if planet_selection is valid and not empty
        if (empty($planetSelection)) {
            // Handle case where planet_selection is empty or not provided
            throw new \Exception("Planet selection is empty or not defined.");
        }

        // Fetch degrees and DMS values for the selected planet dynamically
        $niray_degree = (float) $kundali->{'niray_degree_' . $planetSelection};
        $sary_degree = (float) $kundali->{'sary_degree_' . $planetSelection};
        $saryana_dms = $kundali->{'saryana_dms_' . $planetSelection};
        $nirayana_dms =  $kundali->{'nirayana_dms_' . $planetSelection};

        // Initialize degree to zero
        $degree = 0;

        // Calculate degree based on available data (saryana_dms or nirayana_dms)
        if ($saryana_dms != '0° 0\' 00"') {
            $degree = (float) $this->convertDmsToDecimal($saryana_dms);
        } elseif ($nirayana_dms != '0° 0\' 00"') {
            $degree = (float) $this->convertDmsToDecimal($nirayana_dms);
        } elseif ($niray_degree != 0) {
            $degree = (float) $niray_degree;
        } elseif ($sary_degree != 0) {
            $degree = (float) $sary_degree;
        }

        // If degree was determined, calculate Niray and Sary
        if ($degree !== null) {
            if ($saryana_dms != '0° 0\' 00"') {
                $niray = abs($degree - $ayan);
                $sary = abs($niray + $ayan);
            } elseif ($nirayana_dms != '0° 0\' 00"') {
                $sary = abs($degree + $ayan);
                $niray = abs($sary - $ayan);
            } elseif (!empty($niray_degree)) {
                $sary = abs($degree + $ayan);
                $niray = abs($sary - $ayan);
            } elseif (!empty($sary_degree)) {
                $niray = abs($degree - $ayan);
                $sary = abs($niray + $ayan);
            }

            // Ensure Niray and Sary are never 0
            if ($niray === 0) {
                $niray = 360;
            }
            if ($sary === 0) {
                $sary = 360;
            }

            // Store results
            $planets[$planetSelection] = [
                'niray' => $niray,
                'sary' => $sary,
            ];
        } else {
            // Handle case where degree could not be determined
            $planets[$planetSelection] = [
                'niray' => null,
                'sary' => null,
            ];
        }

        return $planets;
    }
    private function agnitatav(Kundali $kundali, $plan, $width)
    {    
        // Determine whether the birth occurred during the day or night
        $isDayTime = $this->isDayTimeBasedOnTime($kundali->tob, $kundali->sunRiseToday, $kundali->sunSetToday, $kundali->city);
       
        
        //  $laganlord = $this->calculateAstrologyValues($kundali->,$width);
         
       
        // var_dump($laganlord['value']);
        if ($isDayTime) {
            // If it's daytime, apply the logic for daytime
            $Agni1 = $this->agnicalculate($plan['moon'], $plan['sun'], $plan['ascendant']);
            $Agni1Value = $Agni1[0]['result'];
            $Agni2 = $this->agnicalculate($plan['sun'], $plan['moon'], $plan['ascendant']);
            $Agni2Value = $Agni2[0]['result'];
            $Agni3 = $this->agnicalculate($plan['sun'], $plan['moon'], $plan['ascendant']);
            $Agni4 = $this->agnicalculate($plan['juipter'], $Agni1Value, $plan['ascendant']);
            $Agni5 = $this->agnicalculate($Agni2Value, $Agni1Value, $plan['venus']);
            $Agni6 = $this->agnicalculate($Agni1Value, $plan['mars'], $plan['ascendant']);
            $Agni7 = $this->agnicalculate($plan['saturn'], $plan['venus'], $plan['ascendant']);
            //    $Agni8 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni9 = $this->agnicalculate($plan['juipter'], $plan['saturn'], $plan['ascendant']);
            $Agni10 = $this->agnicalculate($plan['sun'], $plan['moon'], $plan['juipter']);
            $Agni11 = $this->agnicalculate($plan['saturn'], $plan['sun'], $plan['ascendant']);
            $Agni12 = $this->agnicalculate($plan['saturn'], $plan['sun'], $plan['ascendant']);
            $Agni13 = $this->agnicalculate($plan['moon'], $plan['venus'], $plan['ascendant']);
            $Agni14 = $this->agnicalculate($plan['juipter'], $plan['moon'], $plan['ascendant']);
            $Agni15 = $this->agnicalculate($plan['saturn'], $plan['juipter'], $plan['ascendant']);
            $Agni16 = $this->agnicalculate($plan['ascendant'], $plan['moon'], $plan['ascendant']);
            $Agni17 = $this->agnicalculate($plan['saturn'], $plan['moon'], $plan['ascendant']);
            $Agni18 = $this->agnicalculate($plan['mars'], $plan['mercury'], $plan['ascendant']);
            //    $Agni19 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            $Agni20 = $this->agnicalculate($plan['juipter'], $plan['mars'], $plan['ascendant']);
            //    $Agni21 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            $Agni22 = $this->agnicalculate($plan['juipter'], $plan['saturn'], $plan['mercury']);
            $Agni23 = $this->agnicalculate($plan['mercury'], $plan['moon'], $plan['ascendant']);
            //    $Agni24 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            //    $Agni25 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            //    $Agni26 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni27 = $this->agnicalculate($plan['venus'], $plan['sun'], $plan['ascendant']);
            $Agni28 = $this->agnicalculate($plan['moon'], $plan['saturn'], $plan['ascendant']);
            $Agni29 = $this->agnicalculate($plan['moon'], $plan['mercury'], $plan['ascendant']);
            //    $Agni30 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni31 = $this->agnicalculate($plan['venus'], $plan['saturn'], $plan['ascendant']);
            $Agni32 = $this->agnicalculate($plan['juipter'], $plan['mercury'], $plan['ascendant']);
            //    $Agni33 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            $Agni34 = $this->agnicalculate($plan['venus'], $plan['mars'], $plan['ascendant']);
            $Agni35 = $this->agnicalculate($Agni2Value, $Agni1Value, $plan['ascendant']);
            $Agni36 = $this->agnicalculate($plan['mars'], $plan['saturn'], $plan['mercury']);
            $Agni37 = $this->agnicalculate($plan['mars'], $plan['mercury'], $plan['ascendant']);
            $Agni38 = $this->agnicalculate($plan['saturn'], $plan['moon'], $plan['ascendant']);
            $Agni39 = $this->agnicalculate($plan['mars'], $plan['saturn'], $plan['ascendant']);
            //    $Agni40 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni41 = $this->agnicalculate($Agni1Value, $plan['saturn'], $plan['ascendant']);
            //       $Agni42 = $this->agnicalculate($plan['juipter'],$plan['mercury'],$plan['ascendant']);
            //       $Agni33 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            //       $Agni44 = $this->agnicalculate($plan['venus'],$plan['mars'],$plan['ascendant']);
            //       $Agni45 = $this->agnicalculate($Agni2Value,$Agni1Value,$plan['ascendant']);
            //       $Agni46 = $this->agnicalculate($plan['mars'],$plan['saturn'],$plan['mercury']);
            //       $Agni47 = $this->agnicalculate($plan['mars'],$plan['mercury'],$plan['ascendant']);
            //       $Agni48 = $this->agnicalculate($plan['saturn'],$plan['moon'],$plan['ascendant']);
            //       $Agni49 = $this->agnicalculate($plan['mars'],$plan['saturn'],$plan['ascendant']);
            //       $Agni50 = $this->agnicalculate($plan['mars'],$plan['saturn'],$plan['ascendant']);
            //       $Agni51 = $this->agnicalculate($plan['mars'],$plan['saturn'],$plan['ascendant']);
            $Agni3Value = $Agni3[0]['result'];
            $Agni4Value = $Agni4[0]['result'];
            $Agni5Value = $Agni5[0]['result'];
            $Agni6Value = $Agni6[0]['result'];
            $Agni7Value = $Agni7[0]['result'];
            // $Agni8Value = $Agni8[0]['result'];
            $Agni9Value = $Agni9[0]['result'];
            $Agni10Value = $Agni10[0]['result'];
            $Agni11Value = $Agni11[0]['result'];
            $Agni12Value = $Agni12[0]['result'];
            $Agni13Value = $Agni13[0]['result'];
            $Agni14Value = $Agni14[0]['result'];
            $Agni15Value = $Agni15[0]['result'];
            $Agni16Value = $Agni16[0]['result'];
            $Agni17Value = $Agni17[0]['result'];
            $Agni18Value = $Agni18[0]['result'];
            // $Agni19Value = $Agni19[0]['result'];
            $Agni20Value = $Agni20[0]['result'];
            // $Agni21Value = $Agni21[0]['result'];
            $Agni22Value = $Agni22[0]['result'];
            $Agni23Value = $Agni23[0]['result'];
            // $Agni24Value = $Agni24[0]['result'];
            // $Agni25Value = $Agni25[0]['result'];
            // $Agni26Value = $Agni26[0]['result'];
            $Agni27Value = $Agni27[0]['result'];
            $Agni28Value = $Agni28[0]['result'];
            $Agni29Value = $Agni29[0]['result'];
            // $Agni30Value = $Agni30[0]['result'];
            $Agni31Value = $Agni31[0]['result'];
            $Agni32Value = $Agni32[0]['result'];
            // $Agni33Value = $Agni33[0]['result'];
            $Agni34Value = $Agni34[0]['result'];
            $Agni35Value = $Agni35[0]['result'];
            $Agni36Value = $Agni36[0]['result'];
            $Agni37Value = $Agni37[0]['result'];
            $Agni38Value = $Agni38[0]['result'];
            $Agni39Value = $Agni39[0]['result'];
            // $Agni40Value = $Agni40[0]['result'];
            $Agni41Value = $Agni41[0]['result'];
            // $Agni42Value = $Agni42[0]['result'];
            // $Agni43Value = $Agni43[0]['result'];
            // $Agni44Value = $Agni44[0]['result'];
            // $Agni45Value = $Agni45[0]['result'];
            // $Agni46Value = $Agni46[0]['result'];
            // $Agni47Value = $Agni47[0]['result'];
            // $Agni48Value = $Agni48[0]['result'];
            // $Agni49Value = $Agni49[0]['result'];
            // $Agni50Value = $Agni50[0]['result'];
            // $Agni51Value = $Agni51[0]['result'];

            $results = [

                'Agni1' => ['result' => $Agni1Value, 'agnidata' => $Agni1[0]['agnidata']],
                'Agni2' => ['result' => $Agni2Value, 'agnidata' => $Agni2[0]['agnidata']],
                'Agni3' => ['result' => $Agni3Value, 'agnidata' => $Agni3[0]['agnidata']],
                'Agni4' => ['result' => $Agni4Value, 'agnidata' => $Agni4[0]['agnidata']],
                'Agni5' => ['result' => $Agni5Value, 'agnidata' => $Agni5[0]['agnidata']],
                'Agni6' => ['result' => $Agni6Value, 'agnidata' => $Agni6[0]['agnidata']],
                'Agni7' => ['result' => $Agni7Value, 'agnidata' => $Agni7[0]['agnidata']],
                // 'Agni8' => ['result' => $Agni8Value, 'agnidata' => $Agni8[0]['agnidata']],
                'Agni9' => ['result' => $Agni9Value, 'agnidata' => $Agni9[0]['agnidata']],
                'Agni10' => ['result' => $Agni10Value, 'agnidata' => $Agni10[0]['agnidata']],
                'Agni11' => ['result' => $Agni11Value, 'agnidata' => $Agni11[0]['agnidata']],
                'Agni12' => ['result' => $Agni12Value, 'agnidata' => $Agni12[0]['agnidata']],
                'Agni13' => ['result' => $Agni13Value, 'agnidata' => $Agni13[0]['agnidata']],
                'Agni14' => ['result' => $Agni14Value, 'agnidata' => $Agni14[0]['agnidata']],
                'Agni15' => ['result' => $Agni15Value, 'agnidata' => $Agni15[0]['agnidata']],
                'Agni16' => ['result' => $Agni16Value, 'agnidata' => $Agni16[0]['agnidata']],
                'Agni17' => ['result' => $Agni17Value, 'agnidata' => $Agni17[0]['agnidata']],
                'Agni18' => ['result' => $Agni18Value, 'agnidata' => $Agni18[0]['agnidata']],
                // 'Agni19' => ['result' => $Agni19Value, 'agnidata' => $Agni19[0]['agnidata']],
                'Agni20' => ['result' => $Agni20Value, 'agnidata' => $Agni20[0]['agnidata']],
                // 'Agni21' => ['result' => $Agni21Value, 'agnidata' => $Agni21[0]['agnidata']],
                'Agni22' => ['result' => $Agni22Value, 'agnidata' => $Agni22[0]['agnidata']],
                'Agni23' => ['result' => $Agni23Value, 'agnidata' => $Agni23[0]['agnidata']],
                // 'Agni24' => ['result' => $Agni24Value, 'agnidata' => $Agni24[0]['agnidata']],
                // 'Agni25' => ['result' => $Agni25Value, 'agnidata' => $Agni25[0]['agnidata']],
                // 'Agni26' => ['result' => $Agni26Value, 'agnidata' => $Agni26[0]['agnidata']],
                'Agni27' => ['result' => $Agni27Value, 'agnidata' => $Agni27[0]['agnidata']],
                'Agni28' => ['result' => $Agni28Value, 'agnidata' => $Agni28[0]['agnidata']],
                'Agni29' => ['result' => $Agni29Value, 'agnidata' => $Agni29[0]['agnidata']],
                // 'Agni30' => ['result' => $Agni30Value, 'agnidata' => $Agni30[0]['agnidata']],
                'Agni31' => ['result' => $Agni31Value, 'agnidata' => $Agni31[0]['agnidata']],
                'Agni32' => ['result' => $Agni32Value, 'agnidata' => $Agni32[0]['agnidata']],
                // 'Agni33' => ['result' => $Agni33Value, 'agnidata' => $Agni33[0]['agnidata']],
                'Agni34' => ['result' => $Agni34Value, 'agnidata' => $Agni34[0]['agnidata']],
                'Agni35' => ['result' => $Agni35Value, 'agnidata' => $Agni35[0]['agnidata']],
                'Agni36' => ['result' => $Agni36Value, 'agnidata' => $Agni36[0]['agnidata']],
                'Agni37' => ['result' => $Agni37Value, 'agnidata' => $Agni37[0]['agnidata']],
                'Agni38' => ['result' => $Agni38Value, 'agnidata' => $Agni38[0]['agnidata']],
                'Agni39' => ['result' => $Agni39Value, 'agnidata' => $Agni39[0]['agnidata']],
                // 'Agni40' => ['result' => $Agni40Value, 'agnidata' => $Agni40[0]['agnidata']],
                'Agni41' => ['result' => $Agni41Value, 'agnidata' => $Agni41[0]['agnidata']],
                // 'Agni42' => ['result' => $Agni42Value, 'agnidata' => $Agni42[0]['agnidata']],
            ];
        } else {
            // If it's nighttime, apply the logic for nighttime (if different from daytime logic)
            $Agni1 = $this->agnicalculate($plan['sun'], $plan['moon'], $plan['ascendant']);
            $Agni1Value = $Agni1[0]['result'];
            $Agni2 = $this->agnicalculate($plan['moon'], $plan['sun'], $plan['ascendant']);
            $Agni2Value = $Agni2[0]['result'];
            $Agni3 = $this->agnicalculate($plan['moon'], $plan['sun'], $plan['ascendant']);
            $Agni3Value = $Agni3[0]['result'];
            $Agni4 = $this->agnicalculate($Agni1Value, $plan['juipter'], $plan['venus']);
            $Agni5 = $this->agnicalculate($Agni1Value, $Agni2Value, $plan['venus']);
            $Agni6 = $this->agnicalculate($plan['mars'], $Agni1Value, $plan['ascendant']);
            $Agni7 = $this->agnicalculate($plan['venus'], $plan['saturn'], $plan['ascendant']);
            // $Agni8 = $this->agnicalculate($plan['sun'],$plan['lagan'], $plan['ascendant']);
            $Agni9 = $this->agnicalculate($plan['juipter'], $plan['saturn'], $plan['ascendant']);
            $Agni10 = $this->agnicalculate($plan['moon'], $plan['sun'], $plan['juipter']);
            $Agni11 = $this->agnicalculate($plan['sun'], $plan['saturn'], $plan['ascendant']);
            $Agni12 = $this->agnicalculate($plan['sun'], $plan['saturn'], $plan['ascendant']);
            $Agni13 = $this->agnicalculate($plan['venus'], $plan['moon'], $plan['ascendant']);
            $Agni14 = $this->agnicalculate($plan['juipter'], $plan['moon'], $plan['ascendant']);
            $Agni15 = $this->agnicalculate($plan['juipter'], $plan['saturn'], $plan['ascendant']);
            $Agni16 = $this->agnicalculate($plan['ascendant'], $plan['moon'], $plan['ascendant']);
            $Agni17 = $this->agnicalculate($plan['moon'], $plan['saturn'], $plan['ascendant']);
            $Agni18 = $this->agnicalculate($plan['mercury'], $plan['mars'], $plan['ascendant']);
            //    $Agni19 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            $Agni20 = $this->agnicalculate($plan['mars'], $plan['juipter'], $plan['ascendant']);
            //    $Agni21 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            $Agni22 = $this->agnicalculate($plan['saturn'], $plan['juipter'], $plan['mercury']);
            $Agni23 = $this->agnicalculate($plan['mercury'], $plan['moon'], $plan['ascendant']);
            //    $Agni24 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            //    $Agni25 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            //    $Agni26 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni27 = $this->agnicalculate($plan['venus'], $plan['sun'], $plan['ascendant']);
            $Agni28 = $this->agnicalculate($plan['saturn'], $plan['moon'], $plan['ascendant']);
            $Agni29 = $this->agnicalculate($plan['moon'], $plan['mercury'], $plan['ascendant']);
            //    $Agni30 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni31 = $this->agnicalculate($plan['venus'], $plan['saturn'], $plan['ascendant']);
            $Agni32 = $this->agnicalculate($plan['mercury'], $plan['juipter'], $plan['ascendant']);
            //    $Agni33 = $this->agnicalculate($plan['moon'],$plan['sun'],$plan['ascendant']);
            $Agni34 = $this->agnicalculate($plan['venus'], $plan['mars'], $plan['ascendant']);
            $Agni35 = $this->agnicalculate($Agni2Value, $Agni1Value, $plan['ascendant']);
            $Agni36 = $this->agnicalculate($plan['saturn'], $plan['mars'], $plan['mercury']);
            $Agni37 = $this->agnicalculate($plan['mars'], $plan['mercury'], $plan['ascendant']);
            $Agni38 = $this->agnicalculate($plan['moon'], $plan['saturn'], $plan['ascendant']);
            $Agni39 = $this->agnicalculate($plan['saturn'], $plan['mars'], $plan['ascendant']);
            //    $Agni40 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni41 = $this->agnicalculate($plan['saturn'], $Agni1Value, $plan['ascendant']);
            //    $Agni42 = $this->agnicalculate($plan['sun'],$plan['moon'],$plan['ascendant']);
            $Agni4Value = $Agni4[0]['result'];
            $Agni5Value = $Agni5[0]['result'];
            $Agni6Value = $Agni6[0]['result'];
            $Agni7Value = $Agni7[0]['result'];
            // $Agni8Value = $Agni8[0]['result'];
            $Agni9Value = $Agni9[0]['result'];
            $Agni10Value = $Agni10[0]['result'];
            $Agni11Value = $Agni11[0]['result'];
            $Agni12Value = $Agni12[0]['result'];
            $Agni13Value = $Agni13[0]['result'];
            $Agni14Value = $Agni14[0]['result'];
            $Agni15Value = $Agni15[0]['result'];
            $Agni16Value = $Agni16[0]['result'];
            $Agni17Value = $Agni17[0]['result'];
            $Agni18Value = $Agni18[0]['result'];
            // $Agni19Value = $Agni19[0]['result'];
            $Agni20Value = $Agni20[0]['result'];
            // $Agni21Value = $Agni21[0]['result'];
            $Agni22Value = $Agni22[0]['result'];
            $Agni23Value = $Agni23[0]['result'];
            // $Agni24Value = $Agni24[0]['result'];
            // $Agni25Value = $Agni25[0]['result'];
            // $Agni26Value = $Agni26[0]['result'];
            $Agni27Value = $Agni27[0]['result'];
            $Agni28Value = $Agni28[0]['result'];
            $Agni29Value = $Agni29[0]['result'];
            // $Agni30Value = $Agni30[0]['result'];
            $Agni31Value = $Agni31[0]['result'];
            $Agni32Value = $Agni32[0]['result'];
            // $Agni33Value = $Agni33[0]['result'];
            $Agni34Value = $Agni34[0]['result'];
            $Agni35Value = $Agni35[0]['result'];
            $Agni36Value = $Agni36[0]['result'];
            $Agni37Value = $Agni37[0]['result'];
            $Agni38Value = $Agni38[0]['result'];
            $Agni39Value = $Agni39[0]['result'];
            // $Agni40Value = $Agni40[0]['result'];
            $Agni41Value = $Agni41[0]['result'];
            // $Agni42Value = $Agni42[0]['result'];

            $results = [

                'Agni1' => ['result' => $Agni1Value, 'agnidata' => $Agni1[0]['agnidata']],
                'Agni2' => ['result' => $Agni2Value, 'agnidata' => $Agni2[0]['agnidata']],
                'Agni3' => ['result' => $Agni3Value, 'agnidata' => $Agni3[0]['agnidata']],
                'Agni4' => ['result' => $Agni4Value, 'agnidata' => $Agni4[0]['agnidata']],
                'Agni5' => ['result' => $Agni5Value, 'agnidata' => $Agni5[0]['agnidata']],
                'Agni6' => ['result' => $Agni6Value, 'agnidata' => $Agni6[0]['agnidata']],
                'Agni7' => ['result' => $Agni7Value, 'agnidata' => $Agni7[0]['agnidata']],
                // 'Agni8' => ['result' => $Agni8Value, 'agnidata' => $Agni8[0]['agnidata']],
                'Agni9' => ['result' => $Agni9Value, 'agnidata' => $Agni9[0]['agnidata']],
                'Agni10' => ['result' => $Agni10Value, 'agnidata' => $Agni10[0]['agnidata']],
                'Agni11' => ['result' => $Agni11Value, 'agnidata' => $Agni11[0]['agnidata']],
                'Agni12' => ['result' => $Agni12Value, 'agnidata' => $Agni12[0]['agnidata']],
                'Agni13' => ['result' => $Agni13Value, 'agnidata' => $Agni13[0]['agnidata']],
                'Agni14' => ['result' => $Agni14Value, 'agnidata' => $Agni14[0]['agnidata']],
                'Agni15' => ['result' => $Agni15Value, 'agnidata' => $Agni15[0]['agnidata']],
                'Agni16' => ['result' => $Agni16Value, 'agnidata' => $Agni16[0]['agnidata']],
                'Agni17' => ['result' => $Agni17Value, 'agnidata' => $Agni17[0]['agnidata']],
                'Agni18' => ['result' => $Agni18Value, 'agnidata' => $Agni18[0]['agnidata']],
                // 'Agni19' => ['result' => $Agni19Value, 'agnidata' => $Agni19[0]['agnidata']],
                'Agni20' => ['result' => $Agni20Value, 'agnidata' => $Agni20[0]['agnidata']],
                // 'Agni21' => ['result' => $Agni21Value, 'agnidata' => $Agni21[0]['agnidata']],
                'Agni22' => ['result' => $Agni22Value, 'agnidata' => $Agni22[0]['agnidata']],
                'Agni23' => ['result' => $Agni23Value, 'agnidata' => $Agni23[0]['agnidata']],
                // 'Agni24' => ['result' => $Agni24Value, 'agnidata' => $Agni24[0]['agnidata']],
                // 'Agni25' => ['result' => $Agni25Value, 'agnidata' => $Agni25[0]['agnidata']],
                // 'Agni26' => ['result' => $Agni26Value, 'agnidata' => $Agni26[0]['agnidata']],
                'Agni27' => ['result' => $Agni27Value, 'agnidata' => $Agni27[0]['agnidata']],
                'Agni28' => ['result' => $Agni28Value, 'agnidata' => $Agni28[0]['agnidata']],
                'Agni29' => ['result' => $Agni29Value, 'agnidata' => $Agni29[0]['agnidata']],
                // 'Agni30' => ['result' => $Agni30Value, 'agnidata' => $Agni30[0]['agnidata']],
                'Agni31' => ['result' => $Agni31Value, 'agnidata' => $Agni31[0]['agnidata']],
                'Agni32' => ['result' => $Agni32Value, 'agnidata' => $Agni32[0]['agnidata']],
                // 'Agni33' => ['result' => $Agni33Value, 'agnidata' => $Agni33[0]['agnidata']],
                'Agni34' => ['result' => $Agni34Value, 'agnidata' => $Agni34[0]['agnidata']],
                'Agni35' => ['result' => $Agni35Value, 'agnidata' => $Agni35[0]['agnidata']],
                'Agni36' => ['result' => $Agni36Value, 'agnidata' => $Agni36[0]['agnidata']],
                'Agni37' => ['result' => $Agni37Value, 'agnidata' => $Agni37[0]['agnidata']],
                'Agni38' => ['result' => $Agni38Value, 'agnidata' => $Agni38[0]['agnidata']],
                'Agni39' => ['result' => $Agni39Value, 'agnidata' => $Agni39[0]['agnidata']],
                // 'Agni40' => ['result' => $Agni40Value, 'agnidata' => $Agni40[0]['agnidata']],
                'Agni41' => ['result' => $Agni41Value, 'agnidata' => $Agni41[0]['agnidata']],
                // 'Agni42' => ['result' => $Agni42Value, 'agnidata' => $Agni42[0]['agnidata']],

            ];
        }

        $timeOfDay = $isDayTime ? 'Day' : 'Night';
        $results = ['timeOfDay' => $timeOfDay, 'result' => $results];


        return $results;
    }
    private function isDayTimeBasedOnTime($birthTime, $sunriseTime, $sunsetTime, $city)
    {
        // Convert the times to DateTime objects with error checking
        $birthTimeObj = \DateTime::createFromFormat('g:i:s A', $birthTime);
        $sunriseTimeObj = \DateTime::createFromFormat('g:i:s A', $sunriseTime);
        $sunsetTimeObj = \DateTime::createFromFormat('g:i:s A', $sunsetTime);

        // Check if birth time is between sunrise and sunset (daytime)
        if ($birthTimeObj >= $sunriseTimeObj && $birthTimeObj < $sunsetTimeObj) {
            return true;  // Daytime
        } else {
            return false; // Nighttime
        }
    }
    private function agnicalculate($a, $b, $c)
    {
        // Check if variables are arrays or not strings, then convert to strings
        $a = (is_array($a) ? implode(' ', $a) : (string)$a);
        $b = (is_array($b) ? implode(' ', $b) : (string)$b);
        $c = (is_array($c) ? implode(' ', $c) : (string)$c);



        // Cast to float
        $a = (float)$a;
        $b = (float)$b;
        $c = (float)$c;

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

        // Query zodiac data
        $agnidata = DB::table('zodiac')->where('s_degree', '<=', $d)->where('l_degree', '>=', $d)->first();

        $results[] = [
            'agnidata' => $agnidata,
            'result' => $d

        ];
        return $results;
    }
    private function planetsinput(Kundali $kundali)
    {
        $plan = []; // Initialize the correct array

        // Loop through each planet
        foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet) {
            // Fetch degrees and DMS values
            $niray_degree = (float) $kundali->{'niray_degree_' . $planet};
            $sary_degree = (float) $kundali->{'sary_degree_' . $planet};
            $saryana_dms = $kundali->{'saryana_dms_' . $planet};
            $nirayana_dms =  $kundali->{'nirayana_dms_' . $planet};

            // Initialize degree to 0 by default
            $degree = 0;

            // Determine the degree based on available DMS values
            if ($saryana_dms != '0° 0\' 00"') {
                $degree = (float) $this->convertDmsToDecimal($saryana_dms);
            } elseif ($nirayana_dms != '0° 0\' 00"') {
                $degree = (float) $this->convertDmsToDecimal($nirayana_dms);
            } elseif ($niray_degree != 0) {
                $degree = (float) $niray_degree;
            } elseif ($sary_degree != 0) {
                $degree = (float) $sary_degree;
            }

            // Store the calculated degree and other relevant data in the planets array
            $plan[$planet] = [
                'degree' => $degree
            ];
        }
        return $plan;
    }
    private function getlaganlord(Kundali $kundali,$lagan){
        $laganlord =[];
       
    }

}
