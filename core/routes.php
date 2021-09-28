<?php

    // ============================================================
    // coleção de routes
        $routes = 
        [
                'home_page' => 'main@index',
                'store' => 'main@store',

            // ============================================================
            // customer ( login / logout ) 
                'login' => 'main@login',
                'login_submit' => 'main@login_submit',
                'logout' => 'main@logout',
            // ============================================================            


            // // // ============================================================
            // // // customer ( novo / criar / confirmar )
            // //     'new_customer' => 'main@new_customer',
            // //     'create_customer' => 'main@create_customer',
            // //     'confirm_email' => 'main@confirm_email',
            // // // ============================================================

            // // // ============================================================
            // // // customer ( login / logout ) 
            // //     'login' => 'main@login',
            // //     'login_submit' => 'main@login_submit',
            // //     'logout' => 'main@logout',
            // // // ============================================================

            // // // ============================================================
            // // // profile ( alterar dados )
            // //     //'profile' => 'main@profile',
            // //     'profile_modal' => 'main@profile_modal',
            // //     'change_personal_data' => 'main@change_personal_data',
            // //     'change_personal_data_modal' => 'main@change_personal_data_modal',
            // //     'change_personal_data_submit' => 'main@change_personal_data_submit',
            // //     'change_personal_data_submit_modal' => 'main@change_personal_data_submit_modal',
            // //     'change_password' => 'main@change_password',
            // //     'change_password_modal' => 'main@change_password_modal',
            // //     'change_password_submit' => 'main@change_password_submit',
            // //     'change_password_submit_modal' => 'main@change_password_submit_modal',
            // // // ============================================================
            
            // // // ============================================================
            // // // orders ( historico / detalhe)
            // //     'order_history_modal' => 'main@order_history_modal',
            // //     'order_history' => 'main@order_history',
            // //     'order_details' => 'main@order_history_details',
            // //     'order_history_details_modal' => 'main@order_history_details_modal',
            // // // ============================================================
            
            // // // ============================================================
            // // // cart
            // //     'add_to_cart' => 'cart@add_to_cart',
            // //     'remove_product_cart' => 'cart@remove_product_cart',
            // //     'clean_cart' => 'cart@clean_cart',
            // //     'cart' => 'cart@cart',
            // //     'cart_modal' => 'cart@cart_modal',
            // //     'finalize_order' => 'cart@finalize_order',
            // //     'finalize_order_modal' => 'cart@finalize_order_modal',
            // //     'finalize_order_summary' => 'cart@finalize_order_summary',
            // //     'finalize_order_summary_modal' => 'cart@finalize_order_summary_modal',
            // //     'alternative_address' => 'cart@alternative_address',
            // //     'alternative_address_modal' => 'cart@alternative_address_modal',
            // //     'confirm_order' => 'cart@confirm_order',
            // //     'confirm_order_modal' => 'cart@confirm_order_modal',
            // //   //  'clean_cart' => 'cart@clean_cart',
            // // // ============================================================

            // // // ============================================================
            // // // pagamentos
            // //     'payment' => 'main@payment',
            // // // ============================================================

            // // // ============================================================
            // // // temp
            // //     'pdf' => 'main@generate_pdf'
            // // // ============================================================
        ];
    // ============================================================   

    // ============================================================
    // define ação por defeito
        $acao = 'home_page';
    // ============================================================

    // ============================================================
    // verifica se existe a ação na query string
        if(isset($_GET['a']))
        {
            // ============================================================
            // verifica se a ação existe nas routes
                if(!key_exists($_GET['a'], $routes))
                {
                    $acao = 'home_page';
                } 
                else 
                {
                    $acao = $_GET['a'];
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
    
    
    // ============================================================
    // coleção de routes
    // $routes = 
    // [
    //     'home_page' => 'main@index',
    //     'store' => 'main@store',

    //     // ============================================================
    //     // customer ( novo / criar / confirmar )
    //         'new_customer' => 'main@new_customer',
    //         'create_customer' => 'main@create_customer',
    //         'confirm_email' => 'main@confirm_email',
    //     // ============================================================

    //     // ============================================================
    //     // customer ( login / logout ) 
    //         'login' => 'main@login',
    //         'login_submit' => 'main@login_submit',
    //         'logout' => 'main@logout',
    //     // ============================================================

    //     // ============================================================
    //     // profile ( alterar dados )
    //         //'profile' => 'main@profile',
    //         'profile_modal' => 'main@profile_modal',
    //         'change_personal_data' => 'main@change_personal_data',
    //         'change_personal_data_modal' => 'main@change_personal_data_modal',
    //         'change_personal_data_submit' => 'main@change_personal_data_submit',
    //         'change_personal_data_submit_modal' => 'main@change_personal_data_submit_modal',
    //         'change_password' => 'main@change_password',
    //         'change_password_modal' => 'main@change_password_modal',
    //         'change_password_submit' => 'main@change_password_submit',
    //         'change_password_submit_modal' => 'main@change_password_submit_modal',
    //     // ============================================================
        
    //     // ============================================================
    //     // orders ( historico / detalhe)
    //         'order_history_modal' => 'main@order_history_modal',
    //         'order_history' => 'main@order_history',
    //         'order_details' => 'main@order_history_details',
    //         'order_history_details_modal' => 'main@order_history_details_modal',
    //     // ============================================================
        
    //     // ============================================================
    //     // cart
    //         'add_to_cart' => 'cart@add_to_cart',
    //         'remove_product_cart' => 'cart@remove_product_cart',
    //         'clean_cart' => 'cart@clean_cart',
    //         'cart' => 'cart@cart',
    //         'cart_modal' => 'cart@cart_modal',
    //         'finalize_order' => 'cart@finalize_order',
    //         'finalize_order_modal' => 'cart@finalize_order_modal',
    //         'finalize_order_summary' => 'cart@finalize_order_summary',
    //         'finalize_order_summary_modal' => 'cart@finalize_order_summary_modal',
    //         'alternative_address' => 'cart@alternative_address',
    //         'alternative_address_modal' => 'cart@alternative_address_modal',
    //         'confirm_order' => 'cart@confirm_order',
    //         'confirm_order_modal' => 'cart@confirm_order_modal',
    //       //  'clean_cart' => 'cart@clean_cart',
    //     // ============================================================

    //     // ============================================================
    //     // pagamentos
    //         'payment' => 'main@payment',
    //     // ============================================================

    //     // ============================================================
    //     // temp
    //         'pdf' => 'main@generate_pdf'
    //     // ============================================================
    // ];
// ============================================================    