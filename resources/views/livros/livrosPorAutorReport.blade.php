<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Livros</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Livros styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.livros-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.livros-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.livros-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.livros-box table tr td:nth-child(2) {
				text-align: right;
			}

			.livros-box table tr.top table td {
				padding-bottom: 20px;
			}

			.livros-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.livros-box table tr.information table td {
				padding-bottom: 40px;
			}

			.livros-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.livros-box table tr.details td {
				padding-bottom: 20px;
			}

			.livros-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.livros-box table tr.item.last td {
				border-bottom: none;
			}

			.livros-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.livros-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.livros-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<h1>Relatório de livros</h1>
		<h3>Agrupados por autor</h3>

		<div class="livros-box">
			<table>
                @if( count($autores) == 0 )
                    <tr>
						<td colspan="2">Nenhum autor encontrado</td>
					</tr>
                @endif
                @foreach ($autores as $autor)
					<tr class="heading">
						@if ( count($autor['Livros']) )
							<td>Autor: {{ $autor['Nome'] }}</td>

                            <td>Valor</td>
						@else
							<td  colspan="2">Autor: {{ $autor['Nome'] }} - Não possui livros cadastrados</td>
						@endif
					</tr>
					@foreach ($autor['Livros'] as $livro)
						@php($assuntos = '')
						@for ($i = 0; $i < count($livro['Assuntos']); $i++)
							@if( $i +1 != count($livro['Assuntos']))
								@php($assuntos .= $livro['Assuntos'][$i].', ')
							@else
								@php($assuntos .= $livro['Assuntos'][$i]))
							@endif
						@endfor
						<tr class="item">
                            <td>
								<div>
									<div>
										<span style="font-weight: bolder;font-size: 18px;">{{ $livro['Titulo'] }}</span>
									</div>
									<div>
										<div>
											{{ $livro['Editora'] }}, Edição: {{$livro['Edicao']}}, {{$livro['AnoPublicacao']}}
										</div>
									</div>
									@if( strlen($assuntos) )
										<div>
											<span>Assuntos: {{ $assuntos }}</span>
										</div>
									@endif
								</div>
							</td>
                            <td style="vertical-align: middle;">
								<span>R${{ number_format($livro['Valor'], 2, ',', '.') }}</span>
							</td>
                        </tr>
					@endforeach
				@endforeach
			</table>
		</div>
	</body>
</html>
