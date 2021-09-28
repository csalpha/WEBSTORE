<?php
	use core\classes\Store;
	
	$f = '';

	// ===========================================================
    // variáveis
		if(!empty($data_temp) && is_array($data_temp))
		{
			//extract($data_temp
			print_r($data);
		} 	
	// ===========================================================

	// =====================================================================================================
	//calcula o numero de products no carrinho
		$total_products = 0;
		if(isset($_SESSION['cart']))
		{
			foreach ($_SESSION['cart'] as $quantity) 
			{
				$total_products += $quantity;
			}
		}
	// =====================================================================================================
	

 ?>

		<!-- container-fluid -->
		<!-- ===================================================================================================== -->
			<div class="container-fluid navegacao">
				<!-- row -->
				<!-- ===================================================================================================== -->
					<div class="row ">
						<!-- col -->
						<!-- ===================================================================================================== -->
							<div class="col-6 p-3 ">
								<a href="?a=store">
								<img src="assets/images/icon/logo.svg" alt="main icon">  
								</a>
							</div>
						<!-- ===================================================================================================== -->
						
						<!-- col -->
						<!-- ===================================================================================================== -->
							<div class="col-6 text-end p-3">
							<!--	<a href="?a=home_page" class="nav-item-inv">Home</a> -->
								<a href="?a=store" class="nav-item-inv"> Store</a>

								<!-- ===================================================================================================== -->
								<!-- Verifica se existe customer na session -->
									<?php if(Store::is_customer_logged_in()): ?>
										<!-- <a href="?a=profile" class="fas fa-user mr-2 nav-item"><i class="nav-item"> <?= $_SESSION['nome_customer']  ?></i></a>     -->
										<a onclick="apresentarModalProfile()" class="fas fa-user mr-2 nav-item"><i class="nav-item"> <?= $_SESSION['nome_customer']  ?></i></a>
										<a href="?a=logout" class="nav-item-inv"><i class="fas fa-sign-out-alt"></i></a>
									<?php else: ?>
										<a id="user_login" onclick="apresentarModalLogin()" class="nav-item-inv"><i class="fas fa-sign-in-alt"></i></a>
								<!--	<a href="?a=new_customer" class="nav-item">Create account</a>  -->
										<a id="add_button" onclick="apresentarModalAdd()" class="nav-item"> <!--<i class="fa fa-plus"></i> -->Create account</a>  
									<?php endif; ?>
								<!-- ===================================================================================================== -->

								<!-- <a href="?a=cart" class="nav-item-inv"><i class="fas fa-shopping-cart"></i></a> -->
								<a  id="cart_modal" onclick="apresentarModalEncomenda()" class="nav-item-inv"><i class="fas fa-shopping-cart"></i></a>

								<span class="badge bg-warning" id="cart">
									<?= $total_products == 0 ? '0' : $total_products ?>
								</span>
							</div>
						<!-- ===================================================================================================== -->
					</div>
					<!-- <div id="msg"></div>					 -->


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

		<!-- modal Add -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<!-- form -->
							<!-- ===================================================================================================== -->				
								<form action="?a=create_customer" method="post">
									<!-- Email -->
									<!-- ===================================================================================================== -->				
										<div class="my-3">
											<label>Email</label>
											<input type="email" class="form-control" name="text_email"  placeholder="Email" required>
										</div>
									<!-- ===================================================================================================== -->					
									
									<!-- pass_1 -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
											<label>Pass</label>
											<input type="password" class="form-control" name="text_pass_1"  placeholder="Pass" required>
										</div>
									<!-- ===================================================================================================== -->					

									<!-- pass_2 -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
											<label>Repetir Pass</label>
											<input type="password" class="form-control" name="text_pass_2"  placeholder="Repetir Pass" required>
										</div>
									<!-- ===================================================================================================== -->					

									<!-- Full Name -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
											<label>Full Name</label>
											<input type="text" class="form-control" name="text_full_name"  placeholder="Full Name" required>
										</div>
									<!-- ===================================================================================================== -->					

									<!-- address -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
											<label>address</label>
											<input type="text" class="form-control" name="text_address"  placeholder="address" required>
										</div>
									<!-- ===================================================================================================== -->					

									<!-- city -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
											<label>city</label>
											<input type="text" class="form-control" name="text_city"  placeholder="city" required>
										</div>
									<!-- ===================================================================================================== -->					

									<!-- telephone -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
											<label>telephone</label>
											<input type="text" class="form-control" name="text_telephone"  placeholder="telephone">
										</div>
									<!-- ===================================================================================================== -->	
									
									<!-- gender -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
												<label>Gender</label>
												<select id="combo-status" name="text_gender" class="form-control" onchange=""> 
														<option value="" <?= $f == '' ? 'selected' : '' ?> class="nav-it"></option>
														<option value="M" <?= $f == 'masculino' ? 'selected' : '' ?> class="nav-it">Masculino</option>
														<option value="F" <?= $f == 'feminino' ? 'selected' : '' ?> class="nav-it">Feminino</option>
												</select>
										</div>
									<!-- ===================================================================================================== -->									

									<!-- Picture -->
									<!-- ===================================================================================================== -->					
										<div class="my-3">
													<label>Picture</label>
													<input type="file" class="form-control" name="user_image" id="user_image">
										</div>
									<!-- ===================================================================================================== -->						
									<!-- <a href="/*?a=create_customer_modal" onclick="insert_data_customer()" value="Criar conta" class="mb-3 btn btn-black text-uppercase filter-btn m-2">Criar Cliente</a> -->

									<!-- ===================================================================================================== -->                                                             
										</div>
										<div class="modal-footer">
											<input type="submit" value="Criar Cliente" class="mb-3 btn btn-black text-uppercase filter-btn m-2">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
										</div> 
								</form>
							<!-- ===================================================================================================== -->

					</div>
				</div>
			</div>
		<!-- ===================================================================================================== -->

		<!-- modal Login -->
		<!-- ===================================================================================================== -->
		<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<form method="post" id="login_form_customer"  >
						<div id="login_modal" class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Login</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div class="modal-body">
								<div class="my-3">
									<label>user:</label>
									<input type="email" id="text_user" name="text_user" placeholder="user" required class="form-control">
								</div>
								<div class="my-3">
									<label>pass:</label>
									<input type="password" id="text_pass" name="text_pass" placeholder="pass" required class="form-control">
								</div>
							</div>

							<div class="modal-footer">
								<input type="submit" value="Entrar" class="btn btn-success ">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							</div> 
					</form>			
				</div>
			</div>
			</div>	
		<!-- ===================================================================================================== -->

		<!-- modal Profile -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div  class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Profile</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>

							<div id="corpo_profile_modal" class="modal-body">


							</div>

							<div class="modal-footer">
								<div class="col">
									<!-- <a href="?a=change_personal_data" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-edit"></i>Alterar Dados</a> -->
									<a onclick="apresentaModalAlterarDados()" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-edit"></i>Alterar Dados</a>
								</div>
								
								<div class="col">
									<!-- <a href="?a=change_password" class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1"><i class="fas fa-key"></i>Alterar Password</a> -->
									<a onclick="apresentaModalAlterarPass() " class="mb-3 btn btn-black text-uppercase filter-btn m-2 m-1" data-bs-dismiss="modal"><i class="fas fa-key"></i>Alterar Password</a>
								</div>
							</div> 
									</form>
								<!-- ===================================================================================================== -->
						</div>
					</div>
			</div>
		<!-- ===================================================================================================== -->		

        <!-- modal encomenda -->
		<!-- ===================================================================================================== -->
		  	<div class="modal fade" id="modalEncomenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpoEncomenda" class="modal-content">

						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->

		<!-- modal Finalizar Encomenda -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalFinalizarEncomenda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpoFinalizarEncomenda" class="modal-content">

						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->

		<!-- modal Confirm Order -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalConfirmOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpo_modal" class="modal-content">


						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->

		<!-- Modal Histórico Encomendas -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalHistorico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpo_modal_historico" class="modal-content">	


						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->		

		<!-- Modal Alterar Pass -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalAlterarPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

					  <div class="modal-dialog modal-dialog-centered">
					  
						  <div id="corpo_modal_pass" class="modal-content">
								

								
						  
						  </div>
						  



					  </div>

			</div>

		<!-- ===================================================================================================== -->
		
		<!-- Modal Pass Sucesso -->
		<!-- ===================================================================================================== -->
		<div class="modal fade" id="passSucesso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpo_pass_sucesso" class="modal-content">
							  
								
						  
						  </div>
						  

					  </div>
			</div>
		<!-- ===================================================================================================== -->		
		
		<!-- Modal Alterar Dados -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalAlterarDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpo_modal_dados" class="modal-content">

						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->
		
		<!-- Modal order detail -->
		<!-- ===================================================================================================== -->
		<div class="modal fade" id="modalOrderDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
						  <div id="corpo_order_detail" class="modal-content">

						  </div>
					  </div>
			</div>
		<!-- ===================================================================================================== -->		
		

		<script>

		    // Submeter dados - login form
            // =============================================================================================
				$(document).on('submit', '#login_form_customer', function(event)
            	{
                        event.preventDefault();

						//alert('login');

						var text_user = $('#text_user').val();
						var text_pass = $('#text_pass').val();

						   array = [ 
						 	text_user,
						 	text_pass
                           ];

						  //alert(array);

                         if( text_user != '' && text_pass != '' )
                         {
        
                             $.ajax(
                             {
                                 method: 'post',
                                 url: '?a=login_submit',
                                 data:new FormData(this),
                                 contentType:false,
                                 processData:false,
                                 success:function(data)
                                 {
                                    $('#modalLogin').modal('hide');
									location.reload();
                                   
                                 },
                                 error:function(data)
                                 {
                               
                                     alert('ajax error');
                               
                                 }
                               
                          });            

                         }
                         else
                         {
                             alert("Both Fields are Required");
                         		}						  



           


                });
            // =============================================================================================  

        $(document).ready(function() {
            $('#order').DataTable({
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
    </script>