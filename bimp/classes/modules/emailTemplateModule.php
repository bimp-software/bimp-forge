<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo isset($d->subject) ? $d->subject : 'Correo TiajoBank'; ?></title>
    <style>
      /* GLOBAL RESETS */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; 
        height: auto;
      }
      body {
        background-color: #f8fafc;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        font-size: 15px;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
        color: #1e293b;
      }
      table {
        border-collapse: separate;
        width: 100%;
        border-spacing: 0;
      }
      table td {
        font-family: inherit;
        font-size: inherit;
        vertical-align: top;
      }

      /* STRUCTURE */
      .body {
        background-color: #f8fafc;
        width: 100%;
        padding: 20px 0;
      }
      .container {
        display: block;
        margin: 0 auto;
        max-width: 600px;
        width: 100%;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
      }
      .content {
        box-sizing: border-box;
        padding: 30px;
      }
      
      /* HEADER */
      .header {
        text-align: center;
        padding: 30px 0 20px;
      }
      .header img {
        width: 160px;
        transition: all 0.3s ease;
      }
      
      /* TYPOGRAPHY */
      h1 {
        font-weight: 700;
        font-size: 24px;
        color: #0059b3;
        margin: 0 0 20px 0;
        text-align: center;
        line-height: 1.3;
      }
      p {
        font-size: 15px;
        color: #475569;
        margin: 0 0 18px 0;
        line-height: 1.6;
      }
      a {
        color: #0059b3;
        text-decoration: none;
        font-weight: 500;
      }
      
      /* BUTTON */
      .btn {
        display: inline-block;
        background-color: #0059b3;
        color: white !important;
        padding: 14px 28px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        margin: 25px 0;
        text-align: center;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }
      .btn:hover {
        background-color: #004494;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
      }
      
      /* FOOTER */
      .footer {
        text-align: center;
        font-size: 13px;
        color: #64748b;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
        margin-top: 30px;
      }
      .footer p {
        margin-bottom: 8px;
        color: inherit;
      }
      .footer a {
        color: #64748b;
        text-decoration: underline;
      }
      
      /* RESPONSIVE */
      @media only screen and (max-width: 620px) {
        .body {
          padding: 0;
        }
        .container {
          border-radius: 0;
          box-shadow: none;
        }
        .content {
          padding: 25px;
        }
        .header {
          padding: 25px 0 15px;
        }
        .header img {
          width: 140px;
        }
        h1 {
          font-size: 22px;
        }
        .btn {
          width: 100%;
          padding: 12px 24px;
        }
      }
    </style>
  </head>
  <body class="body">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <!-- HEADER -->
            <div class="header">
              <img src="<?php echo FAVICON.'logo-tiajobank.png'; ?>" alt="TiajoBank" />
            </div>

            <!-- MAIN CONTENT -->
            <h1><?php echo isset($d->subject) ? htmlspecialchars($d->subject) : 'Notificación de TiajoBank'; ?></h1>
            <p><?php echo isset($d->body) ? $d->body : ''; ?></p>

            <!-- Optional button example -->
            <?php if (!empty($d->btn_link) && !empty($d->btn_text)) : ?>
              <p style="text-align:center;">
                <a href="<?php echo htmlspecialchars($d->btn_link); ?>" class="btn" target="_blank" rel="noopener noreferrer">
                  <?php echo htmlspecialchars($d->btn_text); ?>
                </a>
              </p>
            <?php endif; ?>

            <!-- FOOTER -->
            <div class="footer">
              <?php if (!empty($d->footer_links)) : ?>
                <div class="footer-links">
                  <?php foreach ($d->footer_links as $link) : ?>
                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank"><?php echo htmlspecialchars($link['text']); ?></a>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              
              <p>TiajoBank • Licanten 2, Tambillo #0311, Curicó, Región del Maule, Chile</p>
              <p>© <?php echo date('Y'); ?> TiajoBank. Todos los derechos reservados.</p>
              <p>
                <a href="<?php echo URL.'home/privacidad'; ?>">Política de Privacidad</a> | 
                <a href="<?php echo URL.'home/terminos_condiciones'; ?>">Términos de Servicio</a>
              </p>
              <p style="font-size: 12px; color: #a0aec0;">
                Si no deseas recibir estos correos, <a href="<?php echo URL.'home/unsubcribe'; ?>" style="color: #a0aec0;">cancelar suscripción</a>.
              </p>
            </div>
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>