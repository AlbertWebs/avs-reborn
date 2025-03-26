<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>{{ config('app.name', 'Laravel') }} | Scheduled Maintenance</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('admins_theme/assets/plugins/Font-Awesome/css/font-awesome.css')}}" />
    <!--END GLOBAL STYLES -->

     <!-- PAGE LEVEL STYLES -->
        <link rel="stylesheet" href="{{asset('admins_theme/assets/css/countdown.css')}}" />
     <!-- END PAGE LEVEL STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ccd55492846b90c57acd37d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
<body >
      <!--MAIN CONTAINER --> 
    <div id="main"> 
        <!-- PAGE CONTENT --> 
      <div class="container">
       
        <div class="clearfix">
         
        </div>
        <div id="counter"></div>

        <div id="counter-default" class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="inner">
                    <div id="day-number" class="timer-number"></div>
                    <div class="timer-text">DAYS</div>
                    <div class="progress mini progress-striped active">
                        <div id="day-bar" class="progress-bar progress-bar-primary"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="inner">
                    <div id="hour-number" class="timer-number"></div>
                    <div class="timer-text">HOURS</div>
                    <div class="progress mini progress-striped active">
                        <div id="hour-bar" class="progress-bar progress-bar-primary"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="inner">
                    <div id="minute-number" class="timer-number"></div>
                    <div class="timer-text">MINUTES</div>
                    <div class="progress mini progress-striped active">
                        <div id="minute-bar" class="progress-bar progress-bar-primary"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="inner">
                    <div id="second-number" class="timer-number"></div>
                    <div class="timer-text">SECOND</div>

                    <div class="progress mini progress-striped active">
                        <div id="second-bar" class="progress-bar progress-bar-primary"></div>
                    </div>

                </div>
            </div>
        </div>
           <div class="col-lg-12 title">
            <h2 >Our Site Is <span class="">U</span>nder <span class="">M</span>aintenance</h2>
           We are down for Scheduled maintenance
          </div>
          <br /><br />
        <div class="row">
          <div class="col-lg-12">
            <div class="progress progress-striped active" rel="tooltip" data-placement="bottom"
                 data-original-title="Total Progress">
              <div id="total-bar" class="progress-bar progress-bar-primary"></div>
            </div>
          </div>
        </div>
        <hr/>
        <div class="row">
          
          <div class="col-lg-12 contact">
          {{ config('app.name', 'Laravel') }}
          </div>
        </div>
        
      </div>
          <!--END PAGE CONTENT --> 
    </div>
     <!--END MAIN CONTAINER --> 
	      

     <!-- GLOBAL SCRIPTS -->
    <script src="{{asset('admins_theme/assets/plugins/jquery-2.0.3.min.js')}}"></script>
    <!-- END GLOBAL SCRIPTS -->

	       <!-- PAGE LEVEL SCRIPTS --> 
      <script src="{{asset('admins_theme/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
          <script type="text/javascript" src="{{asset('admins_theme/assets/plugins/countdown/jquery.countdown.min.js')}}"></script>
            
    <script type="text/javascript" src="{{asset('admins_theme/assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('admins_theme/assets/js/countdown.js')}}"></script>
     <!-- END PAGE LEVEL SCRIPTS --> 


</body>
    <!-- END BODY -->
</html>
