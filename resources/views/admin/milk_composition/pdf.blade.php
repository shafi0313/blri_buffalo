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
                    <th>Area</th>
                    <th>Animal ID</th>
                    <th>Calving Date</th>
                    <th>Milking Date</th>
                    <th>Milk Production</th>
                    <th>Milk Fat(%)</th>
                    <th>Density</th>
                    <th>Lactose</th>
                    <th>SNF</th>
                    <th>Protein(%)</th>
                    <th>Water</th>
                    <th>Salt</th>
                </tr>
            </thead>
            <tbody>
                @php $x=1; @endphp
                @foreach ($milkCompositions as $milkComposition)
                    <tr class="text-center">
                        <td>{{ $x++ }} </td>
                        <td>{{ $milkComposition->farm ? $milkComposition->farm->name : $milkComposition->communityCat->name }}
                        </td>
                        <td>{{ $milkComposition->animalInfo->animal_tag }} </td>
                        <td>{{ \Carbon\Carbon::parse($milkComposition->calving_date)->format('d/m/Y') }} </td>
                        <td>{{ \Carbon\Carbon::parse($milkComposition->date)->format('d/m/Y') }} </td>
                        <td>{{ $milkComposition->production }} </td>
                        <td>{{ $milkComposition->fat }}</td>
                        <td>{{ $milkComposition->density }}</td>
                        <td>{{ $milkComposition->lactose }}</td>
                        <td>{{ $milkComposition->snf }}</td>
                        <td>{{ $milkComposition->protein }}</td>
                        <td>{{ $milkComposition->water }}</td>
                        <td>{{ $milkComposition->salt }}</td>
                    </tr>
                @endforeach
            </tbody>
    </div>

</body>

</html>
