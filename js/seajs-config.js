var urlHost = "http://192.168.2.222:8020/wushengsy.com/";

seajs.config({
	base: urlHost,
	alias: {
		"jquery": "node_modules/jquery/dist/jquery.min.js",
		"vue": "node_modules/vue/dist/vue.js",
		"nsw_index":"js/nsw_index.js",
		"common": "js/common.js"
	}
});