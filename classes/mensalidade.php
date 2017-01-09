<?php

	class Model_Mensalidade extends RedBean_SimpleModel {



        public function alerta ($post){

            $hj = date('Y-m-d');

            $mensalidades =  R::getAll( "SELECT * from mensalidade where vencimento < '".$hj."' and  ISNULL(pagamento_data)");

            if(count($mensalidades) > 0){
                echo '1';
            }else{
                echo '0';
            }

        }

        public function excluirmensalidades ($post){

        	$ids = explode("|", $post['data']);
 		try{
        	for ($i=0; $i < count($ids) ; $i++) { 
        	R::exec( "delete from mensalidade where id = ".$ids[$i]);
        	R::exec( "insert into log (acao, data) value ('delete from mensalidade where id = ".$ids[$i]."',NOW())");
        	}
			echo 1;
        }catch(Exception $e){
	                echo $e;	               
	            }

        }


		public function listaturmaalunocombo($post){

			$turmaaluno =  R::getAll( 'select turma.nome, turma.id as turma_id from turma join usuarioturma on turma.id = usuarioturma.turma_id where usuarioturma.usuario_id ='.$post['usuario_id']);
			
			$option = "";

			foreach ($turmaaluno as $turmaaluno) {
				$option .= '<option value="'.$turmaaluno['turma_id'].'">'.$turmaaluno['nome'].'</option>';
			}

			echo $option;

		}	



        public function estorno ($post){

            $mensalidade = R::load( 'mensalidade', $post['id']  );
            $mensalidade->estorno_data =  date('Y-m-d', strtotime(str_replace('/', '-', $post['estorno_data'])));
            $mensalidade->estorno = $post['estorno'];
            R::store( $mensalidade );
              $this->listamensalidadestabela($post);

        }		


        public function baixapagamento ($post){

            $mensalidade = R::load( 'mensalidade', $post['id'] );

            $mensalidade->pagamento_data =  date('Y-m-d', strtotime(str_replace('/', '-', $post['pagamento_data'])));
            $mensalidade->multa = $post['multa'];
            $mensalidade->desconto = $post['desconto'];
            $mensalidade->valor_pago = $post['valor'];
            R::store( $mensalidade );

            $this->listamensalidadestabela($post);

        }


        public function addmensalidade ($post){

       
            $mensalidades =  R::getAll( "   SELECT
                                                modalidade.valor,
                                                turma.inicio,
                                                turma.fim
                                            FROM  modalidade                                        
                                            JOIN turma ON turma.id = ".$post['turma']. " and modalidade.id = ".$post['modalidade_id']);
            

            if(count($mensalidades) > 0){
            	 try{
	            $matricula =  date('Y-m-d', strtotime($post['matricula']));
	            $diff = abs(strtotime($mensalidades[0]['fim']) - strtotime($matricula));
	            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));


	            $parcela = 0;

	            for ($i=1; $i < $months; $i++) { 

	                $mensalidade = R::dispense( 'mensalidade');

	                if($post['extra'] !=''){
	                  $mensalidade->valor = $mensalidades[0]['valor'] + $post['extra'];
	                }else{
	                  $mensalidade->valor = $mensalidades[0]['valor'];  
	                }

	                $mensalidade->parcela = $i;
	                $mensalidade->desconto = $post['desconto'];
	                $mensalidade->usuario_id = $post['usuario_id'];
	                $mensalidade->modalidade_id = $post['modalidade_id'];
	                $mensalidade->matricula =  date('Y-m-d', strtotime($post['matricula']));
	                $mensalidade->vencimento =  date("Y-m-d", strtotime($post['vencimento']."+".$i." Month")); 


	                R::store( $mensalidade );
	                
	            }
	                header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroMensalidade.php&dados=true');
	            }catch(Exception $e){
	                echo $e;
	                header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroMensalidade.php&dados=false&msg=');
	            }
	        }else{
	        	echo $e;
 				header('Location:http://www.ultramoderndance.com.br/sistema/view/transfer.php?retorno=cadastroMensalidade.php&dados=false&msg=');
	        }

		}




        public function lista ($post){

            $mensalidades =  R::getAll( "SELECT * from mensalidade where usuario_id = ".base64_decode($post['id']));
            $c = "";
            $data = "";
            foreach ($mensalidades as $mensalidade) {


                $today_dt = new DateTime(date('Y-m-d'));
                $expire_dt = new DateTime($mensalidade['vencimento']);

                if($expire_dt < $today_dt && $mensalidade['pagamento_data'] == ""){
                    $c = 'class="alert alert-danger"';
                }else{
                    $c = "";
                }

                if($mensalidade['pagamento_data'] !=""){
                    $data = date("d/m/Y", strtotime($mensalidade['pagamento_data']));
                } else{
                    $data = "";
                }

                $tb .='   <tr '.$c.'>
                                <td style="text-align: center;">'.$mensalidade['parcela'].'</td>
                                <td>'. $data.'</td>
                                <td>'.date("d/m/Y", strtotime($mensalidade['vencimento'])).'</td>
                                <td>'.$mensalidade['desconto'].'</td>
                                <td>'.$mensalidade['multa'].'</td>
                                <td>'.$mensalidade['valor'].'</td>
                                <td>'.$mensalidade['valor_pago'].'</td>
                            </tr>';


            }

            echo $tb;           
             

        }   	





    public function listamensalidadestabela($post){


             $mensalidades =  R::getAll( 'SELECT mensalidade.id as mensalidade_id, mensalidade.* from mensalidade where mensalidade.usuario_id = '.$post['usuario_id']);
             $table = '';
            
               foreach( $mensalidades as $mensalidade ) {


                if($mensalidade['estorno'] != ''){

                $e = '<a href="#" onclick="view(\''.$mensalidade['estorno'].'\', \''.date("d/m/Y", strtotime($mensalidade['pagamento_data'])).'\')" data-toggle="modal" data-target="#modal_">
                      <i class="fa fa-eye text-navy"></i></a>';

                }else{

                    $e = '
                    <i class="fa fa-eye-slash"></i></i>';
                }

                if($mensalidade['pagamento_data'] !=''){
                    $disabled = '<a href="#"  onclick="updatemensalidade('.$mensalidade['mensalidade_id'].',\''.date("d/m/Y", strtotime($mensalidade['pagamento_data'])).'\', \''.$mensalidade['valor'].'\', \''.$mensalidade['desconto'].'\', \''.$mensalidade['multa'].'\', \''.$mensalidade['valor_pago'].'\', '.$post['usuario_id'].')" data-toggle="modal" data-target="#modal_" >
                                        <i class="fa fa-pencil-square-o text-navy"></i> </a>

                                        <a href="#" onclick="estorno(\''.$mensalidade['mensalidade_id'].'\', '.$post['usuario_id'].' )" data-toggle="modal" data-target="#modal_">
                                        <i class="fa fa-undo text-navy"></i> </a>

                                        ';
                }else{
                    $disabled = '<i class="fa fa-pencil-square-o "></i>  <i class="fa fa-undo"></i>';
                }


                if($mensalidade['pagamento_data'] != ""){
                    $data=date('d/m/Y', strtotime($mensalidade['pagamento_data']));
                }else{
                    $data="";
                }


                            $table .='<tr>
                                        <td  style="text-align: center;">'.$mensalidade['parcela'].'</td>
                                        <td>'.date("d/m/Y", strtotime($mensalidade['vencimento'])).'</td>
                                        <td>'.$mensalidade['valor'].'</td>
                                        <td>'.$mensalidade['desconto'].'</td>
                                        <td>'.$mensalidade['multa'].'</td>
                                        <td>'.$mensalidade['valor_pago'].'</td>
                                        <td>'.$data.'</td>
                                        <td  style="text-align: center;">'.$e.'</td>
                                        <td  style="text-align: center;" >

                                        '.$disabled .'


                                        <a href="#" onclick="baixa('.$mensalidade['mensalidade_id'].','.$mensalidade['usuario_id'].',\''.$mensalidade['valor'].'\',\''.$mensalidade['desconto'].'\')" data-toggle="modal" data-target="#modal_">
                                        <i class="fa fa-money text-navy"></i></a> 

                                        <input type="checkbox" name="apagar" id="apagar[]" value="'.$mensalidade['mensalidade_id'].'" style="position: relative;vertical-align: middle;  bottom: 3px; left:5px;" />

                                        </td>
                                    </tr>';
                                } 
                if(count($mensalidades) ==0){
                                     $table .='<tr>
                                        <td colspan="4">Nenhuma mensalidade encontrada...</td>
                                    </tr>';
                }               

             echo $table;

        }   


	}



?>