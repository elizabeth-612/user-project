<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
     body {
        background-color: #F3EBF6;
        font-family: 'Ubuntu', sans-serif;
    }
    
    .main {
        background-color: #FFFFFF;
        width: 620px;
        height: 800px;
        margin: 7em auto;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }
    
    .sign {
        padding-top: 40px;
        color: #8C55AA;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 23px;
    }
    
    .un {
    width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
    form.form1 {
        padding-top: 40px;
    }
    
    .pass {
            width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
   
    .un:focus, .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;
        
    }
    
    .submit {
      cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9C27B0, #E040FB);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 35%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    }
    
    
    
    a {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        text-decoration: none
    }

    .no-print {
    
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
    @media (max-width: 600px) {
        .main {
            border-radius: 0px;
        }
</style>




<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registration</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center">User Registration</p>
    <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                               

                               <input id="name" type="text" class="un" name="name" value="{{ old('name') }}" required placeholder="Name">

                               <input id="phone" type="text" class="un telnumber" name="phone" maxlength="12" value="{{ old('phone') }}" required placeholder="Phone">

                                <input id="email" type="email" class="un" name="email" value="{{ old('email') }}" required placeholder="Email" onblur="duplicateEmail(this)">

                                <input id="password" type="password" class="pass" name="password" required placeholder="Password" value="{{ old('password') }}">

                                 <input id="confirmpassword" type="password" class="pass" name="password_confirmation" required placeholder="Confirm Password">
                                
                                <input type="file" class="un gui-file" name="image" id="image" accept="image/*" required="" />
                                <img src="" class="un" style="max-width:100px;" id="image_preview" />

                                <div class="row no-print">
                                <div class="col-md-12 mb-3 mt-1">
                                  <div class="captcha">
                                    <div class="g-recaptcha" data-sitekey="{{ RECAPTCHA_SITE_KEY }}"></div>
                                  </div>
                                </div>

                              </div>
                          
                       

                       <button type="submit" class="submit">Register</button>
                 
                    </form>
    
                
    </div>
     
</body>

</html>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"  rel="stylesheet">

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
    $(document).on("keyup", ".telnumber", function() {
    foo = $(this).val().split("-").join(""); // remove hyphens

        foo = foo.match(new RegExp('.{1,4}$|.{1,3}', 'g')).join("-");

        $(this).val(foo);


});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

    function duplicateEmail(element){
        var email = $(element).val();

        $.ajax({
            type: "POST",
            url: '{{route('checkemail')}}',
              data: {
                      email: email,
                      _token: '{!! csrf_token() !!}'
                    },

           
            // dataType: "json",
            success: function(res) {
                if(res.exists){
                 
                    displayFailMsg('Email already exists.');
                }
            },
            error: function (jqXHR, exception) {

            }
        });
    }
    function displayFailMsg(msg) {
            // Create new Notification
            toastr.clear();
                toastr.options = {
                  "closeButton": "true",
                  "progressBar": "false",
                  "debug": "false",
                  "positionClass": "toast-top-right",
                  "showDuration": "330",
                  "hideDuration": "330",
                  "timeOut":  "10000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "swing",
                  "showMethod": "slideDown",
                  "hideMethod": "slideUp",
                  "onclick": null
                }
            toastr.error(msg,'Error');
        }
     @if (Session::has('success'))
            // Create new Notification
            toastr.clear();
                toastr.options = {
                  "closeButton": "true",
                  "progressBar": "false",
                  "debug": "false",
                  "positionClass": "toast-top-right",
                  "showDuration": "330",
                  "hideDuration": "330",
                  "timeOut":  "10000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "swing",
                  "showMethod": "slideDown",
                  "hideMethod": "slideUp",
                  "onclick": null
                }
            toastr.success("{{Session::get('success')}}",'Success');
        @endif

        // Notification if the process was a failure
        @if (Session::has('fail'))
            // Create new Notification
            toastr.clear();
                toastr.options = {
                  "closeButton": "true",
                  "progressBar": "false",
                  "debug": "false",
                  "positionClass": "toast-top-right",
                  "showDuration": "330",
                  "hideDuration": "330",
                  "timeOut":  "10000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "swing",
                  "showMethod": "slideDown",
                  "hideMethod": "slideUp",
                  "onclick": null
                }
            toastr.error("{{Session::get('fail')}}",'Error');
        @endif
        @if (Session::has('error'))
            // Create new Notification
            toastr.clear();
                toastr.options = {
                  "closeButton": "true",
                  "progressBar": "false",
                  "debug": "false",
                  "positionClass": "toast-top-right",
                  "showDuration": "330",
                  "hideDuration": "330",
                  "timeOut":  "10000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "swing",
                  "showMethod": "slideDown",
                  "hideMethod": "slideUp",
                  "onclick": null
                }
            toastr.error("{{Session::get('error')}}",'Error');
        @endif

        // Notification if the process was a failure due to data posted
        @if ($errors->any())
            // Create new Notification
            toastr.clear();
                toastr.options = {
                  "closeButton": "true",
                  "progressBar": "false",
                  "debug": "false",
                  "positionClass": "toast-top-right",
                  "showDuration": "330",
                  "hideDuration": "330",
                  "timeOut":  "10000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "swing",
                  "showMethod": "slideDown",
                  "hideMethod": "slideUp",
                  "onclick": null
                }
            toastr.error("{!! implode('',$errors->all('<li>:message</li>')); !!}",'Error');
        @endif
    </script>


                    
      

