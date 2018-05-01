/**
 * @description 封装一个异步调用函数
 * @param {String} url
 * @param {Object} data
 * @param {Function} callback
 */
$.Post = function () {
	var urlPrefix="http://www.wushengsy.com/";
    var args = arguments;
    var url, data, callback;

    if (args.length == 2) {
        url = args[0];
        callback = typeof args[1] === 'function' && args[1];
    }

    if (args.length == 3) {
        url = args[0];
        data = args[1];
        callback = args[2];
    }

	$.ajax({
		type:"post",
		url: (url.indexOf('http://') == 0 ? url : urlPrefix + url),
		data: data,
        dataType: "json",
        crossDomain: true,
		async:true,
		success: function (d) {
            callback(d);
        },
	});
	
}

function getPageVar ( sVar ) {
  return decodeURI(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURI(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
}
