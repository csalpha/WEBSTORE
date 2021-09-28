
<?php 
 use core\classes\Store;

 //Store::printData($cart);

?>



<!-- container -->
<!-- ===================================================================================================== -->
    <div class="container">
        <!-- row -->
        <!-- ===================================================================================================== -->
            <div class="row">
                <!-- col -->
                <!-- ===================================================================================================== -->            
                    <div class="col">
                        <h3 class="my-3">A sua encomenda</h3>
                        <hr>
                    </div>
                <!-- ===================================================================================================== -->                
            </div>
        <!-- ===================================================================================================== -->
    </div>
<!-- ===================================================================================================== -->

<!-- container -->
<!-- ===================================================================================================== -->
    <div class="container">
        <!-- row -->
        <!-- ===================================================================================================== -->
            <div class="row">
                <!-- col -->
                <!-- ===================================================================================================== -->
                    <div class="col">
                        <?php if ($cart == null) : ?>
                            <p class="text-center">Não existem produtos no carrinho.</p>
                            <div class="mt-4 text-center">
                                <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Ir para a loja</a>
                            </div>
                        <?php else : ?>

                            <div style="margin-bottom: 80px;">
                                <!-- table -->
                                <!-- ===================================================================================================== -->                            
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
                                        <tbody>
                                            <?php
                                            $index = 0;
                                            $total_rows = count($cart);
                                            ?>
                                            <?php foreach ($cart as $product) : ?>
                                                <?php if ($index < $total_rows - 1) : ?>

                                                    <!-- lista dos products -->
                                                    <tr>
                                                        <td><img src="assets/images/products/<?= $product['image']; ?>" class="img-fluid" width="50px"></td>
                                                        <td class="align-middle"><h5><?= $product['titulo'] ?></h5></td>
                                                        <td class="text-center align-middle"><h5><?= $product['quantity'] ?></h5></td>
                                                        <td class="text-end align-middle"><h4><?= number_format($product['price'],2,',','.') . '€' ?></h4></td>
                                                        <td class="text-center align-middle">
                                                            <a href="?a=remove_product_cart&id_product=<?= $product['id_product'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                                        </td>
                                                    </tr>

                                                <?php else : ?>

                                                    <!-- total -->
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-end"><h3>Total:</h3></td>
                                                        <td class="text-end"><h3><?= number_format($product,2,',','.') . '€' ?></h3></td>
                                                        <td></td>
                                                    </tr>

                                                <?php endif; ?>
                                                <?php $index++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <!-- ===================================================================================================== -->

                                <!-- row -->
                                <!-- ===================================================================================================== -->                                
                                    <div class="row">
                                        <!-- col -->
                                        <!-- ===================================================================================================== -->                                        
                                            <div class="col">
                                                <!-- <a href="?a=clean_cart" class="btn btn-sm btn-primary">Limpar cart</a> -->
                                                <a href="?a=clean_cart" onclick="clean_cart()" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Limpar carrinho</a>
                                                <span class="ms-3" id="confirmar_clean_cart" style="display: none; ">Tem a certeza?
                                                    <button class="mb-3 btn btn-black text-uppercase filter-btn m-2" onclick="clean_cart_off()">Não</button>
                                                    <a href="?a=clean_cart" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Sim</a>
                                                </span>
                                            </div>
                                        <!-- ===================================================================================================== -->                                        

                                        <!-- col -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col text-end">
                                                <a href="?a=store" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Continuar a comprar</a>
                                                <a href="?a=finalize_order" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Finalizar encomenda</a>
                                            </div>
                                        <!-- ===================================================================================================== -->
                                    </div>
                                <!-- ===================================================================================================== -->
                            </div>

                        <?php endif; ?>
                    </div>
                <!-- ===================================================================================================== -->
            </div>
        <!-- ===================================================================================================== -->
    </div>
<!-- ===================================================================================================== -->