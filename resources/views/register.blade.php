<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/login_register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <style>
    .form .register-form {
      display: block;
    }
  </style>
<div class="login-page">
  @include('shared.error')
  <div class="form">
    <form class="register-form" action="/register" method="post">
      <input type="text" placeholder="name" name="user_name"/>
      <input type="text" placeholder="login name" name="login_name"/>
      <input type="password" placeholder="password" name="password"/>
      <input type="text" placeholder="email address" name="user_mail"/>
      <input type="text" placeholder="phone number" name="user_phone"/>
      <button>create</button>
      <p class="message">Already registered? <a href="/login">Sign In</a></p>
      @csrf
    </form>
  </div>
</div>
</body>
</html>