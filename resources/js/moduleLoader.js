const context = require.context(
																'./modules',
																true,
																/\.js$/
																);

const ACTION_MAP = {
	create: 'form',
	edit: 'form'
};

function generateCandidates(routeName) {

	const parts = routeName.split('.');
	const action = parts.pop();
	const folderPath = parts.join('/');

	const candidates = [];

		// 1️⃣ ACTION_MAP candidate
	if (ACTION_MAP[action]) {
		const mapped = ACTION_MAP[action];

		candidates.push(
										folderPath
										? `./${folderPath}/${mapped}.js`
										: `./${mapped}.js`
										);
	}

		// 2️⃣ Original action fallback
	candidates.push(
									folderPath
									? `./${folderPath}/${action}.js`
									: `./${action}.js`
									);

	return candidates;
}

export async function loadModule(routeName) {

	if (!routeName) return;

	try {

		const candidates = generateCandidates(routeName);
		const available = context.keys();

		const modulePath = candidates.find(p => available.includes(p));

		if (!modulePath) {
			console.log(
		`[ModuleLoader] Missing module for route "${routeName}".\n` +
	`Tried:\n${candidates.join('\n')}`
	);
			return;
		}

		const module = context(modulePath);

		if (module.default) {
			await module.default({ routeName });
		}

	} catch (error) {
		console.error('[ModuleLoader] Failed to load module', routeName, error);
	}
}
