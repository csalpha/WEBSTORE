<?php
    use core\classes\Store;  
?>
    <!-- container-fluid -->
    <!-- ===================================================================================================== -->
        <div class="container-fluid navegacao nav-item">
            <!-- row -->
            <!-- ===================================================================================================== -->
                <div class="row">
                    <!-- logo -->
                    <!-- ===================================================================================================== -->
                        <!-- col -->
                        <!-- ===================================================================================================== -->
                            <div class="col-6 p-3 ">
                                <a onclick="home_page_admin()">
                                    <img src="../assets/images/icon/logo.svg" alt="main icon">
                                </a>
                            </div>
                        <!-- ===================================================================================================== -->
                    <!-- ===================================================================================================== -->

                    <!-- navigator -->
                    <!-- ===================================================================================================== -->
                        <!-- col -->
                        <!-- ===================================================================================================== -->
                            <div class="col-6 p-3 text-end align-self-center nav-item">
                                <?php if (Store::is_admin_logged_in()) : ?>
                                    <!-- user -->
                                    <!-- ===================================================================================================== -->
                                        <!-- <a href="?a=profile_admin" class="nav-item">
                                            <i class="fas fa-user me-2"></i>
                                            <?= $_SESSION['admin_user'] ?>
                                        </a> -->

                                        <a onclick="apresentarModalProfileAdmin()" class="nav-item">
                                            <i class="fas fa-user me-2"></i>
                                            <?= $_SESSION['admin_user'] ?>
                                        </a>
                                    <!-- ===================================================================================================== -->
                                    <span class="mx-2 nav-item"></span>
                                    <!-- logout -->
                                    <!-- ===================================================================================================== -->
                                        <a href="?a=admin_logout" class="mx-2 nav-item-inv">
                                            <i class="fas fa-sign-out-alt me-2 nav-item-inv"></i>
                                        </a>
                                    <!-- ===================================================================================================== -->
                                <?php endif; ?>
                            </div>
                    <!-- ===================================================================================================== -->
                </div>
            <!-- ===================================================================================================== -->
        </div>
    <!-- ===================================================================================================== -->


    	<!-- modal Profile -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalProfileAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div id="corpo_profile_admin_modal"  class="modal-content">

								
                        </div>
					</div>
			</div>
		<!-- ===================================================================================================== -->	 
        
		<!-- Modal Alterar Pass Admin -->
		<!-- ===================================================================================================== -->
			<div class="modal fade" id="modalAlterarPassAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

					  <div class="modal-dialog modal-dialog-centered">
					  
						  <div id="corpo_modal_pass_admin" class="modal-content">
								

								
						  
						  </div>
						  



					  </div>

			</div>

		<!-- ===================================================================================================== --> 

		<!-- Modal Alterar Pass Admin -->
		<!-- ===================================================================================================== -->
        <div class="modal fade" id="modalAlterarPassAdminAlfa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered">

    <div id="corpo_modal_pass_admin_alfa" class="modal-content">
          

          
    
    </div>
    



</div>

</div>

<!-- ===================================================================================================== -->         
        
		<!-- Modal Alterar Pass Admin -->
		<!-- ===================================================================================================== -->
        <div class="modal fade" id="modalAlterarDadosAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div id="corpo_modal_dados_admin" class="modal-content">
          

          
    
                    </div>
    



                </div>

        </div>

<!-- ===================================================================================================== -->          