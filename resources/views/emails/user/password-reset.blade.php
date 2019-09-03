<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
</head>
<body>
    <p>
        You are receiving this email because we received a password reset request for your account.
    </p>
    <p>
        <a href={{route('password.reset', [$token])}}> Reset Password</a>
    </p>
    <p>
        If you did not request a password reset, no further action is required.
    </p>
    <p>
        Regards,
    </p>
    <p>
        Your friends at Eolh.
    </p>
</body>
</html>