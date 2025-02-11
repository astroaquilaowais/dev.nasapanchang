<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .result {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
        }
        .result p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kundali Calculation</h2>
        <form action="{{ route('calculate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="a">Degree of Planet A:</label>
                <input type="number" step="any" name="a" id="a" required>
            </div>
            <div class="form-group">
                <label for="b">Degree of Planet B:</label>
                <input type="number" step="any" name="b" id="b" required>
            </div>
            <div class="form-group">
                <label for="c">Degree of Planet C:</label>
                <input type="number" step="any" name="c" id="c" required>
            </div>
            <button type="submit">Calculate</button>
        </form>

        @if(isset($result))
            <div class="result">
                <h3>Calculation Result:</h3>
                <p><strong>Calculated Value (d):</strong> {{ $result }}°</p>
                <p><strong>Day or Night:</strong> {{ $day_or_night }}</p>
                
                @if($data)
                    <h3>Zodiac Data:</h3>
                    <p><strong>Sign Name:</strong> {{ $data->sign_name }}</p>
                    <p><strong>Sign Lord:</strong> {{ $data->sign_lord }}</p>
                    <p><strong>Sign Type:</strong> {{ $data->sign_type }}</p>
                    <p><strong>Sign Element:</strong> {{ $data->sign_element }}</p>
                @else
                    <p>No zodiac data found for this calculation.</p>
                @endif
            </div>
        @endif
    </div>
</body>
</html>
