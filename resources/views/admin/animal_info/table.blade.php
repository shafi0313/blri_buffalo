<table id="multi-filter-select" class="display nowrap table table-striped table-hover">
    <thead class="bg-secondary thw">
        <tr>
            <th style="width: 35px">SL</th>
            <th>Identification no</th>
            <th>Buffalo ID</th>
            <th>Farm Id</th>
            <th>Tag no</th>
            <th>Tattoo no</th>
            <th>Type</th>
            <th>Breed</th>
            <th>Coat color</th>
            <th>Sex</th>
            <th>Body Wt. (kg)</th>
            <th>Generation</th>
            <th>Parity</th>
            <th>Dam Milk</th>
            <th>Date of Birth</th>
            <th>Season of Birth</th>
            <th>Sire</th>
            <th>Dam</th>
            <th>Death Date</th>
            <th>Location</th>
            <th>Remark</th>
            @if ($editable == 1)
                <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($animalInfos as $animalInfo)
            <tr>
                <td class="text-center">{{ $x++ }} </td>
                <td>{{ $animalInfo->identification_no }} </td>
                <td>{{ $animalInfo->buffalo_id }} </td>
                <td>{{ $animalInfo->getCommunity ? $animalInfo->getCommunity->no : ''}} </td>
                <td>{{ $animalInfo->farm_id != '' ? $animalInfo->animal_tag : $animalInfo->ear_tag }} </td>
                <td>{{ $animalInfo->tattoo_no }} </td>
                <td>{{ $animalInfo->type == 1 ? 'Swamp' : 'River' }} </td>
                <td>{{ $animalInfo->animalCat->name }} </td>
                <td>{{ $animalInfo->color }} </td>
                <td>{{ $animalInfo->sex }} </td>
                <td>{{ $animalInfo->birth_wt }} </td>
                <td>{{ $animalInfo->generation }} </td>
                <td>{{ $animalInfo->paity }} </td>
                <td>{{ $animalInfo->dam_milk }} </td>
                <td>{{ bdDate($animalInfo->d_o_b) }} </td>
                <td>{{ $animalInfo->season_o_birth }} </td>
                <td>{{ $animalInfo->sire }} </td>
                <td>{{ $animalInfo->dam }} </td>
                <td>{{ bdDate($animalInfo->death_date) }} </td>
                @if ($animalInfo->location->getLocation->name == 'Gazipur' || $animalInfo->location->getLocation->name == 'Dhaka')
                    <td>Savar</td>
                @else
                    <td>{{ $animalInfo->location->getLocation->name }} </td>
                @endif
                <td>{{ $animalInfo->remark }} </td>
                @if ($editable == 1)
                    <td class="text-center">
                        <div class="form-button-action">
                            <a href="{{ route('animal-info.edit', $animalInfo->id) }}" title="Edit"
                                class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('animal-info.destroy', $animalInfo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" class="btn btn-link btn-danger"
                                    data-original-title="Remove" onclick="return confirm('Are you sure?')">
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
