<?php include ROOT . '/views/lego/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <?php include ROOT . '/views/lego/category.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>

                    <?php foreach ($product_list as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo $product['image']; ?>" alt="" />
                                        <h2> 
                                            <?php echo $product['price']; ?>$ 
                                        </h2>
                                        <p>
                                            <a href="/product/<?php echo $product['id']; ?>">
                                                <?php echo $product['name']; ?>
                                            </a>
                                        </p>
                                        <a href="/basket/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div><!--features_items-->


                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php for ($i = 0; $i < 3; $i++): ?> 
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?php echo $slider[$i]['image']; ?>" alt="" />
                                                    <h2><?php echo $slider[$i]['price']; ?>$</h2>
                                                    <p>
                                                        <a href="/product/<?php echo $slider[$i]['id']; ?>">
                                                            <?php echo $slider[$i]['name']; ?>
                                                        </a>
                                                    </p>
                                                    <a href="/basket/add/<?php echo $slider[$i]['id']; ?>" class="btn btn-default add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i>В корзину
                                                    </a>
                                                </div>
                                                <?php if ($slider[$i]['is_new']): ?>
                                                    <img src="/template/images/home/new.png" class="new" alt="" />
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>

                            <div class="item">	
                                <?php for ($i = 0; $i < count($slider); $i++): ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?php echo $slider[$i]['image']; ?>" alt="" />
                                                    <h2><?php echo $slider[$i]['price']; ?>$</h2>
                                                    <p>
                                                        <a href="/product/<?php echo $slider[$i]['id']; ?>">
                                                            <?php echo $slider[$i]['name']; ?>
                                                        </a>
                                                    </p>
                                                    <a href="/basket/add/<?php echo $slider[$i]['id']; ?>" class="btn btn-default add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i>В корзину
                                                    </a>
                                                </div>
                                                <?php if ($slider[$i]['is_new']): ?>
                                                    <img src="/template/images/home/new.png" class="new" alt="" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>

                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>			
                    </div>
                </div><!--/recommended_items-->



            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/lego/footer.php'; ?>

