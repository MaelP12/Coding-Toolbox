<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Account Created</title>
</head>
<body>
<p>Hello {{ $user->name }},</p>
<p>Your account has been created. Here are your credentials:</p>
<ul>
    <li><strong>Email:</strong> {{ $user->email }}</li>
    <li><strong>Password:</strong> {{ $password }}</li>
</ul>
</body>
</html>
