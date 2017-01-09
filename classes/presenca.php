<?php

	class Model_Presenca extends RedBean_SimpleModel {



public function update ($post){

	try{
		
			$chamada_existente = R::getAll("
	    		select turma.nome as turma_nome, usuario.nome as usuario_nome, aula.conteudo,  aula.id as id_, aula.usuario_id, aula.turma_id, reposicao, presenca, professor_id from aula 
     			join usuario on usuario.id = aula.usuario_id 
     			join turma on aula.turma_id = turma.id 
     			where presenca_data = '".date('Y-m-d',strtotime($post['presencadata']))."' and aula.turma_id = ".$post['turma_id']. " and aula.inicio = '".$post['presencahora']."'");


			

	foreach ($post['faltas'] as $key ) {

		if(count($chamada_existente) > 0){



		$arr_ = explode("|", $key);

		$aula = R::load( 'aula', $arr_[1] );
		$aula->turma_id = $arr_[3];
		$aula->usuario_id =  $arr_[2];
		$aula->presenca_data = date("Y-m-d", strtotime($post['presencadata']));
		$aula->professor_id = $post['professor_id'];
		$aula->conteudo = $post['conteudo'];


		if($arr_[0] == 1 ){
			$aula->reposicao = 1;
			$aula->presenca  = 0;	
		}

		if($arr_[0] == 2 ){
			$aula->presenca   = 0;
			$aula->reposicao  = 0;	
		}

		if($arr_[0] == 3){
			$aula->presenca   = 1;
			$aula->reposicao  = 0;		
		}


		R::store( $aula );


		}else{


		$arr_ = explode("|", $key);
		
		$aula = R::dispense( 'aula');
		$aula->turma_id = $arr_[3];
		$aula->usuario_id =  $arr_[2];
		$aula->presenca_data = date("Y-m-d", strtotime($post['presencadata']));
		$aula->professor_id = $post['professor_id'];
		$aula->inicio = $post['presenca_hora'];
		$aula->conteudo = $post['conteudo'];
	
		if($arr_[0] == 1){
			$aula->reposicao = 1;	
			$aula->presenca  = 0;	
		}

		if($arr_[0] == 2){
			$aula->presenca  = 0;	
			$aula->reposicao = 0;	
		}

		if($arr_[0] == 3){
			$aula->presenca  = 1;
			$aula->reposicao = 0;		
		}


		R::store( $aula );


		}


		

	}

				echo 1;
				//header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroPresenca.php&dados=true');
			}catch(Exception $e){
				//echo $e;
				echo 0;
				//header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroPresenca.php&dados=false&msg=');
			}

	
}

public function add ($post){
			$table = '';
			

			$chamada_existente = R::getAll("
	    		select turma.nome as turma_nome, usuario.nome as usuario_nome, aula.conteudo,  aula.id as id_, aula.usuario_id, aula.turma_id, reposicao, presenca, professor_id from aula 
     			join usuario on usuario.id = aula.usuario_id 
     			join turma on aula.turma_id = turma.id 
     			where presenca_data = '".date('Y-m-d',strtotime($post['presenca_data']))."' and aula.turma_id = ".$post['turma_id']. " and aula.inicio = '".$post['presenca_hora']."'");


			if(count($chamada_existente) > 0){
				
							foreach( $chamada_existente as $presenca ) {

							$r = '';
							$p = '';
							if($presenca['reposicao'] == '1'){ $r ='checked';}
							if($presenca['presenca'] == '0' && $r =='' ){ $p2 ='checked';}
							if($presenca['presenca'] == '1' && $r =='' ){ $p ='checked';}
			

			                $table .='<tr onclick="radioupdate(this)">
                                        <td >'.$presenca['turma_nome'].'</td>
                                        <td>'.$presenca['usuario_nome'].'</td>
                                        <td style="text-align: center;"><div class="radio i-checks "><label> <input type="radio" '.$r.'  value="1|'.$presenca['id_'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['id_'].']"  required> <i></i></label></div></div>
                                        </td>
                                        <td style="text-align: center;"><div class="radio i-checks "><label> <input type="radio" '.$p2.'  value="2|'.$presenca['id_'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['id_'].']"> <i></i></label></div></div>
                                        </td>
                                        <td style="text-align: center;"><div class="radio i-checks "><label> <input type="radio" '.$p.'  value="3|'.$presenca['id_'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['id_'].']"> <i></i></label></div></div>
                                        </td>    
                                  
                                    </tr>';
                                }
								
							$table .="<tr><td colspan='5'><b>Conteúdo dado em aula:</b></td><tr>";  
							$table .="<tr><td colspan='5'><textarea placeholder='Conteúdo' style='width:100%;' class='form-control' id='conteudo' name='conteudo' >".$presenca['conteudo']."</textarea></td><tr>";  
						  
						$v = "\"".date('Y-m-d',strtotime($post['presenca_data']))."\",".$post['turma_id']."\",".$post['presenca_hora']."\"";
						
						$table .= "<tr><td colspan='5'>
									<div class='input-group btupdate'>
									 <button class='btn btn-primary pre' type='submit'><i class='fa fa-floppy-o'></i> Alterar diário</button>
									 <button class='btn btn-w-m btn-danger' onclick='deletedia(".$v.")' data-toggle='modal' data-target='#modal_' style='margin-left:10px;' type='button' ><i class='fa fa-times'></i> Excluir diário</button>
									</div></td></tr>";
					
			
			}else{

				$presencas = R::getAll("SELECT distinct
											 usuario.id AS usuario_id,
											 usuario.nome AS u,
											 turma.nome AS t,
											 turma.id AS turma_id
										FROM
											 alunodia
										JOIN usuario ON usuario.id = alunodia.usuario_id
										JOIN turma ON turma.id = alunodia.turma_id
										JOIN dia ON dia.id = alunodia.dia_id
										WHERE
											dia.turma_id = ".$post['turma_id']."
										AND dia.inicio = '".str_replace(" ", "", $post['presenca_hora'])."' 
										AND dia.dia = DAYNAME('".date('Y-m-d',strtotime($post['presenca_data']))."') ORDER BY usuario.nome");




			   foreach( $presencas as $presenca ) {
			                $table .='<tr> 
                                        <td>'.$presenca['t'].'</td>
                                        <td>'.$presenca['u'].'</td>
                                        <td><div class="radio i-checks"><label> <input type="radio" value="1|'.$presenca['usuario_id'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['usuario_id'].']" required> <i></i></label></div></div>
                                        </td>
                                        <td><div class="radio i-checks"><label> <input type="radio" value="2|'.$presenca['usuario_id'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['usuario_id'].']"> <i></i></label></div></div>
                                        </td>
                                        <td><div class="radio i-checks"><label> <input type="radio" value="3|'.$presenca['usuario_id'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['usuario_id'].']"> <i></i></label></div></div>
                                        </td>                                    
                                    </tr>';
                                }
                if(count($presencas) ==0){
                				     $table .='<tr>
                                        <td colspan="5" style="text-align:center;">Nenhum aluno registrado para este horário e data</td>
                                    </tr>';
                }               
               $table .="<tr><td colspan='5'><textarea placeholder='Conteúdo'  style='width:100%;' class='form-control' id='conteudo' name='conteudo' ></textarea></td><tr>";  
			
													
									$table .= "<tr><td colspan='5'>
									<div class='input-group btupdate2'>
									 <button class='btn btn-primary pre' type='submit'><i class='fa fa-floppy-o'></i> Salvar diário</button>
									</div></td></tr>";
				
				
			}
     		 echo $table;


		
		}
	



		public function presenca ($post){

 
	    		$presencas = R::getAll("
	    		select turma.nome as turma_nome, usuario.nome as usuario_nome, aula.conteudo,  aula.id as id_, aula.usuario_id, aula.turma_id, reposicao, presenca, professor_id from aula 
     			join usuario on usuario.id = aula.usuario_id 
     			join turma on aula.turma_id = turma.id 
     			where presenca_data = '".date('Y-m-d',strtotime($post['presenca_data']))."' and aula.turma_id = ".$post['turma_id']. " and aula.inicio = '".$post['inicio']."'");

			 $table = '';

			 	echo'<input type="hidden" id="professor_id2" value="'.$presencas[0]['professor_id'].'" >';

			   foreach( $presencas as $presenca ) {


							$r = '';

							if($presenca['reposicao'] == 1){ $r='checked';}
							if($presenca['presenca'] == 1 && $presenca['reposicao'] == 0){ $p='checked';}
							if($presenca['presenca'] == 0 && $presenca['reposicao'] == 0){ $p2='checked';}
			

			                $table .='<tr onclick="radioupdate(this)">
                                        <td style="text-align: center;">'.$presenca['turma_nome'].'</td>
                                        <td>'.$presenca['usuario_nome'].'</td>
                                        <td><div class="radio i-checks "><label> <input type="radio" '.$r.'  value="1|'.$presenca['id_'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['id_'].']"  required> <i></i></label></div></div>
                                        </td>
                                        <td><div class="radio i-checks "><label> <input type="radio" '.$p2.'  value="2|'.$presenca['id_'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['id_'].']"> <i></i></label></div></div>
                                        </td>
                                        <td><div class="radio i-checks "><label> <input type="radio" '.$p.'  value="3|'.$presenca['id_'].'|'.$presenca['usuario_id'].'|'.$presenca['turma_id'].'" name="faltas['.$presenca['id_'].']"> <i></i></label></div></div>
                                        </td>    
                                  
                                    </tr>';
                                }
                if(count($presencas) == 0){
                				     $table .='<tr>
                                       <td colspan="5" style="text-align:center;">Nenhuma diário encotrado para essa data...</td>
                                    </tr>';
                }               

               $table .="<tr><td  colspan='5' ><textarea placeholder='Conteúdo dado em aula' class='form-control' id='conteudo' name='conteudo' >".$presencas[0]['conteudo']."</textarea></td><tr>";  

			 echo $table;


		
		}	


	
		public function deletedia($post){
			 R::exec("delete From aula where presenca_data = '".$post['data']."' and turma_id = ".$post['turma']." and inicio = '".$post['hora']."'");	
		}



	}



?>