<?php

require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);
if ($method === 'get') {

	$sql = $pdo->query("SELECT 
								pe.pedido AS PEDIDO,
								sa.nome AS PIZZA,
								ta.descricao AS TAMANHO,
								ma.descricao AS MASSA,
								bo.descricao AS BORDA,
								st.DESCRICAO AS STATUS,
								be.descricao AS BEBIDA,
								pe.VALOR AS VALOR,
								concat(us.nome, ' ', us.sobrenome) AS USUARIO
						FROM pedido as pe
						JOIN pizza as pi ON PI.pizza = pe.pizza
						JOIN tamanho AS ta ON ta.TAMANHO = PI.tamanho
						JOIN massa AS ma ON ma.massa = PI.massa
						JOIN borda AS bo ON bo.borda = PI.borda
						JOIN sabor AS sa ON sa.sabor = PI.sabor
						JOIN status AS st ON st.status = pe.status
						JOIN bebida AS be ON be.bebida = pe.bebida
						JOIN usuario AS us ON us.usuario = pe.usuario
						ORDER BY pe.pedido");
	if ($sql) {
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $item) {
			$array['result'][] = [
				'pedido' => $item['PEDIDO'],
				'pizza' => $item['PIZZA'],
				'tamanho' => $item['TAMANHO'],
				'massa' => $item['MASSA'],
				'borda' => $item['BORDA'],
				'status' => $item['STATUS'],
				'bebida' => $item['BEBIDA'],
				'valor' => $item['VALOR'],
				'usuario' => $item['USUARIO']
			];
		}
	}
} else {
	$array['error'] = 'Método não permitido (Apenas GET)';
}

require('../return.php');
