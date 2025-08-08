 <article class="portfolio" data-page="portfolio">

        <header>
          <h2 class="h2 article-title">Portfolio</h2>
        </header>

        <section class="projects">

          <ul class="filter-list">

            <li class="filter-item">
              <button class="active" data-filter-btn>All</button>
            </li>

            <li class="filter-item">
              <button data-filter-btn>Web design</button>
            </li>

            <li class="filter-item">
              <button data-filter-btn>Applications</button>
            </li>

            <li class="filter-item">
              <button data-filter-btn>Web development</button>
            </li>

          </ul>

          <div class="filter-select-box">

            <button class="filter-select" data-select>

              <div class="select-value" data-selecct-value>Select category</div>

              <div class="select-icon">
                <ion-icon name="chevron-down"></ion-icon>
              </div>

            </button>

            <ul class="select-list">

              <li class="select-item">
                <button data-select-item>All</button>
              </li>

              <li class="select-item">
                <button data-select-item>Web design</button>
              </li>

              <li class="select-item">
                <button data-select-item>Applications</button>
              </li>

              <li class="select-item">
                <button data-select-item>Web development</button>
              </li>

            </ul>

          </div>

          <ul class="project-list">
            <?php
              include 'admin/config.php';
              $result = $conn->query("SELECT * FROM portfolio ORDER BY created_at DESC");
              while($row = $result->fetch_assoc()):
            ?>

            <li class="project-item  active" data-filter-item data-category="<?= htmlspecialchars($row['category']) ?>" >
              <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank">

                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

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

                <h3 class="project-title"><?= htmlspecialchars($row['title']) ?></h3>

                <p class="project-category"><?= htmlspecialchars($row['category']) ?></p>

              </a>
            </li>

           

            <?php endwhile; ?>

          </ul>

        </section>

      </article>