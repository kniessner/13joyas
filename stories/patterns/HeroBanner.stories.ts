import type { Meta, StoryObj } from '@storybook/html';

const meta: Meta = {
	title: 'Patterns/Hero Banner',
	tags: ['autodocs'],
	render: ( args ) => `
		<div class="wp-block-cover alignfull" style="
			min-height: 60vh;
			display: flex;
			align-items: center;
			justify-content: center;
			background: linear-gradient(rgba(10,10,10,0.6), rgba(10,10,10,0.6)), url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"100\" height=\"100\"><rect fill=\"%23E8E4DB\" width=\"100\" height=\"100\"/></svg>');
			background-size: cover;
			color: #F5F2EB;
		">
			<div style="text-align:center; padding: 6rem 1.5rem;">
				<h1 style="
					font-family: 'Playfair Display', serif;
					font-size: clamp(2.5rem, 6vw, 5rem);
					margin: 0 0 1.5rem;
					color: #FFFFFF;
				">${args.heading}</h1>
				<p style="
					font-size: 1.25rem;
					margin: 0 0 2rem;
					color: #E8E4DB;
				">${args.subheading}</p>
				<a href="#" class="wp-block-button__link wp-element-button" style="
					background-color: #C9A96E;
					color: #FFFFFF;
					padding: 0.75rem 2rem;
					border-radius: 2px;
					text-decoration: none;
					display: inline-block;
				">${args.cta}</a>
			</div>
		</div>
	`,
	argTypes: {
		heading: { control: 'text' },
		subheading: { control: 'text' },
		cta: { control: 'text' },
	},
	args: {
		heading: 'Timeless Elegance',
		subheading: 'Discover the art of fine jewelry, crafted to stand the test of time.',
		cta: 'Explore Collection',
	},
};

export default meta;

type Story = StoryObj<typeof meta>;

export const Default: Story = {};

export const Alternate: Story = {
	args: {
		heading: 'Crafted with Precision',
		subheading: 'Every piece tells a story of dedication and mastery.',
		cta: 'View Our Process',
	},
};
