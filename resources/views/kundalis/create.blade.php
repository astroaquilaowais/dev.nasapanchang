@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                        Welcome, {{ Auth::user()->name }}
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John">
                        </div>
                        <div class="h5 text-center">
                            <strong>{{ Auth::user()->name }} </strong>
                            <p class="h6 mt-2 text-muted">5 Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-lg mt-3">
                    <div class="card-header  text-white">
                        Navigation
                    </div>
                    <div class="card-body sidebar">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('layouts.message')
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Add records
                    </div>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">

                        <form action="{{ route('kundalis.store') }}" method="post" enctype="multipart/form-data"
                            onsubmit="validateForm(event)">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="name" name="name"
                                    id="title" />
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Birth Place (Country)</label>
                                <input type="text" class="form-control" placeholder="country" name="country"
                                    id="locality" />
                                @error('author')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthplace">Birth Place</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state" required>
                                    </div>
                                    <div class="col">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="col">
                                        <label for="locality">Locality</label>
                                        <input type="" class="form-control" id="locality" name="locality" required>
                                    </div>
                                </div>

                                @error('author')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pin" class="form-label">Birth Place (Pin)</label>
                                <input type="text" class="form-control" placeholder="locality" name="pin"
                                    id="pin" />
                                @error('author')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                            </div>
                            @error('author')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            <div class="mb-3">
                                <label for="tob">Time of Birth</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="hour">Hour</label>
                                        <input type="number" class="form-control" value="0" id="hour"
                                            name="hour" min="0" max="12" required>
                                    </div>
                                    <div class="col">
                                        <label for="minute">Minute</label>
                                        <input type="number" class="form-control" value="0" id="minute"
                                            name="minute" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="second">Second</label>
                                        <input type="number" class="form-control" value="0" id="second"
                                            name="second" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="tob_ampm">AM/PM</label>
                                        <select class="form-control" name="tob_ampm" id="tob_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                @error('tob')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <h3><strong>Direction</strong></h3>
                            <div class="row mb-3 ">
                                <label for="gmt_birthtime">
                                    <h4>GMT at Birth Time</h4>
                                </label>

                                <div class="col">
                                    <label for="gmt_birth_hour">Hour</label>
                                    <input type="number" class="form-control" value="0" id="gmt_birth_hour"
                                        name="gmt_birth_hour" min="0" max="12" required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_minute">Minute</label>
                                    <input type="number" class="form-control" value="0" id="gmt_birth_minute"
                                        name="gmt_birth_minute" min="0" max="59" required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_second">Second</label>
                                    <input type="number" class="form-control" value="0" id="gmt_birth_second"
                                        name="gmt_birth_second" min="0" max="59" required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_ampm">AM/PM</label>
                                    <select class="form-control" name="gmt_birth_ampm" id="gmt_birth_ampm" required>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>


                                <div class="col">
                                    <label for="gmt_birth_date">GMT at Birth Date</label>
                                    <input type="date" class="form-control" name="gmt_birth_date" id="gmt_birth_date"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_direction">Direction</label>
                                    <select class="form-control" name="gmt_birth_direction" id="gmt_birth_direction"
                                        required>
                                        <option value="gmt">GMT</option>
                                        <option value="zctcst">ZCT/CST</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3 ">
                                <label for="lmt_birthtime">
                                    <h4>LMT at Birth Time</h4>
                                </label>

                                <div class="col">
                                    <label for="lmt_birth_hour">Hour</label>
                                    <input type="number" class="form-control" value="0" id="lmt_birth_hour"
                                        name="lmt_birth_hour" min="0" max="12" required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_minute">Minute</label>
                                    <input type="number" class="form-control" value="0" id="lmt_birth_minute"
                                        name="lmt_birth_minute" min="0" max="59" required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_second">Second</label>
                                    <input type="number" class="form-control" value="0" id="lmt_birth_second"
                                        name="lmt_birth_second" min="0" max="59" required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_ampm">AM/PM</label>
                                    <select class="form-control" name="lmt_birth_ampm" id="lmt_birth_ampm" required>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>


                                <div class="col">
                                    <label for="lmt_birth_date">LMT at Birth Date</label>
                                    <input type="date" class="form-control" name="lmt_birth_date" id="lmt_birth_date"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth">Direction</label>
                                    <select class="form-control" name="lmt_birth_direction" id="lmt_birth_direction"
                                        required>
                                        <option value="gmt">GMT</option>
                                        <option value="zctcst">ZCT/CST</option>
                                    </select>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="latitude_longitude">
                                    <h4>Laditude/Logitude</h4>
                                </label>
                                <div class="col">
                                    <label for="latitude_plusminus">plus/minus</label>
                                    <select class="form-control" name="latitude_plusminus" id="latitude_direction"
                                        required>
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="latitude"> Latitude</label>
                                    <input type="number" class="form-control" name="latitude" id="latitude"
                                        value="0" min="0" max="360" step="any" required>
                                </div>

                                <div class="col">
                                    <label for="latitude_direction">Direction</label>
                                    <select class="form-control" name="latitude_direction" id="latitude_direction"
                                        required>
                                        <option value="North">N</option>
                                        <option value="South">S</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="longitude_plusminus">plus/minus</label>
                                    <select class="form-control" name="longitude_plusminus" id="longitude_direction"
                                        required>
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="longitude">Longitude</label>
                                    <input type="number" class="form-control" name="longitude" id="longitude"
                                        value="0" min="0" max="360" step="any" required>
                                </div>
                                <div class="col">
                                    <label for="longitude_direction">Direction</label>
                                    <select class="form-control" name="longitude_direction" id="longitude_direction"
                                        required>
                                        <option value="East">E</option>
                                        <option value="West">W</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="gmt">
                                    <h4>Sidereal Time on GMT</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="hour_gmt">Hour</label>
                                        <input type="number" class="form-control" value="0" id="hour_gmt"
                                            name="hour_gmt" min="0" max="12" required>
                                    </div>
                                    <div class="col">
                                        <label for="minute_gmt">Minute</label>
                                        <input type="number" class="form-control" value="0" id="minute_gmt"
                                            name="minute_gmt" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="second_gmt">Second</label>
                                        <input type="number" class="form-control" value="0" id="second_gmt"
                                            name="second_gmt" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="gmt_ampm">AM/PM</label>
                                        <select class="form-control" name="gmt_ampm" id="gmt_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                @error('GMT')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lmt">
                                    <h4>Sidereal Time on LMT</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="hour_lmt">Hour</label>
                                        <input type="number" class="form-control" value="0" id="hour_lmt"
                                            name="hour_lmt" min="0" max="23" required>
                                    </div>
                                    <div class="col">
                                        <label for="minute_lmt">Minute</label>
                                        <input type="number" class="form-control" value="0" id="minute_lmt"
                                            name="minute_lmt" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="second_lmt">Second</label>
                                        <input type="number" class="form-control" value="0" id="second_lmt"
                                            name="second_lmt" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="lmt_ampm">AM/PM</label>
                                        <select class="form-control" name="lmt_ampm" id="lmt_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                @error('LMT')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="dst">
                                    <h4>DST</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="dst_plusminus">plus/minus</label>
                                        <select class="form-control" name="dst_plusminus" id="dst_plusminus" required>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="hour_dst">Hour</label>
                                        <input type="number" class="form-control" value="0" id="hour_dst"
                                            name="hour_dst" min="0" max="23" required>
                                    </div>
                                    <div class="col">
                                        <label for="minute_dst">Minute</label>
                                        <input type="number" class="form-control" value="0" id="minute_dst"
                                            name="minute_dst" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="second_dst">Second</label>
                                        <input type="number" class="form-control" value="0" id="second_dst"
                                            name="second_dst" min="0" max="59" required>
                                    </div>

                                </div>

                                @error('dst')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="subtime">
                                    <h4>ADD/SUB TIME</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="subtime_plusminus">plus/minus</label>
                                        <select class="form-control" name="subtime_plusminus" id="subtime_plusminus"
                                            required>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="hour_subtime">Hour</label>
                                        <input type="number" class="form-control" value="0" id="hour_subtime"
                                            name="hour_subtime" min="0" max="23" required>
                                    </div>
                                    <div class="col">
                                        <label for="minute_subtime">Minute</label>
                                        <input type="number" class="form-control" value="0" id="minute_subtime"
                                            name="minute_subtime" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="second_subtime">Second</label>
                                        <input type="number" class="form-control" value="0" id="second_subtime"
                                            name="second_subtime" min="0" max="59" required>
                                    </div>

                                </div>

                                @error('subtime')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="timezone">
                                    <h4>Time Zone</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="timezone_plusminus">plus/minus</label>
                                        <select class="form-control" name="timezone_plusminus" id="timezone_plusminus"
                                            required>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="timezone_time">Time</label>
                                        <input type="time" class="form-control" name="timezone_time"
                                            id="timezone_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <label for="timedifference">
                                    <h4>Time Difference</h4>
                                </label>
                                <div class="col">
                                    <label for="timedifference_plusminus">plus/minus</label>
                                    <select class="form-control" name="timedifference_plusminus"
                                        id="timedifference_plusminus" required>
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="hour_timedifference">Hour</label>
                                    <input type="number" class="form-control" value="0" id="hour_timedifference"
                                        name="hour_timedifference" min="0" max="12" required>
                                </div>
                                <div class="col">
                                    <label for="minute_timedifference">Minute</label>
                                    <input type="number" class="form-control" value="0" id="minute_timedifference"
                                        name="minute_timedifference" min="0" max="59" required>
                                </div>
                                <div class="col">
                                    <label for="second_timedifference">Second</label>
                                    <input type="number" class="form-control" value="0" id="second_timedifference"
                                        name="second_timedifference" min="0" max="59" required>
                                </div>





                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="cst">
                                            <h4>CST</h4>
                                        </label>
                                        <input type="number" class="form-control" name="cst" id="cst"
                                            value="0" min="0" step="any" max="360" required>
                                    </div>
                                    <div class="col">
                                        <label for="juliyan">
                                            <h4>Julian Day</h4>
                                        </label>
                                        <input type="number" class="form-control" name="juliyan" id="cst"
                                            value="0" min="0" step="any" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <label for="ayan">
                                        <h4>Ayanamsa</h4>
                                    </label>
                                    <div class="col">
                                        <label for="ayan_degree">Degree</label>
                                        <input type="number" class="form-control" name="ayan_degree" value="0"
                                            id="ayan_degree" min="0" max="360" required>
                                    </div>
                                    <div class="col">
                                        <label for="ayan_minute">Minute</label>
                                        <input type="number" class="form-control" name="ayan_minute" value="0"
                                            id= "ayan_minute" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="ayan_second">Second</label>
                                        <input type="number" class="form-control" name="ayan_second" value="0"
                                            id="ayan_second" min="0" max="59" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ayan_name" class="form-label">
                                    <h4>Ayanamsa Name</h4>
                                </label>
                                <input type="text" class="form-control" name="ayan_name" id="ayan_name" />
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <h3>Sun Rise/Set Times</h3>
                            @foreach (['yesterday', 'today', 'tomorrow'] as $day)
                                <h2> {{ ucfirst($day) }}</h2>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_hour"> Sunrise Hour</label>
                                        <input type="number" class="form-control"
                                            name="sun_rise_{{ $day }}_hour"
                                            id="sun_rise_{{ $day }}_hour" min="0" max="12"
                                            value="0" required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_minute"> Sunrise
                                            Min</label>
                                        <input type="number" class="form-control"
                                            name="sun_rise_{{ $day }}_minute" value="0"
                                            id="sun_rise_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_second"> Sunrise
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="sun_rise_{{ $day }}_second" value="0"
                                            id="sun_rise_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="sun_rise_{{ $day }}_ampm"
                                            id="sun_rise_{{ $day }}_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="sun_set__hour"> Sunset Hour

                                        </label>
                                        <input type="number" class="form-control"
                                            name="sun_set_{{ $day }}_hour" value="0"
                                            id="sun_set_{{ $day }}_hour" min="0" max="12"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_set_{{ $day }}_minute"> Sunset
                                            Min</label>
                                        <input type="number" class="form-control"
                                            name="sun_set_{{ $day }}_minute" value="0"
                                            id="sun_set_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_set_{{ $day }}_second"> Sunset
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="sun_set_{{ $day }}_second" value="0"
                                            id="sun_set_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_set_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="sun_set_{{ $day }}_ampm"
                                            id="sun_set_{{ $day }}_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">
                                                PM</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <h3>Moon Rise/Set Times</h3>
                            @foreach (['yesterday', 'today', 'tomorrow'] as $day)
                                <h2>{{ ucfirst($day) }}</h2>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_hour"> Moonrise
                                            Hour</label>
                                        <input type="number" class="form-control"
                                            name="moon_rise_{{ $day }}_hour" value="0"
                                            id="moon_rise_{{ $day }}_hour" min="0" max="12"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_minute"> Moonrise
                                            Min</label>
                                        <input type="number" class="form-control" value="0"
                                            name="moon_rise_{{ $day }}_minute"
                                            id="moon_rise_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_second"> Moonrise
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="moon_rise_{{ $day }}_second" value="0"
                                            id="moon_rise_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="moon_rise_{{ $day }}_ampm"
                                            id="moon_rise_{{ $day }}_ampm" required>
                                            <option value="AM">
                                                AM</option>
                                            <option value="PM">
                                                PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_hour">Moonset
                                            Hour</label>
                                        <input type="number" class="form-control" value="0"
                                            name="moon_set_{{ $day }}_hour"
                                            id="moon_set_{{ $day }}_hour" min="0" max="12"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_minute"> Moonset
                                            Min</label>
                                        <input type="number" class="form-control" value="0"
                                            name="moon_set_{{ $day }}_minute"
                                            id="moon_set_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_second"> Moonset
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="moon_set_{{ $day }}_second" value="0"
                                            id="moon_set_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="moon_set_{{ $day }}_ampm"
                                            id="moon_set_{{ $day }}_ampm" required>
                                            <option value="AM">
                                                AM</option>
                                            <option value="PM">
                                                PM</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <label for="choice">
                                <h3>Choose between Degree and DMS:</h3>
                            </label>
                            <select name="choice" class="form-control" id="choice" onchange="showSubChoices()">
                                <option value="">--Select--</option>
                                <option value="degree">Degree</option>
                                <option value="dms">DMS</option>
                            </select>

                            <div id="sub-choices" class="mb-3" style="display: none;" onchange="submitForm()">
                                <label for="sub_choice">Choose an Option:</label>
                                <select name="sub_choice" id="sub_choice" class="form-control"
                                    onchange="showDynamicForm()">
                                    <!-- Options will be dynamically generated -->
                                </select>
                            </div>

                            <!-- Dynamic Forms Here -->
                            <div id="saryana_dms" class="dynamic-form" style="display: none;">
                                @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                    <div class="row">
                                        <label for="{{ $planet }}">{{ ucfirst($planet) }}</label>
                                        <div class="col">
                                            <label for="saryana_degree_{{ $planet }}">Degree
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="saryana_degree_{{ $planet }}" value="0"
                                                id="saryana_degree_{{ $planet }}" min="0" max="360">
                                        </div>
                                        <div class="col">
                                            <label for="saryana_minute_{{ $planet }}">Minute
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="saryana_minute_{{ $planet }}" value="0"
                                                id="saryana_minute_{{ $planet }}" min="0" max="59">
                                        </div>
                                        <div class="col">
                                            <label for="saryana_second_{{ $planet }}">Second
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="saryana_second_{{ $planet }}" value="0"
                                                id="saryana_second_{{ $planet }}" min="0" max="59">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="nirayana_dms" class="dynamic-form" style="display: none;">
                                @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                    <div class="row">
                                        <label for="{{ $planet }}">{{ ucfirst($planet) }}</label>
                                        <div class="col">
                                            <label for="nirayana_degree_{{ $planet }}">Degree
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="nirayana_degree_{{ $planet }}" value="0"
                                                id="nirayana_degree_{{ $planet }}" min="0" max="360">
                                        </div>
                                        <div class="col">
                                            <label for="nirayana_minute_{{ $planet }}">Minute
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="nirayana_minute_{{ $planet }}" value="0"
                                                id= "nirayana_minute_{{ $planet }}" min="0" max="59">
                                        </div>
                                        <div class="col">
                                            <label for="nirayana_second_{{ $planet }}">Second
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="nirayana_second_{{ $planet }}" value="0"
                                                id="nirayana_second_{{ $planet }}" min="0" max="59">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Nirayana Degree -->
                            <div id="niray_degree" class="dynamic-form" style="display: none;">
                                <div class="mb-3">
                                    <div class="row">
                                        @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                            <div class="col-3">
                                                <label
                                                    for="niray_degree_{{ $planet }}">{{ ucfirst($planet) }}</label>
                                                <input type="number" class="form-control"
                                                    id="niray_degree_{{ $planet }}" step="any" value="0"
                                                    name="niray_degree_{{ $planet }}" min="0"
                                                    max="360">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Saryana Degree -->
                            <div id="sary_degree" class="dynamic-form" style="display: none;">
                                <div class="mb-3">
                                    <div class="row">
                                        @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                            <div class="col-3">
                                                <label
                                                    for="sary_degree_{{ $planet }}">{{ ucfirst($planet) }}</label>
                                                <input type="number" class="form-control" step="any"
                                                    id="sary_degree_{{ $planet }}" value="0"
                                                    name="sary_degree_{{ $planet }}" min="0"
                                                    max="360">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="planet_degree_selection" class="mb-3" style="display: none;">
                                <label for="planet_selection">Select Planets:</label>
                                <select name="planet_selection" id="planet_selection" class="form-control"
                                    onchange="showPlanetForm()">
                                    <option value="">--Select Planet--</option>
                                    @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                        <option value="{{ $planet }}">{{ ucfirst($planet) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="planet_degree_form" class="dynamic-form mt-3" style="display: none;">
                                <h4>Degree Input for <span id="selected_planet"></span></h4>
                                <label for="degree_input">Planet Degree:</label>
                                <input type="number" id="degree_input" class="form-control" min="0"
                                    max="360" step="any" onchange="updateDegrees()" name="degree_input" required>
                                @foreach (range(1, 12) as $house)
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="house{{ $house }}">House</label>
                                            <input type="number" class="form-control" name="house{{ $house }}"
                                                id="{{ $house }}" value="{{ $house }}"
                                                >
                                        </div>
                                        <div class="col">
                                            <label for="starting_degree{{ $house }}">Starting Degree</label>
                                            <input type="number" class="form-control"
                                                name="starting_degree{{ $house }}"
                                                id="starting_degree{{ $house }}" min="0" max="360"
                                                value="0" oninput="calculateRange({{ $house }})">
                                        </div>
                                        <div class="col">
                                            <label for="ending_degree{{ $house }}">Ending Degree</label>
                                            <input type="number" class="form-control"
                                                name="ending_degree{{ $house }}"
                                                id="ending_degree{{ $house }}" min="0" max="360"
                                                value="0" oninput="calculateRange({{ $house }})">
                                        </div>
                                        <div class="col">
                                            <label for="range{{ $house }}">Range</label>
                                            <input type="number" class="form-control" name="range{{ $house }}"
                                                id="range{{ $house }}" min="0" max="360"
                                                value="0">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Form to Display Selected Planet Degree Range -->


                            <button type="submit" class="btn btn-primary mb-3 mt-3">Submit</button>
                        </form>

                        <script>
                            function showSubChoices() {
                                const choice = document.getElementById('choice').value;
                                const subChoices = document.getElementById('sub-choices');
                                const subChoiceSelect = document.getElementById('sub_choice');

                                subChoiceSelect.innerHTML = '';

                                if (choice === 'degree') {
                                    subChoices.style.display = 'block';
                                    subChoiceSelect.innerHTML += '<option value="">--Select--</option>';
                                    subChoiceSelect.innerHTML += '<option value="niray_degree">Nirayana (Degree)</option>';
                                    subChoiceSelect.innerHTML += '<option value="sary_degree">Saryana (Degree)</option>';

                                } else if (choice === 'dms') {
                                    subChoices.style.display = 'block';
                                    subChoiceSelect.innerHTML += '<option value="">--Select--</option>';
                                    subChoiceSelect.innerHTML += '<option value="nirayana_dms">Nirayana (DD:MM:SS)</option>';
                                    subChoiceSelect.innerHTML += '<option value="saryana_dms">Saryana (DD:MM:SS)</option>';

                                } else {
                                    subChoices.style.display = 'none';
                                    hideAllDynamicForms();
                                }
                            }

                            function showDynamicForm() {
                                const subChoice = document.getElementById('sub_choice').value;
                                hideAllDynamicForms();

                                if (subChoice === 'saryana_dms') {
                                    document.getElementById('saryana_dms').style.display = 'block';
                                } else if (subChoice === 'nirayana_dms') {
                                    document.getElementById('nirayana_dms').style.display = 'block';
                                } else if (subChoice === 'sary_degree') {
                                    document.getElementById('sary_degree').style.display = 'block';
                                } else if (subChoice === 'niray_degree') {
                                    document.getElementById('niray_degree').style.display = 'block';
                                }

                                // Add other cases similarly...
                            }

                            function hideAllDynamicForms() {
                                document.getElementById('saryana_dms').style.display = 'none';

                                document.getElementById('nirayana_dms').style.display = 'none';
                                document.getElementById('sary_degree').style.display = 'none';
                                document.getElementById('niray_degree').style.display = 'none';

                                // Hide other forms similarly...
                            }

                            function validateForm(event) {
                                const requiredFields = document.querySelectorAll('[required]');
                                let valid = true;

                                requiredFields.forEach(field => {
                                    if (field.offsetParent !== null && !field
                                        .checkValidity()) { // Only check if the field is visible
                                        valid = false;
                                        field.focus(); // Set focus on the first invalid field
                                    }
                                });

                                if (!valid) {
                                    event.preventDefault(); // Prevent form submission
                                    alert('Please fill all required fields that are visible.');
                                }
                            }

                            function submitForm() {
                                const subChoice = document.getElementById('sub_choice').value;
                                if (subChoice) {
                                    document.getElementById('planet_degree_selection').style.display = 'block';
                                } else {
                                    document.getElementById('planet_degree_selection').style.display = 'none';
                                }
                            }

                            function getAllPlanetData() {
                                const planets = ['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'];
                                const planetData = {};

                                planets.forEach(planet => {
                                    planetData[planet] = {
                                        niray_degree: document.getElementById(`niray_degree_${planet}`).value,
                                        sary_degree: document.getElementById(`sary_degree_${planet}`).value,
                                        nirayana: {
                                            degree: document.getElementById(`nirayana_degree_${planet}`).value,
                                            minute: document.getElementById(`nirayana_minute_${planet}`).value,
                                            second: document.getElementById(`nirayana_second_${planet}`).value
                                        },
                                        saryana: {
                                            degree: document.getElementById(`saryana_degree_${planet}`).value,
                                            minute: document.getElementById(`saryana_minute_${planet}`).value,
                                            second: document.getElementById(`saryana_second_${planet}`).value
                                        }
                                    };
                                });

                                return planetData;
                            }

                            // Display selected planet data in the planet_degree_form
                            function showPlanetForm() {
                                const selectedPlanet = document.getElementById("planet_selection").value;
                                if (!selectedPlanet) {
                                    document.getElementById("planet_degree_form").style.display = "none";
                                    return;
                                }

                                const planetData = getAllPlanetData();
                                const planetInfo = planetData[selectedPlanet];

                                // Set the selected planet name and display degree values
                                document.getElementById("selected_planet").innerText = selectedPlanet.charAt(0).toUpperCase() + selectedPlanet
                                    .slice(1);
                                document.getElementById("degree_input").value = planetInfo.niray_degree;

                                // Make planet degree form visible
                                document.getElementById("planet_degree_form").style.display = "block";
                            }


                            function updateDegrees() {
                                const selectedPlanet = document.getElementById("planet_selection").value;
                                const planetDegree = parseFloat(document.getElementById('degree_input').value) || 0;
                                if (selectedPlanet) {
                                const numberOfHouses = 12;
                                const fixedRanges = [];
                                const houseWidth = 30;

                                // Calculate starting and ending degrees based on the input degree
                                const baseDegree = Math.floor(planetDegree / houseWidth) * houseWidth;

                                // Define ranges for each house based on the base degree
                                for (let house = 0; house < numberOfHouses; house++) {
                                    const startingDegree = (baseDegree + house * houseWidth) % 360;
                                    const endingDegree = (startingDegree + houseWidth) % 360;
                                    fixedRanges.push({
                                        starting: startingDegree,
                                        ending: endingDegree
                                    });

                                    // Adjust the ending degree to ensure it goes to 360, not 0
                                    if (endingDegree === 0) {
                                        fixedRanges.push({
                                            starting: startingDegree,
                                            ending: 360
                                        });
                                    } else {
                                        fixedRanges.push({
                                            starting: startingDegree,
                                            ending: endingDegree
                                        });
                                    }

                                    // Set values in the inputs
                                    document.getElementById(`starting_degree${house + 1}`).value = startingDegree;
                                    document.getElementById(`ending_degree${house + 1}`).value = endingDegree === 0 ? 360 : endingDegree;
                                }
                            }
                            }

                            function updateHouseDegrees(house) {
                                const startingDegree = parseFloat(document.getElementById(`starting_degree${house}`).value);
                                const endingDegree = parseFloat(document.getElementById(`ending_degree${house}`).value);

                                // Validate the input
                                if (isNaN(startingDegree) || isNaN(endingDegree) || startingDegree >= endingDegree) {
                                    alert('Invalid degrees. Make sure starting is less than ending.');
                                    return;
                                }

                                const currentHouseWidth = endingDegree - startingDegree;;

                                // Calculate total width of previous houses
                                let totalWidthOfPreviousHouses = 0;
                                for (let i = 1; i < house; i++) {
                                    const prevEndingDegree = parseFloat(document.getElementById(`ending_degree${i}`).value);
                                    const prevStartingDegree = parseFloat(document.getElementById(`starting_degree${i}`).value);
                                    totalWidthOfPreviousHouses += (prevEndingDegree - prevStartingDegree);
                                }

                                // Calculate remaining degrees
                                let remainingDegrees = 360 - totalWidthOfPreviousHouses - currentHouseWidth;
                                let remainingHouses = 12 - house;

                                // Calculate the width for the remaining houses
                                // Calculate the width for the remaining houses
                                const newHouseWidth = remainingHouses > 0 ? remainingDegrees / remainingHouses : 0;

                                let currentStartingDegree = endingDegree;

                                for (let i = house; i < 12; i++) {
                                    currentStartingDegree = normalizeDegree(currentStartingDegree);
                                    let newEndingDegree = currentStartingDegree + newHouseWidth;

                                    newEndingDegree = normalizeDegree(newEndingDegree);

                                    // Update the starting and ending degrees for the next house
                                    document.getElementById(`starting_degree${i + 1}`).value = currentStartingDegree;
                                    document.getElementById(`ending_degree${i + 1}`).value = newEndingDegree === 0 ? 360 : newEndingDegree;

                                    // Set the range value for the current house



                                    currentStartingDegree = newEndingDegree;
                                }
                            }

                            function normalizeDegree(degree) {
                                return degree >= 360 ? degree % 360 : degree;
                            }

                            for (let i = 1; i <= 12; i++) {
                                document.getElementById(`starting_degree${i}`).addEventListener('change', () => updateHouseDegrees(i));
                                document.getElementById(`ending_degree${i}`).addEventListener('change', () => updateHouseDegrees(i));
                            }

                            function calculateRange(house) {
                                const startingDegree = parseInt(document.getElementById(`starting_degree${house}`).value) || 0;
                                const endingDegree = parseInt(document.getElementById(`ending_degree${house}`).value) || 0;
                                const range = Math.max( endingDegree - startingDegree); // Ensure range is not negative

                                document.getElementById(`range${house}`).value = range;
                            }
                        </script>





                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>


@endsection
