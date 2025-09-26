<?php 
$k= trim($_POST['id']);
$s= trim($_POST['id1']);
$l= trim($_POST['id2']);
$n= trim($_POST['id3']);

$conn1 = mysqli_connect("localhost","root","","database");
$sql1="select * from fee_sett where class_id = {$k} and st_Session = '{$s}'";
$result1 = mysqli_query($conn1,$sql1);
if($n == 10 || $n == 15 || $n == 20){
while($rows1 = mysqli_fetch_array ($result1)){
?> 
        <span> Total fee <?php
          $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['Mis_fee']+$rows1['CM_fee']+$rows1['Exam_fee']+$l;
          $tot = ($to*$n) /100;
          $total = $to-$tot;
          ?>
          <div  class="summary-section">
              <h5 class="mb-3 text-center">Fee Summary</h5>
              <p>Total Fee: <span id="totalFeeSum" class="fw-bold"><?php echo $to?></span></p>
              <input type="hidden" name=""id="">
<p>Discount: <span id="discount_Amount" class="fw-bold"><?php echo $tot . " (" . $n . "%)" ?></span></p>
              <input type="hidden" name="discount_am"id="discount_am" value="<?php echo $tot?>" >
               <input type="hidden" name="total_am"id="total_am" value="<?php echo $total ?>">
              <p class="final-amount">Final Amount: <span id="finalAmount"><?php echo $total ?></span></p>
              <small id="feeNote" class="form-text text-muted d-block text-end"><?php echo "Quarterly ₹". $l ." fee included"?></small>
            </div>
          <?php }
}
          else{
            while($rows1 = mysqli_fetch_array ($result1)){
                
?>
      <?php    $to = $rows1['Form_fee']+$rows1['AD_fee']+$rows1['Mis_fee']+$rows1['CM_fee']+$rows1['Exam_fee']+$l;
      ?>
        <div  class="summary-section">
              <h5 class="mb-3 text-center">Fee Summary</h5>
              <p>Total Fee: <span id="totalFeeSum" class="fw-bold"><?php echo $to; ?></span></p>
              <small id="feeNote" class="form-text text-muted d-block text-end"><?php echo "Quarterly ₹". $l ." fee included"?></small>
            </div>
<?php 
}
}
?>
