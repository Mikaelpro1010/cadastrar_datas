<?php
    include_once "conexao.php";

$query_datas = "SELECT id, nome, data, observação, tipo, cor FROM datas LIMIT 10";
$result_datas = $conn->prepare($query_datas);
$result_datas->execute();

$dados = "";
while($row_data = $result_datas->fetch(PDO::FETCH_ASSOC)){
    extract($row_data);
    $dados .= "<tr>
            <td>$id</td>
            <td>$nome</td>
            <td>$data</td>
            <td>$observação</td>
            <td>$tipo</td>
            <td>$cor</td>
            <td>
            <button id='$id' class='btn btn-primary btn-sm'
            onclick='visData($id)'>Visualizar</button>
            <button id='$id' class='btn btn-warning btn-sm'
            onclick='editData($id)'>Editar</button>
            </td>
            </tr>";
}

echo $dados;