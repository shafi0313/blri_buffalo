<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Female Buffalo ID;</th>
            <th>Buffalo Bull ID</th>
            <th>Date of Service</th>
            <th>Expected Date of Birth</th>
            <th>Natural/AI</th>
            <th>Repeat Heat/not</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($services as $service)
        <tr>
            <td>{{ $x++ }} </td>
            <td>{{ $service->animalInfo->animal_tag }} </td>
            <td>{{ $service->bullId->animal_tag }} </td>
            <td>{{ bdDate($service->date_of_service) }} </td>
            <td>{{ bdDate($service->expected_d_o_b) }} </td>
            <td>{{ $service->natural }} </td>
            <td>{{ $service->repeat_heat }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
