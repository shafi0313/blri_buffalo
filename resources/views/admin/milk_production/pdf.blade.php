<style>
    .table table {

        width: 100%;
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
                    <th>Tag No</th>
                    <th>Tattoo No</th>
                    <th>Date of Milking</th>
                    <th>Milk Production (kg)</th>
                    <th>Peak Milk Production (kg)</th>
                    {{-- <th>Average milk production (Kg)</th> --}}
                    <th>Lactation length</th>
                </tr>
            </thead>
            <tbody>
                @php $x=1; @endphp
                @foreach ($milkProductions as $milkProduction)
                    <tr class="text-center">
                        <td>{{ $x++ }} </td>
                        <td>{{ $milkProduction->animalInfo->animal_tag }} </td>
                        <td>{{ $milkProduction->animalInfo->tattoo_no }} </td>
                        <td>{{ \Carbon\Carbon::parse($milkProduction->date_of_milking)->format('d/m/Y') }} </td>
                        <td>{{ $milkProduction->milk_production }} </td>
                        <td>{{ $milkProduction->milk_production }} </td>
                        {{-- <td>{{ number_format($milkProductions->where('animal_info_id', $milkProduction->animal_info_id)->sum('milk_production') / $milkProducti->count(), 2) }}
                        </td> --}}
                        <td>{{ $milkProduction->lactation_length }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
