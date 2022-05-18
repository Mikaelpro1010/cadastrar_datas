let number = document.getElementById('entrada_date').value;
const Form = document.getElementById("cad-data-form");
const cadModal = new bootstrap.Modal(document.getElementById("cadDataModal"));

const tbody = document.querySelector("tbody");

const listarDatas = async () => {
    const dados = await fetch("./tabela.php");
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarDatas();

Form.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-data-btn").value = "Salvando...";

    if(document.getElementById("nome").value === ""){
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo nome 1!</div>';
    } else if(document.getElementById("data").value === ""){
        msgAlertaErroCad.innerHTML = '<div class="alert alert-danger" role="alert">Erro: Necessário preencher o campo email 1!</div>';
    } else {
        const dadosForm = new FormData(Form);
        dadosForm.append("add", 1);

        const dados = await fetch("cadastrar.php",{
        method: "POST",
        body: dadosForm,
    })

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlertaErroCad.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            Form.reset();
            cadModal.hide();
            listarDatas(1);
        }
    }

    document.getElementById("cad-data-btn").value = "Cadastrar";
});

async function visData(id){
    const dados = await fetch('visualizar.php?id= '+id);
    const resposta = await dados.json();
    console.log(resposta)

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    }else{
        const visModal = new bootstrap.Modal(document.getElementById("visDataModal"));
        visModal.show();

        document.getElementById("idData").innerHTML = resposta['dados'].id;
        document.getElementById("nomeData").innerHTML = resposta['dados'].nome;
        document.getElementById("dataData").innerHTML = resposta['dados'].data;
        document.getElementById("observaçãoData").innerHTML = resposta['dados'].observação;
        document.getElementById("tipos_de_dataData").innerHTML = resposta['dados'].tipo;
        document.getElementById("corData").innerHTML = resposta['dados'].cor;

    }
}

async function editData(id){
    const dados = await fetch('visualizar.php?id='+id);
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else{
        const editModal = new bootstrap.Modal(document.getElementById("editDataModal"));
        editModal.show();
        document.getElementById("edit_id").innerHTML = resposta['dados'].id;
        document.getElementById("edit_nome").innerHTML = resposta['dados'].nome;
        document.getElementById("edit_data").innerHTML = resposta['dados'].data;
        document.getElementById("edit_bservação").innerHTML = resposta['dados'].observação;
        document.getElementById("edit_tipo").innerHTML = resposta['dados'].tipo;
        document.getElementById("edit_cor").innerHTML = resposta['dados'].cor;

    }
}