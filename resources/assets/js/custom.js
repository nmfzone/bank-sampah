$(function() {

  $('.input-date').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: true,
    language: "id",
    autoclose: true,
    todayHighlight: true
  });

  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    
    return (results===null) ? null : (results[1] || 0);
  }

  $('.input-date').attr('title', 'Silahkan pilih tanggal');

  var deleter = {
    elementSelector       : ".the-tables",
    classSelector         : ".delete-this",
    modalTitle            : "Anda yakin?",
    modalMessage          : "Data yang sudah dihapus, tidak bisa dikembalikan.",
    modalConfirmButtonText: "Hapus sekarang!",
    modalCancelButtonText : "Batal",
    laravelToken          : null,
    url                   : "/",

    init: function() {
      $(this.elementSelector).on('click', this.classSelector, {self:this}, this.handleClick);
    },

    handleClick: function(event) {
      event.preventDefault();

      var self = event.data.self;
      var link = $(this);

      self.modalTitle             = link.data('title') || self.modalTitle;
      self.modalMessage           = link.data('message') || self.modalMessage;
      self.modalConfirmButtonText = link.data('confirm-button-text') || self.modalConfirmButtonText;
      self.modalCancelButtonText  = link.data('cancel-button-text') || self.modalCancelButtonText;
      self.url                    = link.attr('href');
      self.laravelToken           = $("meta[name=token]").attr('content');

      self.confirmDelete();
    },

    confirmDelete: function() {
      swal({
        title             : this.modalTitle,
        text              : this.modalMessage,
        type              : "warning",
        showCancelButton  : true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText : this.modalConfirmButtonText,
        cancelButtonText  : this.modalCancelButtonText,
        closeOnConfirm    : true
      },
      function() {
        this.makeDeleteRequest()
      }.bind(this)
      );
    },

    makeDeleteRequest: function() {
      var form =
        $('<form>', {
          'method': 'POST',
          'action': this.url
        });

      var token =
        $('<input>', {
          'type': 'hidden',
          'name': '_token',
          'value': this.laravelToken
        });

      var hiddenInput =
        $('<input>', {
          'name': '_method',
          'type': 'hidden',
          'value': 'DELETE'
        });

      return form.append(token, hiddenInput).appendTo('body').submit();
    }
  };
  deleter.init();

});
