module.exports.containsElement = (e, elem) => {
	const target = jQuery(e.target);

	if (!target || !target.parents().andSelf().is(elem)) {
		return false;
	}

	return true;
};

module.exports.click = (func, val) => {
	return e => {
		return (func && typeof func === 'function') ? func(val || typeof val !== 'undefined' ? val : e) : null;
	};
};

module.exports.clickOnly = (func, val) => {
	return e => {
		e.stopPropagation();
		e.preventDefault();

		return (func && typeof func === 'function') ? func(val || typeof val !== 'undefined' ? val : e) : null;
	};
};

module.exports.windowReload = () => {
	window.location.reload();
};

module.exports.buttonLoading = button => {
	const loader = jQuery(button).siblings('[data-loader]');

	button.attr('disabled', 'disabled');
	jQuery(button).hide();
	loader.css('display', 'inline-block')
		.show();
};
