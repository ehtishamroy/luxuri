<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Inquiry Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #000;">New Inquiry Submission</h2>
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
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['phone'] }}</td>
            </tr>
            @if(!empty($data['villa']))
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Villa</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['villa']->title }}</td>
            </tr>
            @endif
            @if(!empty($data['yacht']))
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Yacht</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['yacht']->title }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Check In</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['check_in'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Check Out</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['check_out'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Guests</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['guests'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Message</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['message'] ?? 'N/A' }}</td>
            </tr>
            @if(!empty($data['referral_source']))
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Referral</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['referral_source'] }}</td>
            </tr>
            @endif
        </table>
        <p style="margin-top: 20px; font-size: 12px; color: #666;">
            Submitted on {{ now()->format('F j, Y g:i A') }}
        </p>
    </div>
</body>
</html>
