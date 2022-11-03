<style>
    .select2 {
    width: 100% !important;
}
</style>
<div class="form-group col-md-6">
    <label for="community_cat_id">Area <span class="t_r">*</span></label>
    <select name="farmOrCommunityId" id="farm" class="form-control @error('community_cat_id') is-invalid @enderror select2">
        <option selected >Select</option>
        @foreach ($farms as $farm)
        <option value="{{$farm->id}}f">{{$farm->name}}</option>
        @endforeach
        @foreach ($communityCats as $communityCat)
        <option value="{{$communityCat->id}}c">{{$communityCat->name}}</option>
        @endforeach
    </select>
    @error('community_cat_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
@push('custom_scripts')
@endpush
