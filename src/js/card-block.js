wp.domReady( function() {

	// Import the element creator function (React abstraction layer)
	const el = wp.element.createElement;

	const cardIcon = el('svg', { width: 24, height: 24 },
	  el('path', { d: "M 5,11 H 19 V 4 H 5 Z m 0,4 H 19 V 13 H 5 Z m 0,4 H 19 V 17 H 5 Z" } )
	);

	/* Card Block (Media & Text) */
	wp.blocks.registerBlockVariation(
		'core/media-text',
		{
			name: 'mrw-card',
			title: 'Card',
			icon: cardIcon,
			attributes: {
				className: 'mrw-card-block',
				mediaSizeSlug: 'medium',
				imageFill: true,
				align: ''
			},
			innerBlocks: [
				[ 'core/heading', { 'level': 3 } ],
				[ 'core/paragraph' ],
			],
			isActive: (blockAttributes) => blockAttributes.className?.includes('mrw-card-block'),
		}
	);

});
