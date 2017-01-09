<?php

	class Model_Calendario extends RedBean_SimpleModel {

		public function GetDays($sStartDate, $sEndDate){
				  // Firstly, format the provided dates.
				  // This function works best with YYYY-MM-DD
				  // but other date formats will work thanks
				  // to strtotime().
				  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));
				  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));

				  // Start the variable off with the start date
				  $aDays[] = $sStartDate;

				  // Set a 'temp' variable, sCurrentDate, with
				  // the start date - before beginning the loop
				  $sCurrentDate = $sStartDate;

				  // While the current date is less than the end date
				  while($sCurrentDate < $sEndDate){
				    // Add a day to the current date
				    $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));

				    // Add this new day to the aDays array
				    $aDays[] = $sCurrentDate;
				  }

				  // Once the loop has finished, return the
				  // array of days.
				  return $aDays;
			}



		public function busca($post){

			$perfils =  R::getAll( 'SELECT usuario.id as usuario_id, usuario.nome FROM usuario join perfilusuario on perfilusuario.usuario_id = usuario.id where perfilusuario.perfil_id = 3');
			
			$option = "";

			foreach ($perfils as $perfil) {
				$option .= '<option value="'.$perfil['usuario_id'].'">'.$perfil['nome'].'</option>';
			}

			echo $option;

		}


		public function listadatas($post){

			if($post['tipo'] == 2){
				$q =	'WHERE alunodia.usuario_id ='.base64_decode($post['usuario_id']);
			}else{
				$q='';
			}

			$datas =  R::getAll('SELECT
								    turma.inicio AS tinicio,
									turma.fim AS tfim,
									turma.nome AS turma,
									turma.color AS color,
									dia.dia AS dias,
									dia.inicio AS minicio,
									dia.termino AS mtermino,
									turma.id AS turma_id
								FROM
									alunodia
								JOIN turma ON turma.id = alunodia.turma_id
								JOIN usuario ON usuario.id = alunodia.usuario_id
								join dia on dia.id = alunodia.dia_id '.$q.' GROUP BY minicio');

			$array_datas[] = '';

			foreach ($datas as $data) {

				$alunos = "";


				 $turmas =  R::getAll(" SELECT 
				 						usuario.nome as nome
										FROM alunodia
										JOIN turma ON turma.id = alunodia.turma_id
										JOIN dia ON dia.id = alunodia.dia_id
										JOIN usuario ON usuario.id = alunodia.usuario_id
										WHERE turma.id = ".$data['turma_id']." AND dia.inicio = '".$data['minicio']."' AND dia.dia = '".$data['dias']."'");

				 foreach ($turmas as $aluno) {

				 	$alunos .= $aluno['nome'].", ";

				 }

				$array = $this->GetDays($data['tinicio'], $data['tfim']);

				

				for ($i=0; $i < count($array); $i++) { 

					if(str_replace(' ','',date('l',strtotime( $array[$i]))) == str_replace(' ','',$data['dias'])){
						$array_datas[] = $array[$i]."T".$data['minicio']."|".$array[$i]."T".$data['mtermino']."|".$data['turma']." - ".substr($data['minicio'],0,5)." às ".substr($data['mtermino'],0,5)."|".$data['color']."|".substr($alunos, 0, -2);
					} 
				}

				
			}

		
			echo json_encode($array_datas);

		}



		public function listadatasevento($post){

	

			$datas =  R::getAll( 'SELECT * FROM evento');

			$array_datas[] = '';

			foreach ($datas as $data) { 
						$array_datas[] = $data['dataevento']."|".$data['titulo']."|".$data['descricao']."|".$data['color'];			 
				}

		
			echo json_encode($array_datas);

		}





	}



?>