// jshint devel:true
console.log('\'Allo \'Allo!');

var app = {

	container: null,
	button: null,
	selectProduct: null,
	countItems: null,
	currency: 'zł',
	currentItem: null,
	finalPrice: null,
	init: function(container) {
		this.container = container;
		this.setItems();
		this.bindFunctions();
		this.validForom();
	},
	summary: function() {
		var _this = this;

		var tempPrice = 0;
		//ilosc i cena jednostkowa

		if($('[data-parsley-form-config]').parsley().validate()) {

			var currentItem = _this.currentItem;
			var width = this.itemWidth.val();
			var height = this.itemHeight.val();
			var amount = this.countItems.val();
			var setItemWithPrice = null;
			var gapNumber = 1;

			if(currentItem.type === 'blind') {				

				for(var i =0; i < currentItem.priceMeter.length; i++) {

					if(height >= currentItem.priceMeter[i].minHeight[0]  && height <= currentItem.priceMeter[i].minHeight[1] ) {
						setItemWithPrice = currentItem.priceMeter[i];
					}
				}

				if(width == 1) {
					gapNumber = 1;	
				} else {
					gapNumber = parseInt(((width-1) / currentItem.gapDelimeter))+1;	
				}

		
			//nie ma gapow
			if(currentItem.subtype)		 {
				tempPrice = parseFloat(width*setItemWithPrice.priceCM).toFixed(2);
			} else {
				tempPrice = parseFloat(gapNumber*setItemWithPrice.gap * amount).toFixed(2);	
			}

			if(tempPrice < setItemWithPrice.priceMin) {
				tempPrice = setItemWithPrice.priceMin;
			}

			console.log(tempPrice+'zł');

			if(!isNaN(tempPrice)) {
				_this.finalPrice.html('<b>'+tempPrice+_this.currency+'</b>');
			}
		} 


		if(currentItem.type === 'mini') {

			var currentPriceWidthPrice = 0;

			//ustawiamy przedzial dla szerokosci
			for(var i =0; i < currentItem.priceWidth.length; i++) {
									
				if(width >= currentItem.priceWidth[i].distance[0] && width <= currentItem.priceWidth[i].distance[1]) {					
					currentPriceWidthPrice = currentItem.priceWidth[i].price;						
				}
			}
			
			if(height <= 180) {

				tempPrice = currentPriceWidthPrice;

			} else {
				tempPrice = parseFloat(currentPriceWidthPrice*1.5).toFixed(2);
			}

			console.log(tempPrice+'zł');

			if(!isNaN(tempPrice)) {
				_this.finalPrice.html('<b>'+tempPrice+_this.currency+'</b>');
			}
		}
	} else {
		console.log('formularz nipoprawnie wypełniony');
	}

},
setItems: function() {
	this.button = this.container.find('#countPriceButton');
	this.selectProduct = this.container.find('#product');
	this.finalPrice = this.container.find('.final-price');
	this.countItems = this.container.find('#countItems');
	this.dropdown   = this.container.find('.dropdown');
	this.itemWidth  = this.container.find('#itemWidth');
	this.itemHeight = this.container.find('#itemHeight');
		// this.maxAmount  = this.container.find('#maxAmount');
	},
	submit: function() {



		// this.checkIfItemSelect

	},
	setMaxAmount: function(amount) {
		this.countItems.attr('max', amount);
	},

	setMaxHeight: function(height) {

		this.itemHeight.attr('max', height);
	},
	checkIfItemSelect: function() {
		var itemSet =  this.dropdown.find('button').attr('data-item-set');

		console.log(itemSet);

		if(itemSet == 'false') {

			this.dropdown.find('button').attr('title', 'Wybierz produkt');
			this.dropdown.find('button').tooltip('show');

			return false;
		} else {
			this.dropdown.find('button').tooltip('destroy');

			return true;
		}
	},

	bindFunctions: function() {
		var _this = this;


		//akcja do przeliczania formularza
		this.button.on('click', function() {
			
			$('[data-parsley-form-config]').parsley().validate();

			if(_this.checkIfItemSelect() === true) {
				_this.summary();	
			}
			
			return false;
		});

		this.dropdown.find('li').on('click', function() {
			var $dropdownElement = $(this);

			_this.dropdown.find('li').removeClass('active');
			$dropdownElement.addClass('active');
			_this.currentItem = products[$dropdownElement.find('a').data('product-id')];
			_this.dropdown.find('button').text($dropdownElement.find('a').text());
			_this.dropdown.find('button').attr('data-item-set', true);
			_this.setMaxAmount(_this.currentItem.amount);
			_this.setMaxHeight(_this.currentItem.maxHeight);
		});

		this.countItems.on('keyup', function(e){

			_this.checkIfItemSelect();
			// console.log(_this.currentItem);

		// 	//@todo
		// 	console.log(e);


	});

	},
	validForom: function() {


		var parsleyConfig = {
			errorsContainer: function(pEle) {
				var $err = pEle.$element.parent().parent().find('.custom-error');
				return $err;
			}
		};

		if($('[data-parsley-form-config]').length > 0) {
			$('[data-parsley-form-config]').parsley(parsleyConfig);

  //       $('[data-parsley-form-config]').on('field:error', function() {
		//   // This global callback will be called for any field that fails validation.
		//   console.log('Validation failed for: ', this.$element);
		// });
}
}
};


var products  = {
	'001' : {
		'price' : '400',
		'type' : 'blind',
		'rabate' : {
			3  : 5,
			10 : 10
		},
		'gapDelimeter': 10,
		'priceMeter': [
		{
			'minHeight' : [1,150],
			'priceMin' : 36,
			'priceCM'  : 0.8,
			'gap'      : 9
		},
		{
			'minHeight' : [151,220],
			'priceMin' : 46,
			'priceCM'  : 1.2,
			'gap'      : 12.6
		},
		{
			'minHeight' : [221,250],
			'priceMin' : 66,
			'priceCM'  : 1.5,
			'gap'      : 17.64
		}			
		],
		'amount' : 50,
		'maxHeight': 250,
		'name': 'Roleta Dzień i Noc'
	},
	'002' : {
		'price' : '400',
		'type' : 'mini',
		'rabate' : {
			3  : 5,
			10 : 10
		},
		'gapDelimeter': 20,
		'priceWidth': [
			{
				'distance':[0,80],
				'price': 40.20,	
			},
			{
				'distance':[81,100],
				'price': 43.20,	
			},
			{
				'distance':[101,120],
				'price': 46.20,	
			},
			{
				'distance':[121,140],
				'price': 52.20,	
			},
			{
				'distance':[141,160],
				'price': 55.20,	
			},
			{
				'distance':[161,180],
				'price': 58.20,	
			},
			{
				'distance':[181,200],
				'price': 61.20,	
			}
		],
		'priceMeter': [
		{
			'minHeight' : [1,180],
			'priceMin' : 40.20,
			'minWidth' : 80,
			'priceCM'  : 0.8,
			'gap'      : 9
		},
		{
			'minHeight' : [181,250],
			'priceMin' : 46,
			'priceCM'  : 1.2,
			'gap'      : 12.6
		},		
		],
		'amount' : 50,
		'maxHeight': 250,
		'name': 'Roleta Ścienna'
	},
	'003' : {
		'price' : '400',
		'type' : 'blind',
		'rabate' : {
			3  : 5,
			10 : 10
		},
		'gapDelimeter': 10,
		'priceMeter': [
		{
			'minHeight' : [1,150],
			'priceMin' : 32,
			'priceCM'  : 0.8,
			'gap'      : 9
		},
		{
			'minHeight' : [151,220],
			'priceMin' : 46,
			'priceCM'  : 1.2,
			'gap'      : 12.6
		},
		{
			'minHeight' : [221,250],
			'priceMin' : 66,
			'priceCM'  : 1.5,
			'gap'      : 17.64
		}			
		],
		'amount' : 50,
		'maxHeight': 250,
		'name': 'Roleta Mini'
	},
	'004' : {
		'price' : '400',
		'type' : 'blind',
		'subtype' : true,
		'rabate' : {
			3  : 5,
			10 : 10
		},
		'gapDelimeter': 10,
		'priceMeter': [
		{
			'minHeight' : [1,150],
			'priceMin' : 32,
			'priceCM'  : 0.8
		},
		{
			'minHeight' : [151,220],
			'priceMin' : 46,
			'priceCM'  : 1.2
		},
		{
			'minHeight' : [221,250],
			'priceMin' : 66,
			'priceCM'  : 1.5
		}			
		],
		'amount' : 50,
		'maxHeight': 250,
		'name': 'Roleta Termo'		
	},
	'005' : {
		'price' : '400',
		'type' : 'blind',
		'rabate' : {
			3  : 5,
			10 : 10
		},
		'gapDelimeter': 10,
		'priceMeter': [
		{
			'minHeight' : [1,150],
			'priceMin' : 36,
			'priceCM'  : 0.8,
			'gap'      : 9
		},
		{
			'minHeight' : [151,220],
			'priceMin' : 46,
			'priceCM'  : 1.2,
			'gap'      : 12.6
		},
		{
			'minHeight' : [221,250],
			'priceMin' : 66,
			'priceCM'  : 1.5,
			'gap'      : 17.64
		}			
		],
		'amount' : 50,
		'maxHeight': 250,
		'name': 'Roleta Mini'
	},

}


// (parseFloat(parseInt(products['001'].price)/currency.us)).toFixed(2)
app.init($('.form-container'));