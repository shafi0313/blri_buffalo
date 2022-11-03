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
