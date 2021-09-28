<?php

    // ===============================================================
    // carregar classes
        namespace core\classes;

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    // ===============================================================

    // ===============================================================
    // classe enviar mail
        class SendEmail
        {
            // ===============================================================
            // enviar email confirmacao novo customer / send email confirmation new customer
                public function send_email_confirmation_new_customer($email_customer, $purl)
                {

                    // ===============================================================
                    // envia um email para o novo customer no sentido de confirmar o email
                    // ===============================================================

                    // ===============================================================
                    // constroi o purl (link para validação do email)
                        $link = BASE_URL . '?a=confirm_email&purl=' . $purl;
                    // ===============================================================

                    // ===============================================================
                    // criar mail
                        $mail = new PHPMailer(true);
                    // ===============================================================

                    // ===============================================================
                    // tentativa de enviar email
                        try 
                        {
                            // ===============================================================
                            // opções do servidor
                                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                                $mail->isSMTP();
                                $mail->Host       = EMAIL_HOST;
                                $mail->SMTPAuth   = true;
                                $mail->Username   = EMAIL_FROM;
                                $mail->Password   = EMAIL_PASS;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port       = EMAIL_PORT;
                                $mail->CharSet    = 'UTF-8';
                            // ===============================================================

                            // ===============================================================
                            // emissor e recetor
                                $mail->setFrom(EMAIL_FROM, APP_NAME);
                                $mail->addAddress($email_customer);
                            // ===============================================================

                            // ===============================================================
                            // assunto
                                $mail->isHTML(true);
                                $mail->Subject = APP_NAME . ' - Confirmação de email.';
                            // ===============================================================
                            
                            // ===============================================================
                            // message
                                $html = '<p>Seja bem-vindo à nossa store ' . APP_NAME . '.</p>';
                                $html .= '<p>Para poder entrar na nossa store, necessita confirmar o seu email.</p>';
                                $html .= '<p>Para confirmar o email, click no link abaixo:</p>';
                                $html .= '<p><a href="'.$link.'">Confirmar Email</a></p>';
                                $html .= '<p><i><small>' . APP_NAME .'</small></i></p>';
                            // ===============================================================

                            // ===============================================================
                            // corpo do email recebe html
                                $mail->Body = $html;
                            // ===============================================================

                            // ===============================================================
                            // envia email
                                $mail->send();
                            // ===============================================================

                            // ===============================================================
                            // devolve true se o  email for enviado
                                return true;
                            // ===============================================================
                        } 
                        catch (Exception $e) 
                        {
                            // ===============================================================
                            // devolve false se o email não for enviado
                                return false;
                            // ===============================================================
                        }
                    // ===============================================================
                }
            // ===============================================================   
            
            // ===============================================================
            // enviar email confirmacao novo customer / send email confirmation new customer
                public function send_email_confirmation_new_admin($email_admin, $purl)
                {

                    // ===============================================================
                    // envia um email para o novo customer no sentido de confirmar o email
                    // ===============================================================

                    // ===============================================================
                    // constroi o purl (link para validação do email)
                        $link = BASE_URL . '?a=confirm_email&purl=' . $purl;
                    // ===============================================================

                    // ===============================================================
                    // criar mail
                        $mail = new PHPMailer(true);
                    // ===============================================================

                    // ===============================================================
                    // tentativa de enviar email
                        try 
                        {
                            // ===============================================================
                            // opções do servidor
                                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                                $mail->isSMTP();
                                $mail->Host       = EMAIL_HOST;
                                $mail->SMTPAuth   = true;
                                $mail->Username   = EMAIL_FROM;
                                $mail->Password   = EMAIL_PASS;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port       = EMAIL_PORT;
                                $mail->CharSet    = 'UTF-8';
                            // ===============================================================

                            // ===============================================================
                            // emissor e recetor
                                $mail->setFrom(EMAIL_FROM, APP_NAME);
                                $mail->addAddress($email_admin);
                            // ===============================================================

                            // ===============================================================
                            // assunto
                                $mail->isHTML(true);
                                $mail->Subject = APP_NAME . ' - Confirmação de email.';
                            // ===============================================================
                            
                            // ===============================================================
                            // message
                                $html = '<p>Seja bem-vindo à nossa Loja ' . APP_NAME . '.</p>';
                                $html .= '<p>Para poder entrar no BackOffice da nossa Loja, necessita de confirmar o seu email.</p>';
                                $html .= '<p>Para confirmar o email, click no link abaixo:</p>';
                                $html .= '<p><a href="'.$link.'">Confirmar Email</a></p>';
                                $html .= '<p><i><small>' . APP_NAME .'</small></i></p>';
                            // ===============================================================

                            // ===============================================================
                            // corpo do email recebe html
                                $mail->Body = $html;
                            // ===============================================================

                            // ===============================================================
                            // envia email
                                $mail->send();
                            // ===============================================================

                            // ===============================================================
                            // devolve true se o  email for enviado
                                return true;
                            // ===============================================================
                        } 
                        catch (Exception $e) 
                        {
                            // ===============================================================
                            // devolve false se o email não for enviado
                                return false;
                            // ===============================================================
                        }
                    // ===============================================================
                }
            // ===============================================================             

            // ===============================================================
            // enviar email confirmacao order / send order confirmation email    
                public function send_order_confirmation_email($email_customer, $data_order)
                {
                    // ===============================================================
                    // envia um email para o novo customer no sentido de confirmacao order
                    // ===============================================================

                    // ===============================================================
                    // criar mail
                        $mail = new PHPMailer(true);
                    // ===============================================================

                    // ===============================================================
                    // tentativa de enviar email
                        try 
                        {
                            // ===============================================================
                            // opções do servidor
                                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                                $mail->isSMTP();
                                $mail->Host       = EMAIL_HOST;
                                $mail->SMTPAuth   = true;
                                $mail->Username   = EMAIL_FROM;
                                $mail->Password   = EMAIL_PASS;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port       = EMAIL_PORT;
                                $mail->CharSet    = 'UTF-8';
                            // ===============================================================

                            // ===============================================================
                            // emissor e recetor
                                $mail->setFrom(EMAIL_FROM, APP_NAME);
                                $mail->addAddress($email_customer);
                            // ===============================================================

                            // ===============================================================
                            // assunto
                                $mail->isHTML(true);
                                $mail->Subject = APP_NAME . ' - Confirmação de order - '.$data_order['payment_data']['order_code'];
                            // ===============================================================
                            
                            // ===============================================================
                            // message
                                $html = '<p>Este email serve para confirmar a sua order.</p>';
                                $html.='<p>Dados da order:</p>';
                            // ===============================================================

                            // ===============================================================
                            // lista de products
                                $html.= '<ul>';
                                foreach ($data_order['products_list'] as $product)
                                {
                                    $html.= '<li>'.$product.'</li>';   
                                }
                                $html.= '</ul>';
                            // ===============================================================

                            // ===============================================================
                            // total
                                $html .= '<p>Total: <strong>'.$data_order['total'].'</strong> </p>';
                            // ===============================================================

                            // ===============================================================
                            // dados de pagamento
                                $html.= '<hr>';
                                $html.= '<p>DADOS DE PAGAMENTO</p>';   
                                $html.= '<p>Número da conta: <strong>'
                                .$data_order['payment_data']['numero_conta'].'</strong></p>';
                                $html.= '<p>Código da order: <strong>'
                                .$data_order['payment_data']['order_code'].'</strong></p>';
                                $html.= '<p>Valor a pagar: <strong>'
                                .$data_order['payment_data']['total'].'</strong></p>';
                                $html.= '<hr>';
                            // ===============================================================

                            // ===============================================================
                            // Nota importante
                                $html.= '<p>NOTA: A sua order só será processada após pagamento.</p>';
                            // ===============================================================

                            // ===============================================================
                            // corpo do email vai receber html
                                $mail->Body = $html;
                            // ===============================================================

                            // ===============================================================
                            // enviar email
                                $mail->send();
                            // ===============================================================

                            // ===============================================================
                            // devolve verdadeiro
                                return true;
                            // ===============================================================
                        } 
                        catch (Exception $e) 
                        {
                            // ===============================================================
                            // devolve falso
                                return false;
                            // ===============================================================
                        }
                    // ===============================================================
                }
            // ===============================================================        

            // ===============================================================
            // enviar pdf order para customer / send pdf order to customer
                public function send_pdf_order_to_customer($email_customer, $ficheiro)
                {
                    // ===============================================================
                    // envia um email para o customer com o anexo do PDF da order
                    // ===============================================================

                    // ===============================================================
                    // constroi o purl (link para validação do email)
                        $link = BASE_URL . '?a=confirm_email&purl=';
                    // ===============================================================

                    // ===============================================================
                    // criar mail
                        $mail = new PHPMailer(true);
                    // ===============================================================

                    // ===============================================================
                    // tentativa de enviar email            
                        try 
                        {
                            // ===============================================================
                            // opções do servidor
                                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                                $mail->isSMTP();
                                $mail->Host       = EMAIL_HOST;
                                $mail->SMTPAuth   = true;
                                $mail->Username   = EMAIL_FROM;
                                $mail->Password   = EMAIL_PASS;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port       = EMAIL_PORT;
                                $mail->CharSet    = 'UTF-8';
                            // ===============================================================

                            // ===============================================================
                            // emissor e recetor
                                $mail->setFrom(EMAIL_FROM, APP_NAME);
                                $mail->addAddress($email_customer);
                            // ===============================================================

                            // ===============================================================
                            // assunto
                                $mail->isHTML(true);
                                $mail->Subject = APP_NAME . ' - Envio de PDF com detalhe de order.';
                            // ===============================================================
                            
                            // ===============================================================
                            // message
                                $html = '<p>Segue em anexo o PDF com os detalhes da order.</p>';
                                $html .= '<p><i><small>' . APP_NAME .'</small></i></p>';
                            // ===============================================================

                            // ===============================================================
                            //Anexo / Attachment 
                                $mail->addAttachment(PDF_PATH . $ficheiro);         //Add attachments
                            // ===============================================================

                            // ===============================================================
                            // corpo do email vai receber html
                                $mail->Body = $html;
                            // ===============================================================

                            // ===============================================================
                            // enviar mail
                                $mail->send();
                            // ===============================================================

                            // ===============================================================
                            // devolve verdadeiro
                                return true;
                            // ===============================================================
                        } 
                        catch (Exception $e)
                        {
                            // ===============================================================
                            // devolve falso             
                                return false;
                            // ===============================================================             
                        }
                    // ===============================================================
                }
            // ===============================================================
        }
    // ===============================================================