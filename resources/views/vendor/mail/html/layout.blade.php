<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ config('app.name') }}</title>
    <!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            <o:AllowPNG/>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <style>
        @media only screen and (max-width: 600px) {
            .container { width: 100% !important; }
            .px { padding-left: 16px !important; padding-right: 16px !important; }
            .py { padding-top: 16px !important; padding-bottom: 16px !important; }
            .stack { display:block !important; width:100% !important; text-align:left !important; }
        }
        :root { color-scheme: dark; supported-color-schemes: dark; }
    </style>
    {!! $head ?? '' !!}
</head>
<body style="margin:0; padding:0; background-color:#0b0f19; color:#e5e7eb; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">
<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#0b0f19;">
    <tr>
        <td align="center" style="padding:20px 12px;">
            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" class="container" style="width:600px; max-width:600px; background-color:#111827; border:1px solid #1f2937; border-radius:16px; overflow:hidden; font-family:Arial, Helvetica, sans-serif;">

                <tr>
                    <td class="px py" style="padding:24px; border-bottom:1px solid #1f2937;">
                        <table role="presentation" width="100%">
                            <tr>
                                <td class="stack">
                                    <table role="presentation">
                                        <tr>
                                            <td style="background:linear-gradient(90deg,#6366f1,#14b8a6); width:40px; height:40px; border-radius:10px; text-align:center;">
                                                <span style="display:inline-block; line-height:40px; font-weight:700; color:#ffffff; font-size:15px;">R</span>
                                            </td>
                                            <td width="10"></td>
                                            <td>
                                                <div style="font-size:12px; color:#9ca3af; margin-bottom:2px;">{{ __('mail.type') }}</div>
                                                <div style="font-size:16px; color:#ffffff; font-weight:700;">{{ config('app.name') }}</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td class="px" style="padding:24px 28px 0 28px;">
                        {!! Illuminate\Mail\Markdown::parse($slot) !!}
                        <div style="height:1px; background:linear-gradient(90deg,#4f46e5,#14b8a6); width:100%; margin:20px 0 0; border-radius:2px;"></div>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td class="px py" style="padding:20px 28px 24px;">
                        <div style="font-size:12px; color:#6b7280; line-height:18px;">
                            <p style="margin:0; color:#4b5563; text-align: center;">© {{ date('Y') }} {{ config('app.name') }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
