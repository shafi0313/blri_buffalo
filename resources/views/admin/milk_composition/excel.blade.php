<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Calving Date</th>
            <th>Milking Date</th>
            <th>Milk Production</th>
            <th>Milk Fat(%)</th>
            <th>Milk Protein(%)</th>
        </tr>
    <tbody>
        @php $x=1; @endphp
        @foreach ($milkCompositions as $milkComposition)
        <tr class="text-center">
            <td>{{ $x++ }} </td>
            <td>{{ $milkComposition->animalInfo->animal_tag }} </td>
            <td>{{ \Carbon\Carbon::parse($milkComposition->calving_date)->format('d/m/Y') }} </td>
            <td>{{ \Carbon\Carbon::parse($milkComposition->date)->format('d/m/Y') }} </td>
            <td>{{ $milkComposition->production }} </td>
            <td>{{ $milkComposition->fat }}</td>
            <td>{{ $milkComposition->protein }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
