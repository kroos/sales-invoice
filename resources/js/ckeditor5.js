// import $ from 'jquery';

import {
	ClassicEditor,
	Essentials,
	Paragraph,
	Bold,
	Italic,
	Font
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

/*
|--------------------------------------------------------------------------
| Toolbar Presets
|--------------------------------------------------------------------------
*/

const toolbars = {
	basic: [
		'undo', 'redo', '|',
		'bold', 'italic'
	],

	advance: [
		'undo', 'redo', '|',
		'bold', 'italic', '|',
		'fontSize', 'fontFamily',
		'fontColor', 'fontBackgroundColor'
	]
};

/*
|--------------------------------------------------------------------------
| Base Plugins (only what you already imported)
|--------------------------------------------------------------------------
*/

const basePlugins = [
	Essentials,
	Paragraph,
	Bold,
	Italic,
	Font
];

/*
|--------------------------------------------------------------------------
| Config Factory
|--------------------------------------------------------------------------
*/

function buildConfig(options = {}) {

	const { toolbar, ...rest } = options;

	const preset = toolbar && toolbars[toolbar]
	? toolbars[toolbar]
	: toolbars.basic;

	return {
		licenseKey: 'GPL',
		plugins: basePlugins,
		toolbar: preset,
		...rest
	};
}

/*
|--------------------------------------------------------------------------
| jQuery Plugin
|--------------------------------------------------------------------------
*/

$.fn.ckeditor = function (options = {}) {

	return this.each(function () {

		const el = this;

		if (el.dataset.ckeditorInitialized) return;

		ClassicEditor.create(el, buildConfig(options))
		.then(editor => {
			el.dataset.ckeditorInitialized = true;
			el.ckeditorInstance = editor;
		})
		.catch(console.error);

	});
};

/*
|--------------------------------------------------------------------------
| Optional: destroy helper
|--------------------------------------------------------------------------
*/

$.fn.destroyckeditor = function () {
	return this.each(function () {
		if (this.ckeditorInstance) {
			this.ckeditorInstance.destroy();
			delete this.dataset.ckeditorInitialized;
		}
	});
};
