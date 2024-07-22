<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    {{ $header ?? '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="border: hidden !important;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy ?? '' }}
                                    </td>
                                </tr>
                                <div
                                    style="background-color: #381C83;box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; text-align: center;">
                                    <span
                                        style="box-sizing: border-box; font-family: 'Quicksand', sans-serif; color: white;">
                                        <strong
                                            style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">Temukan
                                            Kami</strong>
                                    </span>
                                    @php
                                        $settings = DB::table('settings')->first();
                                    @endphp
                                    <br><br>
                                    <a href="{{ $settings->facebook }}" target="_blank">
                                        <img src="https://i.ibb.co.com/RNqJcB9/1200px-Facebook-Logo-2023.png"
                                            alt="Facebook"
                                            style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100%;border:none;color:#010101;margin-right:20px;width:35px">
                                    </a>
                                    <a href="{{ $settings->instagram }}" target="_blank">
                                        <img src="https://i.ibb.co.com/NYMBsBy/1200px-Instagram-icon.png"
                                            alt="Instagram"
                                            style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100%;border:none;color:#010101;margin-right:20px;width:35px">
                                    </a>
                                    <a href="{{ $settings->twitter }}" target="_blank">
                                        <img src="https://i.ibb.co.com/gWHkWn8/Twitter-new-X-logo.png"
                                            alt="Twitter-new-X-logo" alt="Twitter"
                                            style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100%;border:none;color:#010101;margin-right:20px;width:35px">
                                    </a>
                                    <a href="{{ $settings->linkedin }}" target="_blank">
                                        <img src="https://i.ibb.co.com/SRGn8vd/Linked-In-logo-initials.png"
                                            alt="Linked-In-logo-initials" alt="LinkedIn"
                                            style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100%;border:none;color:#010101;margin-right:20px;width:35px">
                                    </a>


                                    <br><br><br>
                                    <span
                                        style="box-sizing: border-box; font-family: 'Quicksand', sans-serif; color: white;">
                                        <strong
                                            style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">Keanggotaan
                                            & Berlangganan</strong>
                                    </span>
                                    <br><br>
                                    <span
                                        style="box-sizing: border-box; font-family: 'Quicksand', sans-serif; color: white;">
                                        Pesan ini dikirim karena Anda terdaftar dalam member/keanggotaan OtoRent
                                    </span>
                                    <br>
                                    <hr
                                        style="color:white;box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
                                    <div
                                        style="box-sizing: border-box; text-align: center; font-family: 'Quicksand', sans-serif; color: white;">
                                        <strong
                                            style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">TERIMA
                                            KASIH</strong>
                                    </div>
                                </div>
                            </table>
                        </td>
                    </tr>



                    {{ $footer ?? '' }}
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
