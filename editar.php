<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Tente mais tarde!</div>'];
}elseif (empty($dados['edit_nome'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo nome!</div>'];
}elseif (empty($dados['edit_data'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo email!</div>'];
}elseif (empty($dados['edit_observacao'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo sexo!</div>'];
}elseif (empty($dados['edit_tipo'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo idade!</div>'];
} elseif (empty($dados['edit_cor'])){
    $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo idade!</div>'];
} else{
    $query_datas = "UPDATE datas SET nome=:nome, data=:data, observacao=:observacao, tipo=:tipo, cor=:cor WHERE id=:id";
    $edit_datas = $conn->prepare($query_datas);
    $edit_datas->bindParam(':nome', $dados['edit_nome']);
    $edit_datas->bindParam(':data', $dados['edit_data']);
    $edit_datas->bindParam(':observacao', $dados['edit_observacao']);
    $edit_datas->bindParam(':tipo', $dados['edit_tipo']);
    $edit_datas->bindParam(':cor', $dados['edit_cor']);

    if ($edit_datas->execute()) {
        $retorna = ['erro' => false, 'msg' => '<div class="alert alert-success" role="alert">Usuário editado com sucesso!</div>'];
    } else {
        $retorna = ['erro' => true, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Usuário não editado com sucesso!</div>'];
    }
}

echo json_encode($retorna);