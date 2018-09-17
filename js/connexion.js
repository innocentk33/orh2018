/**
 * Created by DEGNI on 25/01/2018.
 */
function connexionCandidat(){
    var obj= new FormData(document.getElementById("FormConnexionCandidat"));
    $.ajax({
        type : 'POST',
        url : 'php/connexionCandidat.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : redirigerCnd,
        error : function () {
            $('#reponseConCnd').html("<div class='text-danger'>Impossible de se connecter.<br>Verifier votre connexion.</div> ");
            setTimeout(function () {
                $('#reponseConCnd').html("");
            }, 3000);
        }
    });

}

function connexionCandidatAux(){
    var obj= new FormData(document.getElementById("connexionCandidat"));
    $.ajax({
        type : 'POST',
        url : 'php/connexionCandidat.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : redirigerCnd,
        error : function () {
            alert("Echec de Connxion !");
        }
    });

}

function connexionEntreprise(){
    var obj= new FormData(document.getElementById("FormConnexionEntreprise"));
    $.ajax({
        type : 'POST',
        url : 'php/connexionEntreprise.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : redirigerEnt,
        error : function () {
            $('#reponseConEnt').html("<div class='text-danger'>Impossible de se connecter.<br>Verifier votre connexion.</div> ");
            setTimeout(function () {
                $('#reponseConEnt').html("");
            }, 3000);
        }
    });

}

function connexionEntrepriseAux(){
    var obj= new FormData(document.getElementById("connexionEntreprise"));
    $.ajax({
        type : 'POST',
        url : 'php/connexionEntreprise.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : redirigerEnt,
        error : function () {
            alert("Echec de Connxion !");
        }
    });

}

function redirigerCnd(reponse) {
    var obj = $.parseJSON(JSON.stringify(reponse));
    $('#reponseConCnd').html(obj.message);

        setTimeout(function () {
            $('#reponseConCnd').html("");
            if(obj.lien != ""){
            window.location.href= obj.lien;
            }
        }, 3000);



}

function redirigerEnt(reponse) {
    var obj = $.parseJSON(JSON.stringify(reponse))
    $('#reponseConEnt').html(obj.message);
    setTimeout(function () {
        $('#reponseConEnt').html("");
        if(obj.lien != ""){
            window.location.href= obj.lien;
        }
    }, 3000);

}

$(document).ready(
    $("#FormConnexionCandidat").submit( function (e) {
        e.preventDefault();
        connexionCandidat();

    }),
    $("#FormConnexionEntreprise").submit( function (e) {
        e.preventDefault();
        connexionEntreprise();

    }),
    $("#connexionCandidat").submit( function (e) {
        e.preventDefault();
        connexionCandidatAux();

    }),
    $("#connexionEntreprise").submit( function (e) {
        e.preventDefault();
        connexionEntrepriseAux();

    })

);