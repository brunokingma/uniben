<?php

	class Model_Banner extends RedBean_SimpleModel {

	
	public function banners($post){

		 $banners =  R::getAll( 'select SUBSTRING(banner,6) as banner ,titulo from banner ORDER BY id DESC limit 3');
		 $b='';
		 $a='';
		 $o='';
	
		for($i=0; $i < count($banners);  $i++ ) {

							if($i==0){
								$a='active';
							}else{
								$a='';
							}

		 					$b .='<div class="item '.$a.'">
                                    <img alt="image"  class="img-responsive" src="'.$banners[$i]['banner'].'">
                                    <div class="carousel-caption">
                                        <p>'.$banners[$i]['titulo'].'</p>
                                    </div>
                                </div>';


                              $o .='<li data-slide-to="'.$i.'" data-target="#carousel2"  class="'.$a.'"></li>';


                               
		}

              $div =' <div class="carousel slide" id="carousel2">
                            <ol class="carousel-indicators">
                                '.$o.'
                            </ol>
                            <div class="carousel-inner">
                            	'.$b.'
                            </div>
                            <a data-slide="prev" href="#carousel2" class="left carousel-control">
                                <span class="icon-prev"></span>
                            </a>
                            <a data-slide="next" href="#carousel2" class="right carousel-control">
                                <span class="icon-next"></span>
                            </a>
                        </div>';

        echo $div;


	}

		

	public function listabanner($post){

		 $foto =  R::getAll( 'select id as banner_id, titulo, banner from banner where id = '.$post['id']);
		 $json = json_encode($foto);
		 echo $json;

	}	



			public function deletebanner($post){
 			  $banner = R::load( 'banner', $post['id'] );
 			  R::trash( $banner ); 
		}



	public function listabannertabela($post){

			 $fotos =  R::getAll( 'select SUBSTRING(banner, 12) as banner, titulo, id as banner_id from banner');
			 $table = '';

			

			   foreach( $fotos as $foto ) {

			   	 

			                $table .='<tr>
                                        <td>'.$foto['titulo'].'</td>
                                        <td><img src="fotos/thumbs/'.$foto['banner'].'" width="50%" /></td>
                                        <td>
                                        <a href="#" onclick="buscabanner('.$foto['banner_id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletebanner('.$foto['banner_id'].',\''.$foto['titulo'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($fotos) ==0){
                				     $table .='<tr style="text-align:center;">
                                        <td colspan="3">Nenhum banner cadastrado...</td>
                                    </tr>';
                }               

			 echo $table;

		}	




		public function addbanner($post){

				require_once('ImageManipulator.php');


			try{

				

				if($post['update'] == "true"){

					$foto = R::load( 'banner', $post["id"] );

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


					$manipulator->resample(1290, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);


			        if(file_exists ($destinationPath.$post['foto_i'])){
			        	$i= $destinationPath.$post['foto_i'];
			        	$i2=$destinationPath2.$post['foto_i'];
				        unlink($i);	
						unlink($i2);
			        }


					$foto->banner = $destinationPath . $fileNameThumb;

					} 

					
					$foto->titulo = $post['titulo'];
					R::store( $foto );


		

				}else{

					$foto = R::dispense( 'banner');

					if($_FILES['inputImage']['name'] != ''){

					$destinationPath = 'view/fotos/';
					$destinationPath2 = 'view/fotos/thumbs/';

					$file = $_FILES['inputImage']['tmp_name'];
					$fileNameThumb = date(si).'_'.$_FILES['inputImage']['name'];
					
			 		$manipulator = new ImageManipulator($file);


					$manipulator->resample(1290, 0);
			        $manipulator->save($destinationPath . $fileNameThumb);

			        $manipulator->resample(200, 0);
			        $manipulator->save($destinationPath2 . $fileNameThumb);

			        $foto->banner = $destinationPath . $fileNameThumb;

					} 	

					
					$foto->titulo = $post['titulo'];
					$id = R::store( $foto );


				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroBanner.php&dados=true');
			}catch(Exception $e){
				echo $e;
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroBanner.php&dados=false&msg=');
			}

			

		}


	



	}



?>