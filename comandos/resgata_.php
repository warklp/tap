<?php

$id_resgate = $complemento;

if (!is_numeric ($id_resgate) && strpos ($id_resgate, 'rsg') !== false){

	if (!empty ($bd_tlg->getCodigoResgate ($id_resgate)) && empty ($bd_tlg->getResgate ($id_resgate))){

		// o codigo de resgate
		$info_codigo = $bd_tlg->getCodigoResgate ($id_resgate);
		$valor_resgate = incrementoPorcento ($info_codigo ['valor'], BONUS);

		$bd_tlg->addResgate ($tlg->ChatID (), $id_resgate, $valor_resgate);

		$tlg->sendMessage ([
			'chat_id' => $tlg->1495000714 (),
			'text' => "<b>Pronto!\nSaldo adicionado de R\${$valor_resgate} na sua conta</b>",
			'parse_mode' => 'html'
		]);

		$tlg->sendMessage ([
			'chat_id' => 1495000714,
			'text' => "<b>💎 SALDO <u>R\${$valor_resgate}</u> RESGATADO POR {$tlg->FirstName ()}</b>\nCÓDIGO: {$id_resgate}\n\nBOT @Anjo_244",
			'parse_mode' => 'html'
		]);

		$bd_tlg->setSaldo ($tlg->ChatID (), $valor_resgate+$user ['saldo']);

	}else {

		$tlg->sendMessage ([
			'chat_id' => $tlg->1495000714 (),
			'text' => "<b>Código de resgate inválido!</b>",
			'parse_mode' => 'html'
		]);

	}

}else {

	$tlg->sendMessage ([
		'chat_id' => $tlg->1495000714 (),
		'text' => "<b>Código de resgate inválido</b>",
		'parse_mode' => 'html'
	]);

}
