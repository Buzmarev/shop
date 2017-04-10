<?php include ROOT . '/views/lego/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <?php include ROOT . '/views/lego/category.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?php echo $product['image'] ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <?php if ($product['is_new']): ?>
                                    <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                <?php endif; ?>
                                <h2><?php echo $product['name'] ?></h2>
                                <p>Код товара: <?php echo $product['code'] ?></p>
                                <span>
                                    <span>US <?php echo $product['price'] ?>$</span>
                                    <a href="/basket/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </span>
                                <p><b>Наличие:</b> 
                                    <?php if ($product['availability']): ?>
                                        На складе</p>
                                <?php else: ?>
                                    Нет в наличии</p>
                                <?php endif; ?>
                                <p><b>Производитель:</b> <?php echo $product['brand'] ?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p>
                                <?php echo $product['description'] ?>
                            </p>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>


<br/>
<br/>

<?php include ROOT . '/views/lego/footer.php';?>