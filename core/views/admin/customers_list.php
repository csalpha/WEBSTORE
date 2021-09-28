    <!-- carregar classes -->
    <!-- ===================================================================================================== -->
        <?php
            use core\classes\Store;

            //Store::printData($customers->image);
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
                            <!-- Tabela Lista de Clientes -->
                            <!-- ===================================================================================================== -->  

                                <h3>Lista de Clientes <?= $filtro != '' ? ($filtro  == 1 ? 'Activos' : 'Inactivos') : '' ?></h3>
                                <hr>
                            <!-- row -->
                            <!-- ===================================================================================================== -->                        
                                <div class="row">
                                    <!-- add button -->
                                    <!-- ===================================================================================================== -->
                                        <div class="col">
                                            <!-- <a href="?a=new_customer" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a> -->
                                            <button id="add_button" onclick="apresentarModalAdd()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  
                                            <a href="?a=customers_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                        </div>
                                    <!-- ===================================================================================================== --> 

                                    <!-- col -->
                                    <!-- ===================================================================================================== -->
                                     <!--   <div class="col">
                                            <a href="?a=customers_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
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
                                    <?php if (count($customers) == 0) : ?>
                                        <p class="text-center text-muted">Não existem customer registados.</p>
                                    <?php else : ?>
                                        <!-- apresenta a tabela de clientes -->
                                        <!-- ===================================================================================================== -->
                                            <small>
                                                <table class="table table-sm" id="tabela-customers">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Imagem</th>
                                                            <th>Nome</th>
                                                            <th>Email</th>
                                                            <th>telephone</th>
                                                            <th class="text-center">Orders</th>
                                                            <th class="text-center">Ativo</th>
                                                            <th class="text-center">Eliminado</th>
                                                        <!--    <th class="text-center">Ver</th> -->
                                                            <th class="text-center">Ver modal</th>
                                                            <th class="text-center">Editar</th>
                                                            <th class="text-center">Apagar</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php //Store::printData($customers) ?>

                                                        <?php foreach ($customers as $customer) : ?>
                                                            <tr>
                                                            <td>
                                                                <img src="../assets/images/customers/<?= $customer->image ?>" class="img-fluid" width="50px">
                                                            </td>                                                               
                                                                <td>
                                                                    <a href="?a=customer_detail&c=<?= Store::aes_encrypt($customer->id_customer) ?>" class="nav-it"><?= $customer->full_name ?></a>
                                                                </td>

                                                                <td><?= $customer->email ?></td>
                                                                <td><?= $customer->telephone ?></td>

                                                                <!-- total orders -->
                                                                <!-- ===================================================================================================== -->
                                                                    <td class="text-center">
                                                                        <?php if ($customer->total_orders == 0) : ?>
                                                                            -
                                                                        <?php else : ?>
                                                                            <a href="?a=customer_detail&c=<?= Store::aes_encrypt($customer->id_customer) ?>" class="nav-it"><?= $customer->total_orders ?></a>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <!-- ===================================================================================================== -->

                                                                <!-- ativo -->
                                                                <!-- ===================================================================================================== -->
                                                                    <td class="text-center">
                                                                        <?php if ($customer->active == 1) : ?>
                                                                            <i class="text-success fas fa-check-circle"></i></span></a>
                                                                        <?php else : ?>
                                                                            <i class="text-danger fas fa-times-circle"></i></span></a>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <!-- ===================================================================================================== -->

                                                            <!-- eliminado -->
                                                            <td class="text-center">
                                                                <?php if ($customer->deleted_at == null) : ?>
                                                                    <i class="text-danger fas fa-times-circle"></i></span>
                                                                <?php else : ?>
                                                                    <i class="text-success fas fa-check-circle"></i></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <!-- Ver -->
                                                      <!--      <td class="text-center">
                                                            <a href="?a=customer_detail&c=<?= Store::aes_encrypt($customer->id_customer) ?>" class="btn btn-primary btn-xs ver"><i class="fas fa-eye"></i></a>
                                                            </td>     -->
                                                            <!-- Ver -->
                                                            <td class="text-center">
                                                            <button onclick="apresentarModalVer(<?= $customer->id_customer ?>)" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                                            </td>                                                                                                                            
                                                            <!-- update -->
                                                       <!--      <td class="text-center">
                                                                <a href="?a=change_customer_data&c=<?= Store::aes_encrypt($customer->id_customer) ?>" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></a>
                                                            </td>   -->
                                                            <!-- update -->
                                                            <td class="text-center">
                                                            <button onclick="apresentarModalUpdate(<?= $customer->id_customer ?>)" name="update" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>
                                                            </td>                                                      
                                                            <!-- delete -->
                                                            <td class="text-center">
                                                            <a href="?a=delete_customer&id_customer=<?= Store::aes_encrypt($customer->id_customer) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                         <!--   <buttom onclick="deleteCustomer(<?= $customer->id_customer ?>)" id="<?= $customer->id_customer ?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button> -->
                                                            </td>                                                                    
                                                            </tr>



                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </small>
                                        <!-- ===================================================================================================== -->
                                    <?php endif; ?>
                                <!-- ===================================================================================================== -->                        

                                <!-- espaco -->
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

                                <hr>

                                <!-- chamada grafico -->
                                <!-- ===================================================================================================== -->            
                                    <div id="grafico1"> </div>
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

    <!-- DataTable -->
    <!-- ===================================================================================================== -->
        <script>
            $(document).ready(function() {
                $('#tabela-customers').DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No data available in table",
                        "info": "Mostrando página _PAGE_ de um total de _PAGES_",
                        "infoEmpty": "Não existem orders disponíveis",
                        "infoFiltered": "(Filtrado de um total de _MAX_ orders)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Apresenta _MENU_ orders por página",
                        "loadingRecords": "Carregando...",
                        "processing": "Processando...",
                        "search": "Procurar:",
                        "zeroRecords": "Não foram encontradas orders",
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

            function definir_filtro() 
            {
                    var filtro = document.getElementById("combo-status").value;

                    console.log(filtro);
                    // reload da página com determinado filtro
                    window.location.href = window.location.pathname + "?" + $.param({
                    'a': 'customers_list',
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
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
						<!-- form -->
						<!-- ===================================================================================================== -->				
                            <form action="?a=create_customer_modal"  method="post" id="user_form">                
						<!-- Email -->
						<!-- ===================================================================================================== -->	                        
                            <label>Email</label>
                            <input type="email" class="form-control" name="text_email" id="text_email" placeholder="Email" required>
                            <br />
						<!-- ===================================================================================================== -->					

						<!-- pass_1 -->
						<!-- ===================================================================================================== -->                        
                            <label>Pass</label>
                            <input type="password" class="form-control" name="text_pass_1" id="text_pass_1"  placeholder="Pass" required>
                            <br />
					    <!-- ===================================================================================================== -->                        

						<!-- pass_2 -->
						<!-- ===================================================================================================== -->                        
                            <label>Repetir Pass</label>
							<input type="password" class="form-control" name="text_pass_2" id="text_pass_2"  placeholder="Repetir Pass" required>
                            <br />
						<!-- ===================================================================================================== -->     

						<!-- Full Name -->
						<!-- ===================================================================================================== -->					
							<label>Full Name</label>
							<input type="text" class="form-control" name="text_full_name" id="text_full_name"  placeholder="Full Name" required>
                            <br />
						<!-- ===================================================================================================== -->	
                           
						<!-- address -->
						<!-- ===================================================================================================== -->					
							<label>address</label>
							<input type="text" class="form-control" name="text_address"  id="text_address"  placeholder="address" required>
                            <br />  
						<!-- ===================================================================================================== -->	
                                
						<!-- city -->
						<!-- ===================================================================================================== -->					
							<label>city</label>
							<input type="text" class="form-control" name="text_city" id="text_city"  placeholder="city" required>
                            </br>
						<!-- ===================================================================================================== -->
						<!-- telephone -->
						<!-- ===================================================================================================== -->					
							<label>telephone</label>
							<input type="text" class="form-control" name="text_telephone" id="text_telephone"  placeholder="telephone">
                            </br>
						<!-- ===================================================================================================== -->	

						<!-- Estado -->
						<!-- ===================================================================================================== -->					
                        <div class="my-3">
								<label>Estado:</label>
								<select id="combo-estado" class="form-control" name="text_activo" id="text_activo" onchange="">
												<option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
												<option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
												<option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
								</select>	
							</div>
						<!-- ===================================================================================================== -->	                        
						
						<!-- gender -->
						<!-- ===================================================================================================== -->					
							<label>Gender</label>
							<select id="combo-status" name="text_gender" id="text_gender" class="form-control" onchange=""> 
									<option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
									<option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
									<option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
							</select>
						<!-- ===================================================================================================== -->								

                        <!-- Picture -->
						<!-- ===================================================================================================== -->					
                        <label>Foto</label>
                        <input type="file" name="user_image" id="user_image" />
                        <span id="user_uploaded_image"></span>
						<!-- ===================================================================================================== -->							
                        <!-- <a href="/*?a=create_customer_modal" onclick="insert_data_customer()" value="Criar conta" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Criar Cliente</a> -->

						<!-- ===================================================================================================== -->                                                             
					</div>
                    <div class="modal-footer">
                        <input type="submit" value="Criar Cliente" class="mb-3 btn btn-black text-uppercase filter-btn m-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div> 
                    </form>

                </div>
            </div>
        </div>
    <!-- ===================================================================================================== -->

    <!-- modal update -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalUpdate" name="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                        <!-- form -->
                                        <!-- ===================================================================================================== -->
                                        <form action="?a=change_customer_data_submit_modal" method="post">
                                                <!-- form-group  -->
                                                <!-- =====================================================================================================  -->
                                                    


                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <input type="email" maxlength="50" name="text_email_update" id="text_email_update" class="form-control" required >
                                                        <input type="text"  name="text_id_customer_update" id="text_id_customer_update" class="form-control" >
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>Full Name:</label>
                                                        <input type="text" maxlength="50" name="text_full_name_update" id="text_full_name_update" class="form-control" required value="">
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>address:</label>
                                                        <input type="text" maxlength="100" name="text_address_update" id="text_address_update" class="form-control" required value="">
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>city:</label>
                                                        <input type="text" maxlength="50" name="text_city_update" id="text_city_update" class="form-control" required value="">
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>telephone:</label>
                                                        <input type="text" maxlength="20" name="text_telephone_update" id="text_telephone_update" class="form-control" value="">
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">    
                                                        <label>Foto</label>
                                                        <input type="file" name="user_image" id="user_image" />
                                                        <span id="user" name="user"></span>
                                                    </div>
                                                 <!-- ===================================================================================================== -->

                                                <!-- buttons-div  -->
                                                <!-- ===================================================================================================== -->
                                            <!--      <div class="text-center my-4">
                                                    <a href="?a=profile" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">Cancelar</a>
                                                        <input type="submit" value="Salvar" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                                    </div> -->
                                                <!-- ===================================================================================================== -->
                                    
                                        <!-- ===================================================================================================== -->
                        </div>
                        <div class="modal-footer">
                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" value="Salvar" class="btn btn-success">
                        </div>  
                            </form>
                        </div>
                </div>
            </div>
        </div>
    <!-- ===================================================================================================== -->

    <!-- modal ver -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalVer" name="modalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ver Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                        <!-- form -->
                                        <!-- ===================================================================================================== -->
                                        <div class="row mt-3">
                                                <!-- form-group  -->
                                                <!-- =====================================================================================================  -->
                            
                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <input type="email" maxlength="50" name="text_email_ver" id="text_email_ver" class="form-control" readonly>
                                                        <input type="text"  name="text_id_customer_ver" id="text_id_customer_ver" class="form-control" readonly>
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>Full Name:</label>
                                                        <input type="text" maxlength="50" name="text_full_name_ver" id="text_full_name_ver" class="form-control" readonly value="">
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>address:</label>
                                                        <input type="text" maxlength="100" name="text_address_ver" id="text_address_ver" class="form-control" readonly value="">
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>city:</label>
                                                        <input type="text" maxlength="50" name="text_city_ver" id="text_city_ver" class="form-control" readonly value="">
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- form-group  -->
                                                <!-- ===================================================================================================== -->
                                                    <div class="form-group">
                                                        <label>telephone:</label>
                                                        <input type="text" maxlength="20" name="text_telephone_ver" id="text_telephone_ver" class="form-control" value="" readonly>
                                                    </div>
                                                <!-- ===================================================================================================== -->

                                                <!-- buttons-div  -->
                                                <!-- ===================================================================================================== -->
                                            <!--      <div class="text-center my-4">
                                                    <a href="?a=profile" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">Cancelar</a>
                                                        <input type="submit" value="Salvar" class="mb-3 btn btn-black text-uppercase filter-btn m-2 btn-100">
                                                    </div> -->
                                                <!-- ===================================================================================================== -->
                                    
                                        <!-- ===================================================================================================== -->
                        </div>
                        <div class="modal-footer">
                    <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button"  onclick="" class="btn btn-success" data-bs-dismiss="modal">Ok</button>
                        </div>  
                        </form>
                    </div>
                    </div>
                </div>
        </div>
    <!-- ===================================================================================================== -->    

    <!-- modal status -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar estado customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <?php foreach (active as $estado) : ?>
                                <?php if ($customer->active == $estado) : ?>
                                    <p><?= ($estado == 0) ? 'Inactive' : 'active' ?></p>
                                <?php else : ?>
                                    <p><a href="?a=customer_change_status&e=<?= core\classes\Store::aes_encrypt($customer->id_customer) ?>&s=<?= $estado ?>"><?= ($estado == 1) ? 'active' : 'Inactive' ?></a></p>
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

    <!-- apresentar modal -->
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
            
        </script>
    <!-- ===================================================================================================== -->

    <!-- grafico -->
    <!-- ===================================================================================================== -->
        <script>
            let el = document.getElementById("grafico1");

            let options = {
                chart: {
                    type: 'bar',
                    height: 500,
                    width: 600

                },

                series: [{
                    name: 'Gender',
                    data: [<?= $total_customers_masc ?>, <?= $total_customers_femi ?>]
                }],

                xaxis: {
                    categories: ['M', 'F']
                },

                title: {
                    text: "Customer gender"
                }
            };

            let chart = new ApexCharts(el, options);
            chart.render();
        </script>
    <!-- ===================================================================================================== -->

    <script>
        /* #################### Apagar #################### */
                    function deleteCustomer(id_customer) {
                        
                        if(confirm("Are you sure you want to delete this?"))
                        {
                            axios({
                                method: 'post',
                                url: '?a=delete_customer&id_customer=' + id_customer,
                                data:
                                {
                                    //alert(data);
                                    //dataTable.ajax.reload();
                                }
                            });
                        }
                        else
                        {
                            return false;	
                        }
                    };
        /* #################### Fim  #################### */

        // ========================================================
        // insert_data_customer
            function insert_data_customer()
            {
                
                axios({
                    method: 'post',
                    url: '?a=create_customer_modal',
                    dataType:"json",
                    data: {
                        
                        text_email: document.getElementById('text_email').value,
                        text_pass_1: document.getElementById('text_pass_1').value,
                        text_pass_2: document.getElementById('text_pass_2').value,
                        text_full_name: document.getElementById('text_full_name').value,
                        text_address: document.getElementById('text_address').value,
                        text_city: document.getElementById('text_city').value,
                        text_telephone: document.getElementById('text_telephone').value,
                        text_gender: document.getElementById('text_gender').value,
                        text_activo: document.getElementById('text_activo').value,
                        //user_image: document.getElementById('user_image').value,
                    },
                    success:function(data)
				    {
                       // alert('aqui');
                       //// $('#modalAdd').modal('hide');
                        console.log(data);
					 //  alert(data);
					   // dataTable.ajax.reload();
				    },

                    error:function(data)
				    {
                        console.log(data);
                   ////     $('#modalAdd').modal('hide');
					   // alert(data);
					   // dataTable.ajax.reload();
				    }
                    
                    
                });
               
            }
        // ========================================================   
        
        /* #################### Actualizar #################### */
            function apresentarModalUpdate(id_customer) 
            {
                $.ajax({
                    url:"?a=change_customer_data_admin&c=" + id_customer,
                    method:"POST",
                    data:{id_customer:id_customer},
                    success:function(data)
                    {
                        const obj = JSON.parse(data);
                        console.log(obj);
                        $('#modalUpdate').modal('show');
                        $('#text_email_update').val(obj.email);
                        $('#text_id_customer_update').val(obj.id_customer);
                        $('#text_full_name_update').val(obj.full_name);
                        $('#text_address_update').val(obj.address);
                        $('#text_city_update').val(obj.city);
                        $('#text_telephone_update').val(obj.telephone);
                        $('#user_image').val(obj.image);
                        alert(obj.image);

                    },
                    error:function(data)
				    {
                     //   $('#modalUpdate').modal('hide');
				    }
                });
            }


	    /* #################### Fim ####################*/

        /* #################### ver #################### */
            function apresentarModalVer(id_customer) 
            {
                    $.ajax({
                        url:"?a=change_customer_data_admin&c=" + id_customer,
                        method:"POST",
                        data:{id_customer:id_customer},
                        success:function(data)
                        {
                            const obj = JSON.parse(data);
                            console.log(obj);
                            $('#modalVer').modal('show');
                            $('#text_email_ver').val(obj.email);
                            $('#text_id_customer_ver').val(obj.id_customer);
                            $('#text_full_name_ver').val(obj.full_name);
                            $('#text_address_ver').val(obj.address);
                            $('#text_city_ver').val(obj.city);
                            $('#text_city_ver').val(obj.city);
                            $('#text_telephone_ver').val(obj.telephone);
                        },
                        error:function(data)
                        {
                            //$('#modalUpdate').modal('hide');
                        }
                    });
            }   
        /* #################### fim #################### */  

    </script>