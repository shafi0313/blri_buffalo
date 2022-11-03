<style>
    .table table  {
        th: 100%;
    }
    .table table tr th, .table table tr td {
        border: 1px solid gray;

    }
    table{
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
        <table>
            <thead>
                <tr>
                    <th style="width: 35px">SL</th>
                    <th>Female Buffalo ID;</th>
                    <th>Buffalo Bull ID</th>
                    <th>Date of Service</th>
                    <th>Expected Date of Birth</th>
                    <th>Natural/AI</th>
                    <th>Repeat Heat/not</th>
                </tr>
            </thead>
            <tbody>
                @php $x=1; @endphp
                @foreach ($services as $service)
                <tr>
                    <td>{{ $x++ }} </td>
                    <td>{{ $service->animalInfo->animal_tag }} </td>
                    <td>{{ $service->bullId->animal_tag }} </td>
                    <td>{{ bdDate($service->date_of_service) }} </td>
                    <td>{{ bdDate($service->expected_d_o_b) }} </td>
                    <td>{{ $service->natural }} </td>
                    <td>{{ $service->repeat_heat }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
