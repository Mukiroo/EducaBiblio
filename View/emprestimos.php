<?php
// Inclua o arquivo de conexão ao banco de dados.
include '../Controller/CConexao.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
	header("Location: ../View/login.php"); // Redirecionar para a página de login se não estiver logado
	exit();
}

// Inicialize a instância da classe de conexão.
$conexao = new CConexao();
$conn = $conexao->getConnection();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../ArquivosExternos/icons.js"></script>
	<link rel="shortcut icon" href="../img/icon1.png" type="image/x-icon">
	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="../CSS/popup5.css">
	<link rel="stylesheet" href="../CSS/darkPaginacao.css">
	<title>EducaBiblio</title>
</head>

<body>

	<section id="sidebar">
		<a href="#" class="brand">
			<i class="fas fa-book"></i>
			<span class="text">EducaBiblio</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="inicio.php">
					<i class='fas fa-home'></i>
					<span class="text">Início</span>
				</a>
			</li>
			<li>
				<a href="livros.php">
					<i class="fas fa-book"></i>
					<span class="text">Livros</span>
				</a>
			</li>
			<li class="active">
				<a href="emprestimos.php">
					<i class="fas fa-undo"></i>
					<span class="text">Empréstimos</span>
				</a>
			</li>
			<li>
				<a href="devolucao.php">
					<i class="fas fa-arrow-left"></i>
					<span class="text">Devoluções</span>
				</a>
			</li>
			<li>
				<a href="aluno.php">
					<i class="fas fa-graduation-cap"></i>
					<span class="text">Alunos</span>
				</a>
			</li>
			<li>
				<a href="prof.php">
					<i class="fas fa-clipboard-list"></i>
					<span class="text">Professores</span>
				</a>
			</li>
			<li>
				<a href="turma.php">
					<i class="fas fa-users"></i>
					<span class="text">Turma</span>
				</a>
			</li>
			<li>
				<a href="recomendacoes.php">
					<i class="fas fa-download"></i>
					<span class="text">Recomendações</span>
				</a>
			</li>
			<li>
				<a href="usuarios.php">
					<i class="fas fa-cogs"></i>
					<span class="text">Usuários</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../Controller/CLogout.php" class="logout">
					<i class="fas fa-sign-out-alt"></i>
					<span class="text">Deslogar</span>
				</a>
			</li>
		</ul>
	</section>

	<section id="content">
		<nav>
			<i class='fas fa-bars'></i>
			<form action="#"></form>
			<div class="icons">
				<div id="menu-btn" class="fas fa-question" onclick="abrirPDFEmNovaAba()"></div>
			</div>

			<script>
				function abrirPDFEmNovaAba() {
					var urlDoPDF = "../ArquivosExternos/Manual.pdf";
					window.open(urlDoPDF, '_blank');
				}
			</script>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="profile">
				<?php
				require('../Controller/Utils.php');

				$conexao = new CConexao();
				$conn = $conexao->getConnection();

				?>
			</a>
		</nav>
		</head>

		<body>

			<section class="tabela">

				<div class="row">
					<form action="../Router/emp_rotas.php" method="post">
						<h3>Empréstimo de livros</h3>
						<input type="text" placeholder="ID" name="idEmprestimo" id="idEmprestimo" class="box2" autocomplete="off" readonly>
						<select id="Genero_idGenero" name="Genero_idGenero" class="box select-dark-mode" required>
							<option value="">Selecione um gênero</option>
							<?php
							// Preencha as opções de gênero a partir do banco de dados.
							$query = "SELECT idGenero, NomeGenero FROM genero";
							$stmt = $conn->query($query);
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								echo "<option value='" . $row['idGenero'] . "'>" . $row['NomeGenero'] . "</option>";
							}
							?>
						</select>
						<select id="livro_idLivro" name="livro_idLivro" class="box select-dark-mode">
							<option value="">Selecione um livro</option>
							<!-- Opções de livros serão preenchidas dinamicamente com JavaScript -->
						</select>
						<select id="Turma_idTurma" name="Turma_idTurma" class="box select-dark-mode" required>
							<option value="">Selecione uma turma</option>
							<option value="0">Professor</option>
							<?php
							// Preencha as opções de turma a partir do banco de dados.
							$query = "SELECT IdTurma, AnodeInicio, AnoTurma, NomeTurma FROM turma";
							$stmt = $conn->query($query);
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								echo "<option value='" . $row['IdTurma'] . "'>" . $row['AnoTurma'] . 'º ' . $row['NomeTurma'] . "</option>";
							}
							?>
						</select>
						<select id="aluno_idAluno" name="aluno_idAluno" class="box select-dark-mode">
							<option value="">Selecione um aluno</option>
							<!-- Opções de alunos serão preenchidas dinamicamente com JavaScript -->
						</select>
						<select id="prof_idProf" name="prof_idProf" class="box select-dark-mode">
							<option value="">Selecione um prof</option>
							<!-- Opções de prof serão preenchidas dinamicamente com JavaScript -->
						</select>
						<h4>Data do empréstimo:</h4>
						<input type="date" placeholder="DD/MM/AAAA" name="DataEmprestimo" id="DataEmprestimo" required class="box" autocomplete="off" required>



						<input type="text" placeholder="Quantidade" name="quantidade" required class="box" autocomplete="off" required>

						<h4>Data da devolução:</h4>
						<input type="date" placeholder="Data" name="data" required class="box" autocomplete="off" required>

						<style>
							h4 {
								margin-right: 87% !important;
							}
						</style>
						<select id="usuario_idUsuario" name="usuario_idUsuario" class="box select-dark-mode" required>
							<option value="">Selecione um usuário</option>
							<?php
							// Preencha as opções de usuário a partir do banco de dados.
							$query = "SELECT idUsuario, UserUsuario FROM usuario";
							$stmt = $conn->query($query);
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								echo "<option value='" . $row['idUsuario'] . "'>" . $row['UserUsuario'] . "</option>";
							}
							?>
						</select>

						<center> <input type="submit" value="Enviar" class="inline-btn" name="emprestar"> </center>
					</form>
				</div>
			</section>
			<style>
				/* Esconde as setas para campos de entrada numérica */
				input[type=number]::-webkit-inner-spin-button,
				input[type=number]::-webkit-outer-spin-button {
					-webkit-appearance: none;
					margin: 0;
				}

				input[type=number] {
					-moz-appearance: textfield;
					/* Firefox */
				}



				.searchInput {
					width: 20% !important;
					height: 30px;
					background-color: #f2f2f2;
					border: 1px solid #ccc;
					border-radius: 5px;
					padding: 5px;
				}
			</style>
			<main>
				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3>Tabela de empréstimos de livros</h3>
							<input type="text" id="searchInput" class="searchInput" placeholder="Pesquisar...">

							<button class="pdf-button" id="pdf-button" aria-label="botão pdf" onclick="abrirAluno()">
								<i class="fas fa-file-pdf"></i></button>

							<script>
								function abrirAluno() {
									var urlDoPDF = "../pdf/emprestimoPdf.php";
									window.open(urlDoPDF, '_blank');
								}
							</script>

						</div>
						<?php
						// Conecta-se ao banco de dados
						$conexao = new CConexao();
						$conn = $conexao->getConnection();

						// Consultas SQL para buscar empréstimos de alunos e professores
						$sqlAlunos = "
    SELECT
        livro.NomeLivro AS TituloLivro,
        genero.NomeGenero,
        emprestimo.idEmprestimo,
        turma.NomeTurma,
        aluno.NomeAluno,
        turma.AnoTurma,
        emprestimo.DataEmprestimo,
        devolucao.DataDevolucao,
        emprestimo.Quantidade_emp,
        usuario.UserUsuario
    FROM emprestimo
    LEFT JOIN aluno ON emprestimo.aluno_idAluno = aluno.idAluno
    INNER JOIN livro ON emprestimo.livro_idLivro = livro.idLivro
    INNER JOIN genero ON livro.Genero_idGenero = genero.idGenero
    INNER JOIN turma ON aluno.Turma_idTurma = turma.IdTurma
    INNER JOIN usuario ON emprestimo.usuario_idUsuario = usuario.idUsuario
    LEFT JOIN devolucao ON emprestimo.idEmprestimo = devolucao.emprestimo_idEmprestimo";

						$sqlProfessores = "
    SELECT
        livro.NomeLivro AS TituloLivro,
        genero.NomeGenero,
        emprestimo.idEmprestimo,
        'Professor' AS NomeTurma,
        prof.NomeProf AS NomeLeitor,
        NULL AS AnoTurma,
        emprestimo.DataEmprestimo,
        devolucao.DataDevolucao,
        emprestimo.Quantidade_emp,
        usuario.UserUsuario
    FROM emprestimo
    LEFT JOIN prof ON emprestimo.prof_idProf = prof.idProf
    INNER JOIN livro ON emprestimo.livro_idLivro = livro.idLivro
    INNER JOIN genero ON livro.Genero_idGenero = genero.idGenero
    INNER JOIN usuario ON emprestimo.usuario_idUsuario = usuario.idUsuario
    LEFT JOIN devolucao ON emprestimo.idEmprestimo = devolucao.emprestimo_idEmprestimo
    WHERE prof.idProf IS NOT NULL"; // Usando a condição na tabela 'prof'

						// Consulta geral unindo empréstimos de alunos e professores
						$sql = "($sqlAlunos) UNION ($sqlProfessores)";

						$result = $conn->query($sql);

						if ($result === false) {
							// Use errorInfo para obter informações sobre o erro
							$errorInfo = $conn->errorInfo();
							echo "Erro na consulta SQL: " . $errorInfo[2];
						} else {
							if ($result->rowCount() > 0) {
								$emprestimos = $result->fetchAll(PDO::FETCH_ASSOC);
								$emprestimosPorPagina = 5;
								$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
								$indiceInicial = ($paginaAtual - 1) * $emprestimosPorPagina;
								$emprestimosExibidos = array_slice($emprestimos, $indiceInicial, $emprestimosPorPagina);

								// Exibir a tabela de empréstimos
								echo "<table>";
								echo "<thead>";
								echo "<tr>";
								echo "<th><center>Livro</center></th>";
								echo "<th><center>Gênero</center></th>";
								echo "<th><center>ID</center></th>";
								echo "<th><center>Turma</center></th>";
								echo "<th><center>Leitor</center></th>";
								echo "<th><center>Data de empréstimo</center></th>";
								echo "<th><center>Data para devolução</center></th>";
								echo "<th><center>Quantidade</center></th>";
								echo "<th><center>Usuário</center></th>";
								echo "<th><center>Editar</center></th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";

								foreach ($emprestimosExibidos as $row) {
									echo "<tr>";
									echo "<td><center>" . $row["TituloLivro"] . "</center></td>";
									echo "<td><center>" . $row["NomeGenero"] . "</center></td>";
									echo "<td><center>" . $row["idEmprestimo"] . "</center></td>";

									// Verifica se é um aluno ou um professor e exibe a informação correspondente
									if (isset($row["NomeAluno"])) {
										// Se for aluno, exibe o nome da turma e o nome do aluno
										echo "<td><center>" . $row["AnoTurma"] . " " . $row["NomeTurma"] . "</center></td>";
										echo "<td><center>" . $row["NomeAluno"] . "</center></td>";
									} elseif (isset($row["NomeLeitor"])) {
										// Se for professor, exibe somente o nome do professor
										echo "<td><center>Professor</center></td>";
										echo "<td><center>" . $row["NomeLeitor"] . "</center></td>";
									}

									// Verifica se a data de empréstimo está definida antes de formatar
									echo "<td><center>" . ($row["DataEmprestimo"] ? date('d/m/Y', strtotime($row["DataEmprestimo"])) : "Data não disponível") . "</center></td>";

									// Verifica se a data de devolução está definida antes de formatar
									echo "<td><center>" . ($row["DataDevolucao"] ? date('d/m/Y', strtotime($row["DataDevolucao"])) : "Data não disponível") . "</center></td>";

									echo "<td><center>" . $row["Quantidade_emp"] . "</center></td>";
									echo "<td><center>" . $row["UserUsuario"] . "</center></td>";
									echo "<td><center><button class='edit-button'><i class='fas fa-pencil-alt'></i></button></center></td>";
									echo "</tr>";
								}

								echo "</tbody>";
								echo "</table>";

								// Adiciona links de paginação
								echo "<div class='pagination'>";
								$totalEmprestimos = count($emprestimos);
								$totalPaginas = ceil($totalEmprestimos / $emprestimosPorPagina);
								for ($i = 1; $i <= $totalPaginas; $i++) {
									$classeAtiva = ($i === $paginaAtual) ? "active" : "";
									echo "<a class='page-link $classeAtiva' href='emprestimos.php?pagina=$i'>$i</a>";
								}
								echo "</div>";
							} else {
								echo "<p><center>Nenhum empréstimo feito.</center></p>";
							}
						}

						$conn = null; // Fecha a conexão
						?>






					</div>

				</div>

				<footer class="footer">

					© Copyright 2023 por <span>EducaBiblio</span> | Todos os direitos reservados

				</footer>

			</main>
	</section>

</body>

</html>

<script src="../JS/script.js"></script>
<script src="../JS/popup.js"></script>
<script src="../ArquivosExternos/Jquery.js"></script>

<script>
	$(document).ready(function() {
		// Capturar clique no botão de edição
		$('.edit-button').click(function() {
			// Obter o ID do empréstimo da linha correspondente na tabela
			var idEmprestimo = $(this).closest('tr').find('td:eq(2)').text(); // ID do empréstimo na segunda coluna, ajuste conforme a estrutura real da sua tabela

			// Preencher o formulário com o ID do empréstimo
			preencherFormulario(idEmprestimo); // Chama a função para preencher o formulário com o ID do empréstimo

			// Alterar o modo de ação para editar
			$('#modoAcao').val('editar');
			// Alterar o valor do botão para refletir a ação de edição
			$('input[type="submit"]').val('Editar');
			// Modificar o action do formulário para o script responsável pela atualização
			$('form').attr('action', '../router/Atualizar_emprotas.php');
			// Modificar o texto do botão de envio para "Atualizar"
			$('input[type="submit"]').attr('name', 'Editar');
		});
	});

	// Função para preencher o formulário com o ID do empréstimo ao clicar no botão de edição
	function preencherFormulario(idEmprestimo) {
		$('#idEmprestimo').val(idEmprestimo);
	}
</script>

<script>
	$(document).ready(function() {
		function toggleSelects() {
			var turmaId = $("#Turma_idTurma").val();
			var alunoSelect = $("#aluno_idAluno");
			var profSelect = $("#prof_idProf");

			if (turmaId !== null && turmaId !== '') {
				var url = "../Controller/CBuscar_AlunoProf.php";
				var requestData = {
					turmaId: turmaId
				};

				$.ajax({
					type: "GET",
					url: url,
					data: requestData,
					success: function(data) {
						if (turmaId === '0') {
							alunoSelect.hide().html('');
							profSelect.html(data).show();
						} else {
							profSelect.hide().html('');
							alunoSelect.html(data).show();
						}
					},
					error: function() {
						alunoSelect.html("<option value=''>Erro ao carregar alunos</option>").show();
						profSelect.html("<option value=''>Erro ao carregar professores</option>").show();
					}
				});
			} else {
				alunoSelect.show();
				profSelect.hide().html('');
			}
		}

		// Verifica o valor da turma ao carregar a página
		toggleSelects();

		// Ao mudar o valor da turma
		$("#Turma_idTurma").change(function() {
			toggleSelects();
		});
	});
</script>
<script>
	$(document).ready(function() {
		// Função para preencher os livros com base no gênero selecionado
		$("#Genero_idGenero").change(function() {
			var generoId = $(this).val();
			var livroSelect = $("#livro_idLivro");

			if (generoId) {
				$.ajax({
					type: "GET",
					url: "../Controller/CBuscar_livros.php",
					data: {
						generoId: generoId
					},
					success: function(data) {
						livroSelect.html(data);
					},
					error: function() {
						livroSelect.html("<option value=''>Erro ao carregar livros</option>");
					}
				});
			} else {
				livroSelect.html("<option value=''>Selecione um livro</option>");
			}
		});
	});
</script>

<script>
	$('#searchInput').on('keyup', function() {
		const value = $(this).val().toLowerCase();

		$('table tbody tr').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});
</script>
</body>

</html>