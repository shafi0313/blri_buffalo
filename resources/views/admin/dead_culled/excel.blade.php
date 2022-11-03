<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Sex</th>
            {{-- <th>Breed</th> --}}
            {{-- <th>Dead/Culled</th> --}}
            <th>Reason</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @php $x=1; @endphp
        @foreach ($deadCulleds as $deadCulled)
        <tr class="text-center">
            <td>{{ $x++ }} </td>
            <td>{{$deadCulled->animalInfo->animal_tag }} </td>
            <td>{{$deadCulled->animalInfo->sex }} </td>
            {{-- <td>{{$deadCulled->animalInfo->breed }} </td>
            <td>{{$deadCulled->dead_culled }}</td> --}}
            <td>{{$deadCulled->reason }}</td>
            <td>{{ bdDate($deadCulled->date_dead_culled) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
