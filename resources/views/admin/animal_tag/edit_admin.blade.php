<style>
    .select2 {
        width: 100% !important;
    }
</style>
<div class="form-group col-md-3">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farm"
        class="form-control @error('community_cat_id') is-invalid @enderror select2">
        <option selected >Select</option>
        @foreach ($farms as $farm)
            <option value="{{ $farm->id }}f" {{ $data->farm_id == $farm->id ? 'selected' : '' }}>{{ $farm->name }}
            </option>
        @endforeach
        @foreach ($communityCats as $communityCat)
            <option value="{{ $communityCat->id }}c" {{ $data->community_cat_id == $farm->id ? 'selected' : '' }}>
                {{ $communityCat->name }}</option>
        @endforeach
    </select>
    @error('community_cat_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 subFarmDiv" style="display: none">
    <label for="">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control select2"></select>
</div>

<div class="form-group col-md-3">
    <label for="name">Tag no <span class="t_r">*</span></label>
    <select name="animal_info_id" id="animal_info"
        class="form-control @error('animal_info_id') is-invalid @enderror select2">
        <option value="{{ $data->animal_info_id }}">{{ $data->animalInfo->animal_tag }}</option>
    </select>
    @error('animal_info_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3">
    <label for="tattoo_no">Tattoo no <span class="t_r">*</span></label>
    <select name="tattoo_no" id="tattooNo" class="form-control @error('tattoo_no') is-invalid @enderror select2">
        <option value="{{ $data->tattoo_no }}">{{ $data->animalInfo->tattoo_no }}</option>
    </select>
    @error('tattoo_no')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

{{-- @if ($animalExtraInfo == 1)
    <div class="form-group col-md-3">
        <label for="">Sex <span class="t_r">*</span></label>
        <input type="text" class="form-control" id="sex" value="" readonly>
    </div>

    <div class="form-group col-md-3">
        <label for="">Coat Color <span class="t_r">*</span></label>
        <input type="text" class="form-control" id="color" value="" readonly>
    </div>

    <div class="form-group col-md-3">
        <label for="">Body Wt. (Kg) <span class="t_r">*</span></label>
        <input type="text" class="form-control" id="birth_wt" readonly>
    </div>
@endif --}}


@push('custom_scripts')
    <script>
        $(document).ready(function() {
            $('#farm').on('change', function() {
                let farm = $(this).val().slice(-1);
                if (farm == 'c') {
                    $('.subFarmDiv').show();
                    // $('#farm').on('change',function(e) {
                    var farmOrComId = $(this).val()
                    $.ajax({
                        url: '{{ route('get.subFarm') }}',
                        type: "get",
                        data: {
                            farmOrComId: farmOrComId
                        },
                        success: function(res) {
                            res = $.parseJSON(res);
                            $('#subFarm').html(res.name);
                        }
                    })
                    // });

                    // For community Farm
                    $('#subFarm').on('change', function(e) {
                        // Tag No
                        let community_id = $(this).val()
                        $.ajax({
                            url: '{{ route('get.tagNo') }}',
                            type: "get",
                            data: {
                                community_id: community_id
                            },
                            success: function(res) {
                                res = $.parseJSON(res);
                                $('#animal_info').html(res.name);
                            }
                        })
                        // tattoo No
                        $.ajax({
                            url: '{{ route('get.tattooNo') }}',
                            type: "get",
                            data: {
                                community_id: community_id
                            },
                            success: function(res) {
                                res = $.parseJSON(res);
                                $('#tattooNo').html(res.tattooNo);
                            }
                        })
                    });
                } else {
                    $('.subFarmDiv').hide();
                    // For research Farm
                    // $('#farm').on('select2:select', function () {
                    // Tag No
                    let farm_id = $(this).val().slice(0, -1)
                    $.ajax({
                        url: '{{ route('get.tagNoResearch') }}',
                        type: "get",
                        data: {
                            farm_id: farm_id
                        },
                        success: function(res) {
                            res = $.parseJSON(res);
                            $('#animal_info').html(res.name);
                        }
                    })
                    // tattoo No
                    $.ajax({
                        url: '{{ route('get.tattooNoResearch') }}',
                        type: "get",
                        data: {
                            farm_id: farm_id
                        },
                        success: function(res) {
                            res = $.parseJSON(res);
                            $('#tattooNo').html(res.tattooNo);
                        }
                    })
                    // });
                }
            })


            // $('#animal_info').on('change', function(e) {
            //     var animalInfoId = $(this).val();
            //     $.ajax({
            //         url: '{{ route('get.getAnimalInfo') }}',
            //         type: "get",
            //         data: {
            //             animalInfoId: animalInfoId
            //         },
            //         success: function(res) {
            //             res = $.parseJSON(res);
            //             $('#sex').val(res.sex);
            //             $('#animal_sl').val(res.animal_sl);
            //             $('#birth_wt').val(res.birth_wt);
            //             $('#color').val(res.color);
            //         }
            //     })
            // });
            // $('#tattooNo').on('change', function(e) {
            //     var animalInfoId = $(this).val();
            //     $.ajax({
            //         url: '{{ route('get.getAnimalInfo') }}',
            //         type: "get",
            //         data: {
            //             animalInfoId: animalInfoId
            //         },
            //         success: function(res) {
            //             res = $.parseJSON(res);
            //             $('#sex').val(res.sex);
            //             $('#animal_sl').val(res.animal_sl);
            //             $('#birth_wt').val(res.birth_wt);
            //             $('#color').val(res.color);
            //         }
            //     })
            // });
        })
    </script>
@endpush
