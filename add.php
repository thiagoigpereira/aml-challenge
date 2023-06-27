<?php
$apiUrl = 'http://localhost:3000/spaceships';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $starship = [
    'name' => $_POST['name'],
    'model' => $_POST['model'],
    'manufacturer' => $_POST['manufacturer']
  ];

  $addedStarship = addStarship($starship);

  if ($addedStarship) {
    header('Location: index.php');
    exit;
  } else {
    echo 'Ocorreu um erro ao adicionar a espaçonave.';
    echo '<br><a href="index.php">Voltar para a listagem</a>';
    exit;
  }
}

function addStarship($starship)
{
  global $apiUrl;
  $curl = curl_init($apiUrl);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($starship));
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);
  return json_decode($response, true);
}
?>
