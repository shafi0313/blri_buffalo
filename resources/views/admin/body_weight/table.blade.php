<table id="multi-filter-select" class="display table table-striped table-hover" >
    <thead class="bg-secondary thw">
        <tr class="text-center">
            <th style="width: 35px">SL</th>
            <th>Tag no</th>
            <th>Sex</th>
            <th>Body wt. (kg)</th>
            <th>15 d. b. wt.(kg)</th>
            <th>1 m. b. wt.(kg)</th>
            <th>2 m. b. wt.(kg)</th>
            <th>3 m. b. wt.(kg)</th>
            <th>6 m. b. wt.(kg)</th>
            <th>12 m. b. wt.(kg)</th>
            <th>18 m. b. wt.(kg)</th>
            <th>24 m. b. wt.(kg)</th>
            <th>30 m. b. wt.(kg)</th>
            <th>36 m. b. wt.(kg)</th>
            <th>42 m. b. wt.(kg)</th>
            <th>48 m. b. wt.(kg)</th>
            <th>Growth rate at 0 d. (kg/d)</th>
            <th>Growth rate at 15 d. (kg/d)</th>
            <th>Growth rate at 1 m. (kg/d)</th>
            <th>Growth rate at 2 m. (kg/d)</th>
            <th>Growth rate at 3 m. (kg/d)</th>
            <th>Growth rate at 6 m. (kg/d)</th>
            <th>Growth rate at 12 m. (kg/d)</th>
            <th>Growth rate at 18 m. (kg/d)</th>
            <th>Growth rate at 24 m. (kg/d)</th>
            <th>Growth rate at 30 m. (kg/d)</th>
            <th>Growth rate at 36 m. (kg/d)</th>
            <th>Growth rate at 42 m. (kg/d)</th>
            <th>Growth rate at 48 m. (kg/d)</th>
            @if ($editable == 1)
            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php $x=1; @endphp
        @foreach ($productionRecords as $productionRecord)
        <tr class="text-center">
            <td>{{ $x++ }} </td>
            <td>{{ $productionRecord->animalInfo->animal_tag }} </td>
            <td>{{ $productionRecord->animalInfo->sex }} </td>
            <td>{{ $productionRecord->day_0 }} </td>
            <td>{{ $productionRecord->day_15 }} </td>
            <td>{{ $productionRecord->month_1 }} </td>
            <td>{{ $productionRecord->month_2 }} </td>
            <td>{{ $productionRecord->month_3 }} </td>
            <td>{{ $productionRecord->month_6 }} </td>
            <td>{{ $productionRecord->month_12 }} </td>
            <td>{{ $productionRecord->month_18 }} </td>
            <td>{{ $productionRecord->month_24 }} </td>
            <td>{{ $productionRecord->month_30 }} </td>
            <td>{{ $productionRecord->month_36 }} </td>
            <td>{{ $productionRecord->month_42 }} </td>
            <td>{{ $productionRecord->month_48 }} </td>

            @isset($productionRecord->day_0)
            <td>{{ number_format($productionRecord->day_0 - ($productionRecord->animalInfo->birth_wt),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->day_15)
            <td>{{ number_format($productionRecord->day_15 - ($productionRecord->animalInfo->birth_wt/15),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_1)
            <td>{{ number_format($productionRecord->month_1 - ($productionRecord->animalInfo->birth_wt/30),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_2)
            <td>{{ number_format($productionRecord->month_2 - ($productionRecord->animalInfo->birth_wt/60),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_3)
            <td>{{ number_format($productionRecord->month_3 - ($productionRecord->animalInfo->birth_wt/60),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_6)
            <td>{{ number_format($productionRecord->month_6 - ($productionRecord->animalInfo->birth_wt/90),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_12)
            <td>{{ number_format($productionRecord->month_12 - ($productionRecord->animalInfo->birth_wt/360),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_18)
            <td>{{ number_format($productionRecord->month_18 - ($productionRecord->animalInfo->birth_wt/540),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_24)
            <td>{{ number_format($productionRecord->month_24 - ($productionRecord->animalInfo->birth_wt/720),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_30)
            <td>{{ number_format($productionRecord->month_30 - ($productionRecord->animalInfo->birth_wt/900),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_34)
            <td>{{ number_format($productionRecord->month_36 - ($productionRecord->animalInfo->birth_wt/1080),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_42)
            <td>{{ number_format($productionRecord->month_42 - ($productionRecord->animalInfo->birth_wt/1260),2) }} </td>
            @else
            <td></td>
            @endisset

            @isset($productionRecord->month_48)
            <td>{{ number_format($productionRecord->month_48 - ($productionRecord->animalInfo->birth_wt/1440),2) }} </td>
            @else
            <td></td>
            @endisset

            @if ($editable == 1)
            <td>
                <div class="form-button-action">
                    <a href="{{route('body-weight.edit',$productionRecord->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{-- <form action="{{ route('farm.destroy', $productionRecord->id) }}" method="POST">
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
