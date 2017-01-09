<?php

	class Model_Perfil extends RedBean_SimpleModel {

	

		public function listaperfilcombo($post){

			$perfils =  R::getAll( 'SELECT * FROM perfil');
			
			$option = "";

			foreach ($perfils as $perfil) {
				$option .= '<option value="'.$perfil['id'].'">'.$perfil['nome'].'</option>';
			}

			echo $option;


		}	

		public function listaperfil($post){

			 $perfil =  R::getAll( 'SELECT perfilusuario.id as id, perfilusuario.usuario_id, perfilusuario.perfil_id, usuario.nome FROM perfilusuario join usuario on usuario.id = perfilusuario.usuario_id  where perfilusuario.id = '.$post['id']);
			 $json = json_encode($perfil);
			 echo $json;

		}	



			public function deleteperfil($post){
 			  $perfil = R::load( 'perfilusuario', $post['id'] );
 			  R::trash( $perfil ); 
		}



	public function listaperfiltabela($post){

			 $perfilusuarios =  R::getAll( 'SELECT usuario.nome as usunome, perfil.id as perfil_id, perfilusuario.id as perfilusuario_id, perfil.nome as nome  FROM perfilusuario join perfil on perfil.id = perfilusuario.perfil_id join usuario  on usuario.id = perfilusuario.usuario_id');
			 $table = '';
			   foreach( $perfilusuarios as $perfil ) {
			                $table .='<tr>
                                        <td>'.$perfil['usunome'].'</td>
                                        <td>'.$perfil['nome'].'</td>
                                        <td>
                                        <a href="#" onclick="buscaperfil('.$perfil['perfilusuario_id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deleteperfil('.$perfil['perfilusuario_id'].',\''.$perfil['usunome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($perfilusuarios) ==0){
                				     $table .='<tr style="text-align:center;">
                                        <td colspan="3">Nenhum perfil cadastrado...</td>
                                    </tr>';
                }               

			 echo $table;

		}	




		public function addperfil($post){

			try{

				if($post["id"] !=''){
					$perfil =  R::getAssocRow( 'SELECT * FROM perfilusuario where id = '.$post["id"]);
				}

				if(count($perfil) > 0){

					$perfil = R::load( 'perfilusuario', $post["id"] );
					$perfil->usuario_id = $post['usuario_id'];
					$perfil->perfil_id = $post['perfil_id'];
				
					R::store( $perfil );

				}else{

					$perfil = R::dispense( 'perfilusuario');
					$perfil->usuario_id = $post['usuario_id'];
					$perfil->perfil_id = $post['perfil_id'];
					R::store( $perfil );
				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroPerfil.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroPerfil.php&dados=false&msg=');
			}

			

		}


	



	}



?>