<script>
    let farm = $("#farm").val()
    $("form").on('submit', function(e){
            let farm = $("#farm").val()
            let animal_info = $("#animal_info").val()
            let tattooNo = $("#tattooNo").val()
            if(farm == null || farm == ""){
                Swal.fire(
                'Data Missing?',
                'Area Missing',
                'question'
                )
                return false;
            }
            if((animal_info == null || animal_info == 0) && (tattooNo == null || tattooNo == 0)){
                Swal.fire(
                'Data Missing?',
                'Tag No or Tattoo No Missing',
                'question'
                )
                return false;
            }
        });
</script>

