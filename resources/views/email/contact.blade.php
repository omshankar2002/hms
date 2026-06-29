<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">

    <h1>{{ $mail_subject }}</h1>

    <p><strong>Name:</strong> {{ $contact_name }}</p>
    <p><strong>Email:</strong> {{ $contact_email }}</p>
    <p><strong>Phone:</strong> {{ $contact_phone }}</p>
    <p><strong>Service:</strong> {{ $service }}</p>
    <p><strong>Preferred Contact Times:</strong> {{ $contact_time }}</p>

    <p><strong>Message:</strong></p>
    <p>{{ $contact_message }}</p>

</body>
</html>