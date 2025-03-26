<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>{{$page_name}} | {{ config('app.name', 'Laravel') }}</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="Nekta CMS" />
    <meta content="" name="Designekta Studios" />
    <link rel="shortcut icon" href="{{asset('uploads/logo/favicon.png')}}" type="image/x-icon"/>
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/MoneAdmin.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/Font-Awesome/css/font-awesome.css')}}" />
    <link href="{{asset('admins_theme/assets/css/layout2.css')}}" rel="stylesheet" />
    <!--END GLOBAL STYLES -->
    @if($page_title=='Admin Home')
    <!-- PAGE LEVEL STYLES -->
    <link href="{{asset('admins_theme/assets/css/layout2.css')}}" rel="stylesheet" />
    <link href="{{asset('admins_theme/assets/plugins/flot/examples/examples.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/timeline/timeline.css')}}" />
    <!-- END PAGE LEVEL  STYLES -->
    @endif

    @if($page_title=='list')
    <link href="{{asset('admins_theme/assets/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
    @endif

    @if($page_title=='form')
    <!-- PAGE LEVEL STYLES -->
        
    <link href="{{asset('admins_theme/assets/css/jquery-ui.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/uniform/themes/default/css/uniform.default.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/chosen/chosen.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/colorpicker/css/colorpicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/tagsinput/jquery.tagsinput.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/datepicker/css/datepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/timepicker/css/bootstrap-timepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/switch/static/stylesheets/bootstrap-switch.css')}}" />
   
    <!-- END PAGE LEVEL  STYLES -->
    @endif

    @if($page_title=='formfile')
    <!-- PAGE LEVEL STYLES -->
        
    <link href="{{asset('admins_theme/assets/css/jquery-ui.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/uniform/themes/default/css/uniform.default.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/chosen/chosen.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/colorpicker/css/colorpicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/tagsinput/jquery.tagsinput.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/datepicker/css/datepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/timepicker/css/bootstrap-timepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/switch/static/stylesheets/bootstrap-switch.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/bootstrap-fileupload.min.css')}}" />
    <!-- END PAGE LEVEL  STYLES -->
    @endif

    @if($page_title=='formfiletext')
    <!-- PAGE LEVEL STYLES -->
        
    <link href="{{asset('admins_theme/assets/css/jquery-ui.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/uniform/themes/default/css/uniform.default.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/chosen/chosen.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/colorpicker/css/colorpicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/tagsinput/jquery.tagsinput.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/daterangepicker/daterangepicker-bs3.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/datepicker/css/datepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/timepicker/css/bootstrap-timepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/switch/static/stylesheets/bootstrap-switch.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/bootstrap-fileupload.min.css')}}" />
     <!-- PAGE LEVEL STYLES -->
     <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/Font-Awesome/css/font-awesome.css')}}" />
     <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/wysihtml5/dist/bootstrap-wysihtml5-0.0.2.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/Markdown.Editor.hack.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/CLEditor1_4_3/jquery.cleditor.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/jquery.cleditor-hack.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/css/bootstrap-wysihtml5-hack.css')}}" />
     <style>
                        ul.wysihtml5-toolbar > li {
                            position: relative;
                        }
                    </style>
    <!-- END PAGE LEVEL  STYLES -->
    <!-- END PAGE LEVEL  STYLES -->
    @endif
    @if($page_title=='Error')
    <link rel="stylesheet" href="{{asset('admins_theme/assets/assets/css/error.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/assets/plugins/magic/magic.css')}}" />   
    @endif

    @if($page_title=='Gallery')
    <link href="{{asset('admins_theme/assets/plugins/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css')}}" rel="stylesheet" />
      <style>
        .panel-body a img {
            margin-bottom:5px !important;

        }
          .panel-body a{
              color:transparent!important;
          }
    </style>
    @endif

    @if($page_title=='Wizard')
    <!-- PAGE LEVEL STYLES -->
    <link href="{{asset('admins_theme/assets/plugins/jquery-steps-master/demo/css/normalize.css')}}" rel="stylesheet" />
    <link href="{{asset('admins_theme/assets/plugins/jquery-steps-master/demo/css/wizardMain.css')}}" rel="stylesheet" />
    <link href="{{asset('admins_theme/assets/plugins/jquery-steps-master/demo/css/jquery.steps.css')}}" rel="stylesheet" />    
    <!-- END PAGE LEVEL  STYLES -->
    @endif

     @if($page_title=='pricing')
  
     @endif
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body class="padTop53 " >

    <!-- MAIN WRAPPER -->
   
    <!-- Contents -->
    @yield('content')
    <!-- Contents Ends Here -->

    <!--END MAIN WRAPPER -->

     <!-- FOOTER -->
     <div id="footer">
        <p>&copy;  <a title="Nekta CMS is an Open Source Content management System intended for websites and web based applications" href="http://www.designekta.com">Designekta Studios</a> &nbsp;<?php $time=date('Y'); echo $time; ?> &nbsp; | <a href="{{url('admin/version')}}">Version Control Info</a></p>
    </div>
    <!--END FOOTER -->


    <!-- GLOBAL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/jquery-2.0.3.min.js')}}"></script>
     <script src="{{asset('admins_theme/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
    <!-- END GLOBAL SCRIPTS -->
    @if($page_title=='Admin Home')
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/flot/jquery.flot.time.js')}}"></script>
     <script  src="{{asset('admins_theme/assets/plugins/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('admins_theme/assets/js/for_index.js')}}"></script>
    @endif
    <!-- END PAGE LEVEL SCRIPTS -->

    @if($page_title=='list')
   <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
     <!-- END PAGE LEVEL SCRIPTS -->
    @endif

    @if($page_title=='form')
    <!-- PAGE LEVEL SCRIPT-->
    <script src="{{asset('admins_theme/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/uniform/jquery.uniform.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/chosen/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/colorpicker/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/validVal/js/jquery.validVal.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/switch/static/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/autosize/jquery.autosize.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jasny/js/bootstrap-inputmask.js')}}"></script>
       <script src="{{asset('admins_theme/assets/js/formsInit.js')}}"></script>
        <script>
            $(function () { formInit(); });
        </script>
        
     <!--END PAGE LEVEL SCRIPT-->
    @endif

     @if($page_title=='formfile')
    <!-- PAGE LEVEL SCRIPT-->
    <script src="{{asset('admins_theme/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/uniform/jquery.uniform.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/chosen/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/colorpicker/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/validVal/js/jquery.validVal.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/switch/static/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/autosize/jquery.autosize.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jasny/js/bootstrap-inputmask.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jasny/js/bootstrap-fileupload.js')}}"></script>   
    <script src="{{asset('admins_theme/assets/js/formsInit.js')}}"></script>
        <script>
            $(function () { formInit(); });
        </script>
        
     <!--END PAGE LEVEL SCRIPT-->
    @endif

     @if($page_title=='formfiletext')
    <!-- PAGE LEVEL SCRIPT-->
    <script src="{{asset('admins_theme/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/uniform/jquery.uniform.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/chosen/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/colorpicker/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/validVal/js/jquery.validVal.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/switch/static/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/autosize/jquery.autosize.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jasny/js/bootstrap-inputmask.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jasny/js/bootstrap-fileupload.js')}}"></script>   
    <script src="{{asset('admins_theme/assets/js/formsInit.js')}}"></script>
        <script>
            $(function () { formInit(); });
        </script>
        
     <!--END PAGE LEVEL SCRIPT-->
      <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/wysihtml5/lib/js/wysihtml5-0.3.0.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/bootstrap-wysihtml5-hack.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/CLEditor1_4_3/jquery.cleditor.min.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/pagedown/Markdown.Converter.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/pagedown/Markdown.Sanitizer.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/Markdown.Editor-hack.js')}}"></script>
    <script src="{{asset('admins_theme/assets/js/editorInit.js')}}"></script>
    <script>
        $(function () { formWysiwyg(); });
        </script>

     <!--END PAGE LEVEL SCRIPTS -->
    @endif

    @if($page_title=='Gallery')
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/jquery.fancybox-1.3.4/jquery-1.4.3.min.js')}}"></script> <!--important for gallery-->
    <script src="{{asset('admins_theme/assets/plugins/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js')}}"></script> 
    <script src="{{asset('admins_theme/assets/plugins/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js')}}"></script>
    <script src="{{asset('admins_theme/assets/js/image_gallery.js')}}"></script>
    
	
     <!--END PAGE LEVEL SCRIPTS -->
    @endif
    
    @if($page_title=="Wizard")
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/jquery-steps-master/lib/jquery.cookie-1.3.1.js')}}"></script>
    <script src="{{asset('admins_theme/assets/plugins/jquery-steps-master/build/jquery.steps.js')}}"></script>   
    <script src="{{asset('admins_theme/assets/js/WizardInit.js')}}"></script>
         <!--END PAGE LEVEL SCRIPTS -->
    @endif

    @if($page_title=='Maps')
<!-- PAGE LEVEL SCRIPTS-->

     <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    
    <script src="{{asset('admins_theme/assets/plugins/gmaps/gmaps.js')}}"></script>
    <script src="{{asset('admins_theme/assets/js/mapsInit.js')}}"></script>
    <script>
        $(function () { MapsInit(); });
    </script>
    
 <!--END PAGE LEVEL SCRIPTS-->
    @endif

<!-- Ajax Paymant APIS --> 
<!-- Check Balance -->
<?php 
    $accountBallance = "https://amanivehiclesounds.co.ke/mpesa/accoutbalance.php";
?>
<?php $AccountBalanceTable = DB::table('accountbalance')->OrderBy('accountBalID','DESC')->first(); ?>

<script>
    $('#balanceBtn').on('click', function (e) {
        $('#balanceBtn').html('Sending Request.............')
    
        e.preventDefault();

        $.ajax({
            type: 'get',
            url: '{{url('/')}}/payments/balance/{{$AccountBalanceTable->accountBalID}}',
            data: $('#balance').serialize(),
            success: function (results) {
                alert(results)
                $('#balanceBtn').html('My MPESA Balance')
                location.reload(true);
            }
        });

    });
</script>

<!-- Balance -->
<?php $Reverse = DB::table('reverse_transaction')->OrderBy('transactionstatusID','DESC')->first(); ?>
<!-- reverse -->
<script>
    $('#Reverse').on('submit', function (e) {
        $('#ReverseBtn').html('Processing.............')
    
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '{{url('/')}}/payments/reverse',
            data: $('#Reverse').serialize(),
            success: function (results) {
                alert(results)
                $('#ReverseBtn').html('Proccessed')
                location.reload(true);
            }
        });

    });
</script>
<!-- Reverese -->
<?php $B2B = DB::table('b2b_api_response')->OrderBy('b2bTransactionID','DESC')->first(); ?>
<!-- B2B -->
<script>
    $('#merchant').on('submit', function (e) {
        $('#merchantBtn').html('Processing.............')
    
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '{{url('/')}}/payments/B2B/{{$B2B->b2bTransactionID}}',
            data: $('#merchant').serialize(),
            success: function (results) {
                alert(results)
                $('#merchantBtn').html('Send')
                // Reload
                location.reload(true);
                
            }
        });

    });
</script>
<!-- B2B -->
<?php $TransStatus = DB::table('transaction_status')->OrderBy('transactionStatusID','DESC')->first(); ?>
<!-- Transaction Stutus -->
<script>
    $('#status').on('submit', function (e) {
        $('#statusbtn').html('Checking.............')
    
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '{{url('/')}}/payments/transStatus/{{$TransStatus->transactionStatusID}}',
            data: $('#status').serialize(),
            success: function (results) {
                alert(results)
                
                $('#statusbtn').html('Send')
                location.reload(true);
            }
        });

    });
</script>
<!-- Transaction Stutus -->
<?php $B2C = DB::table('b2c_api_response')->OrderBy('b2bID','DESC')->first(); ?>
<!-- b2c -->
<script>
    $('#b2c').on('submit', function (e) {
        $('#b2cBtn').html('Processing.............')
    
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '{{url('/')}}/payments/B2C/{{$B2C->b2bID}}',
            data: $('#b2c').serialize(),
            success: function (results) {
                alert(results)
                $('#b2cBtn').html('Send')
                location.reload(true);
            }
        });

    });
</script>
<!-- b2c -->

<script>
$('#TransID').change(function(){
    var id = $(this).val();
    var url = '{{ route("getDetails", ":id") }}';
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response){
            if(response != null){
                $('#AmountQ').val(response.TransAmount);
            }
        }
    });
});
</script>

<?php $Service = DB::table('product')->get(); ?>
@foreach($Service as $value)
<!-- Modal links  -->
<div class="col-lg-12">
                        <div class="modal fade" id="buttonedModal_{{$value->id}}" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H1">{{$value->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <input style="width:100%" type="url" value="{{url('/product')}}/{{$value->slung}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
<!-- </Modal Links -->
@endforeach

<!-- </Ajax Payment API -->
</body>

    <!-- END BODY -->
</html>
