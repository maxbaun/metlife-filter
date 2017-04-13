import Dropdown from './dropdown';
import {cookieSet} from '../utils/cookie';
import {windowReload} from '../utils/componentHelpers';

export default class Filter {
	constructor(element) {
		this.element = jQuery(element);
		this.dropdowns = [];

		this.element.find('.mlf-filter-dropdown')
			.each((index, elem) => {
				this.dropdowns.push(new Dropdown(elem));
			});

		this.form = this.element.find('form').first();

		this.form.submit(this.handleSubmit.bind(this));
	}

	handleSubmit(e) {
		e.preventDefault();
		const target = jQuery(e.target);

		cookieSet(target.serialize())
			.then(windowReload);
	}
}
