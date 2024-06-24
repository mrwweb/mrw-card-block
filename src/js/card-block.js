import { registerBlockVariation } from '@wordpress/blocks';
import { createElement, Fragment } from '@wordpress/element';
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';
import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorControls, useSettings } from '@wordpress/block-editor';
import { SelectControl } from '@wordpress/components';

/**
 * Register the Attribute
 *
 * @param {Object} settings
 */
function addCardAttributes(settings) {
	const { name } = settings;
	if ('core/media-text' === name) {
		settings.attributes = Object.assign({}, settings.attributes, {
			aspectRatio: {
				type: 'string',
			},
		});
	}

	return settings;
}
addFilter(
	'blocks.registerBlockType',
	'mrw-card-block/add-card-attributes',
	addCardAttributes
);

/**
 * Add the controls in the sidebar
 */
const addCardControls = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const {
			attributes: { className, aspectRatio },
			setAttributes,
			name,
		} = props;

		const [defaultAspectRatios, globalAspectRatios] = useSettings(
			'dimensions.defaultAspectRatios',
			'dimensions.aspectRatios'
		);
		if (
			name !== 'core/media-text' ||
			!className?.includes('mrw-card-block') ||
			(!defaultAspectRatios && globalAspectRatios.length === 0)
		) {
			return <BlockEdit {...props} />;
		}

		const aspectRatioOptions = globalAspectRatios.map((ratio) => {
			return {
				label: ratio.name,
				value: ratio.ratio,
			};
		});
		aspectRatioOptions.unshift({ label: __('Original'), value: '' });

		return (
			<Fragment>
				<BlockEdit {...props} />
				<InspectorControls group="settings">
					<SelectControl
						label={__('Image Aspect Ratio', 'mrw-card-block')}
						value={aspectRatio}
						options={aspectRatioOptions}
						onChange={(value) => {
							setAttributes({
								aspectRatio: validateRatio(value),
							});
						}}
						className="aspect-ratio-control"
					/>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'addCardControls');

addFilter(
	'editor.BlockEdit',
	'mrw-card-block/add-card-controls',
	addCardControls
);

/**
 * Add CSS classes to the block in the editor (but not the save object to avoid issues with block validation)
 */
const addCardStyles = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const {
			attributes: { className, aspectRatio },
			name,
		} = props;
		if (
			!className?.includes('mrw-card-block') ||
			name !== 'core/media-text' ||
			aspectRatio === ''
		) {
			return <BlockListBlock {...props} />;
		}

		const styles = {
			'--mrw-card--ratio': aspectRatio,
		};

		const wrapperProps = {
			...props.wrapperProps,
			style: styles,
		};

		return <BlockListBlock {...props} wrapperProps={wrapperProps} />;
	};
}, 'addCardStyles');

addFilter(
	'editor.BlockListBlock',
	'mrw-card-block/card-block-styles',
	addCardStyles
);

function validateRatio(ratio) {
	const ratioRegex = /([0-9]{1,4})\/([0-9]{1,4})/;
	const match = ratio.match(ratioRegex);
	if (ratio === '1' || (match.length > 0 && match[0] === ratio)) {
		return ratio;
	}
	return '';
}

/* Register the Variation */
wp.domReady(function () {
	const el = createElement;

	const cardIcon = el(
		'svg',
		{ width: 24, height: 24 },
		el('path', {
			d: 'M 5,11 H 19 V 4 H 5 Z m 0,4 H 19 V 13 H 5 Z m 0,4 H 19 V 17 H 5 Z',
		})
	);

	/* Card Block (Media & Text) */
	registerBlockVariation('core/media-text', {
		name: 'mrw-card',
		title: 'Card',
		icon: cardIcon,
		attributes: {
			className: 'mrw-card-block',
			mediaSizeSlug: 'medium',
			imageFill: true,
			align: '',
		},
		innerBlocks: [['core/heading', { level: 3 }], ['core/paragraph']],
		isActive: (blockAttributes) =>
			blockAttributes.className?.includes('mrw-card-block'),
	});
});
