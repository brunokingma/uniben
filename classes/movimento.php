<?php

	class Model_Movimento extends RedBean_SimpleModel {


		public function listamovimentoview($post){

			 $movimentos =  R::getAll( 'SELECT
											SUBSTRING(movimento.foto, 6) AS foto,
											movimento.descricao,
											movimento.nome AS movimento_nome,
											movimento.id AS movimento_id,
											nivel.nome AS nivelnome
										FROM
											movimento
										JOIN nivel ON nivel.id = movimento.nivel_id
										JOIN nivelusuario ON nivel.id = nivelusuario.nivel_id										
										WHERE
											nivelusuario.usuario_id ='.base64_decode($post['id']));

			 foreach ($movimentos as $movimento) {

						$div .='

						<div class="col-lg-3" style="height:650px;">
			                <div class="ibox float-e-margins">
			                    <div class="ibox-title">
			                            <h5>'.$movimento['nivelnome'].' nível</h5>
			                        </div>
			                        <div>
			                            <div class="ibox-content no-padding border-left-right" style="height:372px; overflow:hidden;">
			                                <img alt="image" class="img-responsive" src="'.$movimento['foto'].'">
			                            </div>
			                            <div class="ibox-content profile-content">
			                                <h4><strong>'.$movimento['movimento_nome'].'</strong></h4>
			                                <h5>
			                                   Descrição:
			                                </h5>
			                                <p>
			                                   '.$movimento['descricao'].'
			                                </p>
			                            </div>
			                    </div>
			                </div>
			            </div>
			              ';
			 
			 }


			echo $div ;

		}	
	


		public function listamovimento($post){

			 $usuario =  R::getAll( 'SELECT *, movimento.nome as movimento_nome, movimento.id as movimento_id, movimento.* FROM movimento join nivel on nivel.id = movimento.nivel_id where movimento.id = '.$post['id']);
			 $json = json_encode($usuario);
			 echo $json;

		}	

			public function deletemovimento($post){
 			  $movimento = R::load( 'movimento', $post['id'] );
 			  R::trash( $movimento ); 
		}


	public function listamovimentotabela($post){

			 $movimentos =  R::getAll( 'SELECT movimento.id as movimento_id, movimento.nome as nome_movimento, nivel.nome as nome_nivel, SUBSTRING(movimento.foto, 12) as foto FROM movimento join nivel on nivel.id = movimento.nivel_id');
			 $table = '';
			 $media = '';

			   foreach( $movimentos as $movimento ) {

			   	if($movimento['foto'] != ""){
			   		$media = '<img src="fotos/thumbs/'.$movimento['foto'].'" width="50%" />';
			   	}else{
			   		$media = '';
			   	}


			                $table .='<tr>
                                        <td>'.$movimento['nome_movimento'].'</td>
                                        <td>'.$movimento['nome_nivel'].'</td>
                                        <td>'.$media.'</td>
                                        <td>
                                        <a href="#" onclick="buscamovimento('.$movimento['movimento_id'].','.$movimento['nivel_id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletemovimento('.$movimento['movimento_id'].',\''.$movimento['nome_movimento'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($movimentos) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhum movimento cadastrado...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


		public function addmovimento($post){

			require_once('ImageManipulator.php');


			try{

				if($post["id"] !=''){
					$movimento =  R::getAssocRow( 'SELECT id as movimento_id, nivel_id as nivel FROM movimento where movimento.id = '.$post["id"]);
				}

				if(count($movimento) > 0){

					$movimento = R::load( 'movimento', $post["id"] );

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


			 		 list($width, $height) = getimagesize($file);

					if ($width > $height) {
					   

					$manipulator->resample(610, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);

					} else {


					$manipulator->resample(0, 610);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(0, 200);
			        $manipulator->save($destinationPath2 . $fileNameThumb);
					   
					}


			        if(file_exists ($destinationPath.$post['foto_i'])){
			        	$i= $destinationPath.$post['foto_i'];
			        	$i2=$destinationPath2.$post['foto_i'];
				        unlink($i);	
						unlink($i2);
			        }


					$movimento->foto = $destinationPath . $fileNameThumb;

					} 

					
					$nivel = R::load( 'nivel', $post['nivel'] );
					$movimento->nivel = $nivel;
					$movimento->descricao = $post['descricao'];
					$movimento->nome = $post['nome'];
					R::store( $movimento );

				}else{
					$nivel = R::load( 'nivel', $post['nivel'] );
					$movimento = R::dispense( 'movimento' );


						if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


					 list($width, $height) = getimagesize($file);

					if ($width > $height) {
					   

					$manipulator->resample(610, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);

					} else {


					$manipulator->resample(0, 610);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(0, 200);
			        $manipulator->save($destinationPath2 . $fileNameThumb);
					   
					}

			        $movimento->foto = $destinationPath . $fileNameThumb;

					} 	
					$movimento->descricao = $post['descricao'];
					$movimento->nome = $post['nome'];
					$movimento->nivel = $nivel;
					R::store( $movimento );
				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroMovimento.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroMovimento.php&dados=false&msg=');
			}

			

		}

	



	}



?>