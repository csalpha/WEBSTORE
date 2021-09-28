    <!-- Carregar classes -->
    <!-- ===================================================================================================== -->
        <?php
        use core\classes\Store;
        ?>
    <!-- ===================================================================================================== -->

    <!-- container-fluid -->
    <!-- ===================================================================================================== -->
        
        <div class="container-fluid">
            <!-- row -->
            <!-- ===================================================================================================== -->
                <div class="row mt-3">
                    <!-- col -->
                    <!-- ===================================================================================================== -->
                        <div class="col-md-2">
                            <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
                        </div>
                    <!-- ===================================================================================================== -->

                    <!-- col -->
                    <!-- ===================================================================================================== -->
                        <div class="col-md-10">

                            <div class="col text-center">
                                <a href="?a=change_product_data&c=<?= Store::aes_encrypt($data_products->id_product) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar produto</a>
                            </div>  
                                <h3>Detalhe do product</h3>
                                <hr>
                                
                                <!-- row -->
                                <!-- ===================================================================================================== -->
                                    <div class="row mt-3">

                                        <!-- Picture -->
                                        <!-- ===================================================================================================== -->
                                        <div class="col-3 text-end fw-bold">Picture</div>
                                        <div class="col-9"><img src="../assets/images/products/<?= $data_products->image ?>" class="img-fluid" width="40px"></div>
                                        <!-- ===================================================================================================== -->                                         
                               

                                        <!-- Código -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Código:</div>
                                            <div class="col-9"><?= $data_products->id_product ?></div>
                                        <!-- ===================================================================================================== -->

                                        <!-- product -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">product:</div>
                                            <div class="col-9" onclick="apresentarModalName()"><a class="nav-it"><?= $data_products->product_name ?></a></div>
                                        <!-- ===================================================================================================== -->
                                    
                                        <!-- category -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">category:</div>
                                            <div class="col-9" onclick="apresentarModalCategory()"><?= $data_products->category ?></div>
                                        <!-- ===================================================================================================== -->

                                        <!-- price -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Preco:</div>
                                            <div class="col-9" onclick="apresentarModalPrice()">€ <?= $data_products->price ?> </div>
                                        <!-- ===================================================================================================== -->

                                        <?php  
                                                $preco_sem_iva = ( $data_products->price / 1.23 );
                                                $iva = $data_products->price - $preco_sem_iva;
                                        ?> 

                                        <!-- iva --> 
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Iva:</div>
                                            <div class="col-9" onclick="apresentarModalPriceVAT()">€ <?= round($iva, 2)  ?> </div>   
                                        <!-- ===================================================================================================== -->
                                        
                                        <!-- preco sem VAT --> 
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Preco / sem iva:</div>
                                            <div class="col-9" onclick="apresentarModalPriceWithoutVAT()">€ <?= round($preco_sem_iva, 2) ?> </div>   
                                        <!-- ===================================================================================================== -->               

                                        <!-- VAT price --> 
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">VAT:</div>
                                            <div class="col-9" onclick="apresentarModalVAT()"><?= $data_products->VAT * 100 ?> %</div>
                                        <!-- ===================================================================================================== -->               

                                        <!-- Stock -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Stock:</div>
                                            <div class="col-9" onclick="apresentarModalStock()"><?= $data_products->stock ?> unidades</div>   
                                        <!-- ===================================================================================================== -->             

                                        <!-- criado em -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Producto criado em:</div>
                                            <?php   $data = DateTime::createFromFormat('Y-m-d H:i:s', $data_products->created_at);  ?>
                                            <div class="col-9" onclick="apresentarModalCreatedAt()"><?= $data->format('d-m-Y H:i:s') ?></div>
                                        <!-- ===================================================================================================== -->
                                        
                                        <!-- actualizado em -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Actualizado em:</div>
                                            <?php
                                            $data = DateTime::createFromFormat('Y-m-d H:i:s', $data_products->updated_at);
                                            ?>
                                            <div class="col-9" onclick="apresentarModalUpdatedAt()"><?= $data->format('d-m-Y H:i:s') ?></div>    
                                        <!-- ===================================================================================================== -->           

                                        <!-- ativo -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">Estado:</div>
                                            <div class="col-9 " onclick="apresentarModal()"><?= $data_products->active == 0 ? '<span class="text-danger">Inativo</span>' : '<span class="text-success">Ativo</span>' ?></div>
                                        <!-- ===================================================================================================== -->

                                    </div>
                                <!-- ===================================================================================================== -->

                                <!-- row -->
                                <!-- ===================================================================================================== -->
                                    <div class="row mt-3">
                                        <div class="col-9 offset-3">
                                                <div class="col text-center">
                                                </div>
                                        </div>
                                    </div>
                                <!-- ===================================================================================================== -->
                        </div>
                    <!-- ===================================================================================================== -->
                </div>
            <!-- ===================================================================================================== -->
        </div>
    <!-- ===================================================================================================== -->

    <!-- modals -->
    <!-- ===================================================================================================== --> 
        <!-- modal status -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar estado product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <?php foreach(active as $estado): ?>
                                <?php if($data_products->active == $estado):?>
                                    <p><?= ($estado == 0) ? 'Inactive' : 'active' ?></p> 
                                <?php else:?>
                                    <p><a href="?a=product_change_status&e=<?= core\classes\Store::aes_encrypt($data_products->id_product) ?>&s=<?= $estado ?>" class="nav-it"><?= ($estado == 1) ? 'active' : 'Inactive' ?></a></p>
                                <?php endif;?>
                            <?php endforeach; ?>

                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModal(){
                    var modalStatus = new bootstrap.Modal(document.getElementById('modalStatus'));
                    modalStatus.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  category -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Categoria do Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                                    <p><?= $data_products->category ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalCategory(){
                    var modalCategory = new bootstrap.Modal(document.getElementById('modalCategory'));
                    modalCategory.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  name -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Nome do Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <p><?= $data_products->product_name ?></p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalName(){
                    var modalName = new bootstrap.Modal(document.getElementById('modalName'));
                    modalName.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  stock -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Stock do Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <p><?= $data_products->stock ?> unid</p>

                        </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalStock(){
                    var modalStock = new bootstrap.Modal(document.getElementById('modalStock'));
                    modalStock.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  Iva -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">VAT Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                                <?= $data_products->VAT * 100 ?> %
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalVAT(){
                    var modalVAT = new bootstrap.Modal(document.getElementById('modalVAT'));
                    modalVAT.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  price -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modalPrice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Price</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                                <p><?= $data_products->price ?> €</p>
                            </input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalPrice(){
                    var modalPrice = new bootstrap.Modal(document.getElementById('modalPrice'));
                    modalPrice.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  price without VAT -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modal_price_without_VAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Price without VAT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <p><?= $data_products->price_without_VAT ?> €</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalPriceWithoutVAT(){
                    var modal_price_without_VAT = new bootstrap.Modal(document.getElementById('modal_price_without_VAT'));
                    modal_price_without_VAT.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  price  VAT -->
        <!-- ===================================================================================================== -->
            <div class="modal fade" id="modal_price_VAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Price without VAT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <p><?= round($iva, 2) ?> €</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>

            <script>
                function apresentarModalPriceVAT(){
                    var modal_price_VAT = new bootstrap.Modal(document.getElementById('modal_price_VAT'));
                    modal_price_VAT.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  CreatedAt -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalCreatedAt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar CreatedAt</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_products->created_at ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalCreatedAt()
                    {
                        var modalCreatedAt = new bootstrap.Modal(document.getElementById('modalCreatedAt'));
                        modalCreatedAt.show();
                    }
                </script>
        <!-- ===================================================================================================== -->   

        <!-- modal  UpdatedAt -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalUpdatedAt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar UpdatedAt</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_products->updated_at ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalUpdatedAt()
                    {
                        var modalUpdatedAt = new bootstrap.Modal(document.getElementById('modalUpdatedAt'));
                        modalUpdatedAt.show();
                    }
                </script>
        <!-- ===================================================================================================== -->  
    <!-- ===================================================================================================== --> 