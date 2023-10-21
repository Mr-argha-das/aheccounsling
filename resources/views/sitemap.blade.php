<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->

 <url>
  <loc>https://www.ahecounselling.com/</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/blogs</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/ijp</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/story-teller</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/services</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/video-gallery</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/sign-in</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/about-us</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/affiliates-terms</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/FL-Registration</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/contact-us</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>https://www.ahecounselling.com/sign-up</loc>
  <lastmod>2021-10-29T09:40:43+00:00</lastmod>
  <priority>0.64</priority>
</url>


 @foreach($blog as $slug)
<url>
  <loc><?=route('blogpage', str_slug($slug->blog_name, "-"))?></loc>
  <lastmod><?php echo date('Y-m-d', strtotime(' -2 day')) ?>T10:42:43+00:00</lastmod>
  <priority>0.64</priority>
</url>

@endforeach

@foreach($categrorydropdown as $category)
<url>
  <loc>https://www.ahecounselling.com/sample-project/{{ $category->cat_slug }}</loc>
  <lastmod><?php echo date('Y-m-d', strtotime(' -2 day')) ?>T10:42:43+00:00</lastmod>
  <priority>0.64</priority>
</url>

@endforeach

  @foreach($sampleproject as $project)
<url>
  <loc>https://www.ahecounselling.com/document/{{ $project->slug }}</loc>
  <lastmod><?php echo date('Y-m-d', strtotime(' -2 day')) ?>T10:42:43+00:00</lastmod>
  <priority>0.64</priority>
</url>

@endforeach

@foreach ($services as $service)
<url>
  <loc><?=route('servicespage', str_slug($service->services_name, "-"))?></loc>
  <lastmod><?php echo date('Y-m-d', strtotime(' -2 day')) ?>T10:42:43+00:00</lastmod>
  <priority>0.64</priority>
</url>
@endforeach

</urlset> 