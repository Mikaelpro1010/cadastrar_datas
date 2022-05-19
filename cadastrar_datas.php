<?php
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Cadastrar datas</title>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-itens-center">
                <h4>Datas Cadastradas</h4>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadDataModal">
                    Cadastrar datas
                </button>
            </div>
            <hr>
            <span id="msgAlerta"></span>
        </div>
        <div class="row">
            <div class="table-reponsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Observação</th>
                            <th>Tipo de data</th>
                            <th>Cor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="cadDataModal" tabindex="-1" aria-labelledby="#cadDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadDataModalLabel">Cadastro de data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="cad-data-form">
                            <span id="msgAlertaErroCad"></span>
                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" name="nome" class="form-control" id="nome" placeholder="Informe seu nome completo">
                            </div>
                            <div class="mb-3">
                                <label for="data" class="col-form-label">Data:</label>
                                <input type="date" name="entrada_date" id="entrada_date">
                            </div>
                            <div class="mb-3">
                                <label for="observacao" class="col-form-label">Observação:</label>
                                <input type="text" name="observacao" class="form-control" id="observacao" placeholder="Informe a sua idade">
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="col-form-label">Tipo de data:</label>
                                <input type="text" name="tipo" class="form-control" id="tipo" placeholder="Informe o tipo de data">
                            </div>
                            <p>Selecione a cor como legenda para a data:</p>
                            <div>
                                <input type="color" id="cor" name="cor" value="#e66465">
                                <label for="cor">Palheta de cores</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-success btn-sm" id="cad-data-btn" value="Cadastrar" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="visDataModal" tabindex="-1" aria-labelledby="#visDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="visDataModalLabel">Detalhes da data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgAlertaErroVis"></span>
                        <dl class="row">
                            <dt class="col-sm-3">ID</dt>
                            <dd class="col-sm-9"><span id="idData"></span></dd>

                            <dt class="col-sm-3">Nome</dt>
                            <dd class="col-sm-9"><span id="nomeData"></span></dd>

                            <dt class="col-sm-3">Data</dt>
                            <dd class="col-sm-9"><span id="dataData"></span></dd>

                            <dt class="col-sm-3">Observação</dt>
                            <dd class="col-sm-9"><span id="observacaoData"></span></dd>

                            <dt class="col-sm-3">Tipos de data</dt>
                            <dd class="col-sm-9"><span id="tipos_de_dataData"></span></dd>

                            <dt class="col-sm-3">Cor</dt>
                            <dd class="col-sm-9"><span id="corData"></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="#editDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataModalLabel">Alterar informações sobre a data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-data-form">
                            <span id="msgAlertaErroEdit"></span>

                            <input type="hidden" name="editid" id="editid">

                            <div class="mb-3">
                                <label for="nome" class="col-form-label">Nome:</label>
                                <input type="text" name="edit_nome" class="form-control" id="edit_nome" placeholder="Informe seu nome completo">
                            </div>
                            <div class="mb-3">
                                <label for="data" class="col-form-label">Data:</label>
                                <input type="date" name="edit_data" id="edit_data">
                            </div>
                            <div class="mb-3">
                                <label for="observacao" class="col-form-label">Observação:</label>
                                <input type="text" name="edit_observacao" class="form-control" id="edit_observacao" placeholder="Informe a sua idade">
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="col-form-label">Tipo de data:</label>
                                <input type="text" name="edit_tipo" class="form-control" id="edit_tipo" placeholder="Informe o tipo de data">
                            </div>
                            <div class="mb-3">
                                <label for="cor" class="col-form-label">Cor:</label>
                                <input type="text" name="edit_cor" class="form-control" id="edit_cor" placeholder="Informe o tipo de data">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-success btn-sm" id="edit-data-btn" value="Salvar" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="apagarDataModal" tabindex="-1" aria-labelledby="#apagarDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="apagarDataModalLabel">Tem certeza que deseja apagar a data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <span id="msgAlertaErroEdit"></span>

                    <div class="modal-footer">
                        <input type="hidden" name="apagarid" id="apagarid">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-success btn-sm" id="edit-data-btn" onclick= "apagarData()" value="Apagar" />
                    </div>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="js/custom.js"></script>
</body>

</html>