<div id="wc-filepond-dashboard">
  <h2>Uploaded Images</h2>
  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Image</th>
        <th>Order Details</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Get all orders with a FilePond upload
      $args = array(
        'post_type' => 'shop_order',
        'meta_key' => '_wc_filepond_upload',
        'posts_per_page' => -1,
      );
      $orders = get_posts( $args );
      
      // Loop through each order
      foreach ( $orders as $order ) {
        // Get the order ID and FilePond upload
        $order_id = $order->ID;
        $upload = get_post_meta( $order_id, '_wc_filepond_upload', true );
        
        // Get the order details
        $order = wc_get_order( $order_id );
        $order_date = $order->get_date_created()->format( 'Y-m-d H:i:s' );
        $order_status = $order->get_status();
        $order_total = $order->get_total();
        ?>
        <tr>
          <td><?php echo $order_id; ?></td>
          <td>
            <a href="<?php echo $upload; ?>" target="_blank">
              <img src="<?php echo $upload; ?>" alt="Image for Order <?php echo $order_id; ?>" width="100">
            </a>
          </td>
          <td>
            <p>Date: <?php echo $order_date; ?></p>
            <p>Status: <?php echo $order_status; ?></p>
            <p>Total: <?php echo $order_total; ?></p>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>