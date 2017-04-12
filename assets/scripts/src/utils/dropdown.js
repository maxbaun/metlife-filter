import {containsElement, click} from './componentHelpers';

export default class Dropdown {
	constructor(element) {
		this.element = jQuery(element);
		this.list = this.element.find('.mlf-filter-dropdown-list').first();
		this.toggle = this.element.find('.mlf-filter-dropdown-selected').first();
		this.open = false;

		this.element.click(click(this.handleClick.bind(this)));
		jQuery('body').bind('click', click(this.documentClick.bind(this)));
	}

	documentClick(e) {
		if (!containsElement(e, this.element)) {
			this.hide();
		}
	}

	handleClick(e) {
		if (this.open && !containsElement(e, this.list)) {
			return this.hide();
		}

		return this.show();
	}

	hide() {
		this.list.slideUp('fast');
		this.open = false;
	}

	show() {
		this.list.slideDown('fast');
		this.open = true;
	}
}
