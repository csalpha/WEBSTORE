<?php

namespace core\models;

// ================================================================
// carregar classes
    use core\classes\Database;
    use core\classes\Store;
// ================================================================

// ================================================================
// class Orders
    class Orders
    {
        // ================================================================
        // guardar order
            public function save_order($data_order, $data_products)
            {
                $bd = new Database();

                // ================================================================
                // define array com os data da order
                    $parameters = [
                        ':id_customer' => $_SESSION['customer'],
                        ':address' => $data_order['address'],
                        ':city' => $data_order['city'],
                        ':email' => $data_order['email'],
                        ':telephone' => $data_order['telephone'],
                        ':order_code' => $data_order['order_code'],
                        ':status' => $data_order['status'],
                        ':message' => $data_order['message'],
                        ':full_name' => $data_order['full_name']
                    ];
                // ================================================================

                //Store::printData($_SESSION['customer']);

                // ================================================================
                // insere data da order na bd
                    $bd->insert("
                    INSERT INTO Orders (id_customer,order_date, address,city, email, telephone, order_code, status, message,full_name,created_at,
                    updated_at )  
                    VALUES             ( :id_customer, NOW(), :address,:city,:email,:telephone,:order_code,:status,:message,:full_name, NOW(),
                    NOW())"
                    , $parameters);
                // ================================================================
                
                // ================================================================
                // buscar o id da  ultima order
                    $id_order = $bd->select("
                        SELECT MAX(id_order) id_order 
                        FROM orders
                    ")[0]->id_order;
                // ================================================================

                // ================================================================
                // guardar os data dos products
                    foreach ($data_products as $product) 
                    {
                        // ================================================================
                        // define array com os data dos products da order
                            $parameters = [
                                ':id_order' => $id_order,
                                ':product_name' => $product['product_name'],
                                ':unit_price' => $product['unit_price'],
                                ':quantity' => $product['quantity'],
                            ];
                        // ================================================================

                        // ================================================================
                        // insere data do(s) product(s) da order na bd
                            $bd->insert("
                            INSERT INTO order_product VALUES(
                                0,
                                :id_order,
                                :product_name,
                                :unit_price,
                                :quantity,
                                NOW()
                            )", $parameters);
                        // ================================================================
                    }
                // ================================================================
            }
        // ================================================================

        // ================================================================
        // buscar historico de orders
            public function search_order_history($id_customer)
            {
                // ================================================================
                // id do customer
                    $parameters = [
                        ':id_customer' => $id_customer
                    ];
                // ================================================================

                // ================================================================
                // buscar o histórico de orders do customer 
                    $bd = new Database();
                    $resultados = $bd->select("
                        SELECT *
                        FROM orders
                        WHERE id_customer = :id_customer
                        ORDER BY order_date DESC
                    ", $parameters);
                // ================================================================

                // ================================================================
                // devolve historico de orders do customer
                    return $resultados;
                // ================================================================
            }
        // ================================================================

        // ================================================================
        // verificar order customer
            public function check_customer_order($id_customer, $id_order)
            {
                // ================================================================
                // data da order do customer
                    $parameters = [
                        ':id_customer' => $id_customer,
                        ':id_order' => $id_order
                    ];
                // ================================================================

                // ================================================================
                // verificar se a order pertence ao customer identificado
                    $bd = new Database();
                    $resultado = $bd->select("
                        SELECT *
                        FROM orders
                        WHERE id_order = :id_order
                        AND id_customer = :id_customer
                    ", $parameters);
                // ================================================================
                
                // ================================================================
                // verificar se a order pertence ao customer identificado
                    return count($resultado) == 0 ? false : true;
                // ================================================================
            }
        // ================================================================

        // ================================================================
        //  detalhes de order
            public function order_details($id_customer, $id_order)
            {
                // ================================================================
                // data da order
                    $parameters = 
                    [
                        ':id_customer' => $id_customer,
                        ':id_order' => $id_order
                    ];
                // ================================================================ 

                // ================================================================
                // vai buscar os data da order e a lista dos products da order
                    $bd = new Database(); // criar bd
                    $data_order = $bd->select("
                        SELECT *
                        FROM orders
                        WHERE id_customer = :id_customer
                        AND id_order = :id_order
                    ", $parameters)[0];
                // ================================================================

                // ================================================================
                // id da order
                    $parameters = [
                        ':id_order' => $id_order
                    ];
                // ================================================================

                // ================================================================
                // vai buscar os data da lista de products da order
                    $order_products = $bd->select("
                        SELECT *
                        FROM order_product
                        WHERE id_order = :id_order
                    ", $parameters);
                // ================================================================
                            
                // ================================================================
                // devolver ao controlador os data do detalhe da order
                    return [
                        'data_order' => $data_order,
                        'order_products' => $order_products
                    ];
                // ================================================================
            }
        // ================================================================

        // ================================================================
        // efetuar pagamento
            public function make_payment($order_code)
            {
                // ================================================================
                // codigo da order
                    $parameters = [
                        ':order_code' => $order_code
                    ];
                // ================================================================

                // ================================================================
                // vai buscar os data da order
                    $bd = new Database(); // criar bd
                    $resultado = $bd->select("
                        SELECT * FROM orders 
                        WHERE order_code = :order_code 
                        AND status = 'PENDENT'", $parameters);
                // ================================================================

                // ================================================================
                // contagem dos resultados
                    if(count($resultado) == 0)
                    {
                        // devolve falso se não existirem resultados
                        return false;
                    }
                // ================================================================

                // ================================================================
                // efetuar a alteração do estado da order 
                    $bd->update("
                        UPDATE orders
                        SET status = 'PROCESSING',
                        updated_at = NOW()
                        WHERE order_code = :order_code
                    ", $parameters);
                // ================================================================
                
                // ================================================================
                // devolve verdadeiro se existirem resultados
                    return true;
                // ================================================================

            }
        // ================================================================

    }
// ================================================================