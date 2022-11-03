<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Tag no</th>
            <th>Sex</th>
            <th>Distribution type</th>
            <th>Distribution to</th>
            <th>Organization name</th>
            <th>Distribution date</th>
            <th>Number of straw</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($distributions as $distribution)
        <tr>
            <td>{{ $x++ }} </td>
            <td>{{ $distribution->animalInfo->animal_tag }} </td>
            <td>{{ $distribution->animalInfo->sex }} </td>
            <td>{{ $distribution->dis_type }} </td>
            <td>{{ $distribution->dis_to }} </td>
            <td>{{ $distribution->org_name }} </td>
            <td>{{ bdDate($distribution->dis_date) }} </td>
            <td>{{ $distribution->straw }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
