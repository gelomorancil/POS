  <?php
    if (!empty($monthly)) {
        foreach ($monthly as $key => $value) { ?>
          <tr class="custom-row">
              <td>
                  <div data-sales="<?= $value->total ?>"></div>
                  <div data-expenses=""></div>
                  <div data-profit=""></div>
                  <?= date('F', strtotime($value->Date_paid)) ?>
              </td>
              <td>&#8369 <?= number_format($value->total, 2) ?></td>
              <td>&#8369 </td>
              <td>&#8369 <?= number_format($value->total, 2) ?></td>
          </tr>
      <?php }
    } else {
        ?>
      <tr>
          <td colspan="4">NO DATA</td>
      </tr>
  <?php } ?>
