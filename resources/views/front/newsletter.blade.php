

<script>
    $( document ).ready(function() {
        $('.loading-imagers').hide();
    });
    $("#newsletter-popup").submit(function(stay){
        stay.preventDefault()
        //var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
        $('.loading-imagers').show();
    
        var formdata = $(this).serialize();
        $.ajax({
            async: false,
        type: 'POST',
        url: "{{url('/')}}/newsletter",
        data: formdata, // here $(this) refers to the ajax object not form
        success: function (results) {
    
            $('#newsletter-span').html('Successful!')
           
            setTimeout(function() {
                // Redirect
                $('.mfp-close').trigger('click');
            }, 1000);
            },
            timeout: 1000 
        });
});
</script>

<script>
   
    $("#newsletter-ctc").submit(function(stay){
        stay.preventDefault()
        //var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
        $('.loading-imagers').show();
    
        var formdata = $(this).serialize();
        $.ajax({
            async: false,
        type: 'POST',
        url: "{{url('/')}}/newsletter",
        data: formdata, // here $(this) refers to the ajax object not form
        success: function (results) {
          
            $('#newsletter-span').html('Successful!')
          
            
            setTimeout(function() {
                // Redirect
                $('.loading-imagers').hide();
            }, 1000);
            },
            timeout: 1000 
        });
});
</script>

<script>
    $(document).ready(function () {
        var ckbox = $('#register-policy-2');
        var formdata = "Checked=yes"
        $('#register-policy-2').on('click',function (stay) {
            stay.preventDefault()
            if (ckbox.is(':checked')) {
                $.ajax({
                    type: 'GET',
                    url: "{{url('/')}}/do-not",
                    data: formdata, // here $(this) refers to the ajax object not form
                    success: function(results) {
                        $('.mfp-close').trigger('click');
                    }
                });
            } 
        });
    });
  
</script>



