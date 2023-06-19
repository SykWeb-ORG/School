/// *****************************
/// DEFINE GLOBAL VARIABLES
/// *****************************
var drivers = [];
/// *****************************
/// CALL YOUR FUNCTIONS
/// *****************************
$(document).ready(function () {
    getAllData("drivers", fillSelectDrivers);
    $("button.btn-add").click(addTransport);
});
/// *****************************
/// DEFINE YOUR FUNCTIONS
/// *****************************
/**
 * Add new transport
 * @param {Event} e Information about the event
 */
const addTransport = async (e) => {
    e.preventDefault();
    let action = $(e.target).data(`action`);
    if (action == "add") {
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
        addData("transports", dataToSend, showDialogResponse);
    }
}
/**
 * Fill the select field with all drivers
 * @param {object} data response from the server that contains all drivers
 */
const fillSelectDrivers = (data) => {
    drivers = data.drivers;
    $.each(drivers, function (indexInArray, driver) {
        let option = $("<option>");
        option.text(`${driver.id}`); // TODO: change the text with his name after create Person model...
        option.val(driver.id);
        $("select#drivers").append(option);
    });
    // $("select#drivers").select2({
    //     placeholder: 'Séléctionner un chauffeur ...',
    // });
}
