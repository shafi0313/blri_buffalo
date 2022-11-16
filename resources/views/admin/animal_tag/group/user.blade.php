<div class="form-group col-md-3 single" style="display: none">
    <label for="community_id">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm"
        class="form-control select2 singleInput @error('community_id') is-invalid @enderror">
        <option selected disabled value>Select</option>
        @foreach ($communities as $community)
            <option value="{{ $community->id }}">{{ $community->no }}-{{ $community->name }}</option>
        @endforeach
    </select>
    @error('community_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 single" style="display: none">
    <label for="name">Tag no <span class="t_r">*</span></label>
    <select name="animal_info_id" id="animal_info"
        class="form-control select2 singleInput @error('animal_info_id') is-invalid @enderror"></select>
    @error('animal_info_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3 group" style="display: none">
    <label for="community_id">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarmGroup"
        class="form-control select2 groupInput @error('community_id') is-invalid @enderror">
        <option selected disabled value>Select</option>
        @foreach ($communities as $community)
            <option value="{{ $community->id }}">{{ $community->no }}-{{ $community->name }}</option>
        @endforeach
    </select>
    @error('community_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>



@push('custom_scripts')
    <script>
        $(document).ready(function() {
            $("#single").on("click", function() {
                $(".single").show();
                $("#single_input").attr("disabled", false);
                $("#single_input").attr("required", true);
                $("#to, #from").attr("disabled", true);
                $(".group").hide();
                $(".singleInput").attr('disabled', false);
                $(".groupInput").attr('disabled', true);
            })

            $("#group").on("click", function() {
                $(".single").hide();
                $("#single_input").attr("disabled", true);
                $("#to, #from").attr("disabled", false);
                $("#to, #from").attr("required", true);
                $(".group").show();
                $(".singleInput").attr('disabled', true);
                $(".groupInput").attr('disabled', false);
                $(".total_vaccinated").show();
            })

            $('#subFarm, #subFarmGroup').on('change', function(e) {
                var community_id = $(this).val()
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
            });

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
        })
    </script>
    @include('admin.animal_tag.user_js')
@endpush
