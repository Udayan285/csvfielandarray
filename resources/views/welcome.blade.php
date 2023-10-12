<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>TaskApp</title>
</head>
<body>
    <h3>Coder's Lab Interview Task</h3>
    <button class="btn btn-warning"> <a href="{{ route('filter') }}" style="color: black; text-decoration:none;">Filter With Pending Status and Greater Than Current Time</a></button>
    <button class="btn btn-danger"> <a href="{{ route('remove') }}" style="color: white; text-decoration:none;">Remove all the data where the "status" is "failed" or "cancelled"</a></button>
    <button class="btn btn-success"> <a href="{{ route('paid') }}" style="color: white; text-decoration:none;">Only Paid Data Check</a></button>
    <button class="btn btn-black"> <a href="{{ route('insertcsv') }}" style="color: rgb(151, 27, 27); text-decoration:none;">Insert CSV Without Duplicate Entry</a></button>
    <button class="btn btn-primary"> <a href="{{ route('works') }}" style="margin-top:10px; color: rgb(214, 201, 201); text-decoration:none;">Insert Data.php into works db</a></button>
</body>
</html>