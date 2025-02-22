<!-- Menu Section -->
<section id="menu" class="menu section pt-2">

  <!-- Section Title -->
  <div class="container section-title pb-3" data-aos="fade-up">
    <p><span>Thực đơn</span> <span class="description-title">Hôm nay</span></p>
  </div><!-- End Section Title -->
  
  
  <div class="container">

    <!-- List Category -->
    <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

      <?php foreach ($array_menu as $index => $menu) { ?>
        <li class="nav-item">
          <a class="nav-link <?= $index == 0 ? 'active show' : '' ?>" data-bs-toggle="tab"
            data-bs-target="#<?= $menu['slug_category'] ?>">
            <h4><?= $menu['name_category'] ?></h4>
          </a>
        </li><!-- End tab nav item -->

      <?php } ?>

    </ul>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

      <!-- List Product -->
      <?php foreach ($array_menu as $index => $menu) { ?>
        <div class="tab-pane fade <?= $index == 0 ? 'active show' : '' ?>" id="<?= $menu['slug_category'] ?>">

          <div class="tab-header text-center">
            <h3><?= $menu['name_category'] ?></h3>
          </div>

          <div class="row gy-5">
            <!-- Product -->
            <?php foreach ($menu['list_product'] as $product) { ?>
              <div class="col-lg-4 menu-item">
                <a href="<?= URL_STORAGE . $product['image_product'] ?>" class="glightbox object-fit-scale"><img
                    src="<?= URL_STORAGE . $product['image_product'] ?>" class="menu-img img-fluid" alt=""></a>
                <h4><?= $product['name_product'] ?></h4>
                <p class="ingredients">
                  <?= $product['description_product'] ?>
                </p>
                <p class="price">
                  <?= number_format($product['price_product'], 0, ',', '.') ?> <sup>vnđ</sup>
                </p>

                <form method="post" action="gio-hang" class="form-submit text-center">
                  <input type="hidden" class="id_product" value="<?= $product['id_product'] ?>">
                  <button type="button" class="addItemBtn border mx-1 px-2 py-1 rounded-1 btn text-primary">
                    <i class="bi bi-bag-plus me-1"></i> Giỏ hàng
                  </button>
                  <button name="buy_now" value="<?= $product['id_product'] ?>" type="submit" class="border mx-1 px-2 py-1 rounded-1 btn text-primary">
                    <i class="bi bi-bag-check me-1"></i> Mua ngay
                  </button>
                </form>
              </div>
            <?php } ?>
          </div>
        </div><!-- End Starter Menu Content -->
      <?php } ?>
    </div>

  </div>

</section><!-- /Menu Section -->