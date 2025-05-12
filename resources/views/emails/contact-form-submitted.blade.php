<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $formData['subject'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a90e2;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .message-box {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            white-space: pre-line;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Nouveau message de contact</h1>
    </div>
    
    <div class="content">
        <p><strong>De :</strong> {{ $formData['name'] }} &lt;{{ $formData['email'] }}&gt;</p>
        <p><strong>Sujet :</strong> {{ $formData['subject'] }}</p>
        <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>
        
        <div class="message-box">
            <p><strong>Message :</strong></p>
            <p>{{ $formData['message'] }}</p>
        </div>
        
        <p>Vous pouvez répondre directement à cet email pour contacter l'expéditeur.</p>
    </div>
    
    <div class="footer">
        <p>Ce message a été envoyé depuis le formulaire de contact de {{ config('app.name') }}.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
    </div>
</body>
</html>
