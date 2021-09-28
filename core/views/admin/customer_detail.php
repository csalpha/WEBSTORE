    <!-- carregar classes -->
    <!-- ===================================================================================================== -->
        <?php

        use core\classes\Store;
        ?>
    <!-- ===================================================================================================== -->

    <!-- container-fluid -->
    <!-- ===================================================================================================== -->
        <div class="container-fluid">

            <!-- row mt-3 -->
            <!-- ===================================================================================================== -->        
                <div class="row mt-3">

                    <!-- col-md-2 -->
                    <!-- ===================================================================================================== -->
                        <div class="col-md-2">
                            <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
                        </div>
                    <!-- ===================================================================================================== -->        

                    <!-- col-md-10 -->
                    <!-- ===================================================================================================== -->
                        <div class="col-md-10">

                        <div class="col text-center">

                            <a href="?a=change_customer_data&c=<?= Store::aes_encrypt($data_customer->id_customer) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar dados pessoais</a>
                            <a href="?a=change_password_customer&c=<?= Store::aes_encrypt($data_customer->id_customer) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i> Alterar a password</a>
                            <a href="?a=order_history_customer&c=<?= Store::aes_encrypt($data_customer->id_customer) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="far fa-list-alt"></i> Histórico de orders</a>
                        
                        </div>  
                        
                            <h3>Detalhe do customer</h3>
                            <hr>

                            <div class="row mt-3">
                                <!-- Picture -->
                                <!-- ===================================================================================================== -->
                                <div class="col-3 text-end fw-bold">Picture</div>
                                <div class="col-9"><img src="../assets/images/customers/<?= $data_customer->image ?>" class="img-fluid" width="40px"></div>
                                <!-- ===================================================================================================== -->                                 
                                <!-- Full Name -->
                                <div class="col-3 text-end fw-bold">Full Name:</div>
                                <div class="col-9" onclick="apresentarModalName()"><?= $data_customer->full_name ?></div>
                                <!-- address -->
                                <div class="col-3 text-end fw-bold">address:</div>
                                <div class="col-9" onclick="apresentarModalAddress()"><?= $data_customer->address ?></div>
                                <!-- city -->
                                <div class="col-3 text-end fw-bold">city:</div>
                                <div class="col-9" onclick="apresentarModalCity()"><?= $data_customer->city ?></div>
                                <!-- Telephone -->
                                <div class="col-3 text-end fw-bold">telephone:</div>
                                <div class="col-9" onclick="apresentarModalTelephone()"><?= empty($data_customer->telephone) ? '-' : $data_customer->telephone ?></div>
                                <!-- email -->
                                <div class="col-3 text-end fw-bold">Email:</div>
                                <div class="col-9" onclick="apresentarModalEmail()"><?= $data_customer->email ?></div>
                                <!-- ativo -->
                                <div class="col-3 text-end fw-bold">Estado:</div>
                                <div class="col-9" onclick="apresentarModal()"><?= $data_customer->active == 0 ? '<span class="text-danger">Inativo</span>' : '<span class="text-success">Ativo</span>' ?></div>
                                <!-- criado em -->
                                <div class="col-3 text-end fw-bold">Cliente desde:</div>
                                <?php
                                $data = DateTime::createFromFormat('Y-m-d H:i:s', $data_customer->created_at);
                                ?>
                                <div class="col-9" onclick="apresentarModalCreatedAt()"><?= $data->format('d-m-Y') ?></div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-9 offset-3">
                                    <?php if ($total_orders == 0) : ?>
                                        <div class="col text-center">
                                            <p class="text-muted">Não existem orders deste customer.</p>
                                        </div>
                                    <?php else : ?>
                                        <a href="?a=customer_order_history&c=<?= Store::aes_encrypt($data_customer->id_customer) ?>" class="nav-it" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Ver histórico de orders...</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <!-- ===================================================================================================== -->

                </div>
            <!-- ===================================================================================================== -->    

        </div>
    <!-- ===================================================================================================== -->   
    
    <!-- modals -->
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
                                        <h5 class="modal-title" id="exampleModalLabel">Alterar estado customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <!-- ===================================================================================================== -->    
                                
                                <!-- modal body -->
                                <!-- ===================================================================================================== -->
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <?php foreach (active as $estado) : ?>
                                                <?php if ($data_customer->active == $estado) : ?>
                                                    <p><?= ($estado == 0) ? 'Inactive' : 'active' ?></p>
                                                <?php else : ?>
                                                    <p><a href="?a=customer_change_status&e=<?= core\classes\Store::aes_encrypt($data_customer->id_customer) ?>&s=<?= $estado ?>" class="nav-it"><?= ($estado == 1) ? 'active' : 'Inactive' ?></a></p>
                                                <?php endif; ?>
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
                function apresentarModal() {
                    var modalStatus = new bootstrap.Modal(document.getElementById('modalStatus'));
                    modalStatus.show();
                }
            </script>
        <!-- ===================================================================================================== -->

        <!-- modal  name -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar Nome do Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_customer->full_name ?></p>

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

        <!-- modal  morada -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_customer->address ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalAddress(){
                        var modalAddress = new bootstrap.Modal(document.getElementById('modalAddress'));
                        modalAddress.show();
                    }
                </script>
        <!-- ===================================================================================================== -->

            <!-- modal  cidade -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar City</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_customer->city ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalCity()
                    {
                        var modalCity = new bootstrap.Modal(document.getElementById('modalCity'));
                        modalCity.show();
                    }
                </script>
        <!-- ===================================================================================================== -->

            <!-- modal  Telephone -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalTelephone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar Telephone</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_customer->telephone ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalTelephone()
                    {
                        var modalTelephone = new bootstrap.Modal(document.getElementById('modalTelephone'));
                        modalTelephone.show();
                    }
                </script>
        <!-- ===================================================================================================== -->

        <!-- modal  Email -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar Email</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_customer->email ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalEmail()
                    {
                        var modalEmail = new bootstrap.Modal(document.getElementById('modalEmail'));
                        modalEmail.show();
                    }
                </script>
        <!-- ===================================================================================================== -->

        <!-- modal  Email -->
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
                            <p><?= $data_customer->created_at ?></p>
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
    <!-- ===================================================================================================== -->