<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
</head>
<body>
    <h2>Mensaje de contacto recibido</h2>
    <p><strong>Nombre:</strong> {{ $details['name'] }}</p>
    <p><strong>Correo:</strong> {{ $details['email'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $details['message'] }}</p>
</body>
</html>
