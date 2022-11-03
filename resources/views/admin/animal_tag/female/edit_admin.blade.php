<div class="form-group col-md-3">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farm"
        class="form-control select2 @error('community_cat_id') is-invalid @enderror">
        <option>Select</option>
        @foreach ($farms as $farm)
            <option value="{{ $farm->id }}f" {{ $data->farm_id == $farm->id ? 'selected' : '' }}>{{ $farm->name }}
            </option>
        @endforeach
        @foreach ($communityCats as $communityCat)
            <option value="{{ $communityCat->id }}c"
                {{ $data->community_cat_id == $communityCat->id ? 'selected' : '' }}>{{ $communityCat->name }}</option>
        @endforeach
    </select>
    @error('community_cat_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 subFarmDiv" style="display: none">
    <label for="">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control valReset"></select>
</div>

<div class="form-group col-md-3">
    <label for="name">Tag no <span class="t_r">*</span></label>
    <select name="animal_info_id" id="animal_info"
        class="form-control valReset @error('animal_info_id') is-invalid @enderror select2"></select>
    @error('animal_info_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3">
    <label for="tattoo_no">Tattoo no <span class="t_r">*</span></label>
    <select name="tattoo_no" id="tattooNo"
        class="form-control valReset @error('tattoo_no') is-invalid @enderror select2"></select>
    @error('tattoo_no')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

@push('custom_scripts')
    <script>
        $(document).ready(function() {
            var animal_info_id = $("#animal_info_id").val();
            var get_community_id = $("#get_community_id").val();
            if ($("#get_farm_id").val() == '') {
                $('.subFarmDiv').show();
                var farmOrComId = $('#farm').val()
                $.ajax({
                    url: '{{ route('get.subFarm') }}',
                    type: "get",
                    data: {
                        farmOrComId: farmOrComId,
                        get_community_id: get_community_id
                    },
                    success: function(res) {
                        res = $.parseJSON(res);
                        $('#subFarm').html(res.name);
                    }
                })

                // For community Farm
                // Tag No
                let community_id = $("#get_community_id").val()
                $.ajax({
                    url: '{{ route('get.animalF') }}',
                    type: "get",
                    data: {
                        community_id: community_id,
                        animal_info_id: animal_info_id
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
                        community_id: community_id,
                        animal_info_id: animal_info_id
                    },
                    success: function(res) {
                        res = $.parseJSON(res);
                        $('#tattooNo').html(res.tattooNo);
                    }
                })
                // });
            } else {
                $('.subFarmDiv').hide();
                // Tag No
                let farm_id = $("#get_farm_id").val();
                console.log(farm_id)
                console.log(animal_info_id)
                $.ajax({
                    url: '{{ route('get.animalF') }}',
                    type: "get",
                    data: {
                        farm_id: farm_id,
                        animal_info_id: animal_info_id
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
                        farm_id: farm_id,
                        animal_info_id: animal_info_id
                    },
                    success: function(res) {
                        res = $.parseJSON(res);
                        $('#tattooNo').html(res.tattooNo);
                    }
                })
            }
            // edit end


            $('#farm').on('change', function() {
                let farm = $(this).val().slice(-1);
                if (farm == 'c') {
                    $('.subFarmDiv').show();
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

                    // For community Farm
                    $('#subFarm').on('change', function(e) {
                        // Tag No
                        let community_id = $(this).val()
                        $.ajax({
                            url: '{{ route('get.animalF') }}',
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
                    // Tag No
                    let farm_id = $(this).val().slice(0, -1)
                    $.ajax({
                        url: '{{ route('get.animalF') }}',
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
                }
            })

            $('#animal_info').on('change', function(e) {
                var animalInfoId = $(this).val();
                $.ajax({
                    url: '{{ route('get.getAnimalInfo') }}',
                    type: "get",
                    data: {
                        animalInfoId: animalInfoId
                    },
                    success: function(res) {
                        res = $.parseJSON(res);
                        $('#sex').val(res.sex);
                        $('#animal_sl').val(res.animal_sl);
                        $('#birth_wt').val(res.birth_wt);
                        $('#color').val(res.color);
                    }
                })
            });
            $('#tattooNo').on('change', function(e) {
                var animalInfoId = $(this).val();
                $.ajax({
                    url: '{{ route('get.getAnimalInfo') }}',
                    type: "get",
                    data: {
                        animalInfoId: animalInfoId
                    },
                    success: function(res) {
                        res = $.parseJSON(res);
                        $('#sex').val(res.sex);
                        $('#animal_sl').val(res.animal_sl);
                        $('#birth_wt').val(res.birth_wt);
                        $('#color').val(res.color);
                    }
                })
            });
        })
    </script>
@endpush
