@extends('layout')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/login-register.css') }} ">

@section('content')
<main class="login-form" style="background-image: url('images/bg-reg.png'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
    <div class="huh">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-container">
                    {{-- <div class="card-header">Register</div> --}}
                    <div class="card-body">

                        <form action="{{ route('api.register') }}" method="POST" id="handleAjax">

                            @csrf

                            <div id="errors-list"></div>

                            <div class="input_box form-group row">
                                <label for="email_address" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-6 ">
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Name" required autofocus>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input_box form-group row">
                                <label for="email_address" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="text" id="phone_number" class="form-control" name="phone_number" placeholder="Phone Number" required
                                        autofocus>
                                    @if ($errors->has('phone_number'))
                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input_box form-group row">
                                <label for="email_address" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="text" id="address" class="form-control" name="address" placeholder="Address" required
                                        autofocus>
                                    @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input_box form-group row">
                                <label for="email_address" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" placeholder="E-mail" required
                                        autofocus>
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input_box form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="input_box form-group row">
                                <label for="confirm_password" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
                                    @if ($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="contain">
                                <button type="submit" class="login-btn ">
                                    Register
                                </button>
                            </div>

                            <div class="reg">
                                <p>
                                    Already got an account?
                                </p>

                                <p>
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </p>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(function() {

      /*------------------------------------------
      --------------------------------------------
      Submit Event
      --------------------------------------------
      --------------------------------------------*/
      $(document).on("submit", "#handleAjax", function(event) {
         event.preventDefault();
          var e = this;

          $(this).find("[type='submit']").html("Register...");

          console.log("Form submitted:", $(this).serialize());

          // Trim password fields
          $('#password').val($.trim($('#password').val()));
          $('#confirm_password').val($.trim($('#confirm_password').val()));

          $.ajax({
              url: '/api/register', // Update to API route
              data: $(this).serialize(),
              type: "POST",
              dataType: 'json',
              success: function (data) {

                $(e).find("[type='submit']").html("Register");

                if (data.status) {
                    window.location.href = data.redirect; // Redirect to the new page
                }else{

                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }

              },
              error: function (xhr) {
                console.log(xhr.responseText); // Log the error response
                $("#errors-list").append("<div class='alert alert-danger'>An error occurred. Please try again.</div>");
              }
          });

          return false;
      });

    });

</script>
@endsection