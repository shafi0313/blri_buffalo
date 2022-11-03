<div class="form-group col-md-3">
    <label for="community_id">Farm Id <span class="t_r">*</span></label>
    <select name="community_id" id="subFarm" class="form-control @error('community_id') is-invalid @enderror">
        <option disabled value>Select</option>
        @foreach ($communities as $community)
            <option value="{{ $community->id }}" {{ $data->community_id == $community->id ? 'selected' : '' }}>
                {{ $community->no }}-{{ $community->name }}</option>
        @endforeach
    </select>
    @error('community_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group col-md-3">
    <label for="name">Tag no <span class="t_r">*</span></label>
    <select name="animal_info_id" id="animal_info"
        class="form-control @error('animal_info_id') is-invalid @enderror"></select>
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
            // for updates
            var community_id = $("#get_community_id").val()
            var animal_info_id = $('#animal_info_id').val()
            $.ajax({
                url: '{{ route('get.tagNo') }}',
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

            // For create
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
        })
    </script>
@endpush
