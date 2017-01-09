<?php

	class Model_Comunicado extends RedBean_SimpleModel {

	


	public function novidades($post){

		if($post['id'] !=""){
			$q = ' where id = '.$post['id'];
		}

		$media = "";

		 $comunicados =  R::getAll( 'select SUBSTRING(imagem,6) as imagem ,video,  autor,  comunicado.id as comunicado_id, titulo, descricao,  DATE_FORMAT(datacomunicado,\'%d/%m/%Y\') as data from comunicado '.$q.'  ORDER BY datacomunicado DESC limit 1');
			 
			 foreach ($comunicados as $comunicado ) {


			 	if($comunicado['imagem'] != ""){
			   		$media = '<img src="'.$comunicado['imagem'].'" alt="image" class="img-responsive" />';
			   	}

			   	if($comunicado['video'] != ""){
			   		$media = str_replace('width="560"','width="610"',$comunicado['video']);
			   		$media = str_replace('height="315"','height="393"',$comunicado['video']);
			   	}


              $div='<div>
                            <div class="ibox-content no-padding border-left-right" id="jv">
                                <figure>'.$media.'</figure>
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong>'.$comunicado['autor'].'</strong></h4>
                                <p><i class="fa fa-calendar"></i> '.$comunicado['data'].'</p>
                                <h5>
                                    '.$comunicado['titulo'].'
                                </h5>
                                <p>
                                    '.$comunicado['descricao'].'
                                </p>
                            </div>
                    </div>';


			 }
              echo $div.' <!-- video --><script src="js/plugins/video/responsible-video.js"></script>
              <script>
              var v = $(\'iframe[src*="youtube.com"]\').attr(\'data-aspectRatio\', this.height / this.width).removeAttr(\'height\').removeAttr(\'width\');
              v.ajaxComplete(v.width($("#jv").width()).height($("#jv").height() * v.attr(\'data-aspectRatio\')));              
             </script> ';

	}



	public function ultimos($post){

			$media = "";

			 $comunicados =  R::getAll( 'select  autor,  comunicado.id as comunicado_id, titulo, descricao,  DATE_FORMAT(datacomunicado,\'%d/%m/%Y\') as data from comunicado ORDER BY datacomunicado DESC limit 1,9');
				 
			  foreach( $comunicados as $comunicado ) {


			  			$div .='                <div class="feed-element">
			                                        <div>
			                                            <small class="pull-right text-navy">'.$comunicado['data'].'</small>
			                                            <strong>'.$comunicado['autor'].'</strong>
			                                            <div>'.substr($comunicado['descricao'],0,100).'</div>
			                                            <a href="javascript:void(0)" style="text-decoration:none;" onclick="buscaComu('.$comunicado['comunicado_id'].')"> 
			                                            <small class="text-muted">Leia mais</small>
			                                            </a>
			                                        </div>
			                                    </div>';

				}
			echo $div;
		}


		public function listacomunicado($post){

			 $comunicado =  R::getAll( 'select comunicado.id as comunicado_id, comunicado.*, DATE_FORMAT(datacomunicado,\'%d/%m/%Y\') as data from comunicado where id = '.$post['id']);
			 $json = json_encode($comunicado);
			 echo $json;

		}	



			public function deletecomunicado($post){
 			  $comunicado = R::load( 'comunicado', $post['id'] );
 			  R::trash( $comunicado ); 
		}



	public function listacomunicadotabela($post){

			 $comunicados =  R::getAll( 'select comunicado.id as id, comunicado.*, SUBSTRING(imagem, 12) as imagem from comunicado');
			 $table = '';
			 $media = '';
			

			   foreach( $comunicados as $comunicado ) {

			   	if($comunicado['imagem'] != ""){
			   		$media = '<img src="fotos/thumbs/'.$comunicado['imagem'].'" width="50%" />';
			   	}

			   	if($comunicado['video'] != ""){
			   		$media = str_replace('width="560"','width="140"',$comunicado['video']);
			   		$media = str_replace('height="315"','height="85"',$media);
			   	}

			   	 

			                $table .='<tr>
                                        <td>'.$comunicado['titulo'].'</td>
                                        <td>'.date("d/m/Y", strtotime($comunicado['datacomunicado'])).'</td>
                                        <td>'.$media.'</td>
                                        <td>
                                        <a href="#" onclick="buscacomunicado('.$comunicado['id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletecomunicado('.$comunicado['id'].',\''.$comunicado['titulo'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($comunicados) ==0){
                				     $table .='<tr style="text-align:center;">
                                        <td colspan="3">Nenhum comunicado cadastrado...</td>
                                    </tr>';
                }               

			 echo $table;

		}	




		public function addcomunicado($post){

				require_once('ImageManipulator.php');


			try{

				

				if($post['update'] == "true"){

					$comunicado = R::load( 'comunicado', $post["id"] );

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


					$manipulator->resample(610, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);


			        if(file_exists ($destinationPath.$post['foto_i'])){
			        	$i= $destinationPath.$post['foto_i'];
			        	$i2=$destinationPath2.$post['foto_i'];
				        unlink($i);	
						unlink($i2);
			        }


					$comunicado->imagem = $destinationPath . $fileNameThumb;

					} 

					
					$comunicado->titulo = $post['titulo'];
					$comunicado->descricao = $post['descricao'];
					$comunicado->autor = $post['autor'];
					
					if($post['video'] !=""){

						$comunicado->video = $post['video'];
					}

					$comunicado->datacomunicado = date("Y-m-d", strtotime($post['data']));;
					R::store( $comunicado );
		

				}else{

					$comunicado = R::dispense( 'comunicado');

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


					$manipulator->resample(610, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);

			        $comunicado->imagem = $destinationPath . $fileNameThumb;

					} 	

					
					$comunicado->titulo = $post['titulo'];
					$comunicado->descricao = $post['descricao'];
					$comunicado->autor = $post['autor'];
					if($post['video'] !=""){						
						$comunicado->video = $post['video'];
					}
					$comunicado->datacomunicado = date("Y-m-d", strtotime($post['data']));;
					R::store( $comunicado );



				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroComunicado.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroComunicado.php&dados=false&msg=');
			}

			

		}


	



	}



?>