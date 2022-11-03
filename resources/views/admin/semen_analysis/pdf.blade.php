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
        <table>
            <thead>
                <tr>
                    <th style="width: 35px">SL</th>
                    <th>Tag no</th>
                    <th>Semen collecting Date</th>
                    <th>Semen Volume</th>
                    <th>Semen color</th>
                    <th>No. of Straw Prepared</th>
                    <th>Total Motility %</th>
                    <th>Progressive Motility %</th>
                    <th>Sperm concentration m/ml</th>
                </tr>
            </thead>
            <tbody>
                @php $x=1; @endphp
                @foreach ($semenAnalyses as $semenAnalysis)
                <tr class="text-center">
                    <td>{{ $x++ }} </td>
                    <td>{{ $semenAnalysis->animalInfo->animal_tag }} </td>
                    <td>{{ bdDate($semenAnalysis->coll_date) }} </td>
                    <td>{{ $semenAnalysis->volume }} </td>
                    <td>{{ $semenAnalysis->semen_color }} </td>
                    <td>{{ $semenAnalysis->straw_prepared }} </td>
                    <td>{{ $semenAnalysis->total_mortality }} </td>
                    <td>{{ $semenAnalysis->progressive_mortality }} </td>
                    <td>{{ $semenAnalysis->sperm_concentration }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
