<table id="multi-filter-select" class="display table table-striped table-hover">
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Tattoo No</th>
            {{-- <th>Breed</th> --}}
            <th>Sex</th>
            <th>Age</th>
            <th>Date of Feces collection</th>
            <th>fecal egg count (FEC)</th>
            <th>Season</th>
            <th>Parasite name</th>
            @if ($editable == 1)
                <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($parasites as $parasite)
            <tr class="text-center">
                <td>{{ $x++ }} </td>
                <td>{{ $parasite->animalInfo->animal_tag }} </td>
                <td>{{ $parasite->animalInfo->tattoo_no }} </td>
                {{-- <td>{{ $parasite->animalInfo->breed }} </td> --}}
                <td>{{ $parasite->animalInfo->sex }} </td>
                <td>{{ \Carbon\Carbon::parse($parasite->animalInfo->d_o_b)->diff(\Carbon\Carbon::now())->format('%y years, %m months') }}
                </td>
                <td>{{ \Carbon\Carbon::parse($parasite->feces_collection_date)->format('d/m/Y') }} </td>
                <td>{{ $parasite->fecal_egg_count }} </td>
                <td>{{ $parasite->season }} </td>
                <td>{{ $parasite->parasite_name }} </td>
                @if ($editable == 1)
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('parasite.edit', $parasite->id) }}" title="Edit"
                                class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('parasite.destroy', $parasite->id) }}" method="POST">
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
