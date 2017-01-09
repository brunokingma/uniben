<?php

	class Model_Dia extends RedBean_SimpleModel {

	


		public function listaDia($post){

			 $dia =  R::getAll( 'SELECT dia.id as dia_id, dia.* FROM dia where id = '.$post['id']);
			 $json = json_encode($dia);
			 echo $json;

		}	


	
		

		public function deletedia($post){
 			  $dia = R::load( 'dia', $post['id'] );
 			  R::trash( $dia ); 
		}


	public function listadiatabela($post){

			 $dias =  R::getAll( 'SELECT dia.id as dia_id, dia.dia, dia.inicio, dia.termino, turma.nome as turma, dia.turma_id FROM dia join turma on dia.turma_id = turma.id');
			 $table = '';
			$diasemana = "";
						
			   foreach( $dias as $dia ) {
				   
				   
									switch($dia['dia']) {
										case"Monday": $diasemana = "Segunda Feira";       break;
										case"Tuesday": $diasemana = "Terça Feira"; break;
										case"Wednesday": $diasemana = "Quarta Feira";   break;
										case"Thursday": $diasemana = "Quinta Feira";  break;
										case"Friday": $diasemana = "Sexta Ffeira";  break;
										case"Saturday": $diasemana = "Sabado";   break;
										case"Sunday": $diasemana = "Domingo";        break;
									}
				   
				

			                $table .='<tr>
                                        <td>'.$diasemana.'</td>
                                        <td>'.$dia['inicio'].'</td>
                                        <td>'.$dia['termino'].'</td> 
                                        <td>'.$dia['turma'].'</td>
                                        <td>
                                        <a href="#" onclick="buscadia(\''.$dia['dia'].'\','.$dia['turma_id'].',\''.$dia['inicio'].'\',\''.$dia['termino'].'\')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletedia('.$dia['dia_id'].',\''.$diasemana.'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($dias) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhuma aula cadastrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


		public function adddia($post){


			try{

				if($post["id"] !=''){
					$dia =  R::getAssocRow( 'SELECT * FROM dia where id = '.$post["id"]);
				}

				if(count($dia) > 0){

					$dia = R::load( 'dia', $post["id"] );
					$dia->turma_id = $post['turma_id'];
					$dia->dia = $post['dia'];
					$dia->inicio = $post['inicio'];
					$dia->termino = $post['termino'];
					R::store( $dia );

				}else{
					    $dia = R::dispense( 'dia');
						$dia->turma_id = $post['turma_id'];
						$dia->dia = $post['dia'];
						$dia->inicio = $post['inicio'];
						$dia->termino = $post['termino'];
						R::store( $dia );
				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroDia.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroDia.php&dados=false&msg=');
			}


		}

	}



?>