<table id="multi-filter-select" class="display table table-striped table-hover">
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag No</th>
            <th>Tattoo No</th>
            <th>Coat color</th>
            <th>Sex</th>
            <th>Age at 1<sup>st</sup> heat </th>
            <th>Date at 1st service</th>
            <th>Date of 1st calving</th>
            <th>1st Calving interval</th>
            <th>Days open</th>
            <th>Milk production (ml)</th>

            <th>Date at 2nd service</th>
            <th>Date of 2nd calving</th>
            <th>2nd Calving interval</th>

            <th>Date at 3rd service</th>
            <th>Date of 3rd calving</th>
            <th>3rd Calving interval</th>


            <th>Date at 4th service</th>
            <th>Date of 4th calving</th>
            <th>4th Calving interval</th>

            <th>Date at 5th service</th>
            <th>Date of 5th calving</th>
            <th>5th Calving interval</th>

            <th>Date at 6th service</th>
            <th>Date of 6th calving</th>
            <th>6th Calving interval</th>

            <th>Date at 7th service</th>
            <th>Date of 7th calving</th>
            <th>7th Calving interval</th>

            <th>Date at 8th service</th>
            <th>Date of 8th calving</th>
            <th>8th Calving interval</th>

            <th>Date at 9th service</th>
            <th>Date of 9th calving</th>
            <th>9th Calving interval</th>

            <th>Date at 10th service</th>
            <th>Date of 10th calving</th>
            <th>10th Calving interval</th>

            <th>Remarks</th>
            @if ($editable == 1)
                <th class="no-sort" style="text-align:center;width:80px">Action</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php
            $x = 1;
            $milkProduction = App\Models\MilkProduction::all();
        @endphp
        @foreach ($reproductions as $reproduction)
            <tr class="text-center">
                <td>{{ $x++ }} </td>
                <td>{{ $reproduction->animalInfo->animal_tag }} </td>
                <td>{{ $reproduction->animalInfo->tattoo }} </td>
                <td>{{ $reproduction->animalInfo->color }} </td>
                <td>{{ $reproduction->animalInfo->sex }} </td>
                <td>{{ $reproduction->puberty_age }}</td>

                <td>{{ bdDate($reproduction->service_1st_date) }}</td>
                <td>{{ bdDate($reproduction->calving_1st_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_1st_date, $reproduction->calving_1st_date) }}</td>


                @if ($reproduction->service_10th_date != '')
                    @php $lastService = $reproduction->service_10th_date @endphp
                @elseif($reproduction->service_9th_date != '')
                    @php $lastService = $reproduction->service_9th_date @endphp
                @elseif($reproduction->service_8th_date != '')
                    @php $lastService = $reproduction->service_8th_date @endphp
                @elseif($reproduction->service_7th_date != '')
                    @php $lastService = $reproduction->service_7th_date @endphp
                @elseif($reproduction->service_6th_date != '')
                    @php $lastService = $reproduction->service_6th_date @endphp
                @elseif($reproduction->service_5th_date != '')
                    @php $lastService = $reproduction->service_5th_date @endphp
                @elseif($reproduction->service_4th_date != '')
                    @php $lastService = $reproduction->service_4th_date @endphp
                @elseif($reproduction->service_3rd_date != '')
                    @php $lastService = $reproduction->service_3rd_date @endphp
                @elseif($reproduction->service_2nd_date != '')
                    @php $lastService = $reproduction->service_2nd_date @endphp
                @elseif($reproduction->service_1st_date != '')
                    @php $lastService = $reproduction->service_1st_date @endphp
                @else
                    @php $lastService = '' @endphp
                @endif

                @if ($reproduction->calving_10th_date != '')
                    @php $calvingDate = $reproduction->calving_10th_date @endphp
                @elseif($reproduction->calving_9th_date != '')
                    @php $calvingDate = $reproduction->calving_9th_date @endphp
                @elseif($reproduction->calving_8th_date != '')
                    @php $calvingDate = $reproduction->calving_8th_date @endphp
                @elseif($reproduction->calving_7th_date != '')
                    @php $calvingDate = $reproduction->calving_7th_date @endphp
                @elseif($reproduction->calving_6th_date != '')
                    @php $calvingDate = $reproduction->calving_6th_date @endphp
                @elseif($reproduction->calving_5th_date != '')
                    @php $calvingDate = $reproduction->calving_5th_date @endphp
                @elseif($reproduction->calving_4th_date != '')
                    @php $calvingDate = $reproduction->calving_4th_date @endphp
                @elseif($reproduction->calving_3rd_date != '')
                    @php $calvingDate = $reproduction->calving_3rd_date @endphp
                @elseif($reproduction->calving_2nd_date != '')
                    @php $calvingDate = $reproduction->calving_2nd_date @endphp
                @elseif($reproduction->calving_1st_date != '')
                    @php $calvingDate = $reproduction->calving_1st_date @endphp
                @else
                    @php $calvingDate = '' @endphp
                @endif

                @if ($calvingDate && $lastService)
                    <td>{{ Carbon\Carbon::parse($calvingDate)->diffInDays(Carbon\Carbon::parse($lastService)) }}</td>
                @else
                    <td></td>
                @endif
                {{-- @if (carbon($reproduction->service_1st_date)->addMonth(4) <= carbon($reproduction->service_2nd_date))
            <td>{{ bdDate($reproduction->service_1st_date) }}</td>
            @else
            <td></td>
            @endif --}}

                @if ($milkProduction->where('animal_info_id', $reproduction->animal_info_id)->count() > 0)
                    <td>{{ number_format($milkProduction->where('animal_info_id', $reproduction->animal_info_id)->sum('milk_production') / $milkProduction->where('animal_info_id', $reproduction->animal_info_id)->count(), 2) }}
                    </td>
                @else
                    <th></th>
                @endif

                <td>{{ bdDate($reproduction->service_2nd_date) }}</td>
                <td>{{ bdDate($reproduction->calving_2nd_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_2nd_date, $reproduction->calving_2nd_date) }}</td>

                <td>{{ bdDate($reproduction->service_3rd_date) }}</td>
                <td>{{ bdDate($reproduction->calving_3rd_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_3rd_date, $reproduction->calving_3rd_date) }}</td>


                <td>{{ bdDate($reproduction->service_4th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_4th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_4th_date, $reproduction->calving_4th_date) }}</td>

                <td>{{ bdDate($reproduction->service_5th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_5th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_5th_date, $reproduction->calving_5th_date) }}</td>

                <td>{{ bdDate($reproduction->service_6th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_6th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_6th_date, $reproduction->calving_6th_date) }}</td>

                <td>{{ bdDate($reproduction->service_7th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_7th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_7h_date, $reproduction->calving_7th_date) }}</td>

                <td>{{ bdDate($reproduction->service_8th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_8th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_8th_date, $reproduction->calving_8th_date) }}</td>

                <td>{{ bdDate($reproduction->service_9th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_9th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_9th_date, $reproduction->calving_9th_date) }}</td>

                <td>{{ bdDate($reproduction->service_10th_date) }}</td>
                <td>{{ bdDate($reproduction->calving_10th_date) }}</td>
                <td>{{ calvingInterval($reproduction->service_10th_date, $reproduction->calving_10th_date) }}</td>

                <td>{{ $reproduction->remarks }}</td>
                @if ($editable == 1)
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('reproduction-record.edit', $reproduction->id) }}" title="Edit"
                                class="btn btn-link btn-primary btn-lg">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <form action="{{ route('farm.destroy', $reproduction->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                            <i class="fa fa-times"></i>
                        </button>
                    </form> --}}
                        </div>
                    </td>
                @endif

            </tr>
        @endforeach
    </tbody>
</table>
