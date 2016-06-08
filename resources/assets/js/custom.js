$(function() {

    var deleter = {
      elementSelector       : ".the-tables",
      classSelector         : ".delete-this",
      modalTitle            : "Are you sure?",
      modalMessage          : "You will not be able to recover this entry?",
      modalConfirmButtonText: "Yes, delete it!",
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
        self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
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
