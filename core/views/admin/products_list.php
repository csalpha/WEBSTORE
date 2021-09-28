<?php

use core\classes\Store;
use core\models\Products;
use core\models\AdminModel;

$adminModel = new AdminModel();

$p = new Products();
$tot_cat = $p->count_category();

$categorys = $p->category_list();


foreach ($categorys as $category) {
    $nomes[] = "'$category'";
    $quantity[] = $adminModel->count_products_category($category);
}

$quantity = implode(',', $quantity);
$nomes = implode(',', $nomes);


?>
<!-- corpo -->
<!-- ===================================================================================================== -->
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-2">
                <?php include(__DIR__ . '/layouts/admin_menu.php') ?>
            </div>
            <div class="col-md-10">
                <h3>Lista de products</h3>
                <hr>
                            <!-- row -->
                            <!-- ===================================================================================================== -->                        
                                <div class="row">
                                        <!-- col -->
                                        <!-- ===================================================================================================== -->
                                        <div class="col">
                                            <a href="?a=new_product" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a>
                                            <button id="add_button" onclick="apresentarModalAdd()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  
                                            <a href="?a=products_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                        </div>
                                        <!-- ===================================================================================================== -->    

                                        <!-- col -->
                                        <!-- ===================================================================================================== -->
                                    <!--    <div class="col">
                                            <a href="?a=products_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                        </div> -->
                                        <!-- ===================================================================================================== -->

                                        <!-- col -->
                                        <!-- ===================================================================================================== -->                            
                                        <div class="col">
                                        <?php
                                        $f = '';
                                        if (isset($_GET['f'])) {
                                            $f = $_GET['f'];
                                        }
                                        ?>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-4 text-end col-form-label">Escolher estado:</label>
                                            <div class="col-sm-8">
                                                <select id="combo-status" class="form-control" onchange="definir_filtro()">
                                                    <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                    <option value="activo" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                                    <option value="inactivo" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- ===================================================================================================== -->
                                </div>
                            <!-- ===================================================================================================== -->                
                
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                        </div>
                    </div>
                </div>

                
                
                <?php if (count($products) == 0) : ?>
                    <hr>
                    <p>Não existem products registados.</p>
                    <hr>
                <?php else : ?>
                    <small>
                        <table class="table table-striped" id="tabela-products">
                            <thead class="table-dark">
                                <tr>
                                    <th>Picture</th>
                                    <th>Código</th>
                                    <th>Nome product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Price whithout VAT</th>
                                    <th>VAT Price</th>
                                    <th>VAT </th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Atualizado em</th>
                                    <th class="text-center">Ver</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Apagar</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>

                                        <?php 
                                                $price_whithout_VAT = ($product->price / 1.23);
                                                $vat = $product->price - $price_whithout_VAT;
                                                $perc_iva = $product->VAT * 100;

                                               
                                        ?>
                                        <td><img src="../assets/images/products/<?= $product->image ?>" class="img-fluid" width="50px"></td>
                                        <td><?= $product->id_product ?></td>
                                        <td><a href="?a=products_details&c=<?= Store::aes_encrypt($product->id_product) ?>" class="nav-it"><?= $product->product_name ?></a></td>
                                        <td><?= $product->category ?></td>
                                        <td><?= $product->price ?> €</td>
                                        <td><?= number_format($price_whithout_VAT, 2,',','.') ?> €</td>
                                        <td><?= number_format($vat, 2,',','.') ?> €</td> 
                                        <td><?= number_format($perc_iva, 0,',','.') ?> %</td>
                                        <td><?= $product->stock ?></td>
                                        <!-- ativo -->
                                        <td class="text-center">
                                            <?php if ($product->active == 1) : ?>
                                                <i class="text-success fas fa-check-circle"></i></span></a>
                                            <?php else : ?>
                                                <i class="text-danger fas fa-times-circle"></i></span></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $product->updated_at ?></td>
                                        <!-- Ver -->
                                        <td class="text-center">
                                        <a href="?a=products_details&c=<?= Store::aes_encrypt($product->id_product) ?>" class="btn btn-primary btn-xs ver"><i class="fas fa-eye"></i></a>
                                        </td>                                              
                                        <!-- update -->
                                        <td class="text-center">
                                            <a href="?a=change_product_data&c=<?= Store::aes_encrypt($product->id_product) ?>" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <!-- delete -->
                                        <td class="text-center">
                                            <a href="?a=delete_product&id_product=<?= Store::aes_encrypt($product->id_product) ?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>
                                        </td>                                          
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </small>
                <?php endif; ?>
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                        </div>
                    </div>
                </div>
                <hr>
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

                <!-- chamar grafico -->
                <!-- ===================================================================================================== -->
                    <div id="grafico"> </div>
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
        </div>
    </div>
<!-- ===================================================================================================== -->

<!-- Data Table / definir filtro  -->
<!-- ===================================================================================================== -->
    <script>
        $(document).ready(function() {
            $('#tabela-products').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No data available in table",
                    "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                    "infoEmpty": "Não existem orders disponíveis",
                    "infoFiltered": "(Filtrado de um total de _MAX_ products)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Apresenta _MENU_ products por página",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "search": "Procurar:",
                    "zeroRecords": "Não foram encontrados products",
                    "paginate": {
                        "first": "Primeira",
                        "last": "Última",
                        "next": "Seguinte",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": ativar para ordenar a coluna de forma ascendente",
                        "sortDescending": ": ativar para ordenar a coluna de forma descendente"
                    }
                }
            });
        });


        function definir_filtro() {
            var filtro = document.getElementById("combo-status").value;
            // reload da página com determinado filtro
            window.location.href = window.location.pathname + "?" + $.param({
                'a': 'products_list',
                'f': filtro
            });
        }
    </script>
<!-- ===================================================================================================== -->

    <!-- modal  add -->
    <!-- ===================================================================================================== -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
						<!-- form -->
						<!-- ===================================================================================================== -->				
                        <form action="?a=create_product" method="post">
								<!-- Category -->
								<!-- ===================================================================================================== -->				
									<div class="my-3">
										<label>Category</label>
										<input type="text" class="form-control" name="text_category"  placeholder="category" required>
									</div>
								<!-- ===================================================================================================== -->					
								
								<!-- Product name -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Product name</label>
										<input type="text" class="form-control" name="text_product_name"  placeholder="product name" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- Price -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Price</label>
										<input type="text" class="form-control" name="text_pass_price"  placeholder="price" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- VAT -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>VAT</label>
										<input type="text" class="form-control" name="text_VAT"  placeholder="VAT" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- Stock -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Stock</label>
										<input type="text" class="form-control" name="text_stock"  placeholder="Stock" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- Description -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>description</label>
										<input type="text" class="form-control" name="text_description"  placeholder="description" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- visible -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Visible</label>
										<input type="text" class="form-control" name="text_visible"  placeholder="visible">
									</div>
								<!-- ===================================================================================================== -->	
								
								<!-- Picture -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
												<label>Picture</label>
												<input type="file" class="form-control" name="user_image" id="user_image">
									</div>
								<!-- ===================================================================================================== -->								

								<!-- div button -->
								<!-- ===================================================================================================== -->					
									<div class="my-4">
										<input action="?a=create_product" type="submit" value="Criar Produto" class="mb-3 btn btn-black text-uppercase filter-btn m-2">
									</div>	
								<!-- ===================================================================================================== -->					

								<!-- se a variavel erro estiver configurada -->
								<!-- ===================================================================================================== -->
									<?php if(isset($_SESSION['erro'])):?>	
										<!-- alert-danger -->
										<!-- ===================================================================================================== -->
											<div class="alert alert-danger text-center p-2">
												<?= $_SESSION['erro'] ?>
												<?php unset($_SESSION['erro']) ?>
											</div>
										<!-- ===================================================================================================== -->
									<?php endif; ?>	
								<!-- ===================================================================================================== -->

							</form>	
						<!-- ===================================================================================================== -->
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- ===================================================================================================== -->

    <!-- modal update -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
						<!-- form -->
						<!-- ===================================================================================================== -->				
                        <form action="?a=create_product" method="post">
								<!-- Category -->
								<!-- ===================================================================================================== -->				
									<div class="my-3">
										<label>Category</label>
										<input type="text" class="form-control" name="text_category"  placeholder="category" required>
									</div>
								<!-- ===================================================================================================== -->					
								
								<!-- Product name -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Product name</label>
										<input type="text" class="form-control" name="text_product_name"  placeholder="product name" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- Price -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Price</label>
										<input type="text" class="form-control" name="text_pass_price"  placeholder="price" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- VAT -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>VAT</label>
										<input type="text" class="form-control" name="text_VAT"  placeholder="VAT" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- Stock -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Stock</label>
										<input type="text" class="form-control" name="text_stock"  placeholder="Stock" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- Description -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>description</label>
										<input type="text" class="form-control" name="text_description"  placeholder="description" required>
									</div>
								<!-- ===================================================================================================== -->					

								<!-- visible -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
										<label>Visible</label>
										<input type="text" class="form-control" name="text_visible"  placeholder="visible">
									</div>
								<!-- ===================================================================================================== -->	
								
								<!-- Picture -->
								<!-- ===================================================================================================== -->					
									<div class="my-3">
												<label>Picture</label>
												<input type="file" class="form-control" name="user_image" id="user_image">
									</div>
								<!-- ===================================================================================================== -->								

								<!-- div button -->
								<!-- ===================================================================================================== -->					
									<div class="my-4">
										<input action="?a=create_product" type="submit" value="Criar Produto" class="mb-3 btn btn-black text-uppercase filter-btn m-2">
									</div>	
								<!-- ===================================================================================================== -->					

								<!-- se a variavel erro estiver configurada -->
								<!-- ===================================================================================================== -->
									<?php if(isset($_SESSION['erro'])):?>	
										<!-- alert-danger -->
										<!-- ===================================================================================================== -->
											<div class="alert alert-danger text-center p-2">
												<?= $_SESSION['erro'] ?>
												<?php unset($_SESSION['erro']) ?>
											</div>
										<!-- ===================================================================================================== -->
									<?php endif; ?>	
								<!-- ===================================================================================================== -->

							</form>	
						<!-- ===================================================================================================== -->
                    </div>
                <!--    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div> -->
                </div>
            </div>
        </div>
    <!-- ===================================================================================================== -->

<!-- modal -->
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
                        <?php foreach (active as $estado) : ?>
                            <?php if ($product->active == $estado) : ?>
                                <p><?= ($estado == 0) ? 'Inactive' : 'active' ?></p>
                            <?php else : ?>
                                <p><a href="?a=product_change_status&e=<?= $product->id_product ?>&s=<?= $estado ?>"><?= ($estado == 1) ? 'active' : 'Inactive' ?></a></p>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
<!-- ===================================================================================================== -->

<!-- Apresentar Modal -->
<!-- ===================================================================================================== -->
    <script>
        function apresentarModal() {
            var modalStatus = new bootstrap.Modal(document.getElementById('modalStatus'));
            modalStatus.show();
        }

        function apresentarModalAdd() {
                var modalAdd = new bootstrap.Modal(document.getElementById('modalAdd'));
                modalAdd.show();
        }               

        function apresentarModalUpdate() {
            var modalUpdate = new bootstrap.Modal(document.getElementById('modalUpdate'));
            modalUpdate.show();
        }        
    </script>
<!-- ===================================================================================================== -->

<!-- grafico -->
<!-- ===================================================================================================== -->
    <script>
        let el = document.getElementById("grafico");

        let options = {
            chart: {
                type: 'bar',
                height: 500,
                width: 600
            },

            series: [{
                name: 'quantidade',
                data: [<?= $quantity ?>]
            }],

            xaxis: {
                categories: [<?= $nomes ?>]
            },

            title: {
                text: "Quantidade de produtos"
            }
        };

        let chart = new ApexCharts(el, options);
        chart.render();
    </script>
<!-- ===================================================================================================== -->