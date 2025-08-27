<?php
// This file is generated. Do not modify it manually.
return array(
	'boutons-partages' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'gn2025/boutons-partages',
		'version' => '0.1.0',
		'title' => 'Share Buttons',
		'category' => 'gn-block-theme',
		'icon' => 'megaphone',
		'description' => 'Choose share buttons',
		'example' => array(

		),
		'attributes' => array(
			'facebook' => array(
				'type' => 'boolean',
				'default' => true
			),
			'linkedin' => array(
				'type' => 'boolean',
				'default' => true
			),
			'whatsapp' => array(
				'type' => 'boolean',
				'default' => true
			),
			'email' => array(
				'type' => 'boolean',
				'default' => true
			),
			'copyLink' => array(
				'type' => 'boolean',
				'default' => true
			),
			'iconsGap' => array(
				'type' => 'string',
				'default' => '12px'
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => false
			),
			'typography' => array(
				'fontSize' => true
			),
			'spacing' => array(
				'margin' => true
			),
			'multiple' => true,
			'className' => true
		),
		'textdomain' => 'gn-block-react',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'image-icone' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'gn2025/image-icone',
		'version' => '0.1.0',
		'title' => 'Icon Image',
		'category' => 'gn-block-content',
		'icon' => 'buddicons-activity',
		'description' => 'Add an icon',
		'example' => array(

		),
		'attributes' => array(
			'icon' => array(
				'type' => 'string',
				'default' => 'ea11'
			),
			'link' => array(
				'type' => 'string'
			),
			'targetBlank' => array(
				'type' => 'boolean',
				'default' => false
			),
			'ariaLabel' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'supports' => array(
			'html' => false,
			'color' => array(
				'text' => true,
				'background' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true
			),
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'multiple' => true,
			'className' => true,
			'__experimentalBorder' => array(
				'radius' => true,
				'__experimentalDefaultControls' => array(
					'radius' => true
				)
			)
		),
		'textdomain' => 'gn-block-react',
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php'
	),
	'retour-haut' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'gn2025/retour-haut',
		'version' => '0.1.0',
		'title' => 'Back to Top',
		'category' => 'gn-block-theme',
		'icon' => 'insert-before',
		'description' => 'Template button to go back to the top of the page.',
		'example' => array(

		),
		'attributes' => array(
			'rightPosition' => array(
				'type' => 'number',
				'default' => 15
			),
			'bottomPosition' => array(
				'type' => 'number',
				'default' => 15
			),
			'scrollTrigger' => array(
				'type' => 'number',
				'default' => 300
			),
			'iconSize' => array(
				'type' => 'number',
				'default' => 64
			)
		),
		'supports' => array(
			'html' => false,
			'anchor' => true,
			'align' => true,
			'spacing' => array(
				'padding' => true,
				'margin' => true
			)
		),
		'textdomain' => 'gn-block-react',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'slider' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'gn2025/slider',
		'version' => '0.4.0',
		'title' => 'Swiper Slider',
		'category' => 'gn-block-content',
		'icon' => 'images-alt2',
		'description' => 'Adds a slider that can integrate any block.',
		'example' => array(

		),
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			),
			'className' => true,
			'anchor' => true,
			'spacing' => array(
				'margin' => true
			)
		),
		'attributes' => array(
			'loop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'speed' => array(
				'type' => 'number',
				'default' => 400
			),
			'delay' => array(
				'type' => 'number',
				'default' => 3000
			),
			'navigationEnabled' => array(
				'type' => 'boolean',
				'default' => true
			),
			'paginationEnabled' => array(
				'type' => 'boolean',
				'default' => false
			),
			'scrollbarEnabled' => array(
				'type' => 'boolean',
				'default' => false
			),
			'autoplayEnabled' => array(
				'type' => 'boolean',
				'default' => false
			),
			'autoplayPauseOnHover' => array(
				'type' => 'boolean',
				'default' => false
			),
			'slidesPerView' => array(
				'type' => 'number',
				'default' => 1
			),
			'centeredSlides' => array(
				'type' => 'boolean',
				'default' => false
			),
			'autoHeight' => array(
				'type' => 'boolean',
				'default' => false
			),
			'equalHeight' => array(
				'type' => 'boolean',
				'default' => false
			),
			'spaceBetween' => array(
				'type' => 'number',
				'default' => 40
			),
			'navigationEnabledMobile' => array(
				'type' => 'boolean',
				'default' => false
			),
			'paginationEnabledMobile' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'gn-block-react',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'viewScript' => 'file:./view.js'
	),
	'slider-image' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'gn2025/slider-image',
		'version' => '1.1.0',
		'title' => 'Image Slider',
		'category' => 'gn-block-content',
		'icon' => 'images-alt',
		'description' => 'Slider based on Swiffy Slider',
		'example' => array(

		),
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'margin' => true
			),
			'align' => true,
			'anchor' => true,
			'multiple' => true,
			'className' => true
		),
		'attributes' => array(
			'images' => array(
				'type' => 'array',
				'default' => array(

				)
			),
			'imageSize' => array(
				'type' => 'string',
				'default' => 'large'
			),
			'ratio' => array(
				'type' => 'string',
				'default' => '16x9'
			),
			'hasAutoplay' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hasAutopause' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hasVisibleNav' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hasRevealEffect' => array(
				'type' => 'boolean',
				'default' => false
			),
			'animationType' => array(
				'type' => 'string',
				'default' => 'slide'
			),
			'hasBorder' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'gn-block-react',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
);
