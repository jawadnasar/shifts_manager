<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        /* .email-footer {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 20px auto;
            color: #333333;
            line-height: 1.4;
        } */

        .header-section {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 250px;
            /* Half of container width */
            border-bottom: 2px solid #cc0000;
        }

        .name-section {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .position-section {
            font-size: 14px;
            color: #666666;
            margin: 8px 0;
        }

        .contact-info {
            font-size: 13px;
            margin: 10px 0;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0 5px 0;
        }

        .confidential-notice {
            border-left: 3px solid #cc0000;
            background-color: #f8f8f8;
            padding: 12px 15px;
            margin: 25px 0;
            font-size: 11px;
            color: #666666;
        }

        .address-line {
            margin: 3px 0;
        }

        a {
            color: #1155cc;
            text-decoration: none;
        }

        /* Social Media Icons */
        .social-media {
            margin: 15px 0;
            display: flex;
            gap: 12px;
        }

        .social-media a {
            display: inline-block;
        }

        .social-media img {
            width: 24px;
            height: 24px;
            transition: opacity 0.3s ease;
        }

        .social-media img:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    {!! nl2br($email_body) !!}
    {!! $email_footer !!}
</body>

</html>
