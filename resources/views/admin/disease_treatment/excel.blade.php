<table>
    <thead>
        <tr>
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Sex</th>
            <th>Breed</th>
            <th>Name of Disease</th>
            <th>Clinical Sign</th>
            {{-- <th>Season of Disease</th> --}}
            {{-- <th>Medicine Prescribed</th> --}}
            <th>Symptom/Sign Visible Date</th>
            <th>Treatment Starting Date</th>
            <th>Recovered/ Dead</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($diseaseTreatments as $diseaseTreatment)
        <tr class="text-center">
            <td>{{ $x++ }} </td>
            <td>{{ $diseaseTreatment->animalInfo->animal_tag }} </td>
            <td>{{ $diseaseTreatment->animalInfo->sex }} </td>
            <td>{{ $diseaseTreatment->animalInfo->breed }} </td>
            <td>{{ $diseaseTreatment->diseaseSign->disease->name }} </td>
            <td>
                <table>
                    @foreach ($diseaseTreatment->diseaseSigns as $clinicalSign)
                    <tr>
                        <td>{{ $clinicalSign->clinicalSign->name }}, </td>
                    </tr>
                    @endforeach
                    @isset($diseaseTreatment->other)
                    <td>{{ $diseaseTreatment->other }}</td>
                    @endisset
                </table>
            </td>
            {{-- <td>{{ $diseaseTreatment->clinicalSign->name }} </td> --}}
            {{-- <td>{{ $diseaseTreatment->disease_season }} </td> --}}
            {{-- <td>{{ $diseaseTreatment->medicine_prescribed }} </td> --}}
            <td>{{ bdDate($diseaseTreatment->symptom_date) }} </td>
            <td>{{ bdDate($diseaseTreatment->disease_date) }} </td>
            <td>{{ $diseaseTreatment->recovered_dead }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
