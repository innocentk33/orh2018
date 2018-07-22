/**
 * Created by DEGNI on 31/01/2018.
 */

/**
 * Created by DEGNI on 21/01/2018.
 */
function modification(){ // modification du formulaire " Mes informations"
    var obj= new FormData(document.getElementById("formCandidat"));
    $.ajax({
        type : 'POST',
        url : 'php/modifierCandidat.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : afficheModal,
        error : function () {
            $('#msgServeur').html("Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!");
            $('#btnReponse').trigger('click');
            $('#progressionFormCandidat').attr('aria-valuenow', 0).css('width', '0%').html('0%');
        },
        xhr : function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
                if(e.lengthComputable){
                    var pourcentage = Math.round((e.loaded/e.total)*100);
                    $('#progressionFormCandidat').attr('aria-valuenow', pourcentage).css('width', pourcentage+'%').html(pourcentage + '%');
                }

            });
            return xhr;
        }
    });

}

function modifMDPcandidat() {
    var obj= new FormData(document.getElementById("modifMDPcandidat"));
    $.ajax({
        type : 'POST',
        url : 'php/modifierMdpCandidat.php',
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

function envoyerCV() {
    var obj= new FormData(document.getElementById("formEnvoyerCV"));
    $.ajax({
        type : 'POST',
        url : 'php/envoyerCV.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : afficheModal,
        error : function () {
            $('#msgServeur').html("Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!");
            $('#btnReponse').trigger('click');
            $('#progressionEnvoyerCV').attr('aria-valuenow', 0).css('width', '0%').html('0%');
        },
        xhr : function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
                if(e.lengthComputable){
                    var pourcentage = Math.round((e.loaded/e.total)*100);
                    $('#progressionEnvoyerCV').attr('aria-valuenow', pourcentage).css('width', pourcentage+'%').html(pourcentage + '%');
                }

            });
            return xhr;
        }

    });

}

function modifierPhoto() {
    var obj= new FormData(document.getElementById("formPhotoCandidat"));
    $.ajax({
        type : 'POST',
        url : 'php/modifierPhotoCandidat.php',
        data : obj,
        cache : false,
        dataType : 'json',
        processData: false,
        contentType: false,
        success : afficheModal,
        error : function () {
            $('#msgServeur').html("Une erreur de connexion s'est produite. <br>Veuillez svp ressayer!");
            $('#btnReponse').trigger('click');
            $('#progressionFormPhotoCandidat').attr('aria-valuenow', 0).css('width', '0%').html('0%');
        },
        xhr : function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
                if(e.lengthComputable){
                    var pourcentage = Math.round((e.loaded/e.total)*100);
                    $('#progressionFormPhotoCandidat').attr('aria-valuenow', pourcentage).css('width', pourcentage+'%').html(pourcentage + '%');
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
    $('#resetMdp').trigger(obj.action); // exclisivement pour modification de mot de passe
    $('#progressionFormCandidat').attr('aria-valuenow', 0).css('width', '0%').html('0%');
    $('#progressionEnvoyerCV').attr('aria-valuenow', 0).css('width', '0%').html('0%');
    $('#progressionFormPhotoCandidat').attr('aria-valuenow', 0).css('width', '0%').html('0%');
    if(obj.lien != ""){
        setTimeout(function () {
            window.location.reload();
        },2000);
    }

}



$(document).ready(
    $("#formCandidat").submit( function (e) {
        e.preventDefault();
        modification();

    }),
    $("#modifMDPcandidat").submit( function (e) {
        e.preventDefault();
        modifMDPcandidat();

    }),
    $("#formEnvoyerCV").submit( function (e) {
        e.preventDefault();
        envoyerCV();

    }),
    $("#formPhotoCandidat").submit( function (e) {
        e.preventDefault();
        modifierPhoto();

    })


);
