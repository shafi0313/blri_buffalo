<table id="multi-filter-select" class="display table table-striped table-hover" >
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag no</th>
            <th>Sex</th>
            <th>Date</th>
            <th>Body length (inch)</th>
            <th>Heart girth (inch)</th>
            <th>Body wt. (Pound)</th>
            <th>Body wt. (Kg)</th>
            @if ($editable == 1)
            <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($morphometrics as $morphometric)
        <tr class="text-center">
            <td>{{ $x++ }} </td>
            <td>{{ $morphometric->animalInfo->animal_tag }} </td>
            <td>{{ $morphometric->animalInfo->sex }} </td>
            <td>{{ bdDate($morphometric->age) }} </td>
            <td>{{ $morphometric->body_lenght }} </td>
            <td>{{ $morphometric->heart_girth }} </td>
            <td>{{ number_format($morphometric->body_lenght * pow($morphometric->heart_girth ,2)/300 ,2) }}</td>
            <td>{{ number_format(($morphometric->body_lenght * pow($morphometric->heart_girth ,2)/300) * .45 ,2) }}</td>
            @if ($editable == 1)
            <td>
                <div class="form-button-action">
                    <a href="{{route('morphometric.edit',$morphometric->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('morphometric.destroy', $morphometric->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="btn btn-link btn-danger" onclick="return confirm('Are you sure?')">
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
