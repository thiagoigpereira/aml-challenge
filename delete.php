<?php
$apiUrl = 'http://localhost:3000/spaceships';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deletedStarship = deleteStarship($id);

    header('Location: index.php');
    exit;

}

header('Location: index.php');
exit;

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
