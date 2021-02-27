<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form-v5 by Colorlib</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/register/css/roboto-font.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/register/fonts/font-awesome-5/css/fontawesome-all.min.css')}}">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="{{asset('assets/register/css/style.css')}}"/>
</head>
<body class="form-v5">
	<div class="page-content">
		<div class="form-v5-content">
			<form class="form-detail" action="{{route('register')}}" method="post">
                @csrf
				<h2>Register Account Form</h2>
				<div class="form-row">
					<label for="full-name">Full Name</label>
					<input type="text" name="name" id="name" class="input-text @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="your-email">Your Email</label>
					<input type="email" name="email" id="email" class="input-text @error('email') is-invalid @enderror">
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					<i class="fas fa-envelope"></i>
				</div>
                    <div class="form-row">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="input-text @error('password') is-invalid @enderror">
                        @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="form-row">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password" class="input-text">
                        <i class="fas fa-lock"></i>
                    </div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Register">
				</div>
			</form>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>