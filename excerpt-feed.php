<?php
/**
 * RSS feed showing excerpts only
 *
 * @package   feed-excerpts-for-bloglovin
 * @copyright Copyright (c) 2017, Ashley Gibson
 * @license   GPL2+
 */

$posts = new WP_Query( array( 'posts_per_page' => 5 ) );
header( 'Content-Type: ' . feed_content_type( 'rss2' ) . '; charset=' . get_option( 'blog_charset' ), true );
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>';

/**
 * Fires between the xml and rss tags in a feed.
 *
 * @since 4.0.0
 *
 * @param string $context Type of feed. Possible values include 'rss2', 'rss2-comments',
 *                        'rdf', 'atom', and 'atom-comments'.
 */
do_action( 'rss_tag_pre', 'excerpts' );
?>
<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
>
	<channel>
		<title><?php bloginfo_rss( 'name' ); ?></title>
		<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml"/>
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description><?php bloginfo_rss( 'description' ) ?></description>
		<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ); ?></lastBuildDate>
		<language><?php echo get_option( 'rss_language' ); ?></language>
		<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
		<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
		<?php do_action( 'rss2_head' ); ?>
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<item>
				<title><?php the_title_rss(); ?></title>
				<link><?php the_permalink_rss(); ?></link>
				<pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ); ?></pubDate>
				<dc:creator><?php the_author(); ?></dc:creator>
				<?php the_category_rss( 'rss2' ) ?>
				<guid isPermaLink="false"><?php the_guid(); ?></guid>
				<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
				<content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
				<?php rss_enclosure(); ?>
				<?php do_action( 'rss2_item' ); ?>
			</item>
		<?php endwhile; ?>
	</channel>
</rss>