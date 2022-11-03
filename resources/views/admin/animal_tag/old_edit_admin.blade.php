<div class="form-group col-md-3">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farm" class="form-control select2 @error('community_cat_id') is-invalid @enderror">
        <option  disabled value>Select</option>
        @foreach ($farms as $farm)
        <option value="{{$farm->id}}f" {{$data->farm_id==$farm->id?'selected':''}}>{{$farm->name}}</option>
        @endforeach
        @foreach ($communityCats as $communityCat)
        <option value="{{$communityCat->id}}c" {{$data->community_cat_id ==$farm->id?'selected':''}}>{{$communityCat->name}}</option>
        @endforeach
    </select>
    @error('community_cat_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


{{-- <div class="form-group col-md-3">
    <label for="">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control"></select>
</div> --}}

<div class="form-group col-md-3">
    <label for="name">Tag no <span class="t_r">*</span></label>
    <select name="animal_info_id" id="animal_info" class="form-control @error('animal_info_id') is-invalid @enderror">

    </select>
    @error('animal_info_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3">
    <label for="tattoo_no">Tattoo no <span class="t_r">*</span></label>
    <select name="tattoo_no" id="tattooNo" class="form-control @error('tattoo_no') is-invalid @enderror select2"></select>
    @error('tattoo_no')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


@push('custom_scripts')
<script>
    if($("#farm").val()!=''){
        var farmOrComId = $("#farm").val()
        var farm_id = $("#get_farm_id").val()
        var community_cat_id = $("#get_community_cat_id").val()
        $.ajax({
            url:'{{ route("get.subFarm") }}',
            type:"get",
            data: {
                farmOrComId: farmOrComId,
                farm_id: farm_id,
                community_cat_id : community_cat_id,
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#subFarm').html(res.name);
            }
        })
    };


    var community_id = $('#get_community_id').val()
    var animal_info_id = $('#animal_info_id').val()
    $.ajax({
        url:'{{ route("get.tagNo") }}',
        type:"get",
        data: {
            community_id: community_id,
            animal_info_id: animal_info_id
            },
        success:function (res) {
            res = $.parseJSON(res);
            $('#animal_info').html(res.name);
        }
    })

</script>
@endpush
