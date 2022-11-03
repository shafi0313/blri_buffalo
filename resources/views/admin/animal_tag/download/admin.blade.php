<div class="form-group col-md-3">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farm" class="form-control @error('community_cat_id') is-invalid @enderror">
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

<div class="form-group col-md-3">
    <label for="">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control"></select>
</div>




@push('custom_scripts')
    <script>
        $('#farm').on('change', function(e) {
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
        });

        $('#subFarm').on('change', function(e) {
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
    </script>
@endpush
