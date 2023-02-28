<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Elite Admin - is a responsive admin template</title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/default.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19175540-9', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      @if(session('success'))
      <div class="alert alert-success">
            {{  session('success')}}
             </div>
      @endif

      <form class="form-horizontal form-material"  name="form" id="loginform" method="post" action="{{ Route('register.custom')}}">
        <h3 class="box-title m-b-20">Sign In</h3>

        <div class="mt-2">
          @include('layouts.partial.messages')
      </div>
        <div class="form-group ">
                
          @csrf
           
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="name" placeholder="Name">
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif


          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="email" placeholder="Email">
            @if ($errors->has('email'))
               <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="password" required="" name="password" placeholder="Password">
          @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" required="" name="confirm_password" placeholder="Confirm Password">
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary p-t-0">
              <input id="checkbox-signup" type="checkbox" name="agree">
              <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
            </div>
          </div>
        </div>
      


        <div class="form-group text-center m-t-20">
        
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>        
        </div>
        {{-- @endif     @if (session('success')) --}}



        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Sign In</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
 
 <script>


  $('#loginform').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                    
                },
                confirm_password: {
                    required: true,
                    equalTo:'[name="password"]',
                },
            },
            messages: {
              name: {
                    required: "Please Enter Name",
                },
                email: {
                    
                    email: "Please enter valid email id"
                },
                password: {
                    required:"Please enter password",
                    minlength: " Your password must have at least six characters"
                },
                confirm_password: {
                    required: "Confirm password is required",
                    equalTo: "password is not same"
                },
            },
        })
 </script>

<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" > 

</script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
