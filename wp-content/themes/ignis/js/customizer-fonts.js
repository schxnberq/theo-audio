/*
 * jQuery.fontselect - A font selector for the Google Web Fonts api
 * Tom Moor, http://tommoor.com
 * Copyright (c) 2011 Tom Moor
 * MIT Licensed
 * @version 0.1
*/
!function(a){a.fn.fontselect=function(b){var c=function(a,b){return function(){return a.apply(b,arguments)}},d=["Abel","Abril+Fatface","Advent+Pro","Alegreya","Anton","Arimo","Arvo","Asar","Average","Bitter","Cabin+Sketch","Chivo","Crimson+Text","Dancing+Script","Dosis","Droid+Sans","Droid+Serif","Fanwood+Text","Fira+Sans","Gloria+Hallelujah","Inconsolata","Indie+Flower","Josefin+Sans","Josefin+Slab","Karla","Kaushan+Script","Lato","Libre+Baskerville","Lora","Maven+Pro","Merriweather","Merriweather+Sans","Montserrat","Nixie+One","Noto+Sans","Noto+Serif","Nunito","Open+Sans","Open+Sans+Condensed","Oswald","Oxygen","Oxygen+Mono","PT+Mono","PT+Sans","PT+Sans+Caption","PT+Sans+Narrow","PT+Serif","Pacifico","Playfair+Display","Poiret+One","Poppins","Quicksand","Raleway","Roboto","Roboto+Condensed","Roboto+Mono","Roboto+Slab","Rokkitt","Shadows+Into+Light","Slabo+27px","Source+Sans+Pro","Source+Serif+Pro","Titillium+Web","Ubuntu","Ubuntu+Condensed","Ubuntu+Mono","Yanone+Kaffeesatz"],e={style:"font-select",placeholder:"Select a font",lookahead:2,api:"//fonts.googleapis.com/css?family="},f=function(){function b(b,c){this.$original=a(b),this.options=c,this.active=!1,this.setupHtml(),this.getVisibleFonts(),this.bindEvents();var d=this.$original.val();d&&(this.updateSelected(),this.addFontLink(d))}return b.prototype.bindEvents=function(){a("li",this.$results).click(c(this.selectFont,this)).mouseenter(c(this.activateFont,this)).mouseleave(c(this.deactivateFont,this)),a("span",this.$select).click(c(this.toggleDrop,this)),this.$arrow.click(c(this.toggleDrop,this))},b.prototype.toggleDrop=function(a){this.active?(this.$element.removeClass("font-select-active"),this.$drop.hide(),clearInterval(this.visibleInterval)):(this.$element.addClass("font-select-active"),this.$drop.show(),this.moveToSelected(),this.visibleInterval=setInterval(c(this.getVisibleFonts,this),500)),this.active=!this.active},b.prototype.selectFont=function(){var b=a("li.active",this.$results).data("value");this.$original.val(b).change(),this.updateSelected(),this.toggleDrop()},b.prototype.moveToSelected=function(){var b,c=this.$original.val();b=c?a("li[data-value='"+c+"']",this.$results):a("li",this.$results).first(),this.$results.scrollTop(b.addClass("active").position().top)},b.prototype.activateFont=function(b){a("li.active",this.$results).removeClass("active"),a(b.currentTarget).addClass("active")},b.prototype.deactivateFont=function(b){a(b.currentTarget).removeClass("active")},b.prototype.updateSelected=function(){var b=this.$original.val();a("span",this.$element).text(this.toReadable(b)).css(this.toStyle(b))},b.prototype.setupHtml=function(){this.$original.empty().hide(),this.$element=a("<div>",{class:this.options.style}),this.$arrow=a("<div><b></b></div>"),this.$select=a("<a><span>"+this.options.placeholder+"</span></a>"),this.$drop=a("<div>",{class:"fs-drop"}),this.$results=a("<ul>",{class:"fs-results"}),this.$original.after(this.$element.append(this.$select.append(this.$arrow)).append(this.$drop)),this.$drop.append(this.$results.append(this.fontsAsHtml())).hide()},b.prototype.fontsAsHtml=function(){for(var b,c,a=d.length,e="",f=0;f<a;f++)b=this.toReadable(d[f]),c=this.toStyle(d[f]),e+='<li data-value="'+d[f]+'" style="font-family: '+c["font-family"]+"; font-weight: "+c["font-weight"]+'">'+b+"</li>";return e},b.prototype.toReadable=function(a){return a.replace(/[\+|:]/g," ")},b.prototype.toStyle=function(a){var b=a.split(":");return{"font-family":this.toReadable(b[0]),"font-weight":b[1]||400}},b.prototype.getVisibleFonts=function(){if(!this.$results.is(":hidden")){var b=this,c=this.$results.scrollTop(),d=c+this.$results.height();if(this.options.lookahead){var e=a("li",this.$results).first().height();d+=e*this.options.lookahead}a("li",this.$results).each(function(){var e=a(this).position().top+c;if(e+a(this).height()>=c&&e<=d){var g=a(this).data("value");b.addFontLink(g)}})}},b.prototype.addFontLink=function(b){var c=this.options.api+b;0===a("link[href*='"+b+"']").length&&a("link:last").after('<link href="'+c+'" rel="stylesheet" type="text/css">')},b}();return this.each(function(b){return b&&a.extend(e,b),new f(this,e)})}}(jQuery);

jQuery(function($) {
	$('#customize-control-headings_font_family input,#customize-control-body_font_family input').fontselect({
   		style: 'font-select',
    	lookahead: 2
	});
});