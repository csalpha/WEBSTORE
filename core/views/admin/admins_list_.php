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
                                <h3>Lista de admins  <!-- $filtro != '' ? ($filtro  == 1 ? 'Activos' : 'Inactivos') : '' ?> --> </h3>
                                <hr>

                                <!-- row -->
                                <!-- ===================================================================================================== -->                        
                                    <div class="row">
                                        <!-- col -->
                                        <!-- ===================================================================================================== -->
                                        <div class="col">
                                            <!-- <a href="?a=new_admin" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></a> -->
                                            <!-- <button id="add_button" onclick="apresentarModalAdd()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button> 
                                            <a href="?a=admins_list" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fas fa-eye"></i></a>
                                            <button id="add_button_admin" onclick="apresentarModalAddAdmin()" class="mb-3 btn btn-black text-uppercase filter-btn m-2"><i class="fa fa-plus"></i></button>  -->
                                            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg"><i class="fa fa-plus"></i></button>
                                                                                  
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
                    // "processing":true,
                    // "serverSide":true,
                    // "order":[],
                    // "ajax":{
                    //     url:"?a=criar_tabela_admin",
                    //     type:"POST"
                    // },

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


    <!-- ################################# Modal ################################# -->
        <div id="userModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="user_form" enctype="multipart/form-data">
                    <div class="modal-content" id="corpo_modal">
                        <div class="modal-header">
                            <h4 class="modal-title">Adicionar Paciente</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="corpo_modal">

                                        <div id="msg_dados_admin">
                                            </div>

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
                                                <select id="text_activo_admin" name="text_activo_admin"  class="form-control" onchange="">
                                                    <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                    <option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                                    <option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                                </select>	
                                                <br/>
                                            <!-- ===================================================================================================== -->									

                                            <!-- Género -->
                                            <!-- ===================================================================================================== -->					
                                                <label>Gender</label>
                                                <select id="text_gender_admin" name="text_gender_admin" class="form-control" onchange=""> 
                                                                <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                                <option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
                                                                <option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
                                                </select>
                                                <br/>
                                            <!-- ===================================================================================================== -->	

                                            <!-- Picture -->
                                            <!-- ===================================================================================================== -->					
                                                <input type="file" name="user_image" id="user_image" />
                                                <span id="user_uploaded_image"></span>
                                            <!-- ===================================================================================================== -->		                        

                            </div>
                        <div class="modal-footer">
                            <input type="hidden" name="user_id" id="user_id" />
                            <input type="hidden" name="operation" id="operation" />
                            <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

<!-- ################################# Fim Modal ################################# -->


    <script type="text/javascript" language="javascript" >

/* ################################# Adicionar  #################################*/
    $(document).ready(function(){
    // alert('aqui');
        $('#botao_adicionar').click(function(){
        //  alert('aqui');
            $('#userModal').modal('show');
            $('#user_form')[0].reset();
            $('.modal-title').text("Adicionar Admin");
            $('#action').val("Add");
            $('#operation').val("Add");
            $('#user_uploaded_image').html('');
        });
/* ################################# fim add  ################################# */




	/* ################################# Submit Modal ################################# */
        $(document).on('submit', '#user_form', function(event)
        {
            //alert('submit');

            // // event.preventDefault();
            var text_email_admin = $('#text_email_admin').val();
            var text_pass_1_admin = $('#text_pass_1_admin').val();
            var text_pass_2_admin = $('#text_pass_2_admin').val();
            var text_full_name_admin = $('#text_full_name_admin').val();
            var text_address_admin = $('#text_address_admin').val();
            var text_city_admin = $('#text_city_admin').val();
            var text_telephone_admin = $('#text_telephone_admin').val();
            var text_activo_admin = '';
            var text_gender_admin = '';

            $("#text_activo_admin option:selected").each(function() 
            {
                text_activo_admin = $(this).val();
            }); 

            $("#text_gender_admin option:selected").each(function() 
            {
                text_gender_admin = $(this).val();
            }); 

            

            var image = $('#user_image').val().split('\\').pop().toLowerCase();
            var extension = $('#user_image').val().split('.').pop().toLowerCase();

            // // array = [ text_gender_admin];

            // // alert(array);
            
            if(extension != '')
            {
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                    alert("Invalid Image File");
                    $('#user_image').val('');
                    return false;
                }
            }	


            
            

            if(text_email_admin != '' && text_pass_1_admin != '' && text_pass_2_admin != '' && text_full_name_admin !='' 
            && text_address_admin != '' && text_city_admin != '' && text_telephone_admin != '' && text_activo_admin != ''
            && text_gender_admin != '' && image != '')
            {
                // // alert('success!!');
                // // alert(array);
                // $.ajax({
                // 	url:"insert_pac.php",
                // 	method:'POST',
                // 	data:new FormData(this),
                // 	contentType:false,
                // 	processData:false,
                // 	success:function(data)
                // 	{
                // 		alert(data);
                // 		$('#user_form')[0].reset();
                // 		$('#userModal').modal('hide');
                // 		dataTable.ajax.reload();
                // 	}
                // });

                $.ajax(
                {
                        method: 'post',
                        url: '?a=create_admin_modal',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            $('#user_form')[0].reset();
                            $('#userModal').modal('hide');
                            $('#tabela-admins').DataTable().ajax.reload();
                            //dataTable.ajax.reload();
                            // // alert(data);
                            // // alert('success');

                        // // alert(data);
                        // //  $("#msg_dados_admin").fadeIn();

                        // //  const obj = JSON.parse(data);

                        // //  document.getElementById("msg_dados_admin").innerHTML = obj;


                        // alert('success');
                            //document.getElementById("corpo_pass_sucesso").innerHTML = '';
                        // document.getElementById("msg_dados").innerHTML = '';
                            //const obj = JSON.parse(result);
                            //alert(result);
                            

                            // // var passSucesso = new bootstrap.Modal(document.getElementById('passSucesso'));
                            // // passSucesso.show();

                            

                            // //  setTimeout(function() {
                            // //      $("#msg_dados_admin").fadeOut().empty();
                            // //  }, 2000);

                            // //  $('#tabela-admins').DataTable().ajax.reload();



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
            else
            {
                alert("Both Fields are Required");
            }
        });
	/* ################################# fim Submit  ################################# */
	

	/* #################### Actualizar #################### */
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"fetch_single_pac.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				alert(data.first_name);
				/*$('#userModal').modal('show');
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('#email').val(data.email);
				$('#telefone').val(data.telefone);
				$('#codigots').val(data.codigots);
				$('.modal-title').text("Editar Paciente");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");*/
			}
		})
	});
	/* #################### Fim ####################*/


	/* #################### Apagar #################### */
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"?a=delete_admin&id_admin=" + user_id,
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
                   // $('#tabela-admins').DataTable().ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	/* #################### Fim  #################### */
	
	
});

</script>



 