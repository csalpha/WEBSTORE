    <!-- carregar classes -->
    <!-- ===================================================================================================== -->
        <?php
            use core\classes\Store;
        ?>
    <!-- ===================================================================================================== -->

    <?php //Store::printData($admins) ?>

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
                                <h3>Lista de admins  <!-- $filtro != '' ? ($filtro  == 1 ? 'Activos' : 'Inactivos') : '' ?> --> </h3>
                                <hr>

                                <!-- row -->
                                <!-- ===================================================================================================== -->                        
                                    <div class="row">
                                        <!-- col -->
                                        <!-- ===================================================================================================== -->
                                        <div class="col">
                                            <!-- <a href="?a=new_admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a> -->
                                            <button id="add_button" onclick="apresentarModalAdd()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button> 
                                            <a href="?a=admins_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                            <button id="add_button_admin" onclick="apresentarModalAddAdmin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button> 
                                            
                                                                                  
                                        </div>
                                        <!-- ===================================================================================================== -->

                                        <!-- col -->
                                        <!-- ===================================================================================================== -->
                                        <!--    <div class="col">
                                                <a href="?a=admins_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
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

                                 <?php if (count($admins) == 0) : ?>
                                    <p class="text-center text-muted">Não existem customer registados.</p>
                                <?php else : ?>
                                    
                                    <!-- apresenta a tabela de admins -->
                                        <small>
                                            <table class="table table-sm" id="tabela-admins">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Picture</th>
                                                        <th>User</th>
                                                        <th>Pass</th>
                                                        <th>Created at</th>
                                                        <th class="text-center">Updated at</th>
                                                        <th class="text-center">Ativo</th>
                                                        <th class="text-center">Eliminado</th>
                                                        <th class="text-center">Ver</th>
                                                        <!-- <th class="text-center">Ver Admin</th> -->
                                                        <th class="text-center">Editar</th>
                                                        <th class="text-center">Apagar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($admins as $admin) : ?>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/customers/<?= $admin->image ?>" class="img-fluid" width="50px">
                                                            </td>    
                                                            <td>
                                                                <a href="?a=admin_details&c=<?= Store::aes_encrypt($admin->id_admin) ?>" class="nav-it"><?= $admin->user ?></a>
                                                            </td>

                                                            <td><?= $admin->pass ?></td>
                                                            <td><?= $admin->created_at ?></td>

                                                            <td class="text-center"><?= $admin->updated_at ?>
                                                            </td>
                                                            <!-- ativo -->
                                                            <td class="text-center">
                                                                <?php if ($admin->active == 1) : ?>
                                                                    <i class="text-success fas fa-check-circle"></i></span>
                                                                <?php else : ?>
                                                                    <i class="text-danger fas fa-times-circle"></i></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <!-- eliminado -->
                                                            <td class="text-center">
                                                                <?php if ($admin->deleted_at == null) : ?>
                                                                    <i class="text-danger fas fa-times-circle"></i></span>
                                                                <?php else : ?>
                                                                    <i class="text-success fas fa-check-circle"></i></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <!-- Ver -->
                                                          <!--  <td class="text-center">
                                                            <a href="?a=admin_details&c=<?= Store::aes_encrypt($admin->id_admin) ?>" class="btn btn-primary btn-xs ver"><i class="fas fa-eye"></i></a>
                                                            </td>   -->
                                                            
                                                            <!-- Ver -->
                                                            <!-- <td class="text-center">
                                                            <button onclick="apresentarModalVer(<?= $admin->id_admin ?>)" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                                            </td>    -->

                                                            <!-- Ver  Admin -->
                                                            <td class="text-center">
                                                            <button onclick="apresentarModalVerAdmin(<?= $admin->id_admin ?>)" name="ver" class="btn btn-primary btn-xs ver"><i class="fa fa-eye"></i></button>
                                                            </td>     
                                                            
                                                            <!-- update -->
                                                            <!-- <td class="text-center">
                                                            <button onclick="apresentarModalUpdate(<?= $admin->id_admin ?>)"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>
                                                            </td>                                                                -->
                                                                                                                       
                                                            <!-- update modal -->
                                                            <td class="text-center">
                                                            <button onclick="apresentarModalUpdateAdmin(<?= $admin->id_admin ?>)"  class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>
                                                            </td>     

                                                            <!-- delete -->
                                                            <td class="text-center">
                                                                <a href="?a=delete_admin&id_admin=<?= Store::aes_encrypt($admin->id_admin) ?>" 
                                                                  class="btn btn-danger btn-xs delete" name="delete" id="<?= $admin->id_admin ?>"><i class="fa fa-trash"></i></a>
                                                            </td>                                                            
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </small>
                                    <!-- ===================================================================================================== -->
                                <?php endif; ?> 

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

                                <!-- chamada grafico -->
                                <!-- ===================================================================================================== -->
                                    <div id="grafico2"> </div>
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
                            </div>
                        <!-- ===================================================================================================== -->
                    </div>
                <!-- ===================================================================================================== -->                                                    

            </div>
    <!-- ===================================================================================================== -->

    <!-- data table -->
    <!-- ===================================================================================================== -->
        <script>
            $(document).ready(function() {
                $('#tabela-admins').DataTable({
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
                'a': 'admins_list',
                'f': filtro
            });            
            }
        </script>
    <!-- ===================================================================================================== -->

    <!-- modal update -->
    <!-- ===================================================================================================== -->
                <!-- <div class="modal fade" id="modalUpdate" name="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id='modalUpdateAdmin'>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
           
                                            <form action="?a=change_admin_data_submit_modal" id="update_form" method="post">
                                  <div class="form-group">
                                      <label>Email:</label>
                                      <input type="email" maxlength="50" name="text_email_update" id="text_email_update" class="form-control" required >
                                      <input type="text"  name="text_id_admin_update" id="text_id_admin_update" class="form-control" >
                                  </div>
                                  <div class="form-group">
                                      <label>Full Name:</label>
                                      <input type="text" maxlength="50" name="text_full_name_update" id="text_full_name_update" class="form-control" required value="">
                                  </div>
                                  <div class="form-group">
                                      <label>address:</label>
                                      <input type="text" maxlength="100" name="text_address_update" id="text_address_update" class="form-control" required value="">
               
                                  <div class="form-group">
                                      <label>city:</label>
                                      <input type="text" maxlength="50" name="text_city_update" id="text_city_update" class="form-control" required value="">
                                  </div>
   
                
                                  <div class="form-group">
                                      <label>telephone:</label>
                                      <input type="text" maxlength="20" name="text_telephone_update" id="text_telephone_update" class="form-control" value="">
                                  </div>
               
                              <div class="form-group">    
                                      <label>Foto</label>
                                      <input type="file" name="user_image" id="user_image" />
                                      <span id="user" name="user"></span>
                                  </div>
           
      </div>
          <div class="modal-footer">
              <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" value="Salvar" class="btn btn-success">
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
     <!-- ===================================================================================================== -->

         <!-- modal update admin -->
    <!-- ===================================================================================================== -->
         <div class="modal fade" id="modalUpdateAdmin" name="modalUpdateAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id='corpo_modal_update_admin'>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
           
                                    <!-- <form action="?a=change_admin_data_submit_modal" id="update_form" method="post"> -->
                                    <!-- <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" maxlength="50" name="text_email_update" id="text_email_update" class="form-control" required >
                                        <input type="text"  name="text_id_admin_update" id="text_id_admin_update" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name:</label>
                                        <input type="text" maxlength="50" name="text_full_name_update" id="text_full_name_update" class="form-control" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label>address:</label>
                                        <input type="text" maxlength="100" name="text_address_update" id="text_address_update" class="form-control" required value="">
                
                                    <div class="form-group">
                                        <label>city:</label>
                                        <input type="text" maxlength="50" name="text_city_update" id="text_city_update" class="form-control" required value="">
                                    </div>
                
                                    <div class="form-group">
                                        <label>telephone:</label>
                                        <input type="text" maxlength="20" name="text_telephone_update" id="text_telephone_update" class="form-control" value="">
                                    </div>
                
                                    <div class="form-group">    
                                            <label>Foto</label>
                                            <input type="file" name="user_image" id="user_image" />
                                            <span id="user" name="user"></span>
                                        </div>

                                    </div> -->

                            <!-- </form> -->
                        </div>

                        <div class="modal-footer">
                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" value="Salvar" class="btn btn-success">
                        </div>  
                    </div>
                </div>
        </div>
     <!-- ===================================================================================================== -->



    <!-- modal Ver -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalVer" name="modalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ver Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                            <!-- form -->
                                            <!-- ===================================================================================================== -->
                                                <form action="?a=change_admin_data_submit_modal" id="update_form" method="post">
                                                    <!-- form-group  -->
                                                    <!-- =====================================================================================================  -->
                                
                                                        <div class="form-group">
                                                            <label>Email:</label>
                                                            <input type="email" maxlength="50" name="text_email_ver" id="text_email_ver" class="form-control" readonly >
                                                            <input type="text"  name="text_id_admin_ver" id="text_id_admin_ver" class="form-control" readonly>
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
                                                            <input type="text" maxlength="20" name="text_telephone_ver" id="text_telephone_ver" class="form-control" readonly value="">
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

    <!-- modal Ver -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalVerAdmin" name="modalVerAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" id="corpo_modal_ver_admin">

                        </div>
                    </div>
            </div>
        </div>
    <!-- ===================================================================================================== -->      
    
    
    <!-- modal  add -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalAdd"  name="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- form -->
                        <!-- ===================================================================================================== -->				
                            <form action="?a=create_admin_modal"  method="post" enctype="multipart/form-data" id="add_form">
                                    <!-- Email -->
                                    <!-- ===================================================================================================== -->				
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="text_email" id="text_email" placeholder="Email" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					
                                    
                                    <!-- pass_1 -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Pass</label>
                                        <input type="password" class="form-control" name="text_pass_1" id="text_pass_1" placeholder="Pass" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- pass_2 -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Repetir Pass</label>
                                        <input type="password" class="form-control" name="text_pass_2" id="text_pass_2"  placeholder="Repetir Pass" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Full Name -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="text_full_name"  id="text_full_name"  placeholder="Full Name" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- address -->
                                    <!-- ===================================================================================================== -->					
                                        <label>address</label>
                                        <input type="text" class="form-control" name="text_address" id="text_address" placeholder="address" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- city -->
                                    <!-- ===================================================================================================== -->					
                                        <label>city</label>
                                        <input type="text" class="form-control" name="text_city" id="text_city"  placeholder="city" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- telephone -->
                                    <!-- ===================================================================================================== -->					
                                        <label>telephone</label>
                                        <input type="text" class="form-control" name="text_telephone" id="text_telephone" placeholder="telephone">
                                        <br/>
                                    <!-- ===================================================================================================== -->	
                                    
                                    <!-- Estado -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Estado:</label>
                                        <select id="combo-estado" class="form-control" name="text_activo" id="text_activo" onchange="">
                                            <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                            <option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                            <option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                        </select>	
                                        <br/>
                                    <!-- ===================================================================================================== -->									

                                    <!-- Género -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Gender</label>
                                        <input type="text" class="form-control" name="text_gender" id="text_gender" placeholder="gender">
                                        <select id="combo-status" name="text_gender" class="form-control" onchange=""> 
                                                        <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                        <option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
                                                        <option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
                                        </select>
                                        <br/>
                                    <!-- ===================================================================================================== -->	

                                    <!-- Picture -->
                                    <!-- ===================================================================================================== -->					
                                            <label>Foto</label>
                                            <input type="file" name="user_image" id="user_image" />
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


                    </div>
                                <div class="modal-footer">
                                    <input onclick="" value="Criar Admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2">
                                    <!-- <input type="submit" value="Criar Admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2"> -->
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>                
                                </div> 
                            </form>	
                        <!-- ===================================================================================================== -->
                </div>
            </div>
        </div>
    <!-- ===================================================================================================== -->

    <!-- modal  add admin -->
    <!-- ===================================================================================================== -->
        <div class="modal fade" id="modalAddAdmin"  name="modalAddAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div id="msg_dados_admin">
                        </div>

                        <!-- form -->
                        <!-- ===================================================================================================== -->				
                            <form enctype="multipart/form-data" id="add_form_admin">
                                    <!-- Email -->
                                    <!-- ===================================================================================================== -->				
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="text_email_admin" id="text_email_admin" placeholder="Email" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					
                                    
                                    <!-- pass_1 -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Pass</label>
                                        <input type="password" class="form-control" name="text_pass_1_admin" id="text_pass_1_admin" placeholder="Pass" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- pass_2 -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Repetir Pass</label>
                                        <input type="password" class="form-control" name="text_pass_2_admin" id="text_pass_2_admin"  placeholder="Repetir Pass" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- Full Name -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="text_full_name_admin"  id="text_full_name_admin"  placeholder="Full Name" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- address -->
                                    <!-- ===================================================================================================== -->					
                                        <label>address</label>
                                        <input type="text" class="form-control" name="text_address_admin" id="text_address_admin" placeholder="address" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- city -->
                                    <!-- ===================================================================================================== -->					
                                        <label>city</label>
                                        <input type="text" class="form-control" name="text_city_admin" id="text_city_admin"  placeholder="city" required>
                                        <br/>
                                    <!-- ===================================================================================================== -->					

                                    <!-- telephone -->
                                    <!-- ===================================================================================================== -->					
                                        <label>telephone</label>
                                        <input type="text" class="form-control" name="text_telephone_admin" id="text_telephone_admin" placeholder="telephone">
                                        <br/>
                                    <!-- ===================================================================================================== -->	
                                    
                                    <!-- Estado -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Estado:</label>
                                        <select id="combo-estado" class="form-control" name="text_activo_admin" id="text_activo_admin" onchange="">
                                            <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                            <option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                            <option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                        </select>	
                                        <br/>
                                    <!-- ===================================================================================================== -->									

                                    <!-- Género -->
                                    <!-- ===================================================================================================== -->					
                                        <label>Gender</label>
                                        <input type="text" class="form-control" name="text_gender_admin" id="text_gender_admin" placeholder="gender">
                                        <select id="combo-status" name="text_gender" class="form-control" onchange=""> 
                                                        <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                        <option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
                                                        <option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
                                        </select>
                                        <br/>
                                    <!-- ===================================================================================================== -->	

                                    <!-- Picture -->
                                    <!-- ===================================================================================================== -->					
                                            <label>Foto</label>
                                            <input type="file" name="user_image_admin" id="user_image_admin" />
                                    <!-- ===================================================================================================== -->												




                    </div>
                                <div class="modal-footer">
                                    <input onclick="insert_data_admin()" value="Criar Admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2">
                                    <!-- <input type="submit" value="Criar Admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2"> -->
                                    <button type="button" onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>                
                                </div> 
                            </form>	
                        <!-- ===================================================================================================== -->
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
                $('#add_form')[0].reset();
                var modalAdd = new bootstrap.Modal(document.getElementById('modalAdd'));
                modalAdd.show();
            }    

            function apresentarModalAddAdmin() {
                $('#add_form')[0].reset();
                var modalAddAdmin = new bootstrap.Modal(document.getElementById('modalAddAdmin'));
                modalAddAdmin.show();
            }               

          
            
  
                    
        </script>
    <!-- ===================================================================================================== -->

    <!-- grafico -->
    <!-- ===================================================================================================== -->
        <script>
            let el = document.getElementById("grafico2");

            let options = {
                chart: {
                    type: 'bar',
                    height: 500,
                    width: 600

                },

                series: [{
                    name: 'Gender',
                    data: [<?= $total_admins_masc ?>, <?= $total_admins_femi ?>]
                }],

                xaxis: {
                    categories: ['M', 'F']
                },

                title: {
                    text: "Gender"
                }
            };

            let chart = new ApexCharts(el, options);
            chart.render();
        </script>
    <!-- ===================================================================================================== -->

    <script>

		/* #################### Apagar #################### */
            $(document).on('click', '.delete', function(){
               // var user_id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this?"))
                {
                 /*   axios({
                            method: 'get',
			                url: '?a=delete_admin',
                            data:
                            {
                                alert(data);
                                //dataTable.ajax.reload();
                            }
                        });*/
                }
                else
                {
                    return false;	
                }
            });
		/* #################### Fim  #################### */

        // ========================================================
        // insert_data_admin
            function insert_data_admin()
            {
                alert('clicou no botao');

                $.ajax({
                    method: 'post',
                    url: '?a=create_admin_modal',
                    data: {
                        text_email_admin: document.getElementById('text_email_admin').value,
                        text_pass_1_admin: document.getElementById('text_pass_1_admin').value,
                        text_pass_2_admin: document.getElementById('text_pass_2_admin').value,
                        text_full_name_admin: document.getElementById('text_full_name_admin').value,
                        text_address_admin: document.getElementById('text_address_admin').value,
                        text_city_admin: document.getElementById('text_city_admin').value,
                        text_telephone_admin: document.getElementById('text_telephone_admin').value
                       // text_gender_admin: document.getElementById('text_gender_admin').value,
                        //text_activo_admin: document.getElementById('text_activo_admin').value,
                        //user_image_admin: document.getElementById('user_image_admin').files[0].name,
                    },
                    //dataType:"json",
                    success:function(data)
                    {
                        alert(data);
                     $("#msg_dados_admin").fadeIn();

                     const obj = JSON.parse(data);

                     document.getElementById("msg_dados_admin").innerHTML = obj;


                       // alert('success');
                        //document.getElementById("corpo_pass_sucesso").innerHTML = '';
                       // document.getElementById("msg_dados").innerHTML = '';
                        //const obj = JSON.parse(result);
                        //alert(result);
                        

                        // // var passSucesso = new bootstrap.Modal(document.getElementById('passSucesso'));
                        // // passSucesso.show();

                        

                         setTimeout(function() {
                             $("#msg_dados_admin").fadeOut().empty();
                         }, 2000);

                         $('#tabela-admins').DataTable().ajax.reload();



                        // // data.preventDefault();
                        // // alert('sucess');
                    //$('#modalAdd').modal('hide');
                        //alert(data);
                    // dataTable.ajax.reload();
                    },
                    error:function(data)
                    {
                    // $('#modalAdd').modal('hide');
                    alert('error');
                    // dataTable.ajax.reload();
                    }
                    
                });
            }
        // ======================================================== 
        
        /* #################### Actualizar #################### */
                // function apresentarModalUpdate(id_admin) 
                // {

                //             $.ajax({
                //                 url:"?a=change_admin_data_modal&c=" + id_admin,
                //                 method:"POST",
                //                 data:{id_admin:id_admin},
                //                 success:function(data)
                //                 {
                //                     //data.preventDefault();
                //                     const obj = JSON.parse(data);
                //                     console.log(obj);
                //                     $('#modalUpdate').modal('show');
                //                     $('#text_email_update').val(obj.user);
                //                     $('#text_id_admin_update').val(obj.id_admin);
                //                     $('#text_full_name_update').val(obj.full_name);
                //                     $('#text_address_update').val(obj.address);
                //                     $('#text_city_update').val(obj.city);
                //                     $('#text_telephone_update').val(obj.telephone);
                //                     $('#user_image').val(obj.image);
                //                     alert(obj.image);
                //                 },
                //                 error:function(data)
                //                 {
                //                 // $('#modalUpdate').modal('hide');
                //                 }
                //             });
                //     }
	    /* #################### Fim ####################*/    

        /* #################### Actualizar #################### */
        function apresentarModalUpdateAdmin(id_admin) 
                {

                            $.ajax({
                                url:"?a=change_admin_data_modal_admin_alfa&c=" + id_admin,
                                method:"POST",
                                data:{id_admin:id_admin},
                                success:function(data)
                                {
                                   // alert('sucess');
                                    //data.preventDefault();
                                    const obj = JSON.parse(data);
                                    //console.log(obj);
                                    $('#modalUpdateAdmin').modal('show');
                                    document.getElementById('corpo_modal_update_admin').innerHTML = obj;
                                    // $('#text_email_update').val(obj.user);
                                    // $('#text_id_admin_update').val(obj.id_admin);
                                    // $('#text_full_name_update').val(obj.full_name);
                                    // $('#text_address_update').val(obj.address);
                                    // $('#text_city_update').val(obj.city);
                                    // $('#text_telephone_update').val(obj.telephone);
                                    // $('#user_image').val(obj.image);
                                    // alert(obj.image);
                                },
                                error:function(data)
                                {
                                   // alert('Error');
                                }
                            });
                    }
	    /* #################### Fim ####################*/           
        
        /* #################### ver #################### */
                function apresentarModalVer(id_admin) 
                {
                    $.ajax({
                        url:"?a=change_admin_data_modal&c=" + id_admin,
                        method:"POST",
                        data:{id_admin:id_admin},
                        success:function(data)
                        {
                            const obj = JSON.parse(data);
                            console.log(obj);
                            $('#modalVer').modal('show');
                            $('#text_email_ver').val(obj.user);
                            $('#text_id_admin_ver').val(obj.id_admin);
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
        /* #################### Fim ####################*/    
        
        /* #################### ver admin #################### */
        function apresentarModalVerAdmin(id_admin) 
                {
                    alert('ver');
                     $.ajax({
                         url:"?a=change_admin_data_modal_admin",
                         method:"POST",
                         data:{id_admin:id_admin},
                         success:function(data)
                         {

                           const obj = JSON.parse(data);

                             var modalVerAdmin = new bootstrap.Modal(document.getElementById('modalVerAdmin'));
                             modalVerAdmin.show();

                             document.getElementById("corpo_modal_ver_admin").innerHTML = obj;
                             // // const obj = JSON.parse(data);
                             // // console.log(obj);
                             // // $('#modalVerAdmin').modal('show');
                             // // $('#text_email_ver').val(obj.user);
                             // // $('#text_id_admin_ver').val(obj.id_admin);
                             // // $('#text_full_name_ver').val(obj.full_name);
                             // // $('#text_address_ver').val(obj.address);
                             // // $('#text_city_ver').val(obj.city);
                             // // $('#text_city_ver').val(obj.city);
                             // // $('#text_telephone_ver').val(obj.telephone);
                         },
                         error:function(data)
                         {
                             //$('#modalUpdate').modal('hide');
                         }
                     });
                }     
        /* #################### Fim ####################*/          
     

    </script>

