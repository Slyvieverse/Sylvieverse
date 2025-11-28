<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .field {
            margin-bottom: 15px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .field-label {
            font-weight: bold;
            color: #667eea;
            display: block;
            margin-bottom: 5px;
        }
        .field-value {
            color: #333;
        }
        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🦋 New Contact Form Submission</h1>
        <p>SylvieVerse Contact Form</p>
    </div>

    <div class="content">
        <div class="field">
            <span class="field-label">From:</span>
            <span class="field-value">{{ $formData['first_name'] }} {{ $formData['last_name'] }}</span>
        </div>

        <div class="field">
            <span class="field-label">Email:</span>
            <span class="field-value">
                <a href="mailto:{{ $formData['email'] }}">{{ $formData['email'] }}</a>
            </span>
        </div>

        <div class="field">
            <span class="field-label">Subject:</span>
            <span class="field-value">{{ $formData['subject'] }}</span>
        </div>

        <div class="field">
            <span class="field-label">Submitted At:</span>
            <span class="field-value">{{ now()->format('F j, Y \a\t g:i A') }}</span>
        </div>

        <div class="message-box">
            <h3 style="color: #667eea; margin-top: 0;">Message:</h3>
            <p style="white-space: pre-wrap; line-height: 1.6;">{{ $formData['message'] }}</p>
        </div>

        <div style="margin-top: 30px; padding: 15px; background: #e7f3ff; border-radius: 8px; border-left: 4px solid #667eea;">
            <p style="margin: 0; color: #2c5282;">
                <strong>💡 Quick Action:</strong>
                <a href="mailto:{{ $formData['email'] }}?subject=Re: {{ $formData['subject'] }}" style="color: #2b6cb0;">
                    Click here to reply directly
                </a>
            </p>
        </div>
    </div>
</body>
</html>
