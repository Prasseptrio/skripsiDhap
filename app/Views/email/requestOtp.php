<!DOCTYPE html>
<html>

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <style type="text/css">
      @media screen {
         @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
         }

         @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 700;
            src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
         }

         @font-face {
            font-family: 'Lato';
            font-style: italic;
            font-weight: 400;
            src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
         }

         @font-face {
            font-family: 'Lato';
            font-style: italic;
            font-weight: 700;
            src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
         }
      }

      /* CLIENT-SPECIFIC STYLES */
      body,
      table,
      td,
      a {
         -webkit-text-size-adjust: 100%;
         -ms-text-size-adjust: 100%;
      }

      img {
         -ms-interpolation-mode: bicubic;
      }

      /* RESET STYLES */
      img {
         border: 0;
         height: auto;
         line-height: 100%;
         outline: none;
         text-decoration: none;
      }

      table {
         border-collapse: collapse !important;
      }

      body {
         height: 100% !important;
         margin: 0 !important;
         padding: 0 !important;
         width: 100% !important;
      }

      /* iOS BLUE LINKS */
      a[x-apple-data-detectors] {
         color: inherit !important;
         text-decoration: none !important;
         font-size: inherit !important;
         font-family: inherit !important;
         font-weight: inherit !important;
         line-height: inherit !important;
      }

      /* MOBILE STYLES */
      @media screen and (max-width:600px) {
         h1 {
            font-size: 32px !important;
            line-height: 32px !important;
         }
      }

      /* ANDROID CENTER FIX */
      div[style*="margin: 16px 0;"] {
         margin: 0 !important;
      }
   </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
   <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <!-- LOGO -->
      <tr>
         <td bgcolor="#dfcccc" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
               <tr>
                  <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td bgcolor="#dfcccc" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
               <tr>
                  <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                     <img src=" <?= base_url('assets/images/brand/logo_Karnevor_sm.png'); ?>" style="display: block; border: 0px;" />
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
               <tr>
                  <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                     <p style="margin: 0; text-align:justify;">Untuk proses autentikasi, silahkan gunakan One Time Password (OTP) berikut:</p>
                  </td>
               </tr>
               <tr>
                  <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                              <table border="0" cellspacing="0" cellpadding="0">
                                 <tr>
                                    <td align="center" style="border-radius: 3px;padding: 0px 75px;" bgcolor="#f44c4c">
                                       <h1 style="font-size: 48px; font-weight: 400; margin: 2; color: #F0F8FF; letter-spacing: 15px;"><?= $otp; ?></h1>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
               <tr>
                  <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                     <p style="margin: 0; text-align:justify;">Jangan bagikan OTP ini dengan siapa pun dan segera gunakan kode verifikasi di atas untuk melanjutkan proses pendaftaran hak akses. Kode OTP akan kadaluwarsa dalam waktu 2 menit.</p>
                  </td>
               </tr>

               <tr>
                  <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px;border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400; line-height: 25px;">
                     <br>
                     <p style="margin: 0; text-align:justify;">Jika Anda tidak membuat permintaan ini, silahkan abaikan atau menghubungi <a href="mailto:<?= getenv('SMTPUser.config'); ?>">Customer Service</a>, kami selalu dengan senang hati membantu. Mohon untuk tidak membalas email ini.</p>
                  </td>
               </tr>

            </table>
         </td>
      </tr>

   </table>

   <div style="clear:both;padding-top:20px;text-align:center;width:100%">
      <table cellpadding="0" cellspacing="0" style="border-collapse:separate;width:100%">
         <tbody>
            <tr>
               <td style="font-family:sans-serif;font-size:14px;vertical-align:top;color:#999999;font-size:12px;text-align:center;padding-top:20px">
                  <span class="m_-2799203532342614096apple-link" style="color:#999999;font-size:12px;text-align:center">Karnevor.id Semarang</span>
               </td>
            </tr>
            <tr>
               <td style="font-family:sans-serif;font-size:14px;vertical-align:top;color:#999999;font-size:12px;text-align:center">
                  Hak Cipta © 2024 - <?= date('Y'); ?> <a href="" <?= urldecode(base_url()) ?>" style="color:#3498db;text-decoration:underline;color:#999999;font-size:12px;text-align:center;text-decoration:none" target="_blank">Skripsi Dhapunta. </a>.
                  <br>
                  Semua Hak Dilindungi
               </td>
            </tr>
         </tbody>
      </table>
   </div>
</body>

</html>