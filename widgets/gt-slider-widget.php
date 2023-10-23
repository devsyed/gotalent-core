<?php


class GTSliderWidget extends \Elementor\Widget_Base  {
    public function get_name() {
        return 'gotalent-slider-widget';
    }

    public function get_title() {
        return 'Gotalent Slider';
    }

    public function get_icon() {
        return 'fa fa-image'; 
    }

    public function get_categories() {
        return ['gotalent'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Content',
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => 'Background Image',
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'main_heading',
            [
                'label' => 'Main Heading',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Find the Talents for any job.',
            ]
        );

        $this->add_control(
            'auto_type_words',
            [
                'label' => 'Auto-Type Words (Comma-separated)',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Musicians, Dancers, Artists, Emcees, DJ, Roaming Act, Circus Act',
            ]
        );


        $this->add_control(
            'content_text',
            [
                'label' => 'Content Text',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Discover, book, and elevate your events with exceptional talents, all at your fingertips. With GoTalent, your vision becomes reality, and every moment turns into a masterpiece. Your stage, your story, your talent.',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $background_image = $settings['background_image']['url'];
        $main_heading = $settings['main_heading'];
        $auto_type_words = explode(',', $settings['auto_type_words']);
        $content_text = $settings['content_text'];
        ?>

        <script>
            var autoTypeElements = document.querySelectorAll(".auto-type");
            if(autoTypeElements.length > 0){
                var typed = new Typed(".auto-type", {
                        strings: <?php echo json_encode(array_map('trim', $auto_type_words)); ?>,
                        typeSpeed: 100,
                        backSpeed: 30,
                        loop: true,
                        showCursor: false
                    });
            }

        </script>

        <section class="tf-slider sl2 over-flow-hidden d-flex flex-column justify-content-center align-items-center"
            style="background-image: url(<?php echo esc_url($background_image); ?>);">
            <div class="tf-container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="content wow fadeInUp">
                            <div class="heading">
                                <h2>Find the <strong class="auto-type">Dancers</strong> <br><?php echo esc_html($main_heading); ?></h2>
                            </div>
                            <div class="form-sl">
                                
                                <p class="my-3">
                                    <?php echo esc_html($content_text); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new GTSliderWidget());
