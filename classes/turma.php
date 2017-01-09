<?php

	class Model_Turma extends RedBean_SimpleModel {

	


		public function listaturma($post){

			 $turma =  R::getAll( 'SELECT turma.id as id, DATE_FORMAT(turma.inicio, \'%d/%m/%Y\') as inicio, DATE_FORMAT(turma.fim, \'%d/%m/%Y\') as fim,  turma.id as turma_id, turma.nome, turma.color FROM turma where id = '.$post['id']);
			 $json = json_encode($turma);
			 echo $json;

		}	

		
			public function listadia($post){

			 $turma =  R::getAll( 'SELECT alunodia.id, nome, usuario_id, alunodia.turma_id, dia.id as horario 
			 from alunodia 
			 join usuario on usuario.id = alunodia.usuario_id 
			 join dia on dia.id = alunodia.dia_id 
			 where alunodia.id = '.$post['id']);
			 $json = json_encode($turma);
			 echo $json;

		}	


		public function listaturmaaluno($post){

			 $turma =  R::getAll( 'SELECT usuarioturma.id as id, usuarioturma.usuario_id, usuarioturma.turma_id, usuario.nome  FROM usuarioturma join usuario on usuario.id = usuarioturma.usuario_id where usuarioturma.id = '.$post['id']);
			 $json = json_encode($turma);
			 echo $json;

		}	

		public function listahorariocombo($post){

			$turmas =  R::getAll( 'SELECT DISTINCT(inicio) as inicio FROM dia WHERE turma_id = '.$post['turma_id'].' order by inicio');	

			$option = "";

			foreach ($turmas as $turma) {
				$option .= '<option value="'.$turma['inicio'].'">'.$turma['inicio'].'</option>';
			}

			echo $option;
		}

		public function listahorarioaluno($post){

			$turmas =  R::getAll( 'SELECT * FROM dia WHERE turma_id ='.$post['turma_id']);	

			$option = "";

			foreach ($turmas as $turma) {
				$option .= '<option value="'.$turma['id'].'">'.$turma['dia'].' - '.$turma['inicio'].'</option>';
			}

			echo $option;
		}


		public function listaturmacombo($post){

			$turmas =  R::getAll( 'SELECT * FROM turma');	

			$option = "";

			foreach ($turmas as $turma) {
				$option .= '<option value="'.$turma['id'].'">'.$turma['nome'].'</option>';
			}

			echo $option;
		}	

		public function deletealunodia($post){
 			  $turma = R::load( 'alunodia', $post['id'] );
 			  R::trash( $turma ); 
		}
			public function deleteturma($post){
 			  $turma = R::load( 'turma', $post['id'] );
 			  R::trash( $turma ); 
		}

			public function deleteturmaaluno($post){
 			  $turma = R::load( 'usuarioturma', $post['id'] );
 			  R::trash( $turma ); 
		}


		public function listaturmatabela($post){

			 $turmas =  R::getAll( 'SELECT turma.id as turma_id, turma.* FROM turma');
			 $table = '';
			   foreach( $turmas as $turma ) {
			                $table .='<tr>
                                        <td>'.$turma["nome"].'</td>
                                        <td>'.date("d/m/Y", strtotime($turma["inicio"])).'</td>
                                        <td>'.date("d/m/Y", strtotime($turma["fim"])).'</td>
                                        <td><div class="btn  btn-circle" style="background:'.$turma["color"].'; color:#fff;" ><i class="fa fa-list"></i></div></td>
                                        <td>
                                        <a href="#" onclick="buscaturma('.$turma["turma_id"].','.$turma["turma_id"].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deleteturma('.$turma["turma_id"].',\''.$turma["nome"].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhuma turma cadastrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	

		public function listaalunosturma($post){

			 $query = 'SELECT usuario.id as usuario_id, usuario.nome as aluno, modalidade.nome as pacote from usuario
			 JOIN mensalidade on mensalidade.usuario_id = usuario.id
			 JOIN turma on turma.id = '.$post['turma_id'].' 
			 JOIN modalidade on modalidade.id = '.$post['modalidade_id'].' 
			 WHERE 
			 mensalidade.pagamento_data IS NULL
			 AND mensalidade.vencimento >= NOW()
			 GROUP BY usuario_id';
			 $turmas =  R::getAll( $query );
			 $table = '';
			   foreach( $turmas as $turma ) {
			                $table .='<tr>
                                        <td>'.$turma['pacote'].'</td>
                                        <td>'.$turma['aluno'].'</td>                                        
                                    </tr>';
                                }
                if(count($turmas) == 0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhum aluno encontrado na turma cadastrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


		public function listaalunodia($post){

			 $query  = "SELECT usuario.nome, DATE_FORMAT(aula.presenca_data, '%d/%m/%Y') as data 
			 FROM aula join usuario on usuario.id aula.usuario_id WHERE presenca_data = ".$post['data']." AND inicio = ".$post['hora'];
			 $alunos =  R::getAll( $query );
			 $table  = '';
			   
			   foreach( $alunos as $aluno ) {
					   $p = "";
					 
					 if($aluno['presenca'] == "1"){
							$p = "Presente";
					   }else{ 
							$p = "Ausente";
					   }
				   
			                $table .='<tr>
                                        <td>'.$aluno['nome'].'</td>
                                        <td>'.$aluno['data'].'</td>                                        
                                        <td>'.$p.'</td>                                        
                                    </tr>';
                                }
                if(count($turmas) == 0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhum aluno encontrado neste horário...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


		



			public function listturmaaluno($post){

			 $turmas =  R::getAll( 'SELECT usuarioturma.id as id_, usuario.id as usuario_id, usuario.nome as usuario_nome, turma.id as turma_id, turma.nome as turma_nome,turma.color FROM usuarioturma join usuario on usuario.id = usuarioturma.usuario_id join turma on turma.id = usuarioturma.turma_id');
			 $table = '';
			   
			   foreach( $turmas as $turma ) {
			                $table .='<tr>
                                        <td>'.$turma['usuario_nome'].'</td>
                                        <td>'.$turma['turma_nome'].'</td>
                                        <td>
                                        <a href="#" onclick="buscaturmaaluno('.$turma['id_'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deleteturmaaluno('.$turma['id_'].',\''.$turma['usuario_nome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }

                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhuma associação cadastrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	
		
		public function listalunodia($post){

			 $turmas =  R::getAll( 'SELECT alunodia.id as id_, nome, dia, inicio FROM alunodia
									JOIN dia on alunodia.dia_id = dia.id
									JOIN usuario on usuario.id = alunodia.usuario_id');
			 $table = '';
			   
			   foreach( $turmas as $turma ) {
			                $table .='<tr>
                                        <td>'.$turma['nome'].'</td>
                                        <td>'.$turma['dia'].'</td>
                                        <td>'.$turma['inicio'].'</td>
                                        <td>
                                        <a href="#" onclick="buscaalunodia('.$turma['id_'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletealunodia('.$turma['id_'].',\''.$turma['nome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }

                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhuma associação cadastrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


		public function addalunodia($post){
			
			
			try{

				if($post["id"] !=''){
					$turma =  R::getAssocRow( 'SELECT * FROM alunodia where id = '.$post["id"]);
				}

				if(count($turma) > 0){

					$turma = R::load( 'alunodia', $post["id"] );
					$turma->usuario_id = $post['usuario_id'];
					$turma->dia_id = $post['horario_id'];
					$turma->turma_id = $post['turma_id'];
					R::store( $turma );

				}else{

					$turma = R::dispense( 'alunodia');
					$turma->usuario_id = $post['usuario_id'];
					$turma->dia_id = $post['horario_id'];
					$turma->turma_id = $post['turma_id'];
					R::store( $turma );

				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroTurmaAluno.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroTurmaAluno.php&dados=false&msg=');
			}

			

		}
		

		public function addturma($post){

			try{

				if($post["id"] !=''){
					$turma =  R::getAssocRow( 'SELECT * FROM turma where id = '.$post["id"]);
				}

				if(count($turma) > 0){

					$turma = R::load( 'turma', $post["id"] );
					$turma->nome = $post['nome'];
					$turma->color = $post['color'];
					//$turma->modalidade_id = $post['modalidade'];

					if($post['inicio'] != ""){
						$turma->inicio = date("Y-m-d", strtotime($post['inicio']));
					}

					if($post['fim'] != ""){
						$turma->fim = date("Y-m-d", strtotime($post['fim']));
					}					

					R::store( $turma );

				}else{

					$turma = R::dispense( 'turma');
					$turma->nome = $post['nome'];
					$turma->color = $post['color'];
					//$turma->modalidade_id = $post['modalidade'];
					$turma->inicio = date("Y-m-d", strtotime($post['inicio']));
					$turma->fim = date("Y-m-d", strtotime($post['fim']));
				
					R::store( $turma );

				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroTurma.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroTurma.php&dados=false&msg=');
			}

			

		}

		public function addturmaaluno($post){

			
		try{

				if($post["id"] !=''){
					$turma =  R::getAssocRow( 'SELECT * FROM usuarioturma where id = '.$post["id"]);
				}

				if(count($turma) > 0){

					$turma = R::load( 'usuarioturma', $post["id"] );
					$turma->usuario_id = $post['usuario_id'];
					$turma->modalidade_id = $post['modalidade_id'];
					R::store( $turma );

				}else{

					$turma = R::dispense( 'usuarioturma');
					$turma->usuario_id = $post['usuario_id'];
					$turma->modalidade_id = $post['modalidade_id'];				
					R::store( $turma );

				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroTurmaAluno.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroTurmaAluno.php&dados=false&msg=');
			}



			

		}

	



	}



?>