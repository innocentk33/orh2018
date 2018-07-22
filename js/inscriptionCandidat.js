/**
 * Created by DEGNI on 21/01/2018.
 */
function inscription(){
    var obj= new FormData(document.getElementById("formCandidat"));
    //obj.nom=  encodeURIComponent("degni") ;
    //obj.prenom=  encodeURIComponent("jocelin");
    $.ajax({
        type : 'POST',
        url : 'php/inscriptionCandidat.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : afficheModal,
        error : function () {
            $('#msgServeur').html("Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!");
            $('#btnReponse').trigger('click');
            $('#progression').attr('aria-valuenow', 0).css('width', '0%').html('0%');
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

function afficheModal(reponse) {
    var obj = $.parseJSON(JSON.stringify(reponse))
    $('#titre').html(obj.titre);
    $('#msgServeur').html(obj.message);
    $('#erreurInfo').html(obj.erreurInfo);
    $('#btnReponse').trigger('click');// declenchement du modal
    $('#reset').trigger(obj.action);
    $('#progression').attr('aria-valuenow', 0).css('width', '0%').html('0%');


}

$(document).ready(
    $("#formCandidat").submit( function (e) {
        e.preventDefault();
        inscription();

    })



);