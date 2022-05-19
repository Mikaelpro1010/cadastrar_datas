<?php
include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)){
    $query_datas = "DELETE FROM datas WHERE id=:id";
    $result_datas = $conn->prepare($query_datas);
    $result_datas->bindParam(':id', $id);
    
    if($result_datas->execute()){
        $retorna = ['erro' => false, 'msg'=> "<div class='alert alert-success
        role='alert'>Data apagado com sucesso!</div>"];
    } else{
        $retorna = ['erro' => true, 'msg'=> "<div class='alert alert-danger
        role='alert'>Erro: Data não apagado com sucesso!</div>"];
    } 
} else{
    $retorna = ['erro' => true, 'msg'=> "<div class='alert alert-danger
    role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}

echo json_encode($retorna);