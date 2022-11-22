<table id="multi-filter-select" class="display table table-striped table-hover">
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Tattoo No</th>
            <th>Sex</th>
            <th>Breed</th>
            <th>Name of Disease</th>
            <th>Clinical Sign</th>
            <th>Symptom/Sign Visible Date</th>
            <th>Treatment Starting Date</th>
            <th>Recovered/ Dead</th>
            @if ($editable == 1)
                <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($diseaseTreatments as $diseaseTreatment)
            <tr class="text-center">
                <td>{{ $x++ }} </td>
                <td>{{ $diseaseTreatment->animalInfo->animal_tag }} </td>
                <td>{{ $diseaseTreatment->animalInfo->tattoo_no }} </td>
                <td>{{ $diseaseTreatment->animalInfo->sex }} </td>
                <td>{{ $diseaseTreatment->animalInfo->breed }} </td>
                <td>{{ $diseaseTreatment->diseaseSign->disease->name ?? ''}} </td>
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
                <td>{{ bdDate($diseaseTreatment->symptom_date) }} </td>
                <td>{{ bdDate($diseaseTreatment->disease_date) }} </td>
                <td>{{ $diseaseTreatment->recovered_dead }} </td>
                @if ($editable == 1)
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('disease-and-treatment.edit', $diseaseTreatment->id) }}" title="Edit"
                                class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('disease-and-treatment.destroy', $diseaseTreatment->id) }}"
                                method="POST">
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
