
const deleteEl = document.querySelectorAll('form.delete');

deleteEl.forEach((formDelete) => {
  formDelete.addEventListener('submit', function (event) {
    event.preventDefault();
    const doubleconfirm = event.target.classList.contains('double-confirm');
    Swal.fire({
      title: 'Confirm request',
      text: "You are trying to delete a project.",
      icon: 'warning',
      iconColor: '#DC3445',
      showCancelButton: true,
      confirmButtonColor: '#28A745',
      cancelButtonColor: '#6C757D',
      cancelButtonText: '<i class="fa-solid fa-arrow-left"></i> Back',
      confirmButtonText: '<i class="fa-solid fa-thumbs-up"></i> Ok!',
    }).then((result) => {
      if (result.value) {
        // if double confirm
        if (doubleconfirm) {

          Swal.fire({
            title: 'This action is irreversible',
            html: "Please type <b>DELETE</b> to confirm",
            input: 'text',
            icon: 'error',
            iconColor: '#981100',
            inputPlaceholder: 'DELETE',
            showCancelButton: true,
            confirmButtonColor: '#DC3445',
            cancelButtonColor: '#6C757D',
            confirmButtonText: 'Confirm <i class="fa-solid fa-trash"></i>',
            cancelButtonText: 'Cancel <i class="fa-solid fa-xmark"></i>',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading(),
            preConfirm: (txt) => {
              return (txt.toUpperCase() == "DELETE");
            },

          }).then((result) => {
            if (result.value) this.submit();
          })
        } else {
          this.submit();
        }
      }
    });
  });
});