<?php

//Including Database configuration file.
include("wp-config.php");
global $wpdb;

$p = isset($_GET['p']) ? trim($_GET['p']) : '';
?>
<div class="w-100 loaded_post_<?php echo $p; ?>">
    <div class="row">
<?php
$args = array('post_type' => 'post','posts_per_page' => 6,'order' => 'ASC', 'offset' => $p);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) { $loop->the_post();
    
    $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail-no' );
    $thumb_id = get_post_thumbnail_id(get_the_ID());
    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    $headerimage = $featuredImage[0];
?>

<div class="col-sm-6">
	<div class="blog-items blog-page-item">
		<figure>
			<a href="<?php the_permalink(); ?>">
				<?php if($headerimage)	{	?>
				<img src="<?php echo $headerimage;?>"  alt="<?php  echo $alt; ?>" />
				<?php if(get_field('watermark_text')) { ?>
				<div class="watermark"><?php the_field('watermark_text'); ?></div>
				<?php  } ?>
				<?php	}	?>
			</a>
		</figure>
		<div class="blog-detail">
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php
			$limit = 15;
			$content = get_the_excerpt();
			$trimmed_content = wp_trim_words( $content, $limit, '' );
			echo '<p>' .$trimmed_content.'</p>';
			?>
			<a href="<?php the_permalink(); ?>" class="read-btn">Read More</a>
		</div>
	</div>
</div>

<?php }}else{ ?> 
    <div class="col-sm-12" id="no-post">
    	<div class="blog-items text-center">
    		<div class="blog-detail">
    			<p>No more blog post available</p>
    		</div>
    	</div>
    </div>
<?php } ?>
    </div>
</div>
