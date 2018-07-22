/**
 * Created by DEGNI on 08/02/2018.
 */

function modifParametre(){
    var obj= new FormData(document.getElementById("formParametreAdmin"));
    //obj.nom=  encodeURIComponent("degni") ;
    //obj.prenom=  encodeURIComponent("jocelin");
    $.ajax({
        type : 'POST',
        url : './php/parametre.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : reponse,
        error : function () {
            $('#infoParametre').html("<div class='text-danger'>Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!</div>");
            $('#progression').attr('aria-valuenow', 0).css('width', '0%').html('0%');
            setTimeout(function () {
                $('#infoParametre').html("");
            }, 3000);
        },
        xhr : function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
                if(e.lengthComputable){
                    var pourcentage = Math.round((e.loaded/e.total)*100);
                    $('#progression').attr('aria-valuenow', pourcentage).css('width', pourcentage+'%').html(pourcentage + '%');
                }

            });
            return xhr;
        }
    });

}

function reponse(rep) {
    var obj = $.parseJSON(JSON.stringify(rep));
    $('#infoParametre').html(obj.message);
    $('#progression').attr('aria-valuenow', 0).css('width', '0%').html('0%');
}

$(document).ready(
    $("#formParametreAdmin").submit( function (e) {
        e.preventDefault();
        modifParametre();
    })

);