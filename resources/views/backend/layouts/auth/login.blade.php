@include('backend.partials.head')
<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left"> <img class="img-fluid" src="assets/img/logo.png" alt="Logo"> </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        <p class="account-subtitle">Access to our dashboard</p>
                        @include('backend.layouts.errors.errormessage')
                        <form action="{{ route('doLogin') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" placeholder="Email"> </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password"> </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                            </div>
                        </form>
                        <div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a> </div>
                        <div class="login-or"> <span class="or-line"></span> <span class="span-or">or</span> </div>
                        <div class="social-login"> <span>Login with</span> <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a> </div>
                        <div class="text-center dont-have">Don’t have an account? <a href="register.html">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.partials.script')
