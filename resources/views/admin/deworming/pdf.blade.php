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
                    <th>Tag No</th>
                    <th>Sex</th>
                    {{-- <th>Breed</th> --}}
                    <th>Name of Medicine</th>
                    <th>Date of Deworming</th>
                    <th>Dose</th>
                </tr>
            </thead>
            <tbody>
                @php $x=1; @endphp
                @foreach ($dewormings as $deworming)
                <tr class="text-center">
                    <td>{{ $x++ }} </td>
                    <td>{{ $deworming->animalInfo->animal_tag }} </td>
                    <td>{{ $deworming->animalInfo->sex }} </td>
                    {{-- <td>{{ $deworming->animalInfo->breed }} </td> --}}
                    <td>{{ $deworming->medicine_name }}</td>
                    <td>{{ bdDate($deworming->deworming_date) }}</td>
                    <td>{{ $deworming->dose }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
