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

                    <!--col-md-10 -->
                    <!-- ===================================================================================================== -->
                        <div class="col-md-10">

                        <div class="col text-center">

                            <a href="?a=change_admin_data&c=<?= Store::aes_encrypt($data_admin->id_admin) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar dados pessoais</a>
                            <a href="?a=change_password_admin&c=<?= Store::aes_encrypt($data_admin->id_admin) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i> Alterar a password</a>
                         <!--   <a href="?a=order_history" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="far fa-list-alt"></i> Histórico de orders</a> -->
                        
                        </div>                        

                            <h3>Detalhe do admin</h3>
                            <hr>
                            <!-- row mt-3 -->
                            <!-- ===================================================================================================== -->
                                <div class="row mt-3">

                                <!-- Picture -->
                                <!-- ===================================================================================================== -->
                                <div class="col-3 text-end fw-bold">Picture</div>
                                <div class="col-9"><img src="../assets/images/customers/<?= $data_admin->image ?>" class="img-fluid" width="40px"></div>
                                <!-- ===================================================================================================== -->     

                                    <!-- User -->
                                    <!-- ===================================================================================================== -->
                                        <!--col-3 -->
                                        <!-- ===================================================================================================== -->      
                                            <div class="col-3 text-end fw-bold">User:</div>
                                        <!-- ===================================================================================================== -->

                                        <!--col-9 -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-9" onclick="apresentarModalUser()"><?= $data_admin->user ?></div>
                                        <!-- ===================================================================================================== -->
                                    <!-- ===================================================================================================== -->
                                    
                                    <!-- Pass -->
                                    <!-- ===================================================================================================== -->
                                        <!--col-3 -->
                                        <!-- ===================================================================================================== -->      
                                            <div class="col-3 text-end fw-bold">Pass:</div>
                                        <!-- ===================================================================================================== -->

                                        <!--col-9 -->
                                        <!-- ===================================================================================================== -->                                    
                                            <div class="col-9"><?= $data_admin->pass ?></div>
                                        <!-- ===================================================================================================== -->
                                    <!-- ===================================================================================================== -->
                                
                                    <!-- criado em -->
                                    <!-- ===================================================================================================== -->
                                        <!--col-3 -->
                                        <!-- ===================================================================================================== -->                                
                                            <div class="col-3 text-end fw-bold">
                                                Admin desde:
                                            </div>
                                        <!-- ===================================================================================================== -->                                
                                            <?php
                                                $data = DateTime::createFromFormat('Y-m-d H:i:s', $data_admin->created_at);
                                            ?>
                                        <!--col-9 -->
                                        <!-- ===================================================================================================== -->                
                                            <div class="col-9" onclick="apresentarModalCreatedAt()">
                                                <?= $data->format('d-m-Y H:i:s') ?>
                                            </div>
                                        <!-- ===================================================================================================== -->                                
                                    <!-- ===================================================================================================== -->
                                    
                                    <!-- actualizado em -->
                                    <!-- ===================================================================================================== -->
                                        <!-- col-3 -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold" >
                                                Actualizado desde:
                                            </div>
                                        <!-- ===================================================================================================== -->

                                        <?php
                                        $data = DateTime::createFromFormat('Y-m-d H:i:s', $data_admin->updated_at);
                                        ?>

                                        <!-- col-9 -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-9" onclick="apresentarModalUpdatedAt()">
                                              <?= $data->format('d-m-Y H:i:s') ?>
                                            </div>   
                                        <!-- ===================================================================================================== --> 
                                    <!-- ===================================================================================================== -->

                                    <!-- estado -->
                                    <!-- ===================================================================================================== -->
                                        <!-- col-3 -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-3 text-end fw-bold">
                                                Estado:
                                            </div>
                                        <!-- ===================================================================================================== -->

                                        <!-- col-9 -->
                                        <!-- ===================================================================================================== -->
                                            <div class="col-9" onclick="apresentarModal()">
                                                <?= $data_admin->active == 0 ? '<span class="text-danger">Inativo</span>' : '<span class="text-success">Ativo</span>' ?>
                                            </div>
                                        <!-- ===================================================================================================== -->
                                    <!-- ===================================================================================================== -->
                                </div>
                            <!-- ===================================================================================================== -->

                            <!-- Espaco -->
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
                                            <h5 class="modal-title" id="exampleModalLabel">Alterar estado admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <!-- ===================================================================================================== -->

                                    <!-- modal body -->
                                    <!-- ===================================================================================================== -->
                                        <div class="modal-body">
                                            <div class="text-center">
                                            <?php foreach(active as $estado): ?>
                                                    <?php if($data_admin->active == $estado):?>
                                                        <p><?= ($estado == 0) ? 'Inactive' : 'active' ?></p> 
                                                    <?php else:?>
                                                        <p><a href="?a=admin_change_status&e=<?= core\classes\Store::aes_encrypt($data_admin->id_admin) ?>&s=<?= $estado ?>" class="nav-it"><?= ($estado == 1) ? 'active' : 'Inactive' ?></a></p>
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

        <!-- modal  User -->
        <!-- ===================================================================================================== -->
                <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alterar User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                            <p><?= $data_admin->user ?></p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </div>
                    </div>
                </div>

                <script>
                    function apresentarModalUser()
                    {
                        var modalUser = new bootstrap.Modal(document.getElementById('modalUser'));
                        modalUser.show();
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
                            <p><?= $data_admin->created_at ?></p>

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
                            <p><?= $data_admin->updated_at ?></p>

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