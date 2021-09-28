<?php

    // ================================================================
    // carregar classes
        namespace core\controllers;
        use core\classes\Database;
        use core\classes\SendEmail;
        use core\classes\Store;
        use core\models\Customers;
        use core\models\Orders;
        use core\models\products;
    // ================================================================

    // ================================================================
    // class Cart
        class Cart
        {
            // ===========================================================
            // adicionar cart / add cart
                public function add_to_cart()
                {
                    // ===========================================================
                    // vai buscar o id do product à query string (se configurado)
                        if (!isset($_GET['id_product']))
                        {

                            echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '';
                            return;
                        }
                    // ===========================================================

                    // ===========================================================
                    // define o id do product
                        $id_product = $_GET['id_product'];
                    // ===========================================================

                    // ===========================================================
                    // criar product
                        $products = new products();
                    // ===========================================================

                    // ===========================================================
                    //verificar stock do product
                        $resultados = $products->check_stock_product($id_product);
                    // ===========================================================

                    // ===========================================================
                    // mostra valor cart
                        if (!$resultados) {
                            echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '';
                            return;
                        }
                    // ===========================================================

                    // ===========================================================
                    // adiciona/gestão da variável de session do cart
                        $cart = [];

                        if (isset($_SESSION['cart'])) {
                            $cart = $_SESSION['cart'];
                        }
                    // ===========================================================

                    // ===========================================================
                    // adicionar o product ao cart
                        if (key_exists($id_product, $cart))
                        {
                            // ===========================================================
                            // já existe o product. Acrescenta mais uma unidade
                                $cart[$id_product]++;
                            // ===========================================================
                        } else
                        {
                            // ===========================================================
                            // adicionar novo product ao cart
                                $cart[$id_product] = 1;
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // atualiza os dados do cart na sessão
                        $_SESSION['cart'] = $cart;
                    // ===========================================================

                    // ===========================================================
                    // devolve a resposta (número de products do cart)
                        $total_products = 0;
                        foreach ($cart as $quantity) {
                            $total_products += $quantity;
                        }
                        echo $total_products;
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // remover product cart / remove product cart
                public function remove_product_cart()
                {
                    // ===========================================================
                    // vai buscar o id do product na query string
                        $id_product = $_GET['id_product'];
                    // ===========================================================

                    // ===========================================================
                    // buscar o cart à sessão
                        $cart = $_SESSION['cart'];
                    // ===========================================================

                    // ===========================================================
                    // remover o product do cart
                        unset($cart[$id_product]);
                    // ===========================================================

                    // ===========================================================
                    // atualizar o cart na sessão
                        $_SESSION['cart'] = $cart;
                    // ===========================================================

                    // ===========================================================
                        // verificar se existe cart
                        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
                        {
                            // ===========================================================
                            // Não existe cart
                                $data = [
                                    'cart' => null
                                ];
                            // ===========================================================

                            $msg = '';

                            // ===========================================================
                            // variáveis
                                if(!empty($data) && is_array($data))
                                {
                                    extract($data);
                                }
                            // ===========================================================

                                if ($cart == null) :

                                    $total_quantity = 0;
                                    // ===========================================================
                                    // modal-header
                                        $msg.='<div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Carrinho vazio</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>';
                                    // ===========================================================                                    

                                    // ===========================================================
                                    // modal-body
                                        $msg.='<br><br><br><br><br><br><br><br><br><div class="modal-body">
                                                    <p class="text-center">Não existem produtos no carrinho.</p>
                                                    <input type="hidden" value="'.$total_quantity.'" id="total_quantity"></input>
                                            </div>';
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-footer
                                        $msg.='<div class="modal-footer">
                                                    <div class="mt-4 text-center">
                                                        <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Ir para a loja</a>
                                                    </div>
                                                </div>';
                                    // ===========================================================                                    

                                    

                                endif;
                                

                                echo json_encode($msg);
                        }
                        else
                        {
                                    // ===========================================================
                                    // string vazia
                                        $msg = '';
                                    // ===========================================================

                                    // ===========================================================
                                    // Existe cart
                                        $ids = [];
                                        foreach ($_SESSION['cart'] as $id_product => $quantity) {
                                            array_push($ids, $id_product);
                                        }
                                        $ids = implode(",", $ids);
                                    // ===========================================================
                                                    

                                    // ===========================================================
                                    // cria um product
                                        $products = new products();
                                    // ===========================================================

                                    // ===========================================================
                                    // Vai buscar o product com o respectivo id
                                        $resultados = $products->search_products_by_ids($ids);
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-header
                                        $msg.='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">A sua encomenda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>';
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-body                                    
                                            $msg.='<div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Produto</th>
                                                            <th class="text-center">Quantidade</th>
                                                            <th class="text-end">Valor total</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                            // ===========================================================
                                            // Colocar products numa coleccao
                                                $data_temp = [];
                                                foreach ($_SESSION['cart'] as $id_product => $quantity_cart)
                                                {
                                                    // ===========================================================
                                                    // image do product
                                                        foreach ($resultados as $product)
                                                        {
                                                            if ($product->id_product == $id_product)
                                                            {
                                                                // ===========================================================
                                                                // data do product
                                                                    $id_product = $product->id_product;
                                                                    $image = $product->image;
                                                                    $titulo = $product->product_name;
                                                                    $quantity = $quantity_cart;
                                                                    $price = $product->price * $quantity;
                                                                // ===========================================================

                                                                $msg.='<tr>
                                                                <td><img src="assets/images/products/';
                                                                $msg.= $image; 

                                                                $msg.='" class="img-fluid" width="50px"></td>
                                                                <td class="align-middle"><h5>';
                                                                $msg.= $titulo;

                                                                $msg.='</h5></td>
                                                                <td class="text-center align-middle"><h5>';

                                                                $msg.= $quantity;
                                                                $msg.='</h5></td>
                                                                <td class="text-end align-middle"><h4>';

                                                                $msg.=  number_format($price,2,',','.') . '€';

                                                                $msg.='</h4></td>
                                                                <td class="text-center align-middle">
                                                                    <a ';
                                                                    // $msg.='?a=remove_product_cart&id_product='.$id_product;
                                                                    $msg.='';
                                                                    $msg.=' onclick="remove_product_cart(';
                                                                    $msg.=$id_product.')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>';

                                                                // ===========================================================
                                                                // colocar o product na coleção
                                                                    array_push($data_temp, [
                                                                        'id_product' => $id_product,
                                                                        'image' => $image,
                                                                        'titulo' => $titulo,
                                                                        'quantity' => $quantity,
                                                                        'price' => $price
                                                                    ]);    
                                                                // ====================================================
                                                                // ===========================================================
                                                                // sai do bloco
                                                                // break;
                                                                // ===========================================================
                                                            }
                                                        }
                                                    // ===========================================================
                                                    }
                                                    // ===========================================================

                                                        // ===========================================================
                                                        // calcular o total
                                                            $total_da_order = 0;
                                                            $total_quantity = 0;
                                                            foreach ($data_temp as $item) {
                                                                $total_da_order += $item['price'];
                                                                $total_quantity += $item['quantity'];

                                                            }
                                                        // ===========================================================

                                                        // ===========================================================
                                                        // Mandar o total da order para uma coleccao
                                                            array_push($data_temp, $total_da_order);
                                                        // ===========================================================

                                                        // ===========================================================
                                                        // Colocar o preço total na sessão
                                                            $_SESSION['total_order'] = $total_da_order;
                                                        // ===========================================================
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // colocar coleccao de products no cart
                                                        if(!empty($data_temp) && is_array($data_temp))
                                                        {
                                                            $data = [
                                                                'cart' => $data_temp
                                                            ];
                                                        }
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // variáveis
                                                        // // if(!empty($data) && is_array($data))
                                                        // // {
                                                        // //     extract($data);
                                                        // // }
                                                    // ===========================================================
                                        
                                                
                                                    $msg.='</table>
                                                
                                                    <div class="text-end"><input type="hidden" value="'.$total_quantity.'" id="total_quantity"></input>
                                                    <h3><button  onclick="clean_cart()" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i></button>  Total:';
                                                    $msg.= number_format($total_da_order,2,',','.') . '€  </h3></div>';
                                                    
                                                    $msg.=' </div>';
                                            // ===========================================================
                                    // ===========================================================

                                /*  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button> */

                                    // ===========================================================
                                    // modal-footer    
                                        $msg.='<div class="modal-footer">
                                                    <div class="col">
                                                    <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Continuar comprar</a>
                                                    <!-- <a href="?a=clean_cart" onclick="clean_cart()" class="mb-3 btn btn-black text-uppercase filter-btn m-2" data-bs-dismiss="modal">Limpar carrinho</a> -->
                                                    
                                                        <span class="ms-3" id="confirmar_clean_cart" style="display: none; ">Tem a certeza?
                                                            <button class="mb-3 btn btn-black text-uppercase filter-btn m-2" onclick="clean_cart_off()">Não</button>
                                                            <a href="?a=clean_cart" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Sim</a>
                                                        </span>
                                                        
                                                    </div>';



                                            $msg.='<div class="col text-end">
                                                        <button onclick="apresentarModalFinalizarEncomenda()" class="mb-3 btn btn-black text-uppercase filter-btn m-2" data-bs-dismiss="modal">Finalizar encomenda</button>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>';
                                        /*<a href="?a=finalize_order" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Finalizar encomenda</a>*/
                                    // ===========================================================

                                    // ===========================================================
                                    // mostra string json                       
                                       echo json_encode($msg);
                                       //Store::printData($msg);
                                    // ===========================================================

                        }
                    // ===========================================================





                    // ===========================================================
                    // apresentar novamente a página do cart
                        //$this->cart();
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // clean_cart / clean cart
                public function clean_cart()
                {
                    // ===========================================================
                    // limpa o cart de todos os products
                        unset($_SESSION['cart']);
                    // ===========================================================

                    // ===========================================================
                    // refrescar a página do cart
                        //$this->cart();
                    // ===========================================================

                    // ===========================================================
                    // refrescar modal
                        //$this->cart_modal();
                    // ===========================================================

                    // ===========================================================
                        // verificar se existe cart
                        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
                        {
                            // ===========================================================
                            // Não existe cart
                                $data = [
                                    'cart' => null
                                ];
                            // ===========================================================

                            $msg = '';

                            // ===========================================================
                            // variáveis
                                if(!empty($data) && is_array($data))
                                {
                                    extract($data);
                                }
                            // ===========================================================

                                if ($cart == null) :

                                    // ===========================================================
                                    // modal-header
                                        $msg.='<div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Carrinho vazio</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>';
                                    // ===========================================================                                    

                                    // ===========================================================
                                    // modal-body
                                        $msg.='<br><br><br><br><br><br><br><br><br><div class="modal-body">
                                                    <p class="text-center">Não existem produtos no carrinho.</p>
                                            </div>';
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-footer
                                        $msg.='<div class="modal-footer">
                                                    <div class="mt-4 text-center">
                                                        <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Ir para a loja</a>
                                                    </div>
                                                </div>';
                                    // ===========================================================                                    

                                    

                                endif;
                                

                                echo json_encode($msg);
                        }
                        else
                        {
                                    // ===========================================================
                                    // string vazia
                                        $msg = '';
                                    // ===========================================================

                                    // ===========================================================
                                    // Existe cart
                                        $ids = [];
                                        foreach ($_SESSION['cart'] as $id_product => $quantity) {
                                            array_push($ids, $id_product);
                                        }
                                        $ids = implode(",", $ids);
                                    // ===========================================================
                                                    

                                    // ===========================================================
                                    // cria um product
                                        $products = new products();
                                    // ===========================================================

                                    // ===========================================================
                                    // Vai buscar o product com o respectivo id
                                        $resultados = $products->search_products_by_ids($ids);
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-header
                                        $msg.='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">A sua encomenda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>';
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-body                                    
                                            $msg.='<div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Produto</th>
                                                            <th class="text-center">Quantidade</th>
                                                            <th class="text-end">Valor total</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                            // ===========================================================
                                            // Colocar products numa coleccao
                                                $data_temp = [];
                                                foreach ($_SESSION['cart'] as $id_product => $quantity_cart)
                                                {
                                                    // ===========================================================
                                                    // image do product
                                                        foreach ($resultados as $product)
                                                        {
                                                            if ($product->id_product == $id_product)
                                                            {
                                                                // ===========================================================
                                                                // data do product
                                                                    $id_product = $product->id_product;
                                                                    $image = $product->image;
                                                                    $titulo = $product->product_name;
                                                                    $quantity = $quantity_cart;
                                                                    $price = $product->price * $quantity;
                                                                // ===========================================================

                                                                $msg.='<tr>
                                                                <td><img src="assets/images/products/';
                                                                $msg.= $image; 

                                                                $msg.='" class="img-fluid" width="50px"></td>
                                                                <td class="align-middle"><h5>';
                                                                $msg.= $titulo;

                                                                $msg.='</h5></td>
                                                                <td class="text-center align-middle"><h5>';

                                                                $msg.= $quantity;
                                                                $msg.='</h5></td>
                                                                <td class="text-end align-middle"><h4>';

                                                                $msg.=  number_format($price,2,',','.') . '€';

                                                                $msg.='</h4></td>
                                                                <td class="text-center align-middle">
                                                                    <a ';
                                                                    // $msg.='?a=remove_product_cart&id_product='.$id_product;
                                                                    $msg.='';
                                                                    $msg.=' onclick="remove_product_cart(';
                                                                    $msg.=$id_product.')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>';

                                                                // ===========================================================
                                                                // colocar o product na coleção
                                                                    array_push($data_temp, [
                                                                        'id_product' => $id_product,
                                                                        'image' => $image,
                                                                        'titulo' => $titulo,
                                                                        'quantity' => $quantity,
                                                                        'price' => $price
                                                                    ]);    
                                                                // ====================================================
                                                                // ===========================================================
                                                                // sai do bloco
                                                                // break;
                                                                // ===========================================================
                                                            }
                                                        }
                                                    // ===========================================================
                                                    }
                                                    // ===========================================================

                                                        // ===========================================================
                                                        // calcular o total
                                                            $total_da_order = 0;
                                                            foreach ($data_temp as $item) {
                                                                $total_da_order += $item['price'];
                                                            }
                                                        // ===========================================================

                                                        // ===========================================================
                                                        // Mandar o total da order para uma coleccao
                                                            array_push($data_temp, $total_da_order);
                                                        // ===========================================================

                                                        // ===========================================================
                                                        // Colocar o preço total na sessão
                                                            $_SESSION['total_order'] = $total_da_order;
                                                        // ===========================================================
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // colocar coleccao de products no cart
                                                        if(!empty($data_temp) && is_array($data_temp))
                                                        {
                                                            $data = [
                                                                'cart' => $data_temp
                                                            ];
                                                        }
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // variáveis
                                                        // // if(!empty($data) && is_array($data))
                                                        // // {
                                                        // //     extract($data);
                                                        // // }
                                                    // ===========================================================
                                        
                                                
                                                    $msg.='</table>
                                                
                                                    <div class="text-end"><h3><input type="hidden" value="'.$total_quantity.'" id="total_quantity"></input><button  onclick="clean_cart()" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>  Total:';
                                                    $msg.= number_format($total_da_order,2,',','.') . '€  </h3></div>';
                                                    
                                                    $msg.=' </div>';
                                            // ===========================================================
                                    // ===========================================================

                                /*  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button> */

                                    // ===========================================================
                                    // modal-footer    
                                        $msg.='<div class="modal-footer">
                                                    <div class="col">
                                                    <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Continuar comprar</a>
                                                    <!-- <a href="?a=clean_cart" onclick="clean_cart()" class="mb-3 btn btn-black text-uppercase filter-btn m-2" >Limpar carrinho</a> -->
                                                    
                                                        <span class="ms-3" id="confirmar_clean_cart" style="display: none; ">Tem a certeza?
                                                            <button class="mb-3 btn btn-black text-uppercase filter-btn m-2" onclick="clean_cart_off()">Não</button>
                                                            <a href="?a=clean_cart" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Sim</a>
                                                        </span>
                                                        
                                                    </div>';



                                            $msg.='<div class="col text-end">
                                                        <button onclick="apresentarModalFinalizarEncomenda()" class="mb-3 btn btn-black text-uppercase filter-btn m-2" data-bs-dismiss="modal">Finalizar encomenda</button>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>';
                                        /*<a href="?a=finalize_order" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Finalizar encomenda</a>*/
                                    // ===========================================================
                                    

                                    // ===========================================================
                                    // mostra string json                       
                                       echo json_encode($msg);
                                       //Store::printData($msg);
                                    // ===========================================================

                        }
                    // ===========================================================                    

                    // ===========================================================
                    // apresenta a página do cart
                   /* Store::Layout([
                        'layouts/html_header',
                        'layouts/header',
                        'cart',
                        'layouts/footer',
                        'layouts/html_footer',
                    ]);*/
                // ===========================================================


                }
            // ===========================================================

            // ===========================================================
            // cart / cart
                public function cart()
                {
                    // ===========================================================
                    // verificar se existe cart
                        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
                        {
                            // ===========================================================
                            // Não existe cart
                                $data = [
                                    'cart' => null
                                ];
                            // ===========================================================
                        }
                        else
                        {
                            // ===========================================================
                            // Existe cart
                                $ids = [];
                                foreach ($_SESSION['cart'] as $id_product => $quantity) {
                                    array_push($ids, $id_product);
                                }
                                $ids = implode(",", $ids);

                                // ===========================================================
                                // cria um product
                                    $products = new products();
                                // ===========================================================

                                // ===========================================================
                                // Vai buscar o product com o respectivo id
                                    $resultados = $products->search_products_by_ids($ids);
                                // ===========================================================

                                // ===========================================================
                                // Colocar products numa coleccao
                                    $data_temp = [];
                                    foreach ($_SESSION['cart'] as $id_product => $quantity_cart)
                                    {
                                        // ===========================================================
                                        // image do product
                                            foreach ($resultados as $product)
                                            {
                                                if ($product->id_product == $id_product)
                                                {
                                                    // ===========================================================
                                                    // data do product
                                                        $id_product = $product->id_product;
                                                        $image = $product->image;
                                                        $titulo = $product->product_name;
                                                        $quantity = $quantity_cart;
                                                        $price = $product->price * $quantity;
                                                    // ===========================================================
                                                    // ===========================================================
                                                    // colocar o product na coleção
                                                        array_push($data_temp, [
                                                            'id_product' => $id_product,
                                                            'image' => $image,
                                                            'titulo' => $titulo,
                                                            'quantity' => $quantity,
                                                            'price' => $price
                                                        ]);
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // sai do bloco
                                                        break;
                                                    // ===========================================================
                                                }
                                            }
                                        // ===========================================================
                                    }
                                // ===========================================================

                                // ===========================================================
                                // calcular o total
                                    $total_da_order = 0;
                                    foreach ($data_temp as $item) {
                                        $total_da_order += $item['price'];
                                    }
                                // ===========================================================

                                // ===========================================================
                                // Mandar o total da order para uma coleccao
                                    array_push($data_temp, $total_da_order);
                                // ===========================================================

                                // ===========================================================
                                // Colocar o preço total na sessão
                                    $_SESSION['total_order'] = $total_da_order;
                                // ===========================================================

                                // ===========================================================
                                // colocar coleccao de products no cart
                                    $data = [
                                        'cart' => $data_temp
                                    ];
                                // ===========================================================

                            // ===========================================================
                        }
                    // ===========================================================

                   // Store::printData($data);

                    // ===========================================================
                    // apresenta a página do cart
                       /* Store::Layout([
                            'layouts/html_header',
                            'layouts/header',
                            'cart',
                            'layouts/footer',
                            'layouts/html_footer',
                        ], $data); */
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // modal cart / modal cart
                public function cart_modal()
                {

                    // ===========================================================
                    // verificar se existe cart
                        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
                        {
                            // ===========================================================
                            // Não existe cart
                                $data = [
                                    'cart' => null
                                ];
                            // ===========================================================

                            $msg = '';

                            // ===========================================================
                            // variáveis
                                if(!empty($data) && is_array($data))
                                {
                                    extract($data);
                                }
                            // ===========================================================

                                if ($cart == null) :

                                    // ===========================================================
                                    // modal-header
                                        $msg.='<div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Carrinho vazio</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>';
                                    // ===========================================================                                    

                                    // ===========================================================
                                    // modal-body
                                        $msg.='<br><br><br><br><br><br><br><br><br><div class="modal-body">
                                                    <p class="text-center">Não existem produtos no carrinho.</p>
                                               </div>';
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-footer
                                        $msg.='<div class="modal-footer">
                                                    <div class="mt-4 text-center">
                                                        <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Ir para a loja</a>
                                                    </div>
                                                </div>';
                                    // ===========================================================                                    

                                    

                                endif;
                                

                                echo json_encode($msg);
                        }
                        else
                        {
                                    // ===========================================================
                                    // string vazia
                                        $msg = '';
                                    // ===========================================================

                                    // ===========================================================
                                    // Existe cart
                                        $ids = [];
                                        foreach ($_SESSION['cart'] as $id_product => $quantity) {
                                            array_push($ids, $id_product);
                                        }
                                        $ids = implode(",", $ids);
                                    // ===========================================================
                                                       

                                    // ===========================================================
                                    // cria um product
                                        $products = new products();
                                    // ===========================================================

                                    // ===========================================================
                                    // Vai buscar o product com o respectivo id
                                        $resultados = $products->search_products_by_ids($ids);
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-header
                                        $msg.='<div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">A sua encomenda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>';
                                    // ===========================================================

                                    // ===========================================================
                                    // modal-body                                    
                                            $msg.='<div class="modal-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Produto</th>
                                                            <th class="text-center">Quantidade</th>
                                                            <th class="text-end">Valor total</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                            // ===========================================================
                                            // Colocar products numa coleccao
                                                $data_temp = [];
                                                foreach ($_SESSION['cart'] as $id_product => $quantity_cart)
                                                {
                                                    // ===========================================================
                                                    // image do product
                                                        foreach ($resultados as $product)
                                                        {
                                                            if ($product->id_product == $id_product)
                                                            {
                                                                // ===========================================================
                                                                // data do product
                                                                    $id_product = $product->id_product;
                                                                    $image = $product->image;
                                                                    $titulo = $product->product_name;
                                                                    $quantity = $quantity_cart;
                                                                    $price = $product->price * $quantity;
                                                                // ===========================================================

                                                                $msg.='<tr>
                                                                <td><img src="assets/images/products/';
                                                                $msg.= $image; 

                                                                $msg.='" class="img-fluid" width="50px"></td>
                                                                <td class="align-middle"><h5>';
                                                                $msg.= $titulo;

                                                                $msg.='</h5></td>
                                                                <td class="text-center align-middle"><h5>';

                                                                $msg.= $quantity;
                                                                $msg.='</h5></td>
                                                                <td class="text-end align-middle"><h4>';

                                                                $msg.=  number_format($price,2,',','.') . '€';

                                                                $msg.='</h4></td>
                                                                <td class="text-center align-middle">
                                                                    <a ';
                                                                    // $msg.='?a=remove_product_cart&id_product='.$id_product;
                                                                    $msg.='';
                                                                    $msg.=' onclick="remove_product_cart(';
                                                                    $msg.=$id_product.')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>';

                                                                // ===========================================================
                                                                // colocar o product na coleção
                                                                    array_push($data_temp, [
                                                                        'id_product' => $id_product,
                                                                        'image' => $image,
                                                                        'titulo' => $titulo,
                                                                        'quantity' => $quantity,
                                                                        'price' => $price
                                                                    ]);    
                                                                // ====================================================
                                                                // ===========================================================
                                                                // sai do bloco
                                                                   // break;
                                                                // ===========================================================
                                                            }
                                                        }
                                                    // ===========================================================
                                                    }
                                                    // ===========================================================

                                                        // ===========================================================
                                                        // calcular o total
                                                            $total_da_order = 0;
                                                            $total_quantity = 0;
                                                            foreach ($data_temp as $item) {
                                                                $total_da_order += $item['price'];
                                                                $total_quantity += $item['quantity'];
                                                            }
                                                        // ===========================================================

                                                        // ===========================================================
                                                        // Mandar o total da order para uma coleccao
                                                            array_push($data_temp, $total_da_order);
                                                        // ===========================================================

                                                        // ===========================================================
                                                        // Colocar o preço total na sessão
                                                            $_SESSION['total_order'] = $total_da_order;
                                                        // ===========================================================
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // colocar coleccao de products no cart
                                                        if(!empty($data_temp) && is_array($data_temp))
                                                        {
                                                            $data = [
                                                                'cart' => $data_temp
                                                            ];
                                                        }
                                                    // ===========================================================

                                                    // ===========================================================
                                                    // variáveis
                                                        // // if(!empty($data) && is_array($data))
                                                        // // {
                                                        // //     extract($data);
                                                        // // }
                                                    // ===========================================================
                                        
                                                
                                                    $msg.='</table>
                                                   
                                                    <div class="text-end"><input type="hidden" value="'.$total_quantity.'" id="total_quantity"></input><h3><button  onclick="clean_cart()" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i></button>  Total:';
                                                    $msg.= number_format($total_da_order,2,',','.') . '€  </h3></div>';
                                                    
                                                    $msg.=' </div>';
                                            // ===========================================================
                                    // ===========================================================

                                  /*  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button> */

                                    // ===========================================================
                                    // modal-footer    
                                        $msg.='<div class="modal-footer">
                                                    <div class="col">
                                                    <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Continuar comprar</a>
                                                    <!-- <a href="?a=clean_cart" onclick="clean_cart()" class="mb-3 btn btn-black text-uppercase filter-btn m-2" data-bs-dismiss="modal">Limpar carrinho</a> -->
                                                    
                                                        <span class="ms-3" id="confirmar_clean_cart" style="display: none; ">Tem a certeza?
                                                            <button class="mb-3 btn btn-black text-uppercase filter-btn m-2" onclick="clean_cart_off()">Não</button>
                                                            <a href="?a=clean_cart" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Sim</a>
                                                        </span>
                                                        
                                                    </div>';



                                            $msg.='<div class="col text-end">
                                                        <button onclick="apresentarModalFinalizarEncomenda()" class="mb-3 btn btn-black text-uppercase filter-btn m-2" data-bs-dismiss="modal">Finalizar encomenda</button>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>';
                                        /*<a href="?a=finalize_order" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Finalizar encomenda</a>*/
                                    // ===========================================================

                                    // ===========================================================
                                    // mostra string json                       
                                        echo json_encode($msg);
                                    // ===========================================================

                        }
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // finalizar order / finalize order
                public function finalize_order()
                {
                    // ===========================================================
                    // verifica se existe customer logado
                        if (!isset($_SESSION['customer']))
                        {
                            // ===========================================================
                            // nao existe customer logado
                            // ===========================================================

                            // ===========================================================
                            // coloca na sessão uma array temporário com o cart
                                $_SESSION['tmp_cart'] = true;
                            // ===========================================================

                            // ===========================================================
                            // redirecionar para a pagina de login
                                Store::redirect('login');
                            // ===========================================================

                           //echo json_encode('astdfgassfsd');
                        }
                        else
                        {
                            // ===========================================================
                            // existe customer logado
                            // ===========================================================

                            // ===========================================================
                            // redirecionar para a pagina finalizar order resumo
                                Store::redirect('finalize_order_summary');
                            // ===========================================================
                        }
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // finalizar order resumo / finalize order summary
                public function finalize_order_summary()
                {
                    // ===========================================================
                    // verifica se existe customer logado
                        if(!isset($_SESSION['customer'])){
                            Store::redirect('home_page');
                        }
                    // ===========================================================

                    // ===========================================================
                    // informações de cada product do cart
                        $ids = [];
                        foreach ($_SESSION['cart'] as $id_product => $quantity) {
                            array_push($ids, $id_product);
                        }
                        $ids = implode(",", $ids);
                    // ===========================================================

                    // ===========================================================
                    // criar product
                        $products = new products();
                    // ===========================================================

                    // ===========================================================
                    // ir buscar data de cada product
                        $resultados = $products->search_products_by_ids($ids);
                    // ===========================================================


                    // ===========================================================
                    // Para cada product no cart
                        $data_temp = [];
                        foreach ($_SESSION['cart'] as $id_product => $quantity_cart)
                        {

                            // ===========================================================
                            // guardar data de cada product
                                foreach ($resultados as $product)
                                {
                                    if ($product->id_product == $id_product)
                                    {
                                        // ===========================================================
                                        // data do product
                                            $id_product = $product->id_product;
                                            $image = $product->image;
                                            $titulo = $product->product_name;
                                            $quantity = $quantity_cart;
                                            $price = $product->price * $quantity;
                                        // ===========================================================

                                        // ===========================================================
                                        // colocar o product na coleção
                                            array_push($data_temp, [
                                                'id_product' => $id_product,
                                                'image' => $image,
                                                'titulo' => $titulo,
                                                'quantity' => $quantity,
                                                'price' => $price
                                            ]);
                                        // ===========================================================
                                        break;
                                    }
                                }
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // calcular o total
                        $total_da_order = 0;
                        foreach ($data_temp as $item) {
                            $total_da_order += $item['price'];
                        }
                    // ===========================================================

                    // ===========================================================
                    // coloca o total da encomenda na coleccao
                        array_push($data_temp, $total_da_order);
                    // ===========================================================

                    //Store::printData($data_temp);

                    // ===========================================================
                    // preparar os data da view
                        $data = [];
                        $data['cart'] = $data_temp;
                    // ===========================================================

                    // ===========================================================
                    // buscar informações do customer
                        $customer = new Customers();
                        $data_customer = $customer->search_data_customer($_SESSION['customer']);
                        $data['customer'] = $data_customer;
                    // ===========================================================

                    // ===========================================================
                    // gerar o código da order
                        if(!isset($_SESSION['order_code'])){
                            $order_code = Store::order_code_generator();
                            $_SESSION['order_code'] = $order_code;
                        }

                    // ===========================================================

                    // ===========================================================
                    // apresenta a página do resumo da order
                         Store::Layout([
                             'layouts/html_header',
                             'layouts/header',
                             'order_summary',
                             'layouts/footer',
                             'layouts/html_footer',
                         ], $data);
                    // ===========================================================

                }
            // ===========================================================

            // ===========================================================
            // finalizar order modal / finalize order modal
                public function finalize_order_modal()
                {
                    // ===========================================================
                    // verifica se existe customer logado
                        if (!isset($_SESSION['customer']))
                        {

                            //print_r($_SESSION['customer']);
                            // ===========================================================
                            // nao existe customer logado
                            // ===========================================================

                            // ===========================================================
                            // coloca na sessão uma array temporário com o cart
                                $_SESSION['tmp_cart'] = true;
                            // ===========================================================

                            $msg =  $_SESSION['tmp_cart'];

                            // ===========================================================
                            // mostra string json
                                echo json_encode($msg);
                            // ===========================================================                        

                        }
                        else
                        {
                            //$this->finalize_order_summary_modal();
                            // ===========================================================
                            // existe customer logado
                            // ===========================================================

                            // ===========================================================
                            // redirecionar para a pagina finalizar order resumo
                               Store::redirect('finalize_order_summary_modal');
                            // ===========================================================
                        }
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // finalizar order resumo / finalize order summary
                public function finalize_order_summary_modal()
                {
                    // ===========================================================
                    // verifica se existe customer logado
                        if(!isset($_SESSION['customer'])){
                            //Store::redirect('home_page');
                        }
                        else
                        {

                        }
                    // ===========================================================

                    // ===========================================================
                    // informações de cada product do cart
                        $ids = [];
                        foreach ($_SESSION['cart'] as $id_product => $quantity) {
                            array_push($ids, $id_product);
                        }
                        $ids = implode(",", $ids);
                    // ===========================================================

                    // ===========================================================
                    // criar product
                        $products = new products();
                    // ===========================================================

                    // ===========================================================
                    // ir buscar data de cada product
                        $resultados = $products->search_products_by_ids($ids);
                    // ===========================================================


                    // ===========================================================
                    // Para cada product no cart
                        $data_temp = [];
                        foreach ($_SESSION['cart'] as $id_product => $quantity_cart)
                        {

                            // ===========================================================
                            // guardar data de cada product
                                foreach ($resultados as $product)
                                {
                                    if ($product->id_product == $id_product)
                                    {
                                        // ===========================================================
                                        // data do product
                                            $id_product = $product->id_product;
                                            $image = $product->image;
                                            $titulo = $product->product_name;
                                            $quantity = $quantity_cart;
                                            $price = $product->price * $quantity;
                                        // ===========================================================

                                        // ===========================================================
                                        // colocar o product na coleção
                                            array_push($data_temp, [
                                                'id_product' => $id_product,
                                                'image' => $image,
                                                'titulo' => $titulo,
                                                'quantity' => $quantity,
                                                'price' => $price
                                            ]);
                                        // ===========================================================
                                        break;
                                    }
                                }
                            // ===========================================================
                        }
                    // ===========================================================

                    // ===========================================================
                    // calcular o total
                        $total_da_order = 0;
                        foreach ($data_temp as $item) {
                            $total_da_order += $item['price'];
                        }
                    // ===========================================================

                    // ===========================================================
                    // coloca o total da encomenda na coleccao
                        array_push($data_temp, $total_da_order);
                    // ===========================================================

                    //Store::printData($data_temp);

                    // ===========================================================
                    // preparar os data da view
                        $data = [];
                        $data['cart'] = $data_temp;
                    // ===========================================================

                    // ===========================================================
                    // buscar informações do customer
                        $customer = new Customers();
                        $data_customer = $customer->search_data_customer($_SESSION['customer']);
                        $data['customer'] = $data_customer;
                    // ===========================================================

                    // ===========================================================
                    // gerar o código da order
                        if(!isset($_SESSION['order_code'])){
                            $order_code = Store::order_code_generator();
                            $_SESSION['order_code'] = $order_code;
                        }

                    // ===========================================================



                                            $msg = '';

                                            $msg .='<div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">A sua order - resumo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>';


                                                    $msg .='<div id="corpo_finalizar" class="modal-body">
                                                    <table class="table">                 
                                                    <thead>
                                                        <tr>
                                                            <th>product</th>
                                                            <th class="text-center">quantity</th>
                                                            <th class="text-end">Valor total</th>
                                                        </tr>
                                                    </thead>

                                                        <tbody>';

                                                            // ===========================================================
                                                            // variáveis
                                                                if(!empty($data) && is_array($data))
                                                                {
                                                                    extract($data);
                                                                }
                                                            // ===========================================================
                                                        
                                                        $index = 0;
                                                        $total_rows = count($cart);
                                                    
                                                        foreach ($cart as $product) : 
                                                            if ($index < $total_rows - 1) : 
                                                                
                                                            $msg .='<tr>
                                                                <td class="align-middle">'. $product['titulo'] .'</td>
                                                                        <td class="text-center align-middle">'.$product['quantity'] .'</td>
                                                                        <td class="text-end align-middle">'. number_format($product['price'], 2, ',', '.') . '€';
                                                                        $msg.='</td>
                                                                    </tr>';
                                                            else : 
                                                                $msg .='<tr>
                                                                        <td></td>
                                                                        <td class="text-end">
                                                                            <h4>Total:</h4>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            <h4>'.number_format($product, 2, ',', '.') . '€';
                                                                $msg .='</h4>
                                                                        </td>
                                                                    </tr>';
                                                            endif; 
                                                            $index++; 
                                                        endforeach; 


                                                        $msg .='</tbody>
                                                    </table>';
                                                    
                                                    $msg .='<h5 class="bg-dark text-white p-2">Dados do Cliente</h5>
                                                    <div class="row">
                                                            <div class="col">
                                                                <p>Nome: <strong>'.$customer->full_name.'</strong></p>
                                                                <p>address: <strong>'.$customer->address.'</strong></p>
                                                                <p>city: <strong>'. $customer->city.'</strong></p>
                                                            </div>
                                                        
                                                            <div class="col">
                                                                <p>Email: <strong>'. $customer->email.'</strong></p>
                                                                <p>telephone: <strong>'. $customer->telephone.'</strong></p>
                                                            </div>

                                                    </div>
                                                <h5 class="bg-dark text-white p-2">Dados do Pagamento</h5>
                                                    <div class="row">
                                                            <div class="col">
                                                                <p>Conta bancária: PT50019300001050349850226</p>
                                                                <p>Código da order: <strong>'. $_SESSION['order_code'] .'</strong></p>
                                                                <p>Total: <strong>'. number_format($product, 2, ',', '.') . '€' .'</strong></p>
                                                            </div>
                                                    </div>';

                                                    $msg .='<h5 class="bg-dark text-white p-2">address alternativa de entrega</h5>
                                                <div class="form-check">
                                                    <input class="form-check-input" onchange="use_alternative_address()" type="checkbox" name="check_address_alternativa" id="check_address_alternativa">
                                                    <label class="form-check-label" for="check_address_alternativa">Definir uma address alternativa.</label>
                                                </div>
                                                <div id="address_alternativa" style="display: none">  
                                                        <div class="mb-3">
                                                            <label class="form-label">address:</label>
                                                            <input class="form-control" type="text" id="text_address_alternativa">
                                                        </div>
                                                
                                                        <div class="mb-3">
                                                            <label class="form-label">city:</label>
                                                            <input class="form-control" type="text" id="text_city_alternativa">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email:</label>
                                                            <input class="form-control" type="email" id="text_email_alternativo">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">telephone:</label>
                                                            <input class="form-control" type="text" id="text_telephone_alternativo">
                                                        </div>
                                                </div>';
                                                    
                                                    
                                                    
                                                    $msg .='</div>';


                                                    

                                                    $msg .='<div class="modal-footer">
                                                    <div class="row my-5">
                                                    <div class="col">
                                                            <a href="" class="mb-3 btn btn-black text-uppercase filter-btn m-2 data-bs-dismiss="modal"">Cancelar</a>
                                                    </div>
                                                            
                                                    <div class="col text-end">
                                                            
                                                    </div>

                                                    <div class="col text-end">
                                                        <button  onclick="apresentarModalConfirmedOrder()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"  data-bs-dismiss="modal">Confirmar encomenda</button>
                                                    </div>  

                                                 
                                            </div>
                                                    </div>';          

                                              /*  <a href="?a=confirm_order" onclick="alternative_address()" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Confirmar order</a> */

                                            echo json_encode($msg);


                                          /*  <div class="col text-end">
                                            <button  onclick="alternative_address_modal()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"  data-bs-dismiss="modal">Confirmar order modal</button>
                                        </div>      */          



                }
            // ===========================================================            

            // ===========================================================
            // address_alternativa / alternative address
                public function alternative_address()
                {
                    // ===========================================================
                    // receber os data via AJAX(axios)
                        $post = json_decode(file_get_contents('php://input'), true);
                    // ===========================================================

                    // ===========================================================
                    // adiciona ou altera na sessão a variável (coleção / array) data_alternative
                        $_SESSION['data_alternative'] = [
                            'text_email' => $post['text_email'],
                            'city' => $post['text_city'],
                            'email' => $post['text_email'],
                            'telephone' => $post['text_telephone'],
                        ];
                    // ===========================================================

                    // ===========================================================
                    // mostrar string json
                        echo json_encode($_SESSION['data_alternative']);
                    // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // address_alternativa / alternative address
                public function alternative_address_modal()
                {
                  // ===========================================================
                  // receber os data via AJAX(axios)
                      $post = json_decode(file_get_contents('php://input'), true);
                  // ===========================================================
                  // ===========================================================
                  // adiciona ou altera na sessão a variável (coleção / array) data_alternative
                      $_SESSION['data_alternative'] = [
                          'text_email' => $post['text_email'],
                          'city' => $post['text_city'],
                          'email' => $post['text_email'],
                          'telephone' => $post['text_telephone'],
                      ];
                  // ===========================================================
                  // ===========================================================
                  // redirecionar para a pagina de login
                       Store::redirect('store');
                  // ===========================================================                        
                  
                  // ===========================================================
                  // mostra string json
                      echo json_encode($_SESSION['data_alternative']);
                  // ===========================================================
                }
            // ===========================================================            

            // ===========================================================
            // confirmar order / confirm_order
                public function confirm_order()
                {
                                    

                                        // ===========================================================
                                        // verifica se existe customer logado
                                            if(!isset($_SESSION['customer']))
                                            {
                                                Store::redirect('home_page');
                                            }
                                        // ===========================================================

                                        // ===========================================================
                                        // verifica se pode avançar para a gravação da order
                                            if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
                                            {
                                                Store::redirect('home_page');
                                                return;
                                            }
                                        // ===========================================================

                                        // ===========================================================
                                        // enviar email para o customer com os data da order e pagamento
                                            $data_order = [];
                                        // ===========================================================

                                        // ===========================================================
                                        // buscar os data dos products
                                            $ids = [];
                                            foreach ($_SESSION['cart'] as $id_product => $quantity) {
                                                array_push($ids, $id_product);
                                            }
                                            $ids = implode(",", $ids);
                                            $products = new products();
                                            $products_da_order = $products->search_products_by_ids($ids);
                                        // ===========================================================

                                        // ===========================================================
                                        // estrutura dos data dos products
                                            $string_products = [];

                                            foreach($products_da_order as $resultado)
                                            {

                                                // quantity
                                                $quantity = $_SESSION['cart'][$resultado->id_product];

                                                // string do product
                                                $string_products[] = "$quantity x $resultado->product_name - " . number_format($resultado->price,2,',','.') . '€ / Uni.';
                                            }
                                        // ===========================================================

                                        // ===========================================================
                                        // lista de products para o email
                                            $data_order['products_list'] = $string_products;
                                        // ===========================================================

                                        // ===========================================================
                                        // price total da order para o email
                                            $data_order['total'] = number_format($_SESSION['total_order'],2,',','.') . '€';
                                        // ===========================================================

                                        // ===========================================================
                                        // data de pagamento
                                            $data_order['payment_data'] = [
                                                'numero_conta' => 'PT50019300001050349850226',
                                                'order_code' => $_SESSION['order_code'],
                                                'total' => number_format($_SESSION['total_order'],2,',','.') . '€'
                                            ];
                                        // ===========================================================

                                        // ===========================================================
                                        // enviar o email para o customer com os data da order
                                            $email = new SendEmail();
                                            $resultado = $email->send_order_confirmation_email($_SESSION['user'], $data_order);
                                        // ===========================================================

                                        // ===========================================================
                                        // guardar na base de data a order
                                            $data_order = [];
                                            $data_order['id_customer'] = $_SESSION['customer'];
                                        // ===========================================================

                                        // ===========================================================
                                        // address
                                            if(isset($_SESSION['data_alternative']['address']) && !empty($_SESSION['data_alternative']['address']))
                                            {
                                                // ===========================================================
                                                // considerar a address alternativa
                                                    $data_order['address'] = $_SESSION['data_alternative']['address'];
                                                    $data_order['city'] = $_SESSION['data_alternative']['city'];
                                                    $data_order['email'] = $_SESSION['data_alternative']['email'];
                                                    $data_order['telephone'] = $_SESSION['data_alternative']['telephone'];
                                                // ===========================================================
                                            }
                                            else
                                            {
                                                // ===========================================================
                                                // considerar a address do customer na base de data
                                                    $CLIENTE = new Customers();
                                                    $data_customer = $CLIENTE->search_data_customer($_SESSION['customer']);

                                                    $data_order['full_name'] = $data_customer->full_name;
                                                    $data_order['address'] = $data_customer->address;
                                                    $data_order['city'] = $data_customer->city;
                                                    $data_order['email'] = $data_customer->email;
                                                    $data_order['telephone'] =$data_customer->telephone;
                                                // ===========================================================
                                            }
                                        // ===========================================================

                                        // ===========================================================
                                        // codigo order
                                            $data_order['order_code'] = $_SESSION['order_code'];
                                        // ===========================================================

                                        // ===========================================================
                                        // status
                                            $data_order['status'] = 'PENDENT';
                                            $data_order['message'] = '';
                                        // ===========================================================

                                        // ===========================================================
                                        // data dos products da order
                                        // $products_da_order (product_name, price)
                                            $data_products = [];
                                            foreach($products_da_order as $product)
                                            {
                                                $data_products[] = [
                                                    'product_name' => $product->product_name,
                                                    'unit_price' => $product->price,
                                                    'quantity' => $_SESSION['cart'][$product->id_product]
                                                ];
                                            }
                                        // ===========================================================

                                        // ===========================================================
                                        // guardar order
                                            $order = new Orders(); // criar order
                                            $order->save_order($data_order, $data_products);
                                        // ===========================================================

                                        // ===========================================================
                                        // preparar data para apresentar na página de agradecimento
                                            $order_code = $_SESSION['order_code'];
                                            $total_order = $_SESSION['total_order'];
                                        // ===========================================================

                                        // ===========================================================
                                        // limpar todos os data da order que estão no cart
                                            unset($_SESSION['order_code']);
                                            unset($_SESSION['cart']);
                                            unset($_SESSION['total_order']);
                                            unset($_SESSION['data_alternative']);
                                        // ===========================================================

                                        // ===========================================================
                                        // apresenta a página a agradecer a order
                                            $data = [
                                                'order_code' => $order_code,
                                                'total_order' => $total_order
                                            ];

                                        // Store::printData($data);

                                            Store::Layout([
                                                'layouts/html_header',
                                                'layouts/header',
                                                'confirmed_order',
                                                'layouts/footer',
                                                'layouts/html_footer',
                                            ], $data);
                                        // ===========================================================
                }
            // ===========================================================

            // ===========================================================
            // confirmar order modal / confirm_order modal
                public function confirm_order_modal()
                {
                   // ===========================================================
                   // verifica se existe customer logado
                       if(!isset($_SESSION['customer']))
                       {
                           Store::redirect('home_page');
                       }
                   // ===========================================================

                   // ===========================================================
                   // verifica se pode avançar para a gravação da order
                       if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
                       {
                           Store::redirect('home_page');
                           return;
                       }
                   // ===========================================================4

                   // ===========================================================
                   // receber os data via AJAX(axios)
                     /*  $post = json_decode(file_get_contents('php://input'), true);
                   // ===========================================================

                   // ===========================================================
                   // adiciona ou altera na sessão a variável (coleção / array) data_alternative
                       $_SESSION['data_alternative'] = [
                           'text_email' => $post['text_email'],
                           'city' => $post['text_city'],
                           'email' => $post['text_email'],
                           'telephone' => $post['text_telephone'],
                       ];*/
                   // ===========================================================       
                   
                   // ===========================================================
                   // enviar email para o customer com os data da order e pagamento
                       $data_order = [];
                   // ===========================================================

                   // ===========================================================
                   // pesquisar dados dos produtos
                       $ids = [];
                       foreach ($_SESSION['cart'] as $id_product => $quantity) {
                           array_push($ids, $id_product);
                       }
                       $ids = implode(",", $ids);
                       $products = new products();
                       $products_da_order = $products->search_products_by_ids($ids);
                   // ===========================================================

                   // ===========================================================
                   // estrutura dos dados dos produtos
                       $string_products = [];
                       foreach($products_da_order as $resultado)
                       {
                           // quantity
                           $quantity = $_SESSION['cart'][$resultado->id_product];
                           // string do product
                           $string_products[] = "$quantity x $resultado->product_name - " . number_format($resultado->price,2,',','.') . '€ / Uni.';
                       }
                   // ===========================================================

                   // ===========================================================
                   // lista de products para o email
                       $data_order['products_list'] = $string_products;
                   // ===========================================================

                   // ===========================================================
                   // price total da order para o email
                       $data_order['total'] = number_format($_SESSION['total_order'],2,',','.') . '€';
                   // ===========================================================

                   // ===========================================================
                   // data de pagamento
                       $data_order['payment_data'] = [
                           'numero_conta' => 'PT50019300001050349850226',
                           'order_code' => $_SESSION['order_code'],
                           'total' => number_format($_SESSION['total_order'],2,',','.') . '€'
                       ];
                   // ===========================================================

                   // ===========================================================
                   // enviar o email para o customer com os data da order
                       $email = new SendEmail();
                       $resultado = $email->send_order_confirmation_email($_SESSION['user'], $data_order);
                   // ===========================================================

                   // ===========================================================
                   // guardar na base de data a order
                       $data_order = [];
                       $data_order['id_customer'] = $_SESSION['customer'];
                   // ===========================================================

                   // ===========================================================
                   // address
                       if(isset($_SESSION['data_alternative']['address']) && !empty($_SESSION['data_alternative']['address']))
                       {
                           // ===========================================================
                           // considerar a address alternativa
                               $data_order['address'] = $_SESSION['data_alternative']['address'];
                               $data_order['city'] = $_SESSION['data_alternative']['city'];
                               $data_order['email'] = $_SESSION['data_alternative']['email'];
                               $data_order['telephone'] = $_SESSION['data_alternative']['telephone'];
                           // ===========================================================
                       }
                       else
                       {
                           // ===========================================================
                           // considerar a address do customer na base de data
                               $CLIENTE = new Customers();
                               $data_customer = $CLIENTE->search_data_customer($_SESSION['customer']);
                               $data_order['full_name'] = $data_customer->full_name;
                               $data_order['address'] = $data_customer->address;
                               $data_order['city'] = $data_customer->city;
                               $data_order['email'] = $data_customer->email;
                               $data_order['telephone'] =$data_customer->telephone;
                           // ===========================================================
                       }
                   // ===========================================================
                   // ===========================================================
                   // codigo order
                       $data_order['order_code'] = $_SESSION['order_code'];
                   // ===========================================================

                   // ===========================================================
                   // status
                       $data_order['status'] = 'PENDENT';
                       $data_order['message'] = '';
                   // ===========================================================

                   // ===========================================================
                   // dados dos productos da order
                       $data_products = [];
                       foreach($products_da_order as $product)
                       {
                           $data_products[] = [
                               'product_name' => $product->product_name,
                               'unit_price' => $product->price,
                               'quantity' => $_SESSION['cart'][$product->id_product]
                           ];
                       }
                   // ===========================================================

                   // ===========================================================
                   // guardar encomenda
                       $order = new Orders(); // criar order
                       $order->save_order($data_order, $data_products);
                   // ===========================================================

                   // ===========================================================
                   // preparar dados para apresentar na página de agradecimento
                       $order_code = $_SESSION['order_code'];
                       $total_order = $_SESSION['total_order'];
                   // ===========================================================

                   // ===========================================================
                   // limpar todos os dados da encomenda que estão no carrinho
                       unset($_SESSION['order_code']);
                       unset($_SESSION['cart']);
                       unset($_SESSION['total_order']);
                       unset($_SESSION['data_alternative']);
                   // ===========================================================

                   // ===========================================================
                   // apresenta modal a agradecer a encomenda
                       // ===========================================================
                       // array com dados da encomenda
                           $data = [
                               'order_code' => $order_code,
                               'total_order' => $total_order
                           ];
                       // ===========================================================
                       
                       // ===========================================================
                       // string vazia
                           $msg = '';
                       // ===========================================================

                       // ===========================================================
                       // modal-header                                            
                           $msg.='<div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Encomenda confirmada</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>';
                       // ===========================================================                                                    
                       
                       // ===========================================================
                       // modal-body 
                           $msg.='<div id="corpo_finalizar" class="modal-body">
                               <p>Muito obrigado pela sua order.</p>
                               <div class="my-5">
                               <h4>Dados de pagamento</h4>
                               <p>Conta bancária: PT50019300001050349850226</p>
                               <p>Codigo da order: <strong>'. $order_code  .'</strong></p>
                               <p>Total da order: <strong>'. 
                               number_format($total_order, 2, ',', '.'). '€'.'</strong></p>
                               </div>
                               <p>
                                   Vai receber um email com a confrimação da order
                               <br>
                               A sua order só será processada após confirmação do pagamento.
                               </p>
                               <p><small>Por favor verifique se o email aparece na sua conta ou se foi para a pasta do SPAM.</small></p>                                    
                           </div>'; 
                       // ===========================================================

                       // ===========================================================
                       // modal-footer
                           $msg.='<div class="modal-footer">
                               <div class="my-5"><a class="mb-3 btn btn-black text-uppercase filter-btn m-2" data-bs-dismiss="modal">Voltar</a></div>
                           </div>  ';    
                       // ===========================================================

                       // ===========================================================
                       // mostrar string json
                           echo json_encode($msg);
                       // ===========================================================

                   // ===========================================================
                }
            // ===========================================================            

        }
    // ================================================================

