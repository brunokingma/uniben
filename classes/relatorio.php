<?php

	class Model_Relatorio extends RedBean_SimpleModel {


		public function relatoriosTurmaAlunos($post){

				 $turmas =  R::getAll(" SELECT 
				 						usuario.nome as nome,
				 						turma.nome as turma,
				 						dia.inicio as hora,
				 						dia.dia
										FROM alunodia
										JOIN turma ON turma.id = alunodia.turma_id
										JOIN dia ON dia.id = alunodia.dia_id
										JOIN usuario ON usuario.id = alunodia.usuario_id
										WHERE turma.id = ".$post['turma_id']." AND dia.inicio = '".$post['presenca_hora']."' AND dia.dia = '".$post['dia']."'");
									
									$table = '';
									 
			   foreach( $turmas as $turma ) {
			                $table .='<tr>
                                        <td>'.$turma["nome"].'</td>
                                    </tr>';
                                }
                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="3">Nenhum resgistro encontrado...</td>
                                    </tr>';
                }               

			 echo $table;
												

		}



	public function relatoriosChamadaDia($post){



			 $turmas =  R::getAll("SELECT distinct aula.*, usuario.nome
									FROM turma
									JOIN dia ON dia.turma_id = turma.id
									JOIN aula ON aula.turma_id = turma.id
									join usuario on usuario.id = aula.usuario_id
									WHERE dia.dia = DAYNAME('".date('Y-m-d',strtotime($post['data']))."')
									AND aula.presenca_data = '".date('Y-m-d',strtotime($post['data']))."'
									ORDER BY  aula.inicio");
									 $table = '';
									 
			   foreach( $turmas as $turma ) {

			   				

			                $table .='<tr>
                                        <td>'.$turma["nome"].'</td>
                                        <td>'.date("d/m/Y", strtotime($turma["presenca_data"])).'</td>
                                        <td>'.$s.'</td>
                                        <td>'.$turma["reposicao"].'</td>
                                    </tr>';

							$turma_atual = $turma["inicio"];


                                }


                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="3">Nenhuma mensalidade encontrada...</td>
                                    </tr>';
                }               

			 echo $table;
												
		}
	

		public function relatoriosChamada($post){
			 $turmas =  R::getAll("SELECT
										nome,
										  case aula.presenca
											when '1' then 'Presente'
											when '0' then 'Ausente'
										end as presenca,
										  case aula.reposicao
											when '1' then 'Sim'
											when '0' then 'Não'
										end as reposicao,
									  presenca_data
									FROM
										aula
									JOIN usuario ON usuario.id = aula.usuario_id
									WHERE
										aula.turma_id = ".$post['turma']."
									AND aula.inicio = '".$post['hora']."'
									AND aula.presenca_data = '".date('Y-m-d',strtotime($post['data']))."'");
									 $table = '';
									 
			   foreach( $turmas as $turma ) {
						$s =  '';
			   				if($turma["presenca"] !="Ausente"){
			   				$s =  '<button type="button" class="btn btn-outline btn-primary">'.$turma["presenca"].'</button>';
			   			}else{
			   			$s =   '<button type="button" class="btn btn-outline btn-danger">'.$turma["presenca"].'</button>';
			   		}

			                $table .='<tr>
                                        <td>'.$turma["nome"].'</td>
                                        <td>'.date("d/m/Y", strtotime($turma["presenca_data"])).'</td>
                                        <td>'.$s.'</td>
                                        <td>'.$turma["reposicao"].'</td>
                                    </tr>';
                                }
                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="3">Nenhuma mensalidade encontrada...</td>
                                    </tr>';
                }               

			 echo $table;
												
		}
		
		
		public function mensalidade($post){
			
			 $filtro = "";

			 if($post['vencimento'] != ""){
				 $filtro .= " month(vencimento) = ".substr($post['vencimento'],0,2)." and year(vencimento) = ".substr($post['vencimento'],3,4);
			 }
			 
			 if($post['pagamento'] == "isnotnull"){
				 $filtro .= " and pagamento_data is not null";
			 }
			 
			if($post['pagamento'] == "isnull"){
				 $filtro .= " and pagamento_data is null";
			 }

			 $turmas =  R::getAll('select * from mensalidade join usuario on usuario.id = mensalidade.usuario_id where '.$filtro);
			 $table = '';
			   foreach( $turmas as $turma ) {
			                $table .='<tr>
                                        <td>'.$turma["nome"].'</td>
                                        <td>'.date("d/m/Y", strtotime($turma["vencimento"])).'</td>
                                        <td>'.$turma["valor"].'</td>
                                    </tr>';
                                }
                if(count($turmas) ==0){
                				     $table .='<tr>
                                        <td colspan="3">Nenhuma mensalidade encontrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


	}



?>