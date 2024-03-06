<!DOCTYPE html>
<html>
<head>
    <title>Test Email</title>
</head>
<body>
    <h1>Ceci est un test d'email</h1>
    <p>Bienvenue dans Laravel {{ $activationLink->user->name  }}!</p>
    <a href="{{env('APP_URL')}}/activate/{{$activationLink->token}}">Confirmer mon Email</p>
</body>
</html>
