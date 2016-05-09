"use strict";
(function () {

  var AppController = {
    init: function () {
      this.datepickerFire();
      this.tinyInit();
	  this.plugins();
      //this.youTubeActions();
    },
    plugins: function() {
      $('.tool,.btn-logout').tooltip('hide');
      $('[data-tooltip]').tooltip('hide');
    },
    tinyInit: function () {
      tinymce.init({
          selector: "textarea",
          language: 'pl',
          plugins: [
              "advlist autolink lists link image charmap print preview anchor",
              "searchreplace visualblocks code fullscreen",
              "insertdatetime media table contextmenu paste"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
      });
    },
    datepickerFire: function() {
      var _this = this;
      $(function() {

        $('.remove-confirm').on('click', function(){
          if(confirm('Czy chcesz usunąć ?')) {
            return true;
          };
          return false;
        });

		$("#Tdatepicker").datepicker({ dateFormat: "dd.mm.yy" });
		$( "#Odatepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
		$( "#Zdatepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
		$( "#Mdatepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
        $( ".datepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
        $('.datetimepickcer').datetimepicker({showMillisec: false,
          showMicrosec:false,
          showTimezone: false,
          showSecond: false,
          timeFormat: 'HH:mm:00',
          closeText: '×',
          prevText: '<',
          nextText: '>',
          currentText: 'Teraz',
          monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Маj','Czerwiec',
          'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
          monthNamesShort: ['St','Lu','Мa','Kw','Ma','Cz',
          'Lp','Si','Wr','Pa','Li','Gr'],
//          dayNames: ['Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela'],
//          dayNamesShort: ['Pn','Wt','Śr','Czw','Pt','So','Nd'],
          dayNamesMin: ['Nd','Pn','Wt','Śr','Cz','Pt','So'],
          timeOnlyTitle: 'Czas',
          timeText: 'Czas',
          hourText: 'Godzina',
          minuteText: 'Minuta',
//          controlType: 'select',
//          oneLine: true,
          dateFormat: 'yy-mm-dd'
        });

        $('.edit-modal').on('click', function(){

          var btnId = $(this).data('id');
          $.ajax({
            type: 'POST',
            url: 'events.php',
            dataType: 'json',
            data: {'id': btnId},
            success: function (result) {

                $('#editEventForm').find('#event_id_edit').val(result.event_id);
                $('#editEventForm').find('#event_description_edit').val(result.event_description);
                $('#editEventForm').find('#event_title_edit').val(result.event_title);
                $('#editEventForm').find('#event_date_edit').val(result.event_date);
                tinymce.activeEditor.setContent(result.event_description);
                $('#editModal').modal('show');
              }
            });

        });
	  });
    },
    youTubeActions: function() {

      var $actionButtons = $('.youtube-actions'),
        $visibility = $actionButtons.find('a'),
        $youtubleList = $('.sort-categries-js');

        $visibility.on('click', function() {
          var $btn = $(this),
              id = $btn.attr('data-id'),
              status = $btn.attr('data-value');

          $btn.attr('disabled', true);

          $.ajax({
              type: 'POST',
              url : $youtubleList.attr('rel'),
              data: {
                youtube_visibility: id,
                youtube_visibility_status: status
              },
              success : function(data){
                $btn.attr('disabled', false);

                if(data.current_status == 'off') {
                  $btn.find('span').removeClass('label-info').addClass('label-default');
                } else {
                  $btn.find('span').removeClass('label-default').addClass('label-info');
                }

                $btn.attr('data-value', data.current_status);
              }
          });

          return false;
        });

        $youtubleList.find('.removeCategory').on('click', function() {
            return confirm("Czy jesteś pewien, że chcesz usunąć link do filmu?");
        });

        var fixHelper = function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                return ui;
            };

            $youtubleList.sortable({
                helper: fixHelper,
                update: function(event, ui) {
                    var order = [];
                    ui.item.parent().children().each(function(k, v){
                        order[order.length] = $(v).attr('rel');
                    });
                    $.ajax({
                        type: 'POST',
                        url : $youtubleList.attr('rel'),
                        data: {order: order},
                        success : function(data){
                          console.log(data);
//                            var container = $(document).find('.categoryMessages');
//                            container.hide().empty();
//                            container.html(data.html);
//                            container.fadeIn();
                        }
                    });
                },
                handle: '.sort',
                cursor: 'move'
            });
    }
  };

  $(document).ready(function () {
    AppController.init();
  });
}());
