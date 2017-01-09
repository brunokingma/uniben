<?php

	class Model_Usuario extends RedBean_SimpleModel {




		public function resetsenha($post){

			$usuario = R::load( 'usuario', $post['id'] );
			$usuario->senha = md5("123");
			R::store( $usuario );
		}



		public function buscaperfil($post){

			$perfils =  R::getAll( 'SELECT usuario.id as usuario_id, usuario.nome FROM usuario join perfilusuario on perfilusuario.usuario_id = usuario.id where perfilusuario.perfil_id = 3');
			
			$option = "";

			foreach ($perfils as $perfil) {
				$option .= '<option value="'.$perfil['usuario_id'].'">'.$perfil['nome'].'</option>';
			}

			echo $option;

		}


		public function esqueciminhasenha($post){

				 $usuario =  R::getAll( "SELECT *, id as id_ FROM usuario WHERE usuario.email = '".$post['email']."' LIMIT 1");


				 if( count($usuario) > 0){

				 	$u = R::load( 'usuario', $usuario[0][id_] );

					$u->senha = md5("123");
							
					R::store( $u );




			    // $length = 6;
		        // $senha = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

				 $corpo =' <div style="margin: 0 auto; width: 600px; height: 420px; border: solid 1px #f4f4f4; ">
				            <img src="http://www.poledanceultra.com.br/img/pole_.png" width="200" style="margin-left: 210px; margin-top: 30px;">
				                 <div style="margin: 50px auto; width: 580px; height: auto; border: solid 1px #f4f4f4; background: #f3f3f3; color: #aeaeae; font-size: 11px; font-family: tahoma; ">
				                     <table style="padding: 10px; text-align:center;">				                         
		                                <tr><td style="font-size:18px;">Sua senha foi resetada para 123. Para alterar a senha basta entrar no perfil.</td></tr>
					     				<tr>					
											<td style="color: #323232; padding-left: 15px;">
											 Para acessar a área do aluno logar no site 
											 <a href="http://www.ultramoderndance.com.br/sistema/">http://www.ultramoderndance.com.br/sistema/</a>
											</td> 
										</tr>
				                     </table>				                     
				                 </div>
				        </div>';


				$assunto       = "Ultra Modern Dance dados de acesso";
				$destinatario  = $_POST['email'];
				$remetente     = 'contato@poledanceultra.com.br';
				$nome          = "Pole Dance Ultra - Nova senha";

				$this->smtpmailer($destinatario,$remetente,$nome,$assunto,$corpo);

				echo $_POST['email'];

			}else{

				echo "0";

			}

		}


		public function logar($post){
			
		$usuario =  R::getAll( "SELECT usuario.nascimento, usuario.id as uid,  usuario.*, perfilusuario.* from usuario left join perfilusuario on usuario.id = perfilusuario.usuario_id where usuario.login = '".$post['login']."' and usuario.senha = '".md5($post['senha'])."' group by usuario.id");

		$array = array();
		$perfil = "";

		foreach ($usuario as $key) {

			if($key['perfil_id'] == 1){
				$perfil =  'Administrador';
			}
			
			if ($key['perfil_id'] == 2 || $key['perfil_id'] == null) {
				$perfil =  'Aluno';
			}
			if($key['perfil_id'] == 3){
				$perfil =  'Professor';
			}

			$array[]  = $key['perfil_id'];	
		}

		if(count($usuario) > 0){

						
 			$newDate = date("d/m/Y", strtotime($usuario[0]['nascimento']));

			session_start();
			$_SESSION['usuario'] = $usuario[0]['nome'];
			$_SESSION['login'] = $usuario[0]['login'];
			$_SESSION['email'] = $usuario[0]['email'];
			$_SESSION['foto'] = $usuario[0]['foto'];
			$_SESSION['status'] = $usuario[0]['status'];
			$_SESSION['id'] = base64_encode($usuario[0]['uid']);
			$_SESSION['permissoes'] = $array;
			$_SESSION['perfil'] = $perfil;
			$_SESSION['datanascimento'] = $newDate;

			header('Location:http://www.ultramoderndance.com.br/sistema/view/index.php');
			}else{
			header('Location:http://www.ultramoderndance.com.br/sistema/index.php?erro=true');	
			}

		}


		public function deslogar($post){
			$_SESSION['usuario'] = null;
			$_SESSION['permissoes'] = null;
			header('Location:http://www.ultramoderndance.com.br/sistema/index.php');	
		}
		


	public function smtpmailer($to, $from, $from_name, $subject, $body) { 

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: <'.$from.'>' . "\r\n";
		    mail($to,$subject,$body,$headers);

	}

			public function listaalunounico($post){


			 $usuario =  R::getAll( 'SELECT usuario.*, usuario.id as usuario_id , DATE_FORMAT(usuario.nascimento,\'%d/%m/%Y\') as nascimento, endereco.*, telefone.numero as tel  FROM usuario left join endereco on usuario.id = endereco.usuario_id left join telefone on usuario.id = telefone.usuario_id where usuario.id ='.$post['id']);
			 $json = json_encode($usuario);
			 echo $json;

		}	

			public function listaalunouniconivel($post){
				 $usuario =  R::getAll( "SELECT usuario.id as usuario_id, nivelusuario.nivel_id as nivel, usuario.nome, DATE_FORMAT(nivelusuario.matricula, '%d/%m/%Y') as matricula  FROM usuario join nivelusuario on usuario.id = nivelusuario.usuario_id where nivelusuario.id =".$post['id']);
			 $json = json_encode($usuario);
			 echo $json;

		}	

			public function listaalunos($post){

			 $usuario =  R::getAll( "SELECT usuario.nome as label, usuario.id as value  FROM usuario where nome like '%".$_GET['term']."%'");
			 $json = json_encode($usuario);
			 echo $json;

		}	


					public function listaalunosemail($post){

			 $usuario =  R::getAll( "SELECT usuario.nome as label, usuario.email as value  FROM usuario where nome like '%".$_GET['term']."%'");
			 $json = json_encode($usuario);
			 echo $json;

		}



		public function updatealuno($post){




			try{

			
					$usuario = R::load( 'usuario', $post['id'] );

					$usuario->nome = $post['nome'];
					$usuario->email = $post['email'];
					$usuario->nascimento = date("Y-m-d", strtotime($post['nascimento']));					
					R::store( $usuario );


				if($post['endereco_id'] != 0){

					$end = R::load( 'endereco',  $post['endereco_id'] );	
					$end->rua = $post['rua'];
					$end->bairro = $post['bairro'];
					$end->complemento = $post['complemento'];
					$end->numero = $post['numero'];
					$end->cep = $post['cep'];
					$end->cidade = $post['cidade'];
					$end->estado = $post['estado'];
					R::store( $end );

				}else{

					$end = R::dispense( 'endereco');	
					$end->rua = $post['rua'];
					$end->bairro = $post['bairro'];
					$end->complemento = $post['complemento'];
					$end->numero = $post['numero'];
					$end->cep = $post['cep'];
					$end->cidade = $post['cidade'];
					$end->estado = $post['estado'];
					$end->usuario_id = $post['id'];
					R::store( $end );

				}


				if( $post['telefone_id'] != 0){

					$tel = R::load( 'telefone',  $post['telefone_id'] );	
					$tel->numero = $post['telefone'];
					R::store( $tel );

				}else{

					$tel = R::dispense( 'telefone' );	
					$tel->numero = $post['telefone'];
					$tel->usuario_id = $post['id'];
					R::store( $tel );
				}



				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroAluno.php&dados=true');

			}catch(Exception $e){
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroAluno.php&dados=false&msg='.$e);

			}

		}	



		public function listaaluno($post){

			 $usuario =  R::getAll( 'SELECT * FROM usuario join endereco on usuario.id = endereco.usuario_id join telefone on usuario.id = telefone.usuario_id');
			 $json = json_encode($usuario);
			 echo $json;

		}	

		public function updatestatus($post){
 			  $usuario = R::load( 'usuario', $post['id'] );

 			  if($post['status'] == 0){
 			  	$usuario->status = 1;
 			  }

 			  if($post['status'] == 1){
 			  	$usuario->status = 0;
 			  }

 			  R::store( $usuario ); 

 			  $this->listaalunotabela($post);


		}

		public function deletealuno($post){
 			  $usuario = R::load( 'usuario', $post['id'] );
 			  R::trash( $usuario ); 
		}


			public function deletealunonivel($post){
 			  $nivelusuario = R::load( 'nivelusuario', $post['id'] );
 			  R::trash( $nivelusuario ); 
		}


		public function listaalunotabela($post){

			$q="";

			if($post['aluno'] !=''){
				$q=" where usuario.nome like '%".$post['aluno']."%' ";
			}

			 $usuarios =  R::getAll( 'SELECT usuario.id as usuario_id, usuario.matricula, usuario.email, usuario.nome , usuario.status, endereco.id as endereco_id, telefone.id as telefone_id  FROM usuario 
			 						  left join endereco on usuario.id = endereco.usuario_id 
			 						  left join telefone on usuario.id = telefone.usuario_id '.$q.' limit 15');
			 $table = '';
			   foreach( $usuarios as $usuario ) {

			   	if($usuario['status']==0){
			   		$status = '<a href="#" onclick="status('.$usuario['usuario_id'].','.$usuario['status'].')"><span class="label label-warning">Desativado</span></a>';
			   	}else{
			   		$status = '<a href="#" onclick="status('.$usuario['usuario_id'].','.$usuario['status'].')"><span class="label label-info">Ativado</span></a>';
			   	}

			   	 if(is_null($usuario['endereco_id'])){ $endereco_id = 0;}else{ $endereco_id = $usuario['endereco_id'];}
			   	 if(is_null($usuario['telefone_id'])){$telefone_id = 0;}else{$telefone_id = $usuario['telefone_id'];} 


			                $table .='<tr>
                                        <td>'.$usuario['nome'].'</td>
                                        <td style="text-align:center;">'.date("d/m/Y", strtotime($usuario['matricula'])).'</td>
                                        <td style="text-align:center;"><a href="#" onclick="detalhes('.$usuario['usuario_id'].')" data-toggle="modal" data-target="#modal_"><span class="label label-info"><i class="fa fa-external-link"></i> Detalhes</span></a></td>
                                        <td style="text-align:center;">'.$status.'</td>
                                        <td style="text-align:center;">
                                        <a href="#" onclick="buscaaluno('.$usuario['usuario_id'].','.$endereco_id.','.$telefone_id.')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletealuno('.$usuario['usuario_id'].',\''.$usuario['nome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }

			 echo $table;

		}	

	public function listaalunotabelanivel($post){

			 $usuarios =  R::getAll( 'SELECT nivelusuario.id as nivel_id, usuario.nome, usuario.id as usuario_id, nivelusuario.matricula, nivel.nome as nivel
			 FROM usuario join nivelusuario on usuario.id = nivelusuario.usuario_id join nivel on nivel.id = nivelusuario.nivel_id');
			 $table = '';
			   foreach( $usuarios as $usuario ) {
			                $table .='<tr>
                                        <td>'.$usuario['nome'].'</td>
                                        <td>'.date("d/m/Y", strtotime($usuario['matricula'])).'</td>
                                        <td>'.$usuario['nivel'].'</td>
                                        <td>
                                        <a href="#" onclick="buscaalunonivel('.$usuario['nivel_id'].','.$usuario['usuario_id'].')" ><i class="fa fa-pencil-square-o text-navy"></i> </a>
                                        <a href="#" onclick="deletealunonivel('.$usuario['nivel_id'].',\''.$usuario['nome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-times text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($usuarios) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhum nível lançado para os alunos cadastrados...</td>
                                    </tr>';
                }               

			 echo $table;

		}	


			public function alteraDadosAluno($post){

			 $usuarios =  R::getAll( 'SELECT * from usuario');
			 $table = '';
			   foreach( $usuarios as $usuario ) {
			                $table .='<tr>
                                        <td>'.$usuario['nome'].'</td>
                                        <td>'.$usuario['login'].'</td>
                                        <td >                                       
                                        <a href="#" onclick="alterardadosaluno('.$usuario['id'].',\''.$usuario['nome'].'\')" data-toggle="modal" data-target="#modal_" > <i class="fa fa-refresh text-navy"></i></a>
                                        </td>
                                    </tr>';
                                }
                if(count($usuarios) ==0){
                				     $table .='<tr>
                                        <td colspan="4">Nenhum usuario cadastrado...</td>
                                    </tr>';
                }               

			 echo $table;

		}


		public function addalunonivel($post){

			try{

				if($post[update] == ''){
									$nivelusuario_ =  R::getAssocRow( 'SELECT id as nivelusuario_id FROM nivelusuario where usuario_id = '.$post["id"].' and nivel_id = '.$post["nivel"]);
				}else{
									$nivelusuario_ =  R::getAssocRow( 'SELECT id as nivelusuario_id FROM nivelusuario where usuario_id = '.$post["id"]);
				}




				if(count($nivelusuario_) > 0){
				$usuario = R::load( 'usuario', $post['id'] );
				$nivel = R::load( 'nivel', $post['nivel'] );
				$nivelusuario = R::load( 'nivelusuario', $nivelusuario_[0]['nivelusuario_id'] );
				$nivelusuario->usuario = $usuario;
				$nivelusuario->nivel = $nivel;
				$nivelusuario->matricula = date("Y-m-d", strtotime($_POST['matricula']));
				R::store( $nivelusuario );

				}else{

				$usuario = R::load( 'usuario', $post['id'] );
				$nivel = R::load( 'nivel', $post['nivel'] );
				$nivelusuario = R::dispense( 'nivelusuario' );
				$nivelusuario->usuario = $usuario;
				$nivelusuario->nivel = $nivel;
				$nivelusuario->matricula = date("Y-m-d", strtotime($_POST['matricula']));
				R::store( $nivelusuario );

				}
				
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroHistorico.php&dados=true');
			}catch(Exception $e){
				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroHistorico.php&dados=false&msg='.$e);
			}

			

		}


		public function addaluno($post){

			    // $length = 6;
		        // $senha = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				$senha = "123";

				$m = '
				<tr>
					<td>Login:</td>
					<td style="color: #323232;  padding-left: 15px;">'.substr(str_replace(" ", "", $_POST['nome']), 0, 8).'</td> 
				</tr>

				<tr>
					<td>Senha:</td>
					<td style="color: #323232;  padding-left: 15px;">'.$senha.'</td>
				</tr>

				<tr>
					<td>Mensagem:</td>
					<td style="color: #323232; padding-left: 15px;"> Para acessar a área do aluno logar no site <a href="http://www.ultramoderndance.com.br/sistema/">http://www.ultramoderndance.com.br/sistema/</a> </td> 
				</tr>
				    ';

			

			$usuario = R::dispense( 'usuario' );
			$usuario->nome = $_POST['nome'];
			$usuario->email = $_POST['email'];
			$usuario->nascimento = date("Y-m-d", strtotime($_POST['nascimento']));
			$usuario->matricula = date('Y-m-d');
			$usuario->login = substr(str_replace(" ", "", $_POST['nome']), 0, 8);
			$usuario->senha =  md5($senha);
			$usuario->status = 1;
			$id = R::store( $usuario );
			
			$perfil = R::dispense( 'perfilusuario' );
			$perfil->usuario_id = $id;
			$perfil->perfil_id = 2;
			R::store( $perfil );

			$end = R::dispense( 'endereco' );	
			$end->rua = $_POST['rua'];
			$end->bairro = $_POST['bairro'];
			$end->complemento = $_POST['complemento'];
			$end->numero = $_POST['numero'];
			$end->cep = $_POST['cep'];
			$end->cidade = $_POST['cidade'];
			$end->estado = $_POST['estado'];
			$end->usuario = $usuario;
			R::store( $end );


			$tel = R::dispense( 'telefone' );	
			$tel->numero = $_POST['telefone'];
			$tel->usuario = $usuario;
			R::store( $tel );


				 $corpo =' <div style="margin: 0 auto; width: 600px; height: 420px; border: solid 1px #f4f4f4; ">
				            <img src="http://www.poledanceultra.com.br/img/pole_.png" width="200" style="margin-left: 210px; margin-top: 30px;">
				                 <div style="margin: 50px auto; width: 580px; height: auto; border: solid 1px #f4f4f4; background: #f3f3f3; color: #aeaeae; font-size: 11px; font-family: tahoma; ">
				                     <table style="padding: 10px;">
				                         '.$m.'
				                         </tr>
				                     </table>
				                     
				                 </div>
				        </div>';


				$assunto       = "Ultra Modern Dance dados de acesso";
				$destinatario  = $_POST['email'];
				$remetente     = 'contato@poledanceultra.com.br';
				$nome          = "Pole Dance Ultra";

				$this->smtpmailer($destinatario,$remetente,$nome,$assunto,$corpo);


			header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroAluno.php&dados=true');


		}
		
		
		public function atualizaperfil($post){

			require_once('ImageManipulator.php');


			if($_FILES['inputImage']['name'] != ''){

			$destinationPath = 'view/perfil/';
			$file = $_FILES['inputImage']['tmp_name'];
			$fileNameThumb = 'small_'.date(si).'_'.$_FILES['inputImage']['name'];
			$obj = json_decode($_POST['formato']);

	 		$manipulator = new ImageManipulator($file);
	        $width  =  round($obj->width);
	        $height =  round($obj->height);
	        $x = round($obj->x);
	        $y = round($obj->y);

			$manipulator->crop($x, $y, $width+$x, $height+$y); 
	        $manipulator->save($destinationPath . $fileNameThumb);

			} 	

			//$u =  R::getAll("SELECT * from usuario where login ='".substr(str_replace(' ', '', $_POST['login']), 0, 8)."'");

			//if($u[0]['login'] == ''){

	        $usuario = R::load( 'usuario', base64_decode($_POST['id']));

	        $usuario->nome = $_POST['nome'];
	        $usuario->login = $_SESSION['login'];
	        $usuario->email = $_POST['email'];


	        $usuario->nascimento = date("Y-m-d", strtotime($_POST['datanascimento']));

        
	        if($_POST['password'] !=''){
	        	$usuario->senha = md5($_POST['password']);	
	        }

	        if($_FILES['inputImage']['name'] != ''){
	        	$usuario->foto = $fileNameThumb;
	        	$_SESSION['foto'] = $usuario->foto;
			}
			
	        R::store( $usuario );

	        $_SESSION['usuario'] = $usuario->nome;
     		$_SESSION['email'] = $usuario->email;
			$_SESSION['datanascimento'] = $_POST['datanascimento'];
			
			header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=perfil.php&dados=true');
        	
        	//}else{
        	
        //	header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=perfil.php&dados=false&msg=Login já existente no sistema.');

        	//}
		}



	}



?>