<?php

    // ===========================================================
    // Carregar classes
        namespace core\classes;
        use Exception;
    // =========================================================== 

    // =========================================================== 
    // class Store
        class Store
        {
            // ===========================================================
            // Layout
                public static function Layout($estruturas, $data = null)
                {
                    // ===========================================================
                    // verifica se estruturas não é um array
                        if(!is_array($estruturas))
                        {
                            throw new Exception("Coleção de estruturas inválida");
                        }
                    // ===========================================================

                    // ===========================================================
                    // variáveis
                        if(!empty($data) && is_array($data))
                        {
                            extract($data);
                        }
                    // ===========================================================

                    // ===========================================================
                    // apresentar as views da aplicação
                        foreach($estruturas as $estrutura)
                        {
                            include("../core/views/$estrutura.php");
                        }
                    // ===========================================================

                }
            // ===========================================================

            // ===========================================================
            // Layout admin
                public static function admin_layout($estruturas, $data = null)
                {
                    // ===========================================================
                    // verifica se estruturas é um array
                        if(!is_array($estruturas))
                        {
                            throw new Exception("Coleção de estruturas inválida");
                        }
                    // ===========================================================

                    // ===========================================================            
                    // variáveis
                        if(!empty($data) && is_array($data))
                        {
                            extract($data);
                        }
                    // ===========================================================

                    // ===========================================================
                    // apresentar as views da app
                        foreach($estruturas as $estrutura)
                        {
                            include("../../core/views/$estrutura.php");
                        }
                    // ===========================================================
                }
            // ===========================================================    

            // ===========================================================
            // Cliente Logado / Customer Logged In
                public static function is_customer_logged_in()
                {
                    // ===========================================================
                    // verifica se existe um customer com session
                        return isset($_SESSION['customer']);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // Admin Logado / Logged In
                public static function is_admin_logged_in()
                {

                    // verifica se existe um admin com session
                        return isset($_SESSION['admin']);
                    // ===========================================================
                }
            // ===========================================================    

            // ===========================================================
            // Criar / created Hash
                public static function generate_password_hash($num_caracteres = 12)
                {
                    // ===========================================================
                    // criar hashes
                        $chars = '01234567890123456789abcdefghijklmnopqrstuwxyzabcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZABCDEFGHIJKLMNOPQRSTUWXYZ';
                        return substr(str_shuffle($chars), 0, $num_caracteres);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // redirect
                public static function redirect($rota = '', $admin = false)
                {
                    // ===========================================================
                    // faz o redirecionamento para a URL desejada (rota)
                        if(!$admin)
                        {
                            // ===========================================================
                            // se não existir admin
                                header("Location: " . BASE_URL . "?a=$rota");
                            // ===========================================================
                        }
                        else
                        {
                            // ===========================================================
                            // se existir admin
                                header("Location: " . BASE_URL . "/admin?a=$rota");
                            // ===========================================================
                        }
                    // ===========================================================
                    
                }
            // ===========================================================

            // ===========================================================
            //  Gerar Codigo Encomenda / order code generator
                public static function order_code_generator()
                {
                    // ===========================================================
                    // gerar um código de order
                        $codigo = "";
                        // AZ123456
                        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $codigo .= substr(str_shuffle($chars),0,2);
                        $codigo .= rand(100000,999999);
                    // ===========================================================

                    // ===========================================================
                    // devolve o codigo de order
                        return $codigo;
                    // ===========================================================
                }
            // ===========================================================
            
            // ===========================================================
            // encriptação / encrypt

            // ===========================================================
            // aes Encriptar / encrypt
                public static function aes_encrypt($valor)
                {
                    // ===========================================================
                    // devolver valor ( encriptado de binario para hexadecimal )
                        return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // aes Desencriptar / decrypt
                public static function aes_decrypt($valor)
                {
                    // ===========================================================
                    // devolver valor (desencriptado de binario para hexadecimal)
                        return openssl_decrypt(hex2bin($valor), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
                    // ===========================================================            
                }
            // ===========================================================    

            // ===========================================================
            // mostrar data / printData 
                public static function printData($data)
                {
                    // =========================================================== 
                    // se $data for um array ou um objecto
                        if(is_array($data) || is_object($data))
                        {
                            // =========================================================== 
                            // Mostra array / objecto formatado
                                echo '<pre>';
                                print_r($data);
                            // =========================================================== 
                        } 
                        else 
                        {
                            // =========================================================== 
                            // Mostra data
                                echo '<pre>';
                                echo $data;
                            // =========================================================== 
                        }
                    // =========================================================== 
                    
                    // ===========================================================
                    // sai do programa 
                        die('<br>TERMINADO');
                    // =========================================================== 
                }
            // ===========================================================        
        }
    // =========================================================== 