<!DOCTYPE html>
<html>

<head>
  <title>Starships CRUD</title>
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

    function getStarships()
    {
      global $apiUrl;
      $curl = curl_init($apiUrl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);
      return json_decode($response, true);
    }

    function getStarship($id)
    {
      global $apiUrl;
      $curl = curl_init($apiUrl . '/' . $id);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);
      return json_decode($response, true);
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

    function deleteStarship($id)
    {
      global $apiUrl;
      $curl = curl_init($apiUrl . '/' . $id);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);
      return json_decode($response, true);
    }




    $starships = getStarships();
    echo '<h2>Listagem de Espaçonaves</h2>';

    echo '<table class="table">';
    echo '<tr><th>ID</th><th>Nome</th><th>Modelo</th><th>Fabricante</th><th>Ações</th></tr>';
    foreach ($starships as $starship) {
      echo '<tr>';
      echo '<td>' . $starship['id'] . '</td>';
      echo '<td>' . $starship['name'] . '</td>';
      echo '<td>' . $starship['model'] . '</td>';
      echo '<td>' . $starship['manufacturer'] . '</td>';
      echo '<td>';
      echo '<a href="edit.php?id=' . $starship['id'] . '" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
      echo ' ';
      echo '<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-id="' . $starship['id'] . '"><i class="fas fa-trash"></i></button>';
      echo '</td>';
      echo '</tr>';
    }
    echo '</table>';
    echo '<button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Adicionar</button>';

    ?>
  </div>

  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Deseja realmente excluir essa espaçonave?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a href="#" class="btn btn-danger" id="deleteButton">Excluir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de adição -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Adicionar Espaçonave</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="add.php">
            <div class="form-group">
              <label>Nome:</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Modelo:</label>
              <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Fabricante:</label>
              <input type="text" name="manufacturer" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Adicionar os scripts do Bootstrap e do jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      // Configurar o evento de clique do botão de exclusão
      $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botão que acionou o modal
        var id = button.data('id'); // Extrair o ID da espaçonave
        var deleteButton = $('#deleteButton');
        deleteButton.attr('href', 'delete.php?id=' + id); // Definir o link de exclusão no botão do modal
      });
    });
  </script>
</body>

</html>