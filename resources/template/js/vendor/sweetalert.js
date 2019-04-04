(function(){
  'use strict';

  const Swal = (element) => {
    const options = {
      title: void 0 !== element.data('swal-title') 
        ? element.data('swal-title') 
        : 'Title',
      text: element.data('swal-text'),
      type: void 0 !== element.data('swal-type') 
        ? element.data('swal-type') 
        : null,
      html: element.data('swal-html'),
      showCancelButton: element.data('swal-show-cancel-button'), 
      cancelButtonText: element.data('swal-cancel-button-text'), 
      closeOnCancel: void 0 !== element.data('swal-close-on-cancel') 
        ? element.data('swal-close-on-cancel') 
        : true,
      confirmButtonText: element.data('swal-confirm-button-text'), 
      confirmButtonColor: void 0 !== element.data('swal-confirm-button-color') 
        ? element.data('swal-confirm-button-color') 
        : settings.colors.primary[500],
      closeOnConfirm: void 0 !== element.data('swal-close-on-confirm') 
        ? element.data('swal-close-on-confirm') 
        : true
    }
    swal(options, function(isConfirm) {
      if (element.data('swal-confirm-cb') && isConfirm) {
        return Swal($(element.data('swal-confirm-cb')))
      }
      if (element.data('swal-cancel-cb')) {
        Swal($(element.data('swal-cancel-cb')))
      }
    })
  }

  $('[data-toggle="swal"]').on('click', function() {
    var element = $(this)
    Swal(element)
  })

})()