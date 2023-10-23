<?php 

class GTPartnersWidget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'gotalent-partners-carousel';
    }

    public function get_title() {
        return 'GoTalent Partners';
    }

    public function get_icon() {
        return 'fa fa-images';
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
            'partner_logos',
            [
                'label' => 'Partner Logos',
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'main_heading',
            [
                'label' => 'Main Heading',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Over 100,000 recruiters use Jobtex to modernize their hiring',
                'placeholder' => 'Enter your main heading',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $partner_logos = $settings['partner_logos'];

        if (empty($partner_logos)) {
            return;
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function(){
                const swiper = new Swiper(".partner-type-6", {
                direction: "horizontal",
                effect: "slide",
                slidesPerView: 2,
                loop: true,
                spaceBetween: 68.95,
                breakpoints: {
                500: {
                    slidesPerView: 3,
                },
                800: {
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 5,
                },
                1600: {
                    slidesPerView: 6,
                },
                },
                autoplay: {
                delay: 3000,
                },
            });
            })
        </script>

        <section>
            <div class="wd-partner">
                <div class="tf-container">
                    <h1 class="title-partner">
                        <?php echo esc_html($settings['main_heading']); ?>
                    </h1>
                    <div class="swiper partner-type-6">
                        <div class="swiper-wrapper">
                            <?php foreach ($partner_logos as $logo): ?>
                                <div class="swiper-slide">
                                    <a class="logo-partner" href="javascript:void(0)">
                                        <img src="<?php echo esc_url($logo['url']); ?>" />
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new GTPartnersWidget());
