<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Postal code auto complete</title>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/postcode.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

<head>
    <h2 class="text-center">Postal code auto complete</h2>
</head>

<main>
    <div class="container">
        <p>Postal code</p>
        <input type="text" id="postal_code" class="form-control" placeholder="Postal code" oninput="complete();"
               required>

        <p id="prefecture_title">Prefecture</p>
        <input type="text" id="prefecture" class="form-control" placeholder="Prefecture">

        <p id="city_title">City</p>
        <input type="text" id="city" class="form-control" placeholder="City">

        <p id="town_1_title">Town 1</p>
        <input type="text" id="town_1" class="form-control" placeholder="Town 1">

        <p id="town_2_title">Town 2</p>
        <input type="text" id="town_2" class="form-control" placeholder="Town 2" required>
    </div>
</main>

<footer></footer>
</body>


</html>
