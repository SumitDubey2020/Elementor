<?php

namespace Elementor;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Modules\DynamicTags\Module as TagsModule;
 

class MYEW_Example_Widget extends Widget_Base {

    public function get_name(){
        return 'myew-example-widget-id';
    }
    public function get_title() {
        return esc_html__( 'Testimonial', 'my-elementor-widget' );
    }
    public function get_script_depends() {
        return [
            'myew-script'
        ];
    }
    public function get_icon() {
        return 'fab fa-apple';
    }
    public function get_categories() {
        return [ 'myew-for-elementor' ];
    }
    public function register_controls() {
        $this->register_content_testimonials_controls();
		 $this->register_style_order_controls();
		$this->register_content_slider_options_controls();

		// /* Style Tab */
		 $this->register_style_testimonial_controls();
		 $this->register_style_content_controls();
		//  $this->register_style_image_controls();
		// $this->register_style_rating_controls();
		$this->register_style_arrows_controls();
		// $this->register_style_dots_controls();
		 //$this->register_style_thumbnail_nav_controls();
        // Content Settings
        
           
	}
        
    
		protected function register_style_testimonial_controls() {
        $this->start_controls_section(
			'section_testimonial_style',
			[
				'label' => __( 'Testimonial', 'my-elementor-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'row_spacing',
			[
				'label'                 => __( 'Row Spacing', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size'      => 20,
				],
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonials .pp-grid-item-wrap' => 'margin-bottom: {{SIZE}}px;',
				],
				'condition'             => [
					'layout'    => 'grid',
				],
			]
		);

		$this->add_responsive_control(
			'column_spacing',
			[
				'label'                 => __( 'Column Spacing', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size'      => 20,
				],
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 100,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonials .pp-testimonial-slide, {{WRAPPER}} .pp-testimonials .pp-grid-item-wrap' => 'padding-left: calc({{SIZE}}px/2); padding-right: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .pp-testimonials .slick-list, {{WRAPPER}} .pp-elementor-grid' => 'margin-left: calc(-{{SIZE}}px/2); margin-right: calc(-{{SIZE}}px/2);',
				],
				'separator'             => 'after',
				'condition'             => [
					'layout!'   => 'slideshow',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'slide_background',
				'types'                 => [ 'classic', 'gradient' ],
				'selector'              => '{{WRAPPER}} .card',
			]
		);

		$this->add_control(
			'slide_border',
			[
				'label'                 => __( 'Border', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'selectors'             => [
					'{{WRAPPER}} .card' => 'border-style: solid',
				],
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'slide_border_color',
			[
				'label'                 => __( 'Border Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .card' => 'border-color:{{VALUE}};'
					
				],
				'condition'             => [
					'slide_border'   => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'slide_border_width',
			[
				'label'                 => __( 'Border Width', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .card' => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .card' => 'top: -{{SIZE}}{{UNIT}}',
				],
				'condition'             => [
					'slide_border'   => 'yes',
				],
			]
		);

		$this->add_control(
			'slide_border_radius',
			[
				'label'                 => __( 'Border Radius', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'slide_box_shadow',
				'selector'              => '{{WRAPPER}} .card',
			]
		);

		$this->add_responsive_control(
			'slide_padding',
			[
				'label'                 => __( 'Inner Padding', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'selectors'             => [
					'{{WRAPPER}} .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator'             => 'before',
			]
		);

		$this->add_responsive_control(
			'slide_outer_padding',
			[
				'label'                 => __( 'Outer Padding', 'my-elementor-widget' ),
				'description'           => __( 'You must add outer padding for showing box shadow', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonial-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .pp-testimonials-wrap .pp-testimonials-thumb-item:before' => 'margin-top: -{{BOTTOM}}{{UNIT}}',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);


		$this->end_controls_section();

         //$this->style_tab();
    }


    protected function register_content_testimonials_controls() {
		$this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Testimonials', 'my-elementor-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

		$repeater = new Repeater();

		$repeater->add_control(
			'content',
			[
				'label'                => __( 'Content', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::TEXTAREA,
				'default'              => '',
				'dynamic'              => [
					'active'  => true,
				],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'                => __( 'Image', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::MEDIA,
				'dynamic'              => [
					'active'  => true,
				],
				'default'              => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'                => __( 'Name', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::TEXT,
				'default'              => __( 'John Doe', 'my-elementor-widget' ),
				'dynamic'              => [
					'active'  => true,
				],
			]
		);

		$repeater->add_control(
			'position',
			[
				'label'                => __( 'Position', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::TEXT,
				'default'              => __( 'CEO', 'my-elementor-widget' ),
				'dynamic'              => [
					'active'  => true,
				],
			]
		);

		$repeater->add_control(
			'rating',
			[
				'label'                => __( 'Rating', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::NUMBER,
				'min'                  => 0,
				'max'                  => 5,
				'step'                 => 0.1,
			]
		);

        $repeater->add_control(
            'link',
            [
                'label'                 => __( 'Link', 'my-elementor-widget' ),
                'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'        => true,
                    'categories'    => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY
                    ],
				],
                'placeholder'           => 'https://www.your-link.com',
            ]
        );

		$this->add_control(
			'testimonials',
			[
				'label'                => '',
				'type'                 => Controls_Manager::REPEATER,
				'default'              => [
					[
						'name'        => __( 'John Doe', 'my-elementor-widget' ),
						'position'    => __( 'CEO', 'my-elementor-widget' ),
						'content'     => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'my-elementor-widget' ),
					],
					[
						'name'        => __( 'John Doe', 'my-elementor-widget' ),
						'position'    => __( 'CEO', 'my-elementor-widget' ),
						'content'     => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'my-elementor-widget' ),
					],
					[
						'name'        => __( 'John Doe', 'my-elementor-widget' ),
						'position'    => __( 'CEO', 'my-elementor-widget' ),
						'content'     => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'my-elementor-widget' ),
					],
				],
				'fields'            => $repeater->get_controls(),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'                => __( 'Layout', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'carousel',
				'options'              => [
					'carousel'  => __( 'Carousel', 'my-elementor-widget' ),
					'slideshow' => __( 'Slideshow', 'my-elementor-widget' ),
					'grid'      => __( 'Grid', 'my-elementor-widget' ),
				],
				'separator'            => 'before',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'                 => __( 'Columns', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => '3',
				'tablet_default'        => '2',
				'mobile_default'        => '1',
				'options'               => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
				],
				'prefix_class'          => 'elementor-grid%s-',
				'frontend_available'    => true,
				'condition'             => [
					'layout'    => 'grid',
				],
			]
		);

		

		$this->add_control(
			'content_style',
			[
				'label'                => __( 'Content Style', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'default',
				'options'              => [
					'default'   => __( 'Default', 'my-elementor-widget' ),
					'bubble'    => __( 'Bubble', 'my-elementor-widget' ),
				],
				'prefix_class'          => 'pp-testimonials-content-',
			]
		);

		$this->add_control(
			'show_image',
			[
				'label'                => __( 'Show Image', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => '',
				'options'              => [
					''      => __( 'Yes', 'my-elementor-widget' ),
					'no'    => __( 'No', 'my-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'image_position',
			[
				'label'                => __( 'Image Position', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'inline',
				'options'              => [
					'inline'    => __( 'Inline', 'my-elementor-widget' ),
					'stacked'   => __( 'Stacked', 'my-elementor-widget' ),
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'                  => 'thumbnail',
				'default'               => 'full',
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->add_control(
			'show_quote',
			[
				'label'                => __( 'Show Quote', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'no',
				'options'              => [
					''      => __( 'Yes', 'my-elementor-widget' ),
					'no'    => __( 'No', 'my-elementor-widget' ),
				],
			]
		);

		$this->add_control(
			'quote_position',
			[
				'label'                => __( 'Quote Position', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'above',
				'options'              => [
					'above'         => __( 'Above Content', 'my-elementor-widget' ),
					'before'        => __( 'Before Content', 'my-elementor-widget' ),
					'before-after'  => __( 'Before/After Content', 'my-elementor-widget' ),
				],
				'prefix_class'          => 'pp-testimonials-quote-position-',
				'condition'             => [
					'show_quote'    => '',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style Tab: Order
	 */




	protected function register_style_order_controls() {
		$this->start_controls_section(
			'section_order_style',
			[
				'label'                 => __( 'Order', 'my-elementor-widget' ),
				'condition'             => [
					'image_position'    => 'stacked',
				],
			]
		);

		$this->add_control(
			'image_order',
			[
				'label'                 => __( 'Image', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => 1,
				'min'                   => 1,
				'max'                   => 4,
				'step'                  => 1,
				'condition'             => [
					'image_position'    => 'stacked',
				],
			]
		);

		$this->add_control(
			'name_order',
			[
				'label'                 => __( 'Name', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => 2,
				'min'                   => 1,
				'max'                   => 4,
				'step'                  => 1,
				'condition'             => [
					'image_position'    => 'stacked',
				],
			]
		);

		$this->add_control(
			'position_order',
			[
				'label'                 => __( 'Position', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => 3,
				'min'                   => 1,
				'max'                   => 4,
				'step'                  => 1,
				'condition'             => [
					'image_position'    => 'stacked',
				],
			]
		);

		$this->add_control(
			'rating_order',
			[
				'label'                 => __( 'Rating', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => 4,
				'min'                   => 1,
				'max'                   => 4,
				'step'                  => 1,
				'condition'             => [
					'image_position'    => 'stacked',
				],
			]
		);

        $this->end_controls_section();
		
    }
	protected function register_content_slider_options_controls() {
		$this->start_controls_section(
			'section_slider_options',
			[
				'label'                 => __( 'Slider Options', 'my-elementor-widget' ),
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->add_control(
			'effect',
			[
				'label'                => __( 'Effect', 'my-elementor-widget' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'slide',
				'options'              => [
					'slide'     => __( 'Slide', 'my-elementor-widget' ),
					'fade'      => __( 'Fade', 'my-elementor-widget' ),
				],
				'condition'             => [
					'layout'    => 'slideshow',
				],
			]
		);

		$slides_per_view = range( 1, 10 );
		$slides_per_view = array_combine( $slides_per_view, $slides_per_view );

		$this->add_responsive_control(
			'slides_per_view',
			[
				'type'                  => Controls_Manager::SELECT,
				'label'                 => __( 'Slides Per View', 'my-elementor-widget' ),
				'options'               => $slides_per_view,
				'default'               => '3',
				'tablet_default'        => '2',
				'mobile_default'        => '1',
				'condition'             => [
					'layout'    => 'carousel',
				],
				'frontend_available'    => true,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'type'                  => Controls_Manager::SELECT,
				'label'                 => __( 'Slides to Scroll', 'my-elementor-widget' ),
				'description'           => __( 'Set how many slides are scrolled per swipe.', 'my-elementor-widget' ),
				'options'               => $slides_per_view,
				'default'               => '1',
				'tablet_default'        => '1',
				'mobile_default'        => '1',
				'condition'             => [
					'layout'    => 'carousel',
				],
				'frontend_available'    => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'                 => __( 'Autoplay', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'my-elementor-widget' ),
				'label_off'             => __( 'No', 'my-elementor-widget' ),
				'return_value'          => 'yes',
				'separator'             => 'before',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'                 => __( 'Autoplay Speed', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => 3000,
				'frontend_available'    => true,
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'autoplay'  => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite_loop',
			[
				'label'                 => __( 'Infinite Loop', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'my-elementor-widget' ),
				'label_off'             => __( 'No', 'my-elementor-widget' ),
				'return_value'          => 'yes',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label'                 => __( 'Animation Speed', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::NUMBER,
				'default'               => 600,
				'frontend_available'    => true,
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->add_control(
			'center_mode',
			[
				'label'                 => __( 'Center Mode', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => '',
				'label_on'              => __( 'Yes', 'my-elementor-widget' ),
				'label_off'             => __( 'No', 'my-elementor-widget' ),
				'return_value'          => 'yes',
				'frontend_available'    => true,
				'separator'             => 'before',
			]
		);

		$this->add_responsive_control(
			'center_padding',
			[
				'label'                 => __( 'Center Padding', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 40,
					'unit' => 'px',
				],
				'size_units'            => [ 'px' ],
				'range'                 => [
					'px' => [
						'max' => 500,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'condition'             => [
					'center_mode'   => 'yes',
				],
			]
		);

		$this->add_control(
			'name_navigation_heading',
			[
				'label'                 => __( 'Navigation', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->add_control(
			'arrows',
			[
				'label'                 => __( 'Arrows', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'my-elementor-widget' ),
				'label_off'             => __( 'No', 'my-elementor-widget' ),
				'return_value'          => 'yes',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->add_control(
			'thumbnail_nav',
			[
				'label'                 => __( 'Thumbnail Navigation', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'my-elementor-widget' ),
				'label_off'             => __( 'No', 'my-elementor-widget' ),
				'return_value'          => 'yes',
				'frontend_available'    => true,
				'condition'             => [
					'layout'    => 'slideshow',
				],
			]
		);

		$this->add_control(
			'dots',
			[
				'label'                 => __( 'Dots', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __( 'Yes', 'my-elementor-widget' ),
				'label_off'             => __( 'No', 'my-elementor-widget' ),
				'return_value'          => 'yes',
				'frontend_available'    => true,
				'conditions'            => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'layout',
							'operator' => '==',
							'value' => 'carousel',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'layout',
									'operator' => '==',
									'value' => 'slideshow',
								],
								[
									'name' => 'thumbnail_nav',
									'operator' => '!==',
									'value' => 'yes',
								],
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'orientation',
			[
				'label'                 => __( 'Orientation', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'horizontal',
				'options'               => [
					'horizontal'    => __( 'Horizontal', 'my-elementor-widget' ),
					'vertical'      => __( 'Vertical', 'my-elementor-widget' ),
				],
				'separator'             => 'before',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
				],
			]
		);

		$this->end_controls_section();
	}





	protected function register_style_arrows_controls() {
		$this->start_controls_section(
			'section_arrows_style',
			[
				'label'                 => __( 'Navigation Arrows', 'my-elementor-widget' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'select_arrow',
			[
				'label'                  => __( 'Choose Arrow', 'my-elementor-widget' ),
				'type'                   => Controls_Manager::ICONS,
				'fa4compatibility'       => 'arrow',
				'label_block'            => false,
				'default'                => array(
					'value'   => 'fas fa-angle-right',
					'library' => 'fa-solid',
				),
				'skin'                   => 'inline',
				'exclude_inline_options' => 'svg',
				'recommended'            => array(
					'fa-regular' => array(
						'arrow-alt-circle-right',
						'caret-square-right',
						'hand-point-right',
					),
					'fa-solid'   => array(
						'angle-right',
						'angle-double-right',
						'chevron-right',
						'chevron-circle-right',
						'arrow-right',
						'long-arrow-alt-right',
						'caret-right',
						'caret-square-right',
						'arrow-circle-right',
						'arrow-alt-circle-right',
						'toggle-right',
						'hand-point-right',
					),
				),
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'                 => __( 'Arrows Size', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [ 'size' => '22' ],
				'range'                 => [
					'px' => [
						'min'   => 15,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_horitonal_position',
			[
				'label'                 => __( 'Horizontal Alignment', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => -100,
						'max'   => 450,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-arrow-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-arrow-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_vertical_position',
			[
				'label'                 => __( 'Vertical Alignment', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => -400,
						'max'   => 400,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-arrow-next, {{WRAPPER}} .pp-arrow-prev' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_arrows_style' );

		$this->start_controls_tab(
			'tab_arrows_normal',
			[
				'label'                 => __( 'Normal', 'my-elementor-widget' ),
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'arrows_bg_color_normal',
			[
				'label'                 => __( 'Background Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow' => 'background-color: {{VALUE}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'arrows_color_normal',
			[
				'label'                 => __( 'Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow' => 'color: {{VALUE}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'arrows_border_normal',
				'label'                 => __( 'Border', 'my-elementor-widget' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-slider-arrow',
				'separator'             => 'before',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'arrows_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_arrows_hover',
			[
				'label'                 => __( 'Hover', 'my-elementor-widget' ),
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'arrows_bg_color_hover',
			[
				'label'                 => __( 'Background Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow:hover' => 'background-color: {{VALUE}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'arrows_color_hover',
			[
				'label'                 => __( 'Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow:hover' => 'color: {{VALUE}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->add_control(
			'arrows_border_color_hover',
			[
				'label'                 => __( 'Border Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow:hover' => 'border-color: {{VALUE}};',
				],
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'                 => __( 'Padding', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-slider-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'             => 'before',
				'condition'             => [
					'layout'    => [ 'carousel', 'slideshow' ],
					'arrows'    => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}



	protected function register_style_content_controls() {

		/**
		 * Style Tab: Content
		 */
		$this->start_controls_section(
			'section_content_style',
			[
				'label'                 => __( 'Content', 'my-elementor-widget' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label'                 => __( 'Background Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .test-carousel, {{WRAPPER}} .test-carousel:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label'                 => __( 'Text Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .card-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'content_typography',
				'label'                 => __( 'Typography', 'my-elementor-widget' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_3,
				'selector'              => '{{WRAPPER}} .test-carousel',
			]
		);

		$this->add_control(
			'border',
			[
				'label'                 => __( 'Border', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SWITCHER,
				'selectors'             => [
					'{{WRAPPER}} .card-body, {{WRAPPER}} .card-body:after' => 'border-style: solid',
				],
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'                 => __( 'Border Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#000',
				'selectors'             => [
					'{{WRAPPER}} .card-body' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .card-body:after' => 'border-color: transparent {{VALUE}} {{VALUE}} transparent',
				],
				'condition'             => [
					'border'   => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'border_width',
			[
				'label'                 => __( 'Border Width', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .test-carousel, {{WRAPPER}} .test-carousel:after' => 'border-width: {{SIZE}}{{UNIT}}'
					
				],
				'condition'             => [
					'border'   => 'yes',
				],
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'                 => __( 'Border Radius', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%', 'em' ],
				'selectors'             => [
					'{{WRAPPER}} .test-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_gap',
			[
				'label'                 => __( 'Gap', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => '',
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonial-skin-1 .test-carousel, {{WRAPPER}} .pp-testimonial-skin-5 .test-carousel, {{WRAPPER}} .pp-testimonial-skin-6 .test-carousel, {{WRAPPER}} .pp-testimonial-skin-7 .test-carousel' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-testimonial-skin-2 .test-carousel' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-testimonial-skin-3 .test-carousel' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-testimonial-skin-4 .test-carousel' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_text_alignment',
			[
				'label'                 => __( 'Text Alignment', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'my-elementor-widget' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'my-elementor-widget' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'my-elementor-widget' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify'   => [
						'title' => __( 'Justified', 'my-elementor-widget' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'default'               => 'center',
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .test-carousel' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'details_h_alignment',
			[
				'label'                 => __( 'Name and Position Alignment', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::CHOOSE,
				'toggle'                => false,
				'options'               => [
					'left'          => [
						'title'     => __( 'Left', 'my-elementor-widget' ),
						'icon'      => 'eicon-h-align-left',
					],
					'center'        => [
						'title'     => __( 'Center', 'my-elementor-widget' ),
						'icon'      => 'eicon-h-align-center',
					],
					'right'         => [
						'title'     => __( 'Right', 'my-elementor-widget' ),
						'icon'      => 'eicon-h-align-right',
					],
				],
				'default'               => 'center',
				'prefix_class'          => 'pp-testimonials-h-align-',
				'condition'             => [
					'skin'    => [ 'skin-1', 'skin-2', 'skin-5', 'skin-6', 'skin-7' ],
				],
			]
		);

		$this->add_control(
			'details_v_alignment',
			[
				'label'                 => __( 'Name and Position Alignment', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::CHOOSE,
				'toggle'                => false,
				'default'               => 'middle',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'my-elementor-widget' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Center', 'my-elementor-widget' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'my-elementor-widget' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary'  => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
				'prefix_class'          => 'pp-testimonials-v-align-',
				'condition'             => [
					'skin'    => [ 'skin-3', 'skin-4' ],
				],
			]
		);

		$this->add_control(
			'image_v_alignment',
			[
				'label'                 => __( 'Image Alignment', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::CHOOSE,
				'toggle'                => false,
				'default'               => 'middle',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'my-elementor-widget' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Center', 'my-elementor-widget' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'my-elementor-widget' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary'  => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
				'prefix_class'          => 'pp-testimonials-v-align-',
				'condition'             => [
					'skin'    => [ 'skin-5', 'skin-6' ],
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'                 => __( 'Padding', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .test-carousel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'             => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'content_box_shadow',
				'selector'              => '{{WRAPPER}} .test-carousel',
			]
		);

		$this->add_control(
			'name_style_heading',
			[
				'label'                 => __( 'Name', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label'                 => __( 'Text Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .card-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'name_typography',
				'label'                 => __( 'Typography', 'my-elementor-widget' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
				'selector'              => '{{WRAPPER}} .card-name'
			]
		);

		$this->add_responsive_control(
			'name_gap',
			[
				'label'                 => __( 'Gap', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => '',
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .card-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'position_style_heading',
			[
				'label'                 => __( 'Position', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'position_text_color',
			[
				'label'                 => __( 'Text Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .card-position' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'position_typography',
				'label'                 => __( 'Typography', 'my-elementor-widget' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_2,
				'selector'              => '{{WRAPPER}} .card-position',
			]
		);

		$this->add_responsive_control(
			'position_gap',
			[
				'label'                 => __( 'Gap', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => '',
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .card-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quote_style_heading',
			[
				'label'                 => __( 'Quote', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
				'condition'             => [
					'show_quote'    => '',
				],
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label'                 => __( 'Color', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonial-text:before, {{WRAPPER}} .pp-testimonial-text:after' => 'color: {{VALUE}}',
				],
				'condition'             => [
					'show_quote'    => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'quote_typography',
				'label'                 => __( 'Typography', 'my-elementor-widget' ),
				'selector'              => '{{WRAPPER}} .pp-testimonial-text:before, {{WRAPPER}} .pp-testimonial-text:after',
				'condition'             => [
					'show_quote'    => '',
				],
			]
		);

		$this->add_responsive_control(
			'quote_margin',
			[
				'label'                 => __( 'Margin', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'allowed_dimensions'    => 'vertical',
				'placeholder'           => [
					'top'      => '',
					'right'    => 'auto',
					'bottom'   => '',
					'left'     => 'auto',
				],
				'selectors'             => [
					'{{WRAPPER}}.pp-testimonials-quote-position-above .pp-testimonial-text:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'show_quote'        => '',
					'quote_position'    => [ 'above', 'before' ],
				],
			]
		);

		$this->end_controls_section();
	}


	protected function register_style_image_controls() {
		$this->start_controls_section(
			'section_image_style',
			[
				'label'                 => __( 'Image', 'my-elementor-widget' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label'                 => __( 'Size', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => [ '%', 'px' ],
				'range'             => [
					'px' => [
						'max' => 200,
					],
				],
				'tablet_default'    => [
					'unit' => 'px',
				],
				'mobile_default'    => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					
				],
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->add_responsive_control(
			'image_gap',
			[
				'label'                 => __( 'Gap', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonials-image-stacked .pp-testimonial-image, {{WRAPPER}} .pp-testimonial-skin-7 .pp-testimonial-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-testimonials-image-inline .pp-testimonial-image, {{WRAPPER}} .pp-testimonial-skin-5 .pp-testimonial-image, {{WRAPPER}} .pp-testimonial-skin-8 .pp-testimonial-image' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.pp-testimonials-h-align-right .pp-testimonials-image-inline .pp-testimonial-image, {{WRAPPER}} .pp-testimonial-skin-6 .pp-testimonial-image' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				],
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'image_border',
				'label'                 => __( 'Border', 'my-elementor-widget' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-testimonial-image img',
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'                 => __( 'Border Radius', 'my-elementor-widget' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-testimonial-image, {{WRAPPER}} .pp-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'image_box_shadow',
				'selector'              => '{{WRAPPER}} .pp-testimonial-image img',
				'condition'             => [
					'show_image'    => '',
				],
			]
		);

		$this->end_controls_section();
	}


/**
	 * Slider Settings.
	 *
	 * @access public
	 */
	public function slider_settings() {
		$settings = $this->get_settings();

		if ( 'carousel' === $settings['layout'] ) {
			$slides_to_show = ( $settings['slides_per_view'] ) ? absint( $settings['
			'] ) : 3;
			$slides_to_show_tablet = ( $settings['slides_per_view_tablet'] ) ? absint( $settings['slides_per_view_tablet'] ) : 2;
			$slides_to_show_mobile = ( $settings['slides_per_view_mobile'] ) ? absint( $settings['slides_per_view_mobile'] ) : 1;

			$slides_to_scroll = ( $settings['slides_to_scroll'] ) ? absint( $settings['slides_to_scroll'] ) : 1;
			$slides_to_scroll_tablet = ( $settings['slides_to_scroll_tablet'] ) ? absint( $settings['slides_to_scroll_tablet'] ) : 1;
			$slides_to_scroll_mobile = ( $settings['slides_to_scroll_mobile'] ) ? absint( $settings['slides_to_scroll_mobile'] ) : 1;
		} else {
			$slides_to_show = 1;
			$slides_to_show_tablet = 1;
			$slides_to_show_mobile = 1;
			$slides_to_scroll = 1;
			$slides_to_scroll_tablet = 1;
			$slides_to_scroll_mobile = 1;
		}

		$slider_options = [
			'slidesToShow'           => $slides_to_show,
			'slidesToScroll'         => $slides_to_scroll,
			'autoplay'               => ( 'yes' === $settings['autoplay'] ),
			'autoplaySpeed'          => ( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : 3000,
			'speed'                  => ( $settings['animation_speed'] ) ? $settings['animation_speed'] : 600,
			'fade'                   => ( 'fade' === $settings['effect'] && 'slideshow' === $settings['layout'] ),
			'vertical'               => ( 'vertical' === $settings['orientation'] ),
			'adaptiveHeight'         => false,
			'loop'                   => ( 'yes' === $settings['infinite_loop'] ),
			'rtl'                    => is_rtl(),
		];

		if ( 'yes' === $settings['center_mode'] ) {
			$center_mode = true;
			$center_padding = ( $settings['center_padding']['size'] ) ? $settings['center_padding']['size'] . 'px' : '0px';
			$center_padding_tablet = ( $settings['center_padding_tablet']['size'] ) ? $settings['center_padding_tablet']['size'] . 'px' : '0px';
			$center_padding_mobile = ( $settings['center_padding_mobile']['size'] ) ? $settings['center_padding_mobile']['size'] . 'px' : '0px';

			$slider_options['centerMode'] = $center_mode;
			$slider_options['centerPadding'] = $center_padding;
		} else {
			$center_mode = false;
			$center_padding_tablet = '0px';
			$center_padding_mobile = '0px';
		}

		if ( 'yes' === $settings['arrows'] ) {
			$migration_allowed = Icons_Manager::is_migration_allowed();

			if ( ! isset( $settings['arrow'] ) && ! $migration_allowed ) {
				// add old default.
				$settings['arrow'] = 'fa fa-angle-right';
			}

			$has_icon = ! empty( $settings['arrow'] );

			if ( ! $has_icon && ! empty( $settings['select_arrow']['value'] ) ) {
				$has_icon = true;
			}

			$migrated = isset( $settings['__fa4_migrated']['select_arrow'] );
			$is_new = ! isset( $settings['arrow'] ) && $migration_allowed;

			if ( $is_new || $migrated ) {
				$arrow = $settings['select_arrow']['value'];
			}

			if ( $arrow ) {
				$next_arrow = $arrow;
				$prev_arrow = str_replace( 'right', 'left', $arrow );
			} else {
				$next_arrow = 'fa fa-angle-right';
				$prev_arrow = 'fa fa-angle-left';
			}

			$slider_options['arrows']    = true;
			$slider_options['prevArrow'] = '<div class="pp-slider-arrow pp-arrow pp-arrow-prev"><i class="' . $prev_arrow . '"></i></div>';
			$slider_options['nextArrow'] = '<div class="pp-slider-arrow pp-arrow pp-arrow-next"><i class="' . $next_arrow . '"></i></div>';
		} else {
			$slider_options['arrows']    = false;
		}

		if ( 'carousel' === $settings['layout'] && 'yes' === $settings['dots'] ) {
			$slider_options['dots']     = true;
		} elseif ( 'slideshow' === $settings['layout'] && 'yes' === $settings['dots'] && 'yes' !== $settings['thumbnail_nav'] ) {
			$slider_options['dots']     = true;
		} else {
			$slider_options['dots']     = false;
		}

		$elementor_bp_tablet    = get_option( 'elementor_viewport_lg' );
		$elementor_bp_mobile    = get_option( 'elementor_viewport_md' );
		$bp_tablet              = ! empty( $elementor_bp_tablet ) ? $elementor_bp_tablet : 1025;
		$bp_mobile              = ! empty( $elementor_bp_mobile ) ? $elementor_bp_mobile : 768;

		$slider_options['responsive'] = [
			[
				'breakpoint'    => $bp_tablet,
				'settings'      => [
					'slidesToShow'      => $slides_to_show_tablet,
					'slidesToScroll'    => $slides_to_scroll_tablet,
					'centerMode'        => $center_mode,
					'centerPadding'     => $center_padding_tablet,
				],
			],
			[
				'breakpoint'    => $bp_mobile,
				'settings'      => [
					'slidesToShow'      => $slides_to_show_mobile,
					'slidesToScroll'    => $slides_to_scroll_mobile,
					'centerMode'        => $center_mode,
					'centerPadding'     => $center_padding_mobile,
				],
			],
		];

		$this->add_render_attribute(
			'testimonials',
			[
				'data-slider-settings' => wp_json_encode( $slider_options ),
			]
		);
	}
protected function render(){
	
	require MYEW_PLUGIN_PATH .'widgets/render.php';
	
	
}
	

}
    


Plugin::instance()->widgets_manager->register_widget_type(new MYEW_Example_Widget() );
