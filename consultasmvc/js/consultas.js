function consultar()
{
    var fechain = document.getElementById("fechain").value;
    var fechafin = document.getElementById("fechafin").value;
    var selectCodigo = document.getElementById("selectCodigo").value;
    const http=new XMLHttpRequest();
    const url = 'consultasDiscriminadas.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("div_resultados_consultas").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion="+"consultar"
    +"&fechain="+fechain
    +"&fechafin="+fechafin
    +"&selectCodigo="+selectCodigo
    );
}