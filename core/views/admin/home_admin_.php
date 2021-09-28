<div class="container-fluid">
    <div class="row mt-3">
        
        <div class="col-md-2">
            <?php include(__DIR__ . '/layouts/admin_menu.php')?>
        </div>
        <!-- HOME -->
        <!-- ===================================================================================================== -->
            <div id="home_admin" class="col-md-10">
                    
            </div>
        <!-- ===================================================================================================== -->
        <!-- FIM HOME -->
    </div>
</div>

<script>

$(document).ready(function() {
  $("#botao_adicionar").click(function () {
    alert('aqui');
  });
});

</script>

    

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

    <?php $f = ''; ?>


    <!-- ################################# Modal ################################# -->
        <div id="userModal" name="userModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="post"  id="user_form" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Adicionar Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body" id="corpo_modal">

                                        <div id="msg_dados_admin">
                                            </div>

                                            <!-- Email -->
                                            <!-- ===================================================================================================== -->				
                                            <label>Email</label>
                                                <input type="email" class="form-control" name="text_email_admin_add" id="text_email_admin_add" placeholder="Email" required>
                                                <br/>
                                            <!-- ===================================================================================================== -->					
                                            
                                            <!-- pass_1 -->
                                            <!-- ===================================================================================================== -->					
                                                <label>Pass</label>
                                                <input type="password" class="form-control" name="text_pass_1_admin_add" id="text_pass_1_admin_add" placeholder="Pass" required>
                                                <br/>
                                            <!-- ===================================================================================================== -->					

                                            <!-- pass_2 -->
                                            <!-- ===================================================================================================== -->					
                                                <label>Repetir Pass</label>
                                                <input type="password" class="form-control" name="text_pass_2_admin_add" id="text_pass_2_admin_add"  placeholder="Repetir Pass" required>
                                                <br/>
                                            <!-- ===================================================================================================== -->					

                                            <!-- Full Name -->
                                            <!-- ===================================================================================================== -->					
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="text_full_name_admin_add"  id="text_full_name_admin_add"  placeholder="Full Name" required>
                                                <br/>
                                            <!-- ===================================================================================================== -->					

                                            <!-- address -->
                                            <!-- ===================================================================================================== -->					
                                                <label>address</label>
                                                <input type="text" class="form-control" name="text_address_admin_add" id="text_address_admin_add" placeholder="address" required>
                                                <br/>
                                            <!-- ===================================================================================================== -->					

                                            <!-- city -->
                                            <!-- ===================================================================================================== -->					
                                                <label>city</label>
                                                <input type="text" class="form-control" name="text_city_admin_add" id="text_city_admin_add"  placeholder="city" required>
                                                <br/>
                                            <!-- ===================================================================================================== -->					

                                            <!-- telephone -->
                                            <!-- ===================================================================================================== -->					
                                                <label>telephone</label>
                                                <input type="text" class="form-control" name="text_telephone_admin_add" id="text_telephone_admin_add" placeholder="telephone">
                                                <br/>
                                            <!-- ===================================================================================================== -->	
                                            
                                            <!-- Estado -->
                                            <!-- ===================================================================================================== -->					
                                                <label>Estado:</label>
                                                <select id="text_activo_admin_add" name="text_activo_admin_add"  class="form-control" onchange="">
                                                    <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                    <option value="1" <?= $f == 'activo' ? 'selected' : '' ?> class="nav-it">Activo</option>
                                                    <option value="0" <?= $f == 'inactivo' ? 'selected' : '' ?> class="nav-it">Inactivo</option>
                                                </select>	
                                                <br/>
                                            <!-- ===================================================================================================== -->									

                                            <!-- Género -->
                                            <!-- ===================================================================================================== -->					
                                                <label>Gender</label>
                                                <select id="text_gender_admin_add" name="text_gender_admin_add" class="form-control" onchange=""> 
                                                                <option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
                                                                <option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
                                                                <option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
                                                </select>
                                                <br/>
                                            <!-- ===================================================================================================== -->	

                                            <!-- Picture -->
                                            <!-- ===================================================================================================== -->					
                                                <input type="file" name="user_image_add" id="user_image_add" />
                                                <span id="user_uploaded_image"></span>
                                            <!-- ===================================================================================================== -->		                        

                            </div>
                        <div class="modal-footer">
                            <input type="hidden" name="user_id" id="user_id" />
                            <input type="hidden" name="operation" id="operation" />
                            <input type="submit" name="action" id="action" class="btn btn-success " value="Adicionar" />
                            <button type="button"  onclick="" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- ################################# Fim Modal ################################# -->    

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

<script>



// ========================================================
// insert_data_admin
    // function insert_data_admin()
    // {
    //     alert('clicou no botao');

    //     $.ajax({
    //         method: 'post',
    //         url: '?a=create_admin_modal',
    //         data: {
    //             text_email_admin: document.getElementById('text_email_admin_add').value,
    //             text_pass_1_admin: document.getElementById('text_pass_1_admin_add').value,
    //             text_pass_2_admin: document.getElementById('text_pass_2_admin_add').value,
    //             text_full_name_admin: document.getElementById('text_full_name_admin_add').value,
    //             text_address_admin: document.getElementById('text_address_admin_add').value,
    //             text_city_admin: document.getElementById('text_city_admin').value,
    //             text_telephone_admin: document.getElementById('text_telephone_admin_add').value,
    //             text_gender_admin: document.getElementById('text_gender_admin_add').value,
    //             text_activo_admin: document.getElementById('text_activo_admin_add').value,
    //             user_image_admin: document.getElementById('user_image_admin_add').files[0].name,
    //         },
    //         //dataType:"json",
    //         success:function(data)
    //         {
    //             alert(data);
    //          $("#msg_dados_admin").fadeIn();

    //          const obj = JSON.parse(data);

    //          document.getElementById("msg_dados_admin").innerHTML = obj;


    //            // alert('success');
    //             //document.getElementById("corpo_pass_sucesso").innerHTML = '';
    //            // document.getElementById("msg_dados").innerHTML = '';
    //             //const obj = JSON.parse(result);
    //             //alert(result);
                

    //             // // var passSucesso = new bootstrap.Modal(document.getElementById('passSucesso'));
    //             // // passSucesso.show();

                

    //              setTimeout(function() {
    //                  $("#msg_dados_admin").fadeOut().empty();
    //              }, 2000);

    //              $('#tabela-admins').DataTable().ajax.reload();



    //             // // data.preventDefault();
    //             // // alert('sucess');
    //         //$('#modalAdd').modal('hide');
    //             //alert(data);
    //         // dataTable.ajax.reload();
    //         },
    //         error:function(data)
    //         {
    //         // $('#modalAdd').modal('hide');
    //         alert('error');
    //         // dataTable.ajax.reload();
    //         }
            
    //     });
    // }
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
        aletr('update')
                    $.ajax({
                        url:"?a=change_admin_data_modal_admin_alfa&c=" + id_admin,
                        method:"POST",
                        data:{id_admin:id_admin},
                        success:function(data)
                        {
                           alert('sucess');
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
                           alert('Error');
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
function insert_data_admin()
{
           //alert('submit');

            // // event.preventDefault();
            var text_email_admin = $('#text_email_admin_add').val();
            var text_pass_1_admin = $('#text_pass_1_admin_add').val();
            var text_pass_2_admin = $('#text_pass_2_admin_add').val();
            var text_full_name_admin = $('#text_full_name_admin_add').val();
            var text_address_admin = $('#text_address_admin_add').val();
            var text_city_admin = $('#text_city_admin_add').val();
            var text_telephone_admin = $('#text_telephone_admin_add').val();
            var text_activo_admin = '';
            var text_gender_admin = '';

            //alert('submit');

            //alert(text_email_admin);

            $("#text_activo_admin_add option:selected").each(function() 
            {
                text_activo_admin = $(this).val();
            }); 

            $("#text_gender_admin_add option:selected").each(function() 
            {
                text_gender_admin = $(this).val();
            }); 

            

            var image = $('#user_image_add').val().split('\\').pop().toLowerCase();
            var extension = $('#user_image_add').val().split('.').pop().toLowerCase();

           // array = [ text_gender_admin];

           
            
            if(extension != '')
            {
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                    alert("Invalid Image File");
                    $('#user_image_add').val('');
                    return false;
                }
            }	

            // alert(extension);
             array = [ text_email_admin,
             text_pass_1_admin,
             text_pass_2_admin ,
             text_full_name_admin,
             text_address_admin ,
             text_city_admin ,
             text_telephone_admin ,
             image,
             text_activo_admin ,
             text_gender_admin 
             ];

            //alert(array);

            
            

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
                            alert('ajax sucess');
                            
                           // $('#user_form')[0].reset();
                          //  $('#userModal').modal('hide');
                           // $('#tabela-admins').DataTable().ajax.reload();
                            
                            //dataTable.ajax.reload();
                            // // alert(data);
                            // // alert('success');

                        // // alert(data);
                        // $("#msg_dados_admin").fadeIn();

                        // const obj = JSON.parse(data);

                        // document.getElementById("msg_dados_admin").innerHTML = obj;


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

                          alert('ajax sucess');

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
                        alert('ajax error');
                        // dataTable.ajax.reload();
                        }
                        
                });
                }
            else
            {
                alert("Both Fields are Required");
            }

            //admins_list();
};

/* #################### ver admin #################### */
    function apresentarModalVerAdmin(id_admin) 
            {
                //alert('ver');
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

<script type="text/javascript" language="javascript" >



    $(document).ready(function(){

        /* ################################# Adicionar  #################################*/
            $(document).on('click', '#botao_adicionar', function(event)
            {
               // alert('aqui');
                $('#userModal').modal('show');
                  //  $('#user_form')[0].reset();
                    $('.modal-title').text("Adicionar Admin");
                    $('#action').val("Add");
                    $('#operation').val("Add");
                    $('#user_uploaded_image').html('');
            });
        /* ################################# fim add  ################################# */

	/* ################################# Submit Modal ################################# */

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