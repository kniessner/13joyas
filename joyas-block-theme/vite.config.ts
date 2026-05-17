import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import { v4wp } from '@kucrut/vite-for-wp';
import { resolve } from 'path';

export default defineConfig( {
	build: {
		target: 'es2022',
		outDir: 'dist',
		emptyOutDir: true,
		cssCodeSplit: true,
		minify: 'terser',
		terserOptions: {
			output: {
				comments: false,
			},
		},
		rollupOptions: {
			output: {
				manualChunks: undefined,
			},
		},
	},
	plugins: [
		react(),
		v4wp( {
			input: {
				main:   resolve( __dirname, 'src/ts/main.ts' ),
				editor: resolve( __dirname, 'src/ts/editor.ts' ),
			},
			outDir: 'dist',
		} ),
	],
	resolve: {
		alias: {
			'@styles': resolve( __dirname, 'src/scss' ),
			'@scripts': resolve( __dirname, 'src/ts' ),
		},
	},
	css: {
		devSourcemap: true,
	},
	server: {
		port: 3000,
		strictPort: true,
		cors: true,
		hmr: {
			port: 3000,
		},
	},
	optimizeDeps: {
		esbuildOptions: {
			target: 'es2022',
		},
	},
} );
