<style>
    .table table {

        th: 100%;
    }

    .table table tr th,
    .table table tr td {
        border: 1px solid gray;

    }

    table {
        border-collapse: collapse;
    }
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="font-size: 14px !important">
    <div class="table">
        @php
        $editable = 0;
        @endphp
        @include('admin.animal_info.table')
    </div>

</body>

</html>
