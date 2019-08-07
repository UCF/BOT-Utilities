<?php

if ( ! class_exists( 'BOTUtilities' ) ) {

    class BOTUtilities {

        public static function get_person_markup( $person, $title=null ) {
            $image = get_the_post_thumbnail_url( $person );
            if( ! $image ) {
                $image = BOT_UTILITIES_IMG_URL . '/no-photo.png';
            }
            ob_start();
        ?>
            <figure class="figure person-figure">
                <a href="<?php echo get_permalink( $person->ID ); ?>">
                    <img class="img-fluid" src="<?php echo $image; ?>" alt="<?php echo $person->post_title; ?>">
                    <figcaption class="figure-caption text-secondary text-center mt-2 mb-4">
                        <strong><?php echo $person->post_title; ?></strong>
                        <?php if ( $title ) : ?>
                        <p class="text-muted"><?php echo $title; ?></p>
                        <?php endif; ?>
                    </figcaption>
                </a>
            </figure>
        <?php
            return ob_get_clean();
        }

        /**
         * Returns a person list
         **/

        public static function people_list_shortcode( $atts, $content='' ) {
            $atts = shortcode_atts(
                array(
                    'people_group' => null,
                    'category'     => null,
                    'positions'    => false,
                    'limit'        => -1
                ),
                $atts
            );
            $args = array(
                'post_type'      => 'person',
                'posts_per_page' => ( int ) $atts['limit'],
                'meta_key'       => 'person_last_name',
                'order'          => 'ASC',
                'orderby'        => 'meta_value'
            );
            if ( $atts['category'] ) {
                $args['category_name'] = $atts['category'];
            }
            if ( $atts['people_group'] ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'people_group',
                        'field'    => 'slug',
                        'terms'    => $atts['people_group']
                    )
                );
            }
                // Create iterator for layout here.
            $i = 0;
            ob_start();
            if ( $atts['positions'] ) {
                $chair_id = ucfbot_get_theme_mod_or_default( 'board_chair' );
                $vice_chair_id = ucfbot_get_theme_mod_or_default( 'board_vice_chair' );
                $exclude = array();
                if ( !empty( $chair_id ) ) {
                    $chair = get_post( $chair_id );
                    $chair = UCF_People_PostType::append_metadata( $chair );
                    $exclude[] = $chair->ID;
                }
                if ( !empty( $vice_chair_id ) ) {
                    $vice_chair = get_post( $vice_chair_id );
                    $vice_chair = UCF_People_PostType::append_metadata( $vice_chair );
                    $exclude[] = $vice_chair->ID;
                }
                if ( count( $exclude ) > 0 ) {
                    $args['post__not_in'] = $exclude;
                }
            }
            $people = get_posts( $args );
            $count = count( $people ) - 1;
            if ( isset( $chair ) ) :
        ?>
                <?php if ( $i % 3 === 0 ) : ?><div class="row"><?php endif; ?>
                <div class="col-md-4 col-sm-6">
                    <?php echo BOTUtilities::get_person_markup( $chair, 'Board Chair' ); ?>
                </div>
                <?php if ( $i % 3 === 2 ) : ?></div><?php endif; $i++; $count++; ?>
        <?php
            endif;
            if ( isset( $vice_chair ) ) :
        ?>
                <?php if ( $i % 3 === 0 ) : ?><div class="row"><?php endif; ?>
                <div class="col-md-4 col-sm-6">
                    <?php echo BOTUtilities::get_person_markup( $vice_chair, 'Board Vice Chair' ); ?>
                </div>
                <?php if ( $i % 3 === 2 ) : ?></div><?php endif; $i++; $count++; ?>
        <?php
            endif;
            foreach( $people as $person ) :
                $person = UCF_People_PostType::append_metadata( $person );
        ?>
            <?php if ( $i % 3 === 0 ) : ?><div class="row"><?php endif; ?>
            <div class="col-md-4 col-sm-6">
                <?php echo BOTUtilities::get_person_markup( $person ); ?>
            </div>
            <?php if ( $i % 3 === 2  || $i === $count ) : ?></div><?php endif; $i++; ?>
        <?php
            endforeach;
            return ob_get_clean();
        }

        public static function people_group_charter_list_shortcode( $atts, $content="" ) {
            $none_term = term_exists( 'None', 'people_group' );
            $terms = get_terms( array(
                'taxonomy' => 'people_group',
                'exclude'  => array( $none_term )
            ) );
            ob_start();
        ?>
            <ul class="list-unstyled document-list">
            <?php foreach( $terms as $term ) : $charter = get_field( 'people_group_charter', 'people_group_' . $term->term_id ); ?>
                <?php if( $charter ) : ?>
                    <li><a class="document" href="<?php echo $charter; ?>"><?php echo $term->name; ?> Committee Charter</a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        <?php
            return ob_get_clean();
        }
    }

    add_shortcode( 'people-list', 'BOTUtilities::people_list_shortcode' );
    add_shortcode( 'charter-list', 'BOTUtilities::people_group_charter_list_shortcode' );

}
?>