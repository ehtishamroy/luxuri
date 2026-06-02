<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #000;">New Contact Form Submission</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold; width: 120px;">Name</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Email</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['email'] }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Phone</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['phone'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Message</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['message'] }}</td>
            </tr>
        </table>
        <p style="margin-top: 20px; font-size: 12px; color: #666;">
            Submitted on {{ now()->format('F j, Y g:i A') }}
        </p>
    </div>
</body>
</html>
