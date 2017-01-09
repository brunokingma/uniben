<?php

	class Model_Evento extends RedBean_SimpleModel {

	


		public function listaevento($post){

			 $evento =  R::getAll( 'select evento.id as evento_id, evento.*, DATE_FORMAT(dataevento,\'%d/%m/%Y\') as data from evento where id = '.$post['id']);
			 $json = json_encode($evento);
			 echo $json;

		}	



			public function deleteevento($post){
 			  $evento = R::load( 'evento', $post['id'] );
 			  R::trash( $evento ); 
		}



	public function listaeventotabela($post){

			 $eventos =  R::getAll( 'select evento.id as id, evento.* from evento');

			   foreach( $eventos as $evento ) {

			                $table .='<tr>
                                        <td>'.$evento['titulo'].'</td>
                                        <td>'.date("d/m/Y", strtotime($evento['dataevento'])).'</td>
                                        <td><button class="btn  btn-circle" style="background:'.$evento['color'].'; color:#fff;" type="button"><i class="fa fa-list"></i></button></td>
                                        <td>
                                        <a href="#" onclick="buscaevento('.$evento['id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="delete_('.$evento['id'].',\''.$evento['titulo'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
			                if(count($eventos) == 0){
			                				     $table .='<tr style="text-align:center;">
			                                        <td colspan="3">Nenhum evento cadastrado...</td>
			                                    </tr>';
			                }               

						 	echo $table;

		}	




		public function addevento($post){

			

			try{

				

				if($post['update'] == "true"){

					$evento = R::load( 'evento', $post["id"] );
					$evento->titulo = $post['titulo'];
					$evento->color = $post['color'];
					$evento->descricao = $post['descricao'];
					
					if($post['data'] !=''){
						$evento->dataevento = date("Y-m-d", strtotime($post['data']));;
					}
					
					R::store( $evento );
		

				}else{

					$evento = R::dispense( 'evento');
					$evento->titulo = $post['titulo'];
					$evento->color = $post['color'];
					$evento->descricao = $post['descricao'];
					$evento->dataevento = date("Y-m-d", strtotime($post['data']));;
					R::store( $evento );



				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroEvento.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroEvento.php&dados=false&msg=');
			}

			

		}


	



	}



?>