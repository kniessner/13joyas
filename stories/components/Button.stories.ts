import { fn } from 'storybook/test';
import type { Meta, StoryObj } from '@storybook/html';

const meta: Meta = {
	title: 'Components/Button',
	tags: ['autodocs'],
	render: ( args ) => {
		const classes = ['wp-block-button__link', 'wp-element-button'];
		if ( args.variant === 'outline' ) classes.push('is-style-outline');
		return `
			<div class="wp-block-button">
				<a class="${classes.join(' ')}" href="#" style="
					background-color: ${args.variant === 'outline' ? 'transparent' : args.bgColor};
					color: ${args.variant === 'outline' ? args.bgColor : '#FFFFFF'};
					border: 2px solid ${args.bgColor};
					padding: 0.75rem 2rem;
					border-radius: 2px;
					text-decoration: none;
					display: inline-block;
				">${args.label}</a>
			</div>
		`;
	},
	argTypes: {
		variant: { control: 'radio', options: ['filled', 'outline'] },
		bgColor: { control: 'color' },
		label: { control: 'text' },
	},
	args: {
		onClick: fn(),
		variant: 'filled',
		bgColor: '#C9A96E',
		label: 'Explore Collection',
	},
};

export default meta;

type Story = StoryObj<typeof meta>;

export const Primary: Story = { args: { variant: 'filled', bgColor: '#C9A96E' } };
export const Outline: Story = { args: { variant: 'outline', bgColor: '#C9A96E' } };
export const Dark: Story = { args: { variant: 'filled', bgColor: '#0A0A0A' } };
