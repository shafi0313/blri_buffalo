<div class="form-group col-md-3 single" style="display: none">
    <input type="hidden" class="single">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farm"
        class="form-control select2 @error('community_cat_id') is-invalid @enderror singleInput">
        <option selected disabled value>Select</option>
        @foreach ($farms as $farm)
            <option value="{{ $farm->id }}f">{{ $farm->name }}</option>
        @endforeach
        @foreach ($communityCats as $communityCat)
            <option value="{{ $communityCat->id }}c">{{ $communityCat->name }}</option>
        @endforeach
    </select>
    @error('community_cat_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


<div class="form-group col-md-3 group" style="display: none">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farmGroup"
        class="form-control select2 @error('community_cat_id') is-invalid @enderror groupInput">
        <option selected disabled value>Select</option>
        @foreach ($farms as $farm)
            <option value="{{ $farm->id }}f">{{ $farm->name }}</option>
        @endforeach
        @foreach ($communityCats as $communityCat)
            <option value="{{ $communityCat->id }}c">{{ $communityCat->name }}</option>
        @endforeach
    </select>
    @error('community_cat_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 subFarmDiv" style="display: none">
    <label for="">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control valReset select2"></select>
</div>


<div class="form-group col-md-3 single" style="display: none">
    <label for="name">Tag no <span class="t_r">*</span></label>
    <select name="animal_info_id" id="animal_info"
        class="form-control valReset @error('animal_info_id') is-invalid @enderror select2 singleInput"></select>
    @error('animal_info_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 single" style="display: none">
    <label for="tattoo_no">Tattoo no <span class="t_r">*</span></label>
    <select name="tattoo_no" id="tattooNo"
        class="form-control valReset @error('tattoo_no') is-invalid @enderror select2 singleInput"></select>
    @error('tattoo_no')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

@push('custom_scripts')
    <script>
        $(document).ready(function() {
            let vac_type = $('input[name="vac_type"]:checked').val();
            $("#single").on("click", function() {
                $(".single").show();
                $("#to, #from").attr("disabled", true);
                $(".group").hide();
                $(".singleInput").attr('disabled', false);
                $(".groupInput").attr('disabled', true);
                let farm = $("#farm").val()
                $("form").on('submit', function(e) {
                    let animal_info = $("#animal_info").val()
                    let tattooNo = $("#tattooNo").val()
                    if (vac_type == 'single') {
                        alert(single)
                        if (farm == null || farm == "") {
                            Swal.fire(
                                'Data Missing?',
                                'Area Missing',
                                'question'
                            )
                            return false;
                        }
                        if ((animal_info == null || animal_info == 0) && (tattooNo == null ||
                                tattooNo == 0)) {
                            Swal.fire(
                                'Data Missing?',
                                'Tag No or Tattoo No Missing',
                                'question'
                            )
                            return false;
                        }
                    }

                });
            })

            $("#group").on("click", function() {
                $(".single").hide();
                $("#to, #from").attr("disabled", false);
                $("#to, #from").attr("required", true);
                $(".group").show();
                $(".singleInput").attr('disabled', true);
                $(".groupInput").attr('disabled', false);
                $(".total_vaccinated").show();
                $("form").on('submit', function(e) {
                    let farm = $("#farmGroup").val()
                    let animal_info = $("#animal_info").val()
                    let tattooNo = $("#tattooNo").val()
                    if (vac_type == 'group' && (farm == null || farm == "")) {
                        alert(farm)
                        Swal.fire(
                            'Data Missing?',
                            'Area Missing',
                            'question'
                        )
                        return false;
                    }
                });
            })

            $('#farm, #farmGroup').on('change', function() {
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
                }
            })
        })
    </script>
@endpush
