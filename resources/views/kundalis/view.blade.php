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

                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        My Record
                    </div>
                    <div class="card-body pb-0">

                        <div class="slide-container ">
                            <div class="slides" style="position: relative;background-color:green">
                                <div class="one  " style=" background: white; width:100%; height:100%; position: absolute;"
                                    id="one">
                                    <a href="{{ route('download.csv.slide1', ['kundali' => $kundali]) }}"
                                        class="btn btn-primary mb-2">Download CSV</a>
                                    <table class="table  table-striped ">
                                        <tr>
                                            <td><strong>Name:</strong></td>
                                            <td>{{ $kundali->name }}
                                            </td>
                                            <td><strong>Date of Birth:</strong></td>
                                            <td>{{ $kundali->dob }}
                                            </td> <!-- Ensure $kundali is defined -->

                                        </tr>

                                        <tr>
                                            <td><strong>Time of Birth:</strong></td>
                                            <td>{{ $kundali->tob }}
                                            </td>
                                            <td><strong>Birth Place (Country):</strong> </td>
                                            <td>{{ $kundali->country }}</td>

                                        </tr>
                                        <tr>
                                            <td><strong>Birth Place (State):</strong></td>
                                            <td>{{ $kundali->state }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Birth Place (City):</strong></td>
                                            <td>{{ $kundali->city }}
                                            </td> <!-- Ensure $kundali is defined -->


                                        </tr>
                                        <tr>
                                            <td><strong>Birth Place (Locality):</strong> </td>
                                            <td>{{ $kundali->locality }}</td>
                                            <!-- Ensure $kundali is defined -->
                                            <td><strong>Pin:</strong> </td>
                                            <td>{{ $kundali->pin }}</td>
                                            <!-- Ensure $kundali is defined -->

                                        </tr>
                                        <tr>
                                            <td><strong>Latitude: </strong></td>
                                            <td>{{ $kundali->latitude }}</td>
                                            <td><strong>Longitude:</strong> </td>
                                            <td>{{ $kundali->longitude }}</td>


                                        </tr>
                                        <tr>
                                            <td><strong>GMT at Birth Time: </strong></td>
                                            <td>{{ $kundali->lmt_birthtime }}</td>
                                            <td><strong>LMT at Birth Time:</strong> </td>
                                            <td>{{ $kundali->gmt_birthtime }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>DST: </strong></td>
                                            <td>{{ $kundali->dst }}</td>
                                            <td><strong>Add/Sub Time:</strong> </td>
                                            <td>{{ $kundali->subtime }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>CST: </strong></td>
                                            <td>{{ $kundali->cst }}</td>
                                            <td><strong>Time Zone:</strong> </td>
                                            <td>{{ $kundali->timezone }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Julian Day: </strong></td>
                                            <td>{{ $kundali->juliyan }}</td>
                                            <td><strong>Time Difference:</strong> </td>
                                            <td>{{ $kundali->timedifference }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ayanamsa Name :</strong></td>
                                            <td>{{ $kundali->ayan_name }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong> Ayanamsa Dms :</strong> </td>
                                            <td>{{ $kundali->ayan }}</td>
                                        </tr>


                                    </table>
                                </div>
                                <div class="two " style=" background: white; width:100%; height:100%; position: absolute;"
                                    id="two">
                                    <a href="{{ route('download.csv.slide2', ['kundali' => $kundali]) }}"
                                        class="btn btn-primary mb-2">Download CSV</a>
                                    <table class="table  table-striped">
                                        <tr>
                                            <td><strong>Sidereal Time GMT :</strong></td>
                                            <td>{{ $kundali->gmt }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Sidereal Time LMT:</strong> </td>
                                            <td>{{ $kundali->lmt }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ayanamsa Name :</strong></td>
                                            <td>{{ $kundali->ayan_name }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong> Sun Sign :</strong> </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lagna :</strong></td>
                                            <td>
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Lagna Lord :</strong> </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Rashi :</strong></td>
                                            <td>
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Rashi Lord :</strong> </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nakshatra :</strong></td>
                                            <td>
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Weekday :</strong> </td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td><strong>Sun Rise Yesterday Time:</strong></td>
                                            <td>{{ $kundali->sunRiseYesterday }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Sun Set Yesterday Time:</strong></td>
                                            <td>{{ $kundali->sunSetYesterday }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Moon Rise Yesterday Time:</strong></td>
                                            <td>{{ $kundali->moonRiseYesterday }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Moon Set Yesterday Time:</strong> </td>
                                            <td>{{ $kundali->moonSetYesterday }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sun Rise Today Time:</strong></td>
                                            <td>{{ $kundali->sunRiseToday }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Sun Set Today Time:</strong></td>
                                            <td>{{ $kundali->sunSetToday }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Moon Rise Today Time:</strong></td>
                                            <td>{{ $kundali->moonRiseToday }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Moon Set Today Time:</strong> </td>
                                            <td>{{ $kundali->moonSetToday }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sun Rise Tomorrow Time:</strong></td>
                                            <td>{{ $kundali->sunRiseTomorrow }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Sun Set Today Time:</strong></td>
                                            <td>{{ $kundali->sunSetTomorrow }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Moon Rise Tomorrow Time:</strong></td>
                                            <td>{{ $kundali->moonRiseTomorrow }}
                                            </td> <!-- Ensure $kundali is defined -->
                                            <td><strong>Moon Set Tomorrow Time:</strong> </td>
                                            <td>{{ $kundali->moonSetTomorrow }}</td>
                                        </tr>
                                    

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="buttons mb-3">
                            <button id="oneOne" class="btn btn-primary">1</button>
                            <button id="twoTwo" class="btn btn-primary">2</button>

                        </div>
                    </div>
                </div>
            </div>


            <div class="main-collection">
                <div class="collection" id="collection1">
                    <div class="col d-flex align-items-center justify-content-between mt-5 table-dark">
                        <p class="mb-2 mt-2">Planets</p>
                        <i class="fa-solid fa-minus" id="icon"></i>
                    </div>

                </div>
                <div class="sub-collection" id="sub-collection1">
                    <table class="table  table-striped mt-3">
                        <tr>
                            <td class="table-dark">Planets</td>
                            @foreach (['Ascendant', 'Sun', 'Moon', 'Mercury', 'Venus', 'Mars', 'Jupiter', 'Saturn', 'Rahu', 'Ketu'] as $planet)
                                <td> {{ $planet }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Sayana/Tropical Longitude(Gross) / Value in Decimal</td>
                            @foreach ($planetsData as $planet => $data)
                                <td>{{ $data['sary'] }}</td>
                            @endforeach

                        </tr>

                        <tr>
                            <td class="table-dark" width="20%">Sayana/Tropical Longitude (Gross) / Value in DD:MM:SS</td>
                            @foreach ($planetsData as $planet => $data)
                                <td>{{ convertDegreesToDMS($data['sary']) }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Sign</td>
                            @foreach ($finalData['sary'] as $sary)
                                <td>{{ $sary->sign_number }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Sayana/Tropical Longitude(NET) / Value in Decimal</td>
                            @foreach ($finalData['netDegrees']['sary'] as $netDegree)
                                <td>{{ $netDegree }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Sayana/Tropical Longitude(NET) / Value in DD:MM:SS</td>
                            @foreach ($finalData['netDegrees']['sary'] as $netDegree)
                                <td>{{ convertDegreesToDMS($netDegree) }}</td>
                            @endforeach
                        </tr>


                        <tr>
                            <td class="table-dark">Nirayana/Sidereal Longitude(Gross) / Value in Decimal</td>
                            @foreach ($planetsData as $planet => $data)
                                <td>{{ $data['niray'] }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Nirayana/Sidereal Longitude(Gross) / Value in DD:MM:SS</td>

                            @foreach ($planetsData as $planet => $data)
                                <td>{{ convertDegreesToDMS($data['niray']) }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Sign</td>
                            @foreach ($finalData['niray'] as $niray)
                                <td>{{ $niray->sign_number }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nirayana/Sidereal Longitude(NET) / Value in Decimal</td>
                            @foreach ($finalData['netDegrees']['niray'] as $netDegree)
                                <td>{{ $netDegree }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Nirayana/Sidereal Longitude(NET) / Value in DD:MM:SS</td>
                            @foreach ($finalData['netDegrees']['niray'] as $netDegree)
                                <td>{{ convertDegreesToDMS($netDegree) }}</td>
                            @endforeach
                        </tr>




                    </table>
                </div>
            </div>

            <div class="main-collection">
                <div class="collection" id="collection">
                    <div class="col d-flex align-items-center justify-content-between mt-5 table-dark">
                        <p class="mb-2 mt-2">Saryana Houses</p>
                        <i class="fa-solid fa-minus" id="icon1"></i>
                    </div>
                </div>
                <div class="sub-collection" id="sub-collection">
                    <table class="table  table-striped mt-3">
                        <tr>
                            <td class="table-dark">House </td>
                            @foreach ($houseNumber as $index => $house)
                                <td>
                                    {{$house}}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">House Input </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>
                                    @if (isset($result['value'][0]['house']))
                                        {{ $result['value'][0]['house'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Starting Degree </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>
                                    @if (isset($result['value'][0]['starting_degree']))
                                        {{ $result['value'][0]['starting_degree'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Ending Degree </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>
                                    @if (isset($result['value'][0]['ending_degree']))
                                        {{ $result['value'][0]['ending_degree'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">House Width </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>
                                    @if (isset($result['value'][0]['range']))
                                        {{ $result['value'][0]['range'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark" width="13%">Sign Number </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>
                                    @if (isset($result['value'][0]['sign_data']) && !empty($result['value'][0]['sign_data']))
                                        {{ implode(', ', array_column($result['value'][0]['sign_data'], 'sign_number')) }}
                                    @else
                                        No sign data available
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark" width="13%">Sayana Gross Value </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['value'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark" width="13%">Sayana Gross DMS Value </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ convertDegreesToDMS($result['original']['value']) }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Longitude Net Decimal </td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['nethousedegree'] }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Longitude Net DMS</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['dms'] }}</td>
                            @endforeach

                        </tr>

                        <tr>
                            <td class="table-dark">Sign Elements</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['data']->sign_element }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Sign Type</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['data']->sign_type }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Rashi Name</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->rashi_name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Rashi Lord</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->rashi_lord_en }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Planets</td>
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_name }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Pada</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_pada }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Lord</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_lord }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Charan</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_charan_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Diety</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_deity_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Symbol</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_symbol_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Varna</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_varna_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Vashya</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->vashya_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Yoni</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->yoni_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Gana</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->gana_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nadi</td>
                            @foreach ($resultsDmsSary as $result)
                                <td>{{ $result['original']['nakshatra_data']->nadi_eng }}</td>
                            @endforeach
                        </tr>
                    </table>


                </div>
            </div>
            <div class="main-collection">
                <div class="collection" id="collection2">
                    <div class="col d-flex align-items-center justify-content-between mt-5 table-dark">
                        <p class="mb-2 mt-2"> Nirayana Houses</p>
                        <i class="fa-solid fa-minus" id="icon2"></i>
                    </div>
                </div>
                <div class="sub-collection" id="sub-collection2">
                    <table class="table  table-striped mt-3">
                        <tr>
                            <td class="table-dark">House </td>
                            @foreach ($houseNumber as $index => $house)
                                <td>
                                    {{$house}}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">House Input</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>
                                    @if (isset($result['value'][0]['house']))
                                        {{ $result['value'][0]['house'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Starting Degree </td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>
                                    @if (isset($result['value'][0]['starting_degree']))
                                        {{ $result['value'][0]['starting_degree'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Ending Degree </td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>
                                    @if (isset($result['value'][0]['ending_degree']))
                                        {{ $result['value'][0]['ending_degree'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">House Width </td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>
                                    @if (isset($result['value'][0]['range']))
                                        {{ $result['value'][0]['range'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark" width="13%">Sign Number </td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>
                                    @if (isset($result['value'][0]['sign_data']) && !empty($result['value'][0]['sign_data']))
                                        {{ implode(', ', array_column($result['value'][0]['sign_data'], 'sign_number')) }}
                                    @else
                                        No sign data available
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark" width="13%">Nirayana Gross Dms Value </td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['value'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark" width="13%">Nirayana Gross Dms Value </td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ convertDegreesToDMS($result['original']['value']) }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Longitude Net Decimal Value</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['nethousedegree'] }}</td>
                            @endforeach

                        </tr>

                        <tr>
                            <td class="table-dark">Longitude Net DMS</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['dms'] }}</td>
                            @endforeach

                        </tr>

                        <tr>
                            <td class="table-dark">Sign Elements</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['data']->sign_element }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Sign Type</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['data']->sign_type }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Rashi Name</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->rashi_name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Rashi Lord</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->rashi_lord_en }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Planets</td>
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_name }}</td>
                            @endforeach

                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Pada</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_pada }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Lord</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_lord }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Charan</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_charan_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Diety</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_deity_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nakshatra Symbol</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_symbol_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Varna</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->n_varna_eng }}</td>
                            @endforeach
                        </tr>

                        <tr>
                            <td class="table-dark">Vashya</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->vashya_eng }}</td>
                            @endforeach
                        </tr>

                        <tr>
                            <td class="table-dark">Yoni</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->yoni_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Gana</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->gana_eng }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="table-dark">Nadi</td>
                            @foreach ($resultsDmsNiray as $result)
                                <td>{{ $result['original']['nakshatra_data']->nadi_eng }}</td>
                            @endforeach
                        </tr>

                    </table>


                </div>
            </div>


            <div class="main-collection">
                <div class="collection" id="collection3">
                    <div class="col d-flex align-items-center justify-content-between mt-5 table-dark">
                        <p class="mb-2 mt-2">Agni</p>
                        <i class="fa-solid fa-minus" id="icon3"></i>
                    </div>
                </div>
                <div class="sub-collection" id="sub-collection3">
                    <table class="table  table-striped mt-3">
                        <tr>
                            <td class="table-dark">Agni </td>
                            <td class="table-dark">Time Of Birth</td>
                            <td class="table-dark">Result</td>
                            <td class="table-dark">Sign Name </td>
                            <td class="table-dark">Sign Lord</td>
                            <td class="table-dark">Sign Type</td>
                            <td class="table-dark">Sign Element</td>
                        </tr>
                        @foreach($agni['result'] as $key => $value)
                        <tr>
                            <td class="table-dark">{{ $key }}</td>
                            <td>{{ $agni['timeOfDay'] ?? 'No Data' }}</td> <!-- Displaying the timeOfDay -->
                            <td>{{ $value['result'] ?? 'No Data' }}</td> <!-- Displaying the result -->
                            <td>{{ $value['agnidata']->sign_name ?? 'No Data' }}</td>
                            <td>{{ $value['agnidata']->sign_lord ?? 'No Data' }}</td>
                            <td>{{ $value['agnidata']->sign_type ?? 'No Data' }}</td>
                            <td>{{ $value['agnidata']->sign_element ?? 'No Data' }}</td>
                        </tr>
                        @endforeach
                    


                    </table>


                </div>
            </div>
        

             <script>
                     document.getElementById('oneOne').addEventListener('click', () => {
                     document.getElementById('one').style.zIndex = "100";
                     document.getElementById('two').style.zIndex = "1";
                     });

                     document.getElementById('twoTwo').addEventListener('click', () => {
                     document.getElementById('one').style.zIndex = "1";
                     document.getElementById('two').style.zIndex = "100";
                     });

                                     // Define an array of all collection elements and sub-collections
                     let collections = [
                     { collection: document.getElementById('collection'), subCollection: document.getElementById('sub-collection'), icon: document.getElementById('icon') },
                     { collection: document.getElementById('collection1'), subCollection: document.getElementById('sub-collection1'), icon: document.getElementById('icon1') },
                     { collection: document.getElementById('collection2'), subCollection: document.getElementById('sub-collection2'), icon: document.getElementById('icon2') },
                     { collection: document.getElementById('collection3'), subCollection: document.getElementById('sub-collection3'), icon: document.getElementById('icon3') }
                     ];

                         // Initially set all sub-collections to be closed when the page loads
                     collections.forEach(item => {
                     item.subCollection.style.display = "none"; // Hide all sub-collections
                     item.icon.classList.remove("fa-minus");    // Make sure the icon starts as "fa-plus"
                     item.icon.classList.add("fa-plus");
                     });
                 
                       // Add event listeners to all collections
                     collections.forEach(item => {
                     item.collection.addEventListener('click', () => {
                         // Check if the clicked sub-collection is already open
                         if (item.subCollection.style.display === "none" || item.subCollection.style.display === "") {
                             // Open the clicked sub-collection
                             item.subCollection.style.display = "block";  // Show the clicked sub-collection
                             item.icon.classList.add("fa-minus");         // Change the icon to "fa-minus"
                             item.icon.classList.remove("fa-plus");
                         } else {
                             // Close the clicked sub-collection
                             item.subCollection.style.display = "none";   // Hide the clicked sub-collection
                             item.icon.classList.remove("fa-minus");      // Change the icon back to "fa-plus"
                             item.icon.classList.add("fa-plus");
                         }
                     });
                     });
            </script>



        </div>


    </div>

@endsection
