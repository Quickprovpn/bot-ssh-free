<?php

error_reporting(0);
function puxarstring($string, $start, $end) {
		
	$str = explode($start, $string);
	$str = explode($end, $str[1]);
	return $str[0];
}
//Formato do Request
$formato = $_GET['lista'];
$CPF = explode("|", $formato)[0];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.juventudeweb.mte.gov.br/pnpepesquisas.asp');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml, application/x-www-form-urlencoded;charset=ISO-8859-1, text/xml; charset=ISO-8859-1','Cookie: ASPSESSIONIDSCCRRTSA=NGOIJMMDEIMAPDACNIEDFBID; FGTServer=2A56DE837DA99704910F47A454B42D1A8CCF150E0874FDE491A399A5EF5657BC0CF03A1EEB1C685B4C118A83F971F6198A78','Host: www.juventudeweb.mte.gov.br']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'acao=consultar%20cpf&cpf='.$CPF.'&nocache=0.7636039437638835');
$result = curl_exec($ch);
	
//CPF
$CPF = puxarstring($result, 'NRCPF="','"');

//NOME
$NOPESSOAFISICA = puxarstring($result, 'NOPESSOAFISICA="','"');

//NOME DA MÃE
$NOMAE = puxarstring($result, 'NOMAE="','"');

//DATA DE NASCIMENTO
$DTNASCIMENTO = puxarstring($result, 'DTNASCIMENTO="','"');	
$DTNASCIMENTO = explode('/', $DTNASCIMENTO);
$DTNASCIMENTO = $DTNASCIMENTO[0] . '/' . $DTNASCIMENTO[1] . '/' . $DTNASCIMENTO[2];



//LORGADOURO
$NOLOGRADOURO = puxarstring($result, 'NOLOGRADOURO="','"');

//NÚMERO DA CASA
$NUMERO = puxarstring($result, 'NRLOGRADOURO="','"');

//COMPLEMENTO
$DSCOMPLEMENTO = puxarstring($result, 'DSCOMPLEMENTO="','"');
if(empty($DSCOMPLEMENTO)) {
	$DSCOMPLEMENTO = 'Não Encontrado';
} else {
	$DSCOMPLEMENTO;
}

//BAIRRO
$NOBAIRRO = puxarstring($result, 'NOBAIRRO="','"');

//CEP
$NRCEP = puxarstring($result, 'NRCEP="','"');

//CIDADE
$NOMUNICIPIO = puxarstring($result, 'NOMUNICIPIO="','"');

//UF
$SGUF = puxarstring($result, 'SGUF="','"');

echo $consulta_cpf_1 = 'Nome: ' . $NOPESSOAFISICA . '<bR>CPF: ' . $CPF . '<bR> Data de Nascimento: ' . $DTNASCIMENTO . '<bR> Nome da Mãe: ' . $NOMAE . '<bR> Endereço: ' . $NOLOGRADOURO . '<bR> Numero: ' . $NUMERO . '<bR> Complemento: ' . $DSCOMPLEMENTO . '<bR> Bairro: ' . $NOBAIRRO . '<bR> CEP: ' . $NRCEP . '<bR> UF: ' . $SGUF . '<bR> Cidade: ' . $NOMUNICIPIO;

$texto = "$consulta_cpf_1";
$data = [];

$date = preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $texto,$data);

$data_con = date("Y-m-d" , strtotime($data[0]));



//http://localhost/www/Auxilio/teste.php?lista=93421664749