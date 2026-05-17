/**
 * Theme front-end entry.
 */
import '../scss/main.scss';
import { store } from '@wordpress/interactivity';

interface JoyasState {
	menuOpen: boolean;
}

interface JoyasActions {
	toggleMenu: () => void;
}

// Example Interactivity API store.
const { state } = store<JoyasState, JoyasActions>( 'joyas', {
	state: {
		menuOpen: false,
	},
	actions: {
		toggleMenu: (): void => {
			state.menuOpen = ! state.menuOpen;
		},
	},
} );

// Log store state for HMR verification.
if ( import.meta.hot ) {
	import.meta.hot.accept( () => {
		console.log( '[Joyas] HMR active. Store state:', state );
	} );
}
