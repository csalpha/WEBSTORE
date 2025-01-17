<!-- container-fluid -->
<!-- ===================================================================================================== -->
    <div class="container-fluid">
        
        <!-- row -->
        <!-- ===================================================================================================== -->
            <div class="row">
            <!-- col-12 -->
            <!-- ===================================================================================================== -->
                <div class="col-12">
                    <h1 class="text-center">Detalhe da order</h1>
                    <!-- row -->
                    <!-- ===================================================================================================== -->
                        <div class="row">

                            <!-- col -->
                            <!-- ===================================================================================================== -->                            
                                <div class="col">
                                    <!-- Data da encomenda -->
                                    <!-- ===================================================================================================== -->
                                        <div class="p-2 my-3">
                                            <span><strong>Data da order</strong></span><br>
                                            <?= $data_order->order_date ?>
                                        </div>
                                    <!-- ===================================================================================================== -->

                                    <!-- Morada -->
                                    <!-- ===================================================================================================== -->                                        
                                        <div class="p-2 my-3">
                                            <span><strong>address</strong></span><br>
                                            <?= $data_order->address ?>
                                        </div>
                                    <!-- ===================================================================================================== -->

                                    <!-- Cidade -->
                                    <!-- ===================================================================================================== -->
                                        <div class="p-2 my-3">
                                            <span><strong>city</strong></span><br>
                                            <?= $data_order->city ?>
                                        </div>
                                    <!-- ===================================================================================================== -->
                                </div>
                            <!-- ===================================================================================================== -->

                            <!-- col -->
                            <!-- ===================================================================================================== -->                            
                                <div class="col">
                                    <!-- email -->
                                    <!-- ===================================================================================================== -->                                    
                                        <div class="p-2 my-3">
                                            <span><strong>Email</strong></span><br>
                                            <?= $data_order->email ?>
                                        </div>
                                    <!-- ===================================================================================================== -->

                                    <!-- telephone -->
                                    <!-- ===================================================================================================== -->                                    
                                        <div class="p-2 my-3">
                                            <span><strong>Telephone</strong></span><br>
                                            <?= !empty($data_order->telephone) ? $data_order->telephone : '&nbsp;' ?>
                                        </div>
                                    <!-- ===================================================================================================== -->
                                    
                                    <!-- Código da encomenda -->
                                    <!-- ===================================================================================================== -->                                    
                                        <div class="p-2 my-3">
                                            <span><strong>Código da encomenda</strong></span><br>
                                            <?= $data_order->order_code ?>
                                        </div>
                                    <!-- ===================================================================================================== -->
                                </div>
                            <!-- ===================================================================================================== -->    

                            <!-- col -->
                            <!-- ===================================================================================================== -->                            
                                <div class="col align-self-center">
                                    <!-- Status da encomenda -->
                                    <!-- ===================================================================================================== -->                                    
                                        <div class="text-center mb-3">
                                            Estado da encomenda
                                        </div>
                                        <div>
                                            <h4 class="text-center" class="nav-it"><?= $data_order->status ?></h4>
                                        </div>
                                    <!-- ===================================================================================================== -->                                    
                                </div>
                            <!-- ===================================================================================================== -->

                        </div>
                    <!-- ===================================================================================================== -->

                    <!-- row mb-5 -->
                    <!-- ===================================================================================================== -->                    
                        <div class="row mb-5">
                            <!-- col -->
                            <!-- ===================================================================================================== -->                             
                                <div class="col">
                                    <!-- table -->
                                    <!-- ===================================================================================================== -->                                    
                                        <table class="table">
                                            <!-- thead -->
                                            <!-- ===================================================================================================== --> 
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Price Whithout VAT</th>
                                                        <th class="text-end">Preço / Uni.</th>
                                                    </tr>
                                                </thead>
                                            <!-- ===================================================================================================== --> 

                                            <!-- tbody -->
                                            <!-- ===================================================================================================== -->                                        
                                                <tbody>
                                                    <!-- produtos da encomenda -->
                                                    <!-- ===================================================================================================== -->                                                    
                                                        <?php 
                                                        
                                                            $total_order = 0; 
                                                            $total_quantity = 0; 
                                                            $total_whithout_VAT = 0; 

                                                            foreach($order_products as $product): ?>

                                                            <?php 

                                                                $preco = $product->quantity * $product->unit_price; 
                                                                $price_whithout_VAT = $product->quantity * ($product->unit_price / 1.23);
                                                                $total_order += $preco; 
                                                                $total_quantity += $product->quantity; 
                                                                $total_whithout_VAT += $price_whithout_VAT; 

                                                            ?>
                                                            <tr>
                                                                <td><?= $product->product_name ?></td>
                                                                <td class="text-center"><?= $product->quantity ?></td>
                                                                <td class="text-center"><?= number_format($price_whithout_VAT, 2,',','.') . '€' ?></td>
                                                                <td class="text-end"><?= number_format($preco,2,',','.') . ' €' ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <!-- ===================================================================================================== -->
                                                    
                                                    <!-- linha com total -->
                                                    <!-- ===================================================================================================== -->                                                
                                                        <tr>
                                                            <td><strong></strong></td>
                                                            <td class="text-center"><strong><?= $total_quantity ?></strong></td>
                                                            <td class="text-center"><strong><?= number_format($total_whithout_VAT, 2,',','.') . '€' ?></strong></td>
                                                            <td colspan="12" class="text-end"><strong><?= number_format($total_order,2,',','.') . ' €'?></strong></td>
                                                        </tr>
                                                    <!-- ===================================================================================================== -->
                                                </tbody>
                                            <!-- ===================================================================================================== -->     
                                        </table>
                                    <!-- ===================================================================================================== -->                  
                                </div>
                             <!-- ===================================================================================================== -->
                        </div>
                    <!-- ===================================================================================================== -->                    

                    <!-- row -->
                    <!-- ===================================================================================================== -->
                        <div class="row">
                            <div class="col text-center mb-5">
                                <a href="?a=order_history" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Voltar</a>
                            </div>
                            <div class="mb-5">
                                &nbsp;
                            </div>
                        </div>
                    <!-- ===================================================================================================== -->                
                </div>
            <!-- ===================================================================================================== -->
            </div>
        <!-- ===================================================================================================== -->

    </div>
<!-- ===================================================================================================== -->