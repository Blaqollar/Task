<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Import</title>
</head>
<body>

    <form action="{{ route('csv.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" accept=".csv, .txt">
        <button type="submit">Import CSV</button>
    </form>

</body>
</html>