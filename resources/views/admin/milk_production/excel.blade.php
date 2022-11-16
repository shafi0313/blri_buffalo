<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Tattoo No</th>
            <th>Date of Milking</th>
            <th>Milk Production (kg)</th>
            <th>Peak Milk Production (kg)</th>
            <th>Average milk production (Kg)</th>
            <th>Lactation length</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($milkProductions->groupBy('animal_info_id') as $milkProducti)
            @php
                $milkProduction = $milkProducti->first();
            @endphp
            <tr class="text-center">
                <td>{{ $x++ }} </td>
                <td>{{ $milkProduction->animalInfo->animal_tag }} </td>
                <td>{{ $milkProduction->animalInfo->tattoo_no }} </td>
                <td>{{ \Carbon\Carbon::parse($milkProduction->date_of_milking)->format('d/m/Y') }} </td>
                <td>{{ $milkProduction->milk_production }} </td>
                <td>{{ $milkProduction->peak_milk_production }} </td>
                <td>{{ number_format($milkProductions->where('animal_info_id', $milkProduction->animal_info_id)->sum('milk_production') / $milkProducti->count(), 2) }}
                </td>
                <td>{{ $milkProduction->lactation_length }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
