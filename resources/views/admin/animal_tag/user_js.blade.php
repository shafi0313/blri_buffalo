<script>
    $("form").on('submit', function(e) {
        let community_id = $("#subFarm").val()
        let animal_info = $("#animal_info").val()
        let tattooNo = $("#tattooNo").val()
        if (community_id == null || community_id == "") {
            Swal.fire(
                'Data Missing?',
                'Farm ID Missing',
                'question'
            )
            return false;
        }
        if ((animal_info == null || animal_info == 0) && (tattooNo == null || tattooNo == 0)) {
            Swal.fire(
                'Data Missing?',
                'Tag no or Tattoo no',
                'question'
            )
            return false;
        }
    });
</script>
