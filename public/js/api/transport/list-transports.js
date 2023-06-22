/// *****************************
/// DEFINE GLOBAL VARIABLES
/// *****************************
var transports = [];
var transportToOperate = null;
/// *****************************
/// CALL YOUR FUNCTIONS
/// *****************************
$(document).ready(function () {
    getAllData("transports", getAllTransports);
    $("button.btn-add").click(editTransport);
    $("button.btn-show-modal-add").click(function (e) {
        e.preventDefault();
        debugger
        $("button.btn-add").data(`action`, `add`);
        $("button.btn-add").text(`Ajouter transport`);
        $("#modal-title").text(`Ajouter transport`);
        $("form#modal-add-edit").trigger("reset");
    });
});
/// *****************************
/// DEFINE YOUR FUNCTIONS
/// *****************************
/**
 * Edit transport
 * @param {Event} e Information about the event
 */
const editTransport = (e) => {
    e.preventDefault();
    let action = $(e.target).data(`action`);
    if (action == "edit") {
        let matricule = $("input#matricule").val();
        let status = $("input#status").val();
        let techVisit = $("input#tech-visit").val();
        let model = $("input#model").val();
        let tax = $("input#tax").val();
        let nbPlaces = $("input#nb-places").val();
        let totalPrice = $("input#total-price").val();
        let paidPrice = $("input#paid-price").val();
        let monthlyPrice = $("input#monthly-price").val();
        let driver = $("select#drivers").val();
        let dataToSend = {
            "matricule": matricule,
            "status": status,
            "tech_visit": techVisit,
            "model": model,
            "tax": tax,
            "nb_places": nbPlaces,
            "total_price": totalPrice,
            "paid_price": paidPrice,
            "monthly_price": monthlyPrice,
            "driver": driver,
        }
        updateData(`transports/${transportToOperate.id}`, dataToSend, showDialogResponse);
    }
}
/**
 * Delete transport
 */
const deleteTransport = () => {
    deleteData(`transports/${transportToOperate.id}`, showDialogResponse);
}
/**
 * Show dialog modal to display server response
 * @param {object} data response from the server that contains modified transport 
 */
const showDialogResponse = (data) => {
    let msg = data.msg;
    if (data.status == 200) {
        let transport = data.result;
        // alertMsg(msg);
        $("tbody#tbl_transport").empty();
        getAllData("transports", getAllTransports);
        $("form#modal-add-edit").trigger("reset");
    } else {
        let errors = data.errors;
        console.log(errors);
    }
    window.scrollTo(0, 0);
}
/**
 * Retrieve all transports from the server
 * @param {object} data response from the server that contains all transports
 */
const getAllTransports = (data) => {
    transports = data.transports;
    $.each(transports, function (indexInArray, transport) {
        let tr = $("<tr>");
        let tdNb = $("<td>");
        tdNb.text(indexInArray + 1);
        let tdMatricule = $("<td>");
        tdMatricule.text(`${transport.matricule}`);
        let tdTechVisit = $("<td>");
        tdTechVisit.text(transport.tech_visit);
        let tdStatus = $("<td>");
        tdStatus.text(transport.status);
        let tdDriver = $("<td>");
        tdDriver.text(transport.driver ? transport.driver.id : `-`); //TODO: change the text with his name after create Person model...
        let tdEditTransport = $(`<td class="text-center">`);
        let btnEditTransport = $(`<button class='btn btn-primary m-2' data-transport-id=${transport.id} data-bs-toggle='modal' data-bs-target='#addnew'  data-bs-toggle='tooltip' data-bs-placement='top' title='Modifier transport'>`);
        btnEditTransport.append(`<i class="la la-pencil"></i>Modifier`);
        btnEditTransport.click(function (e) {
            e.preventDefault();
            transportToOperate = transports.find(oneTransport => oneTransport.id == $(this).data("transport-id"));
            $("button.btn-add").data(`action`, `edit`);
            $("button.btn-add").text(`Modifier transport`);
            $("#modal-title").text(`Modifier transport`);
            fillModalEditTransport();
        });
        tdEditTransport.append(btnEditTransport);
        let tdDeleteTransport = $(`<td class="text-center">`);
        let btnDeleteTransport = $(`<button class="btn btn-primary m-2" data-transport-id=${transport.id}  data-bs-toggle='tooltip' data-bs-placement='top' title='Supprimer transport'>`);
        btnDeleteTransport.append(`<i class="la la-trash-o"></i>Supprimer`);
        btnDeleteTransport.click(function (e) {
            e.preventDefault();
            transportToOperate = transports.find(oneTransport => oneTransport.id == $(this).data("transport-id"));
            callSwal(deleteTransport);
        });
        tdDeleteTransport.append(btnDeleteTransport);
        tr.append(tdNb, tdMatricule, tdStatus, tdTechVisit, tdDriver, tdEditTransport, tdDeleteTransport);
        $("tbody#tbl_transport").append(tr);
    });
}
/**
 * Fill all inputs to modify a transport
 * @param {int} index The index of the selected transport to be modified
 */
const fillModalEditTransport = () => {
    $("input#matricule").val(transportToOperate.matricule);
    $("input#status").val(transportToOperate.status);
    $("input#tech-visit").val(transportToOperate.tech_visit);
    $("input#model").val(transportToOperate.model);
    $("input#tax").val(transportToOperate.tax);
    $("input#nb-places").val(transportToOperate.nb_places);
    $("input#total-price").val(transportToOperate.total_price);
    $("input#paid-price").val(transportToOperate.paid_price);
    $("input#monthly-price").val(transportToOperate.monthly_price);
    $("select#drivers").val(transportToOperate.driver ? transportToOperate.driver.id : ``).trigger();
}
