/*
 *
 * Copyright (c) 2007, J.P.Westerhof <rater@edesign.nl>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of eDesign.nl, eDesign or J.P.Westerhof nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY J.P.WESTERHOF ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL J.P.WESTERHOF BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

/*
 * Rater version 2.0.2
 * 2007-11-11 03:04 GMT+0100
 */

var Rater = Class.create();
Object.extend(Rater.prototype, {
	mouseOnMe: false,
	pointer: null,
	pImg: null,
	lastElementValue: 0,
	initialize: function(element, options, optionsx, initial) {
		this.element = element;

		if(typeof(element) == 'string')
			this.element = $(element);
		
		if(options)
			if(typeof(options) != 'object')
				options.initial = parseFloat(options);

		if(optionsx)
		{
			if(typeof(optionsx) == 'object')
				Object.extend(options, optionsx);
			else
				options.initial = optionsx;
		}
		
		if(initial)
			options.initial = initial;
		
		this.options = Object.extend({
			width: null,
			height: null,
			
			initial: .5,
			
			rated: false,
			
			ratingto: null,
			
			steps: 0,
			snapAverage: false,
			
			cursor: 'pointer',
			cursorDefault: 'default',
			
			enablePointer: false,
			
			fg: null,
			bg: null,
			p: null,
			
			fg_torate: null,
			fg_rating: null,
			fg_rated: null,

			bg_torate: null,
			bg_rating: null,
			bg_rated: null,

			p_torate: null,
			p_rating: null,
			p_rated: null,
			
			p_color: '000000',
			fg_color: 'ff0000',
			bg_color: 'eeeeee',
			fg_color_rated: '7777dd',

			text: '%average% average with %votes% votes',
			textId: null,
			
			reratable: false,
			snapBack: true,
			
			inputId: null,
			
			ignorePointerWidth: false,
			
			mode: 'horizontal'
		}, options || {});
		
		this.snapBackTo = this.options.initial;
		
		if(this.options.fg != null)
		{
			if(this.options.fg_torate == null)
				this.options.fg_torate = this.options.fg;
			if(this.options.fg_rating == null)
				this.options.fg_rating = this.options.fg;
			if(this.options.fg_rated == null)
				this.options.fg_rated = this.options.fg;
		}
		if(this.options.bg != null)
		{
			if(this.options.bg_torate == null)
				this.options.bg_torate = this.options.bg;
			if(this.options.bg_rating == null)
				this.options.bg_rating = this.options.bg;
			if(this.options.bg_rated == null)
				this.options.bg_rated = this.options.bg;
		}
		if(this.options.p != null)
		{
			if(this.options.p_torate == null)
				this.options.p_torate = this.options.p;
			if(this.options.p_rating == null)
				this.options.p_rating = this.options.p;
			if(this.options.p_rated == null)
				this.options.p_rated = this.options.p;
		}
		
		this.bg = document.createElement('div');
		Element.extend( this.bg );
		this.bg.setAttribute('id', 'rater_' + this.element.id + '_bg');
		if(this.options.bg_color != null)
			this.bg.setStyle({backgroundColor: '#' + this.options.bg_color});
		this.element.appendChild(this.bg);

		if(this.options.width == null)
			this.options.width = 100;
		if(this.options.height == null)
			this.options.height = 15;
		
		this.fg = document.createElement('div');
		Element.extend( this.fg );
		this.fg.setAttribute('id', 'rater_' + this.element.id + '_fg');
		this.element.appendChild(this.fg);

		if(this.options.enablePointer)
		{
			if(this.options.p_color != null && (this.options.p_torate == null && this.options.p_rating == null && this.options.p_rated == null))
				this.fg.setStyle({ borderRight: '1px solid #' + this.options.p_color});
			else
			{
				this.pointer = document.createElement('div');
				Element.extend( this.pointer );
				this.pointer.setAttribute('id', 'rater_' + this.element.id + '_pointer');
					this.pImg = document.createElement('img');
					Element.extend( this.pImg );
					if(this.options.rated)
						this.pImg.setAttribute('src', this.options.p_rated);
					else
						this.pImg.setAttribute('src', this.options.p_torate);
					this.pointer.appendChild(this.pImg);
				this.element.appendChild(this.pointer);
				this.pointer.setStyle({width: this.pImg.getWidth()+'px', height: this.pImg.getHeight()+'px'});
			}
		}
		
		if(this.options.mode == 'vertical')
		{
			this.bg.setStyle({backgroundPosition: 'bottom left'});
			this.fg.setStyle({backgroundPosition: 'bottom left'});
		}

		this.feeler = document.createElement('div');
		Element.extend( this.feeler );
		this.feeler.setAttribute('id', 'rater_' + this.element.id + '_feeler');
		this.element.appendChild(this.feeler);

		//enable or disable the rater
		if(this.options.rated)
			this.options.cursor = this.options.cursorDefault;
		
		var style = {
			width: parseInt(this.options.width) + 'px',
			height: parseInt(this.options.height) + 'px',
			cursor: this.options.cursor,
			overflow: 'hidden'
		};
		

		this.element.setStyle(style);
		this.bg.setStyle(Object.extend(style, {position: 'absolute', left: this.getPosition()[0]+'px', top: this.getPosition()[1]+'px'}));
		this.fg.setStyle(Object.extend(style, {position: 'absolute', left: this.getPosition()[0]+'px', top: this.getPosition()[1]+'px'}));
		if(this.pointer != null)
			this.pointer.setStyle(Object.extend({position: 'absolute', left: this.getPosition()[0]+'px', top: this.getPosition()[1]+'px'}));
		this.feeler.setStyle(Object.extend(style, {position: 'absolute', left: this.getPosition()[0]+'px', top: this.getPosition()[1]+'px'}));
		

		this.setValue(this.snapBackTo);

		//For some reason MSIE sets something like the z-index, but not THE z-index
		//of Pointer higher than feeler causing this.reset() to trigger
		//That is what this next if block is about... frikkin' MSIE #$^#$#$&!
		if(this.pointer != null)
		{
			Event.observe(this.pointer, 'mousemove', this.movingFromPointer.bindAsEventListener(this));
			Event.observe(this.pointer, 'mouseout', this.resetFromPointer.bindAsEventListener(this));
			Event.observe(this.pointer, 'click', this.registerClickFromPointer.bindAsEventListener(this));
		}
		
		Event.observe(this.feeler, 'mousemove', this.moving.bindAsEventListener(this));
		Event.observe(this.feeler, 'mouseout', this.reset.bindAsEventListener(this));
		Event.observe(this.feeler, 'click', this.click.bindAsEventListener(this));
		
		this.setStyle();
	},
	getPosition: function () {
		return new Array(Position.cumulativeOffset(this.element)[0], Position.cumulativeOffset(this.element)[1]);
	},
	movingFromPointer: function(event) { //frikkin' MSIE #$^#$#$&!
		if(this.pointer != null)
			this.pointer.setStyle({width: this.pImg.getWidth()+'px', height: this.pImg.getHeight()+'px'});
		this.mouseOnMe = true;
	},
	resetFromPointer: function(event) { //frikkin' MSIE #$^#$#$&!
		this.mouseOnMe = false;
		setTimeout(function(event){this.realReset(event);}.bind(this), 10);
	},
	registerClickFromPointer: function(event) { //frikkin' MSIE #$^#$#$&!
		this.setValueFromEvent(event, true);
		
		this.registerClick();
	},
	moving: function(event) {
		if(this.pointer != null)
			this.pointer.setStyle({width: this.pImg.getWidth()+'px', height: this.pImg.getHeight()+'px'});
		
		if(this.options.rated) return;
		
		if(!this.mouseOnMe)
		{
			this.mouseOnMe = true;
			this.setStyle();
		}
		
		this.setValueFromEvent(event);
	},
	reset: function(event) {
		this.mouseOnMe = false;
		
		// frikkin' MSIE #$^#$#$&!
		if(event.offsetY) //IE
			setTimeout(function(event){this.realReset(event);}.bind(this), 10);
		else
			this.realReset(event);
	},
	realReset: function(event) { //frikkin' MSIE #$^#$#$&!
		if(!this.mouseOnMe) {
			if(this.options.rated)
			{
				if(this.options.reratable)
					this.reable();
				return;
			}

			if(this.options.snapBack)
				this.setValue(this.snapBackTo);
			
			this.setStyle();
		}
	},
	click: function(event) {
		this.setValueFromEvent(event);
		
		this.registerClick();
	},
	registerClick: function() {
		if(this.options.rated)
		{
			if(this.options.reratable)
				this.reable();
			return;
		}
		
		if(!this.options.reratable)
		{
			this.disable();
		}
		
		try {
			new Effect.Highlight( this.feeler, {duration: .1, startcolor: '#ffffff'} );
		} catch(e) {}
		
		this.snapBackTo = this.getValue();
		
		if(this.options.inputId != null)
			$('inputId').value = this.getValue();
		
		if(this.options.ratingto)
		{
			if(typeof(this.options.ratingto) == 'function')
			{
				this.options.ratingto(this, this.getValue());
				this.snapBackTo = this.getValue();
			}
			else
			{
				if(this.options.ratingto != '')
				{
					new Ajax.Request(this.options.ratingto.replace(/%score%/gim, this.getValue()).replace(/%id%/gim, this.element.id), {
						method: 'get',
						onSuccess: function(transport) {
							var response = transport.responseText;

							var avg_score = 0;
							var votes = -1;
							var display = '';

							var parsed_response = Try.these(
							    function() { return eval('('+response+')'); },
							    function() { return parseFloat(response); }
							);

							if(typeof(parsed_response) == 'object')
							{
								avg_score = parsed_response.average;
								if(parsed_response.votes)
									votes = parsed_response.votes;
								if(parsed_response.display_average)
									display = parsed_response.display_average;
							}
							else
							{
								avg_score = parsed_response;
							}

							this.setValue(avg_score);
							this.snapBackTo = this.getValue();

							if(this.options.textId != null)
							{
								var ratingtext = '';

								if(display == '')
									ratingtext = this.options.text.replace(/%average%/gim, avg_score);
								else
									ratingtext = this.options.text.replace(/%average%/gim, display);

								if(votes > -1)
									ratingtext = ratingtext.replace(/%votes%/gim, votes);
								$(this.options.textId).innerHTML = ratingtext;
							}
						}.bind(this)
					});
				}
			}
		}
	},
	reable: function() {
		this.options.rated = false;
		this.feeler.setStyle({
			cursor: this.options.cursor
		});
		
		this.setStyle();
	},
	setValueFromEvent: function(event, fromPointer) {
		var elementValue = 0;

		if(!fromPointer) //frikkin' MSIE #$^#$#$&!
		{
			var pointerCorrection = this.getPointerCorrection();

			if(this.options.mode == 'vertical')
			{
				if(event.offsetY) //IE
					elementValue = event.offsetY;
				else //Mozilla (or event.layerY)
					elementValue = Event.pointerY(event) - Position.cumulativeOffset(this.feeler)[1];

				elementValue = this.getERD() - elementValue;
			}
			else
			{
				if(event.offsetX) //IE
					elementValue = event.offsetX;
				else //Mozilla (or event.layerX)
					elementValue = Event.pointerX(event) - Position.cumulativeOffset(this.feeler)[0];
			}

			if(!this.options.ignorePointerWidth && this.pointer != null)
				elementValue = Math.min(this.getERD(), Math.max(0, (elementValue - (pointerCorrection / 2)) * (this.getERD() / (this.getERD() - pointerCorrection))));

			this.lastElementValue = elementValue;
		}
		else
		{
			elementValue = this.lastElementValue; //frikkin' MSIE #$^#$#$&!
		}
		
		this.setValue(elementValue / this.getERD());
	},
	setValue: function(value) {
		this.value = value;
		
		if(this.options.steps > 0 && (this.mouseOnMe || this.options.snapAverage))
			this.value = (Math.round((this.value * this.getERD()) / (this.getERD() / this.options.steps))) / this.options.steps;
		
		this.drawValue();
	},
	getValue: function() {
		return this.value;
	},
	drawValue: function() {
		var value = this.getValue();
		var pointerCorrection = this.getPointerCorrection();
		
		if(this.options.mode == 'vertical')
		{
			var h = Math.round((value * (this.getERD() - pointerCorrection)) + Math.floor(pointerCorrection / 2));
			this.fg.setStyle({top: (this.getPosition()[1] + (this.options.height - h))+'px', height: h+'px'});
		}
		else
			this.fg.setStyle({width: Math.round((value * (this.getERD() - pointerCorrection)) + Math.floor(pointerCorrection / 2))+'px'});

		if(this.pointer != null)
		{
			if(this.options.mode == 'vertical')
				this.pointer.setStyle({top: (this.getPosition()[1] + (this.getERD() - Math.round(value * (this.getERD()) * ((this.getERD() - pointerCorrection) / this.getERD()))) - pointerCorrection)+'px'});
			else
				this.pointer.setStyle({left: (this.getPosition()[0] + Math.round(value * this.getERD() * ((this.getERD() - pointerCorrection) / this.getERD())))+'px'});
		}
	},
	getPointerCorrection: function() {
		var pointerCorrection = 0;
		if(!this.options.ignorePointerWidth && this.pointer != null)
		{
			if(this.options.mode == 'vertical')
				pointerCorrection = parseInt(this.pointer.getHeight())
			else
				pointerCorrection = parseInt(this.pointer.getWidth())
		}
		return pointerCorrection;
	},
	disable: function() {
		this.options.rated = true;
		this.feeler.setStyle({
			cursor: this.options.cursorDefault
		});
		
		
		this.setStyle();
	},
	setStyle: function() {
		var ifg = null;
		var ibg = null;
		var ip = null;
		
		if(this.mouseOnMe && !this.options.rated)
		{
			if(this.options.fg_rating != null)
				ifg = this.options.fg_rating;
			if(this.options.bg_rating != null)
				ibg = this.options.bg_rating;
			if(this.options.p_rating != null)
				ip = this.options.p_rating;
		} else {
			if(this.options.rated)
			{
				if(this.options.fg_rated != null)
					ifg = this.options.fg_rated;
				if(this.options.bg_rated != null)
					ibg = this.options.bg_rated;
				if(this.options.p_rated != null)
					ip = this.options.p_rated;
			} else {
				if(this.options.fg_torate != null)
					ifg = this.options.fg_torate;
				if(this.options.bg_torate != null)
					ibg = this.options.bg_torate;
				if(this.options.p_torate != null)
					ip = this.options.p_torate;
			}
		}
			
		if(ifg != null)
			this.fg.setStyle({ backgroundImage: 'url('+ifg+')'});
		if(ibg != null)
			this.bg.setStyle({ backgroundImage: 'url('+ibg+')'});
		if(ip != null)
			this.pImg.setAttribute('src', ip);

		if(this.options.fg_color != null)
		{
			if(this.options.rated)
			{
				if(this.options.fg_color_rated != null)
					this.fg.setStyle({ backgroundColor: '#' + this.options.fg_color_rated });
				else
					this.fg.setStyle({ backgroundColor: '#' + this.options.fg_color });
			}
			else
				this.fg.setStyle({ backgroundColor: '#' + this.options.fg_color });
		}
	},
	getERD: function () {
		if(this.options.mode == 'vertical')
			return this.options.height;
		return this.options.width;
	}
});

var raterLayout = {};
raterLayout.stars = {
	width: 150,
	height: 30,
	bg: "/public/image/rater/star_empty.gif",
	fg: "/public/image/rater/star_rate.gif",
	fg_rated: "/public/image/rater/star_full.gif",
	steps: "5",
	p_color: null,
	fg_color: null,
	bg_color: 'eeeeee',
	fg_color_rated: null
};
raterLayout.starsVertical = {
	mode: 'vertical',
	height: 150,
	width: 30,
	bg: "/public/image/rater/star_empty.gif",
	fg: "/public/image/rater/star_rate.gif",
	fg_rated: "/public/image/rater/star_full.gif",
	steps: "5",
	p_color: null,
	fg_color: null,
	bg_color: 'ffffff',
	fg_color_rated: null
};
raterLayout.slider = {
	enablePointer: true,
	steps: 9,
	snapAverage: true,
	p: "/public/image/rater/slider.gif",
	p_rating: "/public/image/rater/slider_act.gif",
	bg: "/public/image/rater/slider_rails.gif",
	fg: "/public/image/rater/slider_rails.gif",
	width: 162,
	height: 26,
	p_color: null,
	fg_color: null,
	bg_color: null,
	fg_color_rated: null
};
raterLayout.smooth = {
	enablePointer: true,
	p: "/public/image/rater/slider_smooth.gif",
	p_rating: "/public/image/rater/slider_smooth_act.gif",
	bg: "/public/image/rater/slider_smooth_rails.gif",
	fg: "/public/image/rater/slider_smooth_rails.gif",
	width: 162,
	height: 21,
	p_color: null,
	fg_color: null,
	bg_color: null,
	fg_color_rated: null
};
raterLayout.progressBar = {
	width: 396,
	initial: 0,
	height: 19,
	bg: "/public/image/rater/progress_empty.jpg",
	fg: "/public/image/rater/progress_full.jpg",
	p_color: null,
	fg_color: null,
	bg_color: null,
	fg_color_rated: null
}

function buildRaters (options) {
	if(!options)
		options = raterLayout.stars;
	
	var raters = $$('rater', options);
	for(var i = 0; i < raters.length; i++)
		new Rater(raters[i].id);
}
