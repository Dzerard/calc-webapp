// jshint devel:true
'use strict';

/* global $ */
/* global products */
var app = {
  container: null,
  button: null,
  selectProduct: null,
  countItems: null,
  currency: 'zł',
  currentItem: null,
  finalPrice: null,
  init: function (container) {
    this.container = container;
    this.setItems();
    this.bindFunctions();
    this.validForom();
  },
  summary: function () {
    var self = this;

    var tempPrice = 0;
    //ilosc i cena jednostkowa
    if ($('[data-parsley-form-config]').parsley().validate()) {

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

        if (!isNaN(tempPrice)) {
          self.finalPrice.html('<b>' + tempPrice + self.currency + '</b>');
        }
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

        if (!isNaN(tempPrice)) {
          self.finalPrice.html('<b>' + tempPrice + self.currency + '</b>');
        }
      }
    } else {
      console.log('formularz nipoprawnie wypeÅ‚niony');
    }

  },
  setItems: function () {
    this.button = this.container.find('#countPriceButton');
    this.selectProduct = this.container.find('#product');
    this.finalPrice = this.container.find('.final-price');
    this.countItems = this.container.find('#countItems');
    this.dropdown = this.container.find('.dropdown');
    this.itemWidth = this.container.find('#itemWidth');
    this.itemHeight = this.container.find('#itemHeight');
    // this.maxAmount  = this.container.find('#maxAmount');
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

    console.log(itemSet);

    if (itemSet === 'false') {

      this.dropdown.find('button').attr('title', 'Wybierz produkt');
      this.dropdown.find('button').tooltip('show');

      return false;
    } else {
      this.dropdown.find('button').tooltip('destroy');

      return true;
    }
  },
  bindFunctions: function () {
    var self = this;

    //akcja do przeliczania formularza
    this.button.on('click', function () {

      $('[data-parsley-form-config]').parsley().validate();

      if (self.checkIfItemSelect() === true) {
        self.summary();
      }

      return false;
    });

    this.dropdown.find('li').on('click', function () {
      var $dropdownElement = $(this);

      self.dropdown.find('li').removeClass('active');
      $dropdownElement.addClass('active');
      self.currentItem = products[$dropdownElement.find('a').data('product-id')];
      self.dropdown.find('button').text($dropdownElement.find('a').text());
      self.dropdown.find('button').attr('data-item-set', true);
      self.setMaxAmount(self.currentItem.amount);
      self.setMaxHeight(self.currentItem.maxHeight);
    });

    this.countItems.on('keyup', function () {

      self.checkIfItemSelect();
      // console.log(self.currentItem);
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

      //       $('[data-parsley-form-config]').on('field:error', function() {
      //   // This global callback will be called for any field that fails validation.
      //   console.log('Validation failed for: ', this.$element);
      // });
    }
  }
};

app.init($('.form-container'));
