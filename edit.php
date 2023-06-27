<!DOCTYPE html>
<html>

<head>
  <title>Editar Espaçonave</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .container {
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    $apiUrl = 'http://localhost:3000/spaceships';

    function getStarship($id)
    {
      global $apiUrl;
      $curl = curl_init($apiUrl . '/' . $id);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);
      return json_decode($response, true);
    }

    function updateStarship($id, $starship)
    {
      global $apiUrl;
      $curl = curl_init($apiUrl . '/' . $id);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($starship));
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);
      return json_decode($response, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $id = $_GET['id'];
      $starship = getStarship($id);

      if (!$starship) {
        echo '<h2>Espaçonave não encontrada</h2>';
        echo '<a href="index.php" class="btn btn-primary">Voltar</a>';
        exit();
      }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $starship = array(
        'name' => $_POST['name'],
        'model' => $_POST['model'],
        'manufacturer' => $_POST['manufacturer']
      );
      $updatedStarship = updateStarship($id, $starship);

      if (!$updatedStarship) {
        echo '<h2>Falha ao atualizar a espaçonave</h2>';
        echo '<a href="index.php" class="btn btn-primary">Voltar</a>';
        exit();
      }

      header('Location: index.php');
      exit();
    }
    ?>

    <h2>Editar Espaçonave</h2>
    <form method="POST" action="edit.php">
      <input type="hidden" name="id" value="<?php echo $starship['id']; ?>">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $starship['name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="model">Modelo:</label>
        <input type="text" class="form-control" id="model" name="model" value="<?php echo $starship['model']; ?>" required>
      </div>
      <div class="form-group">
        <label for="manufacturer">Fabricante:</label>
        <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?php echo $starship['manufacturer']; ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Atualizar</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>