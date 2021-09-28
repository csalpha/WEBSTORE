<?php

use core\classes\Store;
                                            
//Store::printData($data);

?>

<!-- container-fluid -->
<!-- ===================================================================================================== -->
    <div class="container-fluid">
        <!-- row -->
        <!-- ===================================================================================================== -->        
            <div class="row mt-3 mb-5">
                <!-- col-md-2 -->
                <!-- ===================================================================================================== -->                                            
                    <div class="col-md-2">
                        <?php include(__DIR__ . '/layouts/admin_menu.php')?>
                    </div>
                <!-- ===================================================================================================== -->                            

                <!-- col-md-10 -->
                <!-- ===================================================================================================== -->                            
                    <div class="col-md-10">
                    <div class="col text-center">

                    <a href="?a=change_order_data&c=<?= Store::aes_encrypt($order->id_order) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar dados encomenda</a>
                    <!-- <a href="?a=change_password_admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i> Alterar encomenda</a> -->
                    <!-- <a href="?a=order_history" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="far fa-list-alt"></i> Histórico de encomendas</a> -->

</div>  
                        <!-- row -->
                        <!-- ===================================================================================================== -->                                
                            <div class="row">
                                <!-- col-md-10 -->
                                <!-- ===================================================================================================== -->                                
                                    <div class="col">
                                        <h4>DETALHE ENCOMENDA</h4><small><?= $order->order_code ?></small>
                                    </div>
                                <!-- ===================================================================================================== --> 

                                <!-- col -->
                                <!-- ===================================================================================================== -->                                
                                    <div class="col text-end">
                                        <div class="mb-3 btn btn-black text-uppercase filter-btn m-2" onclick="apresentarModal()"><?= $order->status?></div>
                                        <?php if($order->status == 'PROCESSING'):?>                       
                                        <div class="m1">
                                            <a href="?a=generate_pdf_order&e=<?= core\classes\Store::aes_encrypt($order->id_order)?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Ver PDF</a>
                                            <a href="?a=send_pdf_order&e=<?= core\classes\Store::aes_encrypt($order->id_order)?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Enviar PDF</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <!-- ===================================================================================================== -->                                
                            </div>
                        <!-- ===================================================================================================== -->                                                                    
                        <hr>
                        <!-- row -->
                        <!-- ===================================================================================================== -->                        
                            <div class="row">
                                <!-- col -->
                                <!-- ===================================================================================================== -->                                
                                    <div class="col">
                                        <p>Nome customer:<br><strong><?= $order->full_name ?></strong></p>
                                        <p>Email:<br><strong><?= $order->email ?></strong></p>
                                        <p>telephone:<br><strong><?= $order->telephone ?></strong></p>
                                    </div>
                                <!-- ===================================================================================================== -->                                

                                <!-- col -->
                                <!-- ===================================================================================================== -->
                                    <div class="col">
                                        <p>Data order:<br><strong><?= $order->order_date ?></strong></p>
                                        <p>address:<br><strong><?= $order->address ?></strong></p>
                                        <p>city:<br><strong><?= $order->city ?></strong></p>
                                    </div>
                                <!-- ===================================================================================================== -->                                
                            </div>
                        <!-- ===================================================================================================== -->                        
                        <hr>
                        <!-- table -->
                        <!-- ===================================================================================================== -->                        
                            <table class="table">
                                <!-- thead -->
                                <!-- ===================================================================================================== -->                                
                                    <thead>
                                        <th>product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price Whithout VAT</th>
                                        <th class="text-end">Price / Uni.</th>
                                    </thead>
                                <!-- ===================================================================================================== -->                                
                                <!-- tbody -->
                                <!-- ===================================================================================================== -->                            
                                    <tbody>

                                        <?php $total_order = 0; ?>
                                        <?php $total_quantity = 0; ?>
                                        <?php $total_whithout_VAT = 0; ?>

                                        <?php foreach($products_list as $product):?>
                                            <tr>
                                            <?php 
                                                    $preco = $product->quantity * $product->unit_price; 
                                                    $price_whithout_VAT = $product->quantity * ($product->unit_price / 1.23);
                                                    $total_order += $preco; 
                                                    $total_quantity += $product->quantity; 
                                                    $total_whithout_VAT += $price_whithout_VAT; 

                                                 ?>
                                                <td><?= $product->product_name ?></td>
                                                <td class="text-center"><?= $product->quantity ?></td>
                                                <td class="text-center"><?= number_format($price_whithout_VAT, 2,',','.') . '€' ?></td>
                                                <td class="text-end"><?=  preg_replace("/\./", ",", $product->unit_price) . '€' ?></td>

                                                 
                                            </tr>
                                        <?php endforeach;?>

                                        <!-- linha com total -->
                                        <!-- ===================================================================================================== -->                                                
                                        <tr>
                                                <td></td>
                                                <td class="text-center"><strong><?= $total_quantity ?></strong></td>
                                                <td class="text-center"><strong><?= number_format($price_whithout_VAT, 2,',','.') . ' €'?></strong></td>
                                                <td class="text-end"><strong><?= number_format($total_order, 2,',','.') . ' €'?></strong></td>
                                                
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
    </div>
<!-- ===================================================================================================== -->

<!-- modal -->
<!-- ===================================================================================================== -->
    <div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- modal dialog -->
        <!-- ===================================================================================================== -->
            <div class="modal-dialog modal-dialog-centered">
                <!-- modal content -->
                <!-- ===================================================================================================== -->                
                    <div class="modal-content">
                        <!-- modal header -->
                        <!-- ===================================================================================================== -->                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Alterar estado da order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <!-- ===================================================================================================== -->  
                        
                        <!-- modal body -->
                        <!-- ===================================================================================================== -->                        
                                <div class="modal-body">
                                    <div class="text-center">
                                        <?php
                                            
                                            //Store::printData($estado);
                                        
                                            foreach(STATUS as $estado): ?>
                                            <?php if($order->status == $estado):?>
                                                <p><?= $estado ?></p>
                                            <?php else:?>
                                                <p><a href="?a=order_change_status&e=<?= core\classes\Store::aes_encrypt($order->id_order) ?>&s=<?= $estado ?>" class="nav-it"><?= $estado ?></a></p>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                        <!-- ===================================================================================================== -->  
                        
                        <!-- modal footer -->
                        <!-- ===================================================================================================== -->                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        <!-- ===================================================================================================== -->   
                    </div>
                <!-- ===================================================================================================== -->                    
            </div>
        <!-- ===================================================================================================== -->        
    </div>
<!-- ===================================================================================================== -->

<!-- apresentar modal -->
<!-- ===================================================================================================== -->    
    <script>
        function apresentarModal(){
            var modalStatus = new bootstrap.Modal(document.getElementById('modalStatus'));
            modalStatus.show();
        }
    </script>
<!-- ===================================================================================================== -->