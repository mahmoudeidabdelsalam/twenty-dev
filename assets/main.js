// Webpack Imports
import * as bootstrap from 'bootstrap';
import 'owl.carousel';

import lightslider from 'lightslider';
import lightGallery from 'lightgallery';
// Plugins
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'

(function () {
	'use strict';

	// Focus input if Searchform is empty
	[].forEach.call(document.querySelectorAll('.search-form'), (el) => {
		el.addEventListener('submit', function (e) {
			var search = el.querySelector('input');
			if (search.value.length < 1) {
				e.preventDefault();
				search.focus();
			}
		});
	});

	// Initialize Popovers: https://getbootstrap.com/docs/5.0/components/popovers
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
	var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		return new bootstrap.Popover(popoverTriggerEl, {
			trigger: 'focus',
		});
	});

  const myCarouselElement = document.querySelector('#carouselExampleIndicators');

  const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 2000,
    touch: false
  });
  console.log(carousel);

  const carouselBasicCar = document.querySelector('#carouselBasicCar');

  const carouselSingle = new bootstrap.Carousel(carouselBasicCar, {
    interval: 2000,
    touch: false
  });
  console.log(carouselSingle);

  var toastElList = [].slice.call(document.querySelectorAll('.toast'))
  var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, option)
  });
  console.log(toastList);
})();
