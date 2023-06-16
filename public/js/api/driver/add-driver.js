/// *****************************
/// DEFINE GLOBAL VARIABLES
/// *****************************
/// *****************************
/// CALL YOUR FUNCTIONS
/// *****************************
$(document).ready(function () {
    $("button.btn-add").click(addDriver);
});
/// *****************************
/// DEFINE YOUR FUNCTIONS
/// *****************************
/**
 * Add new driver
 * @param {Event} e Information about the event
 */
const addDriver = async (e) => {
    e.preventDefault();
    let action = $(e.target).data(`action`);
    if (action == "add") {
        let nom = $("input#nom").val();
        let prenom = $("input#prenom").val();
        let cin = $("input#cin").val();
        let date_naissance = $("input#date-naissance").val();
        let adress = $("input#adress").val();
        let tel = $("input#tel").val();
        let date_embauche = $("input#date-embauche").val();
        let salaire = $("input#salaire").val();
        let gender = $("select#gender").val();
        let description = $("textarea#description").val();
        // TODO: add logic for avatar ...
        let dataToSend = {
            "nom": nom,
            "prenom": prenom,
            "cin": cin,
            "date_naissance": date_naissance,
            "adress": adress,
            "tel": tel,
            "gender": gender,
            "description": description,
            "date_embauche": date_embauche,
            "salaire": salaire,
            // add avatar param ....
        }
        addData("drivers", dataToSend, showDialogResponse);
    }
}
