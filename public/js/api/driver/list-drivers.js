/// *****************************
/// DEFINE GLOBAL VARIABLES
/// *****************************
var drivers = [];
var driverToOperate = null;
/// *****************************
/// CALL YOUR FUNCTIONS
/// *****************************
$(document).ready(function () {
    getAllData("drivers", getAllDrivers);
    $("button.btn-add").click(editDriver);
    $("button.btn-show-modal-add").click(function (e) {
        e.preventDefault();
        debugger
        $("button.btn-add").data(`action`, `add`);
        $("button.btn-add").text(`Ajouter chauffeur`);
        $("#modal-title").text(`Ajouter chauffeur`);
        $("form#modal-add-edit").trigger("reset");
    });
});
/// *****************************
/// DEFINE YOUR FUNCTIONS
/// *****************************
/**
 * Edit driver
 * @param {Event} e Information about the event
 */
const editDriver = (e) => {
    e.preventDefault();
    let action = $(e.target).data(`action`);
    if (action == "edit") {
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
        updateData(`drivers/${driverToOperate.id}`, dataToSend, showDialogResponse);
    }
}
/**
 * Delete driver
 */
const deleteDriver = () => {
    deleteData(`drivers/${driverToOperate.id}`, showDialogResponse);
}
/**
 * Show dialog modal to display server response
 * @param {object} data response from the server that contains modified driver 
 */
const showDialogResponse = (data) => {
    let msg = data.msg;
    if (data.status == 200) {
        let driver = data.result;
        // alertMsg(msg);
        $("tbody#tbl_driver").empty();
        getAllData("drivers", getAllDrivers);
        $("form#modal-add-edit").trigger("reset");
    } else {
        let errors = data.errors;
        console.log(errors);
    }
    window.scrollTo(0, 0);
}
/**
 * Retrieve all drivers from the server
 * @param {object} data response from the server that contains all drivers
 */
const getAllDrivers = (data) => {
    drivers = data.drivers;
    $.each(drivers, function (indexInArray, driver) {
        let tr = $("<tr>");
        let tdNb = $("<td>");
        tdNb.text(indexInArray + 1);
        let tdNomComplet = $("<td>");
        tdNomComplet.text(`${driver.person} ${driver.person}`); //TODO
        let tdGender = $("<td>");
        tdGender.text(driver.person); //TODO
        let tdCin = $("<td>");
        tdCin.text(driver.person); //TODO
        let tdTel = $("<td>");
        tdTel.text(driver.person); //TODO
        let tdEditDriver = $(`<td class="text-center">`);
        let btnEditDriver = $(`<button class='btn btn-primary m-2' data-driver-id=${driver.id} data-bs-toggle='modal' data-bs-target='#addnew'  data-bs-toggle='tooltip' data-bs-placement='top' title='Modifier Chauffeur'>`);
        btnEditDriver.append(`<i class="la la-pencil"></i>Modifier`);
        btnEditDriver.click(function (e) {
            e.preventDefault();
            driverToOperate = drivers.find(oneDriver => oneDriver.id == $(this).data("driver-id"));
            $("button.btn-add").data(`action`, `edit`);
            $("button.btn-add").text(`Modifier chauffeur`);
            $("#modal-title").text(`Modifier chauffeur`);
            fillModalEditDriver();
        });
        tdEditDriver.append(btnEditDriver);
        let tdDeleteDriver = $(`<td class="text-center">`);
        let btnDeleteDriver = $(`<button class="btn btn-primary m-2" data-driver-id=${driver.id}  data-bs-toggle='tooltip' data-bs-placement='top' title='Supprimer Chauffeur'>`);
        btnDeleteDriver.append(`<i class="la la-trash-o"></i>Supprimer`);
        btnDeleteDriver.click(function (e) {
            e.preventDefault();
            driverToOperate = drivers.find(oneDriver => oneDriver.id == $(this).data("driver-id"));
            callSwal(deleteDriver);
        });
        tdDeleteDriver.append(btnDeleteDriver);
        tr.append(tdNb, tdNomComplet, tdCin, tdGender, tdTel, tdEditDriver, tdDeleteDriver);
        $("tbody#tbl_driver").append(tr);
    });
}
/**
 * Fill all inputs to modify a driver
 * @param {int} index The index of the selected driver to be modified
 */
const fillModalEditDriver = (driverId) => {
    // TODO: fill inputs of persons table ...
    $("input#nom").val(driverToOperate.person);
    $("input#prenom").val(driverToOperate.person);
    $("input#cin").val(driverToOperate.person);
    $("input#date-naissance").val(driverToOperate.person);
    $("input#adress").val(driverToOperate.person);
    $("input#tel").val(driverToOperate.person);
    $("input#date-embauche").val(driverToOperate.employee.date_embauche);
    $("input#salaire").val(driverToOperate.employee.salaire);
    $("select#gender").val(driverToOperate.person);
    $("textarea#description").val(driverToOperate.person);
}
