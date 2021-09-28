<?php

namespace core\models;

// ===========================================================
// carregar classes
    use core\classes\Database;
    use core\classes\Store;
// ===========================================================

// ===========================================================
// class Customers
    class Customers
    {
        // ===========================================================
        // verificar email existe    
            public function check_email_exists($email)
            {
                // ===========================================================
                // verifica se já existe outra conta com o mesmo email
                // ===========================================================  
                
                // ===========================================================
                // email
                    $parameters = [
                        ':e' => strtolower(trim($email))
                    ];
                // ===========================================================

                // ===========================================================
                // verifica se já existe outra conta com o mesmo email na bd
                    $bd = new Database();
                    $resultados = $bd->select("
                        SELECT email FROM Customers WHERE email = :e
                    ", $parameters);
                // ===========================================================
                
                // ===========================================================
                // se o customer já existe...
                    if (count($resultados) != 0) 
                    {
                        return true;
                    } 
                    else 
                    {
                        return false;
                    }
                // ===========================================================
            }
        // ===========================================================        

        // ===========================================================
        // registar customer
            public function register_customer()
            {
                // ===========================================================
                // cria uma hash para o registo do customer
                    $purl = Store::generate_password_hash();
                // ===========================================================

                // ===========================================================
                // data do customer
                    $parameters = [
                        ':email' => strtolower(trim($_POST['text_email'])),
                        ':pass' => password_hash(trim($_POST['text_pass_1']), PASSWORD_DEFAULT),
                        ':full_name' => trim($_POST['text_full_name']),
                        ':address' => trim($_POST['text_address']),
                        ':city' => trim($_POST['text_city']),
                        ':telephone' => trim($_POST['text_telephone']),
                        ':purl' => $purl,
                        ':ativo' => 0,
                        ':gender' =>  trim($_POST['text_gender']),
                        ':image' =>  trim($_POST['user_image']),
                    ];
                // ===========================================================

                Store::printData($parameters);

                // ===========================================================
                // regista o novo customer na base de data 
                    $bd = new Database(); // criar bd
                    $sql = "
                    INSERT INTO Customers VALUES(
                        0,
                        :email,
                        :pass,
                        :full_name,
                        :address,
                        :city,
                        :telephone,
                        :purl,
                        :ativo,
                        NOW(),
                        NOW(),
                        NULL,
                        :gender,
                        :image
                    )
                ";
                    $bd->insert($sql, $parameters);
                // ===========================================================

               // Store::printData($parameters);
                
                // ===========================================================
                // retorna o purl criado
                    return $purl;
                // ===========================================================
            }
        // ===========================================================    

        // ===========================================================
        // registar customer
        public function register_customer_alfa($text_email_customer ,
        $text_pass_1_customer ,
        $text_full_name_customer ,
        $text_address_customer ,
        $text_city_customer ,
        $text_telephone_customer,
        $text_activo_customer,
        $text_gender_customer,
        $customer_image)
        {
            // ===========================================================
            // cria uma hash para o registo do customer
                $purl = Store::generate_password_hash();
            // ===========================================================

            // ===========================================================
            // data do customer
                $parameters = [
                    ':email' => strtolower(trim($text_email_customer)),
                    ':pass' => password_hash(trim($text_pass_1_customer), PASSWORD_DEFAULT),
                    ':full_name' => trim($text_full_name_customer),
                    ':address' => trim($text_address_customer),
                    ':city' => trim($text_city_customer),
                    ':telephone' => trim( $text_telephone_customer),
                    ':purl' => $purl,
                    ':ativo' =>trim($text_activo_customer),
                    ':gender' =>  trim($text_gender_customer),
                    ':image' =>  trim($customer_image),
                ];
            // ===========================================================

            //Store::printData($parameters);

            // ===========================================================
            // regista o novo customer na base de data 
                $bd = new Database(); // criar bd
                $sql = "
                INSERT INTO Customers VALUES(
                    0,
                    :email,
                    :pass,
                    :full_name,
                    :address,
                    :city,
                    :telephone,
                    :purl,
                    :ativo,
                    NOW(),
                    NOW(),
                    NULL,
                    :gender,
                    :image
                )
            ";
                $bd->insert($sql, $parameters);
            // ===========================================================

           // Store::printData($parameters);
            
            // ===========================================================
            // retorna o purl criado
                return $purl;
            // ===========================================================
        }
    // ===========================================================        
        
        // ===========================================================
        // registar customer admin
            public function register_customer_admin()
            {
                // ===========================================================
                // cria uma hash para o registo do customer
                   // $purl = Store::generate_password_hash();
                // ===========================================================

                // ===========================================================
                // data do customer
                    $parameters = [
                        ':email' => strtolower(trim($_POST['text_email'])),
                        ':pass' => password_hash(trim($_POST['text_pass_1']), PASSWORD_DEFAULT),
                        ':full_name' => trim($_POST['text_full_name']),
                        ':address' => trim($_POST['text_address']),
                        ':city' => trim($_POST['text_city']),
                        ':telephone' => trim($_POST['text_telephone']),
                        ':active' => trim($_POST['text_activo']),
                        ':gender' => trim($_POST['text_gender'])
                    ];
                // ===========================================================

               ////Store::printData($parameters);

                // ===========================================================
                // regista o novo customer na base de data 
                    $bd = new Database(); // criar bd
                    $sql = "
                    INSERT INTO Customers (email, pass, full_name, address, city, telephone, active, created_at, updated_at, deleted_at, gender ) VALUES(
                        :email,
                        :pass,
                        :full_name,
                        :address,
                        :city,
                        :telephone,
                        :active,
                        NOW(),
                        NOW(),
                        NULL,
                        :gender
                    )
                ";
                    $bd->insert($sql, $parameters);
                // ===========================================================

               
                
                // ===========================================================
                // retorna o purl criado
                    //return $purl;
                // ===========================================================
            }
        // ===========================================================      
        
        // ===========================================================
        // registar customer admin
            public function register_customer_admin_modal()
            {
                // ===========================================================
                // cria uma hash para o registo do customer
                // $purl = Store::generate_password_hash();
                // ===========================================================

                // ===========================================================
                // data do customer
                    $parameters = [
                        ':email' => strtolower(trim($_SESSION['data_customer']['text_email'])),
                        ':pass' => password_hash(trim($_SESSION['data_customer']['text_pass_1']), PASSWORD_DEFAULT),
                        ':full_name' => trim($_SESSION['data_customer']['text_full_name']),
                        ':address' => trim($_SESSION['data_customer']['text_address']),
                        ':city' => trim($_SESSION['data_customer']['text_city']),
                        ':telephone' => trim($_SESSION['data_customer']['text_telephone']),
                        ':active' => trim($_SESSION['data_customer']['text_activo']),
                        ':gender' => trim($_SESSION['data_customer']['text_gender']),
                        ':user_image' => trim($_SESSION['data_customer']['user_image'])
                    ];
                // ===========================================================

            //Store::printData($parameters);

                // ===========================================================
                // regista o novo customer na base de data 
                    $bd = new Database(); // criar bd
                    $sql = "
                    INSERT INTO Customers (email, pass, full_name, address, city, telephone, active, created_at, updated_at, deleted_at, gender, image ) VALUES(
                        :email,
                        :pass,
                        :full_name,
                        :address,
                        :city,
                        :telephone,
                        :active,
                        NOW(),
                        NOW(),
                        NULL,
                        :gender,
                        :user_image
                    )
                ";
                    $bd->insert($sql, $parameters);
                // ===========================================================

            
                
                // ===========================================================
                // retorna o purl criado
                    //return $purl;
                // ===========================================================
            }
        // ===========================================================   
        
        // ===========================================================
        // registar customer admin
        public function register_customer_admin_modal_ajax( 
        $text_email_customer, 
        $text_pass_1_customer,
        $text_full_name_customer,
        $text_address_customer,
        $text_city_customer,
        $text_telephone_customer,
        $text_activo_customer,
        $text_gender_customer,
        $user_image
        )
        {

            // ===========================================================
            // data do customer
                $parameters = [
                    ':email' => $text_email_customer, 
                    ':pass' => $text_pass_1_customer,
                    ':full_name' => $text_full_name_customer,
                    ':address' => $text_address_customer,
                    ':city' => $text_city_customer,
                    ':telephone' => $text_telephone_customer,
                    ':active' => $text_activo_customer,
                    ':gender' => $text_gender_customer,
                    ':user_image' => $user_image
                ];
            // ===========================================================            

        //Store::printData($parameters);

            // ===========================================================
            // regista o novo customer na base de data 
                $bd = new Database(); // criar bd
                $sql = "
                INSERT INTO Customers (email, pass, full_name, address, city, telephone, active, created_at, updated_at, deleted_at, gender, image ) VALUES(
                    :email,
                    :pass,
                    :full_name,
                    :address,
                    :city,
                    :telephone,
                    :active,
                    NOW(),
                    NOW(),
                    NULL,
                    :gender,
                    :user_image
                )
            ";
                $bd->insert($sql, $parameters);
            // ===========================================================

        
            
            // ===========================================================
            // retorna o purl criado
                //return $purl;
            // ===========================================================
        }
    // ===========================================================         

        // ===========================================================
        // validar email
            public function validate_email($purl)
            {
                // ===========================================================
                // validar o email do novo customer
                // ===========================================================

                // ===========================================================
                // vai buscar data do customer com o purl indicado
                    $bd = new Database(); // criar a bd
                    $parameters = [
                        ':purl' => $purl
                    ];
                    $resultados = $bd->select("
                        SELECT * FROM Customers 
                        WHERE purl = :purl
                    ", $parameters);
                // ===========================================================

                // ===========================================================
                // verifica se foi encontrado o customer
                    if (count($resultados) != 1) 
                    {
                        // ===========================================================
                        // devolve false
                            return false;
                        // ===========================================================
                    }
                // ===========================================================

                // ===========================================================
                // foi encontrado este customer com o purl indicado
                    $id_customer = $resultados[0]->id_customer;
                // ===========================================================

                // ===========================================================
                // atualizar os data do customer
                    $parameters = [
                        ':id_customer' => $id_customer
                    ];
                    $bd->update("
                        UPDATE Customers SET
                        purl = NULL,
                        active = 1,
                        updated_at = NOW()
                        WHERE id_customer = :id_customer
                    ", $parameters);
                // ===========================================================

                // ===========================================================
                // devolve true
                    return true;
                // ===========================================================
            }
        // ===========================================================        

        // ===========================================================
        // validar login
            public function validate_login($user, $pass)
            {
                // ===========================================================
                // verificar se o login é válido
                // ===========================================================

                // ===========================================================
                // vai buscar data do utilizador com o email indicado
                    $parameters = [
                        ':user' => $user
                    ];

                    $bd = new Database();
                    $resultados = $bd->select("
                        SELECT * FROM Customers 
                        WHERE email = :user 
                        AND active = 1 
                        AND deleted_at IS NULL
                    ", $parameters);
                // ===========================================================

                // ===========================================================
                // verificar se o login é válido
                    if (count($resultados) != 1) 
                    {
                        // ===========================================================
                        // não existe user
                            return false;
                        // ===========================================================
                    } 
                    else 
                    {
                        // ===========================================================
                        // existe user
                            $user = $resultados[0];
                        // ===========================================================

                        // ===========================================================
                        // verificar a password do user
                            if (!password_verify($pass, $user->pass)) 
                            {
                                // ===========================================================
                                // password inválida
                                    return false;
                                // ===========================================================
                            } 
                            else 
                            {
                                // ===========================================================
                                // login válido
                                    return $user;
                                // ===========================================================
                            }
                        // ===========================================================
                    }
                // ===========================================================
            }
        // ===========================================================        

        // ===========================================================
        // buscar data customer
            public function search_data_customer($id_customer)
            {
                // ===========================================================
                // vai buscar data do customer com o id indicado
                    $parameters = [
                        'id_customer' => $id_customer
                    ];

                    $bd = new Database();
                    $resultados = $bd->select("
                        SELECT 
                            *
                        FROM Customers 
                        WHERE id_customer = :id_customer
                    ", $parameters);
                // ===========================================================

                // ===========================================================
                // devolve resultados
                    return $resultados[0];
                // ===========================================================
            }
        // ===========================================================        

        // ===========================================================
        // verificar se email existe noutra conta
            public function check_if_email_exists_in_another_account($id_customer, $email)
            {
                // ===========================================================
                // verificar se existe a conta de email noutra conta de customer
                    $parameters = [
                        ':email' => $email,
                        ':id_customer' => $id_customer
                    ];
                    $bd = new Database();
                    $resultados = $bd->select("
                        SELECT id_customer
                        FROM Customers
                        WHERE id_customer <> :id_customer
                        AND email = :email
                    ",$parameters);
                // ===========================================================

                // ===========================================================
                // se existirem resultados
                    if(count($resultados) != 0)
                    {
                        // ===========================================================
                        //devolve true
                            return true;
                        // ===========================================================
                    } 
                    else 
                    {
                        // ===========================================================
                        //devolve false                    
                            return false;
                        // ===========================================================
                    }
                // ===========================================================
            }
        // ===========================================================

        // ===========================================================
        // verificar se email existe noutra conta
        public function check_if_email_exists_in_another_account_alfa($email)
        {
            // ===========================================================
            // verificar se existe a conta de email noutra conta de customer
                $parameters = [
                    ':email' => $email
                ];
                $bd = new Database();
                $resultados = $bd->select("
                    SELECT id_customer
                    FROM Customers
                    WHERE email = :email
                ",$parameters);
            // ===========================================================

            // ===========================================================
            // se existirem resultados
                if(count($resultados) != 0)
                {
                    // ===========================================================
                    //devolve true
                        return true;
                    // ===========================================================
                } 
                else 
                {
                    // ===========================================================
                    //devolve false                    
                        return false;
                    // ===========================================================
                }
            // ===========================================================
        }
    // ===========================================================        

        // ===========================================================
        // atualizar data session customer
            public function update_data_customer($email, $full_name, $address, $city, $telephone)
            {
                // ===========================================================
                // atualiza os data do customer indicados na bd
                    $parameters = [
                        ':id_customer' => $_SESSION['customer'],
                        ':email' => $email,
                        ':full_name' => $full_name,
                        ':address' => $address,
                        ':city' => $city,
                        ':telephone' => $telephone
                    ];

                    $bd = new Database();

                    $bd->update("
                        UPDATE Customers
                        SET
                            email = :email,
                            full_name = :full_name,
                            address = :address,
                            city = :city,
                            telephone = :telephone,
                            updated_at = NOW()
                        WHERE id_customer = :id_customer
                    ", $parameters);
                // ===========================================================
            }
        // ===========================================================

        // ===========================================================
        // atualizar data customer
            public function update_customer($id_customer,$email, $full_name, $address, $city, $telephone, $image)
            {
                // ===========================================================
                // atualiza os data do customer indicados na bd
                    $parameters = [
                        ':id_customer' => $id_customer,
                        ':email' => $email,
                        ':full_name' => $full_name,
                        ':address' => $address,
                        ':city' => $city,
                        ':telephone' => $telephone,
                        ':image' => $image,
                    ];

                    $bd = new Database();

                    $bd->update("
                        UPDATE Customers
                        SET
                            email = :email,
                            full_name = :full_name,
                            address = :address,
                            city = :city,
                            telephone = :telephone,
                            updated_at = NOW(),
                            image = :image
                        WHERE id_customer = :id_customer
                    ", $parameters);
                // ===========================================================
                //Store::printData($parameters);

            }
        // ===========================================================  
        
        

        // ===========================================================
        // atualizar data customer
        public function update_customer_alfa($id_customer, $email_customer, $pass_1_customer, 
        $full_name_customer, $address_customer, $city_customer, $telephone_customer, $activo_customer,
        $gender_customer,  $image_customer)
        {
            // ===========================================================
            // atualiza os data do customer indicados na bd
                $parameters = [
                    ':id_customer' => $id_customer,
                    ':email' => $email_customer,
                    ':pass' => password_hash($pass_1_customer, PASSWORD_DEFAULT),
                    ':full_name' => $full_name_customer,
                    ':address' => $address_customer,
                    ':city' => $city_customer,
                    ':telephone' => $telephone_customer,
                    ':active' => trim($activo_customer),
                    ':gender' => trim($gender_customer),
                    ':image' => $image_customer,
                ];

                //Store::printData($parameters);

                $bd = new Database();

                $bd->update("
                    UPDATE Customers
                    SET
                        email = :email,
                        pass = :pass,
                        full_name = :full_name,
                        address = :address,
                        city = :city,
                        telephone = :telephone,
                        active = :active,
                        gender = :gender, 
                        updated_at = NOW(),
                        image = :image
                    WHERE id_customer = :id_customer
                ", $parameters);
            }
            // ===========================================================        

        // ===========================================================
        // ver se pass esta correta
            public function check_if_password_is_correct($id_customer, $pass_atual)
            {
                // ===========================================================
                // verifica se a pass atual está correta (de acordo com o que está na base de data)
                // ===========================================================

                // ===========================================================
                // vai buscar a pass do customer com o id indicado à BD 
                    $parameters = [
                        ':id_customer' => $id_customer            
                    ];

                    $bd = new Database();
                    $pass_na_bd = $bd->select("
                        SELECT pass 
                        FROM Customers 
                        WHERE id_customer = :id_customer
                    ", $parameters)[0]->pass;
                // ===========================================================

                // ===========================================================
                // verificar se a pass indicada corresponde à pass na bd
                    return password_verify($pass_atual, $pass_na_bd);
                // ===========================================================
            }
        // ===========================================================

        // ===========================================================
        // atualizar a nova pass
            public function update_new_password($id_customer, $nova_pass)
            {
                // ===========================================================
                // atualização da pass do customer
                    $parameters = [
                        ':id_customer' => $id_customer,
                        ':nova_pass' => password_hash($nova_pass, PASSWORD_DEFAULT)
                    ];

                    $bd = new Database();
                    $bd->update("
                        UPDATE Customers
                        SET
                            pass = :nova_pass,
                            updated_at = NOW()
                        WHERE id_customer = :id_customer
                    ", $parameters);
                // ===========================================================
            }
        // ===========================================================    
    }
// ===========================================================
