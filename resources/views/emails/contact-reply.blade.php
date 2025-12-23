<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reply to Your Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 28px;
        }
        .content {
            margin-bottom: 30px;
        }
        .original-message {
            background: #f8f9fa;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .original-message h3 {
            margin-top: 0;
            color: #495057;
        }
        .footer {
            text-align: center;
            border-top: 1px solid #e9ecef;
            padding-top: 20px;
            color: #6c757d;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name', 'Kagzi Admin') }}</h1>
            <p>Thank you for contacting us!</p>
        </div>

        <div class="content">
            <p>Hello {{ $originalMessage->name }},</p>
            
            <p>Thank you for reaching out to us. Here's our response to your message:</p>
            
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
                {!! nl2br(e($replyMessage)) !!}
            </div>

            <div class="original-message">
                <h3>Your Original Message:</h3>
                <p><strong>Date:</strong> {{ $originalMessage->created_at->format('F j, Y g:i A') }}</p>
                <p><strong>Subject:</strong> {{ $originalMessage->subject }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $originalMessage->message }}</p>
            </div>

            <p>If you have any additional questions or need further assistance, please don't hesitate to contact us again.</p>
        </div>

        <div class="footer">
            <p>Best regards,<br>
            <strong>{{ config('app.name', 'Kagzi Admin') }} Team</strong></p>
            
            <p>This is an automated response. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>