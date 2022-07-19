<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <!-- Web Font / @font-face Starts
 ====================================================== -->

    <!--[if mso]>
    <style>
        * {
            font-family: sans-serif !important;
        }
    </style>
    <![endif]-->

    <!--[if !mso]><!-->

    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,200;1,400;1,500;1,600&display=swap" rel="stylesheet"> -->

    <!--<![endif]-->

    <!--
  font-family: 'Poppins', sans-serif;
 -->

    <!-- Web Font / @font-face ends -->

    <!-- CSS reset
 ====================================================== -->
    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            width: 100% !important;
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            line-height: 30px;
            color: #7b7b7b;
        }

        body {
            padding: 15px !important;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 60px auto !important;
        }

        table table table {
            table-layout: auto;
        }

        a {
            text-decoration: none;
            transition: all .3s;
        }

        a:hover {
            color: #3D99EF !important;
            text-decoration: underline !important;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .social-icon:hover {
            opacity: .5;
        }

    </style>
    <!-- CSS Reset : END -->

    <!-- Reset list spacing because Outlook ignores much of our inline CSS. -->
    <!--[if mso]>
    <style type="text/css">
        ul,
        ol {
            margin: 0 !important;
        }
        li {
            margin-left: 30px !important;
        }
        li.list-item-first {
            margin-top: 0 !important;
        }
        li.list-item-last {
            margin-bottom: 10px !important;
        }
    </style>
    <![endif]-->

    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<!--
 The email background color (#222222) is defined in three places:
 1. body tag: for most email clients
 2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
 3. mso conditional: For Windows 10 Mail
-->

<body width="100%" style="margin: 0; padding: 15px; box-sizing: border-box!important; mso-line-height-rule: exactly; background-color: #c1ddfd;
 font-family: 'IBM Plex Sans', sans-serif; font-size: 18px; line-height: 30px; color: #777A7E;">
    <center style="width: 100%; background-color: #c1ddfd;">
        <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F2F8FF;">
        <tr>
            <td>
    <![endif]-->

        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="width: 100%;max-width: 600px; margin: 0;padding: 0;">
            <!-- Email Header : BEGIN -->
            <tbody>
                <tr>
                    <td style="text-align:center;">
                        <img src="https://staging.vioresume.com/backend/assets/images/icon/logo-vioresume.png" alt="vioresume" style="margin-bottom:24px">
                        <div style="background-color: #fff; padding: 30px; border-radius: 6px; text-align: left; min-height: 407px; box-sizing: border-box;">
                            {{-- main email body content --}}
                            <h1>Dear {{ $details['name'] }}</h1>
                            <p>Your password has been reset successfully</p>
                            <p>Thank you</p>
                            {{-- end of email body --}}
                        </div>

                        <div style="margin-top: 30px; text-align: center;">
                            <a href="#" style="display: inline-block; text-decoration: none!important; margin: 0 5px;">
                                <img src="https://staging.vioresume.com/backend/assets/images/icon/facebook-f.png" alt="fb">
                            </a>
                            <a href="#" style="display: inline-block; text-decoration: none!important; margin: 0 5px;">
                                <img src="https://staging.vioresume.com/backend/assets/images/icon/instagram.png" alt="ins">
                            </a>
                            <a href="#" style="display: inline-block; text-decoration: none!important; margin: 0 5px;">
                                <img src="https://staging.vioresume.com/backend/assets/images/icon/twitter.png" alt="tw">
                            </a>
                            <a href="#" style="display: inline-block; text-decoration: none!important; margin: 0 5px;">
                                <img src="https://staging.vioresume.com/backend/assets/images/icon/linkedin-in.png" alt="lnkdn">
                            </a>
                        </div>
                        <p style="font-family: 'Poppins', sans-serif;font-size: 13px;line-height: 23px;color: #7B7B7B; font-weight: 500;text-align: center; margin: 10px 0 0;">
                            <a href="#" style="color: #7b7b7b; text-decoration: none;">Vioresume LLC</a>
                        </p>
                        <p style="font-family: 'Poppins', sans-serif;font-size: 13px;line-height: 23px;color: 7B7B7B; text-align: center; margin: 0;">
                            Ranking street, Wari, Dhaka 1203, Bangladesh</p>
                    </td>
                </tr>

            </tbody>
        </table>

        <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->

    </center>
</body>
</html>