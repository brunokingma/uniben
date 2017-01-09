                  <?php  


                    echo '

                        <li>
                        <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Página inicial </span></a>
                        </li>

                        ';
/**/   
                    foreach ($_SESSION['permissoes'] as $key => $value){

                    if($value == 2 && $_SESSION['status'] == 1){

                    echo '

                        <li>
                        <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Área do aluno</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="historico.php" class="carregaPagina">Histórico</a></li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li><a href="movimento.php" class="carregaPagina">Movimentos</a></li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li><a href="mensalidade.php" class="carregaPagina">Mensalidade</a></li>
                            </ul>
                        </li>


                        <li>
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Calendário</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="calendario.php?tipo='.$value.'" class="carregaPagina">Aulas</a></li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li><a href="calendarioEvento.php" class="carregaPagina">Eventos</a></li>
                            </ul>
                        </li>


                       <li>
                        <a href="falecom.php" class="carregaPagina"><i class="fa fa-envelope-o"></i> <span class="nav-label">Contato</span></a>                            
                       </li>


                        '; 
                    }


                    if($value == 2 && $_SESSION['status'] == 0){

                        echo '
                        <li>
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Calendário</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="calendarioEvento.php" class="carregaPagina">Eventos</a></li>
                            </ul>
                        </li>


                       <li>
                        <a href="falecom.php" class="carregaPagina"><i class="fa fa-envelope-o"></i> <span class="nav-label">Contato</span></a>                            
                       </li>


                        '; 



                    }


                 

 
                   if($value == 3){

                    echo '

                        <li>

                        <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Cadastro de turma</span><span class="fa arrow"></span></a>
                           
                            <ul class="nav nav-second-level">
                                <li><a href="cadastroTurma.php" class="carregaPagina">Turma</a></li>
                            </ul>
							
                            <ul class="nav nav-second-level">
                                <li><a href="cadastroModalidade.php" class="carregaPagina">Tipos de Planos</a></li>
                            </ul>							
														
                            <ul class="nav nav-second-level">
                                <li><a href="cadastroDia.php" class="carregaPagina">Aulas</a></li>
                            </ul>



                        </li>


                        <li>

                        <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Cadastro de aluno</span><span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroAluno.php" class="carregaPagina">Aluno</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroPerfil.php" class="carregaPagina">Perfil de acesso</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroHistorico.php" class="carregaPagina">Nível do aluno</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroTurmaAluno.php" class="carregaPagina">Vincular aluno aula</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroMensalidade.php" class="carregaPagina">Mensalidade</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="listaDadosAluno.php" class="carregaPagina">Login de acesso</a></li>
                            </ul>

                        </li>
						
						<li>
                         <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                <li><a href="relatorioMensalidade.php" class="carregaPagina">Mensalidades</a></li>
                            </ul>
                      
                            <ul class="nav nav-second-level">
                                <li><a href="relatorioAluno.php" class="carregaPagina">Presença por data</a></li>
                            </ul>
							
							<ul class="nav nav-second-level">
                                <li><a href="relatorioAula.php" class="carregaPagina">Horários x Alunos</a></li>
                            </ul>

                        </li>

                        <li>
                         <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Diário de classe</span><span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                <li><a href="cadastroPresenca.php" class="carregaPagina">Chamada</a></li>
                            </ul>
							 <ul class="nav nav-second-level">
                                <li><a href="listaChamada.php" class="carregaPagina">Chamada realizada</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="listaChamadaDia.php" class="carregaPagina">Chamada realizada dia</a></li>
                            </ul>

                        </li>


                        <li>
                         <a href="#"><i class="fa fa-female"></i> <span class="nav-label">Movimentos</span><span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                <li><a href="cadastroMovimento.php" class="carregaPagina">Movimentos</a></li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li><a href="cadastraFotos.php" class="carregaPagina">Fotos</a></li>
                            </ul>

                        </li>


                        <li>
                         <a href="#"><i class="fa fa-comment"></i> <span class="nav-label">Informativo</span><span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                <li><a href="cadastroBanner.php" class="carregaPagina">Banner</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroComunicado.php" class="carregaPagina">Comunicados</a></li>
                            </ul>

                            <ul class="nav nav-second-level">
                                <li><a href="cadastroEvento.php" class="carregaPagina">Eventos</a></li>
                            </ul>

                        </li>

                        <li>
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Agenda</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="calendario.php?tipo='.$value.'" class="carregaPagina">Aulas</a></li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li><a href="calendarioEvento.php" class="carregaPagina">Eventos</a></li>
                            </ul>
                        </li>

                        '; 
                    }


				
 

                  if($value == 1){

                    echo '
                        <li>
                                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Área do professor</span><span class="fa arrow"></span></a>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroAluno.php" class="carregaPagina">Aluno</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroHistorico.php" class="carregaPagina">Nível do aluno</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroTurmaAluno.php" class="carregaPagina">Turma aluno</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroMensalidade.php" class="carregaPagina">Mensalidade</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroPresenca.php" class="carregaPagina">Diário</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroTurma.php" class="carregaPagina">Turma</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroModalidade.php" class="carregaPagina">Modalidade</a></li>
                                </ul>


                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroMovimento.php" class="carregaPagina">Movimentos</a></li>
                                </ul>


                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroPerfil.php" class="carregaPagina">Perfil</a></li>
                                </ul>


                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroBanner.php" class="carregaPagina">Banner</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroComunicado.php" class="carregaPagina">Comunicados</a></li>
                                </ul>

                                <ul class="nav nav-second-level">
                                    <li><a href="cadastroEvento.php" class="carregaPagina">Eventos</a></li>
                                </ul>


                                <ul class="nav nav-second-level">
                                    <li><a href="cadastraFotos.php" class="carregaPagina">Fotos</a></li>
                                </ul>


                        </li>


                        <li>
                        <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Agenda</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="calendario.php?tipo='.$value.'" class="carregaPagina">Aulas</a></li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li><a href="calendarioEvento.php" class="carregaPagina">Eventos</a></li>
                            </ul>
                        </li>


                        '; 
                    }

                    
                }

                  ?>