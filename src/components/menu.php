<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <h2>Menu</h2>
      <p>Our <span>Menu</span></p>
    </div>

    <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
      <li class="nav-item">
        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
          <h4>Starters</h4>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
          <h4>Breakfast</h4>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
          <h4>Lunch</h4>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
          <h4>Dinner</h4>
        </a>
      </li>
    </ul>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
      <?php
      require_once __DIR__ . '/../assets/clase/Mancare.php';
      $categorii_meniu = [
        'starters' => ['id' => 'menu-starters', 'label' => 'Starters', 'active' => true],
        'breakfast' => ['id' => 'menu-breakfast', 'label' => 'Breakfast', 'active' => false],
        'lunch' => ['id' => 'menu-lunch', 'label' => 'Lunch', 'active' => false],
        'dinner' => ['id' => 'menu-dinner', 'label' => 'Dinner', 'active' => false],
      ];
      foreach ($categorii_meniu as $slug => $meta):
        $produse = Mancare::get_by_categorie($conn, $slug);
        $pane_class = $meta['active'] ? 'tab-pane fade active show' : 'tab-pane fade';
      ?>
      <div class="<?= $pane_class ?>" id="<?= htmlspecialchars($meta['id']) ?>">
        <div class="tab-header text-center">
          <p>Menu</p>
          <h3><?= htmlspecialchars($meta['label']) ?></h3>
        </div>
        <div class="row gy-5">
          <?php if (empty($produse)): ?>
            <div class="col-12">
              <p class="text-center text-muted">Niciun produs in aceasta categorie deocamdata.</p>
            </div>
          <?php else: ?>
            <?php foreach ($produse as $row): ?>
              <div class="col-lg-4 menu-item">
                <a href="<?= htmlspecialchars($row['imagine']) ?>" class="glightbox">
                  <img src="<?= htmlspecialchars($row['imagine']) ?>" class="menu-img img-fluid" alt="<?= htmlspecialchars($row['nume']) ?>">
                </a>
                <h4><?= htmlspecialchars($row['nume']) ?></h4>
                <p class="ingredients"><?= htmlspecialchars($row['descriere']) ?></p>
                <p class="price">$<?= htmlspecialchars($row['pret']) ?></p>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section><!-- End Menu Section -->
