<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planet Positions</title>
</head>

<body>
    <form action="{{ route('planet-positions.submit') }}" method="POST">
        @csrf  <!-- CSRF token for security -->

        <label for="ayanamsa">Ayanamsa</label>
        <input type="number" name="ayanamsa" required>

        <label for="planets">Planets</label>
        <input type="text" name="planets[]" required>

        <label for="latitude">Latitude</label>
        <input type="number" name="latitude" required>

        <label for="longitude">Longitude</label>
        <input type="number" name="longitude" required>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
