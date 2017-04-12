import Filter from '../modules/filter';

export default {
	init() {
		// JavaScript to be fired on all pages
	},
	finalize() {
		jQuery('.mlf-filter')
			.each((index, elem) => new Filter(elem));
	}
};
