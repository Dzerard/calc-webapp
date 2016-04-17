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
  finalPrice: null,
  init: function (container) {
    this.container = container;
    this.setItems();
    this.bindFunctions();
    this.validForom();
    this.step2Form();
  },
  countTotalPrice: function () {
    //cena całosci zależna jest od rabatu
    var tableBody = this.productList.find('.product-item tbody');
    var $rows = tableBody.find('tr');
    var tempPrice = 0.00;
    var summary = [];

    $.each($rows, function (key, item) {
      tempPrice += parseFloat($(item).find('[data-price]').data('price'));
      summary.push(tempPrice);
      //parseFloat(summary).toFixed(2) + parseFloat(tempPrice).toFixed(2);
    });

    console.log(tempPrice);
    console.log($rows);

    this.finalPrice.html(String(tempPrice).replace('.', ',') + this.currency);
  },
  // przerobic na event w momencie usuwania wiersza
  showRabate: function () {
    var tableBody = this.productList.find('.product-item tbody');
    var rabate = $('#topPriceRabate');
    if (tableBody.find('tr').length >= 3) {
      rabate.removeClass('hidden');
    } else {
      rabate.addClass('hidden');
    }

    //show hide table thead
    if (tableBody.find('tr').length >= 1) {
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
  summary: function () {
    var self = this;

    var tempPrice = 0;
    //ilosc i cena jednostkowa
    if ($('[data-parsley-form-config]').parsley().validate() === true) {

      var currentItem = self.currentItem;
      var width = this.itemWidth.val();
      var height = this.itemHeight.val();
      var amount = this.countItems.val();
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

        console.log(tempPrice + 'zł');

//        if (!isNaN(tempPrice)) {
//          self.finalPrice.html(tempPrice + self.currency);
//        }
      }

      /* roleta ścienna typu mini */
      if (currentItem.type === 'mini') {

        var currentPriceWidthPrice = 0;

        //ustawiamy przedzial dla szerokosci
        for (var j = 0; j < currentItem.priceWidth.length; j++) {

          if (width >= currentItem.priceWidth[j].distance[0] && width <= currentItem.priceWidth[j].distance[1]) {
            //ustaw wartosc przedzialu
            currentPriceWidthPrice = currentItem.priceWidth[j].price;
          }
        }

        if (height <= 180) {
          tempPrice = currentPriceWidthPrice;
        } else {
          tempPrice = parseFloat(currentPriceWidthPrice * 1.5).toFixed(2);
        }

        console.log(tempPrice + 'zł');

//        if (!isNaN(tempPrice)) {
//          self.finalPrice.html(tempPrice + self.currency);
//        }
      }
    } else {
      console.log('formularz nipoprawnie wypełniony');
    }

    var dime = width + 'cm x ' + height + 'cm'; //wymiary

    this.addRow(currentItem.name, dime, amount, tempPrice, self.currency);
    this.container.find('form')[0].reset();
    this.container.find('form').parsley().reset();
  },
  addRow: function (name, dimensions, amount, price, currency) {

    console.log(price);

    var self = this,
            $tr = $('<tr>'),
            $name = $('<td>'),
            $dimensions = $('<td>'),
            $amount = $('<td>'),
            $price = $('<td>'),
            $remove = $('<td><a href="#" class="remove-item"><span class="icon-trash-o"></span></a></td>');

    $tr
            .append($name.text(name))
            .append($dimensions.text(dimensions))
            .append($amount.text(amount))
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
    this.button = this.container.find('#countPriceButton');
    this.selectProduct = this.container.find('#product');
    this.finalPrice = $('#finalPrice');
    this.countItems = this.container.find('#countItems');
    this.dropdown = this.container.find('.dropdown');
    this.itemWidth = this.container.find('#itemWidth');
    this.itemHeight = this.container.find('#itemHeight');
    // this.maxAmount  = this.container.find('#maxAmount');
    this.productList = $('#productList');
    this.step1 = $('.flow-step-1');
    this.orderButton = $('#orderFormButton');
    this.step2 = $('.flow-step-2');
    this.backToCalculator = $('#backToCalculator');
    this.orderFormButton = $('#orderFormButton');
  },
  submit: function () {



    // this.checkIfItemSelect

  },
  setMaxAmount: function (amount) {
    this.countItems.attr('max', amount);
  },
  setMaxHeight: function (height) {

    this.itemHeight.attr('max', height);
  },
  checkIfItemSelect: function () {
    var itemSet = this.dropdown.find('button').attr('data-item-set');

    //console.log(itemSet);

    if (itemSet === 'false') {

      this.dropdown.find('button').attr('data-original-title', 'Wybierz produkt');
      this.dropdown.parent().addClass('has-error');
      this.dropdown.find('button').tooltip('show');

      return false;
    } else {
      this.dropdown.find('button').tooltip('destroy');
      this.dropdown.parent().removeClass('has-error');

      return true;
    }
  },
  bindFunctions: function () {
    var self = this;

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

    this.orderButton.on('click', showStep);
    this.backToCalculator.on('click', showStep);

    this.dropdown.find('li[role="presentation"]').on('click', function () {
      var $dropdownElement = $(this);

      self.dropdown.find('li').removeClass('active');
      $dropdownElement.addClass('active');
      self.currentItem = products[$dropdownElement.find('a').data('product-id')];
      self.dropdown.find('button b').text($dropdownElement.find('a').text());
      self.dropdown.find('button').attr('data-item-set', true);
      self.setMaxAmount(self.currentItem.amount);
      self.setMaxHeight(self.currentItem.maxHeight);
    });

    this.countItems.on('keyup', function () {

      self.checkIfItemSelect();
      // console.log(self.currentItem);
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
        console.log(fieldInstance);
        console.log(fieldInstance.getValue());

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
//          if ($formWrapper.find('.js-message').length > 0) {
//            $formWrapper.find('.js-message').replaceWith($messageContainer);
//          } else {
//            $form.before($messageContainer);
//          }
//
//          // error
//          //                  $formWrapper.find('.js-message').addClass('alert-success').removeClass('alert-danger').text('poraw dane');
//          //                  $formWrapper.removeClass('js-request');
//          //                  $formWrapper.find('.loader')
//          //                  <div class="js-message alert alert-danger">Wiadomość wysłana</div>
//          //                  $formWrapper.removeClass('js-request');
//          //                  $form[0].reset(); //reset forma
//
//          // success
//          $formWrapper.find('.loader').fadeOut('fast');
//          $form.slideUp('slow', function () {
//            $formWrapper.find('.js-message').addClass('alert-success').removeClass('alert-danger').html(data.message).show();
//          });
        };

        //prepare html of items
        var $message = $('.product-item.table tbody').clone();
        $message.find('td:last-child').remove();
        var messageOutput = $message.html();

        //final Price
        var $finalPrice = $('#finalPrice');

        $form.find('[name="message"]').val(messageOutput);
        $form.find('[name="total"]').val($finalPrice.html());

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

//            $formWrapper.find('.loader').fadeOut('fast');
//            $form.slideUp('slow', function () {
//              $formWrapper.find('.js-message').addClass('alert-success').removeClass('alert-danger').html('Oops, it looks like an error occured. <span>Refresh page and try again</span>').show();
//            });
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
