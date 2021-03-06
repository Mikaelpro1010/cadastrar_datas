let number = document.getElementById("entrada_date").value;
const Form = document.getElementById("cad-data-form");
const editForm = document.getElementById("edit-data-form");
const cadModal = new bootstrap.Modal(document.getElementById("cadDataModal"));
const apagaModal = new bootstrap.Modal(document.getElementById("apagarDataModal"));
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const editModal = new bootstrap.Modal(document.getElementById("editDataModal"));

const tbody = document.querySelector("tbody");
const tabela = document.getElementById("tabela");

const listarDatas = async (pagina) => {
    const dados = await fetch("./tabela.php?pagina="+pagina);
    const resposta = await dados.text();
    tabela.innerHTML = resposta;
}

listarDatas(1);

Form.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-data-btn").value = "Salvando...";

    if (document.getElementById("nome").value === "") {
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo nome 1!</div>';
    } else if (document.getElementById("entrada_date").value === "") {
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo data 1!</div>';
    } else if (document.getElementById("observacao").value === "") {
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo observação 1!</div>';
    } else if (document.getElementById("tipo").value === "") {
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo tipo de data 1!</div>';
    } else if (document.getElementById("cor").value === "") {
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo cor 1!</div>';
    } else {
        const dadosForm = new FormData(Form);
        dadosForm.append("add", 1);

        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm,
        })

        const resposta = await dados.json();
        if (resposta['erro']) {
            msgAlertaErroCad.innerHTML = resposta['msg'];
        } else {
            msgAlerta.innerHTML = resposta['msg'];
            Form.reset();
            cadModal.hide();
            listarDatas(1);
        }
    }

    document.getElementById("cad-data-btn").value = "Cadastrar";
});

async function visData(id) {
    const dados = await fetch('visualizar.php?id= ' + id);
    const resposta = await dados.json();
    console.log(resposta)

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visDataModal"));
        visModal.show();

        document.getElementById("idData").innerHTML = resposta['dados'].id;
        document.getElementById("nomeData").innerHTML = resposta['dados'].nome;
        document.getElementById("dataData").innerHTML = resposta['dados'].data;
        document.getElementById("observacaoData").innerHTML = resposta['dados'].observacao;
        document.getElementById("tipos_de_dataData").innerHTML = resposta['dados'].tipo;
        document.getElementById("corData").innerHTML = resposta['dados'].cor;

    }
}

async function editData(id) {

    msgAlertaErroEdit.innerHTML= "";

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editDataModal"));
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("edit_nome").value = resposta['dados'].nome;
        document.getElementById("edit_data").value = resposta['dados'].data;
        document.getElementById("edit_observacao").value = resposta['dados'].observacao;
        document.getElementById("edit_tipo").value = resposta['dados'].tipo;
        document.getElementById("edit_cor").value = resposta['dados'].cor;

    }
}

editForm.addEventListener("submit", async (e) =>{
    e.preventDefault();

    document.getElementById("edit-data-btn").value = "Salvando...";

    const dadosForm = new FormData(editForm);

    const dados = await fetch("editar.php",{
        method: "POST",
        body:dadosForm
    });

    const resposta = await dados.json();

    if(resposta['erro']){
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    } else{
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        listarDatas(1);
        editModal.hide();
        console.log(editModal);
    }
    document.getElementById("edit-data-btn").value = "Salvar";
});

async function apagarData(){
    const id = document.getElementById("apagarid").value;

    console.log(id);

    const dados = await fetch('apagar.php?id=' +id);

    listarDatas(1);

    apagaModal.hide();
}

function abrirModal(id){
    document.getElementById("apagarid").value = id;
    apagaModal.show();
}

//function fecharModal(){
    //const editModal = new bootstrap.Modal(document.getElementById("editDataModal"));
    //editModal.hide();


