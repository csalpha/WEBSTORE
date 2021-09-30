<?php

    // ============================================================
    //  carregar classes 
        use core\classes\Store;
    // ============================================================

    // ============================================================
    // colecção de routes
        $routes = 
                [
                    // ============================================================
                    // home_page
                        'home_page' => 'admin@index',
                        'home_page_admin' => 'admin@home_page_admin',
                    // ============================================================

                    // ============================================================
                    // profile ( alterar dados )
                        'profile_admin' => 'admin@profile_admin',
                        'profile_admin_modal' => 'admin@profile_admin_modal',
                        'change_profile_admin_data' => 'admin@change_profile_admin_data',
                        'change_profile_admin_data_submit' => 'admin@change_profile_admin_data_submit',
                        
                        //'change_admin_data_submit' => 'main@change_admin_data_submit',
                        'change_password' => 'main@change_password',
                        'change_password_submit' => 'main@change_password_submit',
                       // 'change_password_admin_modal' => 'admin@change_password_admin_modal',
                       'alterar_pass_admin' => 'admin@alterar_pass_admin',

                        'change_password_submit_modal_admin' => 'admin@change_password_submit_modal_admin',
                        'change_password_admin_profile' => 'admin@change_password_admin_profile',
                        'change_password_admin_profile_submit' => 'admin@change_password_admin_profile_submit',
                    // ============================================================                    

                    // ============================================================
                    // admins
                        'criar_tabela_admin' => 'admin@criar_tabela_admin',
                        'new_admin' => 'admin@new_admin',
                        'create_admin' => 'admin@create_admin',
                        'admin_login' => 'admin@admin_login',
                        'admin_login_submit' => 'admin@admin_login_submit',
                        'admin_logout' => 'admin@admin_logout',
                        'admins_list' => 'admin@admins_list',
                        'admin_details' => 'admin@admin_details',
                        'admin_change_status' => 'admin@admin_change_status',
                        'change_admin_data' => 'admin@change_admin_data',
                        'change_admin_data_modal' => 'admin@change_admin_data_modal',
                        'create_modal_ver_admin' => 'admin@create_modal_ver_admin',
                       // 'change_admin_data_modal_admin' => 'admin@change_admin_data_modal_admin', 
                        'create_modal_update_admin' => 'admin@create_modal_update_admin',
                       // 'change_admin_data_modal_admin_alfa' => 'admin@change_admin_data_modal_admin_alfa',  
                        'change_admin_data_submit' => 'admin@change_admin_data_submit',
                        'change_admin_data_submit_modal' => 'admin@change_admin_data_submit_modal',
                        'change_password_admin' => 'admin@change_password_admin',
                        'change_password_admin_submit' => 'admin@change_password_admin_submit',
                        'delete_admin' => 'admin@delete_admin',
                        //'create_admin_modal' => 'admin@create_admin_modal',
                        'change_personal_data_modal_admin' => 'admin@change_personal_data_modal_admin',
                        'change_personal_data_submit_modal_admin' => 'admin@change_personal_data_submit_modal_admin',
                        //'change_personal_data_submit_modal_admin_alfa' => 'admin@change_personal_data_submit_modal_admin_alfa',
                        'update_admin' => 'admin@update_admin',                        
                        'change_password_admin_modal_alfa' => 'admin@change_password_admin_modal_alfa',
                        'change_password_submit_modal_admin_alfa' => 'admin@change_password_submit_modal_admin_alfa',
                        
                        
                    // ============================================================

                    // ============================================================
                    // customers
                        'new_customer' => 'admin@new_customer',
                        'create_customer' => 'admin@create_customer',                    
                        'customers_list' => 'admin@customers_list',
                        'customer_detail' => 'admin@customer_detail',
                        'customer_order_history' => 'admin@customer_order_history',
                        'customer_change_status' => 'admin@customer_change_status',
                        'change_customer_data' => 'admin@change_customer_data',
                        'change_customer_data_admin' => 'admin@change_customer_data_admin',
                        'change_customer_data_submit' => 'admin@change_customer_data_submit',
                        //'change_customer_data_submit_admin' => 'admin@change_customer_data_submit_admin',
                        'change_password_customer' => 'admin@change_password_customer',
                        'change_password_customer_submit' => 'admin@change_password_customer_submit',
                        'order_history_customer' => 'admin@order_history_customer',
                        'order_history_details_customer' => 'admin@order_history_details_customer',
                        'delete_customer' => 'admin@delete_customer',
                        'create_customer_modal' => 'admin@create_customer_modal',
                        'change_customer_data_submit_modal' => 'admin@change_customer_data_submit_modal',
                        'criar_tabela_customer'  => 'admin@criar_tabela_customer',
                        'criar_tabela_products'  => 'admin@criar_tabela_products',
                        'criar_tabela_orders'  => 'admin@criar_tabela_orders',
                        //'create_customer_modal_ajax'  => 'admin@create_customer_modal_ajax',
                        //'change_customer_data_modal_admin'  => 'admin@change_customer_data_modal_admin',
                        'create_modal_ver_customer'  => 'admin@create_modal_ver_customer',
                        'change_customer_data_modal_admin_alfa'  => 'admin@change_customer_data_modal_admin_alfa',
                        'create_modal_update_customer'  => 'admin@create_modal_update_customer',
                        'update_customer'  => 'admin@update_customer',
                    // ============================================================

                    // ============================================================
                    // orders
                        'new_order' => 'admin@new_order',
                        'create_order' => 'admin@create_order',                    
                        'orders_list' => 'admin@orders_list',
                        'order_details' => 'admin@order_details',
                        'order_change_status' => 'admin@order_change_status',
                        'generate_pdf_order' => 'admin@generate_pdf_order',
                        'send_pdf_order' => 'admin@send_pdf_order',
                        'change_order_data' => 'admin@change_order_data',
                        'change_order_data_submit' => 'main@change_order_data_submit',
                        'create_modal_ver_order' => 'admin@create_modal_ver_order',
                        'delete_order' => 'admin@delete_order',
                        'create_modal_update_order' => 'admin@create_modal_update_order',
                    // ============================================================

                    // ============================================================
                    // productos
                        'new_product' => 'admin@new_product',
                        'create_product' => 'admin@create_product',                    
                        'products_list' => 'admin@products_list', 
                        'product_change_status' => 'admin@product_change_status',
                        'products_details' => 'admin@products_details', 
                        'change_product_data' => 'admin@change_product_data',
                        'change_product_data_submit' => 'admin@change_product_data_submit',
                        'create_modal_ver_product' => 'admin@create_modal_ver_product',
                        'delete_product' => 'admin@delete_product',
                        'create_modal_update_product' => 'admin@create_modal_update_product',
                        'update_product' => 'admin@update_product',
                    // ============================================================        
                ];
    // ============================================================  

    // ============================================================
    // define acção por defeito
        $acao = 'home_page';
    // ============================================================

    // ============================================================
    // verifica se existe a acção na query string
        if(isset($_GET['a']))
        {
            // ============================================================
            // verifica se a acção existe nas routes
                if(!key_exists($_GET['a'], $routes))
                {
                    // ============================================================
                    //  acção não existe nas routes
                        $acao = 'home_page';
                    // ============================================================
                } 
                else 
                {
                    // ============================================================
                    //  acção existe nas routes                    
                        $acao = $_GET['a'];
                    // ============================================================                       
                }
            // ============================================================
        }
    // ============================================================    

    // ============================================================
    // trata a definição da rota
        $partes = explode('@',$routes[$acao]);
        $controlador = 'core\\controllers\\'.ucfirst($partes[0]);
        $metodo = $partes[1];        

        $ctr = new $controlador();
        $ctr->$metodo();
    // ============================================================

    