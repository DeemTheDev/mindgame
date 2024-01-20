(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 500;
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                $el.is(':input') && $el.on('keyup keypress',function(e){
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

formValidation = {
	init: function(){
		this.$form = $('.registration-form');
		this.$firstName = this.$form.find('input[name="firstName"]');
		this.$lastName = this.$form.find('input[name="lastName"]');
		this.$email = this.$form.find('input[name="email"]');
		this.$submitButton = this.$form.find('button.submit');
		
		this.validatedFields = {
			firstName: false,
			lastName: false,
			email: false
		};
		
		this.bindEvents();
	},
	bindEvents: function(){
		this.$firstName.donetyping(this.validateFirstNameHandler.bind(this));
		this.$lastName.donetyping(this.validateLastNameHandler.bind(this));
		this.$email.donetyping(this.validateEmailHandler.bind(this));
		this.$form.submit(this.submitFormHandler.bind(this));
	},
	validateFirstNameHandler: function(){
		this.validatedFields.firstName = this.validateText(this.$firstName);
	},
	validateLastNameHandler: function(){
		this.validatedFields.lastName = this.validateText(this.$lastName);
	},
	validateEmailHandler: function(){
		this.validatedFields.email = this.validateText(this.$email) && this.validateEmail(this.$email);
	},
	submitFormHandler: function(e){
		this.validateLastNameHandler();
		this.validateEmailHandler();
		if(this.validatedFields.lastName && this.validatedFields.email){
			// Simulate Ajax loading
			this.$submitButton.addClass('loading').html('<span class="loading-spinner"></span>')
			setTimeout((function(){
				this.$submitButton.removeClass('loading').addClass('success').html('Welcome, '+this.$firstName.val())
			}).bind(this), 1500);
		}else{
			e.preventDefault();
			this.$submitButton.text('Please Fix the Errors');
			setTimeout((function(){
				if(this.$submitButton.text() == 'Please Fix the Errors'){
					this.$submitButton.text('I accept the terms and condtions');
				}
			}).bind(this), 3000)
		}
	},
	
	validateText: function($input){
		$input.parent().removeClass('invalid');
		$input.parent().find('span.label-text small.error').remove();
		if($input.val() != ''){
			return true;
		}else{
			$input.parent().addClass('invalid');
			$input.parent().find('span.label-text').append(' <small class="error">(Field is empty)</small>');
			return false;
		}
	},
	validateEmail: function($input){
		var regEx = /\S+@\S+\.\S+/;
		$input.parent().removeClass('invalid');
		$input.parent().find('span.label-text small.error').remove();
    if(regEx.test($input.val())){
			return true;
		}else{
			$input.parent().addClass('invalid');
			$input.parent().find('span.label-text').append(' <small class="error">(Email is invalid)</small>');
			return false;
		}
	}	
}.init();