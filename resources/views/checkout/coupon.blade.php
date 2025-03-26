<script type="text/javascript">
    $( document ).ready(function() {
       $('#coupon-processing').hide();
       $('#coupon-remove').hide();
        $("#submit-coupon").submit(function(stay){
            confirm('Are you sure you want to apply this coupon? This process cannot be undone')
            stay.preventDefault()
            var formdata = $(this).serialize();
            $('#coupon-processing').show();
            $.ajax({
                type: "POST",
                url: '{{url('/')}}/shopping-cart/checkout/process-coupon',
                data: formdata,
             
                success: function(message) {
                    $('#coupon-processing').html("");
                    if(message == 'The coupon code is invalid'){
                        $('#coupon-processing').append("<span style='color:#ff0e0e'>" + message + "</span>");
                        alert(message)
                    }else if(message == 'The coupon has been applied'){
                        $('#coupon-remove').show();
                        $('#coupon-processing').append("<span style='color:#42ba96'>" + message + "</span>");
                    }else{
                        $('#coupon-processing').append("<span style='color:#ff0e0e'>" + message + "</span>");
                        alert(message)
                    }
                    location.reload();
                   
                }
            });
        });
    });
  </script>

<script type="text/javascript">
    $( document ).ready(function() {
 
        $("#remove-coupon").click(function(stay){
            confirm('Are you sure you want to apply this coupon? This process cannot be undone')
            stay.preventDefault()
      
            $('#coupon-processing').show();
            $.ajax({
                type: "GET",
                url: '{{url('/')}}/shopping-cart/checkout/remove-coupon/{{Session::get('coupon-code')}}',
             
             
                success: function(message) {
                    $('#coupon-processing').html("");
                    
                    location.reload();
                   
                }
            });
        });
    });
  </script>