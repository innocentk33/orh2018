/**
 * Created by DEGNI on 03/02/2018.
 */
/**
 * Created by DEGNI on 31/01/2018.
 */

/**
 * Created by DEGNI on 21/01/2018.
 */
function modification(){ // modification du formulaire "INFORMATIONS SUR VOTRE ENTREPRISE"
    var obj= new FormData(document.getElementById("formEntreprise"));
    $.ajax({
        type : 'POST',
        url : 'php/modifierEntreprise.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : afficheModal,
        error : function () {
            $('#msgServeur').html("Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!");
            $('#btnReponse').trigger('click');
            $('#progressionFormEntreprise').attr('aria-valuenow', 0).css('width', '0%').html('0%');
        },
        xhr : function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
                if(e.lengthComputable){
                    var pourcentage = Math.round((e.loaded/e.total)*100);
                    $('#progressionFormEntreprise').attr('aria-valuenow', pourcentage).css('width', pourcentage+'%').html(pourcentage + '%');
                }

            });
            return xhr;
        }
    });

}

function modifMDPentreprise() {
    var obj= new FormData(document.getElementById("modifMdpEntreprise"));
    $.ajax({
        type : 'POST',
        url : 'php/modifierMdpEntreprise.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : afficheModal,
        error : function () {
            $('#msgServeur').html("Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!");
            $('#btnReponse').trigger('click');
        }
    });


}





function afficheModal(reponse) {
    var obj = $.parseJSON(JSON.stringify(reponse))
    $('#titre').html(obj.titre);
    $('#msgServeur').html(obj.message);
    $('#erreurInfo').html(obj.erreurInfo);
    $('#btnReponse').trigger('click');// declenchement du modal
    $('#resetMdp').trigger(obj.action); // exclisivement pour modification de mot de passe
    $('#progressionFormEntreprise').attr('aria-valuenow', 0).css('width', '0%').html('0%');
    $('#progressionEnvoyerCV').attr('aria-valuenow', 0).css('width', '0%').html('0%');
    $('#progressionFormPhotoCandidat').attr('aria-valuenow', 0).css('width', '0%').html('0%');
    if(obj.lien != ""){
        setTimeout(function () {
            window.location.reload();
        },2000);
    }

}



$(document).ready(
    $("#modifMdpEntreprise").submit( function (e) {
        e.preventDefault();
        modifMDPentreprise();

    }),
    $("#formEntreprise").submit( function (e) {
        e.preventDefault();
        modification();

    })

);
