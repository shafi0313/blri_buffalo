<table id="multi-filter-select" class="display table table-striped table-hover">
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag no</th>
            <th>Tattoo no</th>
            <th>Semen collecting Date</th>
            <th>Semen Volume</th>
            <th>Semen color</th>
            <th>No. of Straw Prepared</th>
            <th>Total Motility %</th>
            <th>Progressive Motility %</th>
            <th>Sperm concentration m/ml</th>
            @if ($editable == 1)
                <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($semenAnalyses as $semenAnalysis)
            <tr class="text-center">
                <td>{{ $x++ }} </td>
                <td>{{ $semenAnalysis->animalInfo->animal_tag }} </td>
                <td>{{ $semenAnalysis->animalInfo->tattoo_no }} </td>
                <td>{{ bdDate($semenAnalysis->date) }} </td>
                <td>{{ $semenAnalysis->volume }} </td>
                <td>{{ $semenAnalysis->semen_color }} </td>
                <td>{{ $semenAnalysis->straw_prepared }} </td>
                <td>{{ $semenAnalysis->total_mortality }} </td>
                <td>{{ $semenAnalysis->progressive_mortality }} </td>
                <td>{{ $semenAnalysis->sperm_concentration }} </td>
                @if ($editable == 1)
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('semen-analysis.edit', $semenAnalysis->id) }}" title="Edit"
                                class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('semen-analysis.destroy', $semenAnalysis->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" class="btn btn-link btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
