<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?= ucfirst($this->entity()->app_info('company_name')); ?></title>
        <meta name="viewport" content="width=device-width" />
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #1bbae1; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content { width: 600px !important; }
                .col387 { width: 387px !important; }
            }
        </style>
    </head>
    <body bgcolor="#394263" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" style="color: #aaaaaa; font-family: Arial, sans-serif; font-size: 12px;">
                                L'email ne s'affiche pas correctement ?  <a href="#" style="color: #1bbae1;">Regardez dans votre navigateur</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#1bbae1" style="padding: 20px 20px 20px 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img src="<?= $this->entity()->img_file('logo.png'); ?>" alt="<?= $this->entity()->app_info('app_name'); ?>" width="152" height="152" style="display:block;" />
                    Newsletters
                </td>
            </tr>
            <?php $nbre = 0; ?>
            <?php foreach ($newsletter_big as $news): ?>
            <?php $nbre++; ?>
            <tr>
                <td bgcolor="#ffffff" style="padding: 20px 20px 10px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                    <b><?= $news['nbre'] ?>. <?= $news['title'] ?></b>
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" style="padding: 10px 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 15px; line-height: 24px;">
                    <img src="<?= $news['picture'] ?>" alt="<?= $news['title'] ?>" width="100%"
                         style="display: block; height: auto;" />
                </td>
            </tr>
            <tr>
                <td bgcolor="#ffffff" style="padding: 0 20px 20px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 15px; line-height: 24px; border-bottom: 1px solid #f6f6f6;">
                    <?= $news['content'] ?><br>
                    <?= $news['url'] ?>
                </td>
            </tr>
            <?php endforeach; ?>


            <?php if(count($newsletter_small) > 0 ): ?>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 20px 20px 10px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                        <b>Brefs</b>
                    </td>
                </tr>
                <?php foreach ($newsletter_small as $small): ?>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 10px 20px 0 20px;">
                            <table width="128" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="128" style="padding: 0 20px 20px 0;">
                                        <img src="<?= $small['picture'] ?>" alt="Icon #4" width="128" height="128" style="display: block;" />
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                            <table width="387" align="left" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                            <![endif]-->
                            <table class="col387" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 387px;">
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding: 0 0 20px 0; color: #555555; font-family: Arial, sans-serif; font-size: 15px; line-height: 24px;">
                                                    <?= $small['content'] ?><br>
                                                    <?= $small['url'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(isset($redirect) && $redirect != ''): ?>
            <tr>
                <td align="center" bgcolor="#f9f9f9" style="padding: 30px 20px 30px 20px; font-family: Arial, sans-serif;">
                    <table bgcolor="#1bbae1" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
                        <tr>
                            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                                <a href="<?= $redirect ?>" style="color: #ffffff; text-align: center; text-decoration: none;">Plus de news</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php endif; ?>

            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b><?= ucfirst($this->entity()->app_info('company_name')); ?></b><br/>
                    <?= $this->entity()->app_info('company_email'); ?>. &bull; <?= $this->entity()->app_info('company_first_phone'); ?> &bull; <?= $this->entity()->app_info('app_url'); ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td width="60%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                <a href="#" style="color: #1bbae1;">Se désinscrire</a>
                            </td>
                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                2018 - <?= date('Y'); ?> &copy; <a href="<?= $this->entity()->app_info('app_url'); ?>" style="color: #1bbae1;"><?= $this->entity()->app_info('company_name'); ?></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>