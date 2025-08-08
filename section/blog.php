  <article class="blog" data-page="blog">

        <header>
          <h2 class="h2 article-title">Blog</h2>
        </header>

       <section class="blog-posts">
 
  <ul class="blog-posts-list">
    <?php
      
      $result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
      while($row = $result->fetch_assoc()):
    ?>
    <li class="blog-post-item">
      <a href="#">
       
<figure class="blog-banner-box">
  <?php
    // Correct paths based on your server structure
    $imageWebPath = BASE_URL . '/Admin/uploads/' . htmlspecialchars($row['image']);
    $imageServerPath = BASE_PATH . '/Admin/uploads/' . $row['image'];
    
    if (!empty($row['image']) && file_exists($imageServerPath)):
  ?>
    <img src="<?= $imageWebPath ?>" alt="Blog image" loading="lazy">
  <?php else: ?>
    <img src="assets/images/default-blog.png" alt="No image available" loading="lazy">
  <?php endif; ?>
</figure>
        <div class="blog-content">
          <div class="blog-meta">
            <p class="blog-category">Blog</p>
            <span class="dot"></span>
            <time datetime="<?= $row['created_at'] ?>"><?= date('M d, Y', strtotime($row['created_at'])) ?></time>
          </div>
          <h3 class="h3 blog-item-title"><?= htmlspecialchars($row['title']) ?></h3>
          <p class="blog-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
        </div>
      </a>
    </li>
    <?php endwhile; ?>
  </ul>
</section>


      </article>