<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astrology Converter</title>
</head>

<body>
    <h1>Astrology Degrees Converter</h1>
    <form action="{{ route('convertDegreesToDMS') }}" method="POST">
        @csrf
        <label for="degrees">Enter Degrees:</label>
        <input type="number" step="any" name="degrees" id="degrees" required>
        <button type="submit">Convert to DMS</button>
    </form>

    <form action="{{ route('convertDMSToDegrees') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dms">Enter DMS</label>
            <div class="row">
                <div class="col">
                    <label for="degree">Degree</label>
                    <input type="number" class="form-control" name="degree" min="0" max="360" required>
                </div>
                <div class="col">
                    <label for="minute">Minute</label>
                    <input type="number" class="form-control" id="minute" name="minute" min="0"
                        max="59" required>
                </div>
                <div class="col">
                    <label for="second">Second</label>
                    <input type="number" class="form-control" id="second" name="second" min="0"
                        max="59" required>
                </div>
            </div>
        </div>
        <button type="submit">Convert to Degrees</button>
    </form>




    @if (isset($data))
        <h1>Zodiac Sign Information</h1>
        <p><strong>Sign Name:</strong> {{ $data->sign_name }}</p>
        <p><strong>Sign Lord:</strong> {{ $data->sign_lord }}</p>
        <p><strong>Sign Type:</strong> {{ $data->sign_type }}</p>
        <p><strong>Sign Element:</strong> {{ $data->sign_element }}</p>
        <p><strong>Sign Number:</strong> {{ $data->sign_number }}</p>
        <p><strong>Net Degree:</strong> {{ $netDegree }}</p>
        <p><strong>Net Degree:</strong> {{ $netDms }}</p>
        <p><strong>Converted DMS:</strong> {{ isset($result) ? $result : 'No result available.' }}</p>
        <p><strong>The input degree is:</strong> {{ isset($inputDegrees) ? $inputDegrees : 'No degree provided.' }}</p>

        <!-- Add any other fields you want to display -->
    @else
        <p>No zodiac sign found for the provided degree.</p>
    @endif
    {{-- <table class="table">
        <thead>
            <tr>
                <th>Value (Degrees)</th>
                <th>Sign Number</th>
                <th>House Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result['value'] }}</td>
                    <td>{{ $result['sign_number'] }}</td>
                    <td>{{ $result['house_number'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <div class="container">

        <h2>Results</h2>
        @if($results)
            <table class="table">
                <thead>
                    <tr>
                        <th>Value (Degrees)</th>
                        <th>Sign Number</th>
                        <th>House Number</th>
                        <th>DMS Value</th>
                        <th>Sign Element</th>
                        <th>Sign Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result['value'] }}</td>
                            <td>{{ $result['data']->sign_number }}</td>
                            <td>{{ $result['house_number']}}</td>
                            <td>{{ $netDms }} </td> <!-- Include DMS value if available -->
                            <td>{{ $result['data']->sign_element }}</td>
                            <td>{{ $result['data']->sign_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No results available.</p>
        @endif


    </div>
</body>

</html>
