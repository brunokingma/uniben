<?php
class Model_Historico extends RedBean_SimpleModel { 



		public function lista ($post){

			$i = 0;

			$historicos =  R::getAll( "SELECT
											nivel.nome AS nivel,
											nivelusuario.matricula AS inicio,
											nivel.id as nivel_id
										FROM
											nivel
										JOIN nivelusuario ON nivelusuario.nivel_id = nivel.id
										JOIN usuario ON usuario.id = nivelusuario.usuario_id
										where nivelusuario.usuario_id = ".base64_decode($post['id'])." 
										GROUP BY nivel.id ORDER BY inicio");

			foreach ($historicos as $historico) {



				$movimentos =  R::getAll( "SELECT  SUBSTRING(movimento.foto, 6) as foto , movimento.descricao, movimento.nome FROM movimento where nivel_id = ".$historico['nivel_id']);

				$m ="";

				foreach ($movimentos as $movimento) {
						$m .= "<b>".$movimento['nome']."</b>  <i class=\"fa fa-check\"></i>  <a href=\"".$movimento['foto']."\" rel=\"prettyPhoto\"><i class=\"fa fa-file\"></i></a><br>";
						$m .= $movimento['descricao']."<br><br>";
				}



				
				if($i % 2 == 0){

					$div .='<div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon navy-bg">
                                    <i class="fa fa-trophy"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Movimentos</h2>
                                    <p>'.$m.'</p>
                                    <span class="vertical-date">
                                        '.$historico['nivel'].' Nível <br/>
                                        <small>'.date("d/m/Y", strtotime($historico['inicio'])).'</small>
                                    </span>
                                </div>
                            </div>';


				}else{

					$div .='<div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon blue-bg">
                                    <i class="fa fa-trophy"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Movimentos</h2>
                                    <p>'.$m.'</p>
                                    <span class="vertical-date">
                                        '.$historico['nivel'].' Nível <br/>
                                        <small>'.date("d/m/Y", strtotime($historico['inicio'])).'</small>
                                    </span>
                                </div>
                            </div>';
				}

				$i++;
			}

			echo $div;



		}




}
?>











                            

