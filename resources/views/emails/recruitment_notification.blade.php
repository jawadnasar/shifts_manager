<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recruitment Notification</title>
</head>
<body style="background:#f8f9fa;font-family:Arial,sans-serif;">
    <div style="max-width:500px;margin:40px auto;padding:30px;background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
        <h2 style="color:#198754;margin-bottom:20px;">New Recruitment Submission</h2>
        <p style="font-size:1.1em;color:#333;">
            Someone has recently <b>added their data</b> to the recruitment form.
        </p>
        <p style="font-size:1.1em;color:#333;">
            You can check in the <span style="color:#0d6efd;font-weight:bold;">admin panel</span> under the <span style="color:#0d6efd;font-weight:bold;">users section</span>.
        </p>
        <p style="font-size:1.1em;color:#333;">
            <span style="color:#dc3545;font-weight:bold;">Please review the details and take necessary actions.</span>
        </p>
        <hr style="margin:30px 0;">
        <div style="text-align:center;">
            <a href="{{ url('/admin/users') }}" style="display:inline-block;padding:10px 24px;background:#198754;color:#fff;text-decoration:none;border-radius:5px;font-weight:bold;">Go to Admin Panel</a>
        </div>
    </div>
</body>
</html>