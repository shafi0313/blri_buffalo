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
                <tr class="text-center">
                    <th style="width: 35px">SL</th>
                    <th>Name of Vaccine</th>
                    <th>Date of Vaccination</th>
                    <th>Dose</th>
                    <th>Total animal vaccinated</th>
                </tr>
            </thead>
            <tbody>
                @php $x=1; @endphp
                @foreach ($vaccinations->groupBy('group') as $vaccinatio)
                @php $vaccination =  $vaccinatio->first() @endphp
                <tr class="text-center">
                    <td>{{ $x++ }} </td>
                    <td>{{ $vaccination->vaccine_name }} </td>
                    <td>{{ bdDate($vaccination->vaccine_date) }} </td>
                    <td>{{ $vaccination->dose }} </td>
                    <td>{{ $vaccination->total_vaccinated }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
