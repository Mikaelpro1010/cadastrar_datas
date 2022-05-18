<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo nome!</div>'];
} elseif (empty($dados['entrada_date'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo email!</div>'];
} elseif (empty($dados['tipo'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo tipo data!</div>'];
} elseif (empty($dados['observacao'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo observação!</div>'];
} elseif (empty($dados['cor'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo cor!</div>'];
} 
else{
    $query_datas = "INSERT INTO datas (nome, data, observacao, tipo, cor) VALUES(:nome, :data, :observacao, :tipo, :cor)";
    $cad_data = $conn->prepare($query_datas);
    $cad_data->bindParam(':nome', $dados['nome']);
    $cad_data->bindParam(':data', $dados['entrada_date']);
    $cad_data->bindParam(':observacao', $dados['observacao']);
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