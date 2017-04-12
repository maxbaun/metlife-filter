module.exports.cookieSet = data => {
	const action = `${METLIFE_FILTER.ajaxUrl}?action=mlf_set_cookie`;
	return new Promise((resolve, reject) => {
		jQuery.ajax({
			url: action,
			method: 'post',
			dataType: 'json',
			data,
			success: response => {
				return (response.data) ? resolve(response.data) : reject(response.error);
			}
		});
	});
};

module.exports.cookieGet = () => {
	const action = `${METLIFE_FILTER.ajaxUrl}?action=mlf_get_cookie`;
	return new Promise((resolve, reject) => {
		jQuery.ajax({
			url: action,
			method: 'get',
			dataType: 'json',
			success: response => {
				return (response.data) ? resolve(response.data) : reject(response.error);
			}
		});
	});
};
