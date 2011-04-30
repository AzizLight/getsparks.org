<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>GetSparks.org: Latest Registered Sparks</title>
    <description>A feed of all of the repository's latest submissions</description>
    <link>http://getsparks.org</link>
    <language>en</language>
    <copyright>GetSparks.org</copyright>
    <pubDate><?php echo date(DATE_RSS); ?></pubDate>
    <lastBuildDate><?php echo date(DATE_RSS); ?></lastBuildDate>
    <generator>getsparks.org</generator>
    <ttl>30</ttl>
    <atom:link href="http://getsparks.org/rss/sparks" rel="self" type="application/rss+xml" />
    <?php foreach($versions as $version): ?>
    <item>
      <title><?php echo $spark->name; ?> v<?php echo $version->version; ?></title>
      <description><?php echo $spark->summary; ?></description>
      <link><?php echo base_url(); ?>packages/<?php echo $spark->name; ?>/versions/<?php echo $version->version; ?>/show</link>
      <guid isPermaLink="true"></guid>
      <pubDate><?php echo (date(DATE_RSS, strtotime($spark->created))); ?></pubDate>
      <source url="http://getsparks.org/">GetSparks.org</source>
    </item>
    <?php endforeach; ?>
  </channel>
</rss>