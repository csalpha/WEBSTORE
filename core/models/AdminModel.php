<?php

namespace core\models;

// ===========================================================
// carregar classes
use core\classes\Database;
use core\classes\Store;
use core\controllers\Admin;
// ===========================================================

// ===========================================================
// class Admin Model
    class AdminModel
    {
        
        // ===========================================================
        // Customer
            // ===========================================================
            // lista Customers
                public function customers_list($filtro)
                {
                    // ===========================================================
                    // vai buscar todos os Customers registados na base de data
                        $bd = new Database(); // criar bd
                        $sql = "
                        SELECT 
                            Customers.id_customer,
                            Customers.email,
                            Customers.full_name,
                            Customers.telephone,
                            Customers.active,
                            Customers.deleted_at,
                            Customers.image,
                            Customers.city,
                            Customers.telephone,
                            Customers.address,

                        COUNT(orders.id_order) total_orders
                        FROM Customers LEFT JOIN orders
                        ON Customers.id_customer = orders.id_customer
                        ";
                    // ===========================================================

                    // ===========================================================
                    //  avaliar filtro
                        if ($filtro != '') 
                        {
                            $sql .= " where Customers.active = $filtro";
                        }

                        $sql .= " GROUP BY Customers.id_customer";

                        //Store::printData($sql);
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $bd->select($sql);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // total customers masc
                public function total_customers_masc()
                {
                    // ===========================================================
                    // vai buscar a quantity de customers masc
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total FROM Customers
                            WHERE gender = 'M'
                        ");
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // total customers femi
                public function total_customers_femi()
                {
                    // ===========================================================
                    // vai buscar a quantity de customers masc
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total FROM Customers
                            WHERE gender = 'F'
                        ");
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // buscar customer
                public function search_customer($id_customer)
                {
                    // ===========================================================
                    // buscar data do customer com o respectivo id
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
            // buscar customer
                public function search_customer_admin($id_customer)
                {
                    // ===========================================================
                    // buscar data do customer com o respectivo id
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
                       // return $resultados[0];
                        return $resultados[0];

                    // ===========================================================
                }
            // ===========================================================            

            // ===========================================================
            // total orders do customer
                public function total_orders_customer($id_customer)
                {
                    // ===========================================================
                    // vai buscar total de orders do customer
                        $parameters = [
                            'id_customer' => $id_customer
                        ];
                        $bd = new Database(); // criar bd
                        return $bd->select("
                            SELECT COUNT(*) total 
                            FROM orders 
                            WHERE id_customer = :id_customer
                        ", $parameters)[0]->total;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // buscar orders por id_order
                public function search_order($id_order)
                {
                    // ===========================================================
                    // buscar todas as orders do order indicado
                        $parameters = [
                            ':id_order' => $id_order
                        ];
                        $bd = new Database();
                        return $bd->select("
                            SELECT * FROM orders WHERE id_order = :id_order
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // buscar orders do customer
                public function search_orders_customer($id_customer)
                {
                    // ===========================================================
                    // buscar todas as orders do customer indicado
                        $parameters = [
                            ':id_customer' => $id_customer
                        ];
                        $bd = new Database();
                        return $bd->select("
                            SELECT * FROM orders WHERE id_customer = :id_customer
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // atualizar o status do customer
                public function update_customer_status($id_customer, $estado)
                {
                    // ===========================================================
                    // atualizar o estado da order
                        $parameters = [
                            ':id_customer' => $id_customer,
                            ':active' => $estado
                        ];
                        $bd = new Database(); // criar bd
                        $bd->update("
                            UPDATE Customers
                            SET
                                active = :active,
                                updated_at = NOW()
                            WHERE id_customer = :id_customer
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================  
            
            // ===========================================================
            // ver se pass esta correta
                public function check_if_password_is_correct_customer($id_customer, $pass_atual)
                {
                    // ===========================================================
                    // verifica se a pass atual está correta (de acordo com o que está na base de data)
                    // ===========================================================

                    // ===========================================================
                    // vai buscar a pass do admin com o id indicado à BD 
                        $parameters = [
                            ':id_customer' => $id_customer            
                        ];

                        $bd = new Database();
                        $pass_na_bd = $bd->select("
                            SELECT pass 
                            FROM customers 
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
                public function update_new_password_customer($id_customer, $nova_pass_customer)
                {
                    // ===========================================================
                    // atualização da pass do admin
                        $parameters = [
                            ':id_customer' => $id_customer,
                            ':nova_pass' => password_hash($nova_pass_customer, PASSWORD_DEFAULT)
                        ];
                    
                        $bd = new Database();
                        $bd->update("
                            UPDATE customers
                            SET
                                pass = :nova_pass,
                                updated_at = NOW()
                            WHERE id_customer = :id_customer
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================  
            
            // ===========================================================
            // registar customer
                public function delete_customer($id_customer)
                {
                    // ===========================================================
                    // cria uma hash para o registo do customer
                    // $purl = Store::generate_password_hash();
                    // ===========================================================

                    // ===========================================================
                    // data do admin
                        $parameters = [
                            ':id_customer' => strtolower(trim($id_customer)),
                        ];
                    // ===========================================================

                        

                    // ===========================================================
                    // regista o novo admin na base de data 
                        $bd = new Database(); // criar bd
                        $sql = "DELETE FROM Customers 
                        WHERE id_customer = :id_customer";
                        $bd->delete($sql, $parameters);
                    // ===========================================================
                    //Store::printData($bd);
                    // ===========================================================
                    // retorna o purl criado
                        //return $purl;
                    // ===========================================================
                }
            // =========================================================== 
        // ===========================================================

        // ===========================================================
        // ENCOMENDAS
            // ===========================================================
            // total orders pendentes
                public function total_orders_pending()
                {
                    // ===========================================================
                    // vai buscar a quantity de orders pendentes
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total FROM orders
                            WHERE status = 'PENDENT'
                        ");
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================

                 // ===========================================================
                // buscar data order
                    public function search_data_order($id_order)
                    {
                        // ===========================================================
                        // vai buscar data do admin com o id indicado
                            $parameters = [
                                'id_order' => $id_order
                            ];

                            $bd = new Database();
                            $resultados = $bd->select("
                                SELECT 
                            *
                                FROM orders 
                                WHERE id_order = :id_order
                            ", $parameters);
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0];
                    // ===========================================================
                }
            // ===========================================================            

            // ===========================================================
            // total orders em processamento
                public function total_orders_in_processing()
                {
                    // ===========================================================
                    // vai buscar a quantity de orders em processamento
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total FROM orders
                            WHERE status = 'PROCESSING'
                        ");
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // lista orders
                public function orders_list($filtro, $id_customer)
                {
                    // ===========================================================
                    // vai buscar lista de orders do id indicado
                        $bd = new Database();
                        $sql = "SELECT e.*, c.full_name FROM orders e 
                        LEFT JOIN Customers c ON e.id_customer = c.id_customer WHERE 1";
                    // ===========================================================

                    // ===========================================================
                    //  avaliar filtro
                        if ($filtro != '') 
                        {
                            $sql .= " AND e.status = '$filtro'";
                        }
                    // ===========================================================

                    // ===========================================================
                    // avaliar se o id do customer não esta vazio
                        if(!empty($id_customer))
                        {
                            // ===========================================================
                            // filtro por id do customer
                                $sql .= " AND e.id_customer = $id_customer";
                            // ===========================================================
                        }
                    // ===========================================================
                    
                    // ===========================================================
                    // filtro por id da order
                        $sql .= " ORDER BY e.id_order DESC";
                    // ===========================================================

                    // ===========================================================
                    // devolve lista de orders
                        return $bd->select($sql);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // buscar detalhes order
                public function search_order_details($id_order)
                {
                    // ===========================================================
                    // vai buscar os data da order
                        $parameters = [
                            ':id_order' => $id_order
                        ];
                        $bd = new Database();
                        $data_order = $bd->select("
                            SELECT Customers.full_name, orders.* 
                            FROM Customers, orders 
                            WHERE orders.id_order = :id_order
                            AND Customers.id_customer = orders.id_customer
                            ", $parameters);
                    // ===========================================================
                    
                    // ===========================================================
                    // vai buscar lista de products da order
                        $products_list = $bd->select("
                            SELECT * 
                            FROM order_product 
                            WHERE id_order = :id_order", $parameters);
                    // ===========================================================
                    
                    // ===========================================================
                    // devolve os data da order e a respectiva lista products
                        return [
                            'order' => $data_order[0],
                            'products_list' => $products_list
                        ];
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // atualizar status order
                public function update_order_status($id_order, $estado)
                {
                    // ===========================================================
                    // atualizar o estado da order com o id e estado indicados
                        $bd = new Database();

                        $parameters = [
                            ':id_order' => $id_order,
                            ':status' => $estado
                        ];

                        $bd->update("
                            UPDATE orders
                            SET
                                status = :status,
                                updated_at = NOW()
                            WHERE id_order = :id_order
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // delete order
                public function delete_order($id_order)
                {
                    // ===========================================================
                    // cria uma hash para o registo do customer
                    // $purl = Store::generate_password_hash();
                    // ===========================================================

                    // ===========================================================
                    // data do admin
                        $parameters = [
                            ':id_order' => strtolower(trim($id_order)),
                        ];
                    // ===========================================================

                        

                    // ===========================================================
                    // regista o novo admin na base de data 
                        $bd = new Database(); // criar bd
                        $sql = "DELETE FROM orders 
                        WHERE id_order = :id_order";
                        $bd->delete($sql, $parameters);
                    // ===========================================================
                    //Store::printData($bd);
                    // ===========================================================
                    // retorna o purl criado
                        //return $purl;
                    // ===========================================================
                }
            // ===========================================================             
        // ===========================================================

        // ===========================================================
        // PRODUCTS
            // ===========================================================
            // lista products
                public function products_list($filtro)
                {
                    // ===========================================================
                    // vai buscar todos os products registados na base de data
                        $bd = new Database();
                        $sql = "
                        SELECT 
                            *
                        FROM products 
                        ";
                    // ===========================================================

                    // ===========================================================
                    //  avaliar filtro
                        if ($filtro != '') 
                        {
                            $sql .= " where products.active = $filtro";
                        }

                        $sql .= " GROUP BY products.id_product";
                    
                        //Store::printData($sql);
                    // ===========================================================                    

                    // ===========================================================
                    // devolve resultados
                        return $bd->select($sql);
                    // ===========================================================
                }
            // =========================================================== 

            // ===========================================================
            // buscar products
                public function search_product($id_product)
                {
                    // ===========================================================
                    // vai buscar os data do product com o id indicado à bd 
                        $parameters = [
                            'id_product' => $id_product
                        ];
                        $bd = new Database();
                        $resultados = $bd->select("
                                SELECT 
                                    *
                                FROM products 
                                WHERE id_product = :id_product
                            ", $parameters);
                    // ===========================================================

                    // ===========================================================
                    //  devolve resultados
                        return $resultados[0];
                    // ===========================================================
                }
            // ===========================================================    
            
            // ===========================================================
            // atualizar status product
                public function update_product_status($id_product, $estado)
                {
                    // ===========================================================
                    // atualizar o estado da order
                        $parameters = [
                            ':id_product' => $id_product,
                            ':active' => $estado
                        ];

                        $bd = new Database();
                        $bd->update("
                            UPDATE products
                            SET
                                active = :active,
                                updated_at = NOW()
                            WHERE id_product = :id_product
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================  

            // ===========================================================
            // atualizar status product
                public function update_product_category($id_product, $estado)
                {
                    // ===========================================================
                    // atualizar o estado da order
                        $parameters = [
                            ':id_product' => $id_product,
                            ':active' => $estado
                        ];

                        $bd = new Database();
                        $bd->update("
                            UPDATE products
                            SET
                                active = :active,
                                updated_at = NOW()
                            WHERE id_product = :id_product
                        ", $parameters);
                    // ===========================================================
                }
            // =========================================================== 

            // ===========================================================
            // total orders em processamento
                public function count_products_category($category)
                {
                    $parameters = [
                        'category' => $category
                    ];
                    $bd = new Database(); // criar bd

                    // ===========================================================
                    // vai buscar a quantity de orders em processamento
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total 
                            FROM products
                            WHERE category = :category
                        ", $parameters);
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // delete product
                public function delete_product($id_product)
                {
                    // ===========================================================
                    // data do admin
                        $parameters = [
                            ':id_product' => strtolower(trim($id_product)),
                        ];
                    // ===========================================================

                    // ===========================================================
                    // regista o novo admin na base de data 
                        $bd = new Database(); // criar bd
                        $sql = "DELETE FROM Products 
                        WHERE id_product = :id_product";
                        $bd->delete($sql, $parameters);
                    // ===========================================================
                }
            // ===========================================================             

        // ===========================================================
        
        // ===========================================================
        // ADMINS
            // ===========================================================
            // validar login ADMIN
                public function validate_login($user_admin, $pass)
                {
                    // ===========================================================
                    // verificar se o login é válido
                    // ===========================================================

                    // ===========================================================
                    // vai buscar data do admin com o email indicado
                        $parameters = [
                            ':user_admin' => $user_admin
                        ];

                        $bd = new Database(); // criar bd
                        $resultados = $bd->select("
                            SELECT * FROM admins 
                            WHERE user = :user_admin 
                            AND deleted_at IS NULL
                        ", $parameters);
                    // ===========================================================

                    // ===========================================================
                    // verifica se existem ou não resultados
                        if (count($resultados) != 1) 
                        {
                            // ===========================================================
                            // não existe user admin
                                return false;
                            // ===========================================================
                        } 
                        else 
                        {
                            // ===========================================================
                            // temos user admin. Vamos ver a sua password
                                $user_admin = $resultados[0];
                            // ===========================================================

                            // ===========================================================
                            // verificar a password
                                if (!password_verify($pass, $user_admin->pass)) 
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
                                        return $user_admin;
                                    // ===========================================================
                                }
                            // ===========================================================
                        }
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // lista admins
                public function admins_list($filtro)
                {
                    // ===========================================================
                    // vai buscar todos os admins registados na base de data
                        $bd = new Database();
                        $sql = "SELECT * FROM admins";
                    // ===========================================================

                    // ===========================================================
                    //  avaliar filtro
                        if ($filtro != '') 
                        {
                            $sql .= " where admins.active = $filtro";
                        }

                        $sql .= " GROUP BY admins.id_admin";
                    
                        //Store::printData($sql);
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $bd->select($sql);
                    // ===========================================================
                }
            // ===========================================================     

            // ===========================================================
            // total admins masc
                public function total_admins_masc()
                {
                    // ===========================================================
                    // vai buscar a quantity de customers masc
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total FROM admins
                            WHERE gender = 'M'
                        ");
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // total admins femi
                public function total_admins_femi()
                {
                    // ===========================================================
                    // vai buscar a quantity de customers masc
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT COUNT(*) total FROM admins
                            WHERE gender = 'F'
                        ");
                    // ===========================================================

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0]->total;
                    // ===========================================================
                }
            // ===========================================================            
            
            // ===========================================================
            // buscar admin
                public function search_admin($id_admin)
                {
                    // ===========================================================
                    // vai buscar data do admin registados na base de data
                        $parameters = [
                            'id_admin' => $id_admin
                        ];

                        $bd = new Database();
                        $resultados = $bd->select("
                                SELECT 
                                    *
                                FROM admins 
                                WHERE id_admin = :id_admin
                            ", $parameters);
                    // ===========================================================

                    

                    // ===========================================================
                    // devolve resultados
                        return $resultados[0];
                        //Store::printData($resultados);
                    // ===========================================================
                }
            // ===========================================================    

            // ===========================================================
            // atualizar status admin
                public function update_status_admin($id_admin, $estado)
                {
                    // ===========================================================
                    // atualizar o estado da order
                        $parameters = [
                            ':id_admin' => $id_admin,
                            ':active' => $estado
                        ];

                        $bd = new Database();
                        $bd->update("
                            UPDATE admins
                            SET
                                active = :active,
                                updated_at = NOW()
                            WHERE id_admin = :id_admin
                        ", $parameters);
                    // ===========================================================
                }
            // =========================================================== 

            // ===========================================================
            // atualizar data session admin
                public function update_admin(
                    $id_admin, 
                    $email_admin, 
                    $pass_1_admin, 
                    $full_name_admin, 
                    $address_admin, 
                    $city_admin, 
                    $telephone_admin, 
                    $activo_admin, 
                    $gender_admin,  
                    $image_admin)
                {
                    // ===========================================================
                    // dados do admin
                        $parameters = [
                            ':id_admin' => trim($id_admin),
                            ':user' => strtolower(trim($email_admin)),
                            ':pass' => password_hash(trim($pass_1_admin), PASSWORD_DEFAULT),
                            ':full_name' => trim($full_name_admin),
                            ':address' => trim($address_admin),
                            ':city' => trim($city_admin),
                            ':telephone' => trim($telephone_admin),
                            ':active' => trim($activo_admin),
                            ':gender' => trim($gender_admin),
                            ':image' => trim($image_admin)
                        ];
                    // ===========================================================

                        //Store::printData($parameters);

                        $bd = new Database();

                        $bd->update("
                            UPDATE admins
                            SET
                                user = :user,
                                pass = :pass,
                                full_name = :full_name,
                                address = :address,
                                city = :city,
                                telephone = :telephone,
                                active = :active,
                                gender = :gender, 
                                updated_at = NOW(),
                                image = :image
                            WHERE id_admin = :id_admin
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================  

            // ===========================================================
            // ver se pass esta correta
                public function check_if_password_is_correct_admin($id_admin, $pass_atual)
                {
                    // ===========================================================
                    // verifica se a pass atual está correta (de acordo com o que está na base de data)
                    // ===========================================================

                    // ===========================================================
                    // vai buscar a pass do admin com o id indicado à BD 
                        $parameters = [
                            ':id_admin' => $id_admin            
                        ];

                        $bd = new Database();
                        $pass_na_bd = $bd->select("
                            SELECT pass 
                            FROM admins 
                            WHERE id_admin = :id_admin
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
                public function update_new_password_admin($id_admin, $nova_pass_admin)
                {
                    // ===========================================================
                    // atualização da pass do admin
                        $parameters = [
                            ':id_admin' => $id_admin,
                            ':nova_pass' => password_hash($nova_pass_admin, PASSWORD_DEFAULT)
                        ];
                    
                        $bd = new Database();
                        $bd->update("
                            UPDATE admins
                            SET
                                pass = :nova_pass,
                                updated_at = NOW()
                            WHERE id_admin = :id_admin
                        ", $parameters);
                    // ===========================================================
                }
            // ===========================================================     
            
            // ===========================================================
            // verificar email existe    
                public function check_email_exists_admin($email)
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
                            SELECT user FROM Admins WHERE user = :e
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
            // registar admin
                public function register_admin_modal(
                                        $text_email_admin ,
                                        $text_pass_1_admin ,
                                        $text_full_name_admin ,
                                        $text_address_admin ,
                                        $text_city_admin ,
                                        $text_telephone_admin,
                                        $text_activo_admin,
                                        $text_gender_admin,
                                        $user_image)
                {
                    // ===========================================================
                    // cria uma hash para o registo do customer
                    // $purl = Store::generate_password_hash();
                    // ===========================================================

                    // ===========================================================
                    // data do admin
                        $parameters = [
                            ':user' => strtolower(trim($text_email_admin)),
                            ':pass' => password_hash(trim($text_pass_1_admin), PASSWORD_DEFAULT),
                            ':full_name' => trim($text_full_name_admin),
                            ':address' => trim($text_address_admin),
                            ':city' => trim($text_city_admin),
                            ':telephone' => trim($text_telephone_admin),
                            ':active' => trim($text_activo_admin),
                            ':gender' => trim($text_gender_admin),
                            ':user_image' => trim($user_image)
                        ];
                    // ===========================================================

                    // ===========================================================
                    // regista o novo admin na base de data 
                        $bd = new Database(); // criar bd
                        $sql = "
                        INSERT INTO Admins (user, pass, full_name, address, city, telephone, active, created_at,  gender, image, created_at ) 
                        VALUES(:user,:pass,:full_name,:address,:city,:telephone,:active, :gender, :user_image,NOW());";
                        $bd->insert($sql, $parameters);

                    //  Store::printData($bd);
                    // ===========================================================
                    //Store::printData($bd);
                    // ===========================================================
                    // retorna o purl criado
                        //return $purl;
                    // ===========================================================
                }
            // ===========================================================               

            // ===========================================================
            // apagar admin
                public function delete_admin($id_admin)
                {
                    // ===========================================================
                    // data do admin
                        $parameters = [
                            ':id_admin' => strtolower(trim($id_admin)),
                        ];
                    // ===========================================================

                        

                    // ===========================================================
                    // regista o novo admin na base de data 
                        $bd = new Database(); // criar bd
                        $sql = "DELETE FROM Admins 
                        WHERE id_admin = :id_admin";
                        $bd->delete($sql, $parameters);
                    // ===========================================================
                }
            // ===========================================================     
            
            // ===========================================================
            // verificar se email existe noutra conta
                public function check_if_email_exists_in_another_account_admin($id_admin, $user)
                {
                    // ===========================================================
                    // verificar se existe a conta de email noutra conta de admin
                        $parameters = [
                            ':user' => $user,
                            ':id_admin' => $id_admin
                        ];
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT id_admin
                            FROM Admins
                            WHERE id_admin <> :id_admin
                            AND user = :user
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
                public function check_if_email_exists_in_another_account_admin_alfa($user)
                {
                    // ===========================================================
                    // verificar se existe a conta de email noutra conta de admin
                        $parameters = [
                            ':user' => $user
                        ];
                        $bd = new Database();
                        $resultados = $bd->select("
                            SELECT id_admin
                            FROM Admins
                            WHERE user = :user
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
            // registar admin
                // public function register_admin()
                // {
                //     // ===========================================================
                //     // cria uma hash para o registo do customer
                //     // $purl = Store::generate_password_hash();
                //     // ===========================================================

                //     // ===========================================================
                //     // data do admin
                //         $parameters = [
                //             ':user' => strtolower(trim($_POST['text_email'])),
                //             ':pass' => password_hash(trim($_POST['text_pass_1']), PASSWORD_DEFAULT),
                //             ':full_name' => trim($_POST['text_full_name']),
                //             ':address' => trim($_POST['text_address']),
                //             ':city' => trim($_POST['text_city']),
                //             ':telephone' => trim($_POST['text_telephone']),
                //             ':active' => trim($_POST['text_activo']),
                //             ':gender' => trim($_POST['text_gender'])
                //         ];
                //     // ===========================================================

                        

                //     // ===========================================================
                //     // regista o novo admin na base de data 
                //         $bd = new Database(); // criar bd
                //         $sql = "
                //             INSERT INTO Admins (user, pass, full_name, address, city, telephone, active, created_at, updated_at, deleted_at, gender ) 
                //                         VALUES(:user,:pass,:full_name,:address,:city,:telephone,:active,NOW(),NOW(),NULL,:gender)";
                //         $bd->insert($sql, $parameters);
                //     // ===========================================================
                //     //Store::printData($bd);
                //     // ===========================================================
                //     // retorna o purl criado
                //         //return $purl;
                //     // ===========================================================
                // }
            // ===========================================================     

        // ===========================================================
    }
// ===========================================================
