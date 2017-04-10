<?php include ROOT. '/views/lego/header.php';?>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Товар</td>
							<td class="description"></td>
							<td class="price">Цена</td>
							<td class="quantity">Количество</td>
							<td class="total">Всего</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                                            <?php if($products): ?>
                                                <?php foreach($products as $id => $prod): ?>
                                                    <tr>
                                                    
							<td class="cart_product">
								<a href=""><img src="<?php echo $prod['image']; ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="/product/<?php echo $prod['id']; ?>"><?php echo $prod['name']; ?></a></h4>
								<p>Код товара: <?php echo $prod['code']; ?></p>
							</td>
							<td class="cart_price">
								<p><?php echo $prod['price']; ?>$</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="/basket/add/<?php echo $prod['id']; ?>"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $prod['quantity']; ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="/basket/delete/<?php echo $prod['id']; ?>"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo $prod['price'] * $prod['quantity']; ?>$</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="/basket/drop/<?php echo $prod['id']; ?>"><i class="fa fa-times"></i></a>
							</td>
                                                    
                                                    </tr>
                                                <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="4" align="right"><h4>Общая стоимость:</h4></td>
                                                        <td class="cart_total">
								<p class="cart_total_price"><?php echo $sum; ?>$</p>
							</td>
                                                    </tr>
                                            <?php endif; ?>
					</tbody>
				</table>
			</div>
                    <p align="right"><a class="btn btn-default checkout" href="/basket/checkout"><i class="fa fa-shopping-cart"></i> Оформить заказ</a></p>

		</div>
	</section> <!--/#cart_items-->

        
<?php include ROOT. '/views/lego/footer.php';?>
