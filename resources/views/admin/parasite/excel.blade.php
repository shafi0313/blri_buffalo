<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            {{-- <th>Breed</th> --}}
            <th>Sex</th>
            <th>Age</th>
            <th>Date of Feces collection</th>
            <th>fecal egg count (FEC)</th>
            <th>Season</th>
            <th>Parasite name</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($parasites as $parasite)
        <tr class="text-center">
            <td>{{ $x++ }} </td>
            <td>{{ $parasite->animalInfo->animal_tag }} </td>
            {{-- <td>{{ $parasite->animalInfo->breed }} </td> --}}
            <td>{{ $parasite->animalInfo->sex }} </td>
            <td>{{ \Carbon\Carbon::parse($parasite->animalInfo->d_o_b)->diff(\Carbon\Carbon::now())->format('%y years, %m months') }} </td>
            <td>{{ bdDate($parasite->feces_collection_date) }} </td>
            <td>{{ $parasite->fecal_egg_count }} </td>
            <td>{{ $parasite->season }} </td>
            <td>{{ $parasite->parasite_name }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
