<?php

require('../config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']);

$data = file_get_contents("php://input");
$decode_data = json_decode($data, true);

$pedido = $decode_data['pedido'];

// $sql = $pdo->prepare("DELETE FROM pedido WHERE pedido = :pedido");
// $sql->bindValue(':pedido', $pedido);
// $sql->execute();

$sql = $pdo->prepare("DELETE 
						pedido, 
						pizza 
					FROM pedido
					LEFT JOIN pizza ON pizza.pizza = pedido.pizza
					WHERE pedido.pedido = :pedido");
$sql->bindValue(':pedido', $pedido);
$sql->execute();

require('../return.php');
