<div class="form-group col-md-3">
    <label for="community_id">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control @error('community_id') is-invalid @enderror">
        <option selected disabled value>Select</option>
        @foreach ($communities as $community)
        <option value="{{$community->id}}">{{$community->no}}-{{$community->name}}</option>
        @endforeach
    </select>
    @error('community_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

@push('custom_scripts')
<script>
$('#subFarm').on('change',function(e) {
        var community_id = $(this).val()
        $.ajax({
            url:'{{ route("get.tagNo") }}',
            type:"get",
            data: {
                community_id: community_id
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#animal_info').html(res.name);
            }
        })
    });

    $('#animal_info').on('change',function(e) {
        var animalInfoId = $(this).val();
        $.ajax({
            url:'{{ route("get.getAnimalInfo") }}',
            type:"get",
            data: {
                animalInfoId: animalInfoId
                },
            success:function (res) {
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
