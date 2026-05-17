import type { Meta, StoryObj } from '@storybook/html';

const colors = [
	{ name: 'Obsidian', hex: '#0A0A0A', text: '#FFFFFF' },
	{ name: 'Charcoal', hex: '#1C1C1C', text: '#FFFFFF' },
	{ name: 'Gold', hex: '#C9A96E', text: '#0A0A0A' },
	{ name: 'Linen', hex: '#F5F2EB', text: '#0A0A0A' },
	{ name: 'White', hex: '#FFFFFF', text: '#0A0A0A' },
	{ name: 'Ash', hex: '#4A4A4A', text: '#FFFFFF' },
	{ name: 'Sand', hex: '#E8E4DB', text: '#0A0A0A' },
];

const meta: Meta = {
	title: 'Tokens/Colors',
	tags: ['autodocs'],
	render: () => `
		<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; padding: 2rem;">
			${colors.map(c => `
				<div style="
					background: ${c.hex};
					color: ${c.text};
					padding: 2rem;
					border-radius: 4px;
					font-family: sans-serif;
				">
					<strong>${c.name}</strong><br/>
					<code style="opacity: 0.8; font-size: 0.875rem;">${c.hex}</code>
				</div>
			`).join('')}
		</div>
	`,
};

export default meta;

type Story = StoryObj<typeof meta>;

export const Palette: Story = {};
