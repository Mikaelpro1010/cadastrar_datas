<?php
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)){
    $query_datas = "SELECT id, nome, data, observação, tipo, cor FROM datas WHERE id =:id LIMIT 1";
    $result_datas = $conn->prepare($query_datas);
    $result_datas->bindParam(':id', $id);
    $result_datas->execute();

    $row_data = $result_datas->fetch(PDO::FETCH_ASSOC);

    
    $retorna = ['erro' => false, 'dados'=>$row_data];

}else{
    $retorna = ['erro' => true, 'msg'=> "<div class='alert alert-danger
    role='alert'>Erro: Nenhum usuário encontrado!</div"];
}

echo json_encode($retorna);
