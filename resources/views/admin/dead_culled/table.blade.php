<table id="multi-filter-select" class="display table table-striped table-hover">
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Tattoo No</th>
            <th>Sex</th>
            <th>Reason</th>
            <th>Date</th>
            @if ($editable == 1)
                <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif

        </tr>
    </thead>

    <tbody>
        @php $x=1; @endphp
        @foreach ($deadCulleds as $deadCulled)
            <tr class="text-center">
                <td>{{ $x++ }} </td>
                <td>{{ $deadCulled->animalInfo->animal_tag }} </td>
                <td>{{ $deadCulled->animalInfo->tattoo_no }} </td>
                <td>{{ $deadCulled->animalInfo->sex }} </td>
                <td>{{ $deadCulled->reason }}</td>
                <td>{{ bdDate($deadCulled->date_dead_culled) }}</td>
                @if ($editable == 1)
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('dead-culled.edit', $deadCulled->id) }}" title="Edit"
                                class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('dead-culled.destroy', $deadCulled->id) }}" method="POST">
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
