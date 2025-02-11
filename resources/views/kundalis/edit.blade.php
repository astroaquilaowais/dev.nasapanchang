@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                        {{-- Welcome, {{ Auth::user()->name }} --}}
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John">
                        </div>
                        <div class="h5 text-center">
                            {{-- <strong>{{ Auth::user()->name }} </strong> --}}
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

                        <?php $tob = $kundali->tob;

                        $data = explode(':', $tob);
                        $data1 = explode(' ', $data[2]);

                        ?>
                        <form action="{{ route('kundalis.update', $kundali->id) }}" method="post"
                            enctype="multipart/form-data" onsubmit="return validateForm(event)">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Name" name="name" value="{{ old('name', $kundali->name) }}"
                                    id="name" required />
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Birth Place (Country)</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    placeholder="Country" name="country" value="{{ old('country', $kundali->country) }}"
                                    id="country" required />
                                @error('country')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="birthplace">Birth Place</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror"
                                            value="{{ old('state', $kundali->state) }}" id="state" name="state"
                                            required>
                                        @error('state')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            id="city" name="city" value="{{ old('city', $kundali->city) }}"
                                            required>
                                        @error('city')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="locality">Locality</label>
                                        <input type="text" class="form-control @error('locality') is-invalid @enderror"
                                            id="locality" name="locality"
                                            value="{{ old('locality', $kundali->locality) }}" required>
                                        @error('locality')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="pin" class="form-label">Birth Place (Pin)</label>
                                <input type="text" class="form-control @error('pin') is-invalid @enderror"
                                    placeholder="Pin" value="{{ old('pin', $kundali->pin) }}" name="pin"
                                    id="pin" />
                                @error('pin')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob"
                                    name="dob" value="{{ old('dob', $kundali->dob) }}" required>
                                @error('dob')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">

                                <label for="tob">Time of Birth</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="hour">Hour</label>
                                        <input type="number" class="form-control @error('hour') is-invalid @enderror"
                                            id="hour" value="{{ old('hour', $data[0] ?? '0') }}" name="hour"
                                            min="0" max="12" required>
                                        @error('hour')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="minute">Minute</label>
                                        <input type="number" class="form-control @error('minute') is-invalid @enderror"
                                            id="minute" name="minute" value="{{ old('minute', $data[1] ?? '0') }}"
                                            min="0" max="59" required>
                                        @error('minute')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="second">Second</label>
                                        <input type="number" class="form-control @error('second') is-invalid @enderror"
                                            id="second" name="second" value="{{ old('second', $data1[0] ?? '0') }}"
                                            min="0" max="59" required>

                                        @error('second')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="tob_ampm">AM/PM</label>
                                        <select class="form-control @error('tob_ampm') is-invalid @enderror"
                                            name="tob_ampm" id="tob_ampm" required>
                                            <option value="AM"
                                                {{ old('tob_ampm', $data1[1]) == 'AM' ? 'selected' : '' }}>AM
                                            </option>
                                            <option value="PM"
                                                {{ old('tob_ampm', $data1[1]) == 'PM' ? 'selected' : '' }}>PM
                                            </option>
                                        </select>
                                        @error('tob_ampm')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h3><strong>Direction</strong></h3>
                            <?php
                            // Assuming $gmt_birthtime is not passed to the view or not set
                            // If $gmt_birthtime is undefined, this will throw an error
                            $gmt_birthtime = isset($kundali->gmt_birthtime) ? $kundali->gmt_birthtime : '';
                            $gmt_birthtime_array = explode(' ', $gmt_birthtime);
                            $time_parts = explode(':', $gmt_birthtime_array[0]);
                            $hour = $time_parts[0];
                            $minute = $time_parts[1];
                            $second = $time_parts[2];
                            $ampm = $gmt_birthtime_array[1];
                            $date = $gmt_birthtime_array[2];
                            $direction = $gmt_birthtime_array[3];
                            ?>

                            <div class="row mb-3 ">
                                <label for="gmt_birthtime">
                                    <h4>GMT at Birth Time</h4>
                                </label>

                                <div class="col">
                                    <label for="gmt_birth_hour">Hour</label>
                                    <input type="number" class="form-control" value="<?= $hour ?>" id="gmt_birth_hour"
                                        name="gmt_birth_hour" min="0" max="12" required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_minute">Minute</label>
                                    <input type="number" class="form-control" value="<?= $minute ?>"
                                        id="gmt_birth_minute" name="gmt_birth_minute" min="0" max="59"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_second">Second</label>
                                    <input type="number" class="form-control" value="<?= $second ?>"
                                        id="gmt_birth_second" name="gmt_birth_second" min="0" max="59"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_ampm">AM/PM</label>
                                    <select class="form-control" name="gmt_birth_ampm" id="gmt_birth_ampm" required>
                                        <option value="AM" <?= $ampm == 'AM' ? 'selected' : '' ?>>AM</option>
                                        <option value="PM" <?= $ampm == 'PM' ? 'selected' : '' ?>>PM</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="gmt_birth_date">GMT at Birth Date</label>
                                    <input type="date" class="form-control" name="gmt_birth_date" id="gmt_birth_date"
                                        value="<?= $date ?>" required>
                                </div>
                                <div class="col">
                                    <label for="gmt_birth_direction">Direction</label>
                                    <select class="form-control" name="gmt_birth_direction" id="gmt_birth_direction"
                                        required>
                                        <option value="gmt" <?= $direction == 'gmt' ? 'selected' : '' ?>>GMT</option>
                                        <option value="zctcst" <?= $direction == 'zctcst' ? 'selected' : '' ?>>ZCT/CST
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $lmt_birthtime = isset($kundali->lmt_birthtime) ? $kundali->lmt_birthtime : '';
                            $lmt_birth_time_array = explode(' ', $lmt_birthtime);

                            $time_parts = explode(':', $lmt_birth_time_array[0]);
                            $lmt_hour = $time_parts[0];
                            $lmt_minute = $time_parts[1];
                            $lmt_second = $time_parts[2];

                            $lmt_ampm = $lmt_birth_time_array[1];
                            $lmt_date = $lmt_birth_time_array[2];
                            $lmt_direction = $lmt_birth_time_array[3];
                            ?>
                            <div class="row mb-3 ">
                                <label for="lmt_birthtime">
                                    <h4>LMT at Birth Time</h4>
                                </label>

                                <div class="col">
                                    <label for="lmt_birth_hour">Hour</label>
                                    <input type="number" class="form-control" value="<?= $lmt_hour ?>"
                                        id="lmt_birth_hour" name="lmt_birth_hour" min="0" max="12"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_minute">Minute</label>
                                    <input type="number" class="form-control" value="<?= $lmt_minute ?>"
                                        id="lmt_birth_minute" name="lmt_birth_minute" min="0" max="59"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_second">Second</label>
                                    <input type="number" class="form-control" value="<?= $lmt_second ?>"
                                        id="lmt_birth_second" name="lmt_birth_second" min="0" max="59"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_ampm">AM/PM</label>
                                    <select class="form-control" name="lmt_birth_ampm" id="lmt_birth_ampm" required>
                                        <option value="AM" <?= $lmt_ampm == 'AM' ? 'selected' : '' ?>>AM</option>
                                        <option value="PM" <?= $lmt_ampm == 'PM' ? 'selected' : '' ?>>PM</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="lmt_birth_date">LMT at Birth Date</label>
                                    <input type="date" class="form-control" name="lmt_birth_date" id="lmt_birth_date"
                                        value="<?= $lmt_date ?>" required>
                                </div>
                                <div class="col">
                                    <label for="lmt_birth_direction">Direction</label>
                                    <select class="form-control" name="lmt_birth_direction" id="lmt_birth_direction"
                                        required>
                                        <option value="gmt" <?= $lmt_direction == 'gmt' ? 'selected' : '' ?>>GMT
                                        </option>
                                        <option value="zctcst" <?= $lmt_direction == 'zctcst' ? 'selected' : '' ?>>ZCT/CST
                                        </option>
                                    </select>
                                </div>
                            </div>






                            <div class="row mb-3">
                                <label for="latitude_longitude">
                                    <h4>Laditude/Logitude</h4>
                                </label>
                                <?php
                                $latitude_string = isset($kundali->latitude) ? $kundali->latitude : ' ';
                                $parts = explode(' ', $latitude_string);
                                $plusminus = isset($parts[0]) ? $parts[0] : '';
                                $latitude_value = isset($parts[1]) ? $parts[1] : '';
                                $direction = isset($parts[2]) ? $parts[2] : ''; // Direction is the third part

                                ?>
                                <div class="col">
                                    <label for="latitude_plusminus">plus/minus</label>
                                    <select class="form-control" name="latitude_plusminus" id="latitude_plusminus"
                                        required>
                                        <option value="+" <?php echo $plusminus == '+' ? 'selected' : ''; ?>>+</option>
                                        <option value="-" <?php echo $plusminus == '-' ? 'selected' : ''; ?>>-</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="latitude"> Latitude</label>
                                    <input type="number" class="form-control" name="latitude" id="latitude"
                                        value="<?php echo $latitude_value; ?>" min="0" max="360" step="any"
                                        required>
                                </div>

                                <div class="col">
                                    <label for="latitude_direction">Direction</label>
                                    <select class="form-control" name="latitude_direction" id="latitude_direction"
                                        required>
                                        <option value="North" <?php echo $direction == 'North' ? 'selected' : ''; ?>>N</option>
                                        <option value="South" <?php echo $direction == 'South' ? 'selected' : ''; ?>>S</option>
                                    </select>
                                </div>



                                <?php
                                // Example of retrieving old longitude data from kundali
                                $longitude_string = isset($kundali->longitude) ? $kundali->longitude : ' ';
                                $parts = explode(' ', $longitude_string);
                                $longitude_plusminus = isset($parts[0]) ? $parts[0] : '';
                                $longitude_value = isset($parts[1]) ? $parts[1] : '';
                                $longitude_direction = isset($parts[2]) ? $parts[2] : '';
                                ?>
                                <div class="col">
                                    <label for="longitude_plusminus">plus/minus</label>
                                    <select class="form-control" name="longitude_plusminus" id="longitude_plusminus"
                                        required>
                                        <option value="+" <?php echo $longitude_plusminus == '+' ? 'selected' : ''; ?>>+</option>
                                        <option value="-" <?php echo $longitude_plusminus == '-' ? 'selected' : ''; ?>>-</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="longitude">Longitude</label>
                                    <input type="number" class="form-control" name="longitude" id="longitude"
                                        value="<?php echo $longitude_value; ?>" min="0" max="360" step="any"
                                        required>
                                </div>

                                <div class="col">
                                    <label for="longitude_direction">Direction</label>
                                    <select class="form-control" name="longitude_direction" id="longitude_direction"
                                        required>
                                        <option value="East" <?php echo $longitude_direction == 'East' ? 'selected' : ''; ?>>E</option>
                                        <option value="West" <?php echo $longitude_direction == 'West' ? 'selected' : ''; ?>>W</option>
                                    </select>
                                </div>

                            </div>
                            <?php
                            $dst_string = isset($kundali->dst) ? $kundali->dst : ' ';
                            $parts = explode(' ', $dst_string);
                            $dst_plusminus = isset($parts[0]) ? $parts[0] : '';
                            $time_parts = isset($parts[1]) ? explode(':', $parts[1]) : [0, 0, 0];
                            $dst_hour = isset($time_parts[0]) ? $time_parts[0] : 0;
                            $dst_minute = isset($time_parts[1]) ? $time_parts[1] : 0;
                            $dst_second = isset($time_parts[2]) ? $time_parts[2] : 0;
                            ?>
                            <div class="mb-3">
                                <label for="dst">
                                    <h4>DST</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="dst_plusminus">plus/minus</label>
                                        <select class="form-control" name="dst_plusminus" id="dst_plusminus" required>
                                            <option value="+" <?php echo $dst_plusminus == '+' ? 'selected' : ''; ?>>+</option>
                                            <option value="-" <?php echo $dst_plusminus == '-' ? 'selected' : ''; ?>>-</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="hour_dst">Hour</label>
                                        <input type="number" class="form-control" value="<?php echo $dst_hour; ?>"
                                            id="hour_dst" name="hour_dst" min="0" max="23" required>
                                    </div>
                                    <div class="col">
                                        <label for="minute_dst">Minute</label>
                                        <input type="number" class="form-control" value="<?php echo $dst_minute; ?>"
                                            id="minute_dst" name="minute_dst" min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="second_dst">Second</label>
                                        <input type="number" class="form-control" value="<?php echo $dst_second; ?>"
                                            id="second_dst" name="second_dst" min="0" max="59" required>
                                    </div>
                                </div>

                                @error('dst')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <?php
                            $subtime_string = isset($kundali->subtime) ? $kundali->subtime : ' ';
                            $parts = explode(' ', $subtime_string);
                            $subtime_plusminus = isset($parts[0]) ? $parts[0] : '';
                            $time_parts = isset($parts[1]) ? explode(':', $parts[1]) : [0, 0, 0];
                            $subtime_hour = isset($time_parts[0]) ? $time_parts[0] : 0;
                            $subtime_minute = isset($time_parts[1]) ? $time_parts[1] : 0;
                            $subtime_second = isset($time_parts[2]) ? $time_parts[2] : 0;
                            ?>
                            <div class="mb-3">
                                <label for="subtime">
                                    <h4>ADD/SUB TIME</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="subtime_plusminus">plus/minus</label>
                                        <select class="form-control" name="subtime_plusminus" id="subtime_plusminus"
                                            required>
                                            <option value="+" <?php echo $subtime_plusminus == '+' ? 'selected' : ''; ?>>+</option>
                                            <option value="-" <?php echo $subtime_plusminus == '-' ? 'selected' : ''; ?>>-</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="hour_subtime">Hour</label>
                                        <input type="number" class="form-control" value="<?php echo $subtime_hour; ?>"
                                            id="hour_subtime" name="hour_subtime" min="0" max="23"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="minute_subtime">Minute</label>
                                        <input type="number" class="form-control" value="<?php echo $subtime_minute; ?>"
                                            id="minute_subtime" name="minute_subtime" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="second_subtime">Second</label>
                                        <input type="number" class="form-control" value="<?php echo $subtime_second; ?>"
                                            id="second_subtime" name="second_subtime" min="0" max="59"
                                            required>
                                    </div>
                                </div>

                                @error('subtime')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <?php
                            $timezone_string = isset($kundali->timezone) ? $kundali->timezone : ' ';
                            $parts = explode(' ', $timezone_string);
                            $timezone_plusminus = isset($parts[0]) ? $parts[0] : '';
                            $timezone_time = isset($parts[1]) ? $parts[1] : '00:00'; ?>
                            <div class="mb-3">
                                <label for="timezone">
                                    <h4>Time Zone</h4>
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label for="timezone_plusminus">plus/minus</label>
                                        <select class="form-control" name="timezone_plusminus" id="timezone_plusminus"
                                            required>
                                            <option value="+" <?php echo $timezone_plusminus == '+' ? 'selected' : ''; ?>>+</option>
                                            <option value="-" <?php echo $timezone_plusminus == '-' ? 'selected' : ''; ?>>-</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="timezone_time">Time</label>
                                        <input type="time" class="form-control" name="timezone_time"
                                            id="timezone_time" value="<?php echo $timezone_time; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $timedifference_string = isset($kundali->timedifference) ? $kundali->timedifference : ' ';
                            $parts = explode(' ', $timedifference_string);
                            $timedifference_plusminus = isset($parts[0]) ? $parts[0] : '';
                            $timedifference_time = isset($parts[1]) ? $parts[1] : '00:00:00';
                            $time_parts = explode(':', $timedifference_time);
                            $timedifference_hour = isset($time_parts[0]) ? $time_parts[0] : '00';
                            $timedifference_minute = isset($time_parts[1]) ? $time_parts[1] : '00';
                            $timedifference_second = isset($time_parts[2]) ? $time_parts[2] : '00';
                            ?>
                            <div class="row mb-3">
                                <label for="timedifference">
                                    <h4>Time Difference</h4>
                                </label>
                                <div class="col">
                                    <label for="timedifference_plusminus">plus/minus</label>
                                    <select class="form-control" name="timedifference_plusminus"
                                        id="timedifference_plusminus" required>
                                        <option value="+" <?php echo $timedifference_plusminus == '+' ? 'selected' : ''; ?>>+</option>
                                        <option value="-" <?php echo $timedifference_plusminus == '-' ? 'selected' : ''; ?>>-</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="hour_timedifference">Hour</label>
                                    <input type="number" class="form-control" value="<?php echo $timedifference_hour; ?>"
                                        id="hour_timedifference" name="hour_timedifference" min="0"
                                        max="12" required>
                                </div>
                                <div class="col">
                                    <label for="minute_timedifference">Minute</label>
                                    <input type="number" class="form-control" value="<?php echo $timedifference_minute; ?>"
                                        id="minute_timedifference" name="minute_timedifference" min="0"
                                        max="59" required>
                                </div>
                                <div class="col">
                                    <label for="second_timedifference">Second</label>
                                    <input type="number" class="form-control" value="<?php echo $timedifference_second; ?>"
                                        id="second_timedifference" name="second_timedifference" min="0"
                                        max="59" required>
                                </div>
                            </div>




                            <div class="mb-3">
                                <?php $gmt = $kundali->gmt;

                                $gmt_data = explode(':', $gmt);
                                $gmt_data1 = explode(' ', $gmt_data[2]);

                                ?>
                                <label for="gmt">Sidereal Time on GMT</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="hour_gmt">Hour</label>
                                        <input type="number"
                                            class="form-control @error('hour_gmt') is-invalid @enderror"
                                            value="{{ old('hour_gmt', $gmt_data[0] ?? '0') }}" id="hour_gmt"
                                            name="hour_gmt" min="0" max="12" required>
                                        @error('hour_gmt')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="minute_gmt">Minute</label>
                                        <input type="number"
                                            class="form-control @error('minute_gmt') is-invalid @enderror"
                                            value="{{ old('minute_gmt', $gmt_data[1] ?? '0') }}" id="minute_gmt"
                                            name="minute_gmt" min="0" max="59" required>
                                        @error('minute_gmt')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="second_gmt">Second</label>
                                        <input type="number"
                                            class="form-control @error('second_gmt') is-invalid @enderror"
                                            value="{{ old('second_gmt', $gmt_data1[0] ?? '0') }}" id="second_gmt"
                                            name="second_gmt" min="0" max="59" required>
                                        @error('second_gmt')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="gmt_ampm">AM/PM</label>
                                        <select class="form-control @error('gmt_ampm') is-invalid @enderror"
                                            name="gmt_ampm" id="gmt_ampm" required>
                                            <option value="AM"
                                                {{ old('gmt_ampm', $gmt_data1[1]) == 'AM' ? 'selected' : '' }}>AM
                                            </option>
                                            <option value="PM"
                                                {{ old('gmt_ampm', $gmt_data[1]) == 'PM' ? 'selected' : '' }}>PM
                                            </option>
                                        </select>
                                        @error('gmt_ampm')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <?php $lmt = $kundali->lmt;

                                $lmt_data = explode(':', $lmt);
                                $lmt_data1 = explode(' ', $lmt_data[2]);

                                ?>
                                <label for="lmt">Sidereal Time on LMT</label>
                                <div class="row">
                                    <div class="col">
                                        <label for="hour_lmt">Hour</label>
                                        <input type="number"
                                            class="form-control @error('hour_lmt') is-invalid @enderror"
                                            value="{{ old('hour_lmt', $lmt_data[0]) }}" id="hour_lmt" name="hour_lmt"
                                            min="0" max="23" required>
                                        @error('hour_lmt')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="minute_lmt">Minute</label>
                                        <input type="number"
                                            class="form-control @error('minute_lmt') is-invalid @enderror"
                                            value="{{ old('minute_lmt', $lmt_data[1]) }}" id="minute_lmt"
                                            name="minute_lmt" min="0" max="59" required>
                                        @error('minute_lmt')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="second_lmt">Second</label>
                                        <input type="number"
                                            class="form-control @error('second_lmt') is-invalid @enderror"
                                            value="{{ old('second_lmt', $lmt_data1[0]) }}" id="second_lmt"
                                            name="second_lmt" min="0" max="59" required>
                                        @error('second_lmt')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="lmt_ampm">AM/PM</label>
                                        <select class="form-control @error('lmt_ampm') is-invalid @enderror"
                                            name="lmt_ampm" id="lmt_ampm" required>
                                            <option value="AM"
                                                {{ old('lmt_ampm', $lmt_data1[1]) == 'AM' ? 'selected' : '' }}>AM
                                            </option>
                                            <option value="PM"
                                                {{ old('lmt_ampm', $lmt_data1[1]) == 'PM' ? 'selected' : '' }}>PM
                                            </option>
                                        </select>
                                        @error('lmt_ampm')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="cst">
                                            <h4>CST</h4>
                                        </label>
                                        <input type="number" class="form-control" name="cst" id="cst"
                                            value="{{ old('cst', $kundali->cst) }}" min="0" step="any" max="360" required>
                                    </div>
                                    <div class="col">
                                        <label for="juliyan">
                                            <h4>Julian Day</h4>
                                        </label>
                                        <input type="number" class="form-control" name="juliyan" id="cst"
                                            value="{{ old('juliyan', $kundali->juliyan) }}" min="0" step="any" required>
                                    </div>
                                </div>
                            </div>
                            <h3>Sun Rise/Set Times</h3>

                            @foreach (['yesterday', 'today', 'tomorrow'] as $day)
                                <?php
                                $sunRise = $kundali->{'sunRise' . ucfirst($day)};
                                $sunSet = $kundali->{'sunSet' . ucfirst($day)};

                                // Parse sunrise time
                                $sunRiseParts = explode(':', $sunRise); // Splitting sunrise time
                                $sunRiseTime1 = explode(' ', $sunRiseParts[2]);
                                // Assuming the time is in the third part
                                $sunSetParts = explode(':', $sunSet); // Splitting sunrise time
                                $sunSetTime1 = explode(' ', $sunSetParts[2]);

                                ?>
                                <h2> {{ ucfirst($day) }}</h2>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_hour"> Sunrise Hour</label>
                                        <input type="number" class="form-control"
                                            name="sun_rise_{{ $day }}_hour"
                                            id="sun_rise_{{ $day }}_hour" min="0" max="12"
                                            value="{{ $sunRiseParts[0] ?? '' }}" required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_minute"> Sunrise
                                            Min</label>
                                        <input type="number" class="form-control"
                                            name="sun_rise_{{ $day }}_minute"
                                            value="{{ $sunRiseParts[1] ?? '' }}"
                                            id="sun_rise_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_second"> Sunrise
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="sun_rise_{{ $day }}_second"
                                            value="{{ $sunRiseTime1[0] ?? '' }}"
                                            id="sun_rise_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_rise_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="sun_rise_{{ $day }}_ampm"
                                            id="sun_rise_{{ $day }}_ampm" required>
                                            <option value="AM"
                                                {{ ($sunRiseTime1[1] ?? '') == 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM"
                                                {{ ($sunRiseTime1[1] ?? '') == 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="sun_set__hour"> Sunset Hour

                                        </label>
                                        <input type="number" class="form-control"
                                            name="sun_set_{{ $day }}_hour" value="{{ $sunSetParts[0] ?? '' }}"
                                            id="sun_set_{{ $day }}_hour" min="0" max="12"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_set_{{ $day }}_minute"> Sunset
                                            Min</label>
                                        <input type="number" class="form-control"
                                            name="sun_set_{{ $day }}_minute"
                                            value="{{ $sunSetParts[1] ?? '' }}" id="sun_set_{{ $day }}_minute"
                                            min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_set_{{ $day }}_second"> Sunset
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="sun_set_{{ $day }}_second"
                                            value="{{ $sunSetTime1[0] ?? '' }}" id="sun_set_{{ $day }}_second"
                                            min="0" max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="sun_set_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="sun_set_{{ $day }}_ampm"
                                            id="sun_set_{{ $day }}_ampm" required>
                                            <option value="AM"
                                                {{ ($sunSetTime1[1] ?? '') == 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM"
                                                {{ ($sunSetTime1[1] ?? '') == 'PM' ? 'selected' : '' }}>
                                                PM</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <h3>Moon Rise/Set Times</h3>
                            @foreach (['yesterday', 'today', 'tomorrow'] as $day)
                                <?php
                                $moonRise = $kundali->{'moonRise' . ucfirst($day)};
                                $moonSet = $kundali->{'moonSet' . ucfirst($day)};

                                // Parse sunrise time
                                $moonRiseParts = explode(':', $moonRise); // Splitting sunrise time
                                $moonRiseTime1 = explode(' ', $moonRiseParts[2]);
                                // Assuming the time is in the third part
                                $moonSetParts = explode(':', $moonSet); // Splitting sunrise time
                                $moonSetTime1 = explode(' ', $moonSetParts[2]);

                                ?>
                                <h2>{{ ucfirst($day) }}</h2>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_hour"> Moonrise
                                            Hour</label>
                                        <input type="number" class="form-control"
                                            name="moon_rise_{{ $day }}_hour"
                                            value="{{ $moonRiseParts[0] ?? '' }}"
                                            id="moon_rise_{{ $day }}_hour" min="0" max="12"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_minute"> Moonrise
                                            Min</label>
                                        <input type="number" class="form-control" value="{{ $moonRiseParts[1] ?? '' }}"
                                            name="moon_rise_{{ $day }}_minute"
                                            id="moon_rise_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_second"> Moonrise
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="moon_rise_{{ $day }}_second"
                                            value="{{ $moonRiseTime1[0] ?? '' }}"
                                            id="moon_rise_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_rise_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="moon_rise_{{ $day }}_ampm"
                                            id="moon_rise_{{ $day }}_ampm" required>
                                            <option value="AM"
                                                {{ ($moonRiseTime1[1] ?? '') == 'AM' ? 'selected' : '' }}>
                                                AM</option>
                                            <option value="PM"
                                                {{ ($moonRiseTime1[1] ?? '') == 'PM' ? 'selected' : '' }}>
                                                PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_hour">Moonset
                                            Hour</label>
                                        <input type="number" class="form-control" value="{{ $moonSetParts[0] ?? '' }}"
                                            name="moon_set_{{ $day }}_hour"
                                            id="moon_set_{{ $day }}_hour" min="0" max="12"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_minute"> Moonset
                                            Min</label>
                                        <input type="number" class="form-control" value="{{ $moonSetParts[1] ?? '' }}"
                                            name="moon_set_{{ $day }}_minute"
                                            id="moon_set_{{ $day }}_minute" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_second"> Moonset
                                            Sec</label>
                                        <input type="number" class="form-control"
                                            name="moon_set_{{ $day }}_second"
                                            value="{{ $moonSetTime1[0] ?? '' }}"
                                            id="moon_set_{{ $day }}_second" min="0" max="59"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="moon_set_{{ $day }}_ampm">AM/PM</label>
                                        <select class="form-control" name="moon_set_{{ $day }}_ampm"
                                            id="moon_set_{{ $day }}_ampm" required>
                                            <option value="AM"
                                                {{ ($moonSetTime1[1] ?? '') == 'PM' ? 'selected' : '' }}>
                                                AM</option>
                                            <option value="PM"
                                                {{ ($moonSetTime1[1] ?? '') == 'PM' ? 'selected' : '' }}>
                                                PM</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach


                            <div class="mb-3">
                                <div class="row">
                                    @php
                                        // Exploding the saryana_dms_ascendant into degree, minute, and second parts
                                        $dmsParts = explode(' ', $kundali->ayan);
                                        $degree = rtrim($dmsParts[0], '°'); // Remove the degree symbol
                                        $minute = rtrim($dmsParts[1], "'"); // Remove the apostrophe for minutes
                                        $second = rtrim($dmsParts[2], '"'); // No need to modify seconds
                                    @endphp
                                    <label for="ayan">
                                        <h4>Ayanamsa</h4>
                                    </label>
                                    <div class="col">
                                        <label for="ayan_degree">Degree</label>
                                        <input type="number" class="form-control" name="ayan_degree"
                                            value="{{ old('ayan', $degree) }}" id="ayan_degree" min="0"
                                            max="360" required>
                                    </div>
                                    <div class="col">
                                        <label for="ayan_minute">Minute</label>
                                        <input type="number" class="form-control" name="ayan_minute"
                                            value="{{ old('ayan', $minute) }}" id= "ayan_minute" min="0"
                                            max="59" required>
                                    </div>
                                    <div class="col">
                                        <label for="ayan_second">Second</label>
                                        <input type="number" class="form-control" name="ayan_second"
                                            value="{{ old('ayan', $second) }}" id="ayan_second" min="0"
                                            max="59" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ayan_name" class="form-label">
                                    <h4>Ayanamsa Name</h4>
                                </label>
                                <input type="text" class="form-control" name="ayan_name" id="ayan_name"
                                    value="{{ old('ayan_name', $kundali->ayan_name ?? '') }}" />
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="choice">Choose between Degree and DMS:</label>
                            <select name="choice" class="form-control" id="choice" onchange="showSubChoices()">
                                <option value="">--Select--</option>
                                <option value="degree"
                                    {{ old('choice', $kundali['choice']) == 'degree' ? 'selected' : '' }}>Degree</option>
                                <option value="dms"
                                    {{ old('choice', $kundali['choice']) == 'dms' ? 'selected' : '' }}>
                                    DMS</option>

                            </select>

                            <div id="sub-choices" class="mb-3">
                                <label for="sub_choice">Choose an Option:</label>
                                <select name="sub_choice" id="sub_choice" class="form-control"
                                    onchange="showDynamicForm()">
                                    <option value="nirayana_degree"
                                        @if ($kundali['choice'] == 'degree') {{ old('choice', $kundali['sub_choice']) == 'nirayana_degree' ? 'selected' : '' }}>nirayan Degree</option>
                                <option value="saryana_degree"
                                    {{ old('choice', $kundali['sub_choice']) == 'saryana_degree' ? 'selected' : '' }}>
                                    saryana degree</option>
                                    @elseif($kundali['choice'] == 'dms')
                                    <option value="nirayana_dms"
                                    {{ old('choice', $kundali['sub_choice']) == 'nirayana_dms' ? 'selected' : '' }}>nirayana dms</option>
                                <option value="saryana_dms"
                                    {{ old('choice', $kundali['sub_choice']) == 'saryana_dms' ? 'selected' : '' }}>
                                    saryana dms</option> @endif
                                        <!-- Options will be dynamically generated -->
                                </select>
                            </div>

                            <div id="saryana_dms" class="dynamic-form" style="display: none;">
                                @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                    @php
                                        // Assume you have the old value stored as a comma-separated string like 'degree,minute,second'
                                        // This could be a value stored in a database or passed from the backend
                                        $dmsValue = old('saryana_' . $planet) ?: '0,0,0'; // Default to '0,0,0' if no old value exists
                                        $dmsArray = explode(',', $dmsValue); // Split the string into an array
                                        $degree = $dmsArray[0];
                                        $minute = $dmsArray[1];
                                        $second = $dmsArray[2];
                                    @endphp

                                    <div class="row">
                                        <label for="{{ $planet }}">{{ ucfirst($planet) }}</label>
                                        <div class="col">
                                            <label for="saryana_degree_{{ $planet }}">Degree
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="saryana_degree_{{ $planet }}" value="{{ $degree }}"
                                                id="saryana_degree_{{ $planet }}" min="0" max="360">
                                        </div>
                                        <div class="col">
                                            <label for="saryana_minute_{{ $planet }}">Minute
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="saryana_minute_{{ $planet }}" value="{{ $minute }}"
                                                id="saryana_minute_{{ $planet }}" min="0" max="59">
                                        </div>
                                        <div class="col">
                                            <label for="saryana_second_{{ $planet }}">Second
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="saryana_second_{{ $planet }}" value="{{ $second }}"
                                                id="saryana_second_{{ $planet }}" min="0" max="59">
                                        </div>
                                    </div>
                                @endforeach
                            </div>




                            <div id="niray_degree" class="dynamic-form" style="display: none;">
                                <h3>nirayana degree</h3>
                                <div class="mb-3">
                                    <div class="row">
                                        @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                            <?php
                                            $niray_degree = $kundali->{'niray_degree_' . $planet};
                                            $niray = explode(':', $niray_degree);
                                            ?>
                                            <div class="col-3">
                                                <label
                                                    for="niray_degree_{{ $planet }}">{{ ucfirst($planet) }}</label>
                                                <input type="number" class="form-control"
                                                    id="niray_degree_{{ $planet }}"
                                                    value="{{ $niray[0] ?? '' }}" step="any"
                                                    name="niray_degree_{{ $planet }}" min="0"
                                                    max="360">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>


                            <!-- Nirayana Degree -->
                            <div id="nirayana_dms" class="dynamic-form" style="display: none;">
                                @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                    @php
                                        // Assume you have the old value for Nirayana stored as a comma-separated string like 'degree,minute,second'
                                        $dmsValue = old('nirayana_' . $planet) ?: '0,0,0'; // Default to '0,0,0' if no old value exists
                                        $dmsArray = explode(',', $dmsValue); // Split the string into an array
                                        $degree = $dmsArray[0];
                                        $minute = $dmsArray[1];
                                        $second = $dmsArray[2];
                                    @endphp

                                    <div class="row">
                                        <label for="{{ $planet }}">{{ ucfirst($planet) }}</label>
                                        <div class="col">
                                            <label for="nirayana_degree_{{ $planet }}">Degree
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="nirayana_degree_{{ $planet }}" value="{{ $degree }}"
                                                id="nirayana_degree_{{ $planet }}" min="0" max="360">
                                        </div>
                                        <div class="col">
                                            <label for="nirayana_minute_{{ $planet }}">Minute
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="nirayana_minute_{{ $planet }}" value="{{ $minute }}"
                                                id="nirayana_minute_{{ $planet }}" min="0" max="59">
                                        </div>
                                        <div class="col">
                                            <label for="nirayana_second_{{ $planet }}">Second
                                                {{ ucfirst($planet) }}</label>
                                            <input type="number" class="form-control"
                                                name="nirayana_second_{{ $planet }}" value="{{ $second }}"
                                                id="nirayana_second_{{ $planet }}" min="0" max="59">
                                        </div>
                                    </div>
                                @endforeach
                            </div>



                            <!-- Saryana Degree -->
                            <div id="sary_degree" class="dynamic-form" style="display: none;">
                                <h3>saryana degree</h3>
                                <div class="mb-3">
                                    <div class="row">
                                        @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'juipter', 'saturn', 'rahu', 'ketu'] as $planet)
                                            <?php
                                            $sary_degree = $kundali->{'sary_degree_' . $planet};
                                            $sary = explode(':', $sary_degree);
                                            ?>
                                            <div class="col-3">
                                                <label
                                                    for="sary_degree_{{ $planet }}">{{ ucfirst($planet) }}</label>
                                                <input type="number" class="form-control" step="any"
                                                    id="sary_degree_{{ $planet }}"
                                                    name="sary_degree_{{ $planet }}" min="0"
                                                    value="{{ $sary[0] ?? '' }}" max="360">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div id="planet_degree_selection" class="mb-3">
                                <label for="planet_selection">Select Planet:</label>
                                <select name="planet_selection" id="planet_selection" class="form-control"
                                    onchange="showPlanetForm()">
                                    <option value="">--Select Planet--</option>
                                    @foreach (['ascendant', 'sun', 'moon', 'mercury', 'venus', 'mars', 'jupiter', 'saturn', 'rahu', 'ketu'] as $planet)
                                        <option value="{{ $planet }}"
                                            @if (old('planet_selection', $kundali->planet_selection) == $planet) selected @endif>
                                            {{ ucfirst($planet) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="planet_degree_form" class="dynamic-form mt-3" style="display: none;">
                                <h4>Degree Input for <span
                                        id="selected_planet">{{ ucfirst($kundali->planet ?? '') }}</span></h4>
                                <label for="degree_input">Planet Degree:</label>
                                <input type="number" id="degree_input" class="form-control" min="0"
                                    max="360" step="any" onchange="updateDegrees()" name="degree_input"
                                    value="{{ old('degree_input', $kundali->degree_input ?? '') }}" required>

                                @foreach (range(1, 12) as $house)
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="house{{ $house }}">House</label>
                                            <input type="number" class="form-control" name="house{{ $house }}"
                                                id="house{{ $house }}"
                                                value="{{ old('house' . $house, $kundali->{'house' . $house} ?? '') }}"
                                                min="0" max="360">
                                        </div>
                                        <div class="col">
                                            <label for="starting_degree{{ $house }}">Starting Degree</label>
                                            <input type="number" class="form-control"
                                                name="starting_degree{{ $house }}"
                                                id="starting_degree{{ $house }}"
                                                value="{{ old('starting_degree' . $house, $kundali->{'starting_degree' . $house} ?? '') }}"
                                                min="0" max="360"
                                                oninput="calculateRange({{ $house }})">
                                        </div>
                                        <div class="col">
                                            <label for="ending_degree{{ $house }}">Ending Degree</label>
                                            <input type="number" class="form-control"
                                                name="ending_degree{{ $house }}"
                                                id="ending_degree{{ $house }}"
                                                value="{{ old('ending_degree' . $house, $kundali->{'ending_degree' . $house} ?? '') }}"
                                                min="0" max="360"
                                                oninput="calculateRange({{ $house }})">
                                        </div>
                                        <div class="col">
                                            <label for="range{{ $house }}">Range</label>
                                            <input type="number" class="form-control" name="range{{ $house }}"
                                                id="range{{ $house }}"
                                                value="{{ old('range' . $house, $kundali->{'range' . $house} ?? '') }}"
                                                min="0" max="360">
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            <script>
                                // Wait for the document to load fully before running the script
                                document.addEventListener("DOMContentLoaded", function() {
                                    showPlanetForm(); // Call the function to handle the form visibility based on the selected planet
                                });

                                function showPlanetForm() {
                                    var planetSelection = document.getElementById('planet_selection')
                                    .value; // Get the selected planet from the dropdown
                                    var planetDegreeSelection = document.getElementById('planet_degree_selection');
                                    var planetDegreeForm = document.getElementById('planet_degree_form');

                                    // If a planet is selected, show the planet degree form
                                    if (planetSelection) {
                                        planetDegreeSelection.style.display = 'block'; // Show the "planet_degree_selection" section
                                        planetDegreeForm.style.display = 'block'; // Show the planet degree form
                                        document.getElementById('selected_planet').innerText = capitalizeFirstLetter(
                                        planetSelection); // Update the text with the selected planet name
                                    } else {
                                        planetDegreeSelection.style.display = 'none'; // Hide the "planet_degree_selection" section
                                        planetDegreeForm.style.display = 'none'; // Hide the planet degree form
                                    }
                                }

                                // Function to capitalize the first letter of the selected planet name
                                function capitalizeFirstLetter(string) {
                                    return string.charAt(0).toUpperCase() + string.slice(1);
                                }

                                // Optional: You can add any additional logic for updating the degrees here
                                function updateDegrees() {
                                    // Your degree updating logic
                                    console.log("Degree updated.");
                                }
                            </script>



                            <!-- Additional Dynamic Forms for Nirayana and Ayanamsa -->
                            <!-- Similar structure for nirayana_dms, ayanamsa_dms, nirayana_degree, etc. -->

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
