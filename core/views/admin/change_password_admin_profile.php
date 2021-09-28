<?php
    // ===========================================================
    // classes carregadas
        namespace core\controllers;
        use core\classes\Database;
        use core\classes\SendEmail;
        use core\classes\PDF;
        use core\classes\Store;
        use core\models\AdminModel;
    // ===========================================================
?>

    <!-- container fluid -->
    <!-- ===================================================================================================== -->
        <div class="container-fluid">
            <!-- row -->
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
                            <!-- row mt-3 -->
                            <!-- ===================================================================================================== -->
                                <div class="row mt-3">  
                                    
                                    <?php //Store::printData($data_admin); ?>

                                    <div class="col text-center">
                                        <a href="?a=change_profile_admin_data&c=<?= Store::aes_encrypt($_SESSION['admin']) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar dados pessoais</a>
                                        <a href="?a=change_password_admin_profile" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i> Alterar a password</a>
                                 <!--       <a href="?a=order_history" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="far fa-list-alt"></i> Histórico de orders</a> -->
                                    </div>                            
                                    
                                        <!-- form -->
                                        <!-- ===================================================================================================== -->
                                            <form action="?a=change_password_admin_profile_submit" method="post">
                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>pass atual:</label>
                                                        <input type="password" maxlength="30" name="text_pass_atual_admin" class="form-control" required>
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>Nova pass:</label>
                                                        <input type="password" maxlength="30" name="text_nova_pass_admin" class="form-control" required>
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>Repetir nova pass:</label>
                                                        <input type="password" maxlength="30" name="text_repetir_nova_pass_admin" class="form-control" required>
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- buttons-div  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="text-center my-4">
                                                        <a href="?a=profile_admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">Cancelar</a>
                                                        <input type="submit" value="Salvar" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                                    </div>
                                                <!-- ===================================================================================================== -->
                                            </form>
                                        <!-- ===================================================================================================== -->
                                </div>

                                    <!-- se a variavel erro estiver definida na sessao -->
                                    <!-- ===================================================================================================== -->
                                            <?php if(isset($_SESSION['erro'])):?>
                                                <!-- show alert danger -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="alert alert-danger text-center p-2">
                                                        <?= $_SESSION['erro'] ?>
                                                        <?php unset($_SESSION['erro']) ?>
                                                    </div>
                                                <!-- ===================================================================================================== -->
                                            <?php endif; ?>
                                    <!-- ===================================================================================================== -->

                        </div>
                    <!-- ===================================================================================================== -->

                    <!-- espaco em branco -->
                    <!-- ===================================================================================================== -->
                                    <div class="row">
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 row">
                                            </div>
                                        </div>
                                    </div>
                    <!-- ===================================================================================================== -->                                                                                     
                </div>
            <!-- ===================================================================================================== -->
        </div>
    <!-- ===================================================================================================== -->
  