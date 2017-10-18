<section class="row main-row">
	<section class="large-8 columns main-column">
		<div class="columns large-12 category-header no-padding-left">
			<div class="small-8 medium-6 large-6 columns left">
				<h3 class="category-title">
				<?php echo arlene_get_programmes_label();?>
				</h3>
			</div>
			<div class="small-4 medium-6 large-6 columns category-title-line right"></div>
		</div><!--header/-->
		<div class="category-row">
			<!-- post list-->
			<div class="post-list clearfix">
				<?php //starting programmes loop;

				$i = 1;	$args = array ('post_type'=>'programme','showposts'=>2); 
				$programmes = new WP_Query($args);                    
				if($programmes->have_posts() ) :
					while ( $programmes->have_posts())  : $programmes->the_post();
						get_template_part( 'template-parts/content', 'programme' );
					endwhile;
				endif; wp_reset_query();?>
			</div>
			<p class="call-to-action clearfix">
				<a href="<?php the_permalink(arlene_get_programmes_page());?>" class="small button post-item-buttom radius"><?php _e('All programmes','arlene')?></a>
			</p>
			
		</div>
	</section>
	<aside id="sidebar" class="large-4 columns">
		<div class="columns large-12 category-header no-padding-left no-padding-right">
			<div class="small-5 large-5 columns no-padding-left">
				<h3 class="category-title"><?php echo arlene_get_events_label();?></h3>
			</div>
			<div class="small-7 large-7 columns category-title-line right no-padding-right"></div>
		</div><!--header/-->
		
		<div class="event-widget">
			<?php //starting events loop;
			$args = array ('post_type'=>'event','showposts'=>5,'order'=>'ASC','post_status' => array('future')); 
			$events = new WP_Query($args);                    
			if($events->have_posts() ) :
				while ( $events->have_posts())  : $events->the_post();
					get_template_part( 'template-parts/content', 'event' );
				endwhile;
			endif; wp_reset_query();?>
			<p class="call-to-action">
				
				<a href="<?php the_permalink(arlene_get_events_page());?>" class="small button radius"><?php _e('All events','arlene')?></a>
			</p>
		</div>
	</aside>
</section>