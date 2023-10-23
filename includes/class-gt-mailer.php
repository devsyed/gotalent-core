<?php 

defined('ABSPATH') || exit; 

use PHPMailer\PHPMailer;

class GTMailer
{


    public static function gt_send_mail($to,$from,$from_name, $subject,$template_name)
    {
        $mail = new PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'naqi112244@gmail.com';
        $mail->Password = 'vawojlqygcfoveus'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($from, $from_name);
        $mail->addAddress($to);
        $mail->Subject = esc_html($subject);
        $mail->Body = GTHelpers::gt_get_template_content($template_name);

        try {
            $mail->send();
            return true;
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }

    }
}
