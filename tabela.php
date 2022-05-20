<?php
include_once "conexao.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {
    //Calcular o inicio visualização
    $qnt_result_pg = 5; //Quant. de registro por pagina
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    // $query_usuarios = "SELECT * FROM usuarios LIMIT 10";
    $query_datas = "SELECT * FROM datas ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
    $result_datas = $conn->prepare($query_datas);
    $result_datas->execute();
    $dados = "<div class = 'table-responsive'>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>ID</th>
            <th>nome</th>
            <th>data</th>
            <th>observacao</th>
            <th>tipo</th> 
            <th>cor</th>       
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>";

    while ($row_data = $result_datas->fetch(PDO::FETCH_ASSOC)) {
        extract($row_data);
        $dados .= "<tr>
                <td>$id</td>
                <td>$nome</td>
                <td>$data</td>
                <td>$observacao</td>
                <td>$tipo</td>
                <td>$cor</td>
                <td>
                <button id='$id' class='btn btn-primary btn-sm'
                onclick='visData($id)'>Visualizar</button>
                <button id='$id' class='btn btn-warning btn-sm'
                onclick='editData($id)'>Editar</button>
                <button id='$id' class='btn btn-danger btn-sm'
                onclick='abrirModal($id)'>Apagar</button>
                </td>
                </tr>";
    }
    $dados .= "</tbody>
                </table>
            </div>";

    //Paginação - Somar a Qauntidade de Usuários
    $query_pg = "SELECT COUNT(id) AS num_result FROM datas";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    //Quantidade de pagina
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    $max_links = 2;
    $dados .= '<td colspan= "7">';
    $dados .=  '<nav aria-label="Page navigation example"><ul class="mx-auto pagination justify-content-center">';
    $dados .= "<li class='page-item'><a class='page-link' onclick= 'listarDatas(1)' href='#'>Primeira página</a></li>";
    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            $dados .= "<li class='page-item'><a class='page-link' onclick='listarDatas($pag_ant)' href='#'>$pag_ant</a></li>";
        }
    }

    $dados .= "<li class='page-item'><a class='page-link text-white bg-primary' href='#'>$pagina</a></li>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            $dados .= "<li class='page-item'><a class='page-link'  onclick='listarDatas($pag_dep)' href='#'>$pag_dep</a></li>";
        }
    }
    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick= 'listarDatas($quantidade_pg)''>Última pagina</a></li>";
    $dados .= '</ul></nav></td>';

    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>";
}

//$query_datas = "SELECT id, nome, data, observacao, tipo, cor FROM datas LIMIT 20";
//$result_datas = $conn->prepare($query_datas);
//$result_datas->execute();