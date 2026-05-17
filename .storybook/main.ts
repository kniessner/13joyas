import type { StorybookConfig } from '@storybook/html-vite';

const config: StorybookConfig = {
	stories: [
		'../stories/**/*.mdx',
		'../stories/**/*.stories.@(js|jsx|mjs|ts|tsx)',
	],
	addons: ['@storybook/addon-links', '@storybook/addon-docs'],
	framework: {
		name: '@storybook/html-vite',
		options: {},
	},
	core: {
		builder: '@storybook/builder-vite',
	},
	viteFinal: async ( config ) => {
		config.resolve = config.resolve || {};
		config.resolve.alias = {
			...( config.resolve.alias || {} ),
			'@styles': new URL( '../joyas-block-theme/src/scss', import.meta.url ).pathname,
		};
		config.css = config.css || {};
		config.css.preprocessorOptions = {
			scss: {
				additionalData: `@use "@styles/tokens" as *;`,
			},
		};
		return config;
	},
};

export default config;
