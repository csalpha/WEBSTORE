/*app.js*/

	//=========================================
	// adicionar cart
		function add_to_cart(id_product)
		{
			axios.defaults.withCredentials = true;
			// Pedido (chamada ajax)
			// Executar a rota adicionar cart e add id_product
			axios.get('?a=add_to_cart&id_product=' + id_product)
			// Resposta
				.then(function(response){

					var total_products = response.data;

					document.getElementById('cart').innerText = total_products;

					console.log(response.data);

				});
		}
	//=========================================

	//=========================================
	// remove cart
		function remove_product_cart(id_product)
		{
			 axios.defaults.withCredentials = true;
			 // Pedido (chamada ajax)
			 // Executar a rota adicionar cart e add id_product
			 axios.post('?a=remove_product_cart&id_product=' + id_product)
			 // Resposta
			 	.then(function(response){

			 		//alert(response.data);
			 		//const obj = JSON.parse(response.data);
			 		//alert(obj);

			 		//apresentarModalEncomenda();

			 		//var total_products = response.data;
			 		document.getElementById('corpoEncomenda').innerHTML = response.data;
			 		//document.getElementById('corpoEncomenda').innerHTML = obj;

					var total_products = document.getElementById('total_quantity').value;

			 		document.getElementById('cart').innerText = total_products;

			 		//console.log(response.data);

			 	});

				// // $.ajax({
				// // 	url:"?a=remove_product_cart&id_product=" + id_product,
				// // 	method:"POST",
				// // 	data:{},
				// // 	success:function(data)
				// // 	{
				// // 		alert(data);
				// // 		console.log(data);

				// // 		//const obj = JSON.parse(data);

				// // 		document.getElementById('corpoEncomenda').innerHTML = data;

				// // 		// // var modalAlterarPass = new bootstrap.Modal(document.getElementById('modalAlterarPass'));
				// // 		// // modalAlterarPass.show();

				// // 		// // document.getElementById("corpo_modal_pass").innerHTML = obj;

				// // 	},
				// // 	error:function(data)
				// // 	{

				// // 	}

				// // });
		}
	//=========================================

	//=========================================
	// clean cart
		function clean_cart()
		{
			//limpar todo o cart
			axios.defaults.withCredentials = true;
			// Pedido (chamada ajax)
			// Executar a rota adicionar cart e add id_product
			axios.post('?a=clean_cart')
			// Resposta
				.then(function(response){

					//alert(response.data);

					document.getElementById('cart').innerText = 0;

					document.getElementById('corpoEncomenda').innerHTML = response.data;

					//apresentarModalEncomenda();

					console.log(response.data);

				});
		}
	//=========================================

	// ========================================================
	// limpar cart off
		function limpar_cart_off()
		{
			var e = document.getElementById("confirmar_limpar_cart");
			e.style.display = "none";
		}
	// ========================================================

	// ========================================================
	// usar address alternativa
		function use_alternative_address(){

			// mostrar ou esconder o espaço para a address alternativa.
			var e = document.getElementById('check_address_alternativa');
			if(e.checked == true){

				// mostra o quadro para definir address alternativa
				document.getElementById("address_alternativa").style.display = 'block';

			} else {

				// esconde o quadro para definir address alternativa
				document.getElementById("address_alternativa").style.display = 'none';
			}
		}
	// ========================================================

	// ========================================================
	// address alternativa
		function alternative_address()
		{
			axios({
				method: 'post',
				url: '?a=alternative_address',
				data: {
						text_address: document.getElementById('text_address_alternativa').value,
						text_city: document.getElementById('text_city_alternativa').value,
						text_email: document.getElementById('text_email_alternativo').value,
						text_telephone: document.getElementById('text_telephone_alternativo').value
				},

				success:function(data)
				{
					const obj = JSON.parse(data);
					console.log(data);
					console.log(obj);
					alert(data);
					alert(obj);

					// var modalFinalizarEncomenda = new bootstrap.Modal(document.getElementById('modalFinalizarEncomenda'));
					// modalFinalizarEncomenda.show();

					// document.getElementById("corpoFinalizarEncomenda").innerHTML = obj;

				},
				error:function(data)
				{
					//$('#modalUpdate').modal('hide');
				}
			});
		}
	// ========================================================

	// ========================================================
	// address alternativa
		function alternative_address_modal()
		{
			axios({
				method: 'post',
				url: '?a=confirm_order_modal',
				data: {
						text_address: document.getElementById('text_address_alternativa').value,
						text_city: document.getElementById('text_city_alternativa').value,
						text_email: document.getElementById('text_email_alternativo').value,
						text_telephone: document.getElementById('text_telephone_alternativo').value
				},


				success:function(data)
				{
					console.log('aqui');
					//apresentarModalConfirmedOrder();
				    const obj = JSON.parse(data);
				   /* console.log(data);
				    console.log(obj);
				    alert(data);*/
					// // alert(obj);
					// // console.log('aqui');

					alert(data);
					var modalConfirmOrder = new bootstrap.Modal(document.getElementById('modalConfirmOrder'));
					modalConfirmOrder.show();



					document.getElementById("corpoFinalizarEncomenda").innerHTML = obj;

				},
				error:function(data)
				{
					//$('#modalUpdate').modal('hide');
				}
			});

		}
	// ========================================================


	// show modals
	// =====================================================================================================

		// =================================================================================================
			function apresentaModalAlterarPass()
			{
				$.ajax({
					url:"?a=change_password_modal",
					method:"POST",
					data:{},
					success:function(data)
					{
						//alert(data);
						console.log(data);

						const obj = JSON.parse(data);

						var modalAlterarPass = new bootstrap.Modal(document.getElementById('modalAlterarPass'));
						modalAlterarPass.show();

						document.getElementById("corpo_modal_pass").innerHTML = obj;

					},
					error:function(data)
					{

					}

				});


			}
		// =================================================================================================

		// =================================================================================================

		// =================================================================================================
			function apresentaModalAlterarDados()
			{
				$.ajax({
					url:"?a=change_personal_data_modal",
					method:"POST",
					data:{},
					success:function(data)
					{
						const obj = JSON.parse(data);

						var modalAlterarDados = new bootstrap.Modal(document.getElementById('modalAlterarDados'));
						modalAlterarDados.show();

						document.getElementById("corpo_modal_dados").innerHTML = obj;

					},
					error:function(data)
					{

					}

				});

			}
		// =================================================================================================

		// =================================================================================================
			function apresentaModalHistorico()
			{
				$.ajax({
					url:"?a=order_history_modal",
					method:"POST",
					data:{},
					success:function(data)
					{
						//alert(data);
						//console.log(data);

						const obj = JSON.parse(data);

						var modalHistorico = new bootstrap.Modal(document.getElementById('modalHistorico'));
						modalHistorico.show();

						document.getElementById("corpo_modal_historico").innerHTML = obj;

					},
					error:function(data)
					{

					}

				});

			}
		// =================================================================================================

		// =================================================================================================
			function apresentarModalAdd()
			{
				var modalAdd = new bootstrap.Modal(document.getElementById('modalAdd'));
				modalAdd.show();
			}
		// =================================================================================================

		// =================================================================================================
			function apresentarModalLogin()
			{
				var modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'));
				modalLogin.show();
			}
		// =================================================================================================
			function apresentarModalProfile()
			{
				$.ajax({
						url:"?a=profile_modal",
						method:"POST",
						data:{},
						success:function(data)
						{
							const obj = JSON.parse(data);

							var modalProfile = new bootstrap.Modal(document.getElementById('modalProfile'));
							modalProfile.show();

							document.getElementById("corpo_profile_modal").innerHTML = obj;

						},
						error:function(data)
						{

						}


				});

			}
		// =================================================================================================

		function logout()
		{
			$.ajax({
				url:"?a=logout",
				method:"POST",
				data:{},
				success:function(data)
				{
					location.reload();

				},
				error:function(data)
				{

				}


		});
		}

		// =================================================================================================
			function apresentarModalEncomenda()
			{
				$.ajax({
						url:"?a=cart_modal",
						method:"POST",
						data:{},
						success:function(data)
						{
							const obj = JSON.parse(data);
							// // console.log(data);
							// // console.log(obj);

							var modalEncomenda = new bootstrap.Modal(document.getElementById('modalEncomenda'));
							modalEncomenda.show();

							document.getElementById("corpoEncomenda").innerHTML = obj;

						},
						error:function(data)
						{

						}
				});


			}
		// =================================================================================================

		// =================================================================================================
			function apresentarModalFinalizarEncomenda()
			{
				$.ajax({

						url:"?a=finalize_order_modal",
						method:"POST",
						data:{},
						success:function(data)
						{
							const obj = JSON.parse(data);

							if(obj == true)
							{
								var modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'));
								modalLogin.show();
							}
							else
							{
								var modalFinalizarEncomenda = new bootstrap.Modal(document.getElementById('modalFinalizarEncomenda'));
								modalFinalizarEncomenda.show();

								document.getElementById("corpoFinalizarEncomenda").innerHTML = obj;
							}

						},
						error:function(data)
						{
						}

				});


			}
		// =================================================================================================

		// =================================================================================================
			function apresentarModalConfirmedOrder()
			{
				$.ajax({

						url:"?a=confirm_order_modal",
						method:"POST",
						data:{},
						success:function(data)
						{

							const obj = JSON.parse(data);

							$('#modalConfirmOrder').modal({backdrop: 'static', keyboard: false})

							var modalConfirmOrder = new bootstrap.Modal(document.getElementById('modalConfirmOrder'));
							modalConfirmOrder.show();

							document.getElementById("corpo_modal").innerHTML = obj;

							$("#cart").html("0");


						},
						error:function(data)
						{

						}

				});
			}
		// =================================================================================================

	// =====================================================================================================


	// =================================================================================================
	// change password submit modal
		function change_password_submit_modal()
		{
			$.ajax({
				method: 'post',
				dataType: 'json',
				url: '?a=change_password_submit_modal',
				data: {
					text_nova_pass: document.getElementById('text_nova_pass').value,
					text_pass_atual: document.getElementById('text_pass_atual').value,
					text_repetir_nova_pass: document.getElementById('text_repetir_nova_pass').value
				},

				success:function(result)
				{
					$("#msg").fadeIn();

					//document.getElementById("corpo_pass_sucesso").innerHTML = '';
					document.getElementById("msg").innerHTML = '';
					//const obj = JSON.parse(result);
					//alert(result);
					// //  const obj = JSON.parse(response);

					// // var passSucesso = new bootstrap.Modal(document.getElementById('passSucesso'));
					// // passSucesso.show();

					document.getElementById("msg").innerHTML = result;

					setTimeout(function() {
						$("#msg").fadeOut().empty();
					}, 2000);


					/*console.log(data);
					console.log(obj);*/
				},
				error:function(result)
				{
					alert(result);
				}
			});
		}
		// =================================================================================================

	// =================================================================================================
	// change password submit modal
		function change_personal_data_submit_modal()
		{
			//alert('aqui');

			$.ajax({

				method: 'post',
				dataType: 'json',
				url: '?a=change_personal_data_submit_modal',
				data: {
					text_email: document.getElementById('text_email').value,
					text_full_name: document.getElementById('text_full_name').value,
					text_address: document.getElementById('text_address').value,
					text_city: document.getElementById('text_city').value,
					text_telephone: document.getElementById('text_telephone').value
				},

				success:function(result)
				{
					//alert(result);
					$("#msg_dados").fadeIn();

					//document.getElementById("corpo_pass_sucesso").innerHTML = '';
					document.getElementById("msg_dados").innerHTML = '';
					//const obj = JSON.parse(result);
					//alert(result);
					// //  const obj = JSON.parse(response);

					// // var passSucesso = new bootstrap.Modal(document.getElementById('passSucesso'));
					// // passSucesso.show();

					document.getElementById("msg_dados").innerHTML = result;

					setTimeout(function() {
						$("#msg_dados").fadeOut().empty();
					}, 2000);

				},
				error:function(result)
				{
					//alert(result);
				}
			});
		}
	// =================================================================================================

	// =================================================================================================
	// change order details
		function order_details(id_order, id_customer)
		{
			//alert('aqui');

			 $.ajax({
			 	method: 'post',
			 	dataType: 'json',
			 	url: '?a=order_history_details_modal',
			 	data: { id_order: id_order, id_customer: id_customer },
			 	success:function(result)
			 	{
					var modalOrderDetail = new bootstrap.Modal(document.getElementById('modalOrderDetail'));
					modalOrderDetail.show();
					document.getElementById("corpo_order_detail").innerHTML = result;
					
			 		//alert(result);
			 		//const obj = JSON.parse(result);
			 		//alert(obj);
			 		// // $("#msg_dados").fadeIn();
			 		// // //document.getElementById("corpo_pass_sucesso").innerHTML = '';
			 		// // document.getElementById("msg_dados").innerHTML = '';
			 		//const obj = JSON.parse(result);
			 		// // //alert(result);
			 		//const obj = JSON.parse(response);

			 		// // setTimeout(function() {
			 		// // 	$("#msg_dados").fadeOut().empty();
			 		// // }, 2000);
			 	},
			 	error:function(result)
			 	{
			 		//alert(result);
			 	}
			 });
		}
	// =================================================================================================

	// =================================================================================================
		function apresentarModalProfileAdmin()
		{
			//alert('aqui');

			$.ajax({
					url:"?a=profile_admin_modal",
					method:"POST",
					data:{},
					success:function(result)
					{
						//alert('success');

						const obj = JSON.parse(result);
						var modalProfileAdmin = new bootstrap.Modal(document.getElementById('modalProfileAdmin'));
						modalProfileAdmin.show();

						document.getElementById("corpo_profile_admin_modal").innerHTML = obj;

					//	dataTable.ajax.reload();


						// // const obj = JSON.parse(data);
						// // var modalProfile = new bootstrap.Modal(document.getElementById('modalProfile'));
						// // modalProfile.show();
						// // document.getElementById("corpo_profile_modal").innerHTML = obj;
					},
					error:function(data)
					{
					}
			});
		}
	// =================================================================================================



	// =================================================================================================
	function apresentaModalAlterarPassAdminAlfa(id_admin)
	{
		$.ajax({
			url:"?a=change_password_admin_modal_alfa",
			method:"POST",
			data:{id_admin : id_admin},
			success:function(data)
			{
				//alert(data);
				console.log(data);

				const obj = JSON.parse(data);

				var modalAlterarPassAdminAlfa = new bootstrap.Modal(document.getElementById('modalAlterarPassAdminAlfa'));
				modalAlterarPassAdminAlfa.show();

				document.getElementById("corpo_modal_pass_admin_alfa").innerHTML = obj;

				//dataTable.ajax.reload();

			},
			error:function(data)
			{

			}

		});


	}
// =================================================================================================	

	// =================================================================================================

	// =================================================================================================
		function apresentaModalAlterarDadosAdmin()
		{
			//alert('aqui');

			$.ajax({
				url:"?a=change_personal_data_modal_admin",
				method:"POST",
				data:{},
				success:function(data)
				{
					const obj = JSON.parse(data);

					var modalAlterarDadosAdmin = new bootstrap.Modal(document.getElementById('modalAlterarDadosAdmin'));
					modalAlterarDadosAdmin.show();

					document.getElementById("corpo_modal_dados_admin").innerHTML = obj;

				},
				error:function(data)
				{

				}

			});

		}
	// =================================================================================================



	// =================================================================================================
		function change_password_submit_modal_admin_alfa(id_admin)
		{
			//alert('aqui');

			$.ajax({
				method: 'post',
				dataType: 'json',
				url: '?a=change_password_submit_modal_admin_alfa',
				data: {
					text_nova_pass_admin: document.getElementById('text_nova_pass_admin').value,
					text_pass_atual_admin: document.getElementById('text_pass_atual_admin').value,
					text_repetir_nova_pass_admin: document.getElementById('text_repetir_nova_pass_admin').value
				},

				success:function(result)
				{
					$("#msg").fadeIn();

					//alert('Success');

					//document.getElementById("corpo_pass_sucesso").innerHTML = '';
					document.getElementById("msg").innerHTML = '';
					const obj = JSON.parse(result);

					
					//alert(result);
					//const obj = JSON.parse(response);

					// // var passSucesso = new bootstrap.Modal(document.getElementById('passSucesso'));
					// // passSucesso.show();

					

					setTimeout(function() {
						$("#msg").fadeOut().empty();
					}, 2000);


					/*console.log(data);
					console.log(obj);*/
				},
				error:function(result)
				{
					//alert('Error');
				}
			});
		}
	// =================================================================================================	

	// =================================================================================================
	// change password submit modal
		function change_personal_data_submit_modal_admin()
		{
			//alert('aqui');

			$.ajax({

				method: 'post',
				dataType: 'json',
				url: '?a=change_personal_data_submit_modal_admin',
				data: {
					text_email_admin: document.getElementById('text_email_admin').value,
					text_full_name_admin: document.getElementById('text_full_name_admin').value,
					text_address_admin: document.getElementById('text_address_admin').value,
					text_city_admin: document.getElementById('text_city_admin').value,
					text_telephone_admin: document.getElementById('text_telephone_admin').value
				},

				success:function(result)
				{
					//alert('success');
					$("#msg_dados").fadeIn();

					
					document.getElementById("msg_dados").innerHTML = '';
		
					//const obj = JSON.parse(result);

					document.getElementById("msg_dados").innerHTML = result;

				 	setTimeout(function() {
				 		$("#msg_dados").fadeOut().empty();
				 	}, 2000);

				},
				error:function(result)
				{
					alert('Error');
				}
			});
		}
	// =================================================================================================

	


	


	/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
		"use strict";
	
		// Add active state to sidbar nav links
		var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
			$("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
				if (this.href === path) {
					$(this).addClass("active");
				}
			});
	
		// Toggle the side navigation
		$("#sidebarToggle").on("click", function(e) {
			e.preventDefault();
			$("body").toggleClass("sb-sidenav-toggled");
		});
	})(jQuery);




