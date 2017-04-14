import Dropdown from './dropdown';
import {cookieSet} from '../utils/cookie';
import {windowReload, buttonLoading} from '../utils/componentHelpers';

export default class Filter {
	constructor(element) {
		this.element = jQuery(element);
		this.dropdowns = [];

		this.submitButton = this.element.find('input[type="submit"]').first();

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

		buttonLoading(this.submitButton);

		cookieSet(target.serialize())
			.then(windowReload);
	}
}
