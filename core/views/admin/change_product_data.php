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


<!-- container -->
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

                                <div class="col text-center">
                                    <a href="?a=change_product_data&c=<?= Store::aes_encrypt($data_product->id_product) ?>" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i> Alterar dados do produto</a>
                                 <!--   <a href="?a=change_password" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i> Alterar a password</a> -->
                                 <!--   <a href="?a=order_history" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="far fa-list-alt"></i> Histórico de orders</a>  -->
                                </div>
                                    <!-- form -->
                                    <!-- ===================================================================================================== -->
                                        <form action="?a=change_product_data_submit" method="post">
                                            <!-- form-group  -->
                                            <!-- ===================================================================================================== -->                            
                                                <div class="form-group">
                                                    <label>Product Name:</label>
                                                    <input type="text" maxlength="50" name="text_product_name" class="form-control" required value="<?= $data_product->product_name ?>">
                                                    <input type="text" maxlength="50" name="text_id_product" class="form-control" required value="<?= $data_product->id_product ?>">
                                                </div>
                                            <!-- ===================================================================================================== -->

                                            <!-- form-group  -->
                                            <!-- ===================================================================================================== -->
                                                <div class="form-group">
                                                    <label>Category:</label>
                                                    <input type="text" maxlength="50" name="text_category" class="form-control" required value="<?= $data_product->category ?>">
                                                </div>
                                            <!-- ===================================================================================================== -->

                                            <!-- form-group  -->
                                            <!-- ===================================================================================================== -->
                                                <div class="form-group">
                                                    <label>price:</label>
                                                    <input type="text" maxlength="100" name="text_price" class="form-control" required value="<?= $data_product->price ?>">
                                            <!-- ===================================================================================================== -->

                                            <!-- form-group  -->
                                            <!-- ===================================================================================================== -->
                                                <div class="form-group">
                                                    <label>stock:</label>
                                                    <input type="text" maxlength="50" name="text_stock" class="form-control" required value="<?= $data_product->stock ?>">
                                                </div>
                                            <!-- ===================================================================================================== -->

                                            <!-- form-group  -->
                                            <!-- ===================================================================================================== -->
                                                <div class="form-group">
                                                    <label>description:</label>
                                                    <input type="text" maxlength="20" name="text_description" class="form-control" value="<?= $data_product->description ?>">
                                                </div>
                                            <!-- ===================================================================================================== -->

                                            <!-- buttons-div  -->
                                            <!-- ===================================================================================================== -->
                                                <div class="text-center my-4">
                                                    <a href="?a=profile" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">Cancelar</a>
                                                    <input type="submit" value="Salvar" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                                </div>
                                            <!-- ===================================================================================================== -->
                                        </form>
                                    <!-- ===================================================================================================== -->

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
            </div>
        <!-- ===================================================================================================== -->
    </div>
<!-- ===================================================================================================== -->