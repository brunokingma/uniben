<?php

	class Model_Modalidade extends RedBean_SimpleModel {

	


		public function listaModalidade($post){

			 $modalidade =  R::getAll( 'SELECT modalidade.id as modalidade_id, modalidade.* FROM modalidade where id = '.$post['id']);
			 $json = json_encode($modalidade);
			 echo $json;

		}	


		public function listamodalidadecombo($post){

			$modalidades =  R::getAll( 'SELECT * FROM modalidade');
			
			$option = "";

			foreach ($modalidades as $modalidade) {
				$option .= '<option value="'.$modalidade['id'].'">'.$modalidade['nome'].'</option>';
			}

			echo $option;


		}	
		

		public function deletemodalidade($post){
 			  $modalidade = R::load( 'modalidade', $post['id'] );
 			  R::trash( $modalidade ); 
		}


	public function listamodalidadetabela($post){

			 $modalidades =  R::getAll( 'SELECT modalidade.id as modalidade_id, modalidade.* FROM modalidade');
			 $table = '';
			
						
			   foreach( $modalidades as $modalidade ) {

			   	 $dias = '';
			     $dias2 = '';
					
						$modalidadedias =  R::getAll( 'SELECT * FROM modalidadedia where modalidade_id = '.$modalidade['modalidade_id']);
						 
						foreach ($modalidadedias as $value) {
							$dias .= $value['dias']."|";
							$dias2 .= $value['dias'].", ";
							$inicio = $value['inicio'];
							$termino = $value['termino'];
						}

					

			                $table .='<tr>
                                        <td>'.$modalidade['nome'].'</td>
                                     <!--   <td>'.substr($dias2,0,-2).'</td>
                                        <td>'.$inicio.'</td>
                                        <td>'.$termino.'</td> -->
                                        <td>'.$modalidade['valor'].'</td>
                                      <!--  <td><div class="btn  btn-circle" style="background:'.$modalidade['color'].'; color:#fff;" ><i class="fa fa-list"></i></div></td> -->
                                        <td>
                                        <a href="#" onclick="buscamodalidade('.$modalidade['modalidade_id'].','.$modalidade['modalidade_id'].',\''.substr($dias,0,-1).'\',\''.$inicio.'\',\''.$termino.'\')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletemodalidade('.$modalidade['modalidade_id'].',\''.$modalidade['nome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($modalidades) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhum plano cadastrado...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


		public function addmodalidade($post){


			try{

				if($post["id"] !=''){
					$modalidade =  R::getAssocRow( 'SELECT * FROM modalidade where id = '.$post["id"]);
				}

				if(count($modalidade) > 0){

					$modalidade = R::load( 'modalidade', $post["id"] );
					$modalidade->nome = $post['nome'];
					$modalidade->valor = $post['valor'];

					$modalidadedia = R::getAll( 'SELECT modalidadedia.id as modalidade_id FROM modalidadedia where modalidade_id = '.$post["id"]);

					foreach ($modalidadedia as $value) {
						$dia = R::load( 'modalidadedia', $value["modalidade_id"] );
						R::trash( $dia );						
					}

			
					R::store( $modalidade );

					for ($i=0; $i < count($post['dias']); $i++) { 
						$modalidadedia = R::dispense( 'modalidadedia');
						$modalidadedia->modalidade_id = $post["id"];
						$modalidadedia->dias = $post['dias'][$i];
						$modalidadedia->inicio = $post['inicio'];
						$modalidadedia->termino = $post['termino'];
						R::store( $modalidadedia );
					}

				}else{

					$modalidade = R::dispense( 'modalidade');
					$modalidade->nome = $post['nome'];
					$modalidade->valor = $post['valor'];
				
					$id = R::store( $modalidade );


					for ($i=0; $i < count($post['dias']); $i++) { 
						$modalidadedia = R::dispense( 'modalidadedia');
						$modalidadedia->modalidade_id = $id;
						$modalidadedia->dias = $post['dias'][$i];
						$modalidadedia->inicio = $post['inicio'];
						$modalidadedia->termino = $post['termino'];
						R::store( $modalidadedia );
					}




				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroModalidade.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroModalidade.php&dados=false&msg=');
			}


		}

	}



?>