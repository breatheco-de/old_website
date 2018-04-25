<?php

namespace BreatheCode\WPTypes\PostType;

use \WP_Query;

class WPLesson{
    const TAX_SLUG = 'lesson';
    private $user;

    function __construct()
    {
        add_action( 'restrict_manage_posts', [$this,'lesson_taxonomy_filters'] );
        add_action( 'load-post.php', [$this,'render_edit_add_view'] , 10, 2);
        add_action( 'load-post-new.php', [$this,'render_edit_add_view'] , 10, 2 );
        add_action( 'save_post_'.self::TAX_SLUG, [$this,'save_post'] , 10, 2 );
    }
    
    /*
    *   FILTER POSTS BY TAXONOMY IN THE ADMIN
    *
    */
    
    function lesson_taxonomy_filters() {
        global $typenow;
     
        // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
        $taxonomies = array('course');
     
        // must set this to the post type you want the filter(s) displayed on
        if( $typenow == 'lesson' ){
     
            foreach ($taxonomies as $tax_slug) {
                $tax_obj = get_taxonomy($tax_slug);
                $tax_name = $tax_obj->labels->name;
                $terms = get_terms($tax_slug);
                if(count($terms) > 0) {
                    echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                    echo "<option value=''>Show All $tax_name</option>";
                    foreach ($terms as $term) { 
                        echo '<option value='. $term->slug, (isset($_GET[$tax_slug]) and $_GET[$tax_slug] == $term->slug) ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
                    }
                    echo "</select>";
                }
            }
        }
    }
    
    function render_edit_add_view($postType ){
        
        //print_r($postType); die();
        add_action( 'add_meta_boxes', [$this,'render_meta_boxes'] );
    }
    
    /* Create one or more meta boxes to be displayed on the post editor screen. */
    function render_meta_boxes() {
    
          add_meta_box(
            'previous-next-lesson',      // Unique ID
            esc_html__( 'Lesson Order', 'breathecode' ),    // Title
            [$this,'render_previous_next_lesson_metabox'],   // Callback function
            self::TAX_SLUG,         // Admin page (or post type)
            'side',         // Context
            'default'         // Priority
          );
    
          add_meta_box(
            'quiz-metabox',      // Unique ID
            esc_html__( 'Lesson Quiz', 'breathecode' ),    // Title
            [$this,'render_quiz_metabox'],   // Callback function
            self::TAX_SLUG,         // Admin page (or post type)
            'side',         // Context
            'default'         // Priority
          );
    
          add_meta_box(
            'replit-metabox',      // Unique ID
            esc_html__( 'Replit Class', 'breathecode' ),    // Title
            [$this,'render_replit_metabox'],   // Callback function
            self::TAX_SLUG,         // Admin page (or post type)
            'side',         // Context
            'default'         // Priority
          );
    }
        
    /* Display the post meta box. */
    function render_replit_metabox( $post ) { 
		$replitTemplateKeys = get_option( \BreatheCode\BCThemeOptions::THEME_OPTIONS_KEY.'replit-courses' );
        if(!$replitTemplateKeys) echo "<p>Unable to get the Replit classes ID's</p>";
        else
        {
            
            $lessonMetas = get_post_meta($post->ID, 'meta_'.self::TAX_SLUG, true); 
            if(!$lessonMetas) $lessonMetas = [];
            if(!isset($lessonMetas['replit'])) $lessonMetas['replit'] = null;
            ?>
              <p>
                    <label for="lesson-replit">Replit:</label>
                    <select name="lesson-replit">
                        <option value="0">No replit</option>
                        <?php foreach($replitTemplateKeys as $key => $val){ ?>
                        <option value="<?php echo $key; ?>" <?php if($lessonMetas['replit']==$key) echo "selected"; ?>><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
              </p>
    <?php }
    }
    
    function render_quiz_metabox( $post ) { 
        
        $quizesContent = file_get_contents(ASSETS_URL.'apis/quiz/all');
        $quizes = json_decode($quizesContent);
        if(!$quizes) echo "<p>Unable to get the quizzes from Assets API.</p>";
        else
        {
            
            $lessonMetas = get_post_meta($post->ID, 'meta_'.self::TAX_SLUG, true); 
            if(!$lessonMetas) $lessonMetas = [];
            if(!isset($lessonMetas['quiz'])) $lessonMetas['quiz'] = null;
            ?>
              <p>
                    <label for="lesson-quiz">Quiz:</label>
                    <select name="lesson-quiz">
                        <option value="0">No quiz</option>
                        <?php foreach($quizes as $q){ ?>
                        <option value="<?php echo $q->info->slug; ?>" <?php if($lessonMetas['quiz']==$q->info->slug) echo "selected"; ?>><?php echo $q->info->name; ?></option>
                        <?php } ?>
                    </select>
              </p>
    <?php }
    }
    
    function render_previous_next_lesson_metabox( $post ) { 
    
        $terms = wp_get_post_terms($post->ID, 'course');
        //print_r($terms); die();
        
        if(count($terms)==0) echo "<p>The lesson needs to belong to one course</p>";
        else if(count($terms)>1) echo "<p>This lesson can only belong to one course (no more)</p>";
        else{
            
            //print_r($terms[0]->term_id); die();

            $auxLessons = new WP_Query([ 
                'post_type'=>'lesson', 
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'course',
                        'field' => 'term_id',
                        'terms' => $terms[0]->term_id
                    )
                )
            ]);
            $lessons = $auxLessons->posts;

            $lessonMetas = get_post_meta($post->ID, 'meta_'.self::TAX_SLUG, true); 
            if(!$lessonMetas) $lessonMetas = [];
            if(!isset($lessonMetas['previous-lesson'])) $lessonMetas['previous-lesson'] = 0;
            if(!isset($lessonMetas['next-lesson'])) $lessonMetas['next-lesson'] = 0;
            ?>
              <h5>Course: <?php echo $terms[0]->name; ?></h5>
              <p>
                    <label for="previous-lesson">Prev Lesson:</label>
                    <select name="previous-lesson">
                        <option value="0">No lesson</option>
                        <?php foreach($lessons as $l){ ?>
                        <option value="<?php echo $l->ID; ?>" <?php if($lessonMetas['previous-lesson']==$l->ID) echo "selected"; ?>><?php echo $l->post_title; ?></option>
                        <?php } ?>
                    </select> <a style="text-decoration: none; font-size: 14px;" href="/wp-admin/post.php?post=<?php echo $lessonMetas['previous-lesson']; ?>&action=edit"><span class="dashicons dashicons-edit"></span></a>
                    </br>
                    <label for="next-lesson">Next Lesson:</label>
                    <select name="next-lesson">
                        <option value="0">No lesson</option>
                        <?php foreach($lessons as $l){ 
                                if($post->ID==$l->ID) continue; 
                        ?>
                                <option value="<?php echo $l->ID; ?>" <?php if($lessonMetas['next-lesson']==$l->ID) echo "selected"; ?>><?php echo $l->post_title; ?></option>
                        <?php } ?>
                    </select> <a style="text-decoration: none; font-size: 14px;" href="/wp-admin/post.php?post=<?php echo $lessonMetas['next-lesson']; ?>&action=edit"><span class="dashicons dashicons-edit"></span></a>
              </p>
    <?php }
        
    }
    
    public function save_post($post_id, $post){
        
        $lessonMetas = get_post_meta($post_id, 'meta_'.self::TAX_SLUG, true);
        if(!$lessonMetas) $lessonMetas = [];

        if(isset($_POST['lesson-quiz'])) $lessonMetas['quiz'] = $_POST['lesson-quiz'];
        
        if(isset($_POST['lesson-replit'])) $lessonMetas['replit'] = $_POST['lesson-replit'];

        update_post_meta($post_id,'meta_'.self::TAX_SLUG, $lessonMetas);
        
        $prev = null; $next = null;
        if(isset($_POST['previous-lesson'])) $prev = $_POST['previous-lesson'];
        if(isset($_POST['next-lesson'])) $next = $_POST['next-lesson'];
        if($prev && $next && $prev==$next) throw new Exception('Next and previous lessons cannot be the same.');
        $this->setPreviousLessonTo($post_id, $_POST['previous-lesson']);
        $this->setNextLessonTo($post_id, $_POST['next-lesson']);
    }
    
    private function setPreviousLessonTo($currentLessonId, $previousLessonId){
        
        if($previousLessonId==null) return;
        
        $currentLessonMetas = get_post_meta($currentLessonId, 'meta_'.self::TAX_SLUG, true);
        
        //if there are not changes, skip the changes
        if($currentLessonMetas['previous-lesson'] == $previousLessonId) return;
        
        $currentLessonMetas['previous-lesson'] = $previousLessonId;
        update_post_meta($currentLessonId,'meta_'.self::TAX_SLUG, $currentLessonMetas);
        
        $previousLessonMetas = get_post_meta($previousLessonId, 'meta_'.self::TAX_SLUG, true);
        $previousLessonMetas['next-lesson'] = $currentLessonId;
        update_post_meta($previousLessonId,'meta_'.self::TAX_SLUG, $previousLessonMetas);
    }
    
    private function setNextLessonTo($currentLessonId, $nextLessonId){
        
        if($nextLessonId == null) return;
        
        $currentLessonMetas = get_post_meta($currentLessonId, 'meta_'.self::TAX_SLUG, true);
        
        //if there are not changes, skip the changes
        if($currentLessonMetas['next-lesson'] == $nextLessonId) return;
        
        $currentLessonMetas['next-lesson'] = $nextLessonId;
        update_post_meta($currentLessonId,'meta_'.self::TAX_SLUG, $currentLessonMetas);
        
        $nextLessonMetas = get_post_meta($nextLessonId, 'meta_'.self::TAX_SLUG, true);
        $nextLessonMetas['previous-lesson'] = $currentLessonId;
        update_post_meta($nextLessonId,'meta_'.self::TAX_SLUG, $nextLessonMetas);
    }
	
}