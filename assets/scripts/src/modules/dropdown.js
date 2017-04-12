import {containsElement, click} from '../utils/componentHelpers';

export default class Dropdown {
	constructor(element) {
		this.element = jQuery(element);
		this.list = this.element.find('.mlf-filter-dropdown-list').first();
		this.toggle = this.element.find('.mlf-filter-dropdown-selected').first();
		this.all = this.element.find('input[value="all"]');
		this.inputs = this.element.find('input[type="checkbox"]');
		this.label = this.element.find('.mlf-filter-dropdown-selected-label span');
		this.open = false;

		this.element.click(click(this.handleClick.bind(this)));
		this.inputs.click(click(this.handleInputClick.bind(this)));
		this.inputs.change(this.updateText.bind(this));
		jQuery('body').bind('click', click(this.documentClick.bind(this)));

		this.updateText();
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

	handleInputClick(e) {
		const allChecked = this.all.attr('checked');

		if (containsElement(e, this.all)) {
			this.toggleAllInputs(allChecked);
			return true;
		}

		this.all.removeAttr('checked');

		return true;
	}

	updateText() {
		const checkedInputs = this.getCheckedInputs();
		const text = this.getText(checkedInputs);
		this.label.text(text);
		return true;
	}

	getText(checkedInputs) {
		let numChecked = checkedInputs.length;

		if (numChecked === this.inputs.length) {
			return 'All';
		}

		if (numChecked === 1) {
			return jQuery(checkedInputs[0]).data('value');
		}

		if (numChecked > 1) {
			return 'Multiple';
		}

		return '';
	}

	getCheckedInputs() {
		return this.inputs.filter((index, input) => jQuery(input).attr('checked'));
	}

	toggleAllInputs(checked) {
		if (checked) {
			this.inputs.attr('checked', 'checked');
		} else {
			this.inputs.removeAttr('checked');
		}
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
