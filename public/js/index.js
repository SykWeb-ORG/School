var baseUrl = `${location.protocol}//${location.host}/`;
// GET a SUNCTUM CSRF
$(document).ready(function () {
    axios.get('/sanctum/csrf-cookie');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// GET Function with Axios
function getAllData(endUrl, fctOutput, dataObject = {}) {
    axios
        .get(baseUrl + endUrl, {
            // timeout: 5000,
            params: dataObject,
        })
        .then(res => fctOutput(res.data, dataObject))
        .catch(err => {
            console.log(err);
            fctOutput(err.response.data);
        });
}

// POST Function Axois
function addData(endUrl, dataObject, fctOutput) {
    axios
        .post(baseUrl + endUrl, dataObject)
        .then(res => fctOutput(res.data, dataObject))
        .catch(err => {
            fctOutput(err.response.data);
        });
}

// PUT Function Axois 
function updateData(endUrl, dataObject, fctOutput) {
    axios
        .put(baseUrl + endUrl, dataObject)
        .then(res => fctOutput(res.data))
        .catch(err => {
            fctOutput(err.response.data);
        });
}

// DELETE Function Axois
function deleteData(endUrl, fctOutput) {
    axios
        .delete(baseUrl + endUrl)
        .then(res => fctOutput(res.data))
        .catch(err => {
            fctOutput(err.response.data);
        });
}

// To upload files with Axois
function uploading(endUrl, dataObject, fctOutput) {
    axios({
        method: 'post',
        url: baseUrl + endUrl,
        data: dataObject,
    })
        .then(res => fctOutput(res.data))
        .catch(err => {
            fctOutput(err.response.data);
        });
}
function callSwal(fctOutput) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-success'
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: 'vous êtes sûr?',
        text: "Vous ne pourrez pas revenir en arrière !!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, Supprimer!',
        cancelButtonText: 'No, Annuler!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            deleteDriver();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Annulé',
                'Cette opération est annulée :)',
                'erreur'
            );
        }
    });
}
