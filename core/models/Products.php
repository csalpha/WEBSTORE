<?php

namespace core\models;

// ================================================================
// carregar classes
    use core\classes\Database;
    use core\classes\Store;
// ================================================================

// ================================================================
// class products
    class products
    {
        // ===========================================================
        // lista products disponiveis
            public function products_list_available($category)
            {
                // ===========================================================
                // criar uma base de dados
                    $bd = new Database();  
                // ===========================================================     
                
                // ===========================================================
                // buscar a lista de categorys da store
                    $categorys = $this->category_list();
                // ===========================================================

                // ===========================================================
                // query - vai buscar as informações dos products da bd
                    $sql = "SELECT * FROM products ";
                    $sql .= "WHERE visible = 1 ";
                // ===========================================================

                // ===========================================================
                // avaliar se a 'category' esta no array 'categorys'
                    if(in_array($category, $categorys))
                    {
                        $sql .= "AND category = '$category'";
                    }
                // ===========================================================
                
                // ===========================================================
                // executa query
                    $products = $bd->select($sql);
                    return $products;
                // ===========================================================
            }
        // ===========================================================

        // ===========================================================
        // lista categorys
            public function category_list()
            {
                // ===========================================================
                // devolve a lista de categorys existentes na base de dados
                    $bd = new Database(); // criar bd
                    $resultados = $bd->select("SELECT DISTINCT category FROM products");
                    $categorys = [];

                    foreach($resultados as $resultado)
                    {
                        array_push($categorys, $resultado->category);
                    }



                    return $categorys;
                // ===========================================================
            }
        // ===========================================================

        // ===========================================================
        // lista categorys
            public function count_category()
            {
                // ===========================================================
                // devolve a lista de categorys existentes na base de dados
                    $bd = new Database(); // criar bd
                    $resultados = $bd->select("SELECT DISTINCT category FROM products");
                    $categorys = [];

                    $tot_category = 0;
                    foreach($resultados as $resultado)
                    {
                        array_push($categorys, $resultado->category);

                        $tot_category++;
                    }

                    return $tot_category;
                // ===========================================================
            }
        // ===========================================================

        // ===========================================================
        // verificar stock product
            public function check_stock_product($id_product)
            {
                // ===========================================================
                // verifica se product tem stock (devolve true / false)
                    $bd = new Database(); // criar bd
                    $parameters = [
                        ':id_product' => $id_product
                    ];
                    $resultados = $bd->select("
                        SELECT * FROM products 
                        WHERE id_product = :id_product
                        AND visible = 1
                        AND stock > 0
                    ", $parameters);
                    //se product tiver stock devolve true, senao devolve false
                    return count($resultados) != 0 ? true : false;
                // ===========================================================
            }
        // ===========================================================        

        // ===========================================================
        // buscar products por ids
            public function search_products_by_ids($ids)
            {
                // ===========================================================
                // executa query que vai buscar todos os prod. do array ids
                    $bd = new Database();
                    return $bd->select("
                        SELECT * FROM products
                        WHERE id_product IN ($ids)
                    ");
                // ===========================================================
            }
        // ===========================================================   
        
        // ===========================================================
        // atualizar data product
            public function update_product( 
            $id_product  ,
            $product_name,
            $category    ,
            $price       ,
            $stock       ,
            $description )
            {
                // ===========================================================
                // atualiza os data do customer indicados na bd

                    $parameters = [
                        ':id_product'       =>   $id_product,
                        ':product_name'     =>   $product_name,
                        ':category'         =>   $category,
                        ':price'            =>   $price,
                        ':stock'            =>   $stock,
                        ':description'      =>   $description
                    ];

                    $bd = new Database();


                    $bd->update("
                        UPDATE Products
                        SET
                            product_name = :product_name,
                            category = :category,
                            price = :price,
                            stock = :stock,
                            description = :description
                        WHERE id_product = :id_product
                    ", $parameters);
                // ===========================================================
                //Store::printData($parameters);

            }
        // ===========================================================          
        
        
    }
// ================================================================

