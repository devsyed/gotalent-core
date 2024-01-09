<?php $user_data = $variables; 
  $user = $user_data['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body link="#C04441" vlink="#C04441" alink="#C04441">
  <style>
    @media only screen and (max-width: 600px) {
      .main {
        width: 320px !important;
      }

      .top-image {
        width: 100% !important;
      }

      .inside-footer {
        width: 320px !important;
      }

      table[class="contenttable"] {
        width: 320px !important;
        text-align: left !important;
      }

      td[class="force-col"] {
        display: block !important;
      }

      td[class="rm-col"] {
        display: none !important;
      }

      .mt {
        margin-top: 15px !important;
      }

      *[class].width300 {
        width: 255px !important;
      }

      *[class].block {
        display: block !important;
      }

      *[class].blockcol {
        display: none !important;
      }

      .emailButton {
        width: 100% !important;
      }

      .emailButton a {
        display: block !important;
        font-size: 18px !important;
      }

    }
  </style>
  <table class=" main contenttable" align="center"
    style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 26px;width: 600px;">
    <tr>
      <td class="border"
        style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
        <table
          style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
          <tr>
            <td colspan="4" valign="top" class="image-section"
              style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff;border-bottom: 4px solid #C04441; text-align: center;">
              <a href="https://gotalent.global"><img class="top-image" src="https://eraveray.sirv.com/logo-main.png"
                  style="line-height: 1;width: 150px; margin:0 auto;" alt="GoTalent"></a>
            </td>
          </tr>
          <tr>
            <td valign="top" class="side title"
              style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
              <table
                style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td class="head-title"
                    style="border-collapse: collapse;
                    border: 0;
                    margin: 0;
                    padding: 0;
                    -webkit-text-size-adjust: none;
                    color: #123841;
                    font-family: Arial, sans-serif;
                    font-size: 28px;
                    line-height: 34px;
                    font-weight: bold;
                    text-align: center;
                    padding: 45px;
                    background: #E6F8FD;">
                    <div class="mktEditable" id="main_title">
                      Your Account has been created!
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="top-padding"
                    style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                  </td>
                </tr>
                
                <tr>
                  <td class="top-padding"
                    style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
                    <hr size="1" color="#eeeff0">
                  </td>
                </tr>
                <tr>
                  <td class="text"
                    style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                    <div class="mktEditable" id="main_text">
                      Dear <strong><?php echo $user->display_name; ?></strong>, <br>

                      Your Profile has been verified at GoTalent. Now you will appear in the searches and are able to be hired by recruiters looking for talented individuals of your sort. 
                      <br>
                      <br>
                      
                      If you have any questions or need assistance, our support team is here to help.
                      <br>
                      <br>
                      
                      Thank you for choosing GoTalent. We can't wait to see what amazing things you'll accomplish on our platform!
                      <br>
                      <br>
                      
                      Best regards,<br>
                      <strong>GoTalent</strong> | Powered by The Only Dandy
                    </div>
                  </td>
                </tr>
                <tr>
                  <td
                    style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 24px;">
                    &nbsp;<br>
                  </td>
                </tr>
                

              </table>
            </td>
          </tr>
          <tr>
            <td valign="top" align="center"
              style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
              <table
                style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td align="center" valign="middle" class="social"
                    style="border-collapse: collapse;border: 0;margin: 0;padding: 10px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;text-align: center;">
                    <table
                      style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                      <tr>
                        <td
                          style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                          <a href="https://gotalent.global"><img
                              src="https://info.tenable.com/rs/tenable/images/rss-teal.png"></a></td>
                        <td
                          style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                          <a href="https://gotalent.global"><img
                              src="https://info.tenable.com/rs/tenable/images/twitter-teal.png"></a></td>
                        <td
                          style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                          <a href="https://gotalent.global"><img
                              src="https://info.tenable.com/rs/tenable/images/facebook-teal.png"></a></td>
                        <td
                          style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                          <a href="https://gotalent.global"><img
                              src="https://info.tenable.com/rs/tenable/images/youtube-teal.png"></a></td>
                        <td
                          style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                          <a href="https://gotalent.global"><img
                              src="https://info.tenable.com/rs/tenable/images/linkedin-teal.png"></a></td>
                        <td
                          style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
                          <a href="https://gotalent.global"><img
                              src="https://info.tenable.com/rs/tenable/images/google-teal.png"></a></td>

                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr bgcolor="#fff" style="border-top: 4px solid #C04441;">
            <td valign="top" class="footer"
              style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background: #fff;text-align: center;">
              <table
                style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
                <tr>
                  <td class="inside-footer" align="center" valign="middle"
                    style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 12px;line-height: 16px;vertical-align: middle;text-align: center;width: 580px;">
                    <div id="address" class="mktEditable">
                      <b>GoTalent</b><br>
                      Al Saaha C Wing 202 - Downtown Dubai - Dubai - United Arab Emirates<br>
                      <a style="color: #C04441;" href="https://www.gotalent.global/contact-us">Contact Us</a>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>