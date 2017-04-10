<?php include ROOT . '/views/lego/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>


                    <?php if ($result): ?>
                        <p>Заказ оформлен.</p>
                    <?php else: ?>

                        <p>Выбрано товаров: <?php echo $count; ?>, на сумму: <?php echo $sum; ?>$</p><br/>

                        <?php if (!$result): ?>                        

                            <div class="col-sm-4">
                                <?php if (isset($errors) && is_array($errors)): ?>
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li> - <?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <p>Для оформления заказа заполните форму.</p>

                                <div class="login-form">
                                    <form action="#" method="post">

                                        <p>Ваше имя</p>
                                        <input type="text" name="name" placeholder="" value="<?php echo $name; ?>"/>

                                        <p>Номер телефона</p>
                                        <input type="text" name="phone" placeholder="" value="<?php echo $phone; ?>"/>

                                        <p>Комментарий к заказу</p>
                                        <input type="text" name="comment" placeholder="Сообщение" value="<?php echo $comment; ?>"/>

                                        <br/>
                                        <br/>
                                        <input type="submit" name="submit" class="btn btn-default" value="Оформить" />
                                    </form>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/lego/footer.php'; ?>

