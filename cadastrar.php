<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo nome!</div>'];
} 
elseif (empty($dados['data'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo email!</div>'];
} 
else{
    $query_datas = "INSERT INTO data (nome, data, observação, tipo, cor) VALUES(:nome, :data, :observação, :tipo, :cor)";
    $cad_data = $conn->prepare($query_usuario);
    $cad_data->bindParam(':nome', $dados['nome']);
    $cad_data->bindParam(':data', $dados['data']);
    $cad_data->bindParam(':observação', $dados['observação']);
    $cad_data->bindParam(':tipo', $dados['tipo']);
    $cad_data->bindParam(':cor', $dados['cor']);
    $cad_data->execute();

    if ($cad_data->rowCount()) {
        $retorna = ['erro' => false, 'msg' => '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>'];
    } else {
        $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Usuário não cadastrado com sucesso!</div>'];
    }
}

echo json_encode($retorna);