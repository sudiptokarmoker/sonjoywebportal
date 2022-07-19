<x-backend.email.header/>
<!-- main body content -->
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
                        <img src="{!! $details['logo_url'] !!}" alt="vioresume" style="margin-bottom:24px" width="250px">
                        <div style="background-color: #fff; padding: 30px; border-radius: 6px; text-align: left; min-height: 407px; box-sizing: border-box;">
                            {{-- main email body content --}}
                            <h1>Dear {!! $details['name'] !!}</h1>
                            <p>An withdraw request sent by your account.</p>
                            <h4>Details</h4>
                            <p>
                                Amount : {!! $details['amount'] !!}
                                <br />
                                Currency : {!! $details['currency'] !!}
                                <br />
                                Withdraw method : {!! $details['method'] !!}
                                <br/>
                                Request Datetime : {!! $details['created_at'] !!}
                            </p>
                            <a href="{!! $details['emergency_contact_email'] !!}">kindly contact to this email address immideatly if you are not authorize this withdraw transaction</a>
                            <br />
                            <p>Or direct call into this number : {!! $details['emergency_contact_number']  !!}</p>
                            <br />
                            <p>Thank you</p>
                            {{-- end of email body --}}
                        </div>
                        <p style="font-family: 'Poppins', sans-serif;font-size: 13px;line-height: 23px;color: #7B7B7B; font-weight: 500;text-align: center; margin: 10px 0 0;">
                            <a href="#" style="color: #7b7b7b; text-decoration: none;">VioAdvisor LLC</a>
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
<!-- end of body content -->
<x-backend.email.footer/>