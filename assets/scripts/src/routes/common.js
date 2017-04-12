import Dropdown from '../utils/dropdown';

export default {
	init() {
		// JavaScript to be fired on all pages
	},
	finalize() {
		jQuery('.mlf-filter-dropdown')
			.each((index, elem) => new Dropdown(elem));
	}
};
