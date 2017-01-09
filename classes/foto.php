<?php

	class Model_Foto extends RedBean_SimpleModel {

	

		public function listaperfilcombo($post){

			$perfils =  R::getAll( 'SELECT * FROM perfil');
			
			$option = "";

			foreach ($perfils as $perfil) {
				$option .= '<option value="'.$perfil['id'].'">'.$perfil['nome'].'</option>';
			}

			echo $option;

		}	

		public function listafoto($post){

			 $foto =  R::getAll( 'select foto.descricao, fotonivel.id as fotonivel_id, fotonivel.nivel_id as nivel_id,  fotonivel.foto_id as foto_id, foto.titulo, SUBSTRING(foto, 12) as foto  from foto join fotonivel on foto.id = fotonivel.foto_id where foto.id = '.$post['id']);
			 $json = json_encode($foto);
			 echo $json;

		}	



			public function deletefoto($post){
 			  $foto = R::load( 'foto', $post['id'] );
 			  R::trash( $foto ); 

 			  $fotonivel = R::load( 'fotonivel', $post['id2'] );
 			  R::trash( $fotonivel ); 
		}



	public function listafototabela($post){

			 $fotos =  R::getAll( 'select fotonivel.id as fotonivel_id, fotonivel.nivel_id as nivel_id,  fotonivel.foto_id as foto_id, foto.titulo, SUBSTRING(foto, 12) as foto  from foto join fotonivel on foto.id = fotonivel.foto_id');
			 $table = '';

			

			   foreach( $fotos as $foto ) {

			   	 

			                $table .='<tr>
                                        <td>'.$foto['titulo'].'</td>
                                        <td><img src="fotos/thumbs/'.$foto['foto'].'" width="50%" /></td>
                                        <td>
                                        <a href="#" onclick="buscafoto('.$foto['foto_id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletefoto('.$foto['foto_id'].','.$foto['fotonivel_id'].',\''.$foto['titulo'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($fotos) ==0){
                				     $table .='<tr style="text-align:center;">
                                        <td colspan="3">Nenhum foto cadastrada...</td>
                                    </tr>';
                }               

			 echo $table;

		}	




		public function addfoto($post){

				require_once('ImageManipulator.php');


			try{

				

				if($post['update'] == "true"){

					$foto = R::load( 'foto', $post["id"] );

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);

			        list($width, $height) = getimagesize($file);

					if ($width > $height) {
					   

					$manipulator->resample(590, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);

					} else {


					$manipulator->resample(0, 590);
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


					$foto->foto = $destinationPath . $fileNameThumb;

					} 

					
					$foto->titulo = $post['titulo'];
					$foto->descricao = $post['descricao'];
					R::store( $foto );

					$fotonivel = R::load( 'fotonivel', $post["fotonivel_id"] );
					$fotonivel->nivel_id = $post['nivel'];

					R::store( $fotonivel );



		

				}else{

					$foto = R::dispense( 'foto');

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


			 		list($width, $height) = getimagesize($file);

					if ($width > $height) {
					   

					$manipulator->resample(590, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);

					} else {


					$manipulator->resample(0, 590);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(0, 200);
			        $manipulator->save($destinationPath2 . $fileNameThumb);
					   
					}



			        $foto->foto = $destinationPath . $fileNameThumb;

					} 	

					
					$foto->titulo = $post['titulo'];
					$foto->descricao = $post['descricao'];					
					$id = R::store( $foto );

					$fotonivel = R::dispense( 'fotonivel');
					$fotonivel->nivel_id = $post['nivel'];
					$fotonivel->foto_id = $id;

					R::store( $fotonivel );



				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastraFotos.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastraFotos.php&dados=false&msg=');
			}

			

		}


	



	}



?>