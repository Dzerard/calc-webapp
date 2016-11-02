// jshint devel:true
'use strict';
/* global $ */
/* global products */
/* global grecaptcha */

var app = {
  container: null,
  button: null,
  selectProduct: null,
  countItems: null,
  currency: 'zł',
  step1: null,
  step2: null,
  currentItem: null,
  RABATE_PRODUCT: '001',
  finalPrice: null,

  /* Odpalanie apki */
  init: function (container) {
    this.container = container;
    this.setItems();
    this.bindFunctions();
    this.validForom();
    this.step2Form();
    this.modalMethods();
  },

  /* Przeliczanie wartości całego zamówienia */
  countTotalPrice: function () {
    var tableBody = this.productList.find('.product-item tbody');
    var $rows = tableBody.find('tr');
    var tempPrice = 0.00;
    var summary = [];

    $.each($rows, function (key, item) {
      tempPrice += parseFloat($(item).find('[data-price]').data('price'));
      summary.push(tempPrice);
    });

    this.finalPrice.data('price', tempPrice.toFixed(2));
    this.finalPrice.html(String(tempPrice.toFixed(2)).replace('.', ',') + this.currency);
    this.button.blur();
  },

  /* Pokazywanie rabatu */
  showRabate: function () {
    var tableBodyRows = this.productList.find('.product-item tbody > tr');
    var countDiscountItems = 0;
    var self = this;

    $.each(tableBodyRows, function(key, item) {
      if($(item).data('id') === self.RABATE_PRODUCT) {
        countDiscountItems += $(item).find('.amount').data('amount');
      }
    });

    // tylko dla RABATE_PRODUCT
    function recalculatePrice(useRabate) {
      $.each(tableBodyRows, function(key, item) {
        if($(item).data('id') === self.RABATE_PRODUCT) {
          var price = $(item).find('[data-price]');
          var priceValue = price.attr('data-price');

          if(useRabate) {

            if(price.data('rabate') != true) {
              var text = price.text();

              price.data('rabate', true);
              price.data('original', price.attr('data-price'));
              priceValue = priceValue * .95;
              price.attr('data-price', priceValue.toFixed(2));

              price.html('<s>' + text + '</s><br>' + String(priceValue.toFixed(2)).replace('.', ',') + self.currency);
            }
          } else {

            if(price.data('rabate') === true) {
              var originalPrice = price.data('original');

              price.data('rabate', false);
              price.attr('data-price', originalPrice);
              price.text(String(originalPrice).replace('.', ',') + self.currency);
            }
          }
        }
      });
    }

    if (countDiscountItems >= 3) {
      this.rabateTag.removeClass('hidden');
      recalculatePrice(true);
    } else {
      this.rabateTag.addClass('hidden');
      recalculatePrice(false);
    }

    //show or hide table thead
    if (tableBodyRows.length >= 1) {
      this.productList.find('.product-item thead').removeClass('hidden');
      this.productList.find('.alert').hide();
      this.orderButton.removeAttr('disabled');
    } else {
      this.productList.find('.product-item thead').addClass('hidden');
      this.productList.find('.alert').show();
      this.orderButton.attr('disabled', true);
    }

    this.countTotalPrice();
  },

  /* Przeliczanie cen za produkty */
  summary: function () {
    var self = this;
    var tempPrice = 0;

    //ilosc i cena jednostkowa
    if ($('[data-parsley-form-config]').parsley().validate() === true) {

      var currentItem = self.currentItem;
      var width = this.itemWidth.val();
      var height = this.itemHeight.val();
      var amount = this.countItems.val();
      var color =   this.colorPicker.data('item');
      var setItemWithPrice = null;
      var gapNumber = 1;

      if (currentItem.type === 'blind') {

        for (var i = 0; i < currentItem.priceMeter.length; i++) {

          if (height >= currentItem.priceMeter[i].minHeight[0] && height <= currentItem.priceMeter[i].minHeight[1]) {
            setItemWithPrice = currentItem.priceMeter[i];
          }
        }

        if (width === 1) {
          gapNumber = 1;
        } else {
          gapNumber = parseInt(((width - 1) / currentItem.gapDelimeter)) + 1;
        }

        //nie ma gapow
        if (currentItem.subtype) {
          tempPrice = parseFloat(width * setItemWithPrice.priceCM).toFixed(2);
        } else {
          tempPrice = parseFloat(gapNumber * setItemWithPrice.gap * amount).toFixed(2);
        }

        if (tempPrice < setItemWithPrice.priceMin) {
          tempPrice = setItemWithPrice.priceMin;
        }
      }

      /* roleta ścienna typu mini */
      if (currentItem.type === 'mini') {

        var currentPriceWidthPrice = 0;

        //ustawiamy wartosc przedzialu dla szerokosci
        for (var j = 0; j < currentItem.priceWidth.length; j++) {

          if (width >= currentItem.priceWidth[j].distance[0] && width <= currentItem.priceWidth[j].distance[1]) {
            currentPriceWidthPrice = currentItem.priceWidth[j].price;
          }
        }

        if (height <= 180) {
          tempPrice = currentPriceWidthPrice;
        } else {
          tempPrice = parseFloat(currentPriceWidthPrice * 1.5).toFixed(2);
        }
      }
    } else {
      console.log('Formularz nipoprawnie wypełniony!');
    }

    var dime = width + 'cm x ' + height + 'cm'; //wymiary

    this.addRow(currentItem, dime, amount, tempPrice, self.currency, color);
    this.container.find('form')[0].reset();
    this.container.find('form').parsley().reset();
  },

  /* Dodawanie wiersza do tabeli */
  addRow: function (item, dimensions, amount, price, currency, color) {

    var self = this,
        $tr = $('<tr>').data('id', item.currentID),
        $name = $('<td>'),
        $dimensions = $('<td>'),
        $amount = $('<td>', {'class': 'amount'}).data('amount', parseInt(amount)),
        $color = $('<td>'),
        $price = $('<td>', {'class': 'text-right'}),
        $remove = $('<td><a href="#" class="remove-item"><span class="icon-trash-o"></span></a></td>');

    function prepareRowName(currentItem) {
      var txt = currentItem.name + '<br><small>' + 'Łańcuszek: ' + self.itemChain.val() + ', Mechanizm: ' + self.colorMechanic.val() + '</small>';

      return txt;
    }

    $tr
      .append($name.html(prepareRowName(item)))
      .append($dimensions.text(dimensions))
      .append($amount.text(amount))
      .append($color.text(color))
      .append($price.text(String(price).replace('.', ',') + currency).attr('data-price', price))
      .append($remove);

    $remove.on('click', function () {
      var $this = $(this);

      self.removeRowAction($this);
      return false;
    });

    this.productList.find('.product-item tbody').append($tr);
    this.showRabate();
  },
  setItems: function () {
    this.button        = this.container.find('#countPriceButton');
    this.selectProduct = this.container.find('#product');
    this.finalPrice    = $('#finalPrice');
    this.countItems    = this.container.find('#countItems');
    this.dropdown      = this.container.find('.choose-product .dropdown');
    this.itemWidth     = this.container.find('#itemWidth');
    this.itemHeight    = this.container.find('#itemHeight');
    this.productList   = $('#productList');
    this.step1         = $('.flow-step-1');
    this.orderButton   = $('#orderFormButton');
    this.step2         = $('.flow-step-2');
    this.colorPicker   = $('#colorPick');
    this.backToCalculator = $('#backToCalculator');
    this.rabateTag     = $('#topPriceRabate');
    this.itemChain     = $('#itemChain');
    this.colorMechanic = $('#colorMechanic');
  },
  setMaxAmount: function (amount) {
    this.countItems.attr('max', amount);
  },
  setMaxHeight: function (height) {
    this.itemHeight.attr('max', height);
  },
  removeError: function($item, $parent) {
    $item.tooltip('destroy');
    $parent.parent().removeClass('has-error');
  },
  checkIfItemSelect: function () {
    var itemSet = this.dropdown.find('button').attr('data-item-set');
    var colorSet = this.colorPicker.attr('data-item-set');
    var self = this;

    //kolor
    if (colorSet === 'false' && !self.colorPicker.attr('disabled')) {
      this.colorPicker.attr('data-original-title', 'Wybierz kolor');
      this.colorPicker.parent().addClass('has-error');
      this.colorPicker.tooltip('show');
    } else {
      self.removeError(self.colorPicker, self.colorPicker);
    }

    //przedmiot
    if (itemSet === 'false') {
      this.dropdown.find('button').attr('data-original-title', 'Wybierz produkt');
      this.dropdown.parent().addClass('has-error');
      this.dropdown.find('button').tooltip('show');
    } else {
      self.removeError(self.dropdown.find('button'), self.dropdown);
    }

    if(itemSet === 'false' || colorSet === 'false') {
      return false;
    } else {
      return true;
    }
  },
  modalMethods: function() {
    var $colorModal = $('#colorModal'),
        $items = $colorModal.find('.modal-body a'),
        $ok = $colorModal.find('.btn-success'),
        self = this;

    function unlockOk() {
      if($colorModal.find('.modal-body a.active').length > 0) {
        $ok.attr('disabled', false);
      } else {
        $ok.attr('disabled', true);
      }
    }

    $items.tooltip();

    $items.on('click', function() {

      $items.removeClass('active');
      $(this).addClass('active');
      unlockOk();

      return false;
    });

    $ok.on('click', function() {
      var activeItem = $colorModal.find('.modal-body a.active').first();

      self.colorPicker.data('item', activeItem.attr('data-original-title'));
      self.colorPicker.attr('data-item-set', 'true');
      self.colorPicker.find('b').text(activeItem.attr('data-original-title'));
      $colorModal.modal('hide');
      self.removeError(self.colorPicker, self.colorPicker);

      return false;
    });

    $colorModal.on('show.bs.modal', function (e) {
      var $button = $(e.relatedTarget);
      var colorScheme = $button.data('colors'); //currentItem





      console.log($button);

      // if($button.exists()) {
      //   url = $button.attr('data-url');
      //   type = !$button.attr('data-system') ? null : $button.attr('data-system');
      // } else {
      //   url = systemData.url;
      //   type = systemData.type;
      //   method = 'GET';
      //   $simpleModal.removeData();
      // }
      //
      // $simpleModal.find('form').hide();
      // $simpleModal.find('.modal-content').hide();
      //
      // if(url != undefined) {
      //   //@todo register avialble methods var DEFINED_METHODS = ['login', 'register'];
      //   if( type== 'FOS') {
      //     self.FOSActions($simpleModal, $button, url);
      //     return;
      //   }
      //
      //   $.ajax({
      //     type: method,
      //     url: url,
      //     dataType: 'json',
      //     success: function (result) {
      //       //validacja metod itd.
      //       $simpleModal.find('.modal-content').html(result.html).show();
      //       if(self[result.method] !== undefined) {
      //         self[result.method]($simpleModal); //fire method in view
      //       }
      //     },
      //     beforeSend: function() {
      //       app.helpers.loader();
      //     },
      //     error: function(xhr, ajaxOptions, thrownError) {
      //       toastr.error(translator.translate(thrownError));
      //       app.helpers.removeLoader();
      //     }
      //   }).always(function() {
      //     app.helpers.removeLoader();
      //   });
      //
      // } else {
      //   //betId for invite friends
      //   $simpleModal.find('form').hide();
      //   $simpleModal.find('[data-form="'+$button.attr('data-type')+'"]').show();
      // }
    });

    //ladujemy kolorki :)
    $.ajax({
      type: 'POST',
      url: 'admin/ajax.php',
      dataType: 'json',
      data: {
        'getPics': true
      },
      success: function (result) {
        var body = $colorModal.find('.modal-body');
        var myTemplate = $("#picItem").html().trim();
        var myTemplateClone = $(myTemplate);

        $.each(result.schemes, function(key, item) {
          var scheme = $('<div>');

          if(item['pics']) {
            $.each(item['pics'], function(key, item) {
              scheme.append($(myTemplate).attr('data-key', item['pic_id']));
            });
          }
          body.append(scheme);
        });

        console.log(result);
        //validacja metod itd.
        // $simpleModal.find('.modal-content').html(result.html).show();
        // if(self[result.method] !== undefined) {
        //   self[result.method]($simpleModal); //fire method in view
        // }
      },
      beforeSend: function() {
        // app.helpers.loader();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log("can't load color schemes");
        // toastr.error(translator.translate(thrownError));
        // app.helpers.removeLoader();
      }
    }).always(function() {
      //app.helpers.removeLoader();
    });
  },
  bindFunctions: function () {
    var self = this;

    $('[data-color-tooltip]').tooltip();

    $('.select-2').select2({
      minimumResultsForSearch: Infinity,
      width: '100%'
    });

    //akcja do przeliczania formularza
    this.button.on('click', function () {

      $('[data-parsley-form-config]').parsley().validate();

      if (self.checkIfItemSelect() === true && $('[data-parsley-form-config]').parsley().validate() === true) {
        self.summary();
      }

      return false;
    });

    function showStep(step) {
      var hide = 'step1',
          show = 'step2';

      if ($(this).attr('data-step') === '1' || step === 1) {
        hide = ['step2'];
        show = ['step1'];
      }

      self[hide].fadeOut('fast', function () {
        self[show].hide().removeClass('hidden').fadeIn('fast');
        self[hide].addClass('hidden');
      });
    }

    function setDataToColorButton() {
      self.colorPicker.attr('disabled', false);

      if(self.currentItem.images === null) {
        self.colorPicker.find('b').text('Brak kolorów');
        self.colorPicker.attr('data-item-set', true);
        self.colorPicker.removeAttr('data-colors');
        self.colorPicker.attr('disabled', true);
        self.colorPicker.data('item', '-');
      } else {
        self.colorPicker.find('b').text('Wybierz kolor');
        self.colorPicker.attr('data-item-set', false);
        self.colorPicker.attr('data-colors', self.currentItem.images);
      }
    }

    this.orderButton.on('click', showStep);
    this.backToCalculator.on('click', showStep);

    this.dropdown.find('li[role="presentation"]').on('click', function () {
      var $dropdownElement = $(this);

      self.dropdown.find('li').removeClass('active');
      $dropdownElement.addClass('active');
      self.currentItem = products[$dropdownElement.find('a').data('product-id')];
      self.currentItem.currentID = $dropdownElement.find('a').data('product-id'); //@todo check if element exist

      self.dropdown.find('button b').text($dropdownElement.find('a').text());
      self.dropdown.find('button').attr('data-item-set', true);
      self.setMaxAmount(self.currentItem.amount);
      self.setMaxHeight(self.currentItem.maxHeight);

      setDataToColorButton();

      self.removeError(self.dropdown.find('button'), self.dropdown);
    });

    this.countItems.on('keyup', function () {
      self.checkIfItemSelect();
    });

    this.productList.find('.remove-item').on('click', function () {
      var $this = $(this);
      self.removeRowAction($this);
      return false;
    });
  },
  removeRowAction: function ($button) {
    var self = this;

    $button.parents('tr').fadeOut('medium', function () {
      $button.parents('tr').remove();
      self.showRabate();
    });
  },
  validForom: function () {

    var parsleyConfig = {
      errorsContainer: function (pEle) {
        var $err = pEle.$element.parent().parent().find('.custom-error');
        return $err;
      }
    };

    if ($('[data-parsley-form-config]').length > 0) {
      $('[data-parsley-form-config]').parsley(parsleyConfig);

      //błędy w tooltipach
      $.listen('parsley:field:error', function (fieldInstance) {
        var $element = fieldInstance.$element.parent();
//        console.log(fieldInstance);
//        console.log(fieldInstance.getValue());

        var message = window.ParsleyUI.getErrorsMessages(fieldInstance);

        $element.addClass('has-error');
        $element.attr('data-original-title', message).tooltip('show');
        //console.log(fieldInstance);
      });

      $.listen('parsley:field:success', function (fieldInstance) {
        fieldInstance.$element.parent().tooltip('destroy').removeClass('has-error');
      });
    }
  },
  helpers: (function () {
    var $loader = $('<div>', {'class': 'loader big'});

    function loader($container) {
      $container.append($loader);
    }

    function removeLoader() {
      $loader.remove();
    }

    function scrollTo($toContainer) {

      if ($toContainer instanceof $) {

        $('html,body').animate({scrollTop: $toContainer.offset().top}, 'medium', function () {
          //@todo $callback();
        });
      }
    }

    return {
      loader: loader,
      removeLoader: removeLoader,
      scrollTo: scrollTo
    };
  })(),
  step2Form: function () {
    var $form = $('.contact-form'),
        route = $form.attr('data-action'),
        $formWrapper = $form.parent(),
        self = this;

    function validatePrice(checkPrice) {
      if (!isNaN(checkPrice)) {
        return checkPrice;
      } else {
        return 0;
      }
    }

    $form.on('submit', function () {

      if ($form.parsley().validate()) {

        $form.find('.recaptcha-wrapper').removeClass('hidden');
        var v = grecaptcha.getResponse(); //parse Recaptcha

        if (v.length === 0) {
          return false;
        }

        var afterResponse = function (data) {
          $formWrapper.find('.js-message').hide().removeClass('hidden');

          if (data.err !== undefined) {
            $formWrapper.find('.js-message').removeClass('alert-info').addClass('alert-danger').hrml('Formularz zawiera błędy:<br>' + data.err).show();
          } else if(data.ok !== undefined) {
            $formWrapper.find('.js-message').addClass('alert-info').removeClass('alert-danger').text('Formularz został wysłany! Wkrótce otrzymasz więcej informacji!').show();
            $form[0].reset();
            $form.slideUp();
            $form.find('.recaptcha-wrapper').addClass('hidden');

            setTimeout(function(){
             window.location.reload();
            }, 5000);
          }
        };

        //prepare html of items
        var $message = $('.product-item.table tbody').clone();
        $message.find('td:last-child').remove();
        var messageOutput = $message.html();

        //final Price
        var $finalPrice = $('#finalPrice');

        $form.find('[name="message"]').val(messageOutput);
        $form.find('[name="total"]').val($finalPrice.data('price')); //@todo validator
        $form.find('[name="rabate"]').val(self.rabateTag.is(':visible'));

        if(validatePrice($finalPrice.data('price') === 0)) {
          console.log('Wystąpił błąd! Suma zamówienia jest błędna');
          return false;
        }

        $.ajax({
          url: route,
          data: {data: $form.serialize()},
          type: 'POST',
          dataType: 'json',
          success: function (data) {
            afterResponse(data);
          },
          beforeSend: function () {
            self.helpers.loader($('.contact-captcha-wrap'));
          },
          error: function () {
            if ($formWrapper.find('.js-message').length > 0) {
              $formWrapper.find('.js-message').text('Wystąpił błąd!');
            }
          }
        }).always(function () {
          self.helpers.removeLoader();
        });
      }
      return false;
    });
  }
};

/*eslint-disable no-unused-vars*/
var recaptchaCallback = function () {
  $('.contact-form').submit();
};
/*eslint-enable no-unused-vars*/

app.init($('.form-container'));
